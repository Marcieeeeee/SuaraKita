<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Pengaduan;
use PDF;
use Illuminate\Http\Request;

class LaporanController extends Controller
{
    public function index()
    {
        return view('Admin.Laporan.index');
    }

    public function getLaporan(Request $request)
    {
        //dd($pengaduan);
        $to = $request->to . ' ' . '23:59:59';
        $from = $request->from . ' ' . '00:00:00';
        $pengaduan = Pengaduan::whereBetween('tgl_pengaduan', [$from, $to])->get();
        return view('Admin.Laporan.index', ['pengaduan' => $pengaduan, 'from' => $from, 'to' => $to]);
    }



    public function cetakLaporan($from, $to)
    {
        $pengaduan = Pengaduan::whereBetween('tgl_pengaduan', [$from, $to])->get();
        $pdf = PDF::loadview('Admin.Laporan.cetak', ['pengaduan'=>$pengaduan, 'from'=>$from, 'to'=>$to]);
        return $pdf->download('laporan-pengaduan.pdf');
    }

}
