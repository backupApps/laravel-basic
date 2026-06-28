<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\MahasiswaController;
use App\Http\Controllers\PeminjamanController;
use Illuminate\Support\Facades\Route;

Route::get('login', [AuthController::class, 'showLogin'])->name('login');
Route::post('login', [AuthController::class, 'login'])->name('login.store');
Route::get('register', [AuthController::class, 'showRegister'])->name('register');
Route::post('register', [AuthController::class, 'register'])->name('register.store');

Route::post('logout', [AuthController::class, 'logout'])
    ->middleware('auth.session')
    ->name('logout');

Route::middleware('auth.session')->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

    Route::resource('peminjaman', PeminjamanController::class)
        ->except('show')
        ->names([
            'index' => 'peminjaman',
        ]);

    Route::get('laporan', [LaporanController::class, 'index'])->name('laporan');

    Route::middleware('role:admin')->group(function () {
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
    });
});
