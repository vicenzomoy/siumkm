<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    // Menampilkan daftar user
    public function dashboard()
    {
        $users = User::all();
        return view('admin.dashboard', compact('users'));
    }

    // Menghapus user
    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->back()->with('success', 'User berhasil dihapus.');
    }

    // Menampilkan form edit (Opsional: bisa menggunakan modal di dashboard)
    public function edit(User $user)
    {
        return view('admin.edit_user', compact('user'));
    }

    // Update data user
    public function update(Request $request, User $user)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
        ]);

        $user->update($data);
        return redirect()->route('admin.dashboard')->with('success', 'User berhasil diperbarui.');
    }
}
