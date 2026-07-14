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
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path>
            </svg>
        </div>
        <div>
            <h2 class="font-display text-2xl font-semibold text-[#0B1220] tracking-tight">Daftar Supplier</h2>
            <p class="text-xs text-stone-400 mt-1">Daftar semua supplier yang terdaftar di sistem.</p>
        </div>
    </div>

    <div class="bg-white border border-stone-200/70 rounded-2xl shadow-[0_1px_2px_rgba(0,0,0,0.04)] overflow-hidden">

        <div class="flex items-center justify-between px-6 py-4 border-b border-dashed border-stone-200 bg-stone-50/40">
            <h3 class="font-display text-sm font-semibold text-[#0B1220]">Manifest Supplier</h3>
            <span class="font-mono text-[11px] text-stone-400">{{ $suppliers->count() }} SUPPLIER</span>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-stone-50/80 border-b border-stone-100 text-[10px] font-mono font-bold text-stone-400 uppercase tracking-wider">
                        <th class="py-3.5 px-6">Nama Supplier</th>
                        <th class="py-3.5 px-4">Kontak/Telepon</th>
                        <th class="py-3.5 px-6">Alamat</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-stone-100 text-xs">
                    @forelse($suppliers as $supplier)
                    <tr class="hover:bg-teal-50/20 transition duration-150">
                        <td class="py-4 px-6">
                            <div class="flex items-center gap-3">
                                <div class="w-8 h-8 rounded-lg bg-[#0B1220] flex items-center justify-center text-teal-400 font-mono font-bold shrink-0 text-xs">
                                    {{ strtoupper(substr($supplier->name, 0, 1)) }}
                                </div>
                                <span class="font-semibold text-stone-800">{{ $supplier->name }}</span>
                            </div>
                        </td>
                        <td class="py-4 px-4 text-stone-600 font-mono">{{ $supplier->phone }}</td>
                        <td class="py-4 px-6 text-stone-500">{{ $supplier->address ?? '-' }}</td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="3" class="py-14 text-center text-xs text-stone-400 font-mono">
                            Belum ada data supplier.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection