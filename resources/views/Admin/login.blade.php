<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css"
        integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">

    <link rel="stylesheet" href="{{ asset('css/register.css') }}">

    <title>Login Petugas</title>
</head>
<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-5">
                <h2 class="text-center text-white mb-0 mt-5">SUARA KITA</h2>
                <P class="text-center text-white mb-5">Platform Pengaduan Publik untuk Suara Keadilan</P>
                <div class="card mt-5">
                    <div class="card-body">
                        <h2 class="text-center text-white mb-5">FORM PETUGAS</h2>
                        <form action="{{ route('admin.login') }}" method="POST">
                            @csrf                            
                            <div class="form-group" id="inputGroup">
                                <input type="text" required="" name="username" autocomplete="off">
                                <label for="username">Username</label>
                            </div>
                            <div class="form-group" id="inputGroup">
                                <input type="password" required="" name="password" autocomplete="off">
                                <label for="password">Password</label>
                            </div>
                            <button type="submit" class="btn btn-login">MASUK</button>
                        </form>
                    </div>
                </div>
                @if (Session::has('pesan'))
                <div class="alert alert-danger mt-2">
                    {{ Session::get('pesan') }}
                </div>
                @endif
                <a href="{{ route('suarakita.index') }}" class="btn btn-warning text-white mt-3" style="width: 100%">Kembali ke Halaman Utama</a>
            </div>
        </div>
    </div>
</body>
</html>