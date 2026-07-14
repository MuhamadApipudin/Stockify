@extends('example.layouts.default.dashboard')

@section('content')
<link rel="preconnect" href="https://fonts.googleapis.com">
<link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@500;600;700&family=Inter:wght@400;500;600;700&family=JetBrains+Mono:wght@400;500;600;700&display=swap" rel="stylesheet">

<style>
    .font-display { font-family: 'Space Grotesk', sans-serif; }
    .font-mono { font-family: 'JetBrains Mono', monospace; }

    @media print {
        .no-print { display: none !important; }
        .print-card { box-shadow: none !important; border: 1px solid #d6d3d1 !important; }
        body { background: white !important; }
    }
</style>

<div class="p-6 space-y-6 max-w-[1200px] mx-auto font-[Inter]">

    <div class="flex items-center gap-3.5 pb-4 border-b border-dashed border-stone-200 no-print">
        <div class="p-2.5 bg-[#0B1220] text-teal-400 rounded-xl shrink-0">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2H7a2 2 0 01-2-2h2"></path>
            </svg>
        </div>
        <div>
            <h2 class="font-display text-2xl font-semibold text-[#0B1220] tracking-tight">Laporan Transaksi</h2>
            <p class="text-xs text-stone-400 mt-1">Rekap seluruh transaksi barang masuk dan keluar berdasarkan rentang tanggal.</p>
        </div>
    </div>

    {{-- ============ FILTER (disembunyikan saat cetak) ============ --}}
    <div class="bg-white border border-stone-200/70 rounded-2xl shadow-[0_1px_2px_rgba(0,0,0,0.04)] p-5 no-print">
        <form method="GET" action="{{ auth()->user() && strtolower(trim(auth()->user()->role)) === 'manajer gudang' ? route('manager.reports.transactions') : route('reports.transactions') }}" class="flex flex-wrap items-end gap-3">
            <div class="space-y-1.5">
                <label class="text-xs font-mono font-bold text-stone-600 uppercase tracking-wider block">Dari Tanggal</label>
                <input type="date" name="start_date" value="{{ request('start_date') }}"
                       class="px-3.5 py-2.5 bg-stone-50 border border-stone-200 rounded-xl text-xs focus:ring-2 focus:ring-teal-500/20 focus:border-teal-500 transition outline-none">
            </div>
            <div class="space-y-1.5">
                <label class="text-xs font-mono font-bold text-stone-600 uppercase tracking-wider block">Sampai Tanggal</label>
                <input type="date" name="end_date" value="{{ request('end_date') }}"
                       class="px-3.5 py-2.5 bg-stone-50 border border-stone-200 rounded-xl text-xs focus:ring-2 focus:ring-teal-500/20 focus:border-teal-500 transition outline-none">
            </div>

            <button type="submit" class="inline-flex items-center gap-2 px-4 py-2.5 bg-[#0B1220] hover:bg-[#151f33] text-white rounded-xl text-xs font-semibold transition shadow-sm">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"></path></svg>
                Filter
            </button>

            <button type="button" onclick="window.print()" class="inline-flex items-center gap-2 px-4 py-2.5 bg-stone-100 hover:bg-stone-200 text-stone-700 rounded-xl text-xs font-semibold transition border border-stone-200/60">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a1 1 0 001-1v-4H8v4a1 1 0 001 1zm0-14h6v3H9V3z"></path></svg>
                Cetak / PDF
            </button>
        </form>
    </div>

    {{-- ============ HEADER CETAK (hanya tampil saat print) ============ --}}
    <div class="hidden print:block pb-4 border-b border-stone-300">
        <h1 class="font-display text-xl font-bold text-[#0B1220]">Laporan Transaksi — Stockify</h1>
        <p class="text-xs text-stone-500 mt-1 font-mono">
            Periode: {{ request('start_date') ?: '—' }} s/d {{ request('end_date') ?: '—' }} · Dicetak {{ now()->format('d-m-Y H:i') }}
        </p>
    </div>

    {{-- ============ TABEL ============ --}}
    <div class="print-card bg-white border border-stone-200/70 rounded-2xl shadow-[0_1px_2px_rgba(0,0,0,0.04)] overflow-hidden">

        <div class="flex items-center justify-between px-6 py-4 border-b border-dashed border-stone-200 bg-stone-50/40 no-print">
            <h3 class="font-display text-sm font-semibold text-[#0B1220]">Manifest Transaksi</h3>
            <span class="font-mono text-[11px] text-stone-400">{{ $transactions->total() ?? $transactions->count() }} BARIS</span>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-stone-50/80 border-b border-stone-100 text-[10px] font-mono font-bold text-stone-400 uppercase tracking-wider">
                        <th class="py-3.5 px-6">Tanggal</th>
                        <th class="py-3.5 px-4">Produk</th>
                        <th class="py-3.5 px-4 text-center">Tipe</th>
                        <th class="py-3.5 px-6 text-right">Jumlah</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-stone-100 text-xs">
                    @forelse($transactions as $t)
                    <tr class="hover:bg-teal-50/20 transition duration-150">
                        <td class="py-4 px-6 font-mono text-stone-500 whitespace-nowrap">
                            {{ $t->created_at->format('d-m-Y') }}
                        </td>

                        <td class="py-4 px-4 font-semibold text-stone-800">
                            {{ $t->product->name ?? 'Produk Tidak Ditemukan' }}
                        </td>

                        <td class="py-4 px-4 text-center">
                            @if(strtolower($t->type) === 'masuk')
                                <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-[11px] font-mono font-bold bg-emerald-50 text-emerald-700 border border-emerald-200">
                                    <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span>
                                    MASUK
                                </span>
                            @else
                                <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-[11px] font-mono font-bold bg-rose-50 text-rose-700 border border-rose-200">
                                    <span class="w-1.5 h-1.5 rounded-full bg-rose-500"></span>
                                    {{ strtoupper($t->type) }}
                                </span>
                            @endif
                        </td>

                        <td class="py-4 px-6 text-right font-mono font-bold text-stone-800">
                            {{ number_format($t->quantity, 0, ',', '.') }}
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="py-14 text-center text-xs text-stone-400 font-mono">
                            Tidak ada transaksi ditemukan.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($transactions instanceof \Illuminate\Pagination\LengthAwarePaginator && $transactions->hasPages())
        <div class="flex items-center justify-between px-6 py-4 border-t border-dashed border-stone-200 bg-stone-50/40 no-print">
            <p class="text-[11px] text-stone-400 font-mono">
                Menampilkan {{ $transactions->firstItem() }}–{{ $transactions->lastItem() }} dari {{ $transactions->total() }} data
            </p>
            <div class="text-xs [&_nav]:flex [&_nav]:items-center [&_nav]:gap-1 [&_a]:px-3 [&_a]:py-1.5 [&_a]:rounded-lg [&_a]:border [&_a]:border-stone-200 [&_a]:text-stone-600 [&_a]:hover:bg-stone-50 [&_a]:transition [&_span[aria-current=page]_span]:bg-[#0B1220] [&_span[aria-current=page]_span]:text-white [&_span[aria-current=page]_span]:rounded-lg [&_span[aria-current=page]_span]:px-3 [&_span[aria-current=page]_span]:py-1.5">
                {{ $transactions->appends(request()->query())->onEachSide(1)->links() }}
            </div>
        </div>
        @endif
    </div>
</div>
@endsection