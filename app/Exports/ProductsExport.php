<?php

namespace App\Exports;

use App\Models\Product;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ProductsExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        return Product::with(['category', 'supplier'])->get()->map(function ($product) {
            return [
                'sku'            => $product->sku,
                'name'           => $product->name,
                'category_id'    => $product->category->name ?? '', // Mengirim NAMA, agar Import bisa mencari/membuatnya
                'supplier_id'    => $product->supplier->name ?? '', // Mengirim NAMA, agar Import bisa mencari/membuatnya
                'purchase_price' => $product->purchase_price,
                'selling_price'  => $product->selling_price,
                'minimum_stock'  => $product->minimum_stock,
                'current_stock'  => $product->current_stock,
            ];
        });
    }

    public function headings(): array
    {
        // PENTING: Key ini harus sama persis dengan yang dipanggil di $row['...'] pada ProductsImport
        return [
            'sku', 
            'name', 
            'category_id', 
            'supplier_id', 
            'purchase_price', 
            'selling_price', 
            'minimum_stock', 
            'current_stock'
        ];
    }
}