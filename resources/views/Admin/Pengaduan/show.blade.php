@extends('Admin.layouts.admin')

@section('css')
    <Link rel="stylesheet" href="{{asset('admin/vendor/datatables/dataTables.bootstrap4.min.css')}}">

    <style>
        .text-primary:hover {
            text-decoration: underline;
        }
        .text-grey {
            color: #65c75d;
        }
        .text-grey:hover {
            color: #65c75d;
        }
    </style>
@endsection

@section('title', 'Detail Pengaduan')

@section('header')
    <a href="{{ route('pengaduan.index') }}">Data Pengaduan</a>
    <a href="#" class="text-grey">/</a>
    <a href="#" class="text-grey">Detail Pengaduan</a>
@endsection

@section('content') 
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-6 col-12">
            <div class="card shadow mb-4">
                <div class="card-header">
                    <div class="text-center">Pengaduan</div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <tbody>
                            <tr>
                                <td>NIK</td>
                                <td>:</td>
                                <td>{{ $pengaduan->nik }}</td>
                                </tr>
                            <tr>
                                <td>Tanggal Pengaduan</td>
                                <td>:</td>
                                <td>{{ $pengaduan->tgl_pengaduan }}</td>
                                </tr>
                                <tr>
                                <td>Foto</td>
                                <td>:</td>
                                <td><img src="{{ Storage::url($pengaduan->foto) }}" alt="Foto Pengaduan" class="embed-responsive"></td>
                                </tr>
                                <tr>
                                    <th>Isi Laporan</th>
                                    <td>:</td>
                                    <td>{{ $pengaduan->isi_laporan }}</td>
                                </tr>
                                <tr>
                                    <th>Status</th>
                                    <td>:</td>
                                    <td>
                                        @if ($pengaduan->status == '0') 
                                            <a href="#" class="badge badge-danger">Pending</a>
                                        @elseif($pengaduan->status == 'proses') 
                                            <a href="#" class="badge badge-warning text-white">Proses</a>
                                        @else
                                            <a href="#" class="badge badge-success text-white">Selesai</a>
                                        @endif
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-6 col-12">
            <div class="card shadow mb-4">
                <div class="card-header">
                    <div class="text-center">Tanggapan Petugas</div>
                </div>
                <div class="card-body">
                    <form action="{{ route('tanggapan.createOrUpdate', $pengaduan->id_pengaduan) }}" method="POST">
                        @csrf
                        <div class="form-group mb-3">
                            <label for="status">Status</label>
                            <div class="input-group mb3">
                                <select name="status" id="status" class="custom-select">
                                    @if($pengaduan->status == '0')
                                        <option selected value="#">Pending</option>
                                        <option value="proses">Proses</option>
                                        <option value="selesai">Selesai</option>
                                    @elseif($pengaduan->status == 'proses')
                                        <option value="proses">Proses</option>
                                        <option selected value="#">Pending</option>
                                        <option value="selesai">Selesai</option>
                                    @else
                                        <option value="proses">Proses</option>
                                        <option value="selesai">Selesai</option>
                                        <option selected value="#">Pending</option>
                                    @endif
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="tanggapan">Tanggapan</label>
                            <textarea name="tanggapan" id="tanggapan" rows="4" class="form-control" placeholder="Belum ada tangapan">{{ $tanggapan->tanggapan ?? ''}}</textarea>
                            <button type="submit" class="btn btn-purple" style="width:100%; background-color: #6a70fc; margin-top: 5px; color: white;">KIRIM</button>
                        </div>
                    </form>


                    @if(Session::has('status'))
                        <div class="alert alert-succcess mt-2">
                            {{ Session::get('status') }}
                        </div>
                    @endif
                </div>        
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