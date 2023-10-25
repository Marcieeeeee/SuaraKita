@extends('Admin.layouts.admin')

@section('css')
    <Link rel="stylesheet" href="{{asset('admin/vendor/datatables/dataTables.bootstrap4.min.css')}}">
@endsection

@section('title', 'Halaman Masyarakat')

@section('header', 'Masyarakat')

@section('content') 
<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>NIK</th>
                            <th>Nama</th>
                            <th>Username</th>
                            <th>Telp</th>
                            <th>Detail</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($masyarakat as $k => $v)
                        <tr>
                            <td>{{ $k += 1 }}</td>
                            <td>{{ $v->nik }}</td>
                            <td>{{ $v->nama }}</td>
                            <td>{{ $v->username }}</td>
                            <td>{{ $v->telp }}</td>
                            <td><a href="{{ route('masyarakat.show', $v->id) }}">Lihat</a></td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection