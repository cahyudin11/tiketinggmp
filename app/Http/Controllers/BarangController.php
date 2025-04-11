<?php

namespace App\Http\Controllers;

use App\Models\BarangModel;
use Illuminate\Http\Request;

class BarangController extends Controller
{
    public function index()
    {
        $barang = BarangModel::all();
        return view('barang.barang', compact('barang'));
    }
    public function tambah()
    {
        return view('barang.tambah');
    }
    public function store(Request $request)
    {
        $barang = new BarangModel();
        $barang->nama_barang = $request->nama_barang;
        $barang->save();

        return redirect()->route('barang')->with('success', 'Barang berhasil disimpan!');
    }
    public function edit($id)
    {
        $barang = BarangModel::findOrFail($id);
        return view('barang.edit', compact('barang'));
    }
    public function update(Request $request, $id)
    {
        $barang = BarangModel::findOrFail($id);
        $barang->nama_barang = $request->nama_barang;
        $barang->save();

        return redirect()->route('barang')->with('success', 'Data barang berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $barang = BarangModel::findOrFail($id);
        $barang->delete();

        return redirect()->back()->with('error', 'Data berhasil dihapus.');
    }
}
