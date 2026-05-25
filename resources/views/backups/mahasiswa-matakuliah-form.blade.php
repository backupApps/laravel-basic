@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-body">

                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h4 class="card-title">Form Input Mahasiswa Matakuliah</h4>
                        <a href="{{ route('mahasiswa.matakuliah') }}" class="btn btn-sm btn-secondary">Kembali</a>
                    </div>

                    <form action="{{ route('mahasiswa.matakuliah.store') }}" method="post" novalidate>

                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">MAHASISWA</label>
                                    <select name="mahasiswa" class="form-control @error('mahasiswa') is-invalid @enderror">
                                        <option value="">-- Pilih --</option>
                                        @foreach ($mahasiswa as $item)
                                            <option value="{{ $item->id }}">{{ $item->nama }}</option>
                                        @endforeach
                                    </select>
                                    @error('mahasiswa')
                                        <span class="invalid-feedback">
                                            {{ $message }}
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">MATAKULIAH</label>
                                    <select name="matakuliah" class="form-control @error('matakuliah') is-invalid @enderror">
                                        <option value="">-- Pilih --</option>
                                        @foreach ($matakuliah as $item)
                                            <option value="{{ $item->id }}">{{ $item->nama_matakuliah }}</option>
                                        @endforeach
                                    </select>
                                    @error('matakuliah')
                                        <span class="invalid-feedback">
                                            {{ $message }}
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div>
                            <button class="btn btn-primary" type="submit">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
            <!-- end card -->
        </div> <!-- end col -->
    </div>
@endsection
