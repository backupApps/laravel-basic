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
        Mahasiswa::create($this->validatedData($request) + [
            'role_user_id' => $this->roleId('Mahasiswa'),
        ]);

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
        $mahasiswa->update($this->validatedData($request, $mahasiswa) + [
            'role_user_id' => $this->roleId('Mahasiswa'),
        ]);

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

    private function validatedData(Request $request, ?Mahasiswa $mahasiswa = null): array
    {
        return $request->validate([
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
        ], [
            'prodi_id.required' => 'Prodi wajib dipilih.',
            'nama.required' => 'Nama wajib diisi.',
            'nim.required' => 'NIM wajib diisi.',
            'nim.unique' => 'NIM sudah digunakan.',
            'no_hp.required' => 'No HP wajib diisi.',
            'alamat.required' => 'Alamat wajib diisi.',
        ]);
    }

    private function roleId(string $namaRole): int
    {
        return RoleUser::where('nama_role', $namaRole)->valueOrFail('id');
    }
}
