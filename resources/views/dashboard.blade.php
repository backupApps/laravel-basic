@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0">Dashboard Inventaris</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item">
                            <a href="{{ route('dashboard') }}">Inventaris</a>
                        </li>
                        <li class="breadcrumb-item active">Dashboard</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-6 col-xl-3">
            <div class="card text-center">
                <div class="card-body">
                    <p class="text-muted mb-2">Total Barang</p>
                    <h2 class="mb-2">
                        <i class="mdi mdi-package-variant-closed text-primary me-2"></i>
                        <b>{{ $stats['total_barang'] }}</b>
                    </h2>
                    @if (session('auth_role') === 'admin')
                        <a href="{{ route('barang') }}" class="text-primary">Lihat data barang</a>
                    @else
                        <span class="text-muted">Data inventaris kampus</span>
                    @endif
                </div>
            </div>
        </div>

        <div class="col-sm-6 col-xl-3">
            <div class="card text-center">
                <div class="card-body">
                    <p class="text-muted mb-2">Total Stok</p>
                    <h2 class="mb-2">
                        <i class="mdi mdi-archive text-success me-2"></i>
                        <b>{{ $stats['total_stok'] }}</b>
                    </h2>
                    <span class="text-muted">Jumlah seluruh unit barang</span>
                </div>
            </div>
        </div>

        <div class="col-sm-6 col-xl-3">
            <div class="card text-center">
                <div class="card-body">
                    <p class="text-muted mb-2">Mahasiswa</p>
                    <h2 class="mb-2">
                        <i class="mdi mdi-account-school text-info me-2"></i>
                        <b>{{ $stats['total_mahasiswa'] }}</b>
                    </h2>
                    @if (session('auth_role') === 'admin')
                        <a href="{{ route('mahasiswa') }}" class="text-primary">Lihat mahasiswa</a>
                    @else
                        <span class="text-muted">Pengguna mahasiswa</span>
                    @endif
                </div>
            </div>
        </div>

        <div class="col-sm-6 col-xl-3">
            <div class="card text-center">
                <div class="card-body">
                    <p class="text-muted mb-2">Admin</p>
                    <h2 class="mb-2">
                        <i class="mdi mdi-account-tie text-warning me-2"></i>
                        <b>{{ $stats['total_admin'] }}</b>
                    </h2>
                    @if (session('auth_role') === 'admin')
                        <a href="{{ route('admin') }}" class="text-primary">Lihat admin</a>
                    @else
                        <span class="text-muted">Pengelola sistem</span>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-4">
            <div class="card text-center">
                <div class="card-body">
                    <p class="text-muted mb-2">Total Peminjaman</p>
                    <h2 class="mb-2">
                        <i class="mdi mdi-clipboard-list-outline text-primary me-2"></i>
                        <b>{{ $stats['total_peminjaman'] }}</b>
                    </h2>
                    <a href="{{ route('peminjaman') }}" class="text-primary">Lihat peminjaman</a>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card text-center">
                <div class="card-body">
                    <p class="text-muted mb-2">Peminjaman Aktif</p>
                    <h2 class="mb-2">
                        <i class="mdi mdi-clock-outline text-danger me-2"></i>
                        <b>{{ $stats['peminjaman_aktif'] }}</b>
                    </h2>
                    <span class="text-muted">Belum kembali penuh</span>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card text-center">
                <div class="card-body">
                    <p class="text-muted mb-2">Peminjaman Selesai</p>
                    <h2 class="mb-2">
                        <i class="mdi mdi-check-circle-outline text-success me-2"></i>
                        <b>{{ $stats['peminjaman_selesai'] }}</b>
                    </h2>
                    <span class="text-muted">Sudah tercatat kembali</span>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-5">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h4 class="card-title mb-0">Stok Barang</h4>
                        @if (session('auth_role') === 'admin')
                            <a href="{{ route('barang.create') }}" class="btn btn-sm btn-primary">Tambah Barang</a>
                        @endif
                    </div>

                    <div class="table-responsive">
                        <table class="table table-hover mb-0">
                            <thead>
                                <tr>
                                    <th>Barang</th>
                                    <th>Kategori</th>
                                    <th class="text-end">Stok</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($stokMenipis as $barang)
                                    <tr>
                                        <td>
                                            <strong>{{ $barang->nama_barang }}</strong>
                                            <div class="text-muted">{{ $barang->kode_barang }}</div>
                                        </td>
                                        <td>{{ $barang->kategoriBarang->nama_kategori }}</td>
                                        <td class="text-end">
                                            <span
                                                class="badge {{ $barang->jumlah_barang <= 5 ? 'bg-danger' : 'bg-success' }}">
                                                {{ $barang->jumlah_barang }}
                                            </span>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="3" class="text-center">Belum ada data barang.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-7">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h4 class="card-title mb-0">Peminjaman Terbaru</h4>
                        <a href="{{ route('peminjaman.create') }}" class="btn btn-sm btn-primary">Tambah Peminjaman</a>
                    </div>

                    <div class="table-responsive">
                        <table class="table table-hover mb-0">
                            <thead>
                                <tr>
                                    <th>Mahasiswa</th>
                                    <th>Barang</th>
                                    <th>Waktu Pinjam</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($peminjamanTerbaru as $peminjaman)
                                    <tr>
                                        <td>{{ $peminjaman->mahasiswa->nama }}</td>
                                        <td>
                                            <strong>{{ $peminjaman->barang->nama_barang }}</strong>
                                            <div class="text-muted">
                                                {{ $peminjaman->jumlah_kembali }}/{{ $peminjaman->jumlah_pinjam }}
                                                kembali
                                            </div>
                                        </td>
                                        <td>{{ $peminjaman->waktu_pinjam->translatedFormat('d F Y H:i') }}</td>
                                        <td>
                                            @if (is_null($peminjaman->waktu_kembali) || $peminjaman->jumlah_kembali < $peminjaman->jumlah_pinjam)
                                                <span class="badge bg-warning">Aktif</span>
                                            @else
                                                <span class="badge bg-success">Selesai</span>
                                            @endif
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="text-center">Belum ada data peminjaman.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
