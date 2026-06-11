@extends('layouts.app')

@section('content')
    <div class="row d-print-none">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0">Laporan Peminjaman</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item">
                            <a href="{{ route('dashboard') }}">Inventaris</a>
                        </li>
                        <li class="breadcrumb-item active">Laporan</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <div class="row d-print-none">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('laporan') }}" method="get">
                        <div class="row">
                            <div class="col-md-3">
                                <div class="mb-3">
                                    <label class="form-label">TANGGAL MULAI</label>
                                    <input type="date" name="tanggal_mulai"
                                        class="form-control @error('tanggal_mulai') is-invalid @enderror"
                                        value="{{ request('tanggal_mulai') }}">
                                    @error('tanggal_mulai')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="mb-3">
                                    <label class="form-label">TANGGAL SELESAI</label>
                                    <input type="date" name="tanggal_selesai"
                                        class="form-control @error('tanggal_selesai') is-invalid @enderror"
                                        value="{{ request('tanggal_selesai') }}">
                                    @error('tanggal_selesai')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="mb-3">
                                    <label class="form-label">STATUS</label>
                                    <select name="status" class="form-select @error('status') is-invalid @enderror">
                                        <option value="">Semua Status</option>
                                        <option value="aktif" @selected(request('status') === 'aktif')>Aktif</option>
                                        <option value="selesai" @selected(request('status') === 'selesai')>Selesai</option>
                                    </select>
                                    @error('status')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="mb-3">
                                    <label class="form-label">MAHASISWA</label>
                                    <select name="mahasiswa_id"
                                        class="form-select @error('mahasiswa_id') is-invalid @enderror">
                                        <option value="">Semua Mahasiswa</option>
                                        @foreach ($mahasiswa as $item)
                                            <option value="{{ $item->id }}" @selected((string) request('mahasiswa_id') === (string) $item->id)>
                                                {{ $item->nim }} - {{ $item->nama }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('mahasiswa_id')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row align-items-end">
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label class="form-label">BARANG</label>
                                    <select name="barang_id" class="form-select @error('barang_id') is-invalid @enderror">
                                        <option value="">Semua Barang</option>
                                        @foreach ($barangs as $barang)
                                            <option value="{{ $barang->id }}" @selected((string) request('barang_id') === (string) $barang->id)>
                                                {{ $barang->kode_barang }} - {{ $barang->nama_barang }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('barang_id')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-8">
                                <div class="mb-3 d-flex justify-content-md-end gap-2">
                                    <a href="{{ route('laporan') }}" class="btn btn-secondary">Reset</a>
                                    <button type="submit" class="btn btn-primary">Filter</button>
                                    <button type="button" class="btn btn-success" onclick="window.print()">Cetak</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-6 col-lg-3">
            <div class="card text-center">
                <div class="card-body">
                    <p class="text-muted mb-2">Total Transaksi</p>
                    <h2 class="mb-0"><b>{{ $stats['total_transaksi'] }}</b></h2>
                </div>
            </div>
        </div>

        <div class="col-sm-6 col-lg-3">
            <div class="card text-center">
                <div class="card-body">
                    <p class="text-muted mb-2">Total Dipinjam</p>
                    <h2 class="mb-0"><b>{{ $stats['total_pinjam'] }}</b></h2>
                </div>
            </div>
        </div>

        <div class="col-sm-6 col-lg-3">
            <div class="card text-center">
                <div class="card-body">
                    <p class="text-muted mb-2">Total Kembali</p>
                    <h2 class="mb-0"><b>{{ $stats['total_kembali'] }}</b></h2>
                </div>
            </div>
        </div>

        <div class="col-sm-6 col-lg-3">
            <div class="card text-center">
                <div class="card-body">
                    <p class="text-muted mb-2">Belum Kembali</p>
                    <h2 class="mb-0"><b>{{ $stats['total_belum_kembali'] }}</b></h2>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <div>
                            <h4 class="card-title mb-1">Detail Laporan Peminjaman</h4>
                            <p class="text-muted mb-0">
                                Dicetak pada {{ now()->translatedFormat('d F Y H:i') }}
                            </p>
                        </div>
                    </div>

                    <div class="table-responsive">
                        <table class="table table-bordered table-hover mb-0">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Mahasiswa</th>
                                    <th>Prodi</th>
                                    <th>Barang</th>
                                    <th>Kategori</th>
                                    <th>Waktu Pinjam</th>
                                    <th>Waktu Kembali</th>
                                    <th>Pinjam</th>
                                    <th>Kembali</th>
                                    <th>Status</th>
                                    <th>Keterangan</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($laporan as $item)
                                    <tr>
                                        <td>{{ $loop->iteration + $laporan->firstItem() - 1 }}</td>
                                        <td>
                                            <strong>{{ $item->mahasiswa->nama }}</strong>
                                            <div class="text-muted">{{ $item->mahasiswa->nim }}</div>
                                        </td>
                                        <td>{{ $item->mahasiswa->prodi->nama_prodi }}</td>
                                        <td>
                                            <strong>{{ $item->barang->nama_barang }}</strong>
                                            <div class="text-muted">{{ $item->barang->kode_barang }}</div>
                                        </td>
                                        <td>{{ $item->barang->kategoriBarang->nama_kategori }}</td>
                                        <td>{{ $item->waktu_pinjam->translatedFormat('d F Y H:i') }}</td>
                                        <td>{{ $item->waktu_kembali?->translatedFormat('d F Y H:i') ?? '-' }}</td>
                                        <td>{{ $item->jumlah_pinjam }}</td>
                                        <td>{{ $item->jumlah_kembali }}</td>
                                        <td>
                                            @if (is_null($item->waktu_kembali) || $item->jumlah_kembali < $item->jumlah_pinjam)
                                                <span class="badge bg-warning">Aktif</span>
                                            @else
                                                <span class="badge bg-success">Selesai</span>
                                            @endif
                                        </td>
                                        <td>{{ $item->keterangan ?? '-' }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="11" class="text-center">Tidak ada data laporan.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <div class="mt-3">
                        {{ $laporan->links('pagination::bootstrap-5') }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
