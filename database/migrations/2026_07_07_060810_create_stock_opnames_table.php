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
        Schema::create('stock_opnames', function (Blueprint $table) {
            $table->id();
            
            // ---> TEMPEL DI SINI <---
            $table->foreignId('product_id')->constrained();
            $table->integer('actual_stock'); // Stok fisik yang dihitung
            $table->integer('system_stock'); // Stok yang tercatat di sistem
            $table->text('notes')->nullable(); // Catatan opsional
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stock_opnames');
    }
};