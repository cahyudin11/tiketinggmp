<?php

namespace App\Http\Controllers;

use App\Models\DivisiModel;
use Illuminate\Http\Request;

class DivisiController extends Controller
{
    public function index()
    {
        $divisi = DivisiModel::all();
        return view('divisi.divisi', compact('divisi'));
    }
    public function tambah()
    {
        return view('divisi.tambah');
    }
    public function store(Request $request)
    {
        $divisi = new DivisiModel();
        $divisi->nama_divisi = $request->nama_divisi;
        $divisi->save();

        return redirect()->route('formdivisi')->with('success', 'Barang berhasil disimpan!');
    }
    public function edit($id)
    {
        $divisi = DivisiModel::findOrFail($id);
        return view('divisi.edit', compact('divisi'));
    }
    public function update(Request $request, $id)
    {
        $divisi = DivisiModel::findOrFail($id);
        $divisi->nama_divisi = $request->nama_divisi;
        $divisi->save();

        return redirect()->route('formdivisi')->with('success', 'Data barang berhasil diperbarui.');
    }
    public function destroy($id)
    {
        $divisi = DivisiModel::findOrFail($id);
        $divisi->delete();

        return redirect()->back()->with('error', 'Data berhasil dihapus.');
    }
}
