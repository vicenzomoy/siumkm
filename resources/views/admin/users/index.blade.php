<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            <i class="fas fa-users me-2"></i>{{ __('Manajemen Pengguna UMKM') }}
        </h2>
    </x-slot>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show rounded-3 shadow-sm border-0" role="alert">
                    <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
                <div class="card-header bg-white py-3 border-0 d-flex justify-content-between align-items-center">
                    <h5 class="mb-0 fw-bold text-gray-700">Daftar Pemilik UMKM</h5>
                    <a href="{{ route('admin.users.create') }}"
                        class="btn btn-sm btn-primary rounded-pill px-3 shadow-sm">
                        <i class="fas fa-user-plus me-1"></i>Tambah Akun
                    </a>
                </div>

                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="bg-light">
                            <tr>
                                <th class="ps-4 border-0 text-muted small text-uppercase">Nama / UMKM</th>
                                <th class="border-0 text-muted small text-uppercase">Email</th>
                                <th class="border-0 text-muted small text-uppercase">Tgl Bergabung</th>
                                <th class="border-0 text-center text-muted small text-uppercase">Status</th>
                                <th class="pe-4 border-0 text-center text-muted small text-uppercase">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($users as $user)
                                <tr>
                                    <td class="ps-4">
                                        <div class="d-flex align-items-center">
                                            <div class="avatar me-3 bg-primary text-white rounded-circle d-flex align-items-center justify-content-center fw-bold"
                                                style="width: 35px; height: 35px; font-size: 14px;">
                                                {{ strtoupper(substr($user->name, 0, 1)) }}
                                            </div>
                                            <div>
                                                <span class="fw-bold d-block text-dark">{{ $user->name }}</span>
                                                <small class="text-muted">ID:
                                                    #{{ str_pad($user->id, 4, '0', STR_PAD_LEFT) }}</small>
                                            </div>
                                        </div>
                                    </td>
                                    <td>{{ $user->email }}</td>
                                    <td>{{ $user->created_at->format('d/m/Y') }}</td>
                                    <td class="text-center">
                                        <span
                                            class="badge bg-info-subtle text-info px-3 rounded-pill border border-info-subtle">Aktif</span>
                                    </td>
                                    <td class="pe-4 text-center">
                                        <div class="btn-group shadow-sm rounded-pill bg-white border p-1">
                                            <a href="{{ route('admin.users.edit', $user) }}"
                                                class="btn btn-sm btn-white text-warning border-0" title="Edit Data">
                                                <i class="fas fa-user-edit"></i>
                                            </a>
                                            <form action="{{ route('admin.users.destroy', $user) }}" method="POST"
                                                class="d-inline" onsubmit="return confirm('Hapus akun UMKM ini?')">
                                                @csrf @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-white text-danger border-0"
                                                    title="Hapus Akun">
                                                    <i class="fas fa-trash-alt"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center py-5 text-muted">
                                        <img src="https://illustrations.popsy.co/gray/fogg-no-messages.png"
                                            style="width: 150px;" class="mb-3 d-block mx-auto">
                                        Belum ada data user terdaftar.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                @if ($users->hasPages())
                    <div class="card-footer bg-white border-0 py-3">
                        {{ $users->links() }}
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
