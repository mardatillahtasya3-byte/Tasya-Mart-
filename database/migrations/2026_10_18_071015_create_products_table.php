
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
                ->onDelete('cascade');

            // Informasi produk
            $table->string('name');
            $table->integer('stock');
            $table->decimal('price', 12, 2);

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
