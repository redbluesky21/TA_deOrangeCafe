<?php

namespace App\Http\Livewire\Admin;

use Livewire\WithFileUploads;

use App\Models\Menu as ModelsMenupesanan;
use Livewire\Component;
use Livewire\WithPagination;
use App\Models\SubKategori;
use Intervention\Image\ImageManagerStatic as Image;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class Menupesanan extends Component
{
    use WithPagination;
    use WithFileUploads;
    protected $paginationTheme = 'bootstrap';

    public $Menupesanan_id, $nama, $harga, $paginate = 10, $search, $stok, $sub_kategori_id, $gambar, $gambarOld;

    protected $listeners = ['pagination' => 'selectPagination', 'deleteAllMenupesanan', 'gambarUpload', 'inputHargaHandle'];
    public function selectPagination($paginateVal)
    {
        $this->paginate = $paginateVal;
    }
    public function render()
    {
        $result = ModelsMenupesanan::select('menu.nama as menu_pesanan', 'sub_kategori.nama as nama_sub_kategori', 'menu.id', 'menu.harga', 'menu.stok', 'menu.gambar')->join('sub_kategori', 'sub_kategori.id', '=', 'menu.sub_kategori_id')
            ->where('menu.nama', 'like', '%' . $this->search . '%')
            ->orWhere('sub_kategori.nama', 'like', '%' . $this->search . '%')->orderBy('sub_kategori.nama', 'asc')
            ->orWhere('menu.harga', 'like', '%' . $this->search . '%')
            ->orWhere('menu.stok', 'like', '%' . $this->search . '%')
            ->paginate($this->paginate);
        return view('livewire.admin.menupesanan.main', [
            'result' => $result,
            'sub_kategori_data' => SubKategori::all(),
            'rows' => $result->count()
        ]);
    }
    public function resetInputFields()
    {
        $this->sub_kategori_id = '';
        $this->nama = '';
        $this->harga = '';
        $this->stok = '';
        $this->Menupesanan_id = '';
        $this->gambar = '';
        $this->gambarOld = '';
    }

    public function store()
    {
        $validation = $this->validate([
            'nama'              =>    'required',
            'sub_kategori_id'   =>    'required|numeric',
            'harga'             =>    'required',
            'stok'              =>    'required|numeric',
            'gambar'            =>    'required|image|max:200|mimes:jpeg,bmp,png,jpg,gif',
        ]);
        $image = $this->storeImage();
        $createdMenu = ModelsMenupesanan::create(
            [
                'nama'            => $this->nama,
                'harga'           => str_replace('.', '', $this->harga),
                'stok'            => $this->stok,
                'gambar'          => $image,
                'sub_kategori_id' => $this->sub_kategori_id,
            ]
        );

        session()->flash('message', 'Data Created Successfully.');
        $this->resetInputFields();
        $this->emit('MenupesananStore');
    }

    public function edit($id)
    {
        $data = ModelsMenupesanan::findOrFail($id);
        $this->Menupesanan_id = $id;
        $this->sub_kategori_id = $data->sub_kategori_id;
        $this->nama = $data->nama;
        $this->harga = $data->harga;
        $this->stok = $data->stok;
        $this->gambar = $data->gambar;
        $this->gambarOld = $data->gambar;
    }

    public function update()
    {
        if ($this->gambarOld == $this->gambar) {
            $validation = $this->validate([
                'nama'              =>    'required',
                'sub_kategori_id'   =>    'required|numeric',
                'harga'             =>    'required',
                'stok'              =>    'required|numeric',
            ]);
        } else {
            $validation = $this->validate([
                'nama'              =>    'required',
                'sub_kategori_id'   =>    'required|numeric',
                'harga'             =>    'required',
                'stok'              =>    'required|numeric',
                'gambar'            =>    'required|image|max:200|mimes:jpeg,bmp,png,jpg,gif',
            ]);
        }
        $data = ModelsMenupesanan::find($this->Menupesanan_id);
        if ($this->gambarOld == $this->gambar) {
            $data->update([
                'nama'              =>   $this->nama,
                'sub_kategori_id'   =>   $this->sub_kategori_id,
                'harga'             =>   str_replace('.', '', $this->harga),
                'stok'              =>   $this->stok,
                'gambar'            =>   $this->gambarOld,
            ]);
        } else {
            Storage::delete('public/menu/img/' . $this->gambarOld);
            $image = $this->storeImage();
            $data->update([
                'nama'              =>   $this->nama,
                'sub_kategori_id'   =>   $this->sub_kategori_id,
                'harga'             =>   str_replace('.', '', $this->harga),
                'stok'              =>   $this->stok,
                'gambar'            =>   $image,
            ]);
        }

        session()->flash('message', 'Data Updated Successfully.');

        $this->resetInputFields();
        $this->emit('MenupesananStore');
    }

    public function delete($id)
    {
        $data = ModelsMenupesanan::find($id);
        Storage::delete('public/menu/img/' . $data->gambar);
        ModelsMenupesanan::find($id)->delete();
        session()->flash('message', 'Data Deleted Successfully.');
    }

    public function deleteAllMenupesanan($id)
    {
        $data = ModelsMenupesanan::whereIn('id', $id)->get();
        foreach ($data as $row) {
            Storage::delete('public/menu/img/' . $row->gambar);
        }
        ModelsMenupesanan::whereIn('id', $id)->delete();
        session()->flash('message', 'Data ' . count($id) . ' Deleted Successfully.');
    }
    public function gambarUpload($result)
    {
        $this->gambar = $result;
    }
    public function inputHargaHandle($result)
    {
        $this->harga = $result;
    }
    public function storeImage()
    {
        if (!$this->gambar) {
            return null;
        }

        $img = Image::make($this->gambar)->encode('jpg');
        $name = Str::random() . '.jpg';
        Storage::disk('local')
            ->put(
                'public/menu/img/' . $name,
                $img
            );
        return $name;
    }
}
