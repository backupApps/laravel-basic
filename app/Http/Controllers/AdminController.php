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
        $data = $request->validate([
            'nama' => ['required', 'string', 'max:32'],
        ]);

        $roleAdmin = RoleUser::where('nama_role', 'Admin')->firstOrFail();

        Admin::create($data + ['role_user_id' => $roleAdmin->id]);

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
        $data = $request->validate([
            'nama' => ['required', 'string', 'max:32'],
        ]);

        $roleAdmin = RoleUser::where('nama_role', 'Admin')->firstOrFail();

        $admin->update($data + ['role_user_id' => $roleAdmin->id]);

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
}
