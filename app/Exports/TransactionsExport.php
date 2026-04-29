<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class TransactionsExport implements FromCollection, WithHeadings, WithMapping, ShouldAutoSize
{
    protected $transactions;

    // Terima data transaksi dari Controller
    public function __construct($transactions)
    {
        $this->transactions = $transactions;
    }

    public function collection()
    {
        return $this->transactions;
    }

    // Header Kolom Excel
    public function headings(): array
    {
        return ['Tanggal', 'Kategori', 'Keterangan', 'Jenis Transaksi', 'Nominal (Rp)'];
    }

    // Mapping Data per Baris
    public function map($transaction): array
    {
        return [
            \Carbon\Carbon::parse($transaction->tanggal)->format('d/m/Y'),
            $transaction->kategori,
            $transaction->keterangan,
            ucfirst($transaction->jenis),
            // Beri tanda minus jika pengeluaran agar rapi di Excel
            $transaction->jenis == 'pengeluaran' ? -$transaction->nominal : $transaction->nominal,
        ];
    }
}
