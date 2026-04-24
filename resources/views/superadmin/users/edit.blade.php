<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <title>Edit User</title>
</head>

<body>
    <h2>Edit User — {{ $user->name }}</h2>

    @if ($errors->any())
        <ul style="color:red">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    @endif

    <form method="POST" action="{{ route('superadmin.users.update', $user) }}">
        @csrf
        @method('PUT')

        <label>Nama</label><br>
        <input type="text" name="name" value="{{ old('name', $user->name) }}" required><br><br>

        <label>Email</label><br>
        <input type="email" name="email" value="{{ old('email', $user->email) }}" required><br><br>

        <label>Role</label><br>
        <select name="role">
            <option value="user" {{ old('role', $user->role) == 'user' ? 'selected' : '' }}>User</option>
            <option value="admin" {{ old('role', $user->role) == 'admin' ? 'selected' : '' }}>Admin</option>
        </select><br><br>

        <label>Password Baru (kosongkan jika tidak diubah)</label><br>
        <input type="password" name="password"><br><br>

        <label>Konfirmasi Password Baru</label><br>
        <input type="password" name="password_confirmation"><br><br>

        <button type="submit">Simpan Perubahan</button>
    </form>

    <a href="{{ route('superadmin.users.index') }}">← Kembali</a>
</body>

</html>
