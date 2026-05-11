<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\FormController;
use App\Http\Controllers\TableController;
use Illuminate\Support\Facades\Route;

Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
// form simpan
Route::get('form', [FormController::class, 'index'])->name('form');
Route::post('form', [FormController::class, 'simpan'])->name('form.simpan');

// form edit
Route::get('/form-edit/{id}', [FormController::class, 'edit'])->name('form.edit');
Route::put('/form-update/{id}', [FormController::class, 'update'])->name('form.update');

// proses hapus
Route::delete('/form-hapus/{id}', [FormController::class, 'delete'])->name('form.delete');

// tabel
Route::get('tabel', [TableController::class, 'index'])->name('tabel');

// HTTP Method -> get (ambil data), post (simpan data), put (update data), delete (hapus data), patch (update sebagian data), option