<?php

namespace App\Http\Controllers;

use App\Models\PerbaikanModel;
use Illuminate\Http\Request;

class TiketingController extends Controller
{

    public function tiketing()
    {


        return view('front.tiketing');
    }
    public function lacak(Request $request)
    {
        // Validasi input kode_tiket
        $request->validate([
            'kode_tiket' => 'required|string',
        ]);

        // Mencari data perbaikan berdasarkan kode_tiket
        $perbaikan = PerbaikanModel::where('kode_tiket', $request->kode_tiket)->first();

        // Jika tidak ditemukan, beri pesan error
        if (!$perbaikan) {
            return back()->with('error', 'Kode tiket tidak ditemukan.');
        }

        // Jika ditemukan, kirim data perbaikan ke view
        return view('front.tiketing', compact('perbaikan'));
    }
}
