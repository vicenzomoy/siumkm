<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <title>Detail User UMKM</title>
</head>

<body>
    <h2>Detail UMKM</h2>
    <p><strong>Nama:</strong> {{ $user->name }}</p>
    <p><strong>Email:</strong> {{ $user->email }}</p>
    <p><strong>Didaftarkan pada:</strong> {{ $user->created_at->format('d M Y, H:i') }}</p>

    <a href="{{ route('admin.users.edit', $user) }}">Edit Akun</a> |
    <a href="{{ route('admin.users.index') }}">← Kembali</a>
</body>

</html>
