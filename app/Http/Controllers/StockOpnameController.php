<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\StockOpname;
use Illuminate\Http\Request;

class StockOpnameController extends Controller
{
    /**
     * ADMIN  -> lihat semua riwayat (read-only) -> view: stock.index
     * STAFF  -> lihat riwayat laporan miliknya sendiri -> view: staff.stock-opname.index
     */
    public function index()
    {
        $userRole = strtolower(trim(auth()->user()->role));

        if ($userRole === 'admin') {
            $opnames = StockOpname::with('product', 'user')->latest()->get();
            return view('stock.index', compact('opnames'));
        }

        // Staff hanya lihat riwayat laporan miliknya sendiri
        $opnames = StockOpname::with('product', 'user')
            ->where('user_id', auth()->id())
            ->latest()
            ->get();

        return view('staff.stock-opname.index', compact('opnames'));
    }

    /**
     * STAFF GUDANG — form input laporan selisih stok
     */
    public function create()
    {
        $products = Product::all();
        return view('staff.stock-opname.create', compact('products'));
    }

    /**
     * STAFF GUDANG — simpan laporan selisih, status PENDING
     * Stok produk TIDAK berubah di sini, baru berubah saat Manajer approve.
     */
    public function store(Request $request)
    {
        $request->validate([
            'product_id'   => 'required|exists:products,id',
            'actual_stock' => 'required|integer|min:0',
            'notes'        => 'nullable|string',
        ]);

        $product = Product::findOrFail($request->product_id);

        StockOpname::create([
            'product_id'   => $product->id,
            'actual_stock' => $request->actual_stock,
            'system_stock' => $product->stock,
            'notes'        => $request->notes,
            'user_id'      => auth()->id(),
            'status'       => 'pending',
        ]);

        return redirect()
            ->route('staff.stock-opname.create')
            ->with('success', 'Selisih stok "' . $product->name . '" berhasil dilaporkan, menunggu proses dari Manajer.');
    }
}