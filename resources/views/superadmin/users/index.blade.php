<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <title>Manajemen User</title>
    <style>
        body {
            font-family: sans-serif;
            padding: 2rem;
            background: #f3f4f6;
        }

        .card {
            background: white;
            padding: 2rem;
            border-radius: 8px;
            max-width: 800px;
            margin: auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 1rem;
        }

        th,
        td {
            padding: 0.75rem;
            border: 1px solid #e5e7eb;
            text-align: left;
        }

        th {
            background: #f9fafb;
        }

        .badge-user {
            background: #dbeafe;
            color: #1d4ed8;
            padding: 2px 10px;
            border-radius: 999px;
            font-size: 0.8rem;
        }

        .badge-admin {
            background: #dcfce7;
            color: #15803d;
            padding: 2px 10px;
            border-radius: 999px;
            font-size: 0.8rem;
        }

        a.btn {
            background: #ef4444;
            color: white;
            padding: 0.5rem 1rem;
            border-radius: 6px;
            text-decoration: none;
        }

        .success {
            color: green;
            margin-bottom: 1rem;
        }
    </style>
</head>

<body>
    <div class="card">
        <h2>Manajemen User & Admin</h2>

        @if (session('success'))
            <p class="success">{{ session('success') }}</p>
        @endif

        <a class="btn" href="{{ route('superadmin.users.create') }}">+ Buat Akun Baru</a>

        <table>
            <thead>
                <tr>
                    <th>Nama</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
                    <tr>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>
                            <span class="badge-{{ $user->role }}">{{ $user->role }}</span>
                        </td>
                        <td>
                            <form method="POST" action="{{ route('superadmin.users.destroy', $user) }}"
                                onsubmit="return confirm('Hapus akun ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" style="color:red; border:none; background:none; cursor:pointer;">
                                    Hapus
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        {{ $users->links() }}

        <br>
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit">Logout</button>
        </form>
    </div>
</body>

</html>
