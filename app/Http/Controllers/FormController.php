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

    public function edit($id)
    {
        $mahasiswa = Mahasiswa::with('orangtua')->findOrFail($id);

        return view('form-edit', compact('mahasiswa'));
    }

    public function update(Request $request, $id)
    {
        $mahasiswa = Mahasiswa::findOrFail($id);

        $request->validate([
            'nama' => 'required',
            'nim' => 'required',
            'alamat' => 'required',
            'nama_ayah' => 'required',
            'nama_ibu' => 'required',
        ]);

        $mahasiswa->update([
            'nama' => $request->nama,
            'nim' => $request->nim,
            'alamat' => $request->alamat,
        ]);

        Orangtua::where('mahasiswa_id', $mahasiswa->id)->update([
            'nama_ayah' => $request->nama_ayah,
            'nama_ibu' => $request->nama_ibu
        ]);

        return back()->with('sukses', 'Data mahasiswa berhasil diperbarui.');
    }

    public function delete($id)
    {
        Mahasiswa::find($id)->delete();

        return back()->with('sukses', 'Data mahasiswa berhasil dihapus.');
    }
}
