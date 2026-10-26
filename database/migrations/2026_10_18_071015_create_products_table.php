<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Membuat tabel products.
     */
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();

            // Relasi ke tabel categories
            $table->foreignId('category_id')
                ->constrained()
                ->cascadeOnDelete();

            // Informasi produk
            $table->string('sku')->unique();
            $table->string('name');
            $table->integer('stock')->default(0);
            $table->integer('minimum_stock')->default(5);
            $table->decimal('price', 12, 2)->default(0);

            $table->timestamps();
        });
    }

    /**
     * Menghapus tabel products saat rollback.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
