<x-app-layout>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
    <link href="{{ asset('css/dashboard.css') }}" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <div class="py-12 bg-light">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show rounded-4 border-0 shadow-sm mb-4"
                    role="alert">
                    <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            @if ($errors->any())
                <div class="alert alert-danger alert-dismissible fade show rounded-4 border-0 shadow-sm mb-4"
                    role="alert">
                    <ul class="mb-0 ps-3">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <div class="container-fluid mb-5 px-0">
                <div class="row g-4 mb-4">
                    <div class="col-md-4">
                        <div class="bento-card">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <h6 class="text-muted fw-semibold mb-2">Total Pemasukan</h6>
                                    <h3 class="mb-0 text-dark fw-bold">Rp
                                        {{ number_format($totalPemasukan, 0, ',', '.') }}</h3>
                                </div>
                                <div class="icon-box bg-income"><i class="fas fa-arrow-trend-up"></i></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="bento-card">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <h6 class="text-muted fw-semibold mb-2">Total Pengeluaran</h6>
                                    <h3 class="mb-0 text-dark fw-bold">Rp
                                        {{ number_format($totalPengeluaran, 0, ',', '.') }}</h3>
                                </div>
                                <div class="icon-box bg-expense"><i class="fas fa-arrow-trend-down"></i></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="bento-card"
                            style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white;">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <h6 class="text-white-50 fw-semibold mb-2">Total Saldo</h6>
                                    <h3 class="mb-0 text-white fw-bold">Rp {{ number_format($totalSaldo, 0, ',', '.') }}
                                    </h3>
                                </div>
                                <div class="icon-box" style="background: rgba(255,255,255,0.2);"><i
                                        class="fas fa-wallet text-white"></i></div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row g-4 mb-4">
                    <div class="col-lg-8">
                        <div class="bento-card p-4">
                            <h5 class="fw-bold mb-4"><i class="fas fa-plus-circle me-2 text-primary"></i>Catat Transaksi
                            </h5>
                            <form action="{{ route('transactions.store') }}" method="POST">
                                @csrf
                                <div class="row g-3">
                                    <div class="col-md-6">
                                        <label class="form-label text-muted small fw-semibold">Tanggal</label>
                                        <input type="date" class="form-control" name="tanggal"
                                            value="{{ date('Y-m-d') }}" max="{{ date('Y-m-d') }}" required />
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label text-muted small fw-semibold">Jenis Transaksi</label>
                                        <select class="form-select" name="jenis" id="jenis_tambah" required>
                                            <option value="pemasukan">Pemasukan</option>
                                            <option value="pengeluaran">Pengeluaran</option>
                                        </select>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label text-muted small fw-semibold">Kategori</label>
                                        <select class="form-select" name="kategori" id="kategori_tambah"
                                            required></select>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label text-muted small fw-semibold">Nominal (Rp)</label>
                                        <input type="text" class="form-control fw-bold" id="nominal_display"
                                            placeholder="0" required />
                                        <input type="hidden" name="nominal" id="nominal_actual" required />
                                    </div>
                                    <div class="col-md-12">
                                        <label class="form-label text-muted small fw-semibold">Keterangan</label>
                                        <input type="text" class="form-control" name="keterangan"
                                            placeholder="Cth: Penjualan meja makan / Bayar listrik" required />
                                    </div>
                                    <div class="col-12 mt-4">
                                        <button type="submit" class="btn btn-primary w-100 shadow-sm"><i
                                                class="fas fa-save me-2"></i>Simpan Transaksi</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>

                    <div class="col-lg-4">
                        <div class="bento-card d-flex flex-column align-items-center justify-content-center p-4">
                            <h5 class="fw-bold mb-4 w-100"><i class="fas fa-chart-pie me-2 text-primary"></i>Arus Kas
                            </h5>
                            <div style="position: relative; height: 220px; width: 220px">
                                <canvas id="grafikKeuangan"></canvas>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row g-4 mb-4">
                    <div class="col-lg-6">
                        <div class="bento-card p-4">
                            <h5 class="fw-bold mb-4"><i class="fas fa-chart-column me-2 text-success"></i>Statistik
                                Pemasukan</h5>
                            <div style="position: relative; height: 250px; width: 100%">
                                <canvas id="barPemasukan"></canvas>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="bento-card p-4">
                            <h5 class="fw-bold mb-4"><i class="fas fa-chart-column me-2 text-danger"></i>Statistik
                                Pengeluaran</h5>
                            <div style="position: relative; height: 250px; width: 100%">
                                <canvas id="barPengeluaran"></canvas>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-12">
                        <div class="bento-card p-4">
                            <div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-3">
                                <h5 class="fw-bold mb-0"><i class="fas fa-list me-2 text-primary"></i>Riwayat
                                    Transaksi</h5>
                                <form action="{{ route('user.dashboard') }}" method="GET"
                                    class="d-flex align-items-center bg-light p-2 rounded-4">
                                    <input type="date" class="form-control form-control-sm me-2 border-0 bg-white"
                                        name="mulai" value="{{ request('mulai') }}" max="{{ date('Y-m-d') }}"
                                        required />
                                    <span class="text-muted small px-1">-</span>
                                    <input type="date"
                                        class="form-control form-control-sm ms-2 me-2 border-0 bg-white"
                                        name="selesai" value="{{ request('selesai') }}" max="{{ date('Y-m-d') }}"
                                        required />
                                    <button type="submit" class="btn btn-sm btn-primary rounded-circle"
                                        style="width:32px; height:32px; padding:6px;"><i
                                            class="fas fa-filter"></i></button>
                                    <a href="{{ route('user.dashboard') }}"
                                        class="btn btn-sm btn-light rounded-circle ms-2 text-danger"
                                        style="width:32px; height:32px; padding:6px;" title="Reset"><i
                                            class="fas fa-sync-alt"></i></a>
                                </form>
                            </div>

                            <div class="table-responsive">
                                <table class="table table-hover align-middle mb-0">
                                    <thead class="text-muted small text-uppercase" style="background: transparent;">
                                        <tr>
                                            <th class="border-0 pb-3">Tanggal</th>
                                            <th class="border-0 pb-3">Kategori</th>
                                            <th class="border-0 pb-3">Keterangan</th>
                                            <th class="border-0 pb-3">Status</th>
                                            <th class="text-end border-0 pb-3">Nominal</th>
                                            <th class="text-center border-0 pb-3">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody class="border-top-0">
                                        @forelse($transactions as $t)
                                            <tr>
                                                <td><span
                                                        class="fw-medium">{{ \Carbon\Carbon::parse($t->tanggal)->format('d M Y') }}</span>
                                                </td>
                                                <td><span
                                                        class="badge bg-light text-dark border px-2 py-1">{{ $t->kategori }}</span>
                                                </td>
                                                <td class="text-muted">{{ $t->keterangan }}</td>
                                                <td>
                                                    <span
                                                        class="badge {{ $t->jenis == 'pemasukan' ? 'bg-success bg-opacity-10 text-success' : 'bg-danger bg-opacity-10 text-danger' }} px-2 py-1 rounded-pill">
                                                        {{ ucfirst($t->jenis) }}
                                                    </span>
                                                </td>
                                                <td
                                                    class="text-end fw-bold {{ $t->jenis == 'pemasukan' ? 'text-success' : 'text-danger' }}">
                                                    {{ $t->jenis == 'pemasukan' ? '+' : '-' }} Rp
                                                    {{ number_format($t->nominal, 0, ',', '.') }}
                                                </td>
                                                <td class="text-center">
                                                    <button
                                                        class="btn btn-sm btn-light text-primary rounded-circle me-1"
                                                        style="width:32px; height:32px; padding:0;"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#editModal{{ $t->id }}">
                                                        <i class="fas fa-pen"></i>
                                                    </button>

                                                    <form action="{{ route('transactions.destroy', $t->id) }}"
                                                        method="POST" class="d-inline"
                                                        onsubmit="return confirm('Yakin ingin menghapus?');">
                                                        @csrf @method('DELETE')
                                                        <button type="submit"
                                                            class="btn btn-sm btn-light text-danger rounded-circle"
                                                            style="width:32px; height:32px; padding:0;"><i
                                                                class="fas fa-trash"></i></button>
                                                    </form>

                                                    <div class="modal fade" id="editModal{{ $t->id }}"
                                                        tabindex="-1" aria-hidden="true">
                                                        <div class="modal-dialog modal-dialog-centered">
                                                            <div class="modal-content border-0 shadow-lg rounded-4">
                                                                <div class="modal-header border-0 pb-0">
                                                                    <h5 class="fw-bold"><i
                                                                            class="fas fa-edit me-2 text-primary"></i>Edit
                                                                        Transaksi</h5>
                                                                    <button type="button" class="btn-close"
                                                                        data-bs-dismiss="modal"
                                                                        aria-label="Close"></button>
                                                                </div>
                                                                <form
                                                                    action="{{ route('transactions.update', $t->id) }}"
                                                                    method="POST">
                                                                    @csrf
                                                                    @method('PUT')
                                                                    <div class="modal-body text-start">
                                                                        <div class="row g-3">
                                                                            <div class="col-md-6">
                                                                                <label
                                                                                    class="form-label small fw-semibold">Tanggal</label>
                                                                                <input type="date"
                                                                                    class="form-control"
                                                                                    name="tanggal"
                                                                                    value="{{ $t->tanggal }}"
                                                                                    max="{{ date('Y-m-d') }}"
                                                                                    required>
                                                                            </div>
                                                                            <div class="col-md-6">
                                                                                <label
                                                                                    class="form-label small fw-semibold">Jenis</label>
                                                                                <select class="form-select jenis-edit"
                                                                                    name="jenis"
                                                                                    data-id="{{ $t->id }}"
                                                                                    required>
                                                                                    <option value="pemasukan"
                                                                                        {{ $t->jenis == 'pemasukan' ? 'selected' : '' }}>
                                                                                        Pemasukan</option>
                                                                                    <option value="pengeluaran"
                                                                                        {{ $t->jenis == 'pengeluaran' ? 'selected' : '' }}>
                                                                                        Pengeluaran</option>
                                                                                </select>
                                                                            </div>
                                                                            <div class="col-md-12">
                                                                                <label
                                                                                    class="form-label small fw-semibold">Kategori</label>
                                                                                <select class="form-select"
                                                                                    name="kategori"
                                                                                    id="kategori_edit_{{ $t->id }}"
                                                                                    data-selected="{{ $t->kategori }}"
                                                                                    required>
                                                                                </select>
                                                                            </div>
                                                                            <div class="col-md-12">
                                                                                <label
                                                                                    class="form-label small fw-semibold">Nominal
                                                                                    (Rp)
                                                                                </label>
                                                                                <input type="text"
                                                                                    class="form-control fw-bold nominal-edit-display"
                                                                                    data-id="{{ $t->id }}"
                                                                                    value="{{ number_format($t->nominal, 0, ',', '.') }}"
                                                                                    required>
                                                                                <input type="hidden" name="nominal"
                                                                                    id="nominal_edit_actual_{{ $t->id }}"
                                                                                    value="{{ $t->nominal }}">
                                                                            </div>
                                                                            <div class="col-md-12">
                                                                                <label
                                                                                    class="form-label small fw-semibold">Keterangan</label>
                                                                                <input type="text"
                                                                                    class="form-control"
                                                                                    name="keterangan"
                                                                                    value="{{ $t->keterangan }}"
                                                                                    required>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="modal-footer border-0">
                                                                        <button type="button"
                                                                            class="btn btn-light rounded-pill px-4"
                                                                            data-bs-dismiss="modal">Batal</button>
                                                                        <button type="submit"
                                                                            class="btn btn-primary rounded-pill px-4">Simpan
                                                                            Perubahan</button>
                                                                    </div>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="6" class="text-center text-muted py-5">
                                                    <div class="mb-3"><i class="fas fa-inbox fa-3x opacity-25"></i>
                                                    </div>
                                                    Belum ada transaksi.
                                                </td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // --- DOUGHNUT CHART ARUS KAS ---
            const ctxDoughnut = document.getElementById("grafikKeuangan").getContext("2d");
            const totalMasuk = {{ $totalPemasukan }};
            const totalKeluar = {{ $totalPengeluaran }};
            const dataKosong = totalMasuk === 0 && totalKeluar === 0;

            new Chart(ctxDoughnut, {
                type: "doughnut",
                data: {
                    labels: ["Pemasukan", "Pengeluaran"],
                    datasets: [{
                        data: dataKosong ? [1] : [totalMasuk, totalKeluar],
                        backgroundColor: dataKosong ? ["#e9ecef"] : ["#198754", "#dc3545"],
                        borderWidth: 0,
                    }],
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            position: "bottom"
                        },
                        tooltip: {
                            enabled: !dataKosong
                        },
                    },
                },
            });

            // --- BAR CHART PEMASUKAN PER KATEGORI ---
            const ctxBarIn = document.getElementById("barPemasukan").getContext("2d");
            const labelPemasukan = {!! json_encode($pemasukanPerKategori->keys()) !!};
            const dataPemasukan = {!! json_encode($pemasukanPerKategori->values()) !!};

            new Chart(ctxBarIn, {
                type: 'bar',
                data: {
                    labels: labelPemasukan.length ? labelPemasukan : ['Belum ada data'],
                    datasets: [{
                        label: 'Pemasukan (Rp)',
                        data: dataPemasukan.length ? dataPemasukan : [0],
                        backgroundColor: '#198754',
                        borderRadius: 5,
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    scales: {
                        y: {
                            beginAtZero: true,
                            ticks: {
                                callback: function(value) {
                                    return 'Rp ' + value.toLocaleString('id-ID');
                                }
                            }
                        }
                    },
                    plugins: {
                        legend: {
                            display: false
                        }
                    }
                }
            });

            // --- BAR CHART PENGELUARAN PER KATEGORI ---
            const ctxBarOut = document.getElementById("barPengeluaran").getContext("2d");
            const labelPengeluaran = {!! json_encode($pengeluaranPerKategori->keys()) !!};
            const dataPengeluaran = {!! json_encode($pengeluaranPerKategori->values()) !!};

            new Chart(ctxBarOut, {
                type: 'bar',
                data: {
                    labels: labelPengeluaran.length ? labelPengeluaran : ['Belum ada data'],
                    datasets: [{
                        label: 'Pengeluaran (Rp)',
                        data: dataPengeluaran.length ? dataPengeluaran : [0],
                        backgroundColor: '#dc3545',
                        borderRadius: 5,
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    scales: {
                        y: {
                            beginAtZero: true,
                            ticks: {
                                callback: function(value) {
                                    return 'Rp ' + value.toLocaleString('id-ID');
                                }
                            }
                        }
                    },
                    plugins: {
                        legend: {
                            display: false
                        }
                    }
                }
            });
        });

        // --- SCRIPT FORMAT RUPIAH & KATEGORI DINAMIS ---
        function formatRupiah(angka) {
            let number_string = angka.replace(/[^,\d]/g, '').toString(),
                split = number_string.split(','),
                sisa = split[0].length % 3,
                rupiah = split[0].substr(0, sisa),
                ribuan = split[0].substr(sisa).match(/\d{3}/gi);

            if (ribuan) {
                let separator = sisa ? '.' : '';
                rupiah += separator + ribuan.join('.');
            }
            return split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
        }

        // Kategori
        const kategoriPemasukan = ['Penjualan Produk', 'Layanan/Jasa', 'Modal Usaha', 'Pendapatan Bunga', 'Lainnya'];
        const kategoriPengeluaran = ['Bahan Baku', 'Biaya Operasional', 'Gaji Karyawan', 'Sewa Tempat', 'Pajak',
            'Transportasi', 'Lainnya'
        ];

        function updateKategoriOptions(jenisSelect, kategoriSelect, selectedValue = '') {
            const jenis = jenisSelect.value;
            let options = '';
            let targetArray = jenis === 'pemasukan' ? kategoriPemasukan : kategoriPengeluaran;

            targetArray.forEach(cat => {
                options += `<option value="${cat}" ${selectedValue === cat ? 'selected' : ''}>${cat}</option>`;
            });

            kategoriSelect.innerHTML = options;
        }

        document.addEventListener('DOMContentLoaded', function() {
            // Format Rupiah (Tambah)
            const nominalDisplay = document.getElementById('nominal_display');
            const nominalActual = document.getElementById('nominal_actual');

            if (nominalDisplay) {
                nominalDisplay.addEventListener('keyup', function(e) {
                    this.value = formatRupiah(this.value);
                    nominalActual.value = this.value.replace(/\./g, '');
                });
            }

            // Format Rupiah (Edit)
            document.querySelectorAll('.nominal-edit-display').forEach(function(input) {
                input.addEventListener('keyup', function(e) {
                    this.value = formatRupiah(this.value);
                    let id = this.getAttribute('data-id');
                    document.getElementById('nominal_edit_actual_' + id).value = this.value.replace(
                        /\./g, '');
                });
            });

            // Kategori Dinamis (Tambah)
            const jenisTambah = document.getElementById('jenis_tambah');
            const kategoriTambah = document.getElementById('kategori_tambah');
            if (jenisTambah && kategoriTambah) {
                jenisTambah.addEventListener('change', () => updateKategoriOptions(jenisTambah, kategoriTambah));
                updateKategoriOptions(jenisTambah, kategoriTambah);
            }

            // Kategori Dinamis (Edit)
            document.querySelectorAll('.jenis-edit').forEach(jenisEdit => {
                const id = jenisEdit.getAttribute('data-id');
                const kategoriEdit = document.getElementById(`kategori_edit_${id}`);
                const selectedVal = kategoriEdit.getAttribute('data-selected');

                jenisEdit.addEventListener('change', () => updateKategoriOptions(jenisEdit, kategoriEdit));
                updateKategoriOptions(jenisEdit, kategoriEdit, selectedVal);
            });
        });
    </script>
</x-app-layout>
