<p align="center">
  <h1 align="center">📊 SI UMKM - Sistem Informasi Manajemen Keuangan UMKM</h1>
</p>

<p align="center">
  <img src="https://img.shields.io/badge/Laravel-11.x-FF2D20?style=for-the-badge&logo=laravel&logoColor=white" alt="Laravel">
  <img src="https://img.shields.io/badge/PHP-8.2%2B-777BB4?style=for-the-badge&logo=php&logoColor=white" alt="PHP">
</p>

---

## 🌟 Tentang Aplikasi

**SI UMKM** adalah aplikasi berbasis web yang dirancang khusus untuk membantu Usaha Mikro, Kecil, dan Menengah (UMKM) dalam mengelola keuangan secara digital dan terstruktur. Aplikasi ini mempermudah pencatatan transaksi (pemasukan dan pengeluaran), pengelolaan kategori, pembuatan laporan keuangan secara real-time, serta ekspor data laporan ke dalam format **Excel** dan **PDF**.

Aplikasi ini dibangun menggunakan framework **Laravel 11** dengan sistem Multi-Role Authentication (User, Admin, dan Super Admin) serta antarmuka modern yang elegan menggunakan **Tailwind CSS**.

---

## ✨ Fitur Utama

### 1. 👥 Multi-Role Authentication & Manajemen Pengguna
* **User (Pelaku UMKM):** Mengelola pencatatan keuangan pribadi/usaha, melihat rekap saldo, pemasukan, pengeluaran, serta melakukan ekspor laporan.
* **Admin:** Mengelola data pengguna di tingkat operasional.
* **Super Admin:** Memiliki hak akses penuh untuk manajemen seluruh pengguna (*User Management* CRUD lengkap).

### 2. 💰 Pencatatan Transaksi Keuangan
* Pencatatan transaksi **Pemasukan** dan **Pengeluaran**.
* Informasi terperinci meliputi: Tanggal, Jenis Transaksi, Kategori, Keterangan, dan Nominal.
* Fitur Tambah, Edit, dan Hapus transaksi dengan validasi ketat.

### 3. 📈 Dashboard & Laporan Keuangan
* Ringkasan saldo total, total pemasukan, dan total pengeluaran secara otomatis.
* Visualisasi data keuangan yang intuitif bagi pengguna.

### 4. 📄 Ekspor Laporan (Excel & PDF)
* **Ekspor Excel:** Menggunakan library `maatwebsite/excel` untuk pengunduhan data transaksi terstruktur.
* **Ekspor PDF:** Menggunakan `barryvdh/laravel-dompdf` untuk cetak laporan keuangan siap-uji.

---

## 🛠️ Tech Stack

* **Backend:** PHP 8.2+, Laravel 11
* **Frontend:** Blade Templates, Alpine.js
* **Authentication:** Laravel Breeze (Customized with Roles)
* **Database:** MySQL / SQLite
* **Package Dependencies:**
  * `maatwebsite/excel` (^3.1)
  * `barryvdh/laravel-dompdf` (^3.1)

---

## ⚙️ Persyaratan Sistem

Sebelum memulai, pastikan perangkat Anda telah terinstal:
* **PHP** >= 8.2
* **Composer**
* **Node.js & NPM**
* **MySQL** atau SQLite

---
