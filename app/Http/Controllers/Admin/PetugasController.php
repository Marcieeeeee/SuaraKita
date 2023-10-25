<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Petugas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class PetugasController extends Controller
{
    public function index()
    {
        $petugas = Petugas::all();
        return view('admin.petugas.index', ['petugas'=>$petugas]);
    }

    public function tambah()
    {
        return view('admin.petugas.create');
    }

    public function register(Request $request)
    {
        $data = $request->all();
        $validator = validator::make($data, [
            'nama_petugas'=>'required|string|max:255',
            'username'=>'required|string|unique:petugas',
            'password'=>'required|string|min:6',
            'telp'=>'required',
            'level'=>'required|in:admin,petugas',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator);
        }
        
        $username = Petugas::where('username', $data['username'])->first();
        
        if ($username) {
            return redirect()->back()->with(['username'=>'Username Sudah Terdaftar']);
        }
        
        Petugas::create([
            'nama_petugas'=>$data['nama_petugas'],
            'username'=>$data['username'],
            'password'=>Hash::make($data['password']),
            'telp'=>$data['telp'],
            'level'=>$data['level'],
        ]);

        return redirect()->route('petugas.index');

    }

    public function edit($id_petugas)
    {
        $petugas = Petugas::where('id_petugas', $id_petugas)->first();
        return view('admin.petugas.edit', ['petugas'=>$petugas]);
    }

    public function update(Request $request, $id_petugas)
    {
        $data = $request->all();

        $petugas = Petugas::find($id_petugas);
        $petugas->update([
            'nama_petugas' => $data['nama_petugas'],
            'username'=> $data['username'],
            'password'=> Hash::make($data['password']),
            'telp'=> $data['telp'],
            'level'=> $data['level'],
        ]);
        return redirect()->route('petugas.index');
    }

    public function destroy($id_petugas)
    {
        $petugas = Petugas::where('id_petugas', $id_petugas)->delete();
        return redirect()->route('petugas.index');
    }
}
