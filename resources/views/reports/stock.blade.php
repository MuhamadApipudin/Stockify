@extends('example.layouts.default.dashboard')

@section('content')
<link rel="preconnect" href="https://fonts.googleapis.com">
<link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@500;600;700&family=Inter:wght@400;500;600;700&family=JetBrains+Mono:wght@400;500;600;700&display=swap" rel="stylesheet">

<style>
    .font-display { font-family: 'Space Grotesk', sans-serif; }
    .font-mono { font-family: 'JetBrains Mono', monospace; }

    @media print {
        .no-print { display: none !important; }
        body { background: white !important; margin: 0; }

        .print-card {
            box-shadow: none !important;
            border: none !important;
            border-radius: 0 !important;
            overflow: visible !important;
        }

        .print-avatar { display: none !important; }

        table.print-table {
            border-collapse: collapse !important;
            width: 100% !important;
            table-layout: fixed !important;
        }
        table.print-table thead tr {
            background: #e5e5e5 !important;
        }
        table.print-table th,
        table.print-table td {
            border: 1px solid #000 !important;
            padding: 6px 10px !important;
            font-family: Arial, sans-serif !important;
            font-size: 11px !important;
            color: #000 !important;
            background: white !important;
            border-radius: 0 !important;
        }
        table.print-table th {
            font-weight: bold !important;
            text-transform: none !important;
            letter-spacing: normal !important;
        }
        table.print-table tr:hover { background: white !important; }
    }
</style>

<div class="container mx-auto py-6 px-6 space-y-6 font-[Inter]">

    <div class="flex items-center gap-3.5 pb-4 border-b border-dashed border-stone-200 no-print">
        <div class="p-2.5 bg-[#0B1220] text-teal-400 rounded-xl shrink-0">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
            </svg>
        </div>
        <div>
            <h2 class="font-display text-2xl font-semibold text-[#0B1220] tracking-tight">Laporan Stok Barang</h2>
            <p class="text-xs text-stone-400 mt-1">Rekap stok seluruh produk, bisa disaring berdasarkan kategori.</p>
        </div>
    </div>

    {{-- ============ FILTER (disembunyikan saat cetak) ============ --}}
    <div class="bg-white p-5 rounded-2xl border border-stone-200/70 shadow-[0_1px_2px_rgba(0,0,0,0.04)] no-print">
        <form method="GET" class="flex flex-wrap items-end gap-3">
            <div class="space-y-1.5">
                <label class="text-xs font-mono font-bold text-stone-600 uppercase tracking-wider block">Kategori</label>
                <select name="category_id" class="px-3.5 py-2.5 bg-stone-50 border border-stone-200 rounded-xl text-xs focus:ring-2 focus:ring-teal-500/20 focus:border-teal-500 transition outline-none min-w-[180px]">
                    <option value="">Semua Kategori</option>
                    @foreach($products->pluck('category')->filter()->unique('id') as $category)
                        <option value="{{ $category->id }}" {{ request('category_id') == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <button type="submit" class="inline-flex items-center gap-2 px-4 py-2.5 bg-[#0B1220] hover:bg-[#151f33] text-white rounded-xl text-xs font-semibold transition shadow-sm">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"></path></svg>
                Filter
            </button>

            <button type="button" onclick="window.print()" class="inline-flex items-center gap-2 px-4 py-2.5 bg-stone-100 hover:bg-stone-200 text-stone-700 rounded-xl text-xs font-semibold transition border border-stone-200/60">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a1 1 0 001-1v-4H8v4a1 1 0 001 1zm0-14h6v3H9V3z"></path></svg>
                Cetak PDF
            </button>
        </form>
    </div>

    {{-- ============ HEADER CETAK (hanya tampil saat print) ============ --}}
    <div class="hidden print:block pb-4 border-b border-stone-300">
        <h1 class="font-display text-xl font-bold text-[#0B1220]">Laporan Stok Barang — Stockify</h1>
        <p class="text-xs text-stone-500 mt-1 font-mono">Dicetak {{ now()->format('d-m-Y H:i') }}</p>
    </div>

    {{-- ============ TABEL ============ --}}
    <div class="print-card bg-white rounded-2xl border border-stone-200/70 shadow-[0_1px_2px_rgba(0,0,0,0.04)] overflow-hidden">

        <div class="flex items-center justify-between px-6 py-4 border-b border-dashed border-stone-200 bg-stone-50/40 no-print">
            <h3 class="font-display text-sm font-semibold text-[#0B1220]">Daftar Stok Produk</h3>
            <span class="font-mono text-[11px] text-stone-400">{{ $products->count() }} PRODUK</span>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse table-fixed print-table">
                <thead>
                    <tr class="bg-stone-50/80 border-b border-stone-100 text-[10px] font-mono font-bold text-stone-400 uppercase tracking-wider">
                        <th class="py-3.5 px-6 text-left w-2/5">Produk</th>
                        <th class="py-3.5 px-4 text-left w-1/3">Kategori</th>
                        <th class="py-3.5 px-6 text-center">Stok</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-stone-100 text-xs">
                    @forelse($products as $item)
                    <tr class="hover:bg-teal-50/20 transition duration-150">
                        <td class="py-4 px-6">
                            <div class="flex items-center gap-3">
                                <div class="print-avatar w-8 h-8 rounded-lg bg-[#0B1220] flex items-center justify-center text-teal-400 font-mono font-bold shrink-0 text-xs">
                                    {{ strtoupper(substr($item->name, 0, 1)) }}
                                </div>
                                <span class="font-semibold text-stone-800">{{ $item->name }}</span>
                            </div>
                        </td>
                        <td class="py-4 px-4 text-left text-stone-500">
                            {{ $item->category->name ?? '-' }}
                        </td>
                        <td class="py-4 px-6 text-center font-mono font-bold text-stone-800">
                            {{ number_format($item->stock, 0, ',', '.') }}
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="3" class="py-14 text-center text-xs text-stone-400 font-mono">
                            Tidak ada data stok untuk ditampilkan.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection