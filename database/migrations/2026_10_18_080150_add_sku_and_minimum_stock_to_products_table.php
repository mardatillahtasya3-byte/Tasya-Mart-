
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->string('sku')
                ->nullable()
                ->unique()
                ->after('id');

            $table->unsignedInteger('minimum_stock')
                ->default(0)
                ->after('stock');
        });

        // Mengisi SKU untuk produk lama yang sudah tersimpan.
        DB::table('products')
            ->orderBy('id')
            ->select('id')
            ->get()
            ->each(function ($product) {
                DB::table('products')
                    ->where('id', $product->id)
                    ->update([
                        'sku' => 'SKU-' . str_pad(
                            (string) $product->id,
                            5,
                            '0',
                            STR_PAD_LEFT
                        ),
                    ]);
            });
    }

    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropUnique(['sku']);
            $table->dropColumn(['sku', 'minimum_stock']);
        });
    }
};
