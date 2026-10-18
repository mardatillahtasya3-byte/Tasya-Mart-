<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Tambahkan kategori contoh hanya jika tabel masih kosong.
        if (Category::count() === 0) {
            $categoryNames = [
                'Elektronik',
                'Makanan dan Minuman',
                'Perlengkapan Kantor',
                'Peralatan Rumah Tangga',
                'Aksesori',
            ];

            foreach ($categoryNames as $name) {
                Category::create([
                    'name' => $name,
                ]);
            }
        }

        // Ambil kategori yang sudah tersedia.
        $categories = Category::all();

        // Buat 20 produk contoh hanya jika belum ada produk.
        if (Product::count() === 0 && $categories->isNotEmpty()) {
            Product::factory()
                ->count(20)
                ->state(fn () => [
                    'category_id' => $categories->random()->id,
                ])
                ->create();
        }
    }
}
