<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\MahasiswaController;
use App\Http\Controllers\PeminjamanController;
use Illuminate\Support\Facades\Route;

Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

Route::resource('barang', BarangController::class)
    ->except('show')
    ->names([
        'index' => 'barang',
    ]);

Route::resource('mahasiswa', MahasiswaController::class)
    ->except('show')
    ->names([
        'index' => 'mahasiswa',
    ]);

Route::resource('admin', AdminController::class)
    ->except('show')
    ->names([
        'index' => 'admin',
    ]);

Route::resource('peminjaman', PeminjamanController::class)
    ->except('show')
    ->names([
        'index' => 'peminjaman',
    ]);

Route::get('laporan', [LaporanController::class, 'index'])->name('laporan');
