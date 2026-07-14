@extends('example.layouts.default.dashboard')

@section('content')
<link rel="preconnect" href="https://fonts.googleapis.com">
<link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@500;600;700&family=Inter:wght@400;500;600;700&family=JetBrains+Mono:wght@400;500;600;700&display=swap" rel="stylesheet">

<style>
    .font-display { font-family: 'Space Grotesk', sans-serif; }
    .font-mono { font-family: 'JetBrains Mono', monospace; }
</style>

<div class="p-6 space-y-6 font-[Inter]">

    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
        <div class="flex items-center gap-3.5">
            <div class="p-2.5 bg-[#0B1220] text-teal-400 rounded-xl shrink-0">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
            </div>
            <div>
                <h2 class="font-display text-2xl font-semibold text-[#0B1220] tracking-tight">Riwayat Konfirmasi Fisik</h2>
                <p class="text-xs text-stone-400 mt-1">Daftar transaksi yang sudah selesai dikonfirmasi secara fisik.</p>
            </div>
        </div>

        <a href="{{ route('staff.stock.incoming') }}"
           class="inline-flex items-center gap-1.5 px-4 py-2.5 text-xs font-semibold text-stone-600 hover:text-[#0B1220] bg-stone-100 hover:bg-stone-200 rounded-xl transition shrink-0">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 17l-5-5m0 0l5-5m-5 5h12"></path></svg>
            Kembali ke Daftar Pengajuan
        </a>
    </div>

    <div class="bg-white border border-stone-200/70 rounded-2xl shadow-[0_1px_2px_rgba(0,0,0,0.04)] overflow-hidden">

        <div class="flex items-center justify-between px-6 py-4 border-b border-dashed border-stone-200 bg-stone-50/40">
            <h3 class="font-display text-sm font-semibold text-[#0B1220]">Manifest Riwayat</h3>
            <span class="font-mono text-[11px] text-stone-400">{{ $transactions->total() }} TRANSAKSI</span>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-stone-50/80 border-b border-stone-100 text-[10px] font-mono font-bold text-stone-400 uppercase tracking-wider">
                        <th class="py-3.5 px-6">Produk</th>
                        <th class="py-3.5 px-4 text-center">Jumlah</th>
                        <th class="py-3.5 px-4">Tanggal Selesai</th>
                        <th class="py-3.5 px-6 text-center">Status</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-stone-100 text-xs">
                    @forelse($transactions as $t)
                    <tr class="hover:bg-teal-50/20 transition duration-150">
                        <td class="py-4 px-6">
                            <div class="flex items-center gap-3">
                                <div class="w-8 h-8 rounded-lg bg-[#0B1220] flex items-center justify-center text-teal-400 font-mono font-bold shrink-0 text-xs">
                                    {{ strtoupper(substr($t->product->name ?? '?', 0, 1)) }}
                                </div>
                                <span class="font-semibold text-stone-800">{{ $t->product->name ?? 'Produk Dihapus' }}</span>
                            </div>
                        </td>

                        <td class="py-4 px-4 text-center font-mono font-bold text-stone-700">
                            {{ $t->quantity }}
                        </td>

                        <td class="py-4 px-4 text-stone-500 font-mono whitespace-nowrap">
                            {{ $t->updated_at->format('d-m-Y H:i') }}
                        </td>

                        <td class="py-4 px-6 text-center">
                            <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-[11px] font-mono font-bold bg-teal-50 text-teal-700 border border-teal-200">
                                <span class="w-1.5 h-1.5 rounded-full bg-teal-500"></span>
                                SELESAI
                            </span>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="py-14 text-center">
                            <div class="flex flex-col items-center justify-center text-stone-400">
                                <svg class="w-10 h-10 mb-2 text-stone-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                <span class="text-sm font-semibold text-stone-600">Belum ada riwayat</span>
                                <span class="text-xs text-stone-400 font-mono mt-0.5">Belum ada transaksi yang dikonfirmasi.</span>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="p-4 border-t border-dashed border-stone-200">
            {{ $transactions->links() }}
        </div>
    </div>
</div>
@endsection