@extends('example.layouts.default.dashboard')

@section('content')
<link rel="preconnect" href="https://fonts.googleapis.com">
<link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@500;600;700&family=Inter:wght@400;500;600;700&family=JetBrains+Mono:wght@400;500;600;700&display=swap" rel="stylesheet">

<style>
    .font-display { font-family: 'Space Grotesk', sans-serif; }
    .font-mono { font-family: 'JetBrains Mono', monospace; }
</style>

<div class="container mx-auto py-6 px-6 space-y-6 font-[Inter]">

    <div class="flex items-center gap-3.5 pb-4 border-b border-dashed border-stone-200">
        <div class="p-2.5 bg-[#0B1220] text-teal-400 rounded-xl shrink-0">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
            </svg>
        </div>
        <div>
            <h2 class="font-display text-2xl font-semibold text-[#0B1220] tracking-tight">Persetujuan Stock Opname</h2>
            <p class="text-xs text-stone-400 mt-1">Daftar penyesuaian stok fisik yang diajukan oleh Staff Gudang.</p>
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

    <div class="bg-white border border-stone-200/70 rounded-2xl shadow-[0_1px_2px_rgba(0,0,0,0.04)] overflow-hidden">
        <div class="flex items-center justify-between p-6 border-b border-dashed border-stone-200 bg-stone-50/40">
            <div>
                <h3 class="font-display text-base font-semibold text-[#0B1220]">Menunggu Persetujuan</h3>
                <p class="text-xs text-stone-400 mt-0.5">Bandingkan stok sistem dengan hasil opname fisik sebelum menyetujui.</p>
            </div>
            @if($opnames->count() > 0)
                <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-[11px] font-mono font-bold bg-amber-50 text-amber-700 border border-amber-200">
                    <span class="w-1.5 h-1.5 rounded-full bg-amber-500 animate-pulse"></span>
                    {{ $opnames->count() }} PENDING
                </span>
            @endif
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-stone-50/80 border-b border-stone-100 text-[10px] font-mono font-bold text-stone-400 uppercase tracking-wider">
                        <th class="py-3.5 px-6">Produk</th>
                        <th class="py-3.5 px-4">Diajukan Oleh</th>
                        <th class="py-3.5 px-4 text-center">Stok Sistem</th>
                        <th class="py-3.5 px-4 text-center">Stok Fisik</th>
                        <th class="py-3.5 px-4 text-center">Selisih</th>
                        <th class="py-3.5 px-4">Catatan</th>
                        <th class="py-3.5 px-6 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-stone-100 text-xs">
                    @forelse($opnames as $item)
                    @php
                        $systemStock = $item->product->stock ?? 0;
                        $diff = $item->actual_stock - $systemStock;
                    @endphp
                    <tr class="hover:bg-teal-50/20 transition duration-150">
                        <td class="py-4 px-6">
                            <div class="flex items-center gap-3">
                                <div class="w-8 h-8 rounded-lg bg-[#0B1220] flex items-center justify-center text-teal-400 font-mono font-bold shrink-0 text-xs">
                                    {{ strtoupper(substr($item->product->name ?? '?', 0, 1)) }}
                                </div>
                                <span class="font-semibold text-stone-800">{{ $item->product->name ?? 'Produk Tidak Ditemukan' }}</span>
                            </div>
                        </td>
                        <td class="py-4 px-4 text-stone-500">{{ $item->user->name ?? '-' }}</td>
                        <td class="py-4 px-4 text-center font-mono text-stone-500 bg-stone-50/50">{{ $systemStock }}</td>
                        <td class="py-4 px-4 text-center font-mono font-bold text-teal-700">{{ $item->actual_stock }}</td>
                        <td class="py-4 px-4 text-center">
                            @if($diff === 0)
                                <span class="inline-flex items-center justify-center min-w-[3rem] px-2.5 py-1 rounded-full text-[11px] font-mono font-bold bg-emerald-50 text-emerald-700 border border-emerald-200">0</span>
                            @elseif($diff > 0)
                                <span class="inline-flex items-center justify-center min-w-[3rem] px-2.5 py-1 rounded-full text-[11px] font-mono font-bold bg-teal-50 text-teal-700 border border-teal-200">+{{ $diff }}</span>
                            @else
                                <span class="inline-flex items-center justify-center min-w-[3rem] px-2.5 py-1 rounded-full text-[11px] font-mono font-bold bg-rose-50 text-rose-700 border border-rose-200">{{ $diff }}</span>
                            @endif
                        </td>
                        <td class="py-4 px-4 text-stone-500">{{ $item->notes ?? '-' }}</td>
                        <td class="py-4 px-6 text-center">
                            <div class="flex items-center justify-center gap-2">
                                <form action="{{ route('manager.stock-opname.approve', $item->id) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="inline-flex items-center gap-1.5 px-3 py-1.5 font-semibold text-white bg-emerald-600 hover:bg-emerald-700 rounded-lg text-xs transition shadow-sm">
                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                                        Setujui
                                    </button>
                                </form>
                                <form action="{{ route('manager.stock-opname.reject', $item->id) }}" method="POST" onsubmit="return confirm('Tolak pengajuan ini?');">
                                    @csrf
                                    <button type="submit" class="inline-flex items-center gap-1.5 px-3 py-1.5 font-semibold text-white bg-rose-600 hover:bg-rose-700 rounded-lg text-xs transition shadow-sm">
                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                                        Tolak
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="py-14 text-center">
                            <div class="flex flex-col items-center justify-center text-stone-400">
                                <svg class="w-10 h-10 mb-2 text-stone-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                <span class="text-sm font-semibold text-stone-600">Semua sudah beres</span>
                                <span class="text-xs text-stone-400 font-mono">Tidak ada pengajuan stock opname yang perlu disetujui.</span>
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