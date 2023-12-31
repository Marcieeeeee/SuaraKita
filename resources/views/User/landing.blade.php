@extends('layouts.user')

@section('css')
<link rel="stylesheet" href="{{ asset('css/landing.css') }}">
@endsection

@section('title', 'Suara Kita')

@section('content')
{{-- Section Header --}}
<section class="header">
    <nav class="navbar navbar-expand-lg navbar-light bg-transparent">
        <div class="container">
            <div class="container-fluid">
                <a class="navbar-brand" href="#">
                    <h4 class="semi-bold mb-0 text-white">SUARA KITA</h4>
                    <p class="italic mt-0 text-white">Platform Pengaduan Publik untuk Suara Keadilan</p>
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    @if(Auth::guard('masyarakat')->check())
                    <ul class="navbar-nav text-center ml-auto">
                        <li class="nav-item">
                            <a class="nav-link ml-3 text-white" href="{{ route('suarakita.laporan') }}">Laporan</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link ml-3 text-white" href="{{ route('suarakita.logout') }}"
                                style="text-decoration: underline">{{ Auth::guard('masyarakat')->user()->nama }}</a>
                        </li>
                    </ul>
                    @else
                    <ul class="navbar-nav text-center ml-auto">
                        <li class="nav-item">
                            <button class="btn text-white" type="button" class="btn btn-primary" data-toggle="modal"
                                data-target="#loginModal">Masuk</button>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('suarakita.formRegister') }}" class="btn btn-outline-purple">Daftar</a>
                        </li>
                    </ul>
                    @endauth
                </div>
            </div>
        </div>
    </nav>

    <div class="text-center">
        <h2 class="medium text-white mt-3">Kami Mendengarkan, Kami Mengambil Tindakan</h2>
        <p class="italic text-white mb-5">Laporkan Keluhanmu untuk Membangun Masyarakat Yang Lebih Responsif</p>
    </div>
</section>


{{-- Section Pengaduan --}}

<div class="row justify-content-center">
    <div class="col-lg-6 col-10 col">
        <div class="content shadow">
            @if ($errors->any())
                @foreach ($errors->all() as $error)
                    <div class="alert alert-danger">{{ $error }}</div>
                @endforeach
            @endif

            @if (Session::has('pengaduan'))
                <div class="alert alert-{{ Session::get('type') }}">{{ Session::get('pengaduan') }}</div>
            @endif

            <div class="card mb-3">Tulis Laporanmu Dibawah Sini</div>
            <form action="{{ route('suarakita.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <textarea name="isi_laporan" placeholder="Apa yang ingin kamu laporkan?" class="form-control"
                        rows="4">{{ old('isi_laporan') }}</textarea>
                </div>
                <div class="form-group">
                    <input type="file" name="foto" class="form-control">
                </div>
                <button type="submit" class="btn btn-custom mt-2">Kirim</button>
            </form>
        </div>
    </div>
</div>

{{-- Footer --}}
<div class="mt-5">
    <hr>
    <div class="text-center">
        <p class="italic text-white">© 2023 SuaraKita • All rights reserved</p>
    </div>
</div>

{{-- Modal --}}
<div class="modal fade" id="loginModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body">
                <div>
                    <h3 class="mt-3">Masuk Dulu Yuk!</h3>
                    <p>Silahkan masuk dengan akun yang sudah kamu daftarkan.
                        Atau masuk sebagai admin<a href="{{route('admin.formLogin')}}"> disini</a>
                    </p>
                    <form action="{{route('suarakita.login')}}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="username">Username</label>
                            <input type="text" name="username" id="username" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" name="password" id="password" class="form-control">
                        </div>
                        <button type="submit" class="btn btn-purple text-white mt-3" style="width: 100%">Masuk</button>
                    </form>
                    @if (Session::has('pesan'))
                    <div class="alert alert-danger mt-2">
                        {{ Session::get('pesan') }}
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')
    @if (Session::has('pesan'))
    <script>
        $('#loginModal').modal('show');

    </script>
    @endif
@endsection