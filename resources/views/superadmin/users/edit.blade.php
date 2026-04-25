<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            <i class="fas fa-user-edit me-2 text-warning"></i>{{ __('Edit Master Akun') }}
        </h2>
    </x-slot>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />

    <style>
        .card-edit {
            border: none;
            border-radius: 20px;
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.1);
        }

        .form-label {
            font-weight: 700;
            color: #374151;
            font-size: 0.85rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .form-control,
        .form-select {
            border-radius: 12px;
            padding: 0.75rem 1rem;
            border: 1px solid #d1d5db;
            background-color: #f9fafb;
        }

        .form-control:focus,
        .form-select:focus {
            background-color: #fff;
            box-shadow: 0 0 0 4px rgba(255, 193, 7, 0.15);
            border-color: #ffc107;
        }

        .btn-save {
            padding: 0.8rem;
            border-radius: 15px;
            font-weight: 800;
            text-transform: uppercase;
            letter-spacing: 1px;
            transition: all 0.3s;
        }

        .btn-save:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 20px rgba(255, 193, 7, 0.4);
        }

        .input-group-text {
            background-color: #f3f4f6;
            border-right: none;
            border-radius: 12px 0 0 12px;
            color: #6b7280;
        }

        .input-with-icon {
            border-left: none;
            border-radius: 0 12px 12px 0;
        }

        .role-badge-info {
            background-color: #fff3cd;
            border: 1px solid #ffe69c;
            color: #854d0e;
            padding: 10px;
            border-radius: 12px;
        }
    </style>

    <div class="py-12">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-7 col-lg-6">

                    <nav aria-label="breadcrumb" class="mb-4">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('superadmin.users.index') }}"
                                    class="text-decoration-none">Manajemen User</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Edit Akun</li>
                        </ol>
                    </nav>

                    <div class="card card-edit p-4 p-md-5 bg-white">
                        <div class="text-center mb-5">
                            <div class="bg-warning-subtle text-warning rounded-4 d-inline-flex align-items-center justify-content-center mb-3"
                                style="width: 70px; height: 70px;">
                                <i class="fas fa-user-cog fa-2x"></i>
                            </div>
                            <h3 class="fw-bold mb-1">Modifikasi Akun</h3>
                            <p class="text-muted small">Sedang menyunting data: <strong>{{ $user->name }}</strong></p>
                        </div>

                        @if ($errors->any())
                            <div class="alert alert-danger border-0 shadow-sm rounded-4 mb-4">
                                <ul class="mb-0 small fw-bold">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <form method="POST" action="{{ route('superadmin.users.update', $user) }}">
                            @csrf
                            @method('PUT')

                            <div class="row">
                                <div class="col-12 mb-4">
                                    <label class="form-label">Identitas Nama</label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="fas fa-id-card"></i></span>
                                        <input type="text" name="name" class="form-control input-with-icon"
                                            value="{{ old('name', $user->name) }}" required>
                                    </div>
                                </div>

                                <div class="col-12 mb-4">
                                    <label class="form-label">Alamat Email Resmi</label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="fas fa-envelope-open-text"></i></span>
                                        <input type="email" name="email" class="form-control input-with-icon"
                                            value="{{ old('email', $user->email) }}" required>
                                    </div>
                                </div>

                                <div class="col-12 mb-4">
                                    <div class="role-badge-info mb-3">
                                        <label class="form-label mb-2 d-block"><i class="fas fa-user-shield me-1"></i>
                                            Otoritas Hak Akses</label>
                                        <select name="role" class="form-select border-warning-subtle shadow-sm">
                                            <option value="user"
                                                {{ old('role', $user->role) == 'user' ? 'selected' : '' }}>USER (Pemilik
                                                UMKM)</option>
                                            <option value="admin"
                                                {{ old('role', $user->role) == 'admin' ? 'selected' : '' }}>ADMIN
                                                (Staff)</option>
                                        </select>
                                        <small class="mt-2 d-block text-muted" style="font-size: 0.75rem;">
                                            * Perubahan role akan langsung berdampak pada dashboard yang diakses
                                            pengguna.
                                        </small>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="d-flex align-items-center mb-3">
                                        <hr class="flex-grow-1 opacity-25">
                                        <span class="mx-3 small text-muted fw-bold">PENGATURAN KEAMANAN</span>
                                        <hr class="flex-grow-1 opacity-25">
                                    </div>
                                </div>

                                <div class="col-md-6 mb-4">
                                    <label class="form-label">Password Baru</label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="fas fa-key"></i></span>
                                        <input type="password" name="password" class="form-control input-with-icon"
                                            placeholder="Minimal 8 karakter">
                                    </div>
                                </div>

                                <div class="col-md-6 mb-4">
                                    <label class="form-label">Konfirmasi</label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="fas fa-check-double"></i></span>
                                        <input type="password" name="password_confirmation"
                                            class="form-control input-with-icon" placeholder="Ulangi password">
                                    </div>
                                </div>
                            </div>

                            <div class="alert bg-light border-0 rounded-4 mb-4">
                                <small class="text-muted d-flex align-items-center">
                                    <i class="fas fa-info-circle me-2 text-warning"></i>
                                    Biarkan kolom password kosong jika tidak ingin mengubah kredensial akses.
                                </small>
                            </div>

                            <button type="submit" class="btn btn-warning btn-save w-100 shadow-sm text-dark">
                                <i class="fas fa-save me-2"></i> Simpan Seluruh Perubahan
                            </button>
                        </form>
                    </div>

                    <div class="text-center mt-4">
                        <a href="{{ route('superadmin.users.index') }}"
                            class="btn btn-link text-muted text-decoration-none small">
                            <i class="fas fa-times me-1"></i> Batalkan dan Kembali
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</x-app-layout>
