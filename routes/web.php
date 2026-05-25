<?php

use App\Http\Controllers\BarangController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;

Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

Route::get('barang', [BarangController::class, 'index'])->name('barang');
Route::get('barang/create', [BarangController::class, 'create'])->name('barang.create');
