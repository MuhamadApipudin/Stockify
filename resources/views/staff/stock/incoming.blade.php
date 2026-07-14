@extends('example.layouts.default.dashboard')

@section('content')
<link rel="preconnect" href="https://fonts.googleapis.com">
<link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@500;600;700&family=Inter:wght@400;500;600;700&family=JetBrains+Mono:wght@400;500;600;700&display=swap" rel="stylesheet">

<style>
    .font-display { font-family: 'Space Grotesk', sans-serif; }
    .font-mono { font-family: 'JetBrains Mono', monospace; }
</style>

<div class="p-6 space-y-6 font-[Inter]">

    @if(session('success'))
        <div class="flex items-center gap-3 p-4 text-xs font-semibold text-emerald-800 bg-emerald-50/90 border border-emerald-200 rounded-2xl shadow-[0_1px_2px_rgba(0,0,0,0.04)]">
            <svg class="w-4 h-4 text-emerald-600 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
            </svg>
            <span>{{ session('success') }}</span>
        </div>
    @endif

    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
        <div class="flex items-center gap-3.5">
            <div class="p-2.5 bg-[#0B1220] text-teal-400 rounded-xl shrink-0">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"></path>
                </svg>
            </div>
            <div>
                <h2 class="font-display text-2xl font-semibold text-[#0B1220] tracking-tight">Daftar Pengajuan Barang Masuk</h2>
                <p class="text-xs text-stone-400 mt-1">Pantau status pengajuan dan konfirmasi barang yang sudah disetujui.</p>
            </div>
        </div>

        <div class="flex items-center gap-2.5 shrink-0">
            <a href="{{ route('staff.stock.completed') }}"
               class="inline-flex items-center gap-1.5 px-4 py-2.5 text-xs font-semibold text-stone-600 hover:text-[#0B1220] bg-stone-100 hover:bg-stone-200 rounded-xl transition">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                Riwayat Selesai
            </a>
            <a href="{{ route('staff.stock.create') }}"
               class="inline-flex items-center gap-1.5 px-4 py-2.5 bg-[#0B1220] hover:bg-[#151f33] text-white text-xs font-semibold rounded-xl shadow-sm transition">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                Buat Pengajuan Baru
            </a>
        </div>
    </div>

    <div class="bg-white border border-stone-200/70 rounded-2xl shadow-[0_1px_2px_rgba(0,0,0,0.04)] overflow-hidden">

        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-stone-50/80 border-b border-stone-100 text-[10px] font-mono font-bold text-stone-400 uppercase tracking-wider">
                        <th class="py-3.5 px-6">Produk</th>
                        <th class="py-3.5 px-4 text-center">Jumlah</th>
                        <th class="py-3.5 px-4">Tanggal</th>
                        <th class="py-3.5 px-4 text-center">Status</th>
                        <th class="py-3.5 px-6 text-center">Aksi</th>
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

                        <td class="py-4 px-4 text-center font-mono font-bold text-emerald-700">
                            +{{ $t->quantity }}
                        </td>

                        <td class="py-4 px-4 text-stone-500 font-mono whitespace-nowrap">
                            {{ \Carbon\Carbon::parse($t->date)->format('d M Y') }}
                        </td>

                        <td class="py-4 px-4 text-center">
                            @if($t->status == 'pending')
                                <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-[11px] font-mono font-bold bg-amber-50 text-amber-700 border border-amber-200">
                                    <span class="w-1.5 h-1.5 rounded-full bg-amber-500 animate-pulse"></span>
                                    MENUNGGU MANAJER
                                </span>
                            @elseif($t->status == 'berhasil')
                                <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-[11px] font-mono font-bold bg-teal-50 text-teal-700 border border-teal-200">
                                    <span class="w-1.5 h-1.5 rounded-full bg-teal-500"></span>
                                    DISETUJUI
                                </span>
                            @endif
                        </td>

                        <td class="py-4 px-6 text-center">
                            @if($t->status == 'berhasil')
                                <form action="{{ route('transactions.confirm.direct', $t->id) }}" method="POST" onsubmit="return confirm('Konfirmasi bahwa barang ini sudah diproses secara fisik?');" class="inline-block">
                                    @csrf
                                    <button type="submit" class="inline-flex items-center gap-1.5 px-3 py-1.5 font-semibold text-white bg-emerald-600 hover:bg-emerald-700 rounded-lg text-xs transition shadow-sm">
                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                                        Konfirmasi Fisik
                                    </button>
                                </form>
                            @else
                                <span class="text-stone-300 text-xs font-mono">—</span>
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
                                <span class="text-sm font-semibold text-stone-600">Semua sudah beres</span>
                                <span class="text-xs text-stone-400 font-mono mt-0.5">Tidak ada pengajuan yang perlu diproses.</span>
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