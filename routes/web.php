<?php

use App\Http\Controllers\AdminAuthController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\PesananController;
use App\Http\Controllers\PenjualanController;
use App\Http\Controllers\JurnalTransaksiController;
use App\Http\Controllers\DashboardController;

// Rute untuk halaman login (menjadi halaman utama)
Route::get('/', [AdminAuthController::class, 'index'])->name('home');

// Rute untuk dashboard (hanya dapat diakses setelah login)
Route::get('/dashboard', function () {
    return view('dashboard.index');
})->middleware('auth')->name('dashboard.index');

Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard.index');

// Rute untuk login
Route::get('/login', [AdminAuthController::class, 'index'])->name('login');
Route::post('/login', [AdminAuthController::class, 'login'])->name('login.post');

// Rute resource untuk barang
Route::resource('barang', BarangController::class);

// Rute resource untuk pesanan dengan tambahan route khusus void
Route::resource('pesanan', PesananController::class);
Route::post('pesanan/{pesanan}/void', [PesananController::class, 'void'])->name('pesanan.void');

// Rute resource untuk penjualan
Route::resource('penjualan', PenjualanController::class);

// Rute resource untuk jurnal transaksi
Route::resource('jurnal', JurnalTransaksiController::class);
