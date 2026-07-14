<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    // Mengizinkan pengisian data key dan value
    protected $fillable = ['key', 'value'];
}