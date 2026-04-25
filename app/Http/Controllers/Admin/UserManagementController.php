<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class UserManagementController extends Controller
{
    // READ — Daftar KHUSUS user biasa
    public function index()
    {
        // Admin hanya boleh melihat akun dengan role 'user'
        $users = User::where('role', 'user')
            ->latest()
            ->paginate(10);

        return view('admin.users.index', compact('users'));
    }

    // READ — Detail satu user
    public function show(User $user)
    {
        // Proteksi: cegah admin mengintip data admin lain atau superadmin
        abort_if($user->role !== 'user', 403, 'Akses Ditolak.');
        return view('admin.users.show', compact('user'));
    }

    // CREATE — Form buat akun baru
    public function create()
    {
        return view('admin.users.create');
    }

    // CREATE — Simpan akun baru
    public function store(Request $request)
    {
        $request->validate([
            'name'     => ['required', 'string', 'max:255'],
            'email'    => ['required', 'email', 'unique:users,email'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => Hash::make($request->password),
            'role'     => 'user', // Paksa role menjadi 'user'
        ]);

        return redirect()->route('admin.users.index')
            ->with('success', 'Akun Pemilik UMKM (User) berhasil dibuat.');
    }

    // UPDATE — Form edit user
    public function edit(User $user)
    {
        abort_if($user->role !== 'user', 403, 'Anda hanya bisa mengedit akun User biasa.');
        return view('admin.users.edit', compact('user'));
    }

    // UPDATE — Simpan perubahan
    public function update(Request $request, User $user)
    {
        abort_if($user->role !== 'user', 403);

        $request->validate([
            'name'     => ['required', 'string', 'max:255'],
            'email'    => ['required', 'email', 'unique:users,email,' . $user->id],
            'password' => ['nullable', 'confirmed', Rules\Password::defaults()],
        ]);

        $user->name  = $request->name;
        $user->email = $request->email;
        // Role tidak di-update karena admin tidak berhak menaikkan pangkat user menjadi admin

        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        $user->save();

        return redirect()->route('admin.users.index')
            ->with('success', 'Data user berhasil diperbarui.');
    }

    // DELETE — Hapus user
    public function destroy(User $user)
    {
        abort_if($user->role !== 'user', 403, 'Anda hanya bisa menghapus akun User biasa.');
        $user->delete();

        return back()->with('success', 'Akun berhasil dihapus.');
    }
}
