@extends('example.layouts.default.dashboard')

@section('content')
<link rel="preconnect" href="https://fonts.googleapis.com">
<link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@500;600;700&family=Inter:wght@400;500;600;700&family=JetBrains+Mono:wght@400;500;600;700&display=swap" rel="stylesheet">

<style>
    .font-display { font-family: 'Space Grotesk', sans-serif; }
    .font-mono { font-family: 'JetBrains Mono', monospace; }
</style>

<div class="p-6 pb-4 bg-white border-b border-dashed border-stone-200 flex items-center gap-3.5 font-[Inter]">
    <div class="p-2.5 bg-[#0B1220] text-teal-400 rounded-xl shrink-0">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
        </svg>
    </div>
    <div>
        <h1 class="font-display text-xl font-semibold text-[#0B1220]">Edit Supplier</h1>
        <p class="text-xs text-stone-400 mt-0.5">{{ $supplier->name }}</p>
    </div>
</div>

<div class="p-6 font-[Inter]">
    <div class="bg-white border border-stone-200/70 rounded-2xl shadow-[0_1px_2px_rgba(0,0,0,0.04)] overflow-hidden max-w-2xl">

        <form action="{{ route('suppliers.update', $supplier->id) }}" method="POST" class="p-6 space-y-5">
            @csrf
            @method('PUT')

            <div class="space-y-1.5">
                <label class="text-xs font-mono font-bold text-stone-600 uppercase tracking-wider block">Nama Supplier <span class="text-rose-500">*</span></label>
                <input type="text" name="name" value="{{ old('name', $supplier->name) }}" required
                       class="w-full px-4 py-2.5 bg-stone-50 border border-stone-200 rounded-xl text-sm text-stone-800 focus:ring-2 focus:ring-teal-500/20 focus:border-teal-500 transition outline-none">
            </div>

            <div class="space-y-1.5">
                <label class="text-xs font-mono font-bold text-stone-600 uppercase tracking-wider block">No. Telepon</label>
                <input type="text" name="phone" value="{{ old('phone', $supplier->phone) }}" placeholder="0812xxxxxxx"
                       class="w-full px-4 py-2.5 bg-stone-50 border border-stone-200 rounded-xl text-sm font-mono text-stone-800 focus:ring-2 focus:ring-teal-500/20 focus:border-teal-500 transition outline-none">
            </div>

            <div class="space-y-1.5">
                <label class="text-xs font-mono font-bold text-stone-600 uppercase tracking-wider block">Alamat</label>
                <textarea name="address" rows="3"
                          class="w-full px-4 py-2.5 bg-stone-50 border border-stone-200 rounded-xl text-sm text-stone-800 focus:ring-2 focus:ring-teal-500/20 focus:border-teal-500 transition outline-none">{{ old('address', $supplier->address) }}</textarea>
            </div>

            <div class="flex justify-end gap-2 pt-4 border-t border-dashed border-stone-200">
                <a href="{{ route('suppliers.index') }}"
                   class="px-5 py-2.5 text-xs font-semibold text-stone-600 bg-stone-100 hover:bg-stone-200 rounded-xl transition">
                   Batal
                </a>
                <button type="submit"
                        class="inline-flex items-center gap-2 px-5 py-2.5 text-xs font-semibold text-white bg-[#0B1220] hover:bg-[#151f33] rounded-xl shadow-sm transition">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                    Simpan Perubahan
                </button>
            </div>
        </form>
    </div>
</div>
@endsection