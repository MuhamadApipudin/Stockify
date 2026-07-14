<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Database\QueryException;

class ProductImportController extends Controller
{
    public function import(Request $request)
    {

        // 1. Validasi file
        $request->validate([
            'file' => 'required|file|mimes:csv,txt'
        ]);

        $file = $request->file('file');

        // 2. Membaca file dengan pemisah titik koma (;)
        $data = array_map(function($line) {
            return str_getcsv($line, ";"); 
        }, file($file->getRealPath()));
        
        // 3. Hapus baris header
        if (count($data) > 0) {
            array_shift($data);
        }

        // 4. Proses import dengan penanganan error
        foreach ($data as $index => $row) {
           
            if (empty($row[3]) && empty($row[4])) {
                continue;
            }

            try {
                // Jika kolom category_id & supplier_id berisi nama, simpan sebagai nama.
                // Kalau ternyata berisi integer id, tetap akan bekerja karena firstOrCreate menerima string/int.
                $category = \App\Models\Category::firstOrCreate(['name' => $row[1]]);
                $supplier = \App\Models\Supplier::firstOrCreate(['name' => $row[2]]);

                \App\Models\Product::updateOrCreate(
                    ['sku' => $row[4]],
                    [
                        'category_id'    => $category->id,
                        'supplier_id'    => $supplier->id,
                        'name'           => $row[3],
                        'purchase_price' => $row[5] ?? 0,
                        'selling_price'  => $row[6] ?? 0,
                        'minimum_stock'  => $row[7] ?? 0,
                        'current_stock'  => $row[8] ?? 0,
                    ]
                );
            } catch (\Illuminate\Database\QueryException $e) {
                return back()->with('error', 'Gagal import di baris ke-' . ($index + 2) . ': ' . $e->getMessage());
            }
        }

        return back()->with('success', 'Data berhasil diimpor ke database!');
    }
}
