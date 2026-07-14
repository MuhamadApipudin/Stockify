<?php

namespace App\Imports;

use App\Models\Product;
use App\Models\Category;
use App\Models\Supplier;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class ProductsImport implements ToModel, WithHeadingRow
{
    /**
     * @param array $row
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        // 1. Ambil SKU. Jika tidak ada SKU, abaikan baris ini
        $sku = $row['sku'] ?? null;
        if (empty($sku)) {
            return null;
        }

        // 2. Ambil nama Kategori & Supplier dengan pengecekan beberapa kemungkinan nama header
        // (Ini supaya tetap jalan meski header-nya berbeda-beda)
        $catName = $row['kategori'] ?? $row['category_id'] ?? null;
        $supName = $row['supplier'] ?? $row['supplier_id'] ?? null;

        // 3. Cari atau Buat Kategori & Supplier berdasarkan nama
        // Jika nama kosong, kita beri nilai default 'Umum' atau null
        $category = !empty($catName) ? Category::firstOrCreate(['name' => $catName]) : null;
        $supplier = !empty($supName) ? Supplier::firstOrCreate(['name' => $supName]) : null;

        // 4. Update atau Buat Produk
        return Product::updateOrCreate(
            ['sku' => $sku],
            [
                'category_id'    => $category ? $category->id : null,
                'supplier_id'    => $supplier ? $supplier->id : null,
                'name'           => $row['name'] ?? $row['nama_produk'] ?? 'Produk Tanpa Nama',
                'purchase_price' => $row['purchase_price'] ?? $row['harga_beli'] ?? 0,
                'selling_price'  => $row['selling_price'] ?? $row['harga_jual'] ?? 0,
                'minimum_stock'  => $row['minimum_stock'] ?? $row['stok_min'] ?? 0,
                'current_stock'  => $row['current_stock'] ?? $row['stok'] ?? 0,
            ]
        );
    }
    
}