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
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17V7m0 10a2 2 0 01-2 2H5a2 2 0 01-2-2V7a2 2 0 012-2h2a2 2 0 012 2m0 10a2 2 0 002 2h2a2 2 0 002-2M9 7a2 2 0 012-2h2a2 2 0 012 2m0 10V7m0 10a2 2 0 002 2h2a2 2 0 002-2V7a2 2 0 00-2-2h-2a2 2 0 00-2 2"></path>
            </svg>
        </div>
        <div>
            <h2 class="font-display text-2xl font-semibold text-[#0B1220] tracking-tight">Laporan Stock Opname</h2>
            <p class="text-xs text-stone-400 mt-1">Riwayat seluruh laporan selisih stok dari Staff dan status persetujuannya. (Read-only)</p>
        </div>
    </div>

    <div class="bg-white border border-stone-200/70 rounded-2xl shadow-[0_1px_2px_rgba(0,0,0,0.04)] overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-stone-50/80 border-b border-stone-100 text-[10px] font-mono font-bold text-stone-400 uppercase tracking-wider">
                        <th class="py-3.5 px-6">Produk</th>
                        <th class="py-3.5 px-4">Dilaporkan Oleh</th>
                        <th class="py-3.5 px-4 text-center">Stok Sistem</th>
                        <th class="py-3.5 px-4 text-center">Stok Fisik</th>
                        <th class="py-3.5 px-4 text-center">Selisih</th>
                        <th class="py-3.5 px-4">Catatan</th>
                        <th class="py-3.5 px-4 text-center">Status</th>
                        <th class="py-3.5 px-6">Tanggal</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-stone-100 text-xs">
                    @forelse($opnames as $item)
                    @php
                        $diff = $item->actual_stock - $item->system_stock;
                        $statusMap = [
                            'pending'  => ['label' => 'Menunggu', 'class' => 'bg-amber-50 text-amber-700 border-amber-200'],
                            'approved' => ['label' => 'Disetujui', 'class' => 'bg-emerald-50 text-emerald-700 border-emerald-200'],
                            'rejected' => ['label' => 'Ditolak', 'class' => 'bg-rose-50 text-rose-700 border-rose-200'],
                        ];
                        $status = $statusMap[$item->status] ?? ['label' => $item->status, 'class' => 'bg-stone-50 text-stone-600 border-stone-200'];
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
                        <td class="py-4 px-4 text-center font-mono text-stone-500 bg-stone-50/50">{{ $item->system_stock }}</td>
                        <td class="py-4 px-4 text-center font-mono font-bold text-teal-700">{{ $item->actual_stock }}</td>
                        <td class="py-4 px-4 text-center">
                            <span class="inline-flex items-center justify-center min-w-[3rem] px-2.5 py-1 rounded-full text-[11px] font-mono font-bold border
                                {{ $diff === 0 ? 'bg-emerald-50 text-emerald-700 border-emerald-200' : ($diff > 0 ? 'bg-teal-50 text-teal-700 border-teal-200' : 'bg-rose-50 text-rose-700 border-rose-200') }}">
                                {{ $diff === 0 ? '0' : ($diff > 0 ? '+'.$diff : $diff) }}
                            </span>
                        </td>
                        <td class="py-4 px-4 text-stone-500">{{ $item->notes ?? '-' }}</td>
                        <td class="py-4 px-4 text-center">
                            <span class="inline-flex items-center px-2.5 py-1 rounded-full text-[11px] font-mono font-bold border {{ $status['class'] }}">
                                {{ strtoupper($status['label']) }}
                            </span>
                        </td>
                        <td class="py-4 px-6 text-stone-400 font-mono text-[11px]">{{ $item->created_at->format('d M Y, H:i') }}</td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="8" class="py-14 text-center">
                            <div class="flex flex-col items-center justify-center text-stone-400">
                                <svg class="w-10 h-10 mb-2 text-stone-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12H5a2 2 0 00-2 2v7a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-4"></path>
                                </svg>
                                <span class="text-sm font-semibold text-stone-600">Belum ada data</span>
                                <span class="text-xs text-stone-400 font-mono">Belum ada laporan stock opname yang tercatat.</span>
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