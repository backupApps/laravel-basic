@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-body">

                    <h4 class="card-title">Form Input Data Barang</h4>
                    <p class="card-title-desc">Tambahkan data barang terbaru.</p>

                    <form action="#" method="post" novalidate>

                        @csrf

                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">KODE BARANG</label>
                                    <input type="text" name="kode_barang" class="form-control @error('kode_barang') is-invalid @enderror" placeholder="Tulis Kode Barang...">
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
                                    <input type="text" name="nama_barang" class="form-control @error('nama_barang') is-invalid @enderror" placeholder="Tulis Nama Barang...">
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
                                    <select name="" class="form-select">
                                        <option value="">-- Pilih --</option>
                                        <option value="">kategori 1</option>
                                        <option value="">kategori 2</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="validationCustom04" class="form-label">JUMLAH</label>
                                    <input type="text" name="nama_ayah" class="form-control @error('nama_ayah') is-invalid @enderror" placeholder="Tulis jumlah...">
                                    @error('nama_ayah')
                                        <span class="invalid-feedback">
                                            {{ $message }}
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="d-flex justify-content-between">
                            <a href="{{ route('barang') }}" class="btn btn-secondary">Kembali</a>
                            <button class="btn btn-primary" type="submit">Tambah</button>
                        </div>
                    </form>
                </div>
            </div>
            <!-- end card -->
        </div> <!-- end col -->
    </div>
@endsection
