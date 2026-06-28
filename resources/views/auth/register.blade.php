@extends('layouts.auth', [
    'title' => 'Registrasi',
    'subtitle' => 'Buat akun baru dan pilih role pengguna.',
])

@section('content')
    <form action="{{ route('register.store') }}" method="post">
        @csrf

        <div class="mb-3">
            <label class="form-label">NAMA</label>
            <input type="text" name="nama" class="form-control @error('nama') is-invalid @enderror"
                value="{{ old('nama') }}" placeholder="Nama lengkap" autofocus>
            @error('nama')
                <span class="invalid-feedback">{{ $message }}</span>
            @enderror
        </div>

        <div class="mb-3">
            <label class="form-label">EMAIL</label>
            <input type="email" name="email" class="form-control @error('email') is-invalid @enderror"
                value="{{ old('email') }}" placeholder="nama@email.com">
            @error('email')
                <span class="invalid-feedback">{{ $message }}</span>
            @enderror
        </div>

        <div class="mb-3">
            <label class="form-label">ROLE</label>
            <select name="role" class="form-select @error('role') is-invalid @enderror">
                <option value="mahasiswa" @selected(old('role', 'mahasiswa') === 'mahasiswa')>Mahasiswa</option>
                <option value="admin" @selected(old('role') === 'admin')>Admin</option>
            </select>
            @error('role')
                <span class="invalid-feedback">{{ $message }}</span>
            @enderror
        </div>

        <div class="mb-3">
            <label class="form-label">NIM</label>
            <input type="text" name="nim" class="form-control @error('nim') is-invalid @enderror"
                value="{{ old('nim') }}" placeholder="Diisi jika role Mahasiswa">
            @error('nim')
                <span class="invalid-feedback">{{ $message }}</span>
            @enderror
        </div>

        <div class="mb-3">
            <label class="form-label">PRODI</label>
            <select name="prodi_id" class="form-select @error('prodi_id') is-invalid @enderror">
                <option value="">-- Pilih jika role Mahasiswa --</option>
                @foreach ($prodis as $prodi)
                    <option value="{{ $prodi->id }}" @selected(old('prodi_id') == $prodi->id)>
                        {{ $prodi->kode_prodi }} - {{ $prodi->nama_prodi }}
                    </option>
                @endforeach
            </select>
            @error('prodi_id')
                <span class="invalid-feedback">{{ $message }}</span>
            @enderror
        </div>

        <div class="mb-3">
            <label class="form-label">NO HP</label>
            <input type="text" name="no_hp" class="form-control @error('no_hp') is-invalid @enderror"
                value="{{ old('no_hp') }}" placeholder="Diisi jika role Mahasiswa">
            @error('no_hp')
                <span class="invalid-feedback">{{ $message }}</span>
            @enderror
        </div>

        <div class="mb-3">
            <label class="form-label">ALAMAT</label>
            <textarea name="alamat" class="form-control @error('alamat') is-invalid @enderror" rows="3"
                placeholder="Diisi jika role Mahasiswa">{{ old('alamat') }}</textarea>
            @error('alamat')
                <span class="invalid-feedback">{{ $message }}</span>
            @enderror
        </div>

        <div class="mb-3">
            <label class="form-label">PASSWORD</label>
            <input type="password" name="password" class="form-control @error('password') is-invalid @enderror"
                placeholder="Minimal 8 karakter">
            @error('password')
                <span class="invalid-feedback">{{ $message }}</span>
            @enderror
        </div>

        <div class="mb-3">
            <label class="form-label">KONFIRMASI PASSWORD</label>
            <input type="password" name="password_confirmation" class="form-control" placeholder="Ulangi password">
        </div>

        <div class="d-grid">
            <button type="submit" class="btn btn-primary">Registrasi</button>
        </div>

        <div class="mt-4 text-center">
            <span class="text-muted">Sudah punya akun?</span>
            <a href="{{ route('login') }}">Login</a>
        </div>
    </form>
@endsection
