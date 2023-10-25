<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Petugas;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AdminController extends Controller
{
    public function index()
    {
        $user = Auth::guard('admin')->user();
        return view('admin.dashboard.index', compact('user'));
    }

    public function formLogin()
    {
        return view('admin.login');
    }

    public function loginRequest(Request $request)
    {
        $user = Petugas::where('username', $request->username)->first();
        if (!$user || !Hash::check($request->password, $user->password)) {
            return redirect()->back()->with(['pesan' => 'Username atau Password tidak sesuai']);
        }

        if (Auth::guard('admin')->attempt(['username' => $request->username, 'password' => $request->password])) {
            return redirect()->route('dashboard.index');
        } else {
            return redirect()->back()->with(['pesan' => 'Akun Tidak Terdaftar']);
        }
    }

    public function logout()
    {
        Auth::guard('admin')->logout();
        return redirect()->route('admin.formLogin');
    }
}
