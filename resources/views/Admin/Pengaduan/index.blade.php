@extends('Admin.layouts.admin')

@section('css')
    <Link rel="stylesheet" href="{{asset('admin/vendor/datatables/dataTables.bootstrap4.min.css')}}">
@endsection

@section('title', 'Halaman Pengaduan')

@section('header', 'Data Pengaduan')

@section('content') 
<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Tanggal</th>
                            <th>Isi Laporan</th>
                            <th>Status</th>
                            <th>Detail</th>
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
                            <td><a href="{{ route('pengaduan.show', $v->id_pengaduan) }}">Lihat</a></td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')
    <script src="https://cdn.datatables.net/1.10.23/js/jquery.dataTables.min.js"></script>
    <script>
        $(document).ready(function() {
            $('example').DataTable();
        });
    </script>
@endsection