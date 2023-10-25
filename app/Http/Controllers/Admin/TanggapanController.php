<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Tanggapan;
use App\Models\Pengaduan;
use App\Models\Petugas;
use Illuminate\Http\Request;

class TanggapanController extends Controller
{
    public function createOrUpdate(Request $request, $id_pengaduan)
    {
        //$pengaduan = Pengaduan::findOrFail($request->id_pengaduan);
        $pengaduan = Pengaduan::findOrFail('id_pengaduan', $request->id_pengaduan)->first();
        $tanggapan = Tanggapan::findOrFail('id_pengaduan', $request->id_pengaduan)->first();

        if ($tanggapan) {
            $pengaduan->update(['status'=>$request->status]);
            $tanggapan->update([
                'tgl_tanggapan'=> date('Y-m-d'),
                'tanggapan'=>$request->tanggapan,
                'id_petugas'=>Auth::guard('admin')-user()->id_petugas,
            ]);

            return redirect()->route('pengaduan.show', ['pengaduan'=>$pengaduan, 'tanggapan'=>$tanggapan]);
        } else {
            $pengaduan->update(['status' => $request->status]); 
            $tanggapan = Tanggapan::create([
                'id_pengaduan' => $request->id_pengaduan,
                'tgl_tanggapan' => date('Y-m-d'),
                'tanggapan' => $request->tanggapan,
                'id_petugas' => Auth::guard('admin')->user()->id_petugas,
            ]);  
            return redirect()->route('pengaduan.show', ['id_pengaduan' => $pengaduan->id_pengaduan, 'tanggapan' => $tanggapan])->with(['status' => 'Berhasil dikirim']);
        }
    } 
}