<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        Category::create(['name' => 'Elektronik']);
        Category::create(['name' => 'Makanan & Minuman']);
        Category::create(['name' => 'Aksesori']);
    }
}