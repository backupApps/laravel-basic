<?php

namespace App\Http\Controllers;

use App\Models\Mahasiswa;
use App\Models\MahasiswaMatakuliah;
use App\Models\Matakuliah;
use Illuminate\Http\Request;

class MahasiswaMatakuliahController extends Controller
{
    public function index()
    {
        $data = MahasiswaMatakuliah::query()->with(['mahasiswa', 'matakuliahs'])->get();

        return view('mahasiswa-matakuliah', compact('data'));
    }

    public function create()
    {
        $mahasiswa = Mahasiswa::query()->get();
        $matakuliah = Matakuliah::query()->get();

        return view('mahasiswa-matakuliah-form', compact('mahasiswa', 'matakuliah'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'mahasiswa' => 'required',
            'matakuliah' => 'required',
        ]);

        MahasiswaMatakuliah::create([
            'mahasiswa_id' => $request->mahasiswa,
            'matakuliah_id' => $request->matakuliah,
        ]);

        return back()->with('sukses', 'Data berhasil disimpan.');
    }

    public function edit($id)
    {
        $mhsMatkul = MahasiswaMatakuliah::query()->findOrFail($id);
        $mahasiswa = Mahasiswa::query()->get();
        $matakuliah = Matakuliah::query()->get();

        return view('mahasiswa-matakuliah-edit', compact('mhsMatkul', 'mahasiswa', 'matakuliah'));
    }

    public function update(Request $request, $id)
    {
        $mhsMatkul = MahasiswaMatakuliah::query()->findOrFail($id);

        $request->validate([
            'mahasiswa' => 'required',
            'matakuliah' => 'required',
        ]);

        $mhsMatkul->update([
            'mahasiswa_id' => $request->mahasiswa,
            'matakuliah_id' => $request->matakuliah,
        ]);

        return back()->with('sukses', 'Data berhasil diperbarui.');
    }

    public function delete($id)
    {
        MahasiswaMatakuliah::query()->findOrFail($id)->delete();

        return back()->with('sukses', 'Data berhasil dihapus.');
    }
}
