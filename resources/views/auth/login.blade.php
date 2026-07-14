<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Stockify') }} — Masuk</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@500;600;700&family=Inter:wght@400;500;600;700&family=JetBrains+Mono:wght@400;500;600;700&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>

    <style>
        body { font-family: 'Inter', sans-serif; }
        .font-display { font-family: 'Space Grotesk', sans-serif; }
        .font-mono { font-family: 'JetBrains Mono', monospace; }
        .blueprint-grid {
            background-image:
                linear-gradient(rgba(255,255,255,0.05) 1px, transparent 1px),
                linear-gradient(90deg, rgba(255,255,255,0.05) 1px, transparent 1px);
            background-size: 28px 28px;
        }
        .manifest-perforation {
            background-image: radial-gradient(circle, rgba(45,212,191,0.35) 1.5px, transparent 1.5px);
            background-size: 10px 2px;
            background-repeat: repeat-x;
            background-position: center;
        }
    </style>
</head>
<body class="bg-[#F4F4F2] min-h-screen flex items-center justify-center p-4">

    <div class="w-full max-w-md">

        {{-- ============ BRAND HEADER ============ --}}
        <div class="relative overflow-hidden bg-[#0B1220] rounded-t-2xl border border-black/20 border-b-0 text-white">
            <div class="absolute inset-0 blueprint-grid pointer-events-none"></div>
            <div class="absolute -right-14 -top-14 w-52 h-52 bg-teal-600/10 rounded-full blur-3xl pointer-events-none"></div>

            <div class="relative z-10 px-8 pt-8 pb-6 text-center">
                <div class="inline-flex items-center justify-center w-11 h-11 rounded-xl bg-white/[0.06] border border-white/10 mb-4">
                    <svg class="w-5 h-5 text-teal-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                    </svg>
                </div>
                <h1 class="font-display text-xl font-semibold tracking-tight">{{ config('app.name', 'Stockify') }}</h1>
                <p class="text-xs text-slate-400 mt-1.5">Masuk untuk mengelola inventaris dan aktivitas gudang Anda.</p>
            </div>

            <div class="relative h-4 border-t border-dashed border-white/10 manifest-perforation"></div>
        </div>

        {{-- ============ FORM CARD ============ --}}
        <div class="bg-white rounded-b-2xl border border-stone-200/70 border-t-0 shadow-[0_1px_2px_rgba(0,0,0,0.04)] px-8 py-7">

            @if (session('status'))
                <div class="flex items-center gap-2.5 mb-5 p-3 text-xs font-semibold text-emerald-800 bg-emerald-50/90 border border-emerald-200 rounded-xl">
                    <svg class="w-4 h-4 text-emerald-600 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    <span>{{ session('status') }}</span>
                </div>
            @endif

            <form method="POST" action="{{ route('login') }}" class="space-y-4">
                @csrf

                {{-- Email --}}
                <div class="space-y-1.5">
                    <label for="email" class="text-xs font-mono font-bold text-stone-600 uppercase tracking-wider block">Email</label>
                    <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus autocomplete="username"
                           placeholder="nama@perusahaan.com"
                           class="w-full px-4 py-2.5 bg-stone-50 border border-stone-200 rounded-xl text-sm text-stone-800 focus:ring-2 focus:ring-teal-500/20 focus:border-teal-500 transition outline-none">
                    @error('email')
                        <p class="text-xs text-rose-600 font-medium mt-1 flex items-center gap-1">
                            <svg class="w-3.5 h-3.5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                {{-- Password --}}
                <div class="space-y-1.5">
                    <label for="password" class="text-xs font-mono font-bold text-stone-600 uppercase tracking-wider block">Password</label>
                    <input id="password" type="password" name="password" required autocomplete="current-password"
                           placeholder="••••••••"
                           class="w-full px-4 py-2.5 bg-stone-50 border border-stone-200 rounded-xl text-sm text-stone-800 focus:ring-2 focus:ring-teal-500/20 focus:border-teal-500 transition outline-none">
                    @error('password')
                        <p class="text-xs text-rose-600 font-medium mt-1 flex items-center gap-1">
                            <svg class="w-3.5 h-3.5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                {{-- Remember Me --}}
                <div class="flex items-center justify-between pt-1">
                    <label for="remember_me" class="inline-flex items-center gap-2 cursor-pointer select-none">
                        <input id="remember_me" type="checkbox" name="remember"
                               class="w-3.5 h-3.5 rounded border-stone-300 text-teal-600 focus:ring-teal-500 focus:ring-offset-0 cursor-pointer">
                        <span class="text-xs font-medium text-stone-500">{{ __('Remember me') }}</span>
                    </label>

                    @if (Route::has('password.request'))
                        <a href="{{ route('password.request') }}" class="text-xs font-semibold text-teal-700 hover:text-teal-800 transition">
                            {{ __('Lupa password?') }}
                        </a>
                    @endif
                </div>

                <button type="submit" class="w-full flex items-center justify-center gap-2 px-4 py-2.5 bg-[#0B1220] hover:bg-[#151f33] text-white rounded-xl text-xs font-semibold shadow-sm hover:shadow-md transition mt-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"></path></svg>
                    {{ __('Masuk') }}
                </button>
            </form>
        </div>

        <p class="text-center text-[11px] font-mono text-stone-400 mt-5">
            {{ config('app.name', 'Stockify') }} · SISTEM MANAJEMEN INVENTARIS
        </p>
    </div>

</body>
</html>