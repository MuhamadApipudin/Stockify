<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Transaction;
use App\Models\Product;

class TransactionController extends Controller
{
    public function create()
    {
        $products = Product::all();
        return view('staff.stock.create', compact('products'));
    }

    public function indexPending(Request $request)
    {
        $user = auth()->user();

        // 1. Logika Query
        // Semua status "final" (tidak lagi butuh aksi manajer) harus di-exclude di sini:
        // 'berhasil' & 'selesai' = sudah disetujui, 'ditolak' = sudah ditolak.
        $finalStatuses = ['berhasil', 'selesai', 'ditolak'];

        if ($user->role === 'Manajer Gudang') {
            $query = Transaction::whereNotIn('status', $finalStatuses)
                ->with(['product']);
        } else {
            $query = Transaction::whereNotIn('status', $finalStatuses)->with('product');
        }

        // 2. Filter Search
        if ($request->filled('search')) {
            $search = $request->search;
            $query->whereHas('product', function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('sku', 'like', "%{$search}%");
            });
        }

        // 3. Filter tipe (khusus Staff/Manajer)
        if ($request->filled('type')) {
            $query->where('type', $request->type);
        }

        // 4. Filter tanggal (sesuai input di blade)
        // Gunakan created_at karena kolom `date` bisa saja tidak terisi/berbeda format.
        if ($request->filled('date_from')) {
            $query->whereDate('created_at', '>=', $request->date_from);
        }
        if ($request->filled('date_to')) {
            $query->whereDate('created_at', '<=', $request->date_to);
        }

        // 5. Filter tipe berdasarkan route (untuk halaman staff)
        if ($request->routeIs('staff.stock.incoming')) $query->where('type', 'masuk');
        if ($request->routeIs('staff.stock.outgoing')) $query->where('type', 'keluar');

        $transactions = $query->latest()->paginate(5)->withQueryString();

        // 4. Return View
        if ($user->role === 'Manajer Gudang') {
            // Manajer approval biasanya tampilan full list dari transaksi non-final
            return view('transaction.approve', compact('transactions'));
        } 
        
        if ($request->routeIs('staff.stock.incoming')) {
            return view('staff.stock.incoming', compact('transactions')); 
        } 
        
        return view('staff.stock.outgoing', compact('transactions'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity'   => 'required|integer|min:1',
            'type'       => 'required|in:masuk,keluar'
        ]);

        $user = auth()->user();

        // JIKA ADMIN: Langsung selesai dan update stok
        if ($user->role === 'Admin') {
            DB::transaction(function () use ($request) {
                $product = Product::findOrFail($request->product_id);
                
                // Update stok
                $request->type === 'masuk' ? $product->increment('current_stock', $request->quantity) 
                                           : $product->decrement('current_stock', $request->quantity);

                // Simpan transaksi status selesai
                Transaction::create([
                    'product_id' => $request->product_id,
                    'quantity'   => $request->quantity,
                    'type'       => $request->type,
                    'status'     => 'selesai',
                    'date'       => now()->format('Y-m-d'),
                ]);
            });
            return redirect()->back()->with('success', 'Transaksi Admin berhasil diproses dan stok terupdate!');
        }

        // JIKA STAFF: Masuk ke alur pending (butuh approval)
        Transaction::create([
            'product_id' => $request->product_id,
            'quantity'   => $request->quantity,
            'type'       => $request->type,
            'status'     => 'pending',
            'date'       => now()->format('Y-m-d'),
        ]);

        return redirect()->back()->with('success', 'Transaksi berhasil diinput, menunggu approval Manajer!');
    }

    public function approve($id)
    {
        return DB::transaction(function () use ($id) {
            $transaction = Transaction::findOrFail($id);
            if ($transaction->status !== 'pending') return redirect()->back()->with('error', 'Transaksi sudah diproses.');

            $product = Product::where('id', $transaction->product_id)->lockForUpdate()->firstOrFail();
            if ($transaction->type === 'keluar' && $product->current_stock < $transaction->quantity) {
                return redirect()->back()->with('error', 'Stok tidak mencukupi!');
            }

            $transaction->type === 'masuk' ? $product->increment('current_stock', $transaction->quantity) 
                                           : $product->decrement('current_stock', $transaction->quantity);
            
            $transaction->status = 'berhasil'; // Di sini tetap 'berhasil' sesuai kode Anda
            $transaction->save();

            return redirect()->route('manager.pending')->with('success', 'Transaksi disetujui!');
        });
    }

    public function reject(Request $request, $id)
    {
        $transaction = Transaction::findOrFail($id);

        // Hanya bisa menolak jika statusnya masih 'pending'
        if ($transaction->status !== 'pending') {
            return redirect()->back()->with('error', 'Transaksi sudah tidak bisa ditolak.');
        }

        $transaction->status = 'ditolak';
        // Anda bisa menambahkan kolom 'notes' di database jika ingin manajer memberi alasan
        // $transaction->notes = $request->notes;
        $transaction->save();

        return redirect()->route('manager.pending')->with('success', 'Transaksi berhasil ditolak.');
    }

    public function confirmDirect($id)
    {
        $transaction = Transaction::findOrFail($id);
        $transaction->status = 'selesai';
        $transaction->save();

        return redirect()->back()->with('success', 'Konfirmasi selesai! Data masuk ke laporan.');
    }

    public function indexLaporanSelesai()
    {
        // Ikutkan 'ditolak' supaya manajer tetap bisa melihat riwayat penolakan,
        // bukan cuma transaksi yang disetujui.
        $transactions = Transaction::whereIn('status', ['selesai', 'berhasil', 'ditolak'])
                                    ->with('product')
                                    ->latest()
                                    ->paginate(5);

        return view('manager.laporan-barang', compact('transactions'));
    }

    public function indexStaffCompleted()
    {
        // Sama seperti laporan manajer: staff juga perlu tahu pengajuannya
        // ditolak, bukan sekadar hilang dari daftar pending.
        $transactions = Transaction::whereIn('status', ['selesai', 'berhasil', 'ditolak'])
                                    ->with('product')
                                    ->latest()
                                    ->paginate(5);
        
        return view('staff.completed', compact('transactions'));
    }
}