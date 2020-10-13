<?php

namespace App\Http\Livewire\Admin;

use App\Models\Subkategori as ModelsSubkategori;
use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Kategori;

class Subkategori extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $Subkategori_id, $nama, $kategori_id, $paginate = 10, $search;

    protected $listeners = ['pagination' => 'selectPagination', 'deleteAllSubKategori'];
    public function selectPagination($paginateVal)
    {
        $this->paginate = $paginateVal;
    }
    public function render()
    {
        $result = ModelsSubkategori::select('sub_kategori.id', 'kategori.id as id_kategori', 'sub_kategori.nama as nama_sub_kategori', 'kategori.nama as nama_kategori')->join('kategori', 'kategori.id', '=', 'sub_kategori.kategori_id')
            ->where('kategori.nama', 'like', '%' . $this->search . '%')->orWhere('sub_kategori.nama', 'like', '%' . $this->search . '%')->orderBy('sub_kategori.nama', 'asc')->paginate($this->paginate);
        return view('livewire.admin.Subkategori.main', [
            'result' => $result,
            'kategori_data' => Kategori::all(),
            'rows' => $result->count()
        ]);
    }
    public function resetInputFields()
    {
        $this->kategori_id = '';
        $this->nama = '';
        $this->Subkategori_id = '';
    }

    public function store()
    {
        $validation = $this->validate([
            'nama'          =>    'required',
            'kategori_id'   =>    'required|numeric',
        ]);

        ModelsSubkategori::create($validation);

        session()->flash('message', 'Data Created Successfully.');
        $this->resetInputFields();
        $this->emit('subKategoriStore');
    }

    public function edit($id)
    {
        $data = ModelsSubkategori::findOrFail($id);
        $this->Subkategori_id = $id;
        $this->kategori_id = $data->kategori_id;
        $this->nama = $data->nama;
    }

    public function update()
    {
        $validation = $this->validate([
            'nama'          =>    'required',
            'kategori_id'   =>    'required|numeric',
        ]);
        $data = ModelsSubkategori::find($this->Subkategori_id);

        $data->update([
            'nama'              =>   $this->nama,
            'kategori_id'       =>   $this->kategori_id,
        ]);

        session()->flash('message', 'Data Updated Successfully.');

        $this->resetInputFields();

        $this->emit('subKategoriStore');
    }

    public function delete($id)
    {
        ModelsSubkategori::find($id)->delete();
        session()->flash('message', 'Data Deleted Successfully.');
    }

    public function deleteAllSubKategori($id)
    {
        ModelsSubkategori::whereIn('id', $id)->delete();
        session()->flash('message', 'Data ' . count($id) . ' Deleted Successfully.');
    }
}
