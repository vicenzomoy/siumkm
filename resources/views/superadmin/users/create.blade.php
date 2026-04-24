<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <title>Buat Akun Baru</title>
    <style>
        body {
            font-family: sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            background: #f3f4f6;
            margin: 0;
        }

        .card {
            background: white;
            padding: 2rem;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 420px;
        }

        h2 {
            margin: 0 0 1.5rem;
        }

        label {
            display: block;
            margin-bottom: 0.25rem;
            font-size: 0.875rem;
            color: #374151;
        }

        input,
        select {
            width: 100%;
            padding: 0.5rem 0.75rem;
            border: 1px solid #d1d5db;
            border-radius: 6px;
            font-size: 1rem;
            box-sizing: border-box;
            margin-bottom: 1rem;
        }

        button {
            width: 100%;
            padding: 0.6rem;
            background: #ef4444;
            color: white;
            border: none;
            border-radius: 6px;
            font-size: 1rem;
            cursor: pointer;
        }

        .error {
            color: #dc2626;
            font-size: 0.875rem;
            margin-bottom: 1rem;
        }

        a {
            color: #6b7280;
            font-size: 0.875rem;
        }
    </style>
</head>

<body>
    <div class="card">
        <h2>Buat Akun User / Admin</h2>

        @if ($errors->any())
            <div class="error">
                @foreach ($errors->all() as $error)
                    <p>{{ $error }}</p>
                @endforeach
            </div>
        @endif

        <form method="POST" action="{{ route('superadmin.users.store') }}">
            @csrf

            <label>Nama</label>
            <input type="text" name="name" value="{{ old('name') }}" required>

            <label>Email</label>
            <input type="email" name="email" value="{{ old('email') }}" required>

            <label>Password</label>
            <input type="password" name="password" required>

            <label>Konfirmasi Password</label>
            <input type="password" name="password_confirmation" required>

            <label>Role</label>
            <select name="role">
                <option value="user" {{ old('role') == 'user' ? 'selected' : '' }}>User</option>
                <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>Admin</option>
            </select>

            <button type="submit">Buat Akun</button>
        </form>

        <br>
        <a href="{{ route('superadmin.users.index') }}">← Kembali ke daftar user</a>
    </div>
</body>

</html>
