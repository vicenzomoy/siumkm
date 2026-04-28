<?php

namespace App\Http\Controllers;

use App\Models\User;

class AdminController extends Controller
{
    // Menampilkan daftar user
    public function dashboard()
    {
        $users = User::all();
        return view('admin.dashboard', compact('users'));
    }
}
