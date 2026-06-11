<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\RoleUser;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        $admins = Admin::with('roleUser')
            ->latest()
            ->paginate(10);

        return view('admin', compact('admins'));
    }

    public function create()
    {
        return view('admin-create');
    }

    public function store(Request $request)
    {
        Admin::create($this->validatedData($request) + [
            'role_user_id' => $this->roleId('Admin'),
        ]);

        return redirect()
            ->route('admin')
            ->with('success', 'Data admin berhasil ditambahkan.');
    }

    public function edit(Admin $admin)
    {
        return view('admin-edit', compact('admin'));
    }

    public function update(Request $request, Admin $admin)
    {
        $admin->update($this->validatedData($request) + [
            'role_user_id' => $this->roleId('Admin'),
        ]);

        return redirect()
            ->route('admin')
            ->with('success', 'Data admin berhasil diperbarui.');
    }

    public function destroy(Admin $admin)
    {
        $admin->delete();

        return redirect()
            ->route('admin')
            ->with('success', 'Data admin berhasil dihapus.');
    }

    private function validatedData(Request $request): array
    {
        return $request->validate([
            'nama' => ['required', 'string', 'max:32'],
        ], [
            'nama.required' => 'Nama wajib diisi.',
        ]);
    }

    private function roleId(string $namaRole): int
    {
        return RoleUser::where('nama_role', $namaRole)->valueOrFail('id');
    }
}
