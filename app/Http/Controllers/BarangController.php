<?php

namespace App\Http\Controllers;

use App\Models\BarangModel;
use Illuminate\Http\Request;

class BarangController extends Controller
{
    public function index()
    {
        $barang = BarangModel::all();
        return view('barang.barang',compact('barang'));
    }
    public function store()
    {
      return view('barang.tambah');
    }
}
