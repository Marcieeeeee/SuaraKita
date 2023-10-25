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

@section('title', 'Detail Masyarakat')

@section('header')
    <a href="{{ route('masyarakat.show', $masyarakat->id) }}">Data Masyarkat</a>
    <a href="#" class="text-grey">/</a>
    <a href="#" class="text-grey">Detail Masyarakat</a>
@endsection

@section('content') 
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-6 col-12">
            <div class="card shadow mb-4">
                <div class="card-header">
                    <div class="text-center">Detail Masyarakat</div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <tbody>
                                <tr>
                                    <td>NIK</td>
                                    <td>:</td>
                                    <td>{{ $masyarakat->nik }}</td>
                                </tr>
                                <tr>
                                    <td>Nama</td>
                                    <td>:</td>
                                    <td>{{ $masyarakat->nama }}</td>
                                </tr>
                                <tr>
                                    <td>Username</td>
                                    <td>:</td>
                                    <td>{{ $masyarakat->username }}</td>
                                </tr>
                                <tr>
                                    <th>No Telp</th>
                                    <td>:</td>
                                    <td>{{ $masyarakat->telp }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
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