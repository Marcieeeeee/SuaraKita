@extends('Admin.layouts.admin')

@section('css')
    <Link rel="stylesheet" href="{{asset('admin/vendor/datatables/dataTables.bootstrap4.min.css')}}">
@endsection

@section('title', 'Halaman Petugas')

@section('header')
    <a href="{{ route('petugas.index')}}">Data Petugas </a>
    <a href="#" class="text-grey"> / </a>
    <a href="#" class="text-grey"> Tambah Data Petugas</a>
@endsection

@section('content') 
    <div class="container-fluid">
        <div class="col-lg-6 col-12">
            <div class="card shadow">
                <div class="card-header">
                    Form Tambah Petugas
                </div>
                <div class="card-body">
                    <form action="{{ route('petugas.register') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="nama_petugas">Nama Petugas</label>
                            <input type="text" name="nama_petugas" id="nama_petugas" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="username">Username</label>
                            <input type="text" name="username" id="username" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" name="password" id="password" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="telp">No Telp</label>
                            <input type="number" name="telp" id="telp" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="level">Level</label>
                            <div class="input -group">
                                <select name="level" id="level" class="custom-select">
                                    <option value="#">Pilih-Level</option>
                                    <option value="admin">Admin</option>
                                    <option value="petugas">Petugas</option>
                                </select>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary" style="width: 100%">Simpan</button>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-lg-6 col-12">
            @if(Session::has('username'))
                <div class="alert alert-danger">{{Session::get('username')}}</div>
            @endif
            @if($errors->any)
                @foreach($errors->all() as $error)
                    <div class="alert alert-danger">{{ $error }}</div>
                @endforeach
            @endif
        </div>
    </div>
@endsection