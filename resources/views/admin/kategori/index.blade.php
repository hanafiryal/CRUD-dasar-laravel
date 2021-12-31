@extends('admin.layouts.app')

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card card-primary card-outline">
            <div class="card-header">
                @include('admin.kategori.create')
            </div>
            <div class="card-body">
                <div class="table">
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th width="1%">No</th>
                                <th>Nama Kategori</th>
                                <th>Jumlah</th>
                                <th>status</th>
                                <th width="20%">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($kategori as $no => $data)
                            <tr>
                                <td>{{ $no + 1; }}</td>
                                <td>{{ $data->jumlah }}</td>
                                <td>{{ $data->nama_kategori }}</td>
                                <td>{{ $data->status }}</td>
                                <td>
                                    <button type="button" class="btn btn-sm btn-outline-info" data-toggle="modal" data-target="#Detail{{ $data->id_kategori }}">
                                        <i class="fas fa-eye"></i> Detail
                                    </button>
                                    
                                    <a href="{{ route('admin.edit_kategori', $data->id_kategori) }}" class="btn btn-sm btn-outline-warning">
                                        <i class="fas fa-edit"></i> Edit
                                    </a>

                                    <button type="button" class="btn btn-sm btn-outline-danger" data-toggle="modal" data-target="#Hapus{{ $data->id_kategori }}">
                                        <i class="fas fa-trash"></i> Hapus
                                    </button>
                                </td>

                                @include('admin.kategori.detail')
                                @include('admin.kategori.delete')
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection