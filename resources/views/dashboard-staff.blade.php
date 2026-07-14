@extends('example.layouts.default.dashboard')

@section('content')
<link rel="preconnect" href="https://fonts.googleapis.com">
<link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@500;600;700&family=Inter:wght@400;500;600;700&family=JetBrains+Mono:wght@400;500;600;700&display=swap" rel="stylesheet">

<style>
    .font-display { font-family: 'Space Grotesk', sans-serif; }
    .font-mono { font-family: 'JetBrains Mono', monospace; }
</style>

<div class="container mx-auto py-6 px-6 space-y-6 font-[Inter]">

    {{-- ============ HERO ============ --}}
    <div class="relative overflow-hidden p-6 bg-[#0B1220] rounded-2xl shadow-sm text-white border border-black/20">
        <div class="absolute -right-10 -bottom-10 w-60 h-60 bg-teal-500/10 rounded-full blur-3xl pointer-events-none"></div>
        <div class="relative z-10 flex flex-col sm:flex-row sm:items-center justify-between gap-3">
            <div>
                <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-semibold bg-white/10 text-teal-200 border border-white/10 mb-3 font-mono">
                    <span class="w-2 h-2 rounded-full bg-emerald-400 animate-pulse"></span>
                    TASK LIST
                </span>
                <h1 class="font-display text-2xl sm:text-3xl font-semibold tracking-tight text-white">Tugas Harian Staff</h1>
                <p class="text-sm text-slate-300 mt-1">Daftar barang masuk dan keluar yang perlu segera kamu tindak lanjuti.</p>
            </div>
            <span class="font-mono text-xs text-slate-400 shrink-0">{{ date('d M Y') }}</span>
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

        {{-- ============ BARANG MASUK ============ --}}
        <div class="bg-white border border-stone-200/70 rounded-2xl shadow-[0_1px_2px_rgba(0,0,0,0.04)] overflow-hidden">
            <div class="flex items-center gap-3.5 p-6 border-b border-dashed border-stone-200 bg-stone-50/40">
                <div class="p-2.5 bg-[#0B1220] text-teal-400 rounded-xl shrink-0">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"></path>
                    </svg>
                </div>
                <div>
                    <h3 class="font-display text-base font-semibold text-[#0B1220]">Barang Masuk</h3>
                    <p class="text-xs text-stone-400 mt-0.5">Perlu diperiksa sebelum dikonfirmasi.</p>
                </div>
            </div>

            <div class="divide-y divide-stone-100">
                @forelse($pendingEntries as $entry)
                    <div class="flex justify-between items-center px-6 py-3.5 text-xs hover:bg-teal-50/20 transition duration-150">
                        <div class="flex items-center gap-3">
                            <div class="w-8 h-8 rounded-lg bg-[#0B1220] flex items-center justify-center text-teal-400 font-mono font-bold shrink-0 text-xs">
                                {{ strtoupper(substr($entry->product->name ?? '?', 0, 1)) }}
                            </div>
                            <span class="font-semibold text-stone-800">{{ $entry->product->name ?? 'Produk' }}</span>
                        </div>
                        <a href="{{ route('staff.stock.incoming') }}" class="px-3 py-1.5 bg-emerald-50 text-emerald-700 border border-emerald-200/80 rounded-lg font-mono font-bold text-[11px] hover:bg-emerald-100 transition">
                            Periksa
                        </a>
                    </div>
                @empty
                    <div class="px-6 py-10 text-center">
                        <p class="text-stone-400 text-xs font-mono italic">Tidak ada barang masuk baru.</p>
                    </div>
                @endforelse
            </div>
        </div>

        {{-- ============ BARANG KELUAR ============ --}}
        <div class="bg-white border border-stone-200/70 rounded-2xl shadow-[0_1px_2px_rgba(0,0,0,0.04)] overflow-hidden">
            <div class="flex items-center gap-3.5 p-6 border-b border-dashed border-stone-200 bg-stone-50/40">
                <div class="p-2.5 bg-[#0B1220] text-teal-400 rounded-xl shrink-0">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                    </svg>
                </div>
                <div>
                    <h3 class="font-display text-base font-semibold text-[#0B1220]">Barang Keluar</h3>
                    <p class="text-xs text-stone-400 mt-0.5">Perlu disiapkan sebelum dikirim/diambil.</p>
                </div>
            </div>

            <div class="divide-y divide-stone-100">
                @forelse($pendingExits as $exit)
                    <div class="flex justify-between items-center px-6 py-3.5 text-xs hover:bg-teal-50/20 transition duration-150">
                        <div class="flex items-center gap-3">
                            <div class="w-8 h-8 rounded-lg bg-[#0B1220] flex items-center justify-center text-teal-400 font-mono font-bold shrink-0 text-xs">
                                {{ strtoupper(substr($exit->product->name ?? '?', 0, 1)) }}
                            </div>
                            <span class="font-semibold text-stone-800">{{ $exit->product->name ?? 'Produk' }}</span>
                        </div>
                        <a href="{{ route('staff.stock.outgoing') }}" class="px-3 py-1.5 bg-rose-50 text-rose-700 border border-rose-200/80 rounded-lg font-mono font-bold text-[11px] hover:bg-rose-100 transition">
                            Siapkan
                        </a>
                    </div>
                @empty
                    <div class="px-6 py-10 text-center">
                        <p class="text-stone-400 text-xs font-mono italic">Tidak ada barang keluar baru.</p>
                    </div>
                @endforelse
            </div>
        </div>

    </div>
</div>
@endsection