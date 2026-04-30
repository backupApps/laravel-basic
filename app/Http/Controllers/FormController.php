<?php

namespace App\Http\Controllers;

use App\Models\Mahasiswa;
use App\Models\Orangtua;
use Illuminate\Http\Request;

class FormController extends Controller
{
    // fungsi di dalam class disebut METHOD
    public function index()
    {
        return view('form');
    }

    public function simpan(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'nim' => 'required',
            'alamat' => 'required',
            'nama_ayah' => 'required',
            'nama_ibu' => 'required',
        ]);

        // simpan mahasiswa
        $mahasiswa = Mahasiswa::create([
            'nama' => $request->nama,
            'nim' => $request->nim,
            'alamat' => $request->alamat,
        ]);

        // simpan orangtua dari mahasiswa tersebut
        Orangtua::create([
            'mahasiswa_id' => $mahasiswa->id,
            'nama_ayah' => $request->nama_ayah,
            'nama_ibu' => $request->nama_ibu,
        ]);

        return redirect()->route('form')->with('sukses', 'Data mahasiswa berhasil ditambahkan.');
    }
}
