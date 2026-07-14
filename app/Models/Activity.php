<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Activity extends Model
{
    use HasFactory;

    // Pastikan field ini diisi agar bisa menyimpan data
    protected $fillable = ['user_id', 'description'];

    // Fungsi statis untuk mencatat log
    public static function log($description)
    {
        self::create([
            'user_id' => Auth::id(),
            'description' => $description,
        ]);
    }
    public function user()
    {
        // Sesuaikan 'user_id' dengan nama kolom di tabel activities Anda
        return $this->belongsTo(User::class, 'user_id');
    }
}