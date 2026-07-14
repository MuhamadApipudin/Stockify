<?php
namespace App\Repositories;

use App\Models\Product;

class ProductRepository
{
    public function create(array $data)
    {
        return Product::create($data);
    }

    public function getAll()
    {
        return Product::with(['category', 'supplier'])->get();
    }
}