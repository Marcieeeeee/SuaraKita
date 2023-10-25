<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Pengaduan Masyarakat</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css"
        integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">

</head>
<body>
    <div class="text-center">
        <h5>Pengaduan Masyarakat</h5>
        <h6>Marcieeeeee.github.io</h6>
    </div>
    <div class="container">
        <table class="table">
            <thead>
                <tr>
                    <th>NO</th>
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
                        <td>{{$v->status == '0' ? 'pending' : ucwords($v->status)}}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>
</html>