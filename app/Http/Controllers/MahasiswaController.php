<?php

namespace App\Http\Controllers;

use App\Models\Mahasiswa;
use App\Models\Prodi;
use App\Models\RoleUser;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class MahasiswaController extends Controller
{
    public function index()
    {
        $mahasiswa = Mahasiswa::with('prodi', 'roleUser')
            ->latest()
            ->paginate(10);

        return view('mahasiswa', compact('mahasiswa'));
    }

    public function create()
    {
        $prodis = Prodi::orderBy('nama_prodi')->get();

        return view('mahasiswa-create', compact('prodis'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'prodi_id' => ['required', 'exists:prodis,id'],
            'nama' => ['required', 'string', 'max:50'],
            'nim' => ['required', 'string', 'max:10', 'unique:mahasiswa,nim'],
            'no_hp' => ['required', 'string', 'max:15'],
            'alamat' => ['required', 'string'],
        ]);

        $roleMahasiswa = RoleUser::where('nama_role', 'Mahasiswa')->firstOrFail();

        Mahasiswa::create($data + ['role_user_id' => $roleMahasiswa->id]);

        return redirect()
            ->route('mahasiswa')
            ->with('success', 'Data mahasiswa berhasil ditambahkan.');
    }

    public function edit(Mahasiswa $mahasiswa)
    {
        $prodis = Prodi::orderBy('nama_prodi')->get();

        return view('mahasiswa-edit', compact('mahasiswa', 'prodis'));
    }

    public function update(Request $request, Mahasiswa $mahasiswa)
    {
        $data = $request->validate([
            'prodi_id' => ['required', 'exists:prodis,id'],
            'nama' => ['required', 'string', 'max:50'],
            'nim' => [
                'required',
                'string',
                'max:10',
                Rule::unique('mahasiswa', 'nim')->ignore($mahasiswa),
            ],
            'no_hp' => ['required', 'string', 'max:15'],
            'alamat' => ['required', 'string'],
        ]);

        $roleMahasiswa = RoleUser::where('nama_role', 'Mahasiswa')->firstOrFail();

        $mahasiswa->update($data + ['role_user_id' => $roleMahasiswa->id]);

        return redirect()
            ->route('mahasiswa')
            ->with('success', 'Data mahasiswa berhasil diperbarui.');
    }

    public function destroy(Mahasiswa $mahasiswa)
    {
        $mahasiswa->delete();

        return redirect()
            ->route('mahasiswa')
            ->with('success', 'Data mahasiswa berhasil dihapus.');
    }
}
