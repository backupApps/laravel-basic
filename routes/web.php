<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\FormController;
use App\Http\Controllers\TableController;
use Illuminate\Support\Facades\Route;

Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

Route::get('form', [FormController::class, 'index'])->name('form');
Route::post('form', [FormController::class, 'simpan'])->name('form.simpan');

Route::get('tabel', [TableController::class, 'index'])->name('tabel');

// HTTP Method -> get (ambil data), post (simpan data), put (update data), delete (hapus data), patch (update sebagian data), option