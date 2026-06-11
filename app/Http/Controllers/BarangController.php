<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\KategoriBarang;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class BarangController extends Controller
{
    public function index()
    {
        $barangs = Barang::with('kategoriBarang')
            ->latest()
            ->paginate(10);

        return view('barang', compact('barangs'));
    }

    public function create()
    {
        $kategoriBarangs = KategoriBarang::orderBy('nama_kategori')->get();

        return view('barang-create', compact('kategoriBarangs'));
    }

    public function store(Request $request)
    {
        Barang::create($this->validatedData($request));

        return redirect()
            ->route('barang')
            ->with('success', 'Data barang berhasil ditambahkan.');
    }

    public function edit(Barang $barang)
    {
        $kategoriBarangs = KategoriBarang::orderBy('nama_kategori')->get();

        return view('barang-edit', compact('barang', 'kategoriBarangs'));
    }

    public function update(Request $request, Barang $barang)
    {
        $barang->update($this->validatedData($request, $barang));

        return redirect()
            ->route('barang')
            ->with('success', 'Data barang berhasil diperbarui.');
    }

    public function destroy(Barang $barang)
    {
        $barang->delete();

        return redirect()
            ->route('barang')
            ->with('success', 'Data barang berhasil dihapus.');
    }

    private function validatedData(Request $request, ?Barang $barang = null): array
    {
        return $request->validate([
            'kategori_barang_id' => ['required', 'exists:kategori_barangs,id'],
            'kode_barang' => [
                'required',
                'string',
                'max:50',
                Rule::unique('barangs', 'kode_barang')->ignore($barang),
            ],
            'nama_barang' => ['required', 'string', 'max:100'],
            'jumlah_barang' => ['required', 'integer', 'min:0'],
        ], [
            'kategori_barang_id.required' => 'Kategori wajib dipilih.',
            'kategori_barang_id.exists' => 'Kategori tidak valid.',
            'kode_barang.required' => 'Kode barang wajib diisi.',
            'kode_barang.unique' => 'Kode barang sudah digunakan.',
            'nama_barang.required' => 'Nama barang wajib diisi.',
            'jumlah_barang.required' => 'Jumlah barang wajib diisi.',
            'jumlah_barang.integer' => 'Jumlah barang harus berupa angka.',
            'jumlah_barang.min' => 'Jumlah barang tidak boleh kurang dari 0.',
        ]);
    }
}
