@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-body">

                    <h4 class="card-title">Edit Data Barang</h4>
                    <p class="card-title-desc">Perbarui data inventaris yang sudah tersimpan.</p>

                    <form action="{{ route('barang.update', $barang) }}" method="post" novalidate>
                        @csrf
                        @method('PUT')

                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">KODE BARANG</label>
                                    <input type="text" name="kode_barang"
                                        class="form-control @error('kode_barang') is-invalid @enderror"
                                        value="{{ old('kode_barang', $barang->kode_barang) }}"
                                        placeholder="Tulis Kode Barang...">
                                    @error('kode_barang')
                                        <span class="invalid-feedback">
                                            {{ $message }}
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">NAMA BARANG</label>
                                    <input type="text" name="nama_barang"
                                        class="form-control @error('nama_barang') is-invalid @enderror"
                                        value="{{ old('nama_barang', $barang->nama_barang) }}"
                                        placeholder="Tulis Nama Barang...">
                                    @error('nama_barang')
                                        <span class="invalid-feedback">
                                            {{ $message }}
                                        </span>
                                    @enderror
                                </div>
                            </div>

                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">KATEGORI</label>
                                    <select name="kategori_barang_id"
                                        class="form-select @error('kategori_barang_id') is-invalid @enderror">
                                        <option value="">-- Pilih --</option>
                                        @foreach ($kategoriBarangs as $kategoriBarang)
                                            <option value="{{ $kategoriBarang->id }}"
                                                @selected(old('kategori_barang_id', $barang->kategori_barang_id) == $kategoriBarang->id)>
                                                {{ $kategoriBarang->nama_kategori }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('kategori_barang_id')
                                        <span class="invalid-feedback">
                                            {{ $message }}
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">JUMLAH</label>
                                    <input type="number" name="jumlah_barang"
                                        class="form-control @error('jumlah_barang') is-invalid @enderror"
                                        value="{{ old('jumlah_barang', $barang->jumlah_barang) }}" min="0"
                                        placeholder="Tulis jumlah...">
                                    @error('jumlah_barang')
                                        <span class="invalid-feedback">
                                            {{ $message }}
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="d-flex justify-content-between">
                            <a href="{{ route('barang') }}" class="btn btn-secondary">Kembali</a>
                            <button class="btn btn-primary" type="submit">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
