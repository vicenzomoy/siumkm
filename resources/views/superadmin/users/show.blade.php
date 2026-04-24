<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <title>Detail User</title>
</head>

<body>
    <h2>Detail User</h2>
    <p><strong>Nama:</strong> {{ $user->name }}</p>
    <p><strong>Email:</strong> {{ $user->email }}</p>
    <p><strong>Role:</strong> {{ $user->role }}</p>
    <p><strong>Dibuat:</strong> {{ $user->created_at->format('d M Y, H:i') }}</p>
    <p><strong>Diperbarui:</strong> {{ $user->updated_at->format('d M Y, H:i') }}</p>

    <a href="{{ route('superadmin.users.edit', $user) }}">Edit</a> |
    <a href="{{ route('superadmin.users.index') }}">← Kembali</a>
</body>

</html>
