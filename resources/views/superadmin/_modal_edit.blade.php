<div class="modal fade" id="modalEdit{{ $user->id }}" tabindex="-1">
    <div class="modal-dialog">
        <form action="{{ route('superadmin.update', $user->id) }}" method="POST" class="modal-content">
            @csrf @method('PUT')
            <div class="modal-header">
                <h5 class="modal-title">Edit Akun: {{ $user->name }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body text-start">
                <div class="mb-3">
                    <label>Nama Lengkap</label>
                    <input type="text" name="name" class="form-control" value="{{ $user->name }}" required>
                </div>
                <div class="mb-3">
                    <label>Email</label>
                    <input type="email" name="email" class="form-control" value="{{ $user->email }}" required>
                </div>
                <div class="mb-3">
                    <label>Role</label>
                    <select name="role" class="form-select" required>
                        <option value="user" {{ $user->role == 'user' ? 'selected' : '' }}>User (UMKM)</option>
                        <option value="admin" {{ $user->role == 'admin' ? 'selected' : '' }}>Admin</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label>Password Baru <small class="text-muted">(Kosongkan jika tidak diubah)</small></label>
                    <input type="password" name="password" class="form-control" minlength="8">
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary w-100">Simpan Perubahan</button>
            </div>
        </form>
    </div>
</div>
