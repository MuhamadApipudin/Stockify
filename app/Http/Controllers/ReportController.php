<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Transaction;
use App\Models\Activity;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    // Laporan Stok Barang (Admin)
    public function stock(Request $request)
    {
        $query = Product::with('category');

        if ($request->filled('category_id')) {
            $query->where('category_id', $request->category_id);
        }

        $products = $query->get();
        return view('reports.stock', compact('products'));
    }

    // Laporan Transaksi Detail (Admin)
    public function transactions(Request $request)
    {
        $query = Transaction::with(['product']);

        if ($request->filled(['start_date', 'end_date'])) {
            $query->whereBetween('created_at', [
                $request->start_date . ' 00:00:00', 
                $request->end_date . ' 23:59:59'
            ]);
        }

        $transactions = $query->latest()->paginate(5);
        return view('reports.transaction', compact('transactions'));
    }

    // Laporan Aktivitas (Admin)
    public function activities()
    {
        $activities = Activity::with('user')->latest()->paginate(5);
        return view('reports.activities', compact('activities'));
    }

    // Laporan Barang Masuk & Keluar (Manajer - Ringkasan Per Produk)
    public function stockFlow(Request $request)
    {
        $query = Product::query();

        // Jika Anda ingin filter berdasarkan periode di laporan manajer
        if ($request->filled(['start_date', 'end_date'])) {
            $query->withSum(['transactions as total_masuk' => function($q) use ($request) {
                $q->where('type', 'masuk')
                  ->whereBetween('created_at', [$request->start_date . ' 00:00:00', $request->end_date . ' 23:59:59']);
            }], 'quantity');

            $query->withSum(['transactions as total_keluar' => function($q) use ($request) {
                $q->where('type', 'keluar')
                  ->whereBetween('created_at', [$request->start_date . ' 00:00:00', $request->end_date . ' 23:59:59']);
            }], 'quantity');
        } else {
            // Tanpa filter tanggal (semua waktu)
            $query->withSum(['transactions as total_masuk' => function($q) {
                $q->where('type', 'masuk');
            }], 'quantity');

            $query->withSum(['transactions as total_keluar' => function($q) {
                $q->where('type', 'keluar');
            }], 'quantity');
        }

        $data = $query->get();

        return view('manager.laporan-barang', compact('data'));
    }
}