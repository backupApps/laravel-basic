@extends('layouts.auth', [
    'title' => 'Login',
    'subtitle' => 'Masuk menggunakan akun admin atau mahasiswa.',
])

@section('content')
    <form action="{{ route('login.store') }}" method="post">
        @csrf

        <div class="mb-3">
            <label class="form-label">EMAIL</label>
            <input type="email" name="email" class="form-control @error('email') is-invalid @enderror"
                value="{{ old('email') }}" placeholder="nama@email.com" autofocus>
            @error('email')
                <span class="invalid-feedback">{{ $message }}</span>
            @enderror
        </div>

        <div class="mb-3">
            <label class="form-label">PASSWORD</label>
            <input type="password" name="password" class="form-control @error('password') is-invalid @enderror"
                placeholder="Password">
            @error('password')
                <span class="invalid-feedback">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-check mb-3">
            <input type="checkbox" name="remember" value="1" class="form-check-input" id="remember">
            <label class="form-check-label" for="remember">Ingat saya</label>
        </div>

        <div class="d-grid">
            <button type="submit" class="btn btn-primary">Login</button>
        </div>

        <div class="mt-4 text-center">
            <span class="text-muted">Belum punya akun?</span>
            <a href="{{ route('register') }}">Registrasi</a>
        </div>
    </form>
@endsection
