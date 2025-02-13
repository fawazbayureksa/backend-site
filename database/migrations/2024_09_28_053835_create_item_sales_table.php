<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('item_sales', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('sale_id'); // relasi ke tabel penjualan
            $table->unsignedBigInteger('product_id'); // relasi ke tabel barang
            $table->integer('qty');
            $table->timestamps();

            // $table->foreign('sale_id')->references('id')->on('sales');
            // $table->foreign('product_id')->references('id')->on('products');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('item_sale');
    }
};
