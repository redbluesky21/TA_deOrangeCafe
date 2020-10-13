<?php

namespace App\Http\Livewire\Admin;

use App\Models\Kategori as ModelsKategori;
use Livewire\Component;
use Livewire\WithPagination;

class Kategori extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $kategori_id, $nama, $paginate = 10, $search;

    protected $listeners = ['pagination' => 'selectPagination', 'deleteAllKategori'];
    public function selectPagination($paginateVal)
    {
        $this->paginate = $paginateVal;
    }
    public function render()
    {
        $result = ModelsKategori::where(
            'nama',
            'like',
            '%' . $this->search . '%'
        )->orderBy('nama', 'asc')->paginate($this->paginate);
        return view('livewire.admin.kategori.main', [
            'result' => $result,
            'rows' => $result->count()
        ]);
    }
    public function resetInputFields()
    {
        $this->kategori_id = '';
        $this->nama = '';
    }

    public function store()
    {
        $validation = $this->validate([
            'nama'        =>    'required',
        ]);

        ModelsKategori::create($validation);

        session()->flash('message', 'Data Created Successfully.');
        $this->resetInputFields();
        $this->emit('kategoriStore');
    }

    public function edit($id)
    {
        $data = ModelsKategori::findOrFail($id);
        $this->kategori_id = $id;
        $this->nama = $data->nama;
    }

    public function update()
    {
        $validate = $this->validate([
            'nama'    =>  'required',
        ]);

        $data = ModelsKategori::find($this->kategori_id);

        $data->update([
            'nama'       =>   $this->nama,
        ]);

        session()->flash('message', 'Data Updated Successfully.');

        $this->resetInputFields();

        $this->emit('kategoriStore');
    }

    public function delete($id)
    {
        ModelsKategori::find($id)->delete();
        session()->flash('message', 'Data Deleted Successfully.');
    }

    public function deleteAllKategori($id)
    {
        ModelsKategori::whereIn('id', $id)->delete();
        session()->flash('message', 'Data ' . count($id) . ' Deleted Successfully.');
    }
}
