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
}
