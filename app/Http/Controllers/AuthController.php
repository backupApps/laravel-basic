<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Mahasiswa;
use App\Models\Prodi;
use App\Models\RoleUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function showLogin()
    {
        if (session()->has('auth_id')) {
            return redirect()->route('dashboard');
        }

        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        $admin = Admin::where('email', $credentials['email'])->first();
        $mahasiswa = Mahasiswa::where('email', $credentials['email'])->first();
        $user = $admin ?? $mahasiswa;
        $role = $admin ? 'admin' : 'mahasiswa';

        if (! $user || ! Hash::check($credentials['password'], $user->password)) {
            return back()
                ->withErrors(['email' => 'Email atau password salah.'])
                ->onlyInput('email');
        }

        $request->session()->regenerate();
        $request->session()->put([
            'auth_id' => $user->id,
            'auth_role' => $role,
            'auth_name' => $user->nama,
        ]);

        return redirect()->intended(route('dashboard'));
    }

    public function showRegister()
    {
        if (session()->has('auth_id')) {
            return redirect()->route('dashboard');
        }

        $prodis = Prodi::orderBy('nama_prodi')->get();

        return view('auth.register', compact('prodis'));
    }

    public function register(Request $request)
    {
        $data = $request->validate([
            'nama' => ['required', 'string', 'max:50'],
            'email' => ['required', 'email', 'max:255'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'role' => ['required', 'in:admin,mahasiswa'],
            'nim' => ['required_if:role,mahasiswa', 'nullable', 'string', 'max:10', 'unique:mahasiswa,nim'],
            'prodi_id' => ['required_if:role,mahasiswa', 'nullable', 'exists:prodis,id'],
            'no_hp' => ['required_if:role,mahasiswa', 'nullable', 'string', 'max:15'],
            'alamat' => ['required_if:role,mahasiswa', 'nullable', 'string'],
        ]);

        $emailDipakai = Admin::where('email', $data['email'])->exists()
            || Mahasiswa::where('email', $data['email'])->exists();

        if ($emailDipakai) {
            return back()
                ->withErrors(['email' => 'Email sudah digunakan.'])
                ->withInput();
        }

        if ($data['role'] === 'admin') {
            $role = RoleUser::where('nama_role', 'Admin')->firstOrFail();
            $user = Admin::create([
                'role_user_id' => $role->id,
                'nama' => $data['nama'],
                'email' => $data['email'],
                'password' => $data['password'],
            ]);
        } else {
            $role = RoleUser::where('nama_role', 'Mahasiswa')->firstOrFail();
            $user = Mahasiswa::create([
                'prodi_id' => $data['prodi_id'],
                'role_user_id' => $role->id,
                'nama' => $data['nama'],
                'nim' => $data['nim'],
                'email' => $data['email'],
                'password' => $data['password'],
                'no_hp' => $data['no_hp'],
                'alamat' => $data['alamat'],
            ]);
        }

        $request->session()->regenerate();
        $request->session()->put([
            'auth_id' => $user->id,
            'auth_role' => $data['role'],
            'auth_name' => $user->nama,
        ]);

        return redirect()->route('dashboard');
    }

    public function logout(Request $request)
    {
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
}
