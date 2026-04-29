<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Exports\TransactionsExport;
use Maatwebsite\Excel\Facades\Excel;

class TransactionController extends Controller
{
    public function index(Request $request)
    {
        $request->validate([
            'mulai'   => 'nullable|date',
            'selesai' => 'nullable|date|after_or_equal:mulai',
        ], [
            'selesai.after_or_equal' => 'Tanggal selesai tidak boleh lebih awal dari tanggal mulai.'
        ]);

        $query = auth()->user()->transactions();

        if ($request->filled('mulai') && $request->filled('selesai')) {
            $query->whereBetween('tanggal', [$request->mulai, $request->selesai]);
        }

        $transactions = $query->orderBy('tanggal', 'desc')->get();

        $totalPemasukan = $transactions->where('jenis', 'pemasukan')->sum('nominal');
        $totalPengeluaran = $transactions->where('jenis', 'pengeluaran')->sum('nominal');
        $totalSaldo = $totalPemasukan - $totalPengeluaran;

        // Merekap Total Nominal Per Kategori
        $pemasukanPerKategori = $transactions->where('jenis', 'pemasukan')
            ->groupBy('kategori')
            ->map(function ($item) {
                return $item->sum('nominal');
            });

        $pengeluaranPerKategori = $transactions->where('jenis', 'pengeluaran')
            ->groupBy('kategori')
            ->map(function ($item) {
                return $item->sum('nominal');
            });

        return view('user.dashboard', compact(
            'transactions',
            'totalPemasukan',
            'totalPengeluaran',
            'totalSaldo',
            'pemasukanPerKategori',
            'pengeluaranPerKategori'
        ));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'tanggal'    => 'required|date|before_or_equal:today',
            'jenis'      => 'required|in:pemasukan,pengeluaran',
            'kategori'   => 'required|string|max:100',
            'keterangan' => 'required|string|max:255',
            'nominal'    => 'required|numeric|min:1|max:999999999999',
        ], [
            'tanggal.before_or_equal' => 'Tanggal transaksi tidak boleh melebihi hari ini.'
        ]);

        $validated['keterangan'] = strip_tags($validated['keterangan']);
        $validated['kategori'] = strip_tags($validated['kategori']);

        auth()->user()->transactions()->create($validated);

        return redirect()->route('user.dashboard')->with('success', 'Transaksi berhasil ditambahkan.');
    }

    public function update(Request $request, Transaction $transaction)
    {
        if ($transaction->user_id !== auth()->id()) {
            abort(403, 'Anda tidak memiliki akses ke transaksi ini.');
        }

        $validated = $request->validate([
            'tanggal'    => 'required|date|before_or_equal:today',
            'jenis'      => 'required|in:pemasukan,pengeluaran',
            'kategori'   => 'required|string|max:100',
            'keterangan' => 'required|string|max:255',
            'nominal'    => 'required|numeric|min:1|max:999999999999',
        ], [
            'tanggal.before_or_equal' => 'Tanggal transaksi tidak boleh melebihi hari ini.'
        ]);

        $validated['keterangan'] = strip_tags($validated['keterangan']);
        $validated['kategori'] = strip_tags($validated['kategori']);

        $transaction->update($validated);

        return redirect()->route('user.dashboard')->with('success', 'Transaksi berhasil diperbarui.');
    }

    public function destroy(Transaction $transaction)
    {
        if ($transaction->user_id !== auth()->id()) abort(403);

        $transaction->delete();
        return redirect()->route('user.dashboard')->with('success', 'Transaksi berhasil dihapus.');
    }

    public function exportPdf(Request $request)
    {
        // Gunakan query dasar milik user yang sedang login
        $query = auth()->user()->transactions();

        // Jika user menerapkan filter tanggal, terapkan juga pada data export
        if ($request->filled('mulai') && $request->filled('selesai')) {
            $query->whereBetween('tanggal', [$request->mulai, $request->selesai]);
        }

        $transactions = $query->orderBy('tanggal', 'desc')->get();

        // Load view PDF dan set ukuran kertas (A4 Potrait)
        $pdf = Pdf::loadView('exports.transactions_pdf', compact('transactions'))
            ->setPaper('a4', 'portrait');

        return $pdf->download('Laporan_Keuangan_UMKM.pdf');
    }

    public function exportExcel(Request $request)
    {
        $query = auth()->user()->transactions();

        if ($request->filled('mulai') && $request->filled('selesai')) {
            $query->whereBetween('tanggal', [$request->mulai, $request->selesai]);
        }

        $transactions = $query->orderBy('tanggal', 'desc')->get();

        return Excel::download(new TransactionsExport($transactions), 'Laporan_Keuangan_UMKM.xlsx');
    }
}
