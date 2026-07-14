@extends('example.layouts.default.dashboard')

@section('content')
<link rel="preconnect" href="https://fonts.googleapis.com">
<link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@500;600;700&family=Inter:wght@400;500;600;700&family=JetBrains+Mono:wght@400;500;600;700&display=swap" rel="stylesheet">

<style>
    .font-display { font-family: 'Space Grotesk', sans-serif; }
    .font-mono { font-family: 'JetBrains Mono', monospace; }
    .manifest-perforation {
        background-image: radial-gradient(circle, rgba(45,212,191,0.35) 1.5px, transparent 1.5px);
        background-size: 10px 2px;
        background-repeat: repeat-x;
        background-position: center;
    }
    .blueprint-grid {
        background-image:
            linear-gradient(rgba(255,255,255,0.04) 1px, transparent 1px),
            linear-gradient(90deg, rgba(255,255,255,0.04) 1px, transparent 1px);
        background-size: 28px 28px;
    }

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

<div class="p-6 min-h-screen space-y-6 font-[Inter]">

    {{-- ============ HERO MANIFEST HEADER ============ --}}
    <div class="relative overflow-hidden bg-[#0B1220] rounded-2xl shadow-sm text-white border border-black/20 no-print">
        <div class="absolute inset-0 blueprint-grid pointer-events-none"></div>
        <div class="absolute -right-16 -top-16 w-72 h-72 bg-teal-600/10 rounded-full blur-3xl pointer-events-none"></div>

        <div class="relative z-10 flex flex-col sm:flex-row sm:items-center justify-between gap-5 p-6">
            <div>
                <span class="inline-flex items-center gap-2 px-3 py-1 rounded-full text-[11px] font-mono font-semibold bg-white/5 text-teal-300 border border-teal-500/20 mb-3">
                    <span class="w-1.5 h-1.5 rounded-full bg-emerald-400 animate-pulse"></span>
                    SYSTEM&nbsp;·&nbsp;ONLINE
                </span>
                <h1 class="font-display text-2xl sm:text-3xl font-semibold tracking-tight text-white">Ringkasan Stok</h1>
                <p class="text-sm text-slate-400 mt-1.5 max-w-md">Pantau status persediaan barang dan pergerakan stok Anda hari ini.</p>
            </div>

            <div class="shrink-0">
                <div class="bg-white/[0.04] border border-white/10 px-4 py-3 rounded-xl flex items-center gap-3">
                    <div class="p-2 bg-teal-500/10 text-teal-400 rounded-lg border border-teal-500/10">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                    </div>
                    <div>
                        <p class="text-[10px] uppercase font-mono font-semibold tracking-wider text-slate-500">Hak Akses</p>
                        <p class="text-xs font-mono font-bold text-white uppercase tracking-wide">{{ strtoupper(Auth::user()->role) }}</p>
                    </div>
                </div>
            </div>
        </div>

        {{-- perforated tear-off edge — the manifest signature --}}
        <div class="relative h-4 border-t border-dashed border-white/10 manifest-perforation"></div>
    </div>

    {{-- ============ STAT CARDS ============ --}}
    <div class="grid grid-cols-1 md:grid-cols-3 gap-5 no-print">

        <div class="bg-white p-5 rounded-2xl border border-stone-200/70 shadow-[0_1px_2px_rgba(0,0,0,0.04)] hover:shadow-md hover:-translate-y-0.5 transition-all duration-200 group">
            <div class="flex justify-between items-start">
                <div>
                    <span class="bin-tag text-[10px] font-mono font-semibold text-stone-400 uppercase tracking-wider block mb-1.5">01 · STOK MENIPIS</span>
                    <div class="flex items-baseline gap-1.5 my-1">
                        <span class="font-mono text-3xl font-bold text-[#0B1220]">{{ $stokMenipisCount }}</span>
                        <span class="text-xs font-mono font-semibold text-amber-600">ITEMS</span>
                    </div>
                    <p class="text-xs text-stone-400">Perlu segera dipesan ulang hari ini.</p>
                </div>
                <div class="p-2.5 bg-amber-50 rounded-xl text-amber-500 border border-amber-100 group-hover:scale-105 transition">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
                    </svg>
                </div>
            </div>
        </div>

        <div class="bg-white p-5 rounded-2xl border border-stone-200/70 shadow-[0_1px_2px_rgba(0,0,0,0.04)] hover:shadow-md hover:-translate-y-0.5 transition-all duration-200 group">
            <div class="flex justify-between items-start">
                <div>
                    <span class="bin-tag text-[10px] font-mono font-semibold text-stone-400 uppercase tracking-wider block mb-1.5">02 · MASUK HARI INI</span>
                    <div class="flex items-baseline gap-1.5 my-1">
                        <span class="font-mono text-3xl font-bold text-emerald-700">{{ $barangMasukHariIni }}</span>
                        <span class="text-xs font-mono font-semibold text-emerald-600">UNITS</span>
                    </div>
                    <p class="text-xs text-stone-400">Total item yang diterima hari ini.</p>
                </div>
                <div class="p-2.5 bg-emerald-50 rounded-xl text-emerald-600 border border-emerald-100 group-hover:scale-105 transition">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3"></path>
                    </svg>
                </div>
            </div>
        </div>

        <div class="bg-white p-5 rounded-2xl border border-stone-200/70 shadow-[0_1px_2px_rgba(0,0,0,0.04)] hover:shadow-md hover:-translate-y-0.5 transition-all duration-200 group">
            <div class="flex justify-between items-start">
                <div>
                    <span class="bin-tag text-[10px] font-mono font-semibold text-stone-400 uppercase tracking-wider block mb-1.5">03 · KELUAR HARI INI</span>
                    <div class="flex items-baseline gap-1.5 my-1">
                        <span class="font-mono text-3xl font-bold text-rose-700">{{ $barangKeluarHariIni }}</span>
                        <span class="text-xs font-mono font-semibold text-rose-600">UNITS</span>
                    </div>
                    <p class="text-xs text-stone-400">Total item yang didistribusikan.</p>
                </div>
                <div class="p-2.5 bg-rose-50 rounded-xl text-rose-500 border border-rose-100 group-hover:scale-105 transition">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 10l7-7m0 0l7 7m-7-7v18"></path>
                    </svg>
                </div>
            </div>
        </div>

    </div>

    {{-- ============ DAFTAR STOK MENIPIS ============ --}}
    <div class="print-card bg-white rounded-2xl border border-stone-200/70 shadow-[0_1px_2px_rgba(0,0,0,0.04)] overflow-hidden">

        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 p-6 border-b border-dashed border-stone-200 bg-stone-50/40 no-print">
            <div>
                <h2 class="font-display text-base font-semibold text-[#0B1220]">Daftar Stok Menipis</h2>
                <p class="text-xs text-stone-400 mt-0.5">Produk di bawah ini telah mencapai atau melewati batas stok minimum.</p>
            </div>
            <button type="button" onclick="window.print()" class="inline-flex items-center text-xs font-semibold text-stone-600 hover:text-[#0B1220] border border-stone-200 px-3 py-2 rounded-lg hover:bg-white transition gap-1.5 shrink-0">
                <svg class="w-4 h-4 text-stone-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a1 1 0 001-1v-4H8v4a1 1 0 001 1zm0-14h6v3H9V3z"></path>
                </svg>
                <span>Cetak PDF</span>
            </button>
        </div>

        {{-- ============ HEADER CETAK (hanya tampil saat print) ============ --}}
        <div class="hidden print:block p-6 pb-4 border-b border-stone-300">
            <h1 class="font-display text-xl font-bold text-[#0B1220]">Daftar Stok Menipis — Stockify</h1>
            <p class="text-xs text-stone-500 mt-1 font-mono">Dicetak {{ now()->format('d-m-Y H:i') }}</p>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse print-table">
                <thead>
                    <tr class="bg-stone-50/80 border-b border-stone-100 text-[10px] font-mono font-bold text-stone-400 uppercase tracking-wider">
                        <th class="py-3.5 px-6">Nama Item</th>
                        <th class="py-3.5 px-4">SKU</th>
                        <th class="py-3.5 px-4 text-center">Stok Saat Ini</th>
                        <th class="py-3.5 px-4 text-center">Batas Min</th>
                        <th class="py-3.5 px-6 text-right">Status</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-stone-100 text-xs">
                    @forelse(($low_stock_products ?? []) as $item)
                    <tr class="hover:bg-teal-50/20 transition duration-150">
                        <td class="py-4 px-6 whitespace-nowrap">
                            <div class="flex items-center gap-3">
                                <div class="print-avatar w-8 h-8 rounded-lg bg-[#0B1220] flex items-center justify-center text-teal-400 font-mono font-bold shrink-0 text-xs">
                                    {{ strtoupper(substr($item->name, 0, 1)) }}
                                </div>
                                <span class="font-semibold text-stone-800">{{ $item->name }}</span>
                            </div>
                        </td>
                        <td class="py-4 px-4">
                            <span class="bg-stone-100 px-2 py-0.5 rounded-md text-[11px] font-mono text-stone-500 border border-stone-200/60">
                                {{ $item->sku }}
                            </span>
                        </td>
                        <td class="py-4 px-4 text-center font-mono font-bold text-rose-600">{{ $item->stock }}</td>
                        <td class="py-4 px-4 text-center font-mono text-stone-400">{{ $item->min_stock ?? 10 }}</td>
                        <td class="py-4 px-6 text-right">
                            @if($item->stock <= 0)
                                <span class="px-2.5 py-1 text-[10px] font-mono font-bold tracking-wide text-rose-700 bg-rose-50 border border-rose-200 rounded-full inline-block">
                                    KRITIS
                                </span>
                            @else
                                <span class="px-2.5 py-1 text-[10px] font-mono font-bold tracking-wide text-amber-700 bg-amber-50 border border-amber-200 rounded-full inline-block">
                                    PERINGATAN
                                </span>
                            @endif
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="py-14 text-center">
                            <div class="flex flex-col items-center justify-center text-stone-400">
                                <svg class="w-10 h-10 mb-2 text-stone-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                <span class="text-sm font-semibold text-stone-600">Stok dalam kondisi aman</span>
                                <span class="text-xs text-stone-400 font-mono">Tidak ada barang yang menyentuh batas minimum.</span>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

</div>
@endsection