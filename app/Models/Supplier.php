<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    use HasFactory;

    // Mengizinkan kolom ini diisi secara massal lewat form
    protected $fillable = ['name', 'phone', 'address'];
}