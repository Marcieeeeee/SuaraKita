@extends('Admin.layouts.admin')

@section('title', 'Halaman Dashboard')

@section('header', 'Dashboard')

@section('content') 
    <div class="row">
        <div class="col-lg-3">
            <div class="card">
                <div class="card-header">
                    <a href="/admin/petugas">
                        <span>Petugas</span>
                    </a>
                </div>
                <div class="card-body">
                <div class="text-center">
                    10
                </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3">
            <div class="card">
                <div class="card-header">Masyarakat</div>
                <div class="card-body">
                    <div class="text-center">
                        10
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3">
            <div class="card">
                <div class="card-header">Pengaduan Proses</div>
                <div class="card-body">
                    <div class="text-center">
                        10
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3">
            <div class="card">
                <div class="card-header">Pengaduan Selesai</div>
                <div class="card-body">
                    <div class="text-center">
                        10
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
