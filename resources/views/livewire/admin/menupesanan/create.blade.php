<div class="text-left mb-3">
    <button type="button" class="btn btn-success" data-toggle="modal" data-target="#createModal"><i class="fas fa-plus    "></i> Tambah Data</button>
    <button id="btnTrashKategori" class="btn btn-danger" wire:click="$emit('deleteAll')"><i class="fas fa-trash    "></i> Delete</button>
</div>

<div wire:ignore.self id="createModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="createModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createModalLabel">Add Data</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                     <span aria-hidden="true close-btn">×</span>
                </button>
            </div>
            <div class="modal-body">
                <form enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="nama">Nama Sub Kategori</label>
                        <select wire:model="sub_kategori_id" class="form-control" id="">
                            <option value="">-- Kategori --</option>
                            @foreach ($sub_kategori_data as $data)
                                <option value="{{ $data->id }}">{{ $data->nama }}</option>
                            @endforeach
                        </select>
                        @error('sub_kategori_id')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="nama">Menu Pesanan</label>
                        <input type="text" id="nama" class="form-control"  placeholder="Menu Pesanan..." wire:model="nama" />
                        @error('nama')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="harga">Harga</label>
                        <input type="text" id="harga" class="form-control hargaMenu"  placeholder="Harga..." wire:change="$emit('inputHarga')" />
                        @error('harga')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="stok">Stok</label>
                        <input type="text" id="stok" class="form-control"  placeholder="Stok..." wire:model="stok" />
                        @error('stok')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="gambar">Gambar</label> <br>
                        <input type="file" class="form-control" id="gambar" wire:model="gambar"/>
                        @error('gambar')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <button wire:click.prevent="store()" class="btn btn-success">Save</button>
                    <button type="button" class="btn btn-secondary close-btn" data-dismiss="modal">Close</button>
                </form>
            </div>
        </div>
    </div>
</div>