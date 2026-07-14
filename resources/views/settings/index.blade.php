@extends('example.layouts.default.dashboard')

@section('content')
<link rel="preconnect" href="https://fonts.googleapis.com">
<link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@500;600;700&family=Inter:wght@400;500;600;700&family=JetBrains+Mono:wght@400;500;600;700&display=swap" rel="stylesheet">

<style>
    .font-display { font-family: 'Space Grotesk', sans-serif; }
    .font-mono { font-family: 'JetBrains Mono', monospace; }
</style>

<div class="p-6 min-h-screen space-y-6 max-w-[1400px] mx-auto font-[Inter]">

    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 pb-4 border-b border-dashed border-stone-200">
        <div>
            <h1 class="font-display text-2xl font-semibold text-[#0B1220] tracking-tight">Pengaturan Aplikasi</h1>
            <p class="text-xs text-stone-400 mt-1">Kelola identitas, logo, dan informasi dasar sistem aplikasi Anda.</p>
        </div>
    </div>

    @if(session('success'))
    <div class="flex items-center justify-between p-4 text-emerald-800 bg-emerald-50/80 border border-emerald-200/80 rounded-2xl shadow-[0_1px_2px_rgba(0,0,0,0.04)] backdrop-blur-md" role="alert">
        <div class="flex items-center gap-3">
            <div class="p-1.5 bg-emerald-100 rounded-lg text-emerald-600">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
            </div>
            <span class="text-sm font-semibold">{{ session('success') }}</span>
        </div>
        <button type="button" onclick="this.parentElement.remove()" class="p-1 text-emerald-600 hover:text-emerald-800 hover:bg-emerald-100/50 rounded-lg transition">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
        </button>
    </div>
    @endif

    @if($errors->any())
    <div class="p-4 text-rose-800 bg-rose-50/80 border border-rose-200/80 rounded-2xl shadow-[0_1px_2px_rgba(0,0,0,0.04)] backdrop-blur-md" role="alert">
        <div class="flex items-center gap-3 mb-1">
            <div class="p-1.5 bg-rose-100 rounded-lg text-rose-600">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
            </div>
            <span class="text-sm font-semibold">Terjadi kesalahan input:</span>
        </div>
        <ul class="list-disc list-inside text-xs space-y-1 text-rose-700 pl-9">
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <div class="bg-white border border-stone-200/70 rounded-2xl shadow-[0_1px_2px_rgba(0,0,0,0.04)] overflow-hidden">

        <div class="p-6 border-b border-dashed border-stone-200 bg-stone-50/40 flex items-center gap-3">
            <div class="p-2.5 bg-[#0B1220] text-teal-400 rounded-xl shrink-0">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
            </div>
            <div>
                <h2 class="font-display text-base font-semibold text-[#0B1220]">Informasi &amp; Identitas Aplikasi</h2>
                <p class="text-xs text-stone-400">Konfigurasi ini akan ditampilkan pada sistem dan laporan.</p>
            </div>
        </div>

        <form action="{{ route('settings.update') }}" method="POST" enctype="multipart/form-data" class="p-6 space-y-6">
            @csrf

            <div class="space-y-2 pb-6 border-b border-dashed border-stone-200">
                <label class="text-xs font-mono font-bold text-stone-600 uppercase tracking-wider block">Logo Aplikasi</label>

                <div class="flex flex-col sm:flex-row items-start sm:items-center gap-5 pt-1">
                    <div class="relative w-24 h-24 rounded-2xl bg-stone-50 border-2 border-dashed border-stone-200 flex items-center justify-center overflow-hidden shrink-0 group">
                        @php
                            $currentLogo = $settings->where('key', 'app_logo')->first()->value ?? null;
                        @endphp
                        <img id="logo-preview"
                             src="{{ $currentLogo ? asset('storage/' . $currentLogo) : '' }}"
                             alt="Logo Preview"
                             class="{{ $currentLogo ? '' : 'hidden' }} w-full h-full object-contain p-2">

                        <div id="logo-placeholder" class="{{ $currentLogo ? 'hidden' : '' }} flex flex-col items-center text-stone-400">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                            <span class="text-[10px] mt-1 font-mono font-medium">NO LOGO</span>
                        </div>
                    </div>

                    <div class="space-y-2 flex-1 w-full">
                        <input type="file" name="app_logo" id="app_logo_input" accept="image/png, image/jpeg, image/jpg, image/svg+xml" onchange="previewImage(event)" class="hidden">

                        <div class="flex flex-wrap items-center gap-2">
                            <label for="app_logo_input" class="inline-flex items-center gap-2 px-4 py-2 bg-stone-100 hover:bg-stone-200 text-stone-700 rounded-xl text-xs font-semibold transition border border-stone-200/60 cursor-pointer">
                                <svg class="w-4 h-4 text-stone-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"></path></svg>
                                Pilih Logo Baru
                            </label>
                        </div>
                        <p class="text-xs text-stone-400">Format yang didukung: PNG, JPG, SVG. Ukuran maksimal: 2 MB.</p>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">

                <div class="space-y-1.5">
                    <label class="text-xs font-mono font-bold text-stone-600 uppercase tracking-wider">Nama Aplikasi <span class="text-rose-500">*</span></label>
                    <input type="text" name="app_name"
                           value="{{ old('app_name', $settings->where('key', 'app_name')->first()->value ?? '') }}"
                           placeholder="Contoh: Inventaris Pro" required
                           class="w-full px-4 py-2.5 bg-stone-50 border border-stone-200 rounded-xl text-xs text-stone-800 font-medium focus:ring-2 focus:ring-teal-500/20 focus:border-teal-500 transition outline-none">
                </div>

                <div class="space-y-1.5">
                    <label class="text-xs font-mono font-bold text-stone-600 uppercase tracking-wider">Email Kontak / Support</label>
                    <input type="email" name="app_email"
                           value="{{ old('app_email', $settings->where('key', 'app_email')->first()->value ?? '') }}"
                           placeholder="Contoh: support@inventaris.id"
                           class="w-full px-4 py-2.5 bg-stone-50 border border-stone-200 rounded-xl text-xs text-stone-800 font-medium focus:ring-2 focus:ring-teal-500/20 focus:border-teal-500 transition outline-none">
                </div>

                <div class="space-y-1.5 md:col-span-2">
                    <label class="text-xs font-mono font-bold text-stone-600 uppercase tracking-wider">Deskripsi Singkat / Tagline</label>
                    <textarea name="app_description" rows="2"
                              placeholder="Sistem Manajemen Inventaris Barang dan Aset Perusahaan..."
                              class="w-full px-4 py-2.5 bg-stone-50 border border-stone-200 rounded-xl text-xs text-stone-800 font-medium focus:ring-2 focus:ring-teal-500/20 focus:border-teal-500 transition outline-none">{{ old('app_description', $settings->where('key', 'app_description')->first()->value ?? '') }}</textarea>
                </div>

                <div class="space-y-1.5 md:col-span-2">
                    <label class="text-xs font-mono font-bold text-stone-600 uppercase tracking-wider">Teks Footer Copyright</label>
                    <input type="text" name="app_copyright"
                           value="{{ old('app_copyright', $settings->where('key', 'app_copyright')->first()->value ?? '© 2026 Inventaris Pro. All rights reserved.') }}"
                           placeholder="Contoh: © 2026 Inventaris Pro. All rights reserved."
                           class="w-full px-4 py-2.5 bg-stone-50 border border-stone-200 rounded-xl text-xs text-stone-800 font-mono focus:ring-2 focus:ring-teal-500/20 focus:border-teal-500 transition outline-none">
                </div>

            </div>

            <div class="pt-4 border-t border-dashed border-stone-200 flex justify-end">
                <button type="submit" class="inline-flex items-center gap-2 px-5 py-2.5 bg-[#0B1220] hover:bg-[#151f33] text-white rounded-xl text-xs font-semibold shadow-sm hover:shadow-md transition cursor-pointer">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                    Simpan Pengaturan
                </button>
            </div>
        </form>
    </div>
</div>

<script>
    // JavaScript Live Image Preview
    function previewImage(event) {
        const input = event.target;
        const preview = document.getElementById('logo-preview');
        const placeholder = document.getElementById('logo-placeholder');

        if (input.files && input.files[0]) {
            const reader = new FileReader();

            reader.onload = function(e) {
                preview.src = e.target.result;
                preview.classList.remove('hidden');
                placeholder.classList.add('hidden');
            }

            reader.readAsDataURL(input.files[0]);
        }
    }
</script>
@endsection