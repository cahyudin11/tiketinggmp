<?php

namespace App\Http\Controllers;

use App\Models\PeminjamanModel;
use App\Models\PerbaikanModel;
use App\Models\TiketingModel;
use Illuminate\Http\Request;

class TiketingController extends Controller
{

    public function tiketing()
    {

        $permintaan = TiketingModel::orderBy('id', 'desc')->get();
        return view('front.tiketing', compact('permintaan'));
    }
    public function lacak(Request $request)
    {
        $request->validate([
            'kode_tiket' => 'required|string',
        ]);

        $kode = $request->kode_tiket;

        $perbaikan = PerbaikanModel::where('kode_tiket', $kode)->first();
        $permintaan = tiketingModel::where('kode_tiket', $kode)->first();
        $peminjaman = PeminjamanModel::where('kode_tiket', $kode)->first(); // Tambahkan ini

        if ($perbaikan) {
            return view('front.tiketing', [
                'jenis' => 'perbaikan',
                'data' => $perbaikan,
            ]);
        }

        if ($permintaan) {
            return view('front.tiketing', [
                'jenis' => 'permintaan',
                'data' => $permintaan,
            ]);
        }

        if ($peminjaman) {
            return view('front.tiketing', [
                'jenis' => 'peminjaman', 
                'data' => $peminjaman,
            ]);
        }

        return back()->with('error', 'Kode tiket tidak ditemukan.');
    }
}
