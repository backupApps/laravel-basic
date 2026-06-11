<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Mahasiswa;
use App\Models\Peminjaman;
use Illuminate\Http\Request;

class PeminjamanController extends Controller
{
    public function index()
    {
        $peminjaman = Peminjaman::with('mahasiswa', 'barang')
            ->latest()
            ->paginate(10);

        return view('peminjaman', compact('peminjaman'));
    }

    public function create()
    {
        return view('peminjaman-create', $this->formData());
    }

    public function store(Request $request)
    {
        Peminjaman::create($this->validatedData($request));

        return redirect()
            ->route('peminjaman')
            ->with('success', 'Data peminjaman berhasil ditambahkan.');
    }

    public function edit(Peminjaman $peminjaman)
    {
        return view('peminjaman-edit', $this->formData() + compact('peminjaman'));
    }

    public function update(Request $request, Peminjaman $peminjaman)
    {
        $peminjaman->update($this->validatedData($request));

        return redirect()
            ->route('peminjaman')
            ->with('success', 'Data peminjaman berhasil diperbarui.');
    }

    public function destroy(Peminjaman $peminjaman)
    {
        $peminjaman->delete();

        return redirect()
            ->route('peminjaman')
            ->with('success', 'Data peminjaman berhasil dihapus.');
    }

    private function formData(): array
    {
        return [
            'mahasiswa' => Mahasiswa::orderBy('nama')->get(),
            'barangs' => Barang::orderBy('nama_barang')->get(),
        ];
    }

    private function validatedData(Request $request): array
    {
        return $request->validate([
            'mahasiswa_id' => ['required', 'exists:mahasiswa,id'],
            'barang_id' => ['required', 'exists:barangs,id'],
            'waktu_pinjam' => ['required', 'date'],
            'waktu_kembali' => ['nullable', 'date', 'after_or_equal:waktu_pinjam'],
            'jumlah_pinjam' => ['required', 'integer', 'min:1'],
            'jumlah_kembali' => ['required', 'integer', 'min:0', 'lte:jumlah_pinjam'],
            'keterangan' => ['nullable', 'string'],
        ], [
            'mahasiswa_id.required' => 'Mahasiswa wajib dipilih.',
            'barang_id.required' => 'Barang wajib dipilih.',
            'waktu_pinjam.required' => 'Waktu pinjam wajib diisi.',
            'waktu_kembali.after_or_equal' => 'Waktu kembali tidak boleh sebelum waktu pinjam.',
            'jumlah_pinjam.required' => 'Jumlah pinjam wajib diisi.',
            'jumlah_pinjam.min' => 'Jumlah pinjam minimal 1.',
            'jumlah_kembali.required' => 'Jumlah kembali wajib diisi.',
            'jumlah_kembali.lte' => 'Jumlah kembali tidak boleh lebih besar dari jumlah pinjam.',
        ]);
    }
}
