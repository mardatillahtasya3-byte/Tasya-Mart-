# Tasya Mart - Inventory & Sales Management System

Aplikasi web manajemen inventaris dan penjualan terintegrasi yang dibangun menggunakan **Laravel** sebagai pemenuhan Ujian Tengah Semester (UTS) mata kuliah **Web Programming 2**. Sistem ini dirancang untuk memastikan konsistensi stok barang melalui transaksi pembelian (*purchasing*) dan penjualan (*sales*) yang atomik, serta dilengkapi dengan pembatasan hak akses berbasis peran (*Role-Based Access Control*).

---

## 📋 Daftar Isi
1. [Project Overview](#project-overview)
2. [Requirements](#requirements)
3. [Fitur Utama](#fitur-utama)
4. [Struktur Database & ERD](#struktur-database--erd)
5. [Panduan Instalasi (Reproducible Setup)](#panduan-instalasi-reproducible-setup)
6. [Environment Setup](#environment-setup)
7. [Migration & Seeding](#migration--seeding)
8. [Akun Demo (Demo Accounts)](#akun-demo-demo-accounts)
9. [Known Limitations](#known-limitations)

---

## 🔍 Project Overview
Usaha distribusi sering menghadapi masalah ketidaksesuaian stok akibat pencatatan manual. Sistem ini dibangun untuk menyelesaikan masalah tersebut dengan aturan bisnis berikut:
* **Konsistensi Stok:** Stok produk bertambah secara otomatis saat transaksi pembelian dikonfirmasi, dan berkurang saat transaksi penjualan berhasil.
* **Pencegahan Overselling:** Sistem menolak penjualan jika kuantitas melebihi stok yang tersedia tanpa mengubah data apa pun.
* **Atomic Transactions:** Memanfaatkan `DB::transaction` dan `lockForUpdate()` untuk memastikan data header, detail item, dan stok tersimpan secara bersamaan atau dibatalkan (*rollback*) jika terjadi kegagalan.

---

## ⚙️ Requirements
Pastikan perangkat Anda telah menginstal perangkat lunak berikut sebelum menjalankan aplikasi:
* **PHP** >= 8.2 (Disarankan PHP 8.5)
* **Composer**
* **Node.js & NPM**
* **MySQL / MariaDB**

---

## 🚀 Fitur Utama
* **Autentikasi & Otorisasi:** Sistem Login/Logout aman dengan hashing password, serta pembatasan hak akses server-side antara **Admin/Owner** dan **Staff**.
* **Master Data Management:** 
  * Manajemen Kategori Produk (Validasi nama unik).
  * Manajemen Produk dengan SKU unik, harga beli/jual, stok, dan batas minimum stok.
  * Manajemen Data Supplier / Pemasok.
* **Transaksi Terintegrasi:**
  * **Purchases (Pembelian):** Pencatatan stok masuk dari supplier.
  * **Sales (Penjualan):** Pencatatan transaksi kasir/penjualan dengan validasi stok real-time.
* **Usability & Report:**
  * Dashboard interaktif dengan ringkasan total produk, nilai stok rendah, dan statistik transaksi.
  * Fitur pencarian (*search*), filter kategori/tanggal, dan pagination yang mempertahankan parameter URL (*query string*).

---

## 📐 Struktur Database & ERD
Relasi antar tabel dalam database menggunakan Eloquent ORM:
* `users` (1-to-Many ke `sales` & `purchases`)
* `categories` (1-to-Many ke `products`)
* `products` (Many-to-One ke `categories`; 1-to-Many ke `sale_items` & `purchase_items`)
* `suppliers` (1-to-Many ke `purchases`)
* `purchases` (1-to-Many ke `purchase_items`)
* `sales` (1-to-Many ke `sale_items`)

*(Catatan: Diagram ERD final dapat diletakkan atau dirender pada bagian ini dalam repositori GitHub Anda).*

---

## 🛠️ Panduan Instalasi (Reproducible Setup)

Agar aplikasi dapat dijalankan dengan bersih pada *environment* baru, ikuti langkah-langkah di terminal berikut:

### 1. Clone Repository
```bash
git clone <repository-url>
cd inventory-laravel