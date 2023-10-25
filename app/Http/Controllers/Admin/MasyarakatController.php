<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Masyarakat;
use Illuminate\Http\Request;

class MasyarakatController extends Controller
{
    public function index()
    {
        $masyarakat = Masyarakat::all();
        return view('Admin.Masyarakat.index', ['masyarakat'=>$masyarakat]);
    }

    public function show($id)
    {
        $masyarakat = Masyarakat::where('id', $id)->first();
        return view('Admin.Masyarakat.show', ['masyarakat' => $masyarakat]);
    }
}
