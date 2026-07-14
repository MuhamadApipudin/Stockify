<?php

namespace App\Repositories;

use App\Models\Product;
use App\Models\Category;
use App\Models\Transaction;
use App\Models\User;
use App\Models\Activity;

class DashboardRepository
{
    public function getProductCount(): int
    {
        return Product::count();
    }

    public function getTransactionCounts(): array
{
    return [
        'masuk'  => Transaction::where('type', 'masuk')
                        ->whereIn('status', ['berhasil', 'selesai'])
                        ->sum('quantity'),
        'keluar' => Transaction::where('type', 'keluar')
                        ->whereIn('status', ['berhasil', 'selesai'])
                        ->sum('quantity'),
    ];
}
    public function getLatestUserActivities()
    {
        return User::latest()->take(5)->get();
    }

   public function getStockChartData()
{
    return Category::all()->map(function($category) {
        $productIds = Product::where('category_id', $category->id)->pluck('id');

        return [
            'category_name' => $category->name,
            'masuk'  => (int) Transaction::whereIn('product_id', $productIds)
                            ->where('type', 'masuk')
                            ->whereIn('status', ['berhasil', 'selesai'])
                            ->sum('quantity'),
            'keluar' => (int) Transaction::whereIn('product_id', $productIds)
                            ->where('type', 'keluar')
                            ->whereIn('status', ['berhasil', 'selesai'])
                            ->sum('quantity'),
        ];
    });
}

   // 1. Fungsi untuk angka di dalam BOX Dashboard (Jumlah)
public function getLowStockCount()
{
    return \App\Models\Product::whereColumn('current_stock', '<=', 'minimum_stock')->count();
}

// 2. Fungsi untuk list/tabel produk yang stoknya menipis
public function getLowStockProducts()
{
    return \App\Models\Product::whereColumn('current_stock', '<=', 'minimum_stock')
                ->limit(10)
                ->get();
}
}