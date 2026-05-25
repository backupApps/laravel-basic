<?php

namespace App\Http\Controllers;

use App\Models\Matakuliah;
use Illuminate\Http\Request;

class MatakuliahController extends Controller
{
    public function index()
    {
        $data = Matakuliah::query()->get();

        return view('matakuliah', compact('data'));
    }

    public function create()
    {
        return view('matakuliah-form');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'kode_matakuliah' => 'required',
            'nama_matakuliah' => 'required',
            'sks' => 'required',
        ]);

        Matakuliah::create($data);

        return back()->with('sukses', 'Matakuliah berhasil ditambah.');
    }

    public function edit($id)
    {
        $matakuliah = Matakuliah::query()->findOrFail($id);

        return view('matakuliah-edit', compact('matakuliah'));
    }

    public function update(Request $request, $id)
    {
        $matakuliah = Matakuliah::query()->findOrFail($id);

        $data = $request->validate([
            'kode_matakuliah' => 'required',
            'nama_matakuliah' => 'required',
            'sks' => 'required',
        ]);

        $matakuliah->update($data);

        return back()->with('sukses', 'Matakuliah berhasil diperbarui.');
    }

    public function delete($id)
    {
        Matakuliah::query()->findOrFail($id)->delete();

        return back()->with('sukses', 'Matakuliah berhasil dihapus.');
    }
}
