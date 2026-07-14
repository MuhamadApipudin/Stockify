@extends('example.layouts.default.dashboard')

@section('content')
<link rel="preconnect" href="https://fonts.googleapis.com">
<link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@500;600;700&family=Inter:wght@400;500;600;700&family=JetBrains+Mono:wght@400;500;600;700&display=swap" rel="stylesheet">

<style>
    .font-display { font-family: 'Space Grotesk', sans-serif; }
    .font-mono { font-family: 'JetBrains Mono', monospace; }
</style>

<div class="container mx-auto p-6 font-[Inter]">

    <div class="flex items-center gap-3.5 pb-4 mb-6 border-b border-dashed border-stone-200">
        <div class="p-2.5 bg-[#0B1220] text-teal-400 rounded-xl shrink-0">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7h12m0 0l-4-4m4 4l-4 4M16 17H4m0 0l4 4m-4-4l4-4"></path>
            </svg>
        </div>
        <div>
            <h2 class="font-display text-2xl font-semibold text-[#0B1220] tracking-tight">Input Transaksi Baru</h2>
            <p class="text-xs text-stone-400 mt-1">Ajukan pencatatan barang masuk atau keluar untuk diproses lebih lanjut.</p>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 items-start">

        {{-- ============ FORM ============ --}}
        <div class="lg:col-span-2 bg-white border border-stone-200/70 rounded-2xl shadow-[0_1px_2px_rgba(0,0,0,0.04)] overflow-hidden">
            <div class="p-6">
                <form action="{{ route('transactions.store') }}" method="POST" class="space-y-5">
                    @csrf

                    <div class="space-y-1.5">
                        <label class="text-xs font-mono font-bold text-stone-600 uppercase tracking-wider block">Produk <span class="text-rose-500">*</span></label>
                        <select name="product_id" id="product-select" class="w-full px-4 py-2.5 bg-stone-50 border border-stone-200 rounded-xl text-sm text-stone-800 focus:ring-2 focus:ring-teal-500/20 focus:border-teal-500 transition outline-none cursor-pointer" required>
                            <option value="">-- Pilih Produk --</option>
                            @foreach($products as $product)
                                <option value="{{ $product->id }}"
                                        data-name="{{ $product->name }}"
                                        data-stock="{{ $product->stock }}"
                                        data-min="{{ $product->minimum_stock ?? '' }}"
                                        data-sku="{{ $product->sku ?? '' }}">
                                    {{ $product->name }} (Stok: {{ $product->stock }})
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="space-y-1.5">
                        <label class="text-xs font-mono font-bold text-stone-600 uppercase tracking-wider block">Tipe Transaksi <span class="text-rose-500">*</span></label>
                        <div class="grid grid-cols-2 gap-3">
                            <label class="relative flex items-center gap-2.5 px-4 py-3 bg-stone-50 border border-stone-200 rounded-xl cursor-pointer has-[:checked]:bg-emerald-50 has-[:checked]:border-emerald-300 transition">
                                <input type="radio" name="type" value="masuk" class="w-4 h-4 text-emerald-600 focus:ring-emerald-500" checked>
                                <span class="text-xs font-semibold text-stone-700 flex items-center gap-1.5">
                                    <svg class="w-4 h-4 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"></path></svg>
                                    Barang Masuk
                                </span>
                            </label>
                            <label class="relative flex items-center gap-2.5 px-4 py-3 bg-stone-50 border border-stone-200 rounded-xl cursor-pointer has-[:checked]:bg-rose-50 has-[:checked]:border-rose-300 transition">
                                <input type="radio" name="type" value="keluar" class="w-4 h-4 text-rose-600 focus:ring-rose-500" id="type-keluar">
                                <span class="text-xs font-semibold text-stone-700 flex items-center gap-1.5">
                                    <svg class="w-4 h-4 text-rose-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path></svg>
                                    Barang Keluar
                                </span>
                            </label>
                        </div>
                    </div>

                    <div class="space-y-1.5">
                        <label class="text-xs font-mono font-bold text-stone-600 uppercase tracking-wider block">Jumlah <span class="text-rose-500">*</span></label>
                        <input type="number" name="quantity" id="quantity-input" placeholder="Masukkan jumlah" required min="1"
                               class="w-full px-4 py-2.5 bg-stone-50 border border-stone-200 rounded-xl text-sm font-mono text-stone-800 focus:ring-2 focus:ring-teal-500/20 focus:border-teal-500 transition outline-none">
                        <p id="quantity-warning" class="hidden text-[11px] text-rose-600 font-medium mt-1 flex items-center gap-1">
                            <svg class="w-3.5 h-3.5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            Jumlah melebihi stok yang tersedia.
                        </p>
                    </div>

                    <div class="pt-4 border-t border-dashed border-stone-200">
                        <button type="submit" class="w-full inline-flex items-center justify-center gap-2 px-5 py-2.5 bg-[#0B1220] hover:bg-[#151f33] text-white rounded-xl text-xs font-semibold shadow-sm transition">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                            Ajukan Transaksi
                        </button>
                    </div>
                </form>
            </div>
        </div>

        {{-- ============ PANEL INFO STOK PRODUK (LIVE) ============ --}}
        <div class="bg-white border border-stone-200/70 rounded-2xl shadow-[0_1px_2px_rgba(0,0,0,0.04)] overflow-hidden lg:sticky lg:top-6">
            <div class="p-5 border-b border-dashed border-stone-200 bg-stone-50/40 flex items-center gap-3">
                <div class="p-2 bg-[#0B1220] text-teal-400 rounded-lg shrink-0">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
                <h3 class="font-display text-sm font-semibold text-[#0B1220]">Info Stok Produk</h3>
            </div>

            <div id="stock-info-empty" class="p-8 text-center">
                <svg class="w-10 h-10 mx-auto mb-3 text-stone-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                </svg>
                <p class="text-xs text-stone-400 font-mono">Pilih produk untuk<br>melihat detail stok.</p>
            </div>

            <div id="stock-info-content" class="hidden p-5 space-y-4">
                <div>
                    <p class="text-[10px] font-mono font-bold text-stone-400 uppercase tracking-wider">Produk Dipilih</p>
                    <p id="info-name" class="text-sm font-semibold text-stone-800 mt-1">-</p>
                    <p id="info-sku" class="text-[11px] font-mono text-stone-400 mt-0.5"></p>
                </div>

                <div class="p-4 bg-stone-50 rounded-xl border border-stone-100">
                    <p class="text-[10px] font-mono font-bold text-stone-400 uppercase tracking-wider mb-1">Stok Saat Ini</p>
                    <p id="info-stock" class="font-mono text-3xl font-bold text-[#0B1220]">0</p>
                    <span id="info-status" class="hidden inline-flex items-center gap-1.5 mt-2 px-2.5 py-1 rounded-full text-[10px] font-mono font-bold"></span>
                </div>

                <div id="info-after-wrap" class="hidden p-4 bg-teal-50/60 rounded-xl border border-teal-100">
                    <p class="text-[10px] font-mono font-bold text-teal-700 uppercase tracking-wider mb-1">Estimasi Setelah Transaksi</p>
                    <p id="info-after" class="font-mono text-xl font-bold text-teal-800">0</p>
                </div>
            </div>
        </div>

    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const productSelect = document.getElementById('product-select');
        const quantityInput = document.getElementById('quantity-input');
        const typeKeluar = document.getElementById('type-keluar');
        const emptyState = document.getElementById('stock-info-empty');
        const contentState = document.getElementById('stock-info-content');
        const infoName = document.getElementById('info-name');
        const infoSku = document.getElementById('info-sku');
        const infoStock = document.getElementById('info-stock');
        const infoStatus = document.getElementById('info-status');
        const infoAfterWrap = document.getElementById('info-after-wrap');
        const infoAfter = document.getElementById('info-after');
        const quantityWarning = document.getElementById('quantity-warning');

        function currentStock() {
            const opt = productSelect.options[productSelect.selectedIndex];
            return opt && opt.value ? parseInt(opt.dataset.stock || '0', 10) : null;
        }

        function updatePanel() {
            const opt = productSelect.options[productSelect.selectedIndex];

            if (!opt || !opt.value) {
                emptyState.classList.remove('hidden');
                contentState.classList.add('hidden');
                return;
            }

            emptyState.classList.add('hidden');
            contentState.classList.remove('hidden');

            const stock = parseInt(opt.dataset.stock || '0', 10);
            const min = opt.dataset.min ? parseInt(opt.dataset.min, 10) : null;

            infoName.textContent = opt.dataset.name || '-';
            infoSku.textContent = opt.dataset.sku ? 'SKU: ' + opt.dataset.sku : '';
            infoStock.textContent = stock.toLocaleString('id-ID');

            if (min !== null) {
                infoStatus.classList.remove('hidden');
                if (stock <= 0) {
                    infoStatus.textContent = 'HABIS';
                    infoStatus.className = 'inline-flex items-center gap-1.5 mt-2 px-2.5 py-1 rounded-full text-[10px] font-mono font-bold bg-rose-100 text-rose-700';
                } else if (stock <= min) {
                    infoStatus.textContent = 'STOK TIPIS';
                    infoStatus.className = 'inline-flex items-center gap-1.5 mt-2 px-2.5 py-1 rounded-full text-[10px] font-mono font-bold bg-amber-100 text-amber-700';
                } else {
                    infoStatus.textContent = 'STOK AMAN';
                    infoStatus.className = 'inline-flex items-center gap-1.5 mt-2 px-2.5 py-1 rounded-full text-[10px] font-mono font-bold bg-emerald-100 text-emerald-700';
                }
            } else {
                infoStatus.classList.add('hidden');
            }

            updateEstimate();
        }

        function updateEstimate() {
            const stock = currentStock();
            const qty = parseInt(quantityInput.value || '0', 10);

            if (stock === null || !qty || qty <= 0) {
                infoAfterWrap.classList.add('hidden');
                quantityWarning.classList.add('hidden');
                return;
            }

            const isKeluar = typeKeluar.checked;
            const result = isKeluar ? stock - qty : stock + qty;

            infoAfterWrap.classList.remove('hidden');
            infoAfter.textContent = result.toLocaleString('id-ID');
            infoAfter.className = 'font-mono text-xl font-bold ' + (result < 0 ? 'text-rose-600' : 'text-teal-800');

            if (isKeluar && qty > stock) {
                quantityWarning.classList.remove('hidden');
            } else {
                quantityWarning.classList.add('hidden');
            }
        }

        productSelect.addEventListener('change', updatePanel);
        quantityInput.addEventListener('input', updateEstimate);
        document.querySelectorAll('input[name="type"]').forEach(radio => {
            radio.addEventListener('change', updateEstimate);
        });
    });
</script>
@endsection