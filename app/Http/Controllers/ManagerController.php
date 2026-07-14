<?php

namespace App\Http\Controllers;

use App\Models\StockOpname;
use Illuminate\Http\RedirectResponse;

class ManagerController extends Controller
{
    public function stockOpnames()
    {
        $opnames = StockOpname::with('product', 'user')
            ->where('status', 'pending')
            ->latest()
            ->get();

        return view('manager.stock-opname', compact('opnames'));
    }

    public function approveOpname($id): RedirectResponse
    {
        $opname = StockOpname::findOrFail($id);

        $opname->update(['status' => 'approved']);

        $opname->product->update(['stock' => $opname->actual_stock]);

        return redirect()->back()->with('success', 'Stock opname disetujui, stok produk telah diperbarui.');
    }

    public function rejectOpname($id): RedirectResponse
    {
        $opname = StockOpname::findOrFail($id);
        $opname->update(['status' => 'rejected']);

        return redirect()->back()->with('success', 'Stock opname ditolak.');
    }
}