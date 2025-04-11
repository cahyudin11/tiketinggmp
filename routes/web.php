<?php

use App\Http\Controllers\BarangController;
use App\Http\Controllers\DashboardController;
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
Route::get('/tambahbarang', [BarangController::class, 'store'])->name('tambahbarang');