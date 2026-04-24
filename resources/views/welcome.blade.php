<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Keuangan UMKM - Kelola Bisnis Lebih Mudah</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap"
        rel="stylesheet">
    <link href="{{ asset('css/welcome.css') }}" rel="stylesheet">
</head>

<body>
    @php
        // Menentukan URL Dashboard berdasarkan Role jika user sudah login
        $dashboardUrl = '';
        if (auth()->check()) {
            $role = auth()->user()->role; // Sesuaikan dengan nama kolom role di table users Anda

            if ($role === 'superadmin') {
                $dashboardUrl = route('superadmin.dashboard');
            } elseif ($role === 'admin') {
                $dashboardUrl = route('admin.dashboard');
            } else {
                $dashboardUrl = route('user.dashboard');
            }
        }
    @endphp

    <nav class="navbar navbar-expand-lg navbar-light fixed-top py-3">
        <div class="container">
            <a class="navbar-brand fw-bold fs-4 text-primary" href="#">
                <i class="fas fa-wallet me-2"></i>SI UMKM
            </a>
            <button class="navbar-toggler border-0 shadow-none" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto align-items-center gap-2">
                    @if (Route::has('login'))
                        @auth
                            <li class="nav-item">
                                <a href="{{ $dashboardUrl }}" class="btn btn-primary rounded-pill px-4 fw-semibold">Masuk
                                    Dashboard</a>
                            </li>
                        @else
                            <li class="nav-item">
                                <a href="{{ route('login') }}" class="nav-link fw-semibold text-dark px-3">Log in</a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a href="{{ route('register') }}"
                                        class="btn btn-dark rounded-pill px-4 fw-semibold shadow-sm">Daftar Sekarang</a>
                                </li>
                            @endif
                        @endauth
                    @endif
                </ul>
            </div>
        </div>
    </nav>

    @if (session('error'))
        <div class="alert alert-danger alert-dismissible fade show text-center m-0 position-relative"
            style="z-index: 1050; border-radius: 0; margin-top: 76px !important;" role="alert">
            <i class="fas fa-exclamation-circle me-2"></i> {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <header class="hero-section">
        <div class="hero-blob" style="width: 400px; height: 400px; top: -100px; left: -100px;"></div>
        <div class="hero-blob"
            style="width: 300px; height: 300px; bottom: 0; right: -50px; background: linear-gradient(135deg, #f59e0b20, #ea580c20);">
        </div>

        <div class="container hero-content text-center">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <span
                        class="badge bg-primary bg-opacity-10 text-primary rounded-pill px-3 py-2 mb-4 fw-semibold border border-primary-subtle">
                        🚀 Solusi Keuangan Pintar
                    </span>
                    <h1 class="display-4 fw-bold mb-4 text-dark" style="letter-spacing: -1px;">
                        Kelola Keuangan UMKM <br><span class="text-primary">Tanpa Ribet</span>
                    </h1>
                    <p class="lead mb-5 text-muted px-md-5">Pencatatan arus kas yang sederhana, cepat, dan aman. Fokus
                        kembangkan bisnis Anda, biarkan kami yang mengurus angkanya.</p>

                    <div class="d-flex justify-content-center gap-3">
                        @guest
                            <a href="{{ route('register') }}"
                                class="btn btn-primary btn-lg rounded-pill px-5 fw-semibold shadow-sm">Mulai Gratis</a>
                            <a href="#fitur" class="btn btn-outline-dark btn-lg rounded-pill px-4 fw-semibold">Lihat
                                Fitur</a>
                        @else
                            <a href="{{ $dashboardUrl }}"
                                class="btn btn-primary btn-lg rounded-pill px-5 fw-semibold shadow-sm">Kembali ke
                                Dashboard</a>
                        @endguest
                    </div>
                </div>
            </div>
        </div>
    </header>

    <section id="fitur" class="py-5">
        <div class="container py-5">
            <div class="text-center mb-5">
                <h2 class="fw-bold mb-3" style="letter-spacing: -0.5px;">Dirancang untuk Produktivitas</h2>
                <p class="text-muted">Fitur lengkap yang didesain khusus untuk kebutuhan pengusaha kecil.</p>
            </div>

            <div class="row g-4">
                <div class="col-md-4">
                    <div class="bento-card p-4 p-md-5">
                        <div class="feature-icon bg-primary bg-opacity-10 text-primary"><i class="fas fa-bolt"></i>
                        </div>
                        <h4 class="fw-bold mb-3">Pencatatan Kilat</h4>
                        <p class="text-muted mb-0">Input pemasukan dan pengeluaran hanya dalam hitungan detik dengan
                            format Rupiah otomatis yang anti-salah.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="bento-card p-4 p-md-5">
                        <div class="feature-icon bg-success bg-opacity-10 text-success"><i class="fas fa-chart-pie"></i>
                        </div>
                        <h4 class="fw-bold mb-3">Grafik Visual</h4>
                        <p class="text-muted mb-0">Pantau kesehatan finansial lewat visualisasi Doughnut chart
                            interaktif yang mudah dipahami sekilas.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="bento-card p-4 p-md-5">
                        <div class="feature-icon bg-warning bg-opacity-10 text-warning"><i class="fas fa-lock"></i>
                        </div>
                        <h4 class="fw-bold mb-3">Privasi Data</h4>
                        <p class="text-muted mb-0">Tenang, data finansial Anda diamankan dengan enkripsi standar
                            industri dan manajemen sesi pintar.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <footer class="py-4 mt-5">
        <div class="container text-center text-muted">
            <small class="fw-medium">&copy; {{ date('Y') }} SI UMKM. Dibuat untuk pertumbuhan bisnis Anda.</small>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
