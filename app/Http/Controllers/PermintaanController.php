<?php

namespace App\Http\Controllers;

use App\Models\BarangModel;
use App\Models\DivisiModel;
use App\Models\tiketingModel;
use Illuminate\Http\Request;

class PermintaanController extends Controller
{
    public function datapermintaan()
    {
        $permintaan = tiketingModel::with(['barang', 'divisi'])->get();
        return view('permintaan.permintaan', compact('permintaan'));
    }
    public function updateStatus(Request $request, $id)
    {
        $permintaan = tiketingModel::findOrFail($id);
        $permintaan->status = $request->status;
        $permintaan->save();


        $token = config('services.fonnte.token');


        $target = $permintaan->kontak . '|a';

        $pesan = "📢 *Notifikasi Status Permintaan*\n\n"
            . "Halo *{$permintaan->nama}*,\n"
            . "Status peminjaman barang Anda telah diperbarui.\n"
            . "📦 Barang: {$permintaan->barang->nama_barang}\n"
            . "🎫 Kode Tiket: {$permintaan->kode_tiket}\n"
            . "📌 Status Baru: *" . ucfirst($permintaan->status) . "*\n\n"
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
        $permintaan = tiketingModel::findOrFail($id);
        $permintaan->delete();

        return redirect()->back()->with('error', 'Data berhasil dihapus.');
    }
}
