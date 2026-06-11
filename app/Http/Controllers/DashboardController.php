<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Barang;
use App\Models\Mahasiswa;
use App\Models\Peminjaman;

class DashboardController extends Controller
{
    public function index()
    {
        $peminjamanAktif = Peminjaman::whereNull('waktu_kembali')
            ->orWhereColumn('jumlah_kembali', '<', 'jumlah_pinjam')
            ->count();

        $totalPeminjaman = Peminjaman::count();

        $stats = [
            'total_barang' => Barang::count(),
            'total_stok' => Barang::sum('jumlah_barang'),
            'total_mahasiswa' => Mahasiswa::count(),
            'total_admin' => Admin::count(),
            'total_peminjaman' => $totalPeminjaman,
            'peminjaman_aktif' => $peminjamanAktif,
            'peminjaman_selesai' => $totalPeminjaman - $peminjamanAktif,
        ];

        $stokMenipis = Barang::with('kategoriBarang')
            ->orderBy('jumlah_barang')
            ->limit(5)
            ->get();

        $peminjamanTerbaru = Peminjaman::with('mahasiswa', 'barang')
            ->latest()
            ->limit(5)
            ->get();

        return view('dashboard', compact('stats', 'stokMenipis', 'peminjamanTerbaru'));
    }
}
