<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        Product::create([
            'category_id' => 1, // Elektronik
            'name' => 'Laptop ASUS ROG',
            'stock' => 10,
            'price' => 15000000,
        ]);

        Product::create([
            'category_id' => 2, // Makanan & Minuman
            'name' => 'Kripik Singkong Balado',
            'stock' => 50,
            'price' => 15000,
        ]);
    }
}