<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\FormController;
use App\Http\Controllers\TableController;
use Illuminate\Support\Facades\Route;

Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
Route::get('form', [FormController::class, 'index'])->name('form');
Route::get('tabel', [TableController::class, 'index'])->name('tabel');
