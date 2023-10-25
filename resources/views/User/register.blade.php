@extends('layouts.user')

@section('css')
<link rel="stylesheet" href="{{ asset('css/register.css') }}">
@endsection

@section('title', 'Halaman Daftar')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-5">
            <h2 class="text-center text-white mb-0 mt-5">SUARA KITA</h2>
            <P class="text-center text-white mb-5">Platform Pengaduan Publik untuk Suara Keadilan</P>
            <div class="card mt-5">
                <div class="card-body">
                    <h2 class="text-center text-white mb-5">FORM DAFTAR</h2>
                    <form action="{{ route('suarakita.register') }}" method="POST">
                        @csrf
                        <div class="form-group" id="inputGroup">
                            <input type="number" required="" name="nik" autocomplete="off">
                            <label for="nik">NIK</label>
                        </div>
                        <div class="form-group" id="inputGroup">
                            <input type="text" required="" name="nama" autocomplete="off">
                            <label for="nama">Nama</label>
                        </div>
                        <div class="form-group" id="inputGroup">
                            <input type="text" required="" name="username" autocomplete="off">
                            <label for="username">Username</label>
                        </div>
                        <div class="form-group" id="inputGroup">
                            <input type="password" required="" name="password" autocomplete="off">
                            <label for="password">Password</label>
                        </div>
                        <div class="form-group" id="inputGroup">
                            <input type="number" required="" name="telp" autocomplete="off">
                            <label for="telp">Telp</label>
                        </div>
                        <button type="submit" class="btn btn-register">REGISTER</button>
                    </form>
                </div>
            </div>
            @if (Session::has('pesan'))
            <div class="alert alert-danger mt-2">
                {{ Session::get('pesan') }}
            </div>
            @endif
            <a href="{{ route('suarakita.index') }}" class="btn btn-back mt-3" style="width: 100%">Kembali ke Halaman Utama</a>
        </div>
    </div>
</div>

@endsection