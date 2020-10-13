<div class="page-content">
    <div class="page-title-box">
        <div class="container-fluid">
            <div class="row align-items-center">
                <div class="col-md-8">
                    <h4 class="page-title mb-1">Sub Kategori</h4>
                    {{ Breadcrumbs::render('sub-kategori') }}
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
                            <h5 class="header-title mb-0">Data Sub Kategori</h5>
                        </div>
                        <div class="card-body">
                        @if(session()->has('message'))
                            <div class="alert alert-success">{{ session('message') }}</div>
                        @endif
                        @include('livewire.admin.subkategori.create')
                        @include('livewire.admin.subkategori.update')
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
                                <table class="table mb-0 table-striped table-bordered" id="tablesub-kategori">
                                    <thead>
                                        <tr>
                                            <th width="100px">
                                                <div class="custom-control custom-checkbox custom-control-inline">
                                                    <input type="checkbox" class="custom-control-input" id="check_all_sub-kategori">
                                                  <label class="custom-control-label" for="check_all_sub-kategori"></label>
                                              </div>
                                          </th>
                                          <th>Nama Sub Kategori</th>
                                          <th>Nama Kategori</th>
                                          <th width="200px;" class="text-center">Action</th>
                                      </tr>
                                  </thead>
                                  <tbody>
                                      @foreach ($result as $index=> $row)
                                          <tr>
                                              <td>
                                                  <div class="custom-control custom-checkbox custom-control-inline">
                                                      <input type="checkbox" class="custom-control-input check_item_sub-kategori" id="checkItemsub-kategori{{ $index }}" value="{{ $row->id }}">
                                                      <label class="custom-control-label" for="checkItemsub-kategori{{ $index }}"></label>
                                                  </div>
                                              </td>
                                              <td>
                                                  {{ $row->nama_sub_kategori }}
                                              </td>
                                              <td>
                                                {{ $row->nama_kategori }}
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
            
            window.livewire.on('subKategoriStore', () => {
                $('#createModal').modal('hide');
                $('#updateModal').modal('hide');
            });
            $(document).on('click','#check_all_sub-kategori',function(){
                if($(this).is(':checked')){
                    $('.check_item_sub-kategori').prop('checked',true);
                } else {
                    $('.check_item_sub-kategori').prop('checked',false);
                }
            })
            $(document).on('click','.check_item_sub-kategori',function(){
                if($('.check_item_sub-kategori').length == $('.check_item_sub-kategori:checked').length){
                    $('#check_all_sub-kategori').prop('checked',true);
                } else {
                    $('#check_all_sub-kategori').prop('checked',false);
                }
            })
            window.livewire.on('deleteAll', ()  => {
                var allVals = [];
                $('.check_item_sub-kategori:checked').each(function() {
                    allVals.push($(this).val());
                });
                window.livewire.emit('deleteAllSubKategori',allVals);
            })
        })
        
    </script>
@endpush