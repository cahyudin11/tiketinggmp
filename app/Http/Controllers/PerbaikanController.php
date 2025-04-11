<?php

namespace App\Http\Controllers;

use App\Models\BarangModel;
use App\Models\DivisiModel;
use App\Models\PerbaikanModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;

class PerbaikanController extends Controller
{
    public function index()
    {
        $barang = BarangModel::all();
        $divisi = DivisiModel::all();
        return view('front.pengajuan', compact('barang', 'divisi'));
    }

    public function store(Request $request)
    {
        $kodeTiket = 'TKT-' . strtoupper(uniqid()) . '-' . Str::random(5);
        $perbaikan = new PerbaikanModel();

        $perbaikan->tanggal = $request->tanggal;
        $perbaikan->nama = $request->nama;
        $perbaikan->divisi_id = $request->divisi_id;
        $perbaikan->kontak = $request->kontak;
        $perbaikan->detail = $request->detail;
        $perbaikan->kode_tiket = $kodeTiket;
        $perbaikan->status = 'menunggu antrian';



        if ($request->hasFile('photo')) {
            $fotoPath = $request->file('photo')->store('permintaan_foto', 'public');
            $perbaikan->photo = $fotoPath;
        }

        $perbaikan->save();

        return redirect()->back()->with('success', $kodeTiket);
    }

    public function dataperbaikan()
    {
        $perbaikan = PerbaikanModel::all();
        return view('admin.perbaikan', compact('perbaikan'));
    }

    public function updateStatus(Request $request, $id)
    {
        $perbaikan = PerbaikanModel::findOrFail($id);
        $perbaikan->status = $request->status;
        $perbaikan->save();

        return redirect()->back()->with('success', 'Status berhasil diperbarui!');
    }
    public function destroy($id)
    {
        $perbaikan = PerbaikanModel::findOrFail($id);
        $perbaikan->delete();
    
        return redirect()->back()->with('success', 'Data berhasil dihapus.');
    }
}
