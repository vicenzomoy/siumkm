<!DOCTYPE html>
<html>

<head>
    <title>Laporan Keuangan</title>
    <style>
        body {
            font-family: sans-serif;
            font-size: 12px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th,
        td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        .text-right {
            text-align: right;
        }

        .text-success {
            color: green;
        }

        .text-danger {
            color: red;
        }
    </style>
</head>

<body>
    <h2 style="text-align: center;">Laporan Keuangan UMKM</h2>
    <p><strong>Nama UMKM:</strong> {{ auth()->user()->name }}<br>
        <strong>Tanggal Cetak:</strong> {{ \Carbon\Carbon::now()->format('d M Y') }}
    </p>

    <table>
        <thead>
            <tr>
                <th>Tanggal</th>
                <th>Kategori</th>
                <th>Keterangan</th>
                <th>Jenis</th>
                <th class="text-right">Nominal (Rp)</th>
            </tr>
        </thead>
        <tbody>
            @php $total = 0; @endphp
            @foreach ($transactions as $t)
                <tr>
                    <td>{{ \Carbon\Carbon::parse($t->tanggal)->format('d/m/Y') }}</td>
                    <td>{{ $t->kategori }}</td>
                    <td>{{ $t->keterangan }}</td>
                    <td>{{ ucfirst($t->jenis) }}</td>
                    <td class="text-right {{ $t->jenis == 'pemasukan' ? 'text-success' : 'text-danger' }}">
                        {{ $t->jenis == 'pemasukan' ? '+' : '-' }} {{ number_format($t->nominal, 0, ',', '.') }}
                    </td>
                </tr>
                @php
                    if ($t->jenis == 'pemasukan') {
                        $total += $t->nominal;
                    } else {
                        $total -= $t->nominal;
                    }
                @endphp
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <th colspan="4" class="text-right">Total Saldo Periode Ini:</th>
                <th class="text-right">Rp {{ number_format($total, 0, ',', '.') }}</th>
            </tr>
        </tfoot>
    </table>
</body>

</html>
