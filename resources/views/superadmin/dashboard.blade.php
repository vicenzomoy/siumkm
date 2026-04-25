<x-app-layout>
    {{-- <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            <i class="fas fa-user-crown me-2 text-warning"></i>{{ __('Super Admin Central Control') }}
        </h2>
    </x-slot> --}}

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />

    <style>
        .card-overview {
            border: none;
            border-radius: 20px;
            transition: all 0.3s;
        }

        .card-overview:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.1) !important;
        }

        .icon-box {
            width: 55px;
            height: 55px;
            border-radius: 15px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 24px;
        }

        .bg-soft-warning {
            background-color: #fff3cd;
            color: #854d0e;
        }

        .bg-soft-success {
            background-color: #d1e7dd;
            color: #0f5132;
        }

        .bg-soft-primary {
            background-color: #cfe2ff;
            color: #084298;
        }
    </style>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="card card-overview shadow-sm p-4 bg-white mb-4 border-0">
                <div class="d-flex align-items-center">
                    <div class="icon-box bg-soft-warning me-3">
                        <i class="fas fa-shield"></i>
                    </div>
                    <div>
                        <h4 class="mb-0 fw-bold">Sistem Operasional Utama</h4>
                        <p class="text-muted mb-0">Selamat bekerja, <strong>{{ auth()->user()->name }}</strong>. Semua
                            sistem terpantau normal.</p>
                    </div>
                </div>
            </div>

            <div class="row g-4 mb-4">
                <div class="col-md-4">
                    <div class="card card-overview shadow-sm p-4 bg-white border-start border-success border-5">
                        <div class="d-flex justify-content-between">
                            <div>
                                <p class="text-muted small fw-bold mb-1">TOTAL ADMIN</p>
                                <h2 class="fw-bold mb-0">{{ \App\Models\User::where('role', 'admin')->count() }}</h2>
                            </div>
                            <div class="icon-box bg-soft-success">
                                <i class="fas fa-user-tie"></i>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card card-overview shadow-sm p-4 bg-white border-start border-primary border-5">
                        <div class="d-flex justify-content-between">
                            <div>
                                <p class="text-muted small fw-bold mb-1">TOTAL USER UMKM</p>
                                <h2 class="fw-bold mb-0">{{ \App\Models\User::where('role', 'user')->count() }}</h2>
                            </div>
                            <div class="icon-box bg-soft-primary">
                                <i class="fas fa-store"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card border-0 shadow-sm rounded-4 p-4">
                <h5 class="fw-bold mb-3"><i class="fas fa-tools me-2 text-primary"></i>Pusat Kendali Akun</h5>
                <p class="text-muted small">Kelola seluruh entitas pengguna sistem dalam satu pintu.</p>
                <div class="d-flex gap-2">
                    <a href="{{ route('superadmin.users.index') }}" class="btn btn-primary px-4 rounded-pill">
                        <i class="fas fa-users-cog me-2"></i>Kelola User & Admin
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
