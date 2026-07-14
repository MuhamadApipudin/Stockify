<?php
namespace App\Repositories;

use App\Models\StockTransaction;

class StockTransactionRepository
{
    public function getTransactionHistory()
    {
        // Menarik data transaksi beserta relasi produk, kategori produk, dan user
        return StockTransaction::with(['product.category', 'user'])
                                ->orderBy('date', 'desc')
                                ->get();
    }
}