<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () { // akses url di browser
    return view('dashboard'); // akses file dashboard.blade.php
})->name('dashboard'); // digunakan di leftbar

Route::get('/tabel', function () { // akses url di browser
    return view('tabel'); // akses file tabel.blade.php
})->name('tabel'); // digunakan di leftbar

Route::get('/form', function () {
    return view('form');
})->name('form');

// buat file -> atur @extends() @section -> copas kode template -> atur route -> tambah di menu