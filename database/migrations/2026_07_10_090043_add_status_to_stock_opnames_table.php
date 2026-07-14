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
    Schema::table('stock_opnames', function (Blueprint $table) {
        // Tambahkan kolom status dengan nilai default 'pending'
        $table->string('status')->default('pending')->after('notes');
    });
}

public function down()
{
    Schema::table('stock_opnames', function (Blueprint $table) {
        $table->dropColumn('status');
    });
}
};
