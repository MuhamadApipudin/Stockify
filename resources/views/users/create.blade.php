@extends('example.layouts.default.dashboard')

@section('content')
<link rel="preconnect" href="https://fonts.googleapis.com">
<link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@500;600;700&family=Inter:wght@400;500;600;700&family=JetBrains+Mono:wght@400;500;600;700&display=swap" rel="stylesheet">

<style>
    .font-display { font-family: 'Space Grotesk', sans-serif; }
    .font-mono { font-family: 'JetBrains Mono', monospace; }
</style>

<div class="p-6 space-y-6 max-w-5xl mx-auto font-[Inter]">

    <div class="flex items-center gap-3.5 pb-4 border-b border-dashed border-stone-200">
        <div class="p-2.5 bg-[#0B1220] text-teal-400 rounded-xl shrink-0">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"></path>
            </svg>
        </div>
        <div>
            <h2 class="font-display text-2xl font-semibold text-[#0B1220] tracking-tight">Tambah Pengguna</h2>
            <p class="text-xs text-stone-400 mt-1">Buat akun baru untuk Admin, Manajer Gudang, atau Staff Gudang.</p>
        </div>
    </div>

    @if($errors->any())
        <div class="p-4 text-xs font-semibold text-rose-800 bg-rose-50/90 border border-rose-200 rounded-2xl">
            <ul class="list-disc list-inside space-y-1">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

        {{-- ============ FORM ============ --}}
        <div class="lg:col-span-2 bg-white border border-stone-200/70 rounded-2xl shadow-[0_1px_2px_rgba(0,0,0,0.04)] overflow-hidden">
            <form action="{{ route('users.store') }}" method="POST" class="p-6 space-y-5">
                @csrf

                <div>
                    <label class="block text-xs font-semibold text-stone-600 mb-1.5 uppercase tracking-wider font-mono">Nama</label>
                    <input type="text" name="name" required value="{{ old('name') }}"
                        class="w-full text-sm bg-stone-50 border border-stone-200 rounded-xl px-3.5 py-2.5 focus:outline-none focus:ring-2 focus:ring-teal-500/40 focus:border-teal-500 transition"
                        placeholder="Nama lengkap">
                </div>

                <div>
                    <label class="block text-xs font-semibold text-stone-600 mb-1.5 uppercase tracking-wider font-mono">Email</label>
                    <input type="email" name="email" required value="{{ old('email') }}"
                        class="w-full text-sm bg-stone-50 border border-stone-200 rounded-xl px-3.5 py-2.5 focus:outline-none focus:ring-2 focus:ring-teal-500/40 focus:border-teal-500 transition"
                        placeholder="nama@stockify.com">
                </div>

                <div>
                    <label class="block text-xs font-semibold text-stone-600 mb-1.5 uppercase tracking-wider font-mono">Role</label>
                    <select name="role" required
                        class="w-full text-sm bg-stone-50 border border-stone-200 rounded-xl px-3.5 py-2.5 focus:outline-none focus:ring-2 focus:ring-teal-500/40 focus:border-teal-500 transition">
                        <option value="">-- Pilih role --</option>
                        <option value="admin" {{ old('role') === 'admin' ? 'selected' : '' }}>Admin</option>
                        <option value="Manajer Gudang" {{ old('role') === 'Manajer Gudang' ? 'selected' : '' }}>Manajer Gudang</option>
                        <option value="Staff Gudang" {{ old('role') === 'Staff Gudang' ? 'selected' : '' }}>Staff Gudang</option>
                    </select>
                </div>

                <div>
                    <label class="block text-xs font-semibold text-stone-600 mb-1.5 uppercase tracking-wider font-mono">Password</label>
                    <input type="password" name="password" required minlength="8"
                        class="w-full text-sm bg-stone-50 border border-stone-200 rounded-xl px-3.5 py-2.5 focus:outline-none focus:ring-2 focus:ring-teal-500/40 focus:border-teal-500 transition"
                        placeholder="Minimal 8 karakter">
                    <p class="text-[11px] text-stone-400 mt-1.5">Minimal 8 karakter.</p>
                </div>

                <div class="flex items-center gap-3 pt-2">
                    <button type="submit"
                        class="inline-flex items-center gap-2 px-5 py-2.5 font-semibold text-white bg-[#0B1220] hover:bg-stone-800 rounded-xl text-sm transition shadow-sm">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                        Simpan Pengguna
                    </button>
                    <a href="{{ route('users.index') }}"
                        class="px-5 py-2.5 font-semibold text-stone-600 bg-stone-100 hover:bg-stone-200 rounded-xl text-sm transition">
                        Batal
                    </a>
                </div>
            </form>
        </div>

        {{-- ============ PANEL BANTUAN ============ --}}
        <div class="lg:col-span-1 space-y-4">

            <div class="bg-white border border-stone-200/70 rounded-2xl shadow-[0_1px_2px_rgba(0,0,0,0.04)] p-5">
                <div class="flex items-center gap-2.5 mb-4">
                    <div class="p-1.5 bg-teal-50 text-teal-600 rounded-lg border border-teal-100">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a4 4 0 00-3-3.87M9 20H4v-2a4 4 0 013-3.87m6-1.13a4 4 0 100-8 4 4 0 000 8zm6 4v-2a4 4 0 00-3-3.87m-9 0a4 4 0 00-3 3.87v2"></path>
                        </svg>
                    </div>
                    <h3 class="font-display text-sm font-semibold text-[#0B1220]">Hak Akses per Role</h3>
                </div>
                <ul class="space-y-3 text-xs text-stone-500">
                    <li class="flex gap-2.5">
                        <span class="shrink-0 mt-0.5 px-1.5 py-0.5 rounded text-[10px] font-mono font-bold bg-teal-50 text-teal-700 border border-teal-200">ADMIN</span>
                        <span>Akses penuh: kelola pengguna, kategori, supplier, dan seluruh laporan sistem.</span>
                    </li>
                    <li class="flex gap-2.5">
                        <span class="shrink-0 mt-0.5 px-1.5 py-0.5 rounded text-[10px] font-mono font-bold bg-stone-100 text-stone-600 border border-stone-200 whitespace-nowrap">MANAJER</span>
                        <span>Approve/reject transaksi & stock opname, lihat laporan stok dan supplier.</span>
                    </li>
                    <li class="flex gap-2.5">
                        <span class="shrink-0 mt-0.5 px-1.5 py-0.5 rounded text-[10px] font-mono font-bold bg-stone-100 text-stone-600 border border-stone-200 whitespace-nowrap">STAFF</span>
                        <span>Konfirmasi barang masuk/keluar, laporkan selisih stock opname.</span>
                    </li>
                </ul>
            </div>

            <div class="bg-white border border-stone-200/70 rounded-2xl shadow-[0_1px_2px_rgba(0,0,0,0.04)] p-5">
                <div class="flex items-center gap-2.5 mb-3">
                    <div class="p-1.5 bg-amber-50 text-amber-600 rounded-lg border border-amber-100">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
                        </svg>
                    </div>
                    <h3 class="font-display text-sm font-semibold text-[#0B1220]">Perlu Diingat</h3>
                </div>
                <p class="text-xs text-stone-500 leading-relaxed">
                    Pastikan email yang dimasukkan valid dan belum terdaftar. Password bisa diubah lagi kapan saja lewat menu Edit Pengguna tanpa perlu tahu password lama.
                </p>
            </div>

            <a href="{{ route('users.index') }}"
                class="flex items-center justify-between p-4 bg-stone-50 hover:bg-stone-100 border border-stone-200/70 rounded-2xl text-xs font-semibold text-stone-600 transition group">
                <span>Lihat semua pengguna</span>
                <svg class="w-4 h-4 text-stone-400 group-hover:translate-x-0.5 transition" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                </svg>
            </a>

        </div>

    </div>
</div>
@endsection