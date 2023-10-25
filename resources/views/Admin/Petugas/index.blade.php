@extends('Admin.layouts.admin')

@section('css')
    <ink rel="stylesheet" href="{{asset('admin/vendor/datatables/dataTables.bootstrap4.min.css')}}">
@endsection

@section('title', 'Halaman Petugas')

@section('header', 'Petugas')

@section('content') 
<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="table-responsive">
                <a href="{{route('petugas.formTambah')}}" class="btn btn-success mb-3">Tambah Petugas</a>
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Petugas</th>
                            <th>Username</th>
                            <th>Telp</th>
                            <th>Level</th>
                            <th>Detail</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($petugas as $k => $v)
                        <tr>
                            <td>{{$k += 1}}</td>
                            <td>{{$v->nama_petugas}}</td>
                            <td>{{$v->username}}</td>
                            <td>{{$v->telp}}</td>
                            <td>{{$v->level}}</td>
                            <td>
                                <a href="{{ route('petugas.formEdit', $v->id_petugas) }}" style="text-decoration: underline">Lihat</a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection