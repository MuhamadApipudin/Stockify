@extends('example.layouts.default.dashboard')

@section('content')
<div class="p-6 bg-slate-50/50 min-h-screen">
    @if(session('success'))
        <div class="flex items-center gap-3 p-4 mb-6 text-sm text-emerald-800 bg-emerald-50 border border-emerald-200 rounded-xl shadow-sm">
            <svg class="w-5 h-5 text-emerald-600 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
            </svg>
            <span class="font-medium">{{ session('success') }}</span>
        </div>
    @endif

    @if(session('error'))
        <div class="flex items-center gap-3 p-4 mb-6 text-sm text-rose-800 bg-rose-50 border border-rose-200 rounded-xl shadow-sm">
            <svg class="w-5 h-5 text-rose-600 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
            </svg>
            <span class="font-medium">{{ session('error') }}</span>
        </div>
    @endif

    <div class="bg-white rounded-2xl border border-slate-100 shadow-sm p-5 mb-6">
        <form method="GET" action="{{ route('manager.pending') }}" class="grid grid-cols-1 md:grid-cols-4 lg:grid-cols-5 gap-4">

            <div class="lg:col-span-2">
                <label class="block text-xs font-bold text-slate-500 uppercase tracking-wider mb-1.5">Cari Produk / SKU</label>
                <div class="relative">
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Ketik nama produk atau SKU..."
                           class="w-full pl-9 pr-4 py-2 text-xs bg-slate-50 border border-slate-200 rounded-xl focus:bg-white focus:ring-2 focus:ring-blue-500 focus:outline-none transition">
                    <svg class="w-4 h-4 text-slate-400 absolute left-3 top-2.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                    </svg>
                </div>
            </div>

            <div>
                <label class="block text-xs font-bold text-slate-500 uppercase tracking-wider mb-1.5">Tipe Transaksi</label>
                <select name="type" class="w-full px-3 py-2 text-xs bg-slate-50 border border-slate-200 rounded-xl focus:bg-white focus:ring-2 focus:ring-blue-500 focus:outline-none transition">
                    <option value="">Semua Tipe</option>
                    <option value="masuk" {{ request('type') == 'masuk' ? 'selected' : '' }}>Barang Masuk</option>
                    <option value="keluar" {{ request('type') == 'keluar' ? 'selected' : '' }}>Barang Keluar</option>
                </select>
            </div>

            <div>
                <label class="block text-xs font-bold text-slate-500 uppercase tracking-wider mb-1.5">Dari Tanggal</label>
                <input type="date" name="date_from" value="{{ request('date_from') }}"
                       class="w-full px-3 py-2 text-xs bg-slate-50 border border-slate-200 rounded-xl focus:bg-white focus:ring-2 focus:ring-blue-500 focus:outline-none transition">
            </div>

            <div class="flex items-end gap-2">
                <button type="submit" class="flex-1 py-2 px-4 bg-slate-900 hover:bg-slate-800 text-white text-xs font-semibold rounded-xl transition shadow-xs flex items-center justify-center gap-1.5">
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"></path>
                    </svg>
                    <span>Filter</span>
                </button>

                @if(request()->anyFilled(['search', 'type', 'date_from', 'date_to']))
                    <a href="{{ route('manager.pending') }}" class="py-2 px-3 bg-slate-100 hover:bg-slate-200 text-slate-600 text-xs font-semibold rounded-xl transition flex items-center justify-center" title="Reset Filter">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path>
                        </svg>
                    </a>
                @endif
            </div>

        </form>
    </div>

    <div class="bg-white rounded-2xl border border-slate-100 shadow-sm overflow-hidden">

        <div class="p-6 border-b border-slate-100 flex items-center justify-between">
            <div>
                <h2 class="text-base font-bold text-slate-800">Daftar Pengajuan Pending</h2>
                <p class="text-xs text-slate-400 mt-0.5">Membutuhkan tindakan persetujuan dari Manajer/Admin.</p>
            </div>

            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-amber-50 text-amber-700 border border-amber-200">
                {{ $transactions->total() }} Menunggu
            </span>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-slate-50/50 border-b border-slate-100 text-[11px] font-bold text-slate-400 uppercase tracking-wider">
                        <th class="py-3.5 px-6">Produk</th>
                        <th class="py-3.5 px-6 text-center">Jumlah</th>
                        <th class="py-3.5 px-6 text-center">Tipe Transaksi</th>
                        <th class="py-3.5 px-6">Tanggal Pengajuan</th>
                        <th class="py-3.5 px-6 text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 text-sm">
                    @forelse($transactions as $t)
                    <tr class="hover:bg-slate-50/60 transition duration-150">

                        <td class="py-4 px-6">
                            <div class="flex items-center gap-3">
                                <div class="w-9 h-9 rounded-lg bg-slate-100 flex items-center justify-center text-slate-400 shrink-0">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                                    </svg>
                                </div>
                                <span class="font-semibold text-slate-800">
                                    {{ $t->product->name ?? 'Produk Dihapus' }}
                                </span>
                            </div>
                        </td>

                        <td class="py-4 px-6 text-center font-bold text-slate-700">
                            {{ number_format($t->quantity) }}
                        </td>

                        <td class="py-4 px-6 text-center">
                            @if($t->type == 'masuk')
                                <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-bold text-emerald-700 bg-emerald-50 border border-emerald-200">
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 14l-7 7m0 0l-7-7m7 7V3"></path></svg>
                                    Barang Masuk
                                </span>
                            @else
                                <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-bold text-rose-700 bg-rose-50 border border-rose-200">
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 10l7-7m0 0l7 7m-7-7v18"></path></svg>
                                    Barang Keluar
                                </span>
                            @endif
                        </td>

                        <td class="py-4 px-6 text-xs font-medium text-slate-500">
                            {{ \Carbon\Carbon::parse($t->date)->format('d M Y') ?? $t->date }}
                        </td>

                        <td class="py-4 px-6 text-right flex gap-2 justify-end">
    <form action="{{ route('manager.approve', $t->id) }}" method="POST" class="inline-block">
        @csrf
        <button type="submit"
            class="inline-flex items-center gap-1.5 px-4 py-2 bg-emerald-600 hover:bg-emerald-700 text-white text-xs font-semibold rounded-xl shadow-xs hover:shadow transition duration-200 cursor-pointer">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
            </svg>
            <span>Setujui</span>
        </button>
    </form>

    <form action="{{ route('manager.reject', $t->id) }}" method="POST" class="inline-block" 
          onsubmit="return confirm('Apakah Anda yakin ingin menolak transaksi ini?')">
        @csrf
        <button type="submit"
            class="inline-flex items-center gap-1.5 px-4 py-2 bg-red-600 hover:bg-red-700 text-white text-xs font-semibold rounded-xl shadow-xs hover:shadow transition duration-200 cursor-pointer">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
            </svg>
            <span>Tolak</span>
        </button>
    </form>
</td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="py-12 text-center">
                            <div class="flex flex-col items-center justify-center text-slate-400">
                                <div class="w-12 h-12 rounded-full bg-slate-50 flex items-center justify-center mb-3">
                                    <svg class="w-6 h-6 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                                    </svg>
                                </div>
                                <span class="text-sm font-semibold text-slate-600">Data Tidak Ditemukan</span>
                                <span class="text-xs text-slate-400 mt-0.5">Tidak ada transaksi yang cocok dengan kriteria filter Anda.</span>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($transactions->hasPages())
        <div class="px-6 py-4 border-t border-slate-100 flex flex-col sm:flex-row items-center justify-between gap-4 bg-slate-50/30">
            <p class="text-xs text-slate-500">
                Menampilkan
                <span class="font-semibold text-slate-700">{{ $transactions->firstItem() }}</span>
                sampai
                <span class="font-semibold text-slate-700">{{ $transactions->lastItem() }}</span>
                dari
                <span class="font-semibold text-slate-700">{{ $transactions->total() }}</span> entri
            </p>

            <div class="flex items-center gap-1">
                @if ($transactions->onFirstPage())
                    <span class="px-3 py-1.5 text-xs font-medium text-slate-300 bg-white border border-slate-200 rounded-lg cursor-not-allowed">
                        Prev
                    </span>
                @else
                    <a href="{{ $transactions->previousPageUrl() }}" class="px-3 py-1.5 text-xs font-medium text-slate-600 hover:text-slate-900 bg-white hover:bg-slate-50 border border-slate-200 rounded-lg transition">
                        Prev
                    </a>
                @endif

                @foreach ($transactions->getUrlRange(1, $transactions->lastPage()) as $page => $url)
                    @if ($page == $transactions->currentPage())
                        <span class="px-3 py-1.5 text-xs font-bold text-white bg-slate-900 rounded-lg shadow-xs">
                            {{ $page }}
                        </span>
                    @else
                        <a href="{{ $url }}" class="px-3 py-1.5 text-xs font-medium text-slate-600 hover:text-slate-900 bg-white hover:bg-slate-50 border border-slate-200 rounded-lg transition">
                            {{ $page }}
                        </a>
                    @endif
                @endforeach

                @if ($transactions->hasMorePages())
                    <a href="{{ $transactions->nextPageUrl() }}" class="px-3 py-1.5 text-xs font-medium text-slate-600 hover:text-slate-900 bg-white hover:bg-slate-50 border border-slate-200 rounded-lg transition">
                        Next
                    </a>
                @else
                    <span class="px-3 py-1.5 text-xs font-medium text-slate-300 bg-white border border-slate-200 rounded-lg cursor-not-allowed">
                        Next
                    </span>
                @endif
            </div>
        </div>
        @endif

    </div>

</div>
@endsection