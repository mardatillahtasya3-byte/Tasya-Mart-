# TasyaShop — Web 5 Laravel

## Tentang Aplikasi

TasyaShop adalah aplikasi web pengelolaan produk yang dikembangkan menggunakan Laravel dan PHP. Aplikasi ini dibuat untuk membantu pengguna mengelola data produk dengan lebih mudah.

## Fitur Aplikasi

- Menampilkan daftar produk.
- Menambahkan produk baru.
- Melihat detail produk.
- Mengedit data produk.
- Menghapus produk.
- Validasi SKU agar tidak duplikat.
- Pencarian dan filter kategori produk.
- Pagination untuk membagi daftar produk menjadi beberapa halaman.

## Teknologi yang Digunakan

- PHP
- Laravel
- Blade Template
- Database yang dikonfigurasi pada aplikasi
- Composer

## Persyaratan

Pastikan perangkat sudah memiliki:
- PHP
- Composer
- Database yang sesuai dengan konfigurasi aplikasi

## Cara Menjalankan Aplikasi

1. Clone repository dan masuk ke folder project.
2. Instal dependensi:

   ```bash
   composer install
   ```

3. Salin `.env.example` menjadi `.env`.
4. Buat application key:

   ```bash
   php artisan key:generate
   ```

5. Sesuaikan konfigurasi database pada file `.env`.
6. Jalankan migration jika database project menggunakan migration Laravel:

   ```bash
   php artisan migrate
   ```

7. Jalankan aplikasi:

   ```bash
   php artisan serve
   ```

8. Buka alamat yang ditampilkan terminal, biasanya `http://127.0.0.1:8000`.

## Repository

Kode sumber aplikasi tersedia di GitHub pada branch `web5-local`.

## Lisensi

Project ini dibuat untuk keperluan pembelajaran Web 5.
