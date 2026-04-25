<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Transaction;
use App\Models\User;
use Faker\Factory as Faker;

class TransactionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create('id_ID');

        // Ganti dengan email kamu yang ada di database
        $user = User::where('email', 'user@example.com')->first();

        if (!$user) {
            $this->command->error('Gagal melakukan seeding: User tidak ditemukan!');
            return;
        }

        $user->transactions()->delete();
        $this->command->info('Data transaksi lama berhasil dihapus.');

        // Kategori Pemasukan beserta pilihan keterangannya
        $pemasukanData = [
            'Penjualan Produk' => ['Penjualan produk hari ini', 'Invoice #INV-001', 'Pelunasan orderan grosir', 'Penjualan via e-commerce', 'Orderan dari pelanggan tetap'],
            'Layanan/Jasa'     => ['Jasa perbaikan sistem', 'Fee konsultasi', 'Pembayaran jasa desain', 'Jasa maintenance bulanan'],
            'Modal Usaha'      => ['Suntikan dana investor', 'Tambahan modal pribadi', 'Pencairan pinjaman bank'],
            'Pendapatan Bunga' => ['Bunga tabungan', 'Return investasi', 'Bunga deposito bank'],
            'Lainnya'          => ['Cashback e-wallet', 'Refund pembelian', 'Pendapatan tak terduga'],
        ];

        // Kategori Pengeluaran beserta pilihan keterangannya
        $pengeluaranData = [
            'Bahan Baku'        => ['Beli stok barang', 'Belanja material produksi', 'Restock bahan di pasar', 'Pembayaran supplier'],
            'Biaya Operasional' => ['Bayar tagihan listrik PLN', 'Bayar internet WiFi', 'Beli token listrik', 'Tagihan air PDAM'],
            'Gaji Karyawan'     => ['Gaji bulanan staf', 'Kasbon karyawan', 'Bonus target bulanan', 'Uang lembur'],
            'Sewa Tempat'       => ['Sewa ruko bulanan', 'Perpanjang sewa lapak', 'Iuran kebersihan dan keamanan lapak'],
            'Pajak'             => ['Bayar pajak PPN', 'Pajak reklame toko', 'Pajak tahunan'],
            'Transportasi'      => ['Isi bensin kendaraan operasional', 'Biaya ojek online', 'Tol dan parkir pengiriman barang'],
            'Lainnya'           => ['Beli lakban dan alat tulis', 'Konsumsi rapat', 'Sumbangan warga', 'Biaya perbaikan ringan'],
        ];

        for ($i = 0; $i < 100; $i++) {
            $jenis = $faker->randomElement(['pemasukan', 'pengeluaran']);

            if ($jenis === 'pemasukan') {
                $kategori = $faker->randomElement(array_keys($pemasukanData));
                // Mengambil keterangan acak sesuai kategori yang terpilih
                $keterangan = $faker->randomElement($pemasukanData[$kategori]);
            } else {
                $kategori = $faker->randomElement(array_keys($pengeluaranData));
                // Mengambil keterangan acak sesuai kategori yang terpilih
                $keterangan = $faker->randomElement($pengeluaranData[$kategori]);
            }

            Transaction::create([
                'user_id'    => $user->id,
                'tanggal'    => $faker->dateTimeBetween('-6 months', 'now')->format('Y-m-d'),
                'jenis'      => $jenis,
                'kategori'   => $kategori,
                'keterangan' => $keterangan, // Sekarang menggunakan kalimat nyata
                'nominal'    => $faker->numberBetween(5, 500) * 10000,
            ]);
        }

        $this->command->info('Berhasil menambahkan 100 transaksi dengan keterangan realistis untuk user: ' . $user->name);
    }
}
