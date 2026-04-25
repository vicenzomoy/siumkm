<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            <i class="fas fa-users-manage me-2"></i>{{ __('Manajemen Master Akun') }}
        </h2>
    </x-slot>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            @if (session('success'))
                <div class="alert alert-success border-0 shadow-sm rounded-3 mb-4" role="alert">
                    <i class="fas fa-check-double me-2"></i>{{ session('success') }}
                </div>
            @endif

            <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
                <div class="card-header bg-white py-3 border-0 d-flex justify-content-between align-items-center">
                    <h5 class="mb-0 fw-bold">Database Pengguna Sistem</h5>
                    <a href="{{ route('superadmin.users.create') }}" class="btn btn-dark btn-sm rounded-pill px-3">
                        <i class="fas fa-plus-circle me-1"></i>Buat Akun Baru
                    </a>
                </div>

                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="table-light">
                            <tr>
                                <th class="ps-4 border-0 small text-muted">IDENTITAS</th>
                                <th class="border-0 small text-muted">EMAIL</th>
                                <th class="border-0 small text-muted">HAK AKSES</th>
                                <th class="pe-4 border-0 text-center small text-muted">AKSI</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $user)
                                <tr>
                                    <td class="ps-4">
                                        <div class="d-flex align-items-center">
                                            <div class="rounded-circle bg-dark text-white d-flex align-items-center justify-content-center me-3"
                                                style="width: 38px; height: 38px;">
                                                <i
                                                    class="fas {{ $user->role === 'admin' ? 'fa-user-tie' : 'fa-store' }} small"></i>
                                            </div>
                                            <div>
                                                <a href="{{ route('superadmin.users.show', $user) }}"
                                                    class="fw-bold text-dark text-decoration-none d-block">{{ $user->name }}</a>
                                                <small class="text-muted">Bergabung:
                                                    {{ $user->created_at->format('d/m/y') }}</small>
                                            </div>
                                        </div>
                                    </td>
                                    <td>{{ $user->email }}</td>
                                    <td>
                                        <span
                                            class="badge rounded-pill {{ $user->role === 'admin' ? 'bg-success-subtle text-success border border-success-subtle' : 'bg-primary-subtle text-primary border border-primary-subtle' }} px-3">
                                            {{ strtoupper($user->role) }}
                                        </span>
                                    </td>
                                    <td class="pe-4 text-center">
                                        <div class="btn-group shadow-sm rounded-pill bg-white border p-1">
                                            <a href="{{ route('superadmin.users.edit', $user) }}"
                                                class="btn btn-sm btn-white text-warning border-0" title="Edit Akun">
                                                <i class="fas fa-user-edit"></i>
                                            </a>

                                            <form action="{{ route('superadmin.users.destroy', $user) }}"
                                                method="POST" class="d-inline"
                                                onsubmit="return confirm('Hapus permanen akun ini?')">
                                                @csrf @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-white text-danger border-0"
                                                    title="Hapus Akun">
                                                    <i class="fas fa-trash-alt"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="mt-4">
                {{ $users->links() }}
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</x-app-layout>
