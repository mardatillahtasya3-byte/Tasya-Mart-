# Tasya Mart — Inventory Management System

Aplikasi manajemen inventaris berbasis web yang dibangun menggunakan Laravel untuk membantu mengelola data produk, kategori, supplier, pembelian, penjualan, dan laporan stok barang.

## ✨ Fitur

- **Dashboard** — Menampilkan ringkasan dan akses cepat ke fitur aplikasi.
- **Manajemen Produk** — Mengelola data produk dan informasi stok.
- **Manajemen Kategori** — Mengelola kategori produk.
- **Manajemen Supplier** — Mengelola data pemasok barang.
- **Pembelian** — Mencatat transaksi pembelian barang.
- **Penjualan** — Mencatat transaksi penjualan barang.
- **Search / Report** — Menampilkan dan mencari data laporan.
- **Export CSV** — Mengekspor data laporan untuk digunakan di spreadsheet.
- **Antarmuka** — Tampilan dengan tema warna cokelat dan krem.

## 🛠️ Teknologi

- PHP
- Laravel
- MySQL
- Blade Templates
- HTML & CSS
- Git & GitHub

## 📋 Persyaratan

Pastikan perangkat sudah memiliki:

- PHP dengan versi yang kompatibel dengan proyek Laravel.
- Composer
- MySQL atau MariaDB
- Node.js dan npm jika proyek menggunakan aset frontend yang perlu dikompilasi.

## 🚀 Cara Instalasi

### 1. Clone repository

```bash
git clone https://github.com/USERNAME/REPOSITORY.git
```

Ganti `USERNAME/REPOSITORY` dengan alamat repository GitHub milikmu.

### 2. Masuk ke folder proyek

```bash
cd inventory-laravel
```

### 3. Instal dependensi

```bash
composer install
```

Jika proyek menggunakan dependensi frontend:

```bash
npm install
```

### 4. Konfigurasi environment

Salin file `.env.example` menjadi `.env`.

Windows PowerShell:

```powershell
Copy-Item .env.example .env
```

### 5. Buat application key

```bash
php artisan key:generate
```

### 6. Buat database

Buat database baru melalui MySQL atau phpMyAdmin, lalu sesuaikan pengaturan database di file `.env`:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=nama_database
DB_USERNAME=root
DB_PASSWORD=
```

Sesuaikan nama database, username, dan password dengan konfigurasi lokalmu.

### 7. Jalankan migration

```bash
php artisan migrate
```

**Catatan:** Jika aplikasi menggunakan database yang sudah berisi data, jangan menjalankan `php artisan migrate:fresh`, karena perintah tersebut dapat menghapus tabel beserta datanya.

### 8. Jalankan aplikasi

```bash
php artisan serve
```

Buka alamat berikut di browser:

```text
http://127.0.0.1:8000
```

Jika diperlukan, jalankan proses frontend di terminal terpisah:

```bash
npm run dev
```

## 📊 Laporan

Fitur Search / Report digunakan untuk membantu melihat data laporan terkait penjualan, pembelian, dan stok barang. Data laporan juga dapat diekspor ke format CSV sesuai dukungan aplikasi.

## 📁 Struktur Proyek

```text
inventory-laravel/
├── app/
│   └── Http/
│       └── Controllers/
├── resources/
│   └── views/
│       ├── layouts/
│       ├── dashboard/
│       └── reports/
├── routes/
│   └── web.php
├── database/
├── public/
├── .env.example
└── README.md
```

## 🔐 Keamanan

- Jangan mengunggah file `.env` ke repository publik.
- Jangan membagikan password database atau kredensial pribadi.
- Gunakan file `.env.example` untuk mendokumentasikan konfigurasi yang dibutuhkan.
- Pastikan file cache, log, dan file konfigurasi lokal tidak ikut diunggah jika tidak diperlukan.

## 👩‍💻 Pengembang

**Tasya Mart — Inventory Management System**

Dibuat sebagai proyek aplikasi inventaris berbasis Laravel.

---

*README ini dapat diperbarui sesuai perkembangan fitur dan konfigurasi proyek.*
