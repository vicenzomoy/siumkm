{{-- <x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required
                autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required
                autocomplete="current-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Remember Me -->
        <div class="block mt-4">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox"
                    class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" name="remember">
                <span class="ms-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
            </label>
        </div>

        <div class="flex items-center justify-end mt-4">
            @if (Route::has('password.request'))
                <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                    href="{{ route('password.request') }}">
                    {{ __('Forgot your password?') }}
                </a>
            @endif

            <x-primary-button class="ms-3">
                {{ __('Log in') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout> --}}


<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Log in - Keuangan UMKM</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap"
        rel="stylesheet">

    <style>
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            color: #2d3748;
            background: linear-gradient(135deg, #fdfbfb 0%, #ebedee 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            position: relative;
            overflow: hidden;
        }

        .hero-blob {
            position: absolute;
            background: linear-gradient(135deg, #0d6efd20, #003d9920);
            border-radius: 50%;
            filter: blur(60px);
            z-index: 0;
        }

        .bento-card {
            background: white;
            border-radius: 28px;
            border: 1px solid rgba(0, 0, 0, 0.03);
            box-shadow: 0 15px 50px rgba(0, 0, 0, 0.06);
            position: relative;
            z-index: 1;
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
    </style>
</head>

<body>
    <div class="hero-blob" style="width: 500px; height: 500px; top: -150px; left: -100px;"></div>
    <div class="hero-blob"
        style="width: 400px; height: 400px; bottom: -100px; right: -50px; background: linear-gradient(135deg, #f59e0b20, #ea580c20);">
    </div>

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
                        <h4 class="fw-bold mb-2">Selamat Datang Kembali! 👋</h4>
                        <p class="text-muted small">Silakan masuk ke akun Anda untuk mengelola keuangan.</p>
                    </div>

                    @if (session('status'))
                        <div class="alert alert-success rounded-3 small">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="mb-3">
                            <label for="email" class="form-label fw-semibold small">Email</label>
                            <input id="email" type="email"
                                class="form-control @error('email') is-invalid @enderror" name="email"
                                value="{{ old('email') }}" required autofocus autocomplete="username"
                                placeholder="nama@email.com">
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="password" class="form-label fw-semibold small">Password</label>
                            <input id="password" type="password"
                                class="form-control @error('password') is-invalid @enderror" name="password" required
                                autocomplete="current-password" placeholder="Masukkan password Anda">
                            @error('password')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="d-flex justify-content-between align-items-center mb-4">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="remember" id="remember_me">
                                <label class="form-check-label text-muted small" for="remember_me">
                                    Ingat saya
                                </label>
                            </div>
                            @if (Route::has('password.request'))
                                <a href="{{ route('password.request') }}"
                                    class="text-decoration-none small text-primary fw-medium">Lupa Password?</a>
                            @endif
                        </div>

                        <button type="submit"
                            class="btn btn-primary w-100 rounded-pill py-2 fw-semibold shadow-sm mb-3">
                            Log in
                        </button>

                        <div class="text-center mt-3 text-muted small">
                            Belum punya akun? <a href="{{ route('register') }}"
                                class="text-primary fw-bold text-decoration-none">Daftar Sekarang</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
