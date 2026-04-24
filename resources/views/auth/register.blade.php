<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Daftar - Keuangan UMKM</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap"
        rel="stylesheet">

    <style>
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            color: #2d3748;
            /* Gunakan background-attachment agar gradient tetap diam saat di-scroll */
            background: linear-gradient(135deg, #fdfbfb 0%, #ebedee 100%);
            background-attachment: fixed;

            min-height: 100vh;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            position: relative;
            overflow-x: hidden;
            padding: 60px 0;
            margin: 0;
            /* Pastikan tidak ada margin default browser */
        }

        .hero-blob {
            position: absolute;
            background: linear-gradient(135deg, #0d6efd20, #003d9920);
            border-radius: 50%;
            filter: blur(60px);
            z-index: 0;
            pointer-events: none;
            /* Agar tidak menghalangi klik pada form */
        }

        .bento-card {
            background: white;
            border-radius: 28px;
            border: 1px solid rgba(0, 0, 0, 0.03);
            box-shadow: 0 15px 50px rgba(0, 0, 0, 0.06);
            position: relative;
            z-index: 1;
            width: 100%;
            /* Pastikan card mengambil lebar penuh kolom */
        }

        .form-control {
            border-radius: 14px;
            padding: 0.8rem 1.25rem;
            border: 1px solid #e2e8f0;
            background-color: #f8f9fa;
        }

        .form-control:focus {
            background-color: #ffffff;
            border-color: #0d6efd;
            box-shadow: 0 0 0 0.25rem rgba(13, 110, 253, 0.15);
        }

        /* Tambahan untuk responsivitas mobile */
        @media (max-width: 576px) {
            body {
                padding: 30px 15px;
            }

            .bento-card {
                padding: 1.5rem !important;
            }
        }
    </style>
</head>

<body>
    <div class="hero-blob"
        style="width: 500px; height: 500px; top: -100px; right: -100px; background: linear-gradient(135deg, #f59e0b20, #ea580c20);">
    </div>
    <div class="hero-blob" style="width: 400px; height: 400px; bottom: -50px; left: -50px;"></div>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6 col-lg-5">
                <div class="text-center mb-4 position-relative" style="z-index: 1;">
                    <a href="{{ url('/') }}" class="text-decoration-none fw-bold fs-3 text-primary">
                        <i class="fas fa-wallet me-2"></i>SI UMKM
                    </a>
                </div>

                <div class="bento-card p-4 p-md-5">
                    <div class="text-center mb-4">
                        <h4 class="fw-bold mb-2">Mulai Perjalanan Anda 🚀</h4>
                        <p class="text-muted small">Buat akun untuk mulai mengelola keuangan bisnis dengan mudah.</p>
                    </div>

                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="mb-3">
                            <label for="name" class="form-label fw-semibold small">Nama Lengkap</label>
                            <input id="name" type="text"
                                class="form-control @error('name') is-invalid @enderror" name="name"
                                value="{{ old('name') }}" required autofocus autocomplete="name"
                                placeholder="Nama Bisnis / Anda">
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="email" class="form-label fw-semibold small">Email</label>
                            <input id="email" type="email"
                                class="form-control @error('email') is-invalid @enderror" name="email"
                                value="{{ old('email') }}" required autocomplete="username"
                                placeholder="nama@email.com">
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="password" class="form-label fw-semibold small">Password</label>
                            <input id="password" type="password"
                                class="form-control @error('password') is-invalid @enderror" name="password" required
                                autocomplete="new-password" placeholder="Buat password yang kuat">
                            @error('password')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="password_confirmation" class="form-label fw-semibold small">Konfirmasi
                                Password</label>
                            <input id="password_confirmation" type="password"
                                class="form-control @error('password_confirmation') is-invalid @enderror"
                                name="password_confirmation" required autocomplete="new-password"
                                placeholder="Ketik ulang password">
                            @error('password_confirmation')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-dark w-100 rounded-pill py-2 fw-semibold shadow-sm mb-3">
                            Daftar Sekarang
                        </button>

                        <div class="text-center mt-3 text-muted small">
                            Sudah punya akun? <a href="{{ route('login') }}"
                                class="text-primary fw-bold text-decoration-none">Log in di sini</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
