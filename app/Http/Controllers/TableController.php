<?php

namespace App\Http\Controllers;

use App\Models\Mahasiswa;
use Illuminate\Http\Request;

class TableController extends Controller
{
    public function index()
    {
        $mahasiswa = Mahasiswa::with('orangtua')->get();

        return view('tabel', compact('mahasiswa'));
    }
}
