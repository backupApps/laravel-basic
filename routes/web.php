<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\FormController;
use App\Http\Controllers\TableController;
use Illuminate\Support\Facades\Route;

Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
// form simpan
Route::get('form', [FormController::class, 'halamanForm'])->name('form');
Route::post('form', [FormController::class, 'simpanData'])->name('form.simpan');

// form edit
Route::get('/form-edit/{id}', [FormController::class, 'halamanEdit'])->name('form.edit');
Route::put('/form-update/{id}', [FormController::class, 'prosesEdit'])->name('form.update');

// proses hapus
Route::delete('/form-hapus/{id}', [FormController::class, 'hapusData'])->name('form.delete');

// tabel
Route::get('tabel', [TableController::class, 'index'])->name('tabel');

// HTTP Method -> get (ambil data), post (simpan data), put (update data), delete (hapus data), patch (update sebagian data), option