<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{ 
    protected $fillable = [
    'name', 'sku', 'category_id', 'supplier_id', 
    'purchase_price', 'selling_price', 'minimum_stock', 
    'description', 'attributes', 'stock', 'current_stock' // Tambahkan ini
];

    public function category() {
        return $this->belongsTo(Category::class);
    }

    public function supplier() {
        return $this->belongsTo(Supplier::class);
    }

    public function attributes() {
        return $this->hasMany(ProductAttribute::class);
    }

    public function transactions() {
        return $this->hasMany(\App\Models\Transaction::class);
    }
    
}