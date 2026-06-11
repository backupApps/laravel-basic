<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Mahasiswa;
use App\Models\Peminjaman;
use Illuminate\Http\Request;

class LaporanController extends Controller
{
    public function index(Request $request)
    {
        $filters = $request->validate([
            'tanggal_mulai' => ['nullable', 'date'],
            'tanggal_selesai' => ['nullable', 'date', 'after_or_equal:tanggal_mulai'],
            'status' => ['nullable', 'in:aktif,selesai'],
            'mahasiswa_id' => ['nullable', 'exists:mahasiswa,id'],
            'barang_id' => ['nullable', 'exists:barangs,id'],
        ]);

        $query = Peminjaman::with('mahasiswa.prodi', 'barang.kategoriBarang')
            ->latest('waktu_pinjam');

        if (! empty($filters['tanggal_mulai'])) {
            $query->whereDate('waktu_pinjam', '>=', $filters['tanggal_mulai']);
        }

        if (! empty($filters['tanggal_selesai'])) {
            $query->whereDate('waktu_pinjam', '<=', $filters['tanggal_selesai']);
        }

        if (! empty($filters['mahasiswa_id'])) {
            $query->where('mahasiswa_id', $filters['mahasiswa_id']);
        }

        if (! empty($filters['barang_id'])) {
            $query->where('barang_id', $filters['barang_id']);
        }

        if (($filters['status'] ?? null) === 'aktif') {
            $query->where(function ($query) {
                $query->whereNull('waktu_kembali')
                    ->orWhereColumn('jumlah_kembali', '<', 'jumlah_pinjam');
            });
        }

        if (($filters['status'] ?? null) === 'selesai') {
            $query->whereNotNull('waktu_kembali')
                ->whereColumn('jumlah_kembali', '>=', 'jumlah_pinjam');
        }

        $summaryItems = (clone $query)->get();
        $laporan = $query->paginate(10)->withQueryString();

        $stats = [
            'total_transaksi' => $summaryItems->count(),
            'total_pinjam' => $summaryItems->sum('jumlah_pinjam'),
            'total_kembali' => $summaryItems->sum('jumlah_kembali'),
            'total_belum_kembali' => $summaryItems->sum(fn (Peminjaman $item) => max($item->jumlah_pinjam - $item->jumlah_kembali, 0)),
        ];

        return view('laporan', [
            'laporan' => $laporan,
            'stats' => $stats,
            'mahasiswa' => Mahasiswa::orderBy('nama')->get(),
            'barangs' => Barang::orderBy('nama_barang')->get(),
            'filters' => $filters,
        ]);
    }
}
