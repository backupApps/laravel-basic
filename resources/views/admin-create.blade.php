@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Form Input Data Admin</h4>
                    <p class="card-title-desc">Tambahkan data admin.</p>

                    <form action="{{ route('admin.store') }}" method="post" novalidate>
                        @csrf

                        <div class="mb-3">
                            <label class="form-label">NAMA</label>
                            <input type="text" name="nama" class="form-control @error('nama') is-invalid @enderror"
                                value="{{ old('nama') }}" placeholder="Tulis nama...">
                            @error('nama')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="d-flex justify-content-between">
                            <a href="{{ route('admin') }}" class="btn btn-secondary">Kembali</a>
                            <button class="btn btn-primary" type="submit">Tambah</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
