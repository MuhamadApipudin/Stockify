<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Supplier;
use App\Models\Activity;
use App\Models\Transaction;

class SupplierController extends Controller
{
    // Menampilkan daftar supplier dengan Search, Sort, dan Pagination
    public function index(Request $request)
    {
        $query = Supplier::query();

        // 2. Pencarian
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', '%' . $search . '%')
                  ->orWhere('phone', 'like', '%' . $search . '%')
                  ->orWhere('address', 'like', '%' . $search . '%');
            });
        }

        // 3. Filter status
        if ($request->has('status') && $request->status !== '') {
            $query->where('status', $request->status);
        }

        // 4. Pengurutan
        $sort = $request->input('sort', 'newest');
        if ($sort === 'name_asc') {
            $query->orderBy('name', 'asc');
        } else {
            $query->orderBy('created_at', 'desc');
        }

        $suppliers = $query->paginate(5)->withQueryString();

        // 6. Tentukan view berdasarkan role user
        $role = strtolower(trim(auth()->user()->role ?? ''));

        if ($role === 'admin') {
            $activeSuppliers = Supplier::where('status', 'aktif')->count();
            $successShipments = Transaction::where('type', 'masuk')->count();

            return view('suppliers.index', compact('suppliers', 'activeSuppliers', 'successShipments'));
        }

        return view('manager.suppliers.index', compact('suppliers'));
    }

    public function create()
    {
        return redirect()->route('suppliers.index');
    }

    public function store(Request $request)
    {
        // Validasi: Wajib angka, minimal 10 digit, maksimal 15 digit
        $validatedData = $request->validate([
            'name'    => 'required|string|max:255',
            'phone'   => 'required|numeric|digits_between:10,15',
            'address' => 'required|string',
        ]);

        $supplier = Supplier::create($validatedData);
        Activity::log('Menambah supplier baru: ' . $supplier->name);

        return redirect()->route('suppliers.index')->with('success', 'Supplier berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $supplier = Supplier::findOrFail($id);
        return view('suppliers.edit', compact('supplier'));
    }

    public function update(Request $request, $id)
    {
        // Validasi ketat untuk update
        $validatedData = $request->validate([
            'name'    => 'required|string|max:255',
            'phone'   => 'required|numeric|digits_between:10,15',
            'address' => 'required|string',
        ]);

        $supplier = Supplier::findOrFail($id);
        $supplier->update($validatedData);
        Activity::log('Mengupdate supplier: ' . $supplier->name);

        return redirect()->route('suppliers.index')->with('success', 'Supplier berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $supplier = Supplier::findOrFail($id);
        
        Activity::log('Menghapus supplier: ' . $supplier->name);
        $supplier->delete();

        return redirect()->route('suppliers.index')->with('success', 'Supplier berhasil dihapus!');
    }

    public function bulkDelete(Request $request)
    {
        $request->validate([
            'ids' => 'required|array',
            'ids.*' => 'exists:suppliers,id',
        ]);

        Supplier::destroy($request->ids);

        return redirect()->route('suppliers.index')->with('success', count($request->ids) . ' Supplier berhasil dihapus.');
    }
}