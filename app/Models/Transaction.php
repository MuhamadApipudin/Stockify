<?php

namespace App\Models; // <--- INI WAJIB ADA

use Illuminate\Database\Eloquent\Model;
use App\Models\Product; // Pastikan model Product juga di-import

class Transaction extends Model
{
    protected $fillable = [
        'product_id', 
        'type', 
        'quantity', 
        'date',
         'status',
    ];

    public function product()
    {
        
        return $this->belongsTo(Product::class);
    }
}
