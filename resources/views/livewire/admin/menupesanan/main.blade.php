<div class="page-content">
    <div class="page-title-box">
        <div class="container-fluid">
            <div class="row align-items-center">
                <div class="col-md-8">
                    <h4 class="page-title mb-1">Menu Pesanan</h4>
                    {{ Breadcrumbs::render('menu-pesanan') }}
                </div>
            </div>    
        </div>
    </div>
    <div class="page-content-wrapper">
        <div class="container-fluid">        
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header bg-transparent p-3">
                            <h5 class="header-title mb-0">Data Menu Pesanan</h5>
                        </div>
                        <div class="card-body">
                        @if(session()->has('message'))
                            <div class="alert alert-success">{{ session('message') }}</div>
                        @endif
                        @include('livewire.admin.menupesanan.create')
                        @include('livewire.admin.menupesanan.update')
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="float-left" style="width:10%;">
                                    <select wire:change="$emit('selectPaginate')" class="form-control selectPaginate" id="">
                                        <option value="">-- Pagination --</option>
                                        <option value="5">5</option>
                                        <option value="10">10</option>
                                        <option value="15">15</option>
                                        <option value="50">50</option>
                                        <option value="100">100</option>
                                    </select>
                                </div>
                                <div class="w-25 float-right">
                                    <div class="form-group">
                                        <input type="text" placeholder="Search..." wire:model="search" class="form-control">
                                    </div>
                                </div>
                                <div class="clearfix"></div>
                            </div>
                        </div>
                            <div class="table-responsive">
                                <table class="table mb-0 table-striped table-bordered" id="tablemenupesanan">
                                    <thead>
                                        <tr>
                                            <th width="100px">
                                                <div class="custom-control custom-checkbox custom-control-inline">
                                                    <input type="checkbox" class="custom-control-input" id="check_all_menupesanan">
                                                  <label class="custom-control-label" for="check_all_menupesanan"></label>
                                              </div>
                                          </th>
                                          <th>Menu Pesanan</th>
                                          <th>Harga</th>
                                          <th>Stok</th>
                                          <th>Sub Kategori</th>
                                          <th>Gambar</th>
                                          <th width="200px;" class="text-center">Action</th>
                                      </tr>
                                  </thead>
                                  <tbody>
                                      @foreach ($result as $index=> $row)
                                          <tr>
                                              <td>
                                                  <div class="custom-control custom-checkbox custom-control-inline">
                                                      <input type="checkbox" class="custom-control-input check_item_menupesanan" id="checkItemmenupesanan{{ $index }}" value="{{ $row->id }}">
                                                      <label class="custom-control-label" for="checkItemmenupesanan{{ $index }}"></label>
                                                  </div>
                                              </td>
                                              <td>
                                                  {{ $row->menu_pesanan }}
                                              </td>
                                              <td>
                                                Rp. {{ number_format($row->harga,2,",",".") }}
                                              </td>
                                              <td>
                                                {{ $row->stok }}
                                              </td>
                                              <td>
                                                {{ $row->nama_sub_kategori }}
                                              </td>
                                              <td>
                                                  <img src="{{ $row->imagePath }}" width="100" alt="Gambar Pesanan">
                                              </td>
                                              <td class="text-center">
                                                <button data-toggle="modal" data-target="#updateModal" class="btn btn-primary btn-sm" wire:click="edit({{ $row->id }})"><i class="fas fa-pencil-alt    "></i> Edit</button>
                                                <button wire:click="delete({{ $row->id }})" class="btn btn-danger btn-sm"><i class="fas fa-trash-alt    "></i> Delete</button>
                                              </td>
                                          </tr>
                                      @endforeach
                                  </tbody>
                              </table>
                            </div>
                            <div class="mt-3">
                                <smal class="text-secondary" style="font-size: 12px;">{{ $rows }} Rows Table</smal><br>
                                {{ $result->links() }}
                            </div>
                        </div>
                    </div>
                  </div>
            </div>
            <!-- end row -->        
          </div> <!-- container-fluid -->
      </div>
</div>

@push('script')
    <script>
        $(document).ready(function(){
            window.livewire.on('selectPaginate', ()  => {
                var val = $('.selectPaginate').val();
                window.livewire.emit('pagination',val);
            })
            
            window.livewire.on('MenupesananStore', () => {
                $('#createModal').modal('hide');
                $('#updateModal').modal('hide');
            });
            $(document).on('click','#check_all_menupesanan',function(){
                if($(this).is(':checked')){
                    $('.check_item_menupesanan').prop('checked',true);
                } else {
                    $('.check_item_menupesanan').prop('checked',false);
                }
            })
            $(document).on('click','.check_item_menupesanan',function(){
                if($('.check_item_menupesanan').length == $('.check_item_menupesanan:checked').length){
                    $('#check_all_menupesanan').prop('checked',true);
                } else {
                    $('#check_all_menupesanan').prop('checked',false);
                }
            })
            window.livewire.on('deleteAll', ()  => {
                var allVals = [];
                $('.check_item_menupesanan:checked').each(function() {
                    allVals.push($(this).val());
                });
                window.livewire.emit('deleteAllMenupesanan',allVals);
            })
            window.livewire.on('inputHarga', ()  => {
                var val = $('.hargaMenu').val();
                window.livewire.emit('inputHargaHandle',val);
            })
            window.livewire.on('inputHargaUpdate', ()  => {
                var val = $('#hargaMenu').val();
                window.livewire.emit('inputHargaHandle',val);
            })
            new AutoNumeric('.hargaMenu', {
                decimalCharacter : ',',
                digitGroupSeparator : '.',
                decimalPlaces:0,
            });
            new AutoNumeric('#hargaMenu', {
                decimalCharacter : ',',
                digitGroupSeparator : '.',
                decimalPlaces:0,
            });
            $(".custom-file-input").on("change", function() {
                var fileName = $(this).val().split("\\").pop();
                $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
            });
            window.livewire.on('fileChoosen', () => {
                let inputField = document.getElementById('gambar');
                let file =inputField.files[0];
                let reader = new FileReader();

                reader.onloadend = () => {
                window.livewire.emit('gambarUpload',reader.result);
                }

                reader.readAsDataURL(file);
            })
        })
        
    </script>
@endpush