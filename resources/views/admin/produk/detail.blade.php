<div class="modal fade" id="Detail{{ $data->id_produk }}">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Detail Produk</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group row">
                    <div class="col-md-12">
                        <img class="img-responsive img-thumbnail" src="@if(!empty($data->gambar)) {{ asset('storage/assets/uploads/images/' . $data->gambar) }} @endif" alt="Image">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="nama_produk" class="col-md-3">Nama Produk</label>
                    <div class="col-md-9">
                        <p>: {{ $data->nama_produk }}</p>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="sku_produk" class="col-md-3">SKU Produk</label>
                    <div class="col-md-9">
                        <p>: {{ $data->sku_produk }}</p>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="harga_produk" class="col-md-3">Harga Produk</label>
                    <div class="col-md-9">
                        <p>: {{ $data->harga_produk }}</p>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="nama_kategori" class="col-md-3">Kategori</label>
                    <div class="col-md-9">
                        <p>: {{ $data->nama_kategori }}</p>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="deskripsi" class="col-md-3">Deskripsi</label>
                    <div class="col-md-9">
                        <p>: {{ $data->deskripsi }}</p>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="status" class="col-md-3">Status</label>
                    <div class="col-md-9">
                        <p>: {{ $data->status }}</p>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="created_at" class="col-md-3">Created At</label>
                    <div class="col-md-9">
                        <p>: {{ date('d M Y H:i', strtotime($data->created_at)) }}</p>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="updated_at" class="col-md-3">Updated At</label>
                    <div class="col-md-9">
                        <p>: {{ date('d M Y H:i', strtotime($data->updated_at)) }}</p>
                    </div>
                </div>
            </div>
            <div class="modal-footer float-right">
                <button type="button" class="btn btn-default" data-dismiss="modal">
                    <i class="fas fa-times"></i> Close
                </button>
                <a href="{{ route('admin.edit_produk', $data->id_produk)}}" class="btn btn-warning">
                    <i class="fas fa-edit"></i> Edit
                </a>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->