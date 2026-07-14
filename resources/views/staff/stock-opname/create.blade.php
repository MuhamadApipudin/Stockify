@extends('example.layouts.default.dashboard')

@section('content')
<link rel="preconnect" href="https://fonts.googleapis.com">
<link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@500;600;700&family=Inter:wght@400;500;600;700&family=JetBrains+Mono:wght@400;500;600;700&display=swap" rel="stylesheet">

<style>
    .font-display { font-family: 'Space Grotesk', sans-serif; }
    .font-mono { font-family: 'JetBrains Mono', monospace; }
</style>

<div class="container mx-auto py-6 px-6 space-y-6 font-[Inter] max-w-2xl">

    <div class="flex items-center gap-3.5 pb-4 border-b border-dashed border-stone-200">
        <div class="p-2.5 bg-[#0B1220] text-teal-400 rounded-xl shrink-0">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17V7m0 10a2 2 0 01-2 2H5a2 2 0 01-2-2V7a2 2 0 012-2h2a2 2 0 012 2m0 10a2 2 0 002 2h2a2 2 0 002-2M9 7a2 2 0 012-2h2a2 2 0 012 2m0 10V7m0 10a2 2 0 002 2h2a2 2 0 002-2V7a2 2 0 00-2-2h-2a2 2 0 00-2 2"></path>
            </svg>
        </div>
        <div>
            <h2 class="font-display text-2xl font-semibold text-[#0B1220] tracking-tight">Laporkan Selisih Stok</h2>
            <p class="text-xs text-stone-400 mt-1">Catat hasil hitung fisik untuk dibandingkan dengan stok sistem.</p>
        </div>
    </div>

    @if(session('success'))
        <div class="flex items-center gap-3 p-4 text-xs font-semibold text-emerald-800 bg-emerald-50/90 border border-emerald-200 rounded-2xl shadow-[0_1px_2px_rgba(0,0,0,0.04)]">
            <svg class="w-4 h-4 text-emerald-600 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
            </svg>
            <span>{{ session('success') }}</span>
        </div>
    @endif

    @if($errors->any())
        <div class="p-4 text-xs font-semibold text-rose-800 bg-rose-50/90 border border-rose-200 rounded-2xl">
            <ul class="list-disc list-inside space-y-1">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="bg-white border border-stone-200/70 rounded-2xl shadow-[0_1px_2px_rgba(0,0,0,0.04)] overflow-hidden">
        <form action="{{ route('staff.stock-opname.store') }}" method="POST" class="p-6 space-y-5">
            @csrf

            <div>
                <label class="block text-xs font-semibold text-stone-600 mb-1.5">Produk</label>
                <select name="product_id" id="product_id" required
                    class="w-full text-sm border border-stone-200 rounded-xl px-3.5 py-2.5 focus:outline-none focus:ring-2 focus:ring-teal-500/40 focus:border-teal-500">
                    <option value="">-- Pilih produk --</option>
                    @foreach($products as $product)
                        <option value="{{ $product->id }}" data-stock="{{ $product->stock }}"
                            {{ old('product_id') == $product->id ? 'selected' : '' }}>
                            {{ $product->name }} (Stok sistem: {{ $product->stock }})
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-xs font-semibold text-stone-600 mb-1.5">Stok Sistem</label>
                    <input type="text" id="system_stock_display" readonly value="-"
                        class="w-full text-sm font-mono bg-stone-50 border border-stone-200 rounded-xl px-3.5 py-2.5 text-stone-500">
                </div>
                <div>
                    <label class="block text-xs font-semibold text-stone-600 mb-1.5">Stok Fisik (Hasil Hitung)</label>
                    <input type="number" name="actual_stock" id="actual_stock" min="0" required
                        value="{{ old('actual_stock') }}"
                        class="w-full text-sm font-mono border border-stone-200 rounded-xl px-3.5 py-2.5 focus:outline-none focus:ring-2 focus:ring-teal-500/40 focus:border-teal-500">
                </div>
            </div>

            <div id="diff_wrapper" class="hidden">
                <label class="block text-xs font-semibold text-stone-600 mb-1.5">Selisih</label>
                <span id="diff_display" class="inline-flex items-center justify-center min-w-[4rem] px-3 py-1.5 rounded-full text-xs font-mono font-bold"></span>
            </div>

            <div>
                <label class="block text-xs font-semibold text-stone-600 mb-1.5">Catatan (opsional)</label>
                <textarea name="notes" rows="3"
                    class="w-full text-sm border border-stone-200 rounded-xl px-3.5 py-2.5 focus:outline-none focus:ring-2 focus:ring-teal-500/40 focus:border-teal-500"
                    placeholder="Contoh: kemasan rusak 2 unit, kemungkinan salah input sebelumnya, dll.">{{ old('notes') }}</textarea>
            </div>

            <div class="flex justify-end pt-2">
                <button type="submit"
                    class="inline-flex items-center gap-2 px-5 py-2.5 font-semibold text-white bg-[#0B1220] hover:bg-stone-800 rounded-xl text-sm transition shadow-sm">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                    </svg>
                    Laporkan Selisih
                </button>
            </div>
        </form>
    </div>
</div>

<script>
    const productSelect = document.getElementById('product_id');
    const systemStockDisplay = document.getElementById('system_stock_display');
    const actualStockInput = document.getElementById('actual_stock');
    const diffWrapper = document.getElementById('diff_wrapper');
    const diffDisplay = document.getElementById('diff_display');

    function getSystemStock() {
        const opt = productSelect.options[productSelect.selectedIndex];
        return opt && opt.dataset.stock ? parseInt(opt.dataset.stock) : null;
    }

    function updateDiff() {
        const systemStock = getSystemStock();
        const actual = parseInt(actualStockInput.value);

        if (systemStock === null || isNaN(actual)) {
            diffWrapper.classList.add('hidden');
            return;
        }

        const diff = actual - systemStock;
        diffWrapper.classList.remove('hidden');

        diffDisplay.textContent = diff === 0 ? '0' : (diff > 0 ? '+' + diff : diff);
        diffDisplay.className = 'inline-flex items-center justify-center min-w-[4rem] px-3 py-1.5 rounded-full text-xs font-mono font-bold border ' +
            (diff === 0
                ? 'bg-emerald-50 text-emerald-700 border-emerald-200'
                : diff > 0
                    ? 'bg-teal-50 text-teal-700 border-teal-200'
                    : 'bg-rose-50 text-rose-700 border-rose-200');
    }

    productSelect.addEventListener('change', function () {
        const systemStock = getSystemStock();
        systemStockDisplay.value = systemStock !== null ? systemStock : '-';
        updateDiff();
    });

    actualStockInput.addEventListener('input', updateDiff);
</script>
@endsection
