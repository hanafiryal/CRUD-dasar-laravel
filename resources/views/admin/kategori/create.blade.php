<button type="button" class="btn btn-outline-primary" data-toggle="modal" data-target="#Tambah">
    <i class="fas fa-plus"></i> Tambah
</button>

<div class="modal fade" id="Tambah">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Tambah Kategori</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('admin.simpan_kategori') }}" method="POST" class="form-horizontal">
                @csrf
                <div class="modal-body">
                    <div class="form-group row">
                        <label for="nama_kategori" class="col-md-3">Nama Kategori</label>
                        <div class="col-md-9">
                            <input type="text" name="nama_kategori" class="form-control @error('nama_kategori') is-invalid @enderror" value="{{ old('nama_kategori') }}" placeholder="Nama kategori">
                            @error('nama_kategori')
                            <em class="text-danger">{{ $message }}</em>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="jumlah" class="col-md-3">Jumlah</label>
                        <div class="col-md-9">
                            <input type="number" name="jumlah" class="form-control @error('jumlah') is-invalid @enderror" value="{{ old('jumlah') }}" placeholder="Jumlah">
                            @error('jumlah')
                            <em class="text-danger">{{ $message }}</em>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="status" class="col-md-3">Status</label>
                        <div class="col-md-9">
                            <select name="status" class="custom-select @error('status') is-invalid @enderror">
                                <option value="Active">Active</option>
                                <option value="Inactive">Inactive</option>
                            </select>
                            @error('status')
                            <em class="text-danger">{{ $message }}</em>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="modal-footer float-right">
                    <button type="button" class="btn btn-default" data-dismiss="modal">
                        <i class="fas fa-times"></i> Close
                    </button>
                    <button type="submit" class="btn btn-success">
                        <i class="fas fa-save"></i> Simpan
                    </button>
                </div>
            </form>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->