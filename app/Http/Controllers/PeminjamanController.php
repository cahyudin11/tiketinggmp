<?php

namespace App\Http\Controllers;

use App\Models\PeminjamanModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PeminjamanController extends Controller
{
    public function datapeminjaman()
    {
        $peminjaman = PeminjamanModel::with(['barang', 'divisi','svp'])->get();
        return view('peminjaman.peminjaman', compact('peminjaman'));
    }
    public function updateStatus(Request $request, $id)
    {
        $peminjaman = PeminjamanModel::findOrFail($id);
        $peminjaman->status = $request->status;
        $peminjaman->save();


        $token = config('services.fonnte.token');


        $target = $peminjaman->kontak . '|a';

        $pesan = "📢 *Notifikasi Status Peminjaman*\n\n"
            . "Halo *{$peminjaman->nama}*,\n"
            . "Status peminjaman barang Anda telah diperbarui.\n"
            . "📦 Barang: {$peminjaman->barang->nama_barang}\n"
            . "🎫 Kode Tiket: {$peminjaman->kode_tiket}\n"
            . "📌 Status Baru: *" . ucfirst($peminjaman->status) . "*\n\n"
            . "Terima kasih telah menggunakan layanan kami.";


        $curl = curl_init();
        curl_setopt_array($curl, [
            CURLOPT_URL => 'https://api.fonnte.com/send',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_POST => true,
            CURLOPT_POSTFIELDS => [
                'target' => $target,
                'message' => $pesan,
            ],
            CURLOPT_HTTPHEADER => [
                "Authorization: $token"
            ],
        ]);
        $response = curl_exec($curl);
        curl_close($curl);

        return redirect()->back()->with('success', 'Status berhasil diperbarui dan notifikasi dikirim!');
    }
    public function destroy($id)
    {
        $peminjaman = PeminjamanModel::findOrFail($id);
        $peminjaman->delete();

        return redirect()->back()->with('error', 'Data berhasil dihapus.');
    }


    public function indexsvp()
    {

        $user = Auth::user();

        $peminjaman = PeminjamanModel::with(['barang', 'divisi'])
            ->where('svp_id', $user->id)
            ->get();

        return view('svp.peminjaman', compact('peminjaman'));
    }

    public function updateStatusSvp(Request $request, $id)
    {
        $peminjaman = PeminjamanModel::findOrFail($id);
        $peminjaman->status = $request->status;
        $peminjaman->save();


        $token = config('services.fonnte.token');


        $target = $peminjaman->kontak . '|a';

        $pesan = "📢 *Notifikasi Status Peminjaman*\n\n"
            . "Halo *{$peminjaman->nama}*,\n"
            . "Status peminjaman barang Anda telah diperbarui.\n"
            . "📦 Barang: {$peminjaman->barang->nama_barang}\n"
            . "🎫 Kode Tiket: {$peminjaman->kode_tiket}\n"
            . "📌 Status Baru: *" . ucfirst($peminjaman->status) . "*\n\n"
            . "Terima kasih telah menggunakan layanan kami.";


        $curl = curl_init();
        curl_setopt_array($curl, [
            CURLOPT_URL => 'https://api.fonnte.com/send',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_POST => true,
            CURLOPT_POSTFIELDS => [
                'target' => $target,
                'message' => $pesan,
            ],
            CURLOPT_HTTPHEADER => [
                "Authorization: $token"
            ],
        ]);
        $response = curl_exec($curl);
        curl_close($curl);

        return redirect()->back()->with('success', 'Status berhasil diperbarui dan notifikasi dikirim!');
    }
}
