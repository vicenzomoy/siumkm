<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\SuperAdminController;
use App\Http\Controllers\SuperAdmin\UserManagementController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth', 'prevent-back-history'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Route untuk User biasa
Route::middleware(['auth', 'role:user', 'prevent-back-history'])->group(function () {
    // Dashboard menggunakan TransactionController
    Route::get('/user/dashboard', [TransactionController::class, 'index'])->name('user.dashboard');

    // CRUD Transaksi
    Route::post('/transactions', [TransactionController::class, 'store'])->name('transactions.store');
    Route::put('/transactions/{transaction}', [TransactionController::class, 'update'])->name('transactions.update');
    Route::delete('/transactions/{transaction}', [TransactionController::class, 'destroy'])->name('transactions.destroy');
});

// Route untuk Admin
Route::middleware(['auth', 'role:admin', 'prevent-back-history'])->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
});

// Route untuk Super Admin + CRUD user management
Route::middleware(['auth', 'role:superadmin', 'prevent-back-history'])->prefix('superadmin')->name('superadmin.')->group(function () {
    Route::get('/dashboard', [SuperAdminController::class, 'dashboard'])->name('dashboard');
    Route::resource('users', UserManagementController::class); // CRUD lengkap
});

// Route yang bisa diakses Admin DAN Super Admin
Route::middleware(['auth', 'role:admin,superadmin', 'prevent-back-history'])->group(function () {
    Route::get('/laporan', function () {
        return view('laporan');
    })->name('laporan');
});

require __DIR__ . '/auth.php';
