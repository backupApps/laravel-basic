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
        $mahasiswa = Mahasiswa::orderBy('nama')->get();
        $barangs = Barang::orderBy('nama_barang')->get();

        return view('peminjaman-create', compact('mahasiswa', 'barangs'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'mahasiswa_id' => ['required', 'exists:mahasiswa,id'],
            'barang_id' => ['required', 'exists:barangs,id'],
            'waktu_pinjam' => ['required', 'date'],
            'waktu_kembali' => ['nullable', 'date', 'after_or_equal:waktu_pinjam'],
            'jumlah_pinjam' => ['required', 'integer', 'min:1'],
            'jumlah_kembali' => ['required', 'integer', 'min:0', 'lte:jumlah_pinjam'],
            'keterangan' => ['nullable', 'string'],
        ]);

        Peminjaman::create($data);

        return redirect()
            ->route('peminjaman')
            ->with('success', 'Data peminjaman berhasil ditambahkan.');
    }

    public function edit(Peminjaman $peminjaman)
    {
        $mahasiswa = Mahasiswa::orderBy('nama')->get();
        $barangs = Barang::orderBy('nama_barang')->get();

        return view('peminjaman-edit', compact('peminjaman', 'mahasiswa', 'barangs'));
    }

    public function update(Request $request, Peminjaman $peminjaman)
    {
        $data = $request->validate([
            'mahasiswa_id' => ['required', 'exists:mahasiswa,id'],
            'barang_id' => ['required', 'exists:barangs,id'],
            'waktu_pinjam' => ['required', 'date'],
            'waktu_kembali' => ['nullable', 'date', 'after_or_equal:waktu_pinjam'],
            'jumlah_pinjam' => ['required', 'integer', 'min:1'],
            'jumlah_kembali' => ['required', 'integer', 'min:0', 'lte:jumlah_pinjam'],
            'keterangan' => ['nullable', 'string'],
        ]);

        $peminjaman->update($data);

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
}
