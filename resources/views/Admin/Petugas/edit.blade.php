@extends('Admin.layouts.admin')

@section('css')
    <Link rel="stylesheet" href="{{asset('admin/vendor/datatables/dataTables.bootstrap4.min.css')}}">
@endsection

@section('title', 'Halaman Petugas')

@section('header')
    <a href="{{ route('petugas.index')}}">Data Petugas </a>
    <a href="#" class="text-grey"> / </a>
    <a href="#" class="text-grey"> Edit Data Petugas</a>
@endsection

@section('content') 
    <div class="container-fluid">
        <div class="col-lg-6 col-12">
            <div class="card shadow">
                <div class="card-header">
                    Form Edit Petugas
                </div>
                <div class="card-body">
                    <form action="{[route('petugas.update', $petugas->id_petugas)]}" method="post">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label for="nama_petugas">Nama Petugas</label>
                            <input type="text"  value="{{ $petugas->nama_petugas }}" name="nama_petugas" id="nama_petugas" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="username">Username</label>
                            <input type="text" value="{{ $petugas->username }}" name="username" id="username" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" name="password" id="password" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="telp">No Telp</label>
                            <input type="number" value="{{ $petugas->telp }}" name="telp" id="telp" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="level">Level</label>
                            <div class="input -group">
                                <select name="level" id="level" class="custom-select">
                                    @if($petugas->level == 'admin')
                                    <option selected value="admin">Admin</option>
                                    <option value="petugas">Petugas</option>
                                    @else
                                    <option value="admin">Admin</option>
                                    <option selected value="petugas">Petugas</option>
                                    @endif
                                </select>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-warning text-white" style="width: 100%">Simpan</button>
                    </form>
                    <form action="{{ route('petugas.destroy', $petugas->id_petugas) }}" method="post">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger" style="margin-top:5px; width:100%">Hapus</button>
                    </form>

                </div>
            </div>
        </div>
    </div>
@endsection