<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up() {
    Schema::create('stock_adjustments', function (Blueprint $table) {
        $table->id();
        $table->foreignId('product_id')->constrained();
        $table->integer('previous_stock');
        $table->integer('new_stock');
        $table->integer('adjustment_amount'); // Selisih (+ atau -)
        $table->string('reason'); // Alasan: Rusak, Hilang, Selisih fisik, dll
        $table->foreignId('user_id')->constrained(); // Siapa yang menginput
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stock_adjustments');
    }
};
