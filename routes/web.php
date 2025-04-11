<?php

use App\Http\Controllers\BarangController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DivisiController;
use App\Http\Controllers\LayoutController;
use App\Http\Controllers\PerbaikanController;
use App\Http\Controllers\TiketingController;
use Illuminate\Support\Facades\Route;



Route::get('/', [PerbaikanController::class, 'index'])->name('form');
Route::post('/permintaan', [PerbaikanController::class, 'store'])->name('permintaan');



Route::get('/tiketing', [TiketingController::class, 'tiketing'])->name('tiketing');
Route::post('/lacak', [TiketingController::class, 'lacak'])->name('lacak');




Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
Route::get('/perbaikan', [PerbaikanController::class, 'dataperbaikan'])->name('perbaikan');
Route::put('/admin/perbaikan/{id}/status', [PerbaikanController::class, 'updateStatus'])->name('admin.updateStatus');
Route::delete('/perbaikan/{id}', [PerbaikanController::class, 'destroy'])->name('perbaikan.destroy');


Route::get('/barang', [BarangController::class, 'index'])->name('barang');
Route::get('/tambah', [BarangController::class, 'tambah'])->name('tambah');
Route::post('/tambahbarang', [BarangController::class, 'store'])->name('tambahbarang');
Route::get('/barang/{id}/edit', [BarangController::class, 'edit'])->name('editbarang');
Route::put('/barang/{id}/update', [BarangController::class, 'update'])->name('updatebarang');
Route::delete('/hapusbarang/{id}', [BarangController::class, 'destroy'])->name('hapusbarang');

Route::get('/formdivisi', [DivisiController::class, 'index'])->name('formdivisi');
Route::get('/divisi', [DivisiController::class, 'tambah'])->name('divisi');
Route::post('/tambahdivisi', [DivisiController::class, 'store'])->name('tambahdivisi');
Route::get('/divisi/{id}/edit', [DivisiController::class, 'edit'])->name('editdivisi');
Route::put('/divisi/{id}/update', [DivisiController::class, 'update'])->name('updatedivisi');
Route::delete('/hapusdivisi/{id}', [DivisiController::class, 'destroy'])->name('hapusdivisi');
