@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-body">

                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h4 class="card-title">Form Input Matakuliah</h4>
                        <a href="{{ route('matakuliah') }}" class="btn btn-sm btn-secondary">Kembali</a>
                    </div>

                    <form action="{{ route('matakuliah.update', $matakuliah->id) }}" method="post" novalidate>
                        @csrf
                        @method('put')

                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="validationCustom01" class="form-label">KODE MATAKULIAH</label>
                                    <input type="text" name="kode_matakuliah" class="form-control @error('kode_matakuliah') is-invalid @enderror" value="{{ old('kode_matakuliah', $matakuliah->kode_matakuliah) }}" placeholder="Kode Matakuliah">
                                    @error('kode_matakuliah')
                                        <span class="invalid-feedback">
                                            {{ $message }}
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="validationCustom01" class="form-label">NAMA MATAKULIAH</label>
                                    <input type="text" name="nama_matakuliah" class="form-control @error('nama_matakuliah') is-invalid @enderror" value="{{ old('nama_matakuliah', $matakuliah->nama_matakuliah) }}" placeholder="Nama Matakuliah">
                                    @error('nama_matakuliah')
                                        <span class="invalid-feedback">
                                            {{ $message }}
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="validationCustom02" class="form-label">SKS</label>
                                    <input type="text" name="sks" class="form-control @error('sks') is-invalid @enderror" value="{{ old('sks', $matakuliah->sks) }}" placeholder="SKS">
                                    @error('sks')
                                        <span class="invalid-feedback">
                                            {{ $message }}
                                        </span>
                                    @enderror
                                </div>
                            </div>

                        </div>
                        <div>
                            <button class="btn btn-primary" type="submit">Perbarui</button>
                        </div>
                    </form>
                </div>
            </div>
            <!-- end card -->
        </div> <!-- end col -->
    </div>
@endsection
