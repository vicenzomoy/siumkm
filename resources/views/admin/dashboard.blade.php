<x-app-layout>
    {{-- <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            <i class="fas fa-user-shield me-2"></i>{{ __('Admin Panel Dashboard') }}
        </h2>
    </x-slot> --}}

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />

    <style>
        .card-stat {
            border: none;
            border-radius: 15px;
            transition: transform 0.3s;
        }

        .card-stat:hover {
            transform: translateY(-5px);
        }

        .icon-shape {
            width: 48px;
            height: 48px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 12px;
        }

        .bg-soft-primary {
            background-color: #e7f1ff;
            color: #0d6efd;
        }
    </style>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="row g-4 mb-4">
                <div class="col-12">
                    <div class="card card-stat shadow-sm p-4 bg-white">
                        <div class="d-flex align-items-center">
                            <div class="icon-shape bg-soft-primary me-3">
                                <i class="fas fa-hand"></i>
                            </div>
                            <div>
                                <h4 class="mb-0 fw-bold">Selamat Datang kembali, {{ auth()->user()->name }}!</h4>
                                <p class="text-muted mb-0">Anda masuk sebagai <span
                                        class="badge bg-success rounded-pill">Admin</span></p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-6 col-lg-4">
                    <div class="card card-stat shadow-sm p-4 bg-white border-start border-primary border-5">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h6 class="text-muted mb-1">Total Pengguna UMKM</h6>
                                <h3 class="mb-0 fw-bold">{{ \App\Models\User::where('role', 'user')->count() }}</h3>
                            </div>
                            <div class="icon-shape bg-soft-primary">
                                <i class="fas fa-users"></i>
                            </div>
                        </div>
                        <a href="{{ route('admin.users.index') }}"
                            class="btn btn-link text-decoration-none p-0 mt-3 small">Kelola User <i
                                class="fas fa-arrow-right ms-1"></i></a>
                    </div>
                </div>
            </div>

            <div class="card border-0 shadow-sm rounded-4 p-4">
                <h5 class="fw-bold mb-3"><i class="fas fa-rocket me-2 text-primary"></i>Aksi Cepat</h5>
                <div class="d-flex gap-2">
                    <a href="{{ route('admin.users.create') }}" class="btn btn-primary px-4 rounded-pill">
                        <i class="fas fa-plus me-2"></i>Daftarkan UMKM Baru
                    </a>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</x-app-layout>
