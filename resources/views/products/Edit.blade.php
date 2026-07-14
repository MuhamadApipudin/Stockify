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
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
        </svg>
    </div>
    <div>
        <h1 class="font-display text-xl font-semibold text-[#0B1220]">Edit Produk</h1>
        <p class="text-xs text-stone-400 mt-0.5">{{ $product->name }}</p>
    </div>
</div>

<div class="p-6 space-y-6 font-[Inter]">
    <div class="bg-white border border-stone-200/70 rounded-2xl shadow-[0_1px_2px_rgba(0,0,0,0.04)] overflow-hidden">

        <form action="{{ route('products.update', $product->id) }}" method="POST" class="p-6">
            @csrf
            @method('PUT')

            <div class="grid grid-cols-1 gap-5 md:grid-cols-2">
                {{-- Nama Produk --}}
                <div class="space-y-1.5">
                    <label for="name" class="text-xs font-mono font-bold text-stone-600 uppercase tracking-wider block">Nama Produk</label>
                    <input type="text" name="name" id="name" value="{{ $product->name }}"
                           class="w-full px-4 py-2.5 bg-stone-50 border border-stone-200 rounded-xl text-sm text-stone-800 focus:ring-2 focus:ring-teal-500/20 focus:border-teal-500 transition outline-none" required>
                </div>

                {{-- SKU --}}
                <div class="space-y-1.5">
                    <label for="sku" class="text-xs font-mono font-bold text-stone-600 uppercase tracking-wider block">SKU</label>
                    <input type="text" name="sku" id="sku" value="{{ $product->sku }}"
                           class="w-full px-4 py-2.5 bg-stone-50 border border-stone-200 rounded-xl text-sm font-mono text-stone-800 focus:ring-2 focus:ring-teal-500/20 focus:border-teal-500 transition outline-none">
                </div>

                {{-- Kategori --}}
                <div class="space-y-1.5">
                    <label for="category_id" class="text-xs font-mono font-bold text-stone-600 uppercase tracking-wider block">Pilih Kategori</label>
                    <select name="category_id" id="category_id"
                            class="w-full px-4 py-2.5 bg-stone-50 border border-stone-200 rounded-xl text-sm text-stone-800 focus:ring-2 focus:ring-teal-500/20 focus:border-teal-500 transition outline-none cursor-pointer" required>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}" {{ $product->category_id == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>

                {{-- Supplier --}}
                <div class="space-y-1.5">
                    <label for="supplier_id" class="text-xs font-mono font-bold text-stone-600 uppercase tracking-wider block">Pilih Supplier</label>
                    <select name="supplier_id" id="supplier_id"
                            class="w-full px-4 py-2.5 bg-stone-50 border border-stone-200 rounded-xl text-sm text-stone-800 focus:ring-2 focus:ring-teal-500/20 focus:border-teal-500 transition outline-none cursor-pointer" required>
                        @foreach($suppliers as $supplier)
                            <option value="{{ $supplier->id }}" {{ $product->supplier_id == $supplier->id ? 'selected' : '' }}>{{ $supplier->name }}</option>
                        @endforeach
                    </select>
                </div>

                {{-- Harga Beli --}}
                <div class="space-y-1.5">
                    <label for="purchase_price" class="text-xs font-mono font-bold text-stone-600 uppercase tracking-wider block">Harga Beli</label>
                    <div class="relative">
                        <span class="absolute inset-y-0 left-0 pl-4 flex items-center text-xs font-mono text-stone-400">Rp</span>
                        <input type="number" name="purchase_price" id="purchase_price" value="{{ $product->purchase_price }}"
                               class="w-full pl-10 pr-4 py-2.5 bg-stone-50 border border-stone-200 rounded-xl text-sm font-mono text-stone-800 focus:ring-2 focus:ring-teal-500/20 focus:border-teal-500 transition outline-none" required>
                    </div>
                </div>

                {{-- Harga Jual --}}
                <div class="space-y-1.5">
                    <label for="selling_price" class="text-xs font-mono font-bold text-stone-600 uppercase tracking-wider block">Harga Jual</label>
                    <div class="relative">
                        <span class="absolute inset-y-0 left-0 pl-4 flex items-center text-xs font-mono text-stone-400">Rp</span>
                        <input type="number" name="selling_price" id="selling_price" value="{{ $product->selling_price }}"
                               class="w-full pl-10 pr-4 py-2.5 bg-stone-50 border border-stone-200 rounded-xl text-sm font-mono text-stone-800 focus:ring-2 focus:ring-teal-500/20 focus:border-teal-500 transition outline-none" required>
                    </div>
                </div>

                {{-- Stok Minimum --}}
                <div class="space-y-1.5">
                    <label for="minimum_stock" class="text-xs font-mono font-bold text-stone-600 uppercase tracking-wider block">Stok Minimum</label>
                    <input type="number" name="minimum_stock" id="minimum_stock" value="{{ $product->minimum_stock }}"
                           class="w-full px-4 py-2.5 bg-stone-50 border border-stone-200 rounded-xl text-sm font-mono text-stone-800 focus:ring-2 focus:ring-teal-500/20 focus:border-teal-500 transition outline-none" required>
                </div>

                {{-- Deskripsi --}}
                <div class="md:col-span-2 space-y-1.5">
                    <label for="description" class="text-xs font-mono font-bold text-stone-600 uppercase tracking-wider block">Deskripsi Produk</label>
                    <textarea name="description" id="description" rows="4"
                              class="w-full px-4 py-2.5 bg-stone-50 border border-stone-200 rounded-xl text-sm text-stone-800 focus:ring-2 focus:ring-teal-500/20 focus:border-teal-500 transition outline-none">{{ $product->description }}</textarea>
                </div>
            </div>

            <div class="mt-6 pt-5 border-t border-dashed border-stone-200 flex items-center gap-3">
                <button type="submit" class="inline-flex items-center gap-2 px-5 py-2.5 bg-[#0B1220] hover:bg-[#151f33] text-white rounded-xl text-xs font-semibold shadow-sm transition">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                    Perbarui Produk
                </button>
                <a href="{{ route('products.index') }}" class="px-5 py-2.5 bg-stone-100 hover:bg-stone-200 text-stone-600 rounded-xl text-xs font-semibold transition">
                    Batal
                </a>
            </div>
        </form>
    </div>
</div>
@endsection