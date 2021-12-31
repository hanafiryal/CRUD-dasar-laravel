@extends('admin.layouts.app')

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card card-primary card-outline">
            <form action="{{ route('admin.update_kategori', $kategori->id_kategori)}}" method="POST" class="form-horizontal">
                @method('PATCH')
                @csrf
                <div class="card-body">
                    <div class="form-group row">
                        <label for="nama_kategori" class="col-md-3">Nama Kategori</label>
                        <div class="col-md-9">
                            <input type="text" name="nama_kategori" class="form-control @error('nama_kategori') is-invalid @enderror" value="{{ $kategori->nama_kategori }}" placeholder="Nama kategori">
                            @error('nama_kategori')
                            <em class="text-danger">{{ $message }}</em>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="jumlah" class="col-md-3">Jumlah</label>
                        <div class="col-md-9">
                            <input type="text" name="jumlah" class="form-control @error('jumlah') is-invalid @enderror" value="{{ $kategori->jumlah }}" placeholder="Jumlah">
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
                                <option value="Inactive" @if($kategori->status == "Inactive") selected @endif>Inactive</option>
                            </select>
                            @error('status')
                            <em class="text-danger">{{ $message }}</em>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <div class="float-right">
                        <a href="{{ route('admin.kategori') }}" class="btn btn-default">
                            <i class="fas fa-undo"></i> Kembali
                        </a>
                        <button type="submit" class="btn btn-warning">
                            <i class="fas fa-edit"></i> Update
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection