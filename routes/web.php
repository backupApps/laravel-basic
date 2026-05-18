<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\FormController;
use App\Http\Controllers\MahasiswaMatakuliahController;
use App\Http\Controllers\MatakuliahController;
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

Route::get('matakuliah', [MatakuliahController::class, 'index'])->name('matakuliah');
Route::get('matakuliah/form', [MatakuliahController::class, 'create'])->name('matakuliah.create');
Route::get('matakuliah/edit/{id}', [MatakuliahController::class, 'edit'])->name('matakuliah.edit');
Route::post('matakuliah', [MatakuliahController::class, 'store'])->name('matakuliah.store');
Route::put('matakuliah/{id}', [MatakuliahController::class, 'update'])->name('matakuliah.update');
Route::delete('matakuliah/{id}', [MatakuliahController::class, 'delete'])->name('matakuliah.delete');

Route::get('mahasiswa-matakuliah', [MahasiswaMatakuliahController::class, 'index'])->name('mahasiswa.matakuliah');
Route::get('mahasiswa-matakuliah/form', [MahasiswaMatakuliahController::class, 'create'])->name('mahasiswa.matakuliah.create');
Route::get('mahasiswa-matakuliah/edit/{id}', [MahasiswaMatakuliahController::class, 'edit'])->name('mahasiswa.matakuliah.edit');
Route::post('mahasiswa-matakuliah', [MahasiswaMatakuliahController::class, 'store'])->name('mahasiswa.matakuliah.store');
Route::put('mahasiswa-matakuliah/{id}', [MahasiswaMatakuliahController::class, 'update'])->name('mahasiswa.matakuliah.update');
Route::delete('mahasiswa-matakuliah/{id}', [MahasiswaMatakuliahController::class, 'delete'])->name('mahasiswa.matakuliah.delete');
