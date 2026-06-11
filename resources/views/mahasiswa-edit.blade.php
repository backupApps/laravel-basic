@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Edit Data Mahasiswa</h4>
                    <p class="card-title-desc">Perbarui data mahasiswa.</p>

                    <form action="{{ route('mahasiswa.update', $mahasiswa) }}" method="post" novalidate>
                        @csrf
                        @method('PUT')

                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">NAMA</label>
                                    <input type="text" name="nama"
                                        class="form-control @error('nama') is-invalid @enderror"
                                        value="{{ old('nama', $mahasiswa->nama) }}" placeholder="Tulis nama...">
                                    @error('nama')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">NIM</label>
                                    <input type="text" name="nim"
                                        class="form-control @error('nim') is-invalid @enderror"
                                        value="{{ old('nim', $mahasiswa->nim) }}" placeholder="Tulis NIM...">
                                    @error('nim')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">PRODI</label>
                                    <select name="prodi_id" class="form-select @error('prodi_id') is-invalid @enderror">
                                        <option value="">-- Pilih --</option>
                                        @foreach ($prodis as $prodi)
                                            <option value="{{ $prodi->id }}" @selected(old('prodi_id', $mahasiswa->prodi_id) == $prodi->id)>
                                                {{ $prodi->kode_prodi }} - {{ $prodi->nama_prodi }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('prodi_id')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">NO HP</label>
                                    <input type="text" name="no_hp"
                                        class="form-control @error('no_hp') is-invalid @enderror"
                                        value="{{ old('no_hp', $mahasiswa->no_hp) }}" placeholder="Tulis no HP...">
                                    @error('no_hp')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">ALAMAT</label>
                            <textarea name="alamat" class="form-control @error('alamat') is-invalid @enderror" rows="3"
                                placeholder="Tulis alamat...">{{ old('alamat', $mahasiswa->alamat) }}</textarea>
                            @error('alamat')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="d-flex justify-content-between">
                            <a href="{{ route('mahasiswa') }}" class="btn btn-secondary">Kembali</a>
                            <button class="btn btn-primary" type="submit">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
