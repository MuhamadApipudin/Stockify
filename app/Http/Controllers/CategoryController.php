<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    // Menampilkan daftar kategori
    public function index(Request $request)
    {

        $query = Category::query();

        if ($request->filled('search')) {
        $query->where('name', 'like', '%' . $request->search . '%')
              ->orWhere('description', 'like', '%' . $request->search . '%');
    }

    switch ($request->sort) {
        case 'asc':
            $query->orderBy('name', 'asc'); // A ke Z
            break;
        case 'desc':
            $query->orderBy('name', 'desc'); // Z ke A
            break;
        default:
            $query->latest(); // Default: Data Terbaru
            break;
    }
        $categories = $query->paginate(5)->withQueryString();

        return view('categories.index', compact('categories'));
    }


    // Menyimpan kategori baru ke database
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255|unique:categories,name',
            'description' => 'nullable|string',
        ]);

        Category::create($validatedData);

        return redirect()->route('categories.index')->with('success', 'Kategori berhasil ditambahkan!');
    }

    // Mengupdate kategori ke database
    public function update(Request $request, Category $category)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255|unique:categories,name,' . $category->id,
            'description' => 'nullable|string',
        ]);

        $category->update($validatedData);

        return redirect()->route('categories.index')->with('success', 'Kategori berhasil diperbarui!');
    }

    // Menghapus kategori
    public function destroy(Category $category)
    {
        // Cek apakah kategori masih dipakai produk
        if ($category->products()->count() > 0) {
            return back()->with('error', 'Kategori tidak bisa dihapus karena masih digunakan oleh produk!');
        }

        $category->delete();

        return redirect()->route('categories.index')->with('success', 'Kategori berhasil dihapus!');
    }
    public function create()
    {
        return view('categories.create');
    }

    public function edit(Category $category)
    {
        return view('categories.edit', compact('category'));
    }

    // Hapus kategori secara massal (bulk)
    public function bulkDelete(Request $request)
    {
        $validated = $request->validate([
            'ids' => 'required|array|min:1',
            'ids.*' => 'integer|distinct',
        ]);

        $ids = $validated['ids'];

        $categories = Category::whereIn('id', $ids)->get();

        $deleted = 0;
        $skipped = 0;
        $skippedIds = [];

        foreach ($categories as $category) {
            // Jika kategori masih dipakai produk, skip
            if ($category->products()->count() > 0) {
                $skipped++;
                $skippedIds[] = $category->id;
                continue;
            }

            $category->delete();
            $deleted++;
        }

        if ($deleted > 0 && $skipped === 0) {
            return redirect()->route('categories.index')->with('success', 'Kategori berhasil dihapus!');
        }

        if ($deleted > 0 && $skipped > 0) {
            return redirect()->route('categories.index')->with(
                'success',
                "Kategori berhasil dihapus: {$deleted}. Tidak terhapus karena masih dipakai produk: {$skipped}."
            );
        }

        return redirect()->route('categories.index')->with(
            'error',
            'Tidak ada kategori yang dihapus. Pastikan kategori yang dipilih tidak sedang digunakan oleh produk.'
        );
    }
}
