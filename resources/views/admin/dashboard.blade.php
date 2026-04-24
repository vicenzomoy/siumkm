<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <title>Admin Dashboard</title>
    <style>
        body {
            font-family: sans-serif;
            background: #f3f4f6;
            padding: 2rem;
        }

        .card {
            background: white;
            padding: 2rem;
            border-radius: 8px;
            max-width: 600px;
            margin: auto;
        }

        .badge {
            background: #dcfce7;
            color: #15803d;
            padding: 2px 12px;
            border-radius: 999px;
            font-size: 0.875rem;
        }

        button {
            margin-top: 1.5rem;
            padding: 0.5rem 1rem;
            background: #ef4444;
            color: white;
            border: none;
            border-radius: 6px;
            cursor: pointer;
        }
    </style>
</head>

<body>
    <div class="card">
        <h1>Dashboard Admin</h1>
        <p>Selamat datang, <strong>{{ auth()->user()->name }}</strong></p>
        <p>Role: <span class="badge">{{ auth()->user()->role }}</span></p>
        <p>Email: {{ auth()->user()->email }}</p>
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit">Logout</button>
        </form>
    </div>
</body>

</html>
