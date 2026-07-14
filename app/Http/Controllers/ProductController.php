<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\ProductService;
use App\Models\Category;
use App\Models\Supplier;
use App\Models\Product;
use App\Models\Activity;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\ProductsExport;
use App\Imports\ProductsImport;

class ProductController extends Controller
{
    protected $productService;

    public function __construct(ProductService $productService)
    {
        $this->productService = $productService;
    }

    public function index(Request $request)
{
    // Mulai dengan Query Builder dari model Product
    $query = \App\Models\Product::query();

    // Terapkan filter jika ada request 'filter=low_stock'
    if ($request->has('filter') && $request->filter == 'low_stock') {
        $query->whereColumn('current_stock', '<=', 'minimum_stock');
    }

    // Ambil data produk (bisa disesuaikan dengan logic di Service Anda)
    $products = $query->get();

    // Ambil data pendukung
    $categories = \App\Models\Category::all(); 
    $suppliers = \App\Models\Supplier::all();

    // Tampilkan view
    return view('products.index', compact('products', 'categories', 'suppliers'));

    }

    public function create()
    {
        $categories = Category::all();
        $suppliers = Supplier::all();
        return view('products.create', compact('categories', 'suppliers'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'category_id'    => 'required|exists:categories,id',
            'supplier_id'    => 'required|exists:suppliers,id',
            'name'           => 'required|string|max:255',
            'sku'            => 'nullable|string|unique:products,sku',
            'purchase_price' => 'required|numeric',
            'selling_price'  => 'required|numeric',
            'minimum_stock'  => 'required|integer',
            'description'    => 'nullable|string',
        ]);

        $this->productService->storeProduct($validatedData);

        Activity::log('Menambah produk baru: ' . $request->name);

        return redirect()->route('products.index')->with('success', 'Produk berhasil disimpan!');
    }

    public function show($id)
    {
        return redirect()->route('products.edit', $id);
    }

    public function edit($id)
    {
        $product = $this->productService->getProductById($id);
        if (!$product) {
            return redirect()->route('products.index')->with('error', 'Produk tidak ditemukan!');
        }

        $categories = Category::all();
        $suppliers = Supplier::all();
        return view('products.edit', compact('product', 'categories', 'suppliers'));
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'category_id'    => 'required|exists:categories,id',
            'supplier_id'    => 'required|exists:suppliers,id',
            'name'           => 'required|string|max:255',
            'sku'            => 'nullable|string|unique:products,sku,' . $id,
            'purchase_price' => 'required|numeric',
            'selling_price'  => 'required|numeric',
            'minimum_stock'  => 'required|integer',
            'description'    => 'nullable|string',
        ]);

        if (empty($validatedData['sku'])) {
            $validatedData['sku'] = 'SKU-' . time();
        }

        $this->productService->updateProduct($id, $validatedData); 
        Activity::log('Mengupdate produk: ' . $validatedData['name']);

        return redirect()->route('products.index')->with('success', 'Produk berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $product = Product::find($id);
        if (!$product) {
            return redirect()->route('products.index')->with('error', 'Produk tidak ditemukan.');
        }

        Activity::log('Menghapus produk ' . $product->name);
        $this->productService->deleteProduct($id);

        return redirect()->route('products.index')->with('success', 'Produk berhasil dihapus!');
    }

    public function export() 
    {
        if (ob_get_length()) ob_end_clean();
        return Excel::download(new ProductsExport, 'products.xlsx');
    }

    public function import(Request $request) 
    {
        $request->validate(['file' => 'required|file|mimes:xls,xlsx,csv,txt']);

        try {
            Excel::import(new ProductsImport, $request->file('file'));
            return back()->with('success', 'Produk berhasil diimport!');
        } catch (\Exception $e) {
            return back()->with('error', 'Gagal import: ' . $e->getMessage());
        }
    }

    public function updateMinimumStock(Request $request, $id)
    {
        $product = Product::findOrFail($id);
        $product->update(['minimum_stock' => $request->minimum_stock]);
        return redirect()->back()->with('success', 'Stok minimum diperbarui');
    }
}