@extends('admin.layouts.app')

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card card-primary card-outline">
            @can('isAdmin')
            <div class="card-header">
                <a href="{{ route('admin.tambah_produk')}}" class="btn btn-outline-primary">
                    <i class="fas fa-plus"></i> Tambah
                </a>
            </div>
            @endcan
            <div class="card-body">
                <form action="{{ url()->current() }}">
                    <div class="row mb-2">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-check-label mr-1" for="limit">
                                    Show 
                                </label>
                                <select name="limit" class="custom-select custom-select-sm form-control form-control-sm col-2" aria-controls="limit">
                                    <option value="10" @if($limit == 10)selected @endif>10</option>
                                    <option value="25" @if($limit == 25)selected @endif>25</option>
                                    <option value="50" @if($limit == 50)selected @endif>50</option>
                                    <option value="100" @if($limit == 100)selected @endif>100</option>
                                </select>
                                <label class="form-check-label ml-1" for="limit">
                                    entries 
                                </label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="float-right">
                                <div class="form-inline">
                                    <label class="form-check-label mr-1" for="search">
                                        Search: 
                                    </label>
                                    <div class="input-group">
                                    <input type="search" name="search" class="form-control form-control-sm" value="{{ $_GET['search'] ?? '' }}" placeholder="Ketik kata pencarian..." aria-controls="search">
                                    <span class="input-group-append">
                                        <button type="submit" class="btn btn-sm btn-info">Go!</button>
                                    </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
                <div class="table">
                    <table class="table table-bordered table-hover table-sm projects">
                        <thead>
                            <tr>
                                <th width="1%">No</th>
                                <th>Nama/ SKU Produk</th>
                                <th>Kategori</th>
                                <th>Harga Produk</th>
                                <th>status</th>
                                <th width="20%">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($produk as $no => $data)
                            <tr>
                                <td>{{ $no + 1; }}</td>
                                <td>
                                    <div class="media">
                                        <img style="width: 120px;" class="img-thumbnail mr-2" src="@if(!empty($data->gambar)) {{ asset('storage/assets/uploads/images/' . $data->gambar) }} @endif" alt="Image">

                                        <div class="media-body mb-0 small lh-125">
                                            <div class="d-flex justify-content-between align-items-center">
                                                <strong class="text-gray-dark">{{ $data->nama_produk }}</strong>
                                            </div>
                                            SKU: <span class="text-primary">{{ $data->sku_produk }}</span>
                                        </div>
                                    </div>
                                </td>
                                <td>{{ $data->nama_kategori }}</td>
                                <td>{{ $data->harga_produk }}</td>
                                <td>{{ $data->status }}</td>
                                <td>
                                    <button type="button" class="btn btn-sm btn-outline-info" data-toggle="modal" data-target="#Detail{{ $data->id_produk }}">
                                        <i class="fas fa-eye"></i> Detail
                                    </button>
                                    
                                    @can('isAdmin')
                                    <a href="{{ route('admin.edit_produk', $data->id_produk) }}" class="btn btn-sm btn-outline-warning">
                                        <i class="fas fa-edit"></i> Edit
                                    </a>

                                    <button type="button" class="btn btn-sm btn-outline-danger" data-toggle="modal" data-target="#Hapus{{ $data->id_produk }}">
                                        <i class="fas fa-trash"></i> Hapus
                                    </button>
                                    @endcan
                                </td>

                                @include('admin.produk.detail')
                                @include('admin.produk.delete')
                            </tr>
                            @endforeach

                            @if(empty($produk->total()))
                            <tr>
                                <td colspan="7" class="text-center">Data masih kosong</td>
                            </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="card-footer clearfix">
                <div class="row">
                    <div class="col-6">
                        <caption>Showing {{ $produk->firstItem() ?? 0 }} to {{ $produk->lastItem() ?? 0 }} of {{ $produk->total() }} entries</caption>
                    </div>
                    <div class="col-6">
                        <div class="float-right">{{ $produk->onEachSide(3)->links() }}</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection