<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Masyarakat;
use App\Models\Pengaduan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function index()
    {
        return view('user.landing');
    }

    public function login(Request $request)
    {
        $username = Masyarakat::where('username', $request->username)->first();
        if(!$username) {
            return redirect()->back()->with(['pesan'=>'Username Tidak Terdaftar']);
        }

        $password = Hash::check($request->password, $username->password);
        if (!$password) {
            return redirect()->back()->with(['pesan' => 'Password tidak sesuai']);
        }

        if (Auth::guard('masyarakat')->attempt(['username' => $request->username, 'password' => $request->password])) {
            return redirect()->back();
        } else {
            return redirect()->back()->with(['pesan' => 'Akun Tidak Terdaftar']);
        }        
    }

    public function formRegister()
    {
        return view('user.register');
    }

    public function register(Request $request)
    {
        $data = $request->all();
        $validator = validator::make($data, [
            'nik'=>'required',
            'nama'=>'required',
            'username'=>'required',
            'password'=>'required',
            'telp'=>'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->with(['pesan'=>$validator->errors()]);
        }
        
        $username = Masyarakat::where('username', $request->username)->first();
        
        if ($username) {
            return redirect()->back()->with(['pesan'=>'Username Sudah Terdaftar']);
        }
        
        Masyarakat::create([
            'nik'=>$data['nik'],
            'nama'=>$data['nama'],
            'username'=>$data['username'],
            'password'=>Hash::make($data['password']),
            'telp'=>$data['telp'],
        ]);

        return redirect()->route('suarakita.index');
    }

    public function logout()
    {
        Auth::guard('masyarakat')->logout();
        return redirect()->route('suarakita.index');
    }
    
    public function storePengaduan(Request $request) 
    {
        if (!Auth::guard('masyarakat')->user()) {
            return redirect()->back()->with(['pesan'=>'Kamu Harus Login Dulu!'])->withInput();
        }

        $data = $request->all();

        $validator = validator::make($data, [
            'isi_laporan' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withInput()->withErrors($validator);
        }

        if ($request->file('foto')) {
            $data['foto'] = $request->file('foto')->store('assets/pengaduan', 'public');
        }
        
        date_default_timezone_set('Asia/Bangkok');

        $pengaduan = Pengaduan::create([
            'tgl_pengaduan' => date('Y-m-d h:i:s'),
            'nik' => Auth::guard('masyarakat')->user()->nik,
            'isi_laporan' => $data['isi_laporan'],
            'foto' => $data['foto'] ?? '',
            'status' => '0',
        ]);

        if ($pengaduan) {
            return redirect()->route('suarakita.laporan', 'me')->with(['pengaduan'=>'Berhasil Dikirim!', 'type'=>'success']);
        } else {
            return redirect()->back()->with(['pengaduan' => 'Gagal Dikirim', 'type'=>'danger']);
        }
    }

    public function laporan($siapa = '')
    {
        $terverivikasi = Pengaduan::where([['nik', Auth::guard('masyarakat')->user()->nik], ['status', '!=', '0']])->get()->count();
        $proses = Pengaduan::where([['nik', Auth::guard('masyarakat')->user()->nik], ['status', 'proses']])->get()->count();
        $selesai = Pengaduan::where([['nik', Auth::guard('masyarakat')->user()->nik], ['status', 'selesai']])->get()->count();
    
        $hitung = [$terverivikasi, $proses, $selesai];
        
        if ($siapa == 'me') {
            $pengaduan = Pengaduan::where('nik', Auth::guard('masyarakat')->user()->nik)->orderBy('tgl_pengaduan', 'desc')->get();

            return view('user.laporan', ['pengaduan' => $pengaduan, 'hitung' => $hitung, 'siapa' => $siapa]);
        } else {
            $pengaduan = Pengaduan::where([['nik', '!=', Auth::guard('masyarakat')->user()->nik], ['status', '!=', '0']])->orderBy('tgl_pengaduan', 'desc')->get();

            return view('user.laporan', ['pengaduan' => $pengaduan, 'hitung' => $hitung, 'siapa' => $siapa]);
        }
    }
}

