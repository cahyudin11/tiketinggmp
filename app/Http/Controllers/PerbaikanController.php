<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\BarangModel;
use App\Models\DivisiModel;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\tiketingModel;
use App\Models\PerbaikanModel;
use App\Models\PeminjamanModel;
use Barryvdh\DomPDF\Facade\Pdf as FacadePdf;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Http;


class PerbaikanController extends Controller
{
    public function index()
    {
        $tiketing = tiketingModel::all();
        $barang = BarangModel::all();
        $divisi = DivisiModel::all();
        $users = User::whereIn('role', ['svp'])->get();
        session()->flash('show_dokumentasi', true);
        return view('front.pengajuan', compact('barang', 'divisi', 'tiketing', 'users'));
    }

    public function store(Request $request)
    {

        $kodeTiket = 'TKT-' . strtoupper(uniqid()) . '-' . Str::random(5);
        $jenis = $request->jenis_permintaan;


        if ($jenis === 'Perbaikan') {
            $request->validate([
                'tanggal' => 'required|date',
                'nama' => 'required|string',
                'divisi_id' => 'required|integer',
                'kontak' => 'required|string',
                'detail' => 'required|string',
            ]);

            $perbaikan = new PerbaikanModel();
            $perbaikan->tanggal = $request->tanggal;
            $perbaikan->nama = $request->nama;
            $perbaikan->divisi_id = $request->divisi_id;
            $perbaikan->kontak = $request->kontak;
            $perbaikan->detail = $request->detail;
            $perbaikan->kode_tiket = $kodeTiket;
            $perbaikan->status = 'menunggu antrian';

            if ($request->hasFile('photo')) {
                $perbaikan->photo = $request->file('photo')->store('permintaan_foto', 'public');
            }

            $perbaikan->save();
        } elseif ($jenis === 'Permintaan Barang') {
            $request->validate([
                'tanggal' => 'required|date',
                'nama' => 'required|string|max:255',
                'divisi_id' => 'required|integer|exists:divisi,id',
                'kontak' => 'required|string|max:255',
                'barang_id' => 'required|exists:barang,id',
                'quantity' => 'required|integer|min:1',
                'keterangan' => 'nullable|string|max:1000',
                'photo' => 'nullable|file|mimes:jpeg,png,jpg,gif',
            ]);


            $permintaan = new tiketingModel();
            $permintaan->tanggal = $request->tanggal;
            $permintaan->nama = $request->nama;
            $permintaan->divisi_id = $request->divisi_id;
            $permintaan->kontak = $request->kontak;
            $permintaan->barang_id = $request->barang_id;
            $permintaan->quantity = $request->quantity;
            $permintaan->keterangan = $request->keterangan;
            $permintaan->kode_tiket = $kodeTiket;
            $permintaan->status = 'sedang diajukan';

            if ($request->hasFile('photo')) {
                $permintaan->photo = $request->file('photo')->store('permintaan_foto', 'public');
            }

            $permintaan->save();
        } elseif ($jenis === 'Peminjaman') {
            $request->validate([
                'tanggal' => 'required|date',
                'nama' => 'required|string|max:255',
                'divisi_id' => 'required|integer|exists:divisi,id',
                'kontak' => 'required|string|max:255',
                'barang_id_peminjaman' => 'required|integer|exists:barang,id',
                'dari' => 'required|date|after_or_equal:today',
                'sampai' => 'required|date|after:dari',
                'photo' => 'nullable|file|mimes:jpeg,png,jpg,gif',
            ]);


            $svp = User::where('role', 'svp')->first();

            if (!$svp) {
                return redirect()->back()->with('error', 'SVP tidak ditemukan');
            }

            $peminjaman = new PeminjamanModel();
            $peminjaman->tanggal = $request->tanggal;
            $peminjaman->nama = $request->nama;
            $peminjaman->divisi_id = $request->divisi_id;
            $peminjaman->kontak = $request->kontak;
            $peminjaman->barang_id_peminjaman = $request->barang_id_peminjaman;
            $peminjaman->dari = $request->dari;
            $peminjaman->sampai = $request->sampai;
            $peminjaman->kode_tiket = $kodeTiket;
            $peminjaman->status = 'menunggu antrian';
            $peminjaman->svp_id = $svp->id;

            if ($request->hasFile('photo')) {
                $peminjaman->photo = $request->file('photo')->store('permintaan_foto', 'public');
            }

            $peminjaman->save();
        }

        $namaBarang = '';
        $status = '';

        if ($jenis === 'Permintaan Barang') {
            $barang = BarangModel::find($request->barang_id);
            $namaBarang = $barang ? $barang->nama_barang : '-';
            $status = 'sedang diajukan';
        } elseif ($jenis === 'Peminjaman') {
            $barang = BarangModel::find($request->barang_id_peminjaman);
            $namaBarang = $barang ? $barang->nama_barang : '-';
            $status = 'menunggu antrian';
        } elseif ($jenis === 'Perbaikan') {
            $status = 'menunggu antrian';
        }

        $token = config('services.fonnte.token');
        $target = $request->kontak . '|a';

        $pesan = "Halo {$request->nama},\n\n"
            . "Pengajuan *{$jenis}* Anda telah diterima.\n"
            . "📅 Tanggal: {$request->tanggal}\n";

        if ($jenis === 'Permintaan Barang' || $jenis === 'Peminjaman') {
            $pesan .= "📦 Barang: {$namaBarang}\n";
        }

        if ($jenis === 'Permintaan Barang') {
            $pesan .= "🔢 Jumlah: {$request->quantity}\n";
        }

        if ($jenis === 'Peminjaman') {
            $pesan .= "📅 Dari: {$request->dari}\n"
                . "📅 Sampai: {$request->sampai}\n";
        }

        $pesan .= "🎫 Kode Tiket: *{$kodeTiket}*\n"
            . "📌 Status: {$status}\n\n"
            . "Tim kami akan segera menindaklanjuti.";


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
        curl_exec($curl);
        curl_close($curl);

        return redirect()->back()->with('success', $kodeTiket);
    }

    public function dataperbaikan()
    {
        $perbaikan = PerbaikanModel::orderBy('id', 'desc')->get();
        return view('perbaikan.perbaikan', compact('perbaikan'));
    }

    public function updateStatus(Request $request, $id)
    {
        $perbaikan = PerbaikanModel::findOrFail($id);
        $perbaikan->status = $request->status;
        $perbaikan->save();

        $token = config('services.fonnte.token');

        $target = $perbaikan->kontak . '|a';

        $pesan = "📢 *Notifikasi Status Perbaikan*\n\n"
            . "Halo *{$perbaikan->nama}*,\n"
            . "Status Perbaikan barang Anda telah diperbarui.\n"
            . "🎫 Kode Tiket: {$perbaikan->kode_tiket}\n"
            . "📌 Status Baru: *" . ucfirst($perbaikan->status) . "*\n\n"
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
        $perbaikan = PerbaikanModel::findOrFail($id);
        $perbaikan->delete();

        return redirect()->back()->with('error', 'Data berhasil dihapus.');
    }
    public function exportPdf(Request $request)
    {

        $data = json_decode($request->data, true);
        $pdf = FacadePdf::loadView('perbaikan.export', compact('data'));
        return $pdf->download('perbaikan.pdf');
    }
}
