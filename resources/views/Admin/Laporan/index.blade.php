@extends('Admin.layouts.admin')

@section('title', 'Halaman Laporan')

@section('header', 'Laporan')

@section('content') 
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-6 col-12">
            <div class="card shadow mb-4">
                <div class="card-header">
                    <div class="text-center">Cari Berdasarkan Tanggal</div>
                </div>
                <div class="card-body">
                    <form action="{{ route('laporan.getLaporan') }}" method="post">
                        @csrf
                        @method('PATCH')
                        <div class="form-group">
                            <input type="text" name="from" class="form-control" placeholder="Tanggal Awal" onfocusin="(this.type='date')" onfocusout="(this.type='text')">
                        </div>
                        <div class="form-group">
                            <input type="text" name="to" class="form-control" placeholder="Tanggal akhir" onfocusin="(this.type='date')" onfocusout="(this.type='text')">
                        </div>
                        <button type="submit" class="btn btn-primary text-white" style="width: 100%">Cari Laporan</button>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-lg-6 col-12">
            <div class="card shadow mb-4">
                <div class="card-header">
                    <div class="text-center">Data Berdasarkan Tanggal</div>
                    <div class="float-right">
                        @if(isset($pengaduan))
                            <a href="{{ route('laporan.cetakLaporan', ['from' => $from, 'to' => $to])}}" class="btn btn-primary">Unduh Laporan</a>
                        @endif

                    </div>
                </div>
                <div class="card-body">
                    @if(isset($pengaduan))
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Tanggal</th>
                                    <th>Isi Laporan</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($pengaduan as $k => $v)
                                <tr>
                                    <td>{{ $k += 1 }}</td>
                                    <td>{{ \Carbon\Carbon::parse($v->tgl_pengaduan)->format('d-m-Y') }}</td>
                                    <td>{{ $v->isi_laporan }}</td>
                                    <td>
                                        @if ($v->status == '0') 
                                            <a href="#" class="badge badge-danger">Pending</a>
                                        @elseif($v->status == 'proses') 
                                            <a href="#" class="badge badge-warning text-white">Proses</a>
                                        @else
                                            <a href="#" class="badge badge-success text-white">Selesai</a>
                                        @endif
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @else
                        <div class="text-center">Data Tidak Ada</div>
                    @endif
                </div>        
            </div>
        </div>

    </div>
</div>
@endsection