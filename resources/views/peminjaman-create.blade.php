@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Form Input Data Peminjaman</h4>
                    <p class="card-title-desc">Tambahkan transaksi peminjaman barang.</p>

                    <form action="{{ route('peminjaman.store') }}" method="post" novalidate>
                        @csrf

                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">MAHASISWA</label>
                                    <select name="mahasiswa_id"
                                        class="form-select @error('mahasiswa_id') is-invalid @enderror">
                                        <option value="">-- Pilih --</option>
                                        @foreach ($mahasiswa as $item)
                                            <option value="{{ $item->id }}" @selected(old('mahasiswa_id') == $item->id)>
                                                {{ $item->nim }} - {{ $item->nama }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('mahasiswa_id')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">BARANG</label>
                                    <select name="barang_id" class="form-select @error('barang_id') is-invalid @enderror">
                                        <option value="">-- Pilih --</option>
                                        @foreach ($barangs as $barang)
                                            <option value="{{ $barang->id }}" @selected(old('barang_id') == $barang->id)>
                                                {{ $barang->kode_barang }} - {{ $barang->nama_barang }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('barang_id')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">WAKTU PINJAM</label>
                                    <input type="datetime-local" name="waktu_pinjam"
                                        class="form-control @error('waktu_pinjam') is-invalid @enderror"
                                        value="{{ old('waktu_pinjam') }}">
                                    @error('waktu_pinjam')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">WAKTU KEMBALI</label>
                                    <input type="datetime-local" name="waktu_kembali"
                                        class="form-control @error('waktu_kembali') is-invalid @enderror"
                                        value="{{ old('waktu_kembali') }}">
                                    @error('waktu_kembali')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">JUMLAH PINJAM</label>
                                    <input type="number" name="jumlah_pinjam"
                                        class="form-control @error('jumlah_pinjam') is-invalid @enderror"
                                        value="{{ old('jumlah_pinjam') }}" min="1">
                                    @error('jumlah_pinjam')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">JUMLAH KEMBALI</label>
                                    <input type="number" name="jumlah_kembali"
                                        class="form-control @error('jumlah_kembali') is-invalid @enderror"
                                        value="{{ old('jumlah_kembali', 0) }}" min="0">
                                    @error('jumlah_kembali')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">KETERANGAN</label>
                            <textarea name="keterangan" class="form-control @error('keterangan') is-invalid @enderror" rows="3"
                                placeholder="Opsional...">{{ old('keterangan') }}</textarea>
                            @error('keterangan')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="d-flex justify-content-between">
                            <a href="{{ route('peminjaman') }}" class="btn btn-secondary">Kembali</a>
                            <button class="btn btn-primary" type="submit">Tambah</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
