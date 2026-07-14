@extends('example.layouts.default.dashboard')

@section('content')
<link rel="preconnect" href="https://fonts.googleapis.com">
<link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@500;600;700&family=Inter:wght@400;500;600;700&family=JetBrains+Mono:wght@400;500;600;700&display=swap" rel="stylesheet">

<style>
    .font-display { font-family: 'Space Grotesk', sans-serif; }
    .font-mono { font-family: 'JetBrains Mono', monospace; }
</style>

<div class="p-6 space-y-6 font-[Inter]">

    <div class="flex items-center gap-3.5 pb-4 border-b border-dashed border-stone-200">
        <div class="p-2.5 bg-[#0B1220] text-teal-400 rounded-xl shrink-0">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7h12m0 0l-4-4m4 4l-4 4M16 17H4m0 0l4 4m-4-4l4-4"></path>
            </svg>
        </div>
        <div>
            <h2 class="font-display text-2xl font-semibold text-[#0B1220] tracking-tight">Laporan Barang Masuk &amp; Keluar</h2>
            <p class="text-xs text-stone-400 mt-1">Ringkasan sirkulasi stok barang per periode.</p>
        </div>
    </div>

    {{-- ============ FILTER ============ --}}
    <div class="bg-white p-5 rounded-2xl border border-stone-200/70 shadow-[0_1px_2px_rgba(0,0,0,0.04)]">
        <form action="{{ route('manager.reports.flow') }}" method="GET" class="flex flex-wrap items-end gap-3">
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
        </form>
    </div>

    {{-- ============ TABEL ============ --}}
    <div class="bg-white rounded-2xl border border-stone-200/70 shadow-[0_1px_2px_rgba(0,0,0,0.04)] overflow-hidden">

        <div class="flex items-center justify-between px-6 py-4 border-b border-dashed border-stone-200 bg-stone-50/40">
            <h3 class="font-display text-sm font-semibold text-[#0B1220]">Sirkulasi Stok per Produk</h3>
            <span class="font-mono text-[11px] text-stone-400">{{ count($data ?? []) }} PRODUK</span>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-stone-50/80 border-b border-stone-100 text-[10px] font-mono font-bold text-stone-400 uppercase tracking-wider">
                        <th class="py-3.5 px-6">Nama Produk</th>
                        <th class="py-3.5 px-4 text-center">Total Masuk</th>
                        <th class="py-3.5 px-4 text-center">Total Keluar</th>
                        <th class="py-3.5 px-6 text-center">Stok Selisih</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-stone-100 text-xs">
                    @forelse($data ?? [] as $item)
                        @php
                            $masuk = $item->total_masuk ?? 0;
                            $keluar = $item->total_keluar ?? 0;
                            $selisih = $masuk - $keluar;
                        @endphp
                        <tr class="hover:bg-teal-50/20 transition duration-150">
                            <td class="py-4 px-6">
                                <div class="flex items-center gap-3">
                                    <div class="w-8 h-8 rounded-lg bg-[#0B1220] flex items-center justify-center text-teal-400 font-mono font-bold shrink-0 text-xs">
                                        {{ strtoupper(substr($item->name, 0, 1)) }}
                                    </div>
                                    <span class="font-semibold text-stone-800">{{ $item->name }}</span>
                                </div>
                            </td>
                            <td class="py-4 px-4 text-center font-mono font-bold text-emerald-700">+{{ $masuk }}</td>
                            <td class="py-4 px-4 text-center font-mono font-bold text-rose-700">-{{ $keluar }}</td>
                            <td class="py-4 px-6 text-center">
                                <span class="inline-flex items-center justify-center min-w-[3.5rem] px-2.5 py-1 rounded-full text-[11px] font-mono font-bold {{ $selisih < 0 ? 'bg-rose-50 text-rose-700 border border-rose-200' : 'bg-teal-50 text-teal-700 border border-teal-200' }}">
                                    {{ $selisih > 0 ? '+' : '' }}{{ $selisih }}
                                </span>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="py-14 text-center text-xs text-stone-400 font-mono">
                                Data tidak ditemukan dalam periode ini.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection