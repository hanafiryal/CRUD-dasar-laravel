<div class="modal fade" id="Detail{{ $data->id_kategori }}">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Detail Kategori</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group row">
                    <label for="nama_kategori" class="col-md-3">Nama Kategori</label>
                    <div class="col-md-9">
                        <p>: {{ $data->nama_kategori }}</p>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="jumlah" class="col-md-3">Jumlah</label>
                    <div class="col-md-9">
                        <p>: {{ $data->jumlah }}</p>
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
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->