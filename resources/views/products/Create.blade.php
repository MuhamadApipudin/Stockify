@extends('example.layouts.default.dashboard')
@section('content')
<link rel="preconnect" href="https://fonts.googleapis.com">
<link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@500;600;700&family=Inter:wght@400;500;600;700&family=JetBrains+Mono:wght@400;500;600;700&display=swap" rel="stylesheet">

<style>
    .font-display { font-family: 'Space Grotesk', sans-serif; }
    .font-mono { font-family: 'JetBrains Mono', monospace; }
</style>

<div class="p-6 pb-4 bg-white border-b border-dashed border-stone-200 flex items-center gap-3.5 font-[Inter]">
    <div class="p-2.5 bg-[#0B1220] text-teal-400 rounded-xl shrink-0">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
        </svg>
    </div>
    <div>
        <h1 class="font-display text-xl font-semibold text-[#0B1220]">Tambah Produk Baru</h1>
        <p class="text-xs text-stone-400 mt-0.5">Lengkapi detail produk untuk menambahkannya ke inventaris.</p>
    </div>
</div>

<div class="p-6 space-y-6 font-[Inter]">
    <div class="bg-white border border-stone-200/70 rounded-2xl shadow-[0_1px_2px_rgba(0,0,0,0.04)] overflow-hidden">

        {{-- Form mengarah ke route store dengan method POST --}}
        <form action="{{ route('products.store') }}" method="POST" class="p-6 space-y-6">
            @csrf {{-- Token keamanan wajib Laravel --}}

            <div class="grid grid-cols-1 gap-5 md:grid-cols-2">
                {{-- Nama Produk --}}
                <div class="space-y-1.5">
                    <label for="name" class="text-xs font-mono font-bold text-stone-600 uppercase tracking-wider block">Nama Produk <span class="text-rose-500">*</span></label>
                    <input type="text" name="name" id="name" placeholder="Contoh: Laptop ASUS ROG"
                           class="w-full px-4 py-2.5 bg-stone-50 border border-stone-200 rounded-xl text-sm text-stone-800 focus:ring-2 focus:ring-teal-500/20 focus:border-teal-500 transition outline-none" required>
                </div>

                {{-- SKU (Boleh dikosongkan karena ada auto-generate di Service) --}}
                <div class="space-y-1.5">
                    <label for="sku" class="text-xs font-mono font-bold text-stone-600 uppercase tracking-wider block">SKU <span class="text-stone-400 normal-case font-sans font-normal">(opsional)</span></label>
                    <input type="text" name="sku" id="sku" placeholder="Kosongkan untuk generate otomatis"
                           class="w-full px-4 py-2.5 bg-stone-50 border border-stone-200 rounded-xl text-sm font-mono text-stone-800 focus:ring-2 focus:ring-teal-500/20 focus:border-teal-500 transition outline-none">
                </div>

                {{-- Kategori --}}
                <div class="space-y-1.5">
                    <label for="category_id" class="text-xs font-mono font-bold text-stone-600 uppercase tracking-wider block">Pilih Kategori <span class="text-rose-500">*</span></label>
                    <select name="category_id" id="category_id"
                            class="w-full px-4 py-2.5 bg-stone-50 border border-stone-200 rounded-xl text-sm text-stone-800 focus:ring-2 focus:ring-teal-500/20 focus:border-teal-500 transition outline-none cursor-pointer" required>
                        <option value="">-- Pilih Kategori --</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>

                {{-- Supplier --}}
                <div class="space-y-1.5">
                    <label for="supplier_id" class="text-xs font-mono font-bold text-stone-600 uppercase tracking-wider block">Pilih Supplier <span class="text-rose-500">*</span></label>
                    <select name="supplier_id" id="supplier_id"
                            class="w-full px-4 py-2.5 bg-stone-50 border border-stone-200 rounded-xl text-sm text-stone-800 focus:ring-2 focus:ring-teal-500/20 focus:border-teal-500 transition outline-none cursor-pointer" required>
                        <option value="">-- Pilih Supplier --</option>
                        @foreach($suppliers as $supplier)
                            <option value="{{ $supplier->id }}">{{ $supplier->name }}</option>
                        @endforeach
                    </select>
                </div>

                {{-- Harga Beli --}}
                <div class="space-y-1.5">
                    <label for="purchase_price" class="text-xs font-mono font-bold text-stone-600 uppercase tracking-wider block">Harga Beli <span class="text-rose-500">*</span></label>
                    <div class="relative">
                        <span class="absolute inset-y-0 left-0 pl-4 flex items-center text-xs font-mono text-stone-400">Rp</span>
                        <input type="number" name="purchase_price" id="purchase_price" placeholder="0"
                               class="w-full pl-10 pr-4 py-2.5 bg-stone-50 border border-stone-200 rounded-xl text-sm font-mono text-stone-800 focus:ring-2 focus:ring-teal-500/20 focus:border-teal-500 transition outline-none" required>
                    </div>
                </div>

                {{-- Harga Jual --}}
                <div class="space-y-1.5">
                    <label for="selling_price" class="text-xs font-mono font-bold text-stone-600 uppercase tracking-wider block">Harga Jual <span class="text-rose-500">*</span></label>
                    <div class="relative">
                        <span class="absolute inset-y-0 left-0 pl-4 flex items-center text-xs font-mono text-stone-400">Rp</span>
                        <input type="number" name="selling_price" id="selling_price" placeholder="0"
                               class="w-full pl-10 pr-4 py-2.5 bg-stone-50 border border-stone-200 rounded-xl text-sm font-mono text-stone-800 focus:ring-2 focus:ring-teal-500/20 focus:border-teal-500 transition outline-none" required>
                    </div>
                </div>

                {{-- Stok Minimum --}}
                <div class="space-y-1.5">
                    <label for="minimum_stock" class="text-xs font-mono font-bold text-stone-600 uppercase tracking-wider block">Stok Minimum <span class="text-rose-500">*</span></label>
                    <input type="number" name="minimum_stock" id="minimum_stock" value="10"
                           class="w-full px-4 py-2.5 bg-stone-50 border border-stone-200 rounded-xl text-sm font-mono text-stone-800 focus:ring-2 focus:ring-teal-500/20 focus:border-teal-500 transition outline-none" required>
                </div>

                {{-- Deskripsi (Full Width) --}}
                <div class="md:col-span-2 space-y-1.5">
                    <label for="description" class="text-xs font-mono font-bold text-stone-600 uppercase tracking-wider block">Deskripsi Produk</label>
                    <textarea name="description" id="description" rows="4" placeholder="Tulis deskripsi produk di sini..."
                              class="w-full px-4 py-2.5 bg-stone-50 border border-stone-200 rounded-xl text-sm text-stone-800 focus:ring-2 focus:ring-teal-500/20 focus:border-teal-500 transition outline-none"></textarea>
                </div>

                {{-- Atribut Produk (Tambahan) --}}
                <div class="md:col-span-2 p-4 bg-stone-50 rounded-xl border border-dashed border-stone-300">
                    <label for="attributes" class="text-xs font-mono font-bold text-stone-600 uppercase tracking-wider block mb-1">Atribut Produk <span class="text-stone-400 normal-case font-sans font-normal">(opsional)</span></label>
                    <p class="text-xs text-stone-400 mb-2">Format JSON, contoh: <code class="font-mono bg-stone-200/60 px-1.5 py-0.5 rounded">{"ukuran": "L", "warna": "Hitam"}</code></p>
                    <textarea name="attributes" id="attributes" rows="2" placeholder='{"ukuran": "L", "warna": "Hitam"}'
                              class="w-full px-4 py-2.5 bg-white border border-stone-200 rounded-xl text-sm font-mono text-stone-800 focus:ring-2 focus:ring-teal-500/20 focus:border-teal-500 transition outline-none"></textarea>
                </div>
            </div>

            <div class="pt-5 border-t border-dashed border-stone-200 flex items-center gap-3">
                <button type="submit" class="inline-flex items-center gap-2 px-5 py-2.5 bg-[#0B1220] hover:bg-[#151f33] text-white rounded-xl text-xs font-semibold shadow-sm transition">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                    Simpan Produk
                </button>
                <a href="{{ route('products.index') }}" class="px-5 py-2.5 bg-stone-100 hover:bg-stone-200 text-stone-600 rounded-xl text-xs font-semibold transition">
                    Batal
                </a>
            </div>
        </form>
    </div>
</div>
@endsection