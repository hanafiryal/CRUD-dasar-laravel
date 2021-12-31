@extends('admin.layouts.app')

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card card-primary card-outline">
            <form action="{{ route('admin.simpan_produk')}}" method="POST" class="form-horizontal" enctype="multipart/form-data">
                @csrf
                <div class="card-body">
                    <div class="form-group row">
                        <label for="id_kategori" class="col-md-3">Kategori</label>
                        <div class="col-md-9">
                            <select name="id_kategori" id="id_kategori" class="form-control custom-select @error('id_kategori') is-invalid @enderror">
                                <option value="">Pilih Kategori</option>
                                @foreach($kategori as $value)
                                <option value="{{ $value->id_kategori }}">{{ $value->nama_kategori }}</option>
                                @endforeach
                            </select>
                            @error('id_kategori')
                            <em class="text-danger">{{ $message }}</em>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="nama_produk" class="col-md-3">Nama Produk</label>
                        <div class="col-md-9">
                            <input type="text" name="nama_produk" class="form-control @error('nama_produk') is-invalid @enderror" value="{{ old('nama_produk') }}" placeholder="Nama produk">
                            @error('nama_produk')
                            <em class="text-danger">{{ $message }}</em>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="sku_produk" class="col-md-3">SKU Produk</label>
                        <div class="col-md-9">
                            <input type="text" name="sku_produk" class="form-control @error('sku_produk') is-invalid @enderror" value="{{ old('sku_produk') }}" placeholder="SKU Produk">
                            @error('sku_produk')
                            <em class="text-danger">{{ $message }}</em>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="harga_produk" class="col-md-3">Harga Produk</label>
                        <div class="col-md-9">
                            <input type="number" name="harga_produk" class="form-control @error('harga_produk') is-invalid @enderror" value="{{ old('harga_produk') }}" placeholder="Harga Produk">
                            @error('harga_produk')
                            <em class="text-danger">{{ $message }}</em>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="deskripsi" class="col-md-3">Deskripsi</label>
                        <div class="col-md-9">
                            <textarea name="deskripsi" class="form-control @error('deskripsi') is-invalid @enderror" rows="5" placeholder="Tulis derskripsi produk disini">{{ old('deskripsi') }}</textarea>
                            @error('deskripsi')
                            <em class="text-danger">{{ $message }}</em>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="gambar" class="col-md-3">Foto/ Gambar</label>
                        <div class="col-md-9">
                            <input type="file" name="gambar" class="form-control @error('gambar') is-invalid @enderror" value="{{ old('gambar') }}" placeholder="Foto/ Gambar">
                            @error('gambar')
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
                <div class="card-footer">
                    <div class="float-right">
                    <a href="{{ route('admin.produk') }}" class="btn btn-default">
                        <i class="fas fa-undo"></i> Kembali
                    </a>
                    <button type="submit" class="btn btn-success">
                        <i class="fas fa-save"></i> Simpan
                    </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection