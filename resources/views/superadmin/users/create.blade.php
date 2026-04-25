<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            <i class="fas fa-user-plus me-2"></i>{{ __('Registrasi Akun Baru') }}
        </h2>
    </x-slot>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />

    <div class="py-12">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-6">
                    <div class="card border-0 shadow-lg rounded-4 p-4 p-md-5 bg-white">
                        <div class="text-center mb-4">
                            <h4 class="fw-bold">Buat Akses Pengguna</h4>
                            <p class="text-muted small">Tentukan hak akses dan identitas pengguna baru</p>
                        </div>

                        @if ($errors->any())
                            <div class="alert alert-danger small rounded-3 border-0">
                                <ul class="mb-0">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <form method="POST" action="{{ route('superadmin.users.store') }}">
                            @csrf
                            <div class="mb-3">
                                <label class="form-label fw-bold small">Nama Lengkap</label>
                                <input type="text" name="name" class="form-control rounded-3"
                                    value="{{ old('name') }}" placeholder="Contoh: Admin" required>
                            </div>

                            <div class="mb-3">
                                <label class="form-label fw-bold small">Alamat Email</label>
                                <input type="email" name="email" class="form-control rounded-3"
                                    value="{{ old('email') }}" placeholder="email@contoh.com" required>
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label fw-bold small">Password</label>
                                    <input type="password" name="password" class="form-control rounded-3" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label fw-bold small">Konfirmasi Password</label>
                                    <input type="password" name="password_confirmation" class="form-control rounded-3"
                                        required>
                                </div>
                            </div>

                            <div class="mb-4">
                                <label class="form-label fw-bold small text-primary">Pilih Role / Hak Akses</label>
                                <select name="role" class="form-select rounded-3 border-primary-subtle">
                                    <option value="user" {{ old('role') == 'user' ? 'selected' : '' }}>User (Pemilik
                                        UMKM)</option>
                                    <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>Admin (Staff)
                                    </option>
                                </select>
                            </div>

                            <button type="submit" class="btn btn-primary w-100 rounded-pill py-2 fw-bold shadow">
                                <i class="fas fa-check-circle me-2"></i>Daftarkan Akun
                            </button>
                        </form>

                        <div class="text-center mt-4">
                            <a href="{{ route('superadmin.users.index') }}"
                                class="text-muted small text-decoration-none">← Kembali ke Daftar</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
