<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::table('products', function (Blueprint $table) {
        if (!Schema::hasColumn('products', 'category_id')) {
            $table->foreignId('category_id')->constrained();
        }
        if (!Schema::hasColumn('products', 'attributes')) {
            $table->json('attributes')->nullable();
        }
        if (!Schema::hasColumn('products', 'stock')) {
            $table->integer('stock')->default(0);
        }
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
