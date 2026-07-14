@extends('example.layouts.default.dashboard')

@section('content')
<link rel="preconnect" href="https://fonts.googleapis.com">
<link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@500;600;700&family=Inter:wght@400;500;600;700&family=JetBrains+Mono:wght@400;500;600;700&display=swap" rel="stylesheet">

<style>
    .font-display { font-family: 'Space Grotesk', sans-serif; }
    .font-mono { font-family: 'JetBrains Mono', monospace; }
    .perforation-v {
        background-image: radial-gradient(circle, rgba(180,83,9,0.25) 1.2px, transparent 1.2px);
        background-size: 2px 9px;
        background-repeat: repeat-y;
    }
</style>

<div class="p-6 min-h-screen space-y-6 font-[Inter]">

    {{-- ============ HEADER ============ --}}
    <div class="relative overflow-hidden flex flex-col lg:flex-row lg:items-center justify-between gap-4 bg-white p-6 rounded-2xl border border-stone-200/70 shadow-[0_1px_2px_rgba(0,0,0,0.04)]">

        <div>
            <div class="flex items-center gap-2.5">
                <h1 class="font-display text-2xl font-semibold text-[#0B1220] tracking-tight">Daftar Produk</h1>
                <span class="px-2.5 py-0.5 text-[11px] font-mono font-semibold bg-teal-50 text-teal-800 rounded-full border border-teal-200">
                    {{ strtolower(auth()->user()->role) === 'admin' ? 'ADMIN' : 'MANAJER' }}
                </span>
            </div>
            <p class="text-xs text-stone-400 mt-1.5">Kelola inventaris, pantau ketersediaan stok, dan riwayat transaksi barang.</p>
        </div>

        <div class="flex flex-wrap items-center gap-2.5">
            <div class="inline-flex p-1 bg-stone-100 rounded-xl border border-stone-200/60 text-xs font-medium">
                <a href="{{ route('products.index') }}"
                   class="px-3 py-1.5 rounded-lg transition-all duration-200 flex items-center gap-1.5 {{ !request('filter') ? 'bg-white text-[#0B1220] shadow-sm font-semibold' : 'text-stone-500 hover:text-[#0B1220]' }}">
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 10h16M4 14h16M4 18h16"></path>
                    </svg>
                    Semua
                </a>
                <a href="{{ route('products.index', ['filter' => 'low_stock']) }}"
                   class="px-3 py-1.5 rounded-lg transition-all duration-200 flex items-center gap-1.5 {{ request('filter') === 'low_stock' ? 'bg-rose-600 text-white shadow-sm font-semibold' : 'text-stone-500 hover:text-rose-600' }}">
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
                    </svg>
                    Stok Menipis
                </a>
            </div>

            @if(strtolower(auth()->user()->role) === 'admin')
                <div class="h-6 w-[1px] bg-stone-200 hidden sm:block"></div>
                <div class="flex items-center gap-2.5 flex-wrap">

                    <a href="{{ route('products.export') }}"
                       class="px-3.5 py-2 text-xs font-semibold text-white bg-emerald-700 hover:bg-emerald-800 rounded-xl transition shadow-sm flex items-center gap-1.5">
                        <svg class="w-3.5 h-3.5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"></path>
                        </svg>
                        Export
                    </a>

                    <form action="{{ route('products.import') }}" method="POST" enctype="multipart/form-data" class="inline-flex">
                        @csrf
                        <label class="px-3.5 py-2 text-xs font-semibold text-white bg-teal-600 hover:bg-teal-700 rounded-xl cursor-pointer transition flex items-center gap-1.5 shadow-sm">
                            <svg class="w-3.5 h-3.5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path>
                            </svg>
                            Import CSV
                            <input type="file" name="file" class="sr-only" required onchange="updateFileName(this)">
                        </label>
                    </form>

                    <a href="{{ route('products.create') }}" class="px-4 py-2 text-xs font-semibold text-white bg-[#0B1220] hover:bg-[#151f33] rounded-xl transition shadow-sm flex items-center gap-1.5">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                        </svg>
                        Tambah Produk
                    </a>

                </div>
            @endif
        </div>
    </div>

    {{-- ============ ALERTS ============ --}}
    @if(session('success'))
        <div class="flex items-center gap-3 p-4 text-xs font-semibold text-emerald-800 bg-emerald-50/90 border border-emerald-200 rounded-2xl shadow-[0_1px_2px_rgba(0,0,0,0.04)]">
            <svg class="w-4 h-4 text-emerald-600 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
            </svg>
            <span>{{ session('success') }}</span>
        </div>
    @endif
    @if(session('error'))
        <div class="flex items-center gap-3 p-4 text-xs font-semibold text-rose-800 bg-rose-50/90 border border-rose-200 rounded-2xl shadow-[0_1px_2px_rgba(0,0,0,0.04)]">
            <svg class="w-4 h-4 text-rose-600 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
            </svg>
            <span>{{ session('error') }}</span>
        </div>
    @endif

    {{-- ============ TABLE — MANIFEST LEDGER ============ --}}
    <div class="bg-white rounded-2xl border border-stone-200/70 shadow-[0_1px_2px_rgba(0,0,0,0.04)] overflow-hidden">
        <div class="flex items-center justify-between px-6 py-4 border-b border-dashed border-stone-200">
            <h3 class="font-display text-sm font-semibold text-[#0B1220]">Manifest Inventaris</h3>
            <span class="font-mono text-[11px] text-stone-400">{{ $products->count() }} ITEM{{ $products->count() === 1 ? '' : 'S' }}</span>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse table-auto">
                <thead>
                    <tr class="bg-stone-50/80 border-b border-stone-100 text-[10px] font-mono font-bold text-stone-400 uppercase tracking-wider">
                        <th class="py-3.5 px-6">Informasi Produk</th>
                        <th class="py-3.5 px-4">SKU</th>
                        <th class="py-3.5 px-4">Kategori</th>
                        <th class="py-3.5 px-4">Supplier</th>
                        <th class="py-3.5 px-4 text-right">Harga Beli</th>
                        <th class="py-3.5 px-4 text-right">Harga Jual</th>
                        <th class="py-3.5 px-4 text-center">Stok Min</th>
                        <th class="py-3.5 px-4 text-center">Stok Saat Ini</th>
                        @if(strtolower(auth()->user()->role) === 'admin')
                            <th class="py-3.5 px-6 text-center">Aksi</th>
                        @endif
                    </tr>
                </thead>

                <tbody class="divide-y divide-stone-100 text-xs">
                    @forelse($products as $product)
                        <tr class="hover:bg-teal-50/30 transition duration-150">
                            <td class="py-4 px-6 whitespace-nowrap">
                                <div class="flex items-center gap-3">
                                    <div class="w-8 h-8 rounded-lg bg-[#0B1220] flex items-center justify-center text-teal-400 font-mono font-bold shrink-0 text-xs">
                                        {{ strtoupper(substr($product->name, 0, 1)) }}
                                    </div>
                                    <span class="font-semibold text-stone-800 text-xs">
                                        {{ $product->name }}
                                    </span>
                                </div>
                            </td>

                            <td class="py-4 px-4 font-mono text-stone-500 whitespace-nowrap">
                                <span class="bg-stone-100 px-2 py-0.5 rounded-md text-[11px] border border-stone-200/60">
                                    {{ $product->sku }}
                                </span>
                            </td>

                            <td class="py-4 px-4 text-center font-medium text-stone-600 whitespace-nowrap">
                                <span class="font-semibold text-stone-700">{{ $product->category->name ?? '-' }}</span>
                            </td>

                            <td class="py-4 px-4 text-center font-medium text-stone-600 whitespace-nowrap">
                                <span class="font-semibold text-stone-700">{{ $product->supplier->name ?? '-' }}</span>
                            </td>

                            <td class="py-4 px-4 text-right font-mono font-medium text-stone-600 whitespace-nowrap">
                                Rp {{ number_format($product->purchase_price, 0, ',', '.') }}
                            </td>

                            <td class="py-4 px-4 text-right font-mono font-bold text-stone-800 whitespace-nowrap">
                                Rp {{ number_format($product->selling_price, 0, ',', '.') }}
                            </td>

                            <td class="py-4 px-4 text-center font-mono text-stone-400 font-medium whitespace-nowrap">
                                {{ $product->minimum_stock }}
                            </td>

                            <td class="py-4 px-4 text-center whitespace-nowrap">
                                @if($product->current_stock <= $product->minimum_stock)
                                    <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-[11px] font-mono font-bold bg-rose-50 text-rose-700 border border-rose-200">
                                        <span class="w-1.5 h-1.5 rounded-full bg-rose-500 animate-pulse"></span>
                                        {{ $product->current_stock }} · KRITIS
                                    </span>
                                @else
                                    <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-[11px] font-mono font-bold bg-emerald-50 text-emerald-700 border border-emerald-200">
                                        <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span>
                                        {{ $product->current_stock }}
                                    </span>
                                @endif
                            </td>

                            @if(strtolower(auth()->user()->role) === 'admin')
                                <td class="py-4 px-6 text-right whitespace-nowrap">
                                    <div class="flex items-center justify-end gap-1.5">
                                        <a href="{{ route('products.edit', $product->id) }}"
                                             class="px-2.5 py-1.5 font-semibold text-blue-700 bg-blue-50 hover:bg-blue-100 border border-blue-200/80 rounded-lg transition"
                                            title="Edit Produk">
                                                 Edit
                                                 </a>

                                        <form action="{{ route('products.destroy', $product->id) }}" method="POST" onsubmit="return confirm('Yakin hapus produk ini?')" class="inline-block">
                                            @csrf @method('DELETE')
                                            <button type="submit" class="px-2.5 py-1.5 font-semibold text-rose-700 bg-rose-50 hover:bg-rose-100 border border-rose-200/80 rounded-lg transition" title="Hapus Produk">
                                            Hapus
                                             </button>
                                        </form>

                                        <button type="button"
                                                data-modal-target="transaction-modal-{{ $product->id }}"
                                                data-modal-toggle="transaction-modal-{{ $product->id }}"
                                                class="px-3 py-1.5 font-semibold text-teal-800 bg-teal-50 hover:bg-teal-100 border border-teal-200/80 rounded-lg transition shadow-2xs">
                                            + Transaksi
                                        </button>
                                    </div>
                                </td>
                            @endif
                        </tr>
                    @empty
                        <tr>
                            <td colspan="{{ strtolower(auth()->user()->role) === 'admin' ? 8 : 7 }}" class="py-14 text-center text-stone-400">
                                <div class="flex flex-col items-center justify-center">
                                    <div class="w-12 h-12 rounded-2xl bg-stone-100 flex items-center justify-center mb-3">
                                        <svg class="w-6 h-6 text-stone-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                                        </svg>
                                    </div>
                                    <span class="text-sm font-semibold text-stone-600">Tidak ada produk ditemukan</span>
                                    <span class="text-xs text-stone-400 mt-0.5 font-mono">Belum ada data produk atau tidak sesuai dengan filter.</span>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

</div>

{{-- ============ TRANSACTION MODAL ============ --}}
@if(strtolower(auth()->user()->role) === 'admin')
    @foreach($products as $product)
        <div id="transaction-modal-{{ $product->id }}" tabindex="-1" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full bg-[#0B1220]/50 backdrop-blur-sm transition">
            <div class="relative p-4 w-full max-w-md max-h-full">
                <div class="relative bg-white rounded-2xl shadow-xl border border-stone-200/70 overflow-hidden">

                    <div class="p-5 border-b border-stone-100 flex justify-between items-center bg-[#0B1220]">
                        <div>
                            <h3 class="font-display text-sm font-semibold text-white">Pengajuan Transaksi</h3>
                            <p class="text-xs text-slate-400 mt-0.5 font-mono">{{ $product->name }}</p>
                        </div>
                        <span class="bg-teal-500/10 text-teal-300 border border-teal-500/20 text-[10px] font-mono font-bold px-2.5 py-0.5 rounded-full uppercase">
                            Pending
                        </span>
                    </div>

                    <form action="{{ route('transactions.store') }}" method="POST">
                        @csrf
                        <input type="hidden" name="product_id" value="{{ $product->id }}">

                        <div class="p-5 space-y-4">
                            <div class="p-3 bg-teal-50/80 border border-teal-200 text-teal-900 text-xs rounded-xl flex items-start gap-2">
                                <svg class="w-4 h-4 text-teal-600 mt-0.5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                <span>Transaksi akan dikirim ke <b>Manajer</b> untuk diapprove sebelum memperbarui stok fisik.</span>
                            </div>

                            <div>
                                <label class="block mb-1.5 text-xs font-mono font-bold text-stone-500 uppercase tracking-wider">Tipe Transaksi</label>
                                <select name="type" class="w-full px-3 py-2 text-xs bg-stone-50 border border-stone-200 rounded-xl focus:bg-white focus:ring-2 focus:ring-teal-500 focus:outline-none transition">
                                    <option value="masuk">Barang Masuk (+)</option>
                                    <option value="keluar">Barang Keluar (-)</option>
                                </select>
                            </div>

                            <div>
                                <label class="block mb-1.5 text-xs font-mono font-bold text-stone-500 uppercase tracking-wider">Jumlah Kuantitas</label>
                                <input type="number" name="quantity" required min="1" class="w-full px-3 py-2 text-xs bg-stone-50 border border-stone-200 rounded-xl focus:bg-white focus:ring-2 focus:ring-teal-500 focus:outline-none transition" placeholder="Masukkan jumlah unit...">
                            </div>
                        </div>

                        <div class="p-4 border-t border-dashed border-stone-200 bg-stone-50/50 flex justify-end gap-2">
                            <button type="button" data-modal-hide="transaction-modal-{{ $product->id }}" class="px-4 py-2 text-xs font-semibold text-stone-500 hover:text-stone-800 transition">
                                Batal
                            </button>
                            <button type="submit" class="px-4 py-2 text-xs font-semibold text-white bg-[#0B1220] hover:bg-[#151f33] rounded-xl shadow-sm transition">
                                Kirim Pengajuan
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endforeach
@endif

<script>
    function updateFileName(input) {
        if (input.files && input.files.length > 0) {
            input.closest('form').submit();
        }
    }
</script>
@endsection