<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // MySQL ENUM needs a full modify to change allowed values.
        Schema::table('transactions', function (Blueprint $table) {
            $table->enum('status', ['pending', 'berhasil', 'selesai', 'ditolak'])
                ->default('pending')
                ->change();
        });
    }

    public function down(): void
    {
        Schema::table('transactions', function (Blueprint $table) {
            $table->enum('status', ['pending', 'berhasil', 'selesai'])
                ->default('pending')
                ->change();
        });
    }
};

