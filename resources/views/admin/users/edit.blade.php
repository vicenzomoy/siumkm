<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            <i class="fas fa-user-edit me-2"></i>{{ __('Edit Data Pemilik UMKM') }}
        </h2>
    </x-slot>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />

    <style>
        .card-form {
            border: none;
            border-radius: 20px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.05);
        }

        .form-label {
            font-weight: 600;
            color: #4b5563;
            font-size: 0.9rem;
        }

        .form-control {
            border-radius: 10px;
            padding: 0.6rem 1rem;
            border: 1px solid #e5e7eb;
        }

        .form-control:focus {
            box-shadow: 0 0 0 4px rgba(13, 110, 253, 0.1);
            border-color: #0d6efd;
        }

        .btn-update {
            padding: 0.75rem;
            border-radius: 12px;
            font-weight: 700;
            transition: all 0.3s;
        }

        .btn-update:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(13, 110, 253, 0.3);
        }

        .input-group-text {
            background-color: #f9fafb;
            border-right: none;
            border-radius: 10px 0 0 10px;
            color: #9ca3af;
        }

        .form-control-with-icon {
            border-left: none;
            border-radius: 0 10px 10px 0;
        }
    </style>

    <div class="py-12">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-6 col-lg-5">

                    <div class="mb-4">
                        <a href="{{ route('admin.users.index') }}"
                            class="text-decoration-none text-muted small fw-bold">
                            <i class="fas fa-arrow-left me-1"></i> Kembali ke Daftar User
                        </a>
                    </div>

                    <div class="card card-form p-4 p-md-5 bg-white">
                        <div class="text-center mb-4">
                            <div class="bg-primary-subtle text-primary rounded-circle d-inline-flex align-items-center justify-content-center mb-3"
                                style="width: 60px; height: 60px;">
                                <i class="fas fa-user-circle fa-2x"></i>
                            </div>
                            <h4 class="fw-bold mb-1">Perbarui Profil</h4>
                            <p class="text-muted small">ID Pengguna: #{{ str_pad($user->id, 4, '0', STR_PAD_LEFT) }}</p>
                        </div>

                        @if ($errors->any())
                            <div class="alert alert-danger border-0 shadow-sm rounded-3">
                                <ul class="mb-0 small">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <form method="POST" action="{{ route('admin.users.update', $user) }}">
                            @csrf
                            @method('PUT')

                            <div class="mb-3">
                                <label class="form-label">Nama Lengkap / UMKM</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fas fa-user"></i></span>
                                    <input type="text" name="name" class="form-control form-control-with-icon"
                                        value="{{ old('name', $user->name) }}" required>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Alamat Email</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                                    <input type="email" name="email" class="form-control form-control-with-icon"
                                        value="{{ old('email', $user->email) }}" required>
                                </div>
                            </div>

                            <hr class="my-4 text-muted opacity-25">

                            <div class="bg-light p-3 rounded-3 mb-4">
                                <p class="small text-muted mb-0">
                                    <i class="fas fa-info-circle me-1 text-primary"></i>
                                    Kosongkan kolom di bawah jika tidak ingin mengubah kata sandi.
                                </p>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Kata Sandi Baru</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fas fa-lock"></i></span>
                                    <input type="password" name="password" class="form-control form-control-with-icon"
                                        placeholder="isi password">
                                </div>
                            </div>

                            <div class="mb-4">
                                <label class="form-label">Konfirmasi Kata Sandi</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fas fa-lock"></i></span>
                                    <input type="password" name="password_confirmation"
                                        class="form-control form-control-with-icon" placeholder="isi password">
                                </div>
                            </div>

                            <button type="submit" class="btn btn-primary btn-update w-100 shadow-sm">
                                <i class="fas fa-save me-2"></i> Simpan Perubahan
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
