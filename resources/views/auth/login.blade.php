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
            background-image: radial-gradient(circle, rgba(255,255,255,0.14) 1.5px, transparent 1.5px);
            background-size: 10px 2px;
            background-repeat: repeat-x;
            background-position: center;
        }
        #rotating-text {
            transition: opacity 0.5s ease, transform 0.5s ease;
        }
        #rotating-text.fade-out {
            opacity: 0;
            transform: translateY(8px);
        }
        .input-focus-ring:focus-within {
            box-shadow: 0 0 0 3px rgba(20, 184, 166, 0.15);
            border-color: #14b8a6;
        }
    </style>
</head>
<body class="min-h-screen flex">

    {{-- ============ PANEL KIRI: BRAND + MANIFEST CARD ============ --}}
    <div class="hidden lg:flex lg:w-[52%] relative overflow-hidden bg-[#0B1220] flex-col justify-between p-12 xl:p-16">
        <div class="absolute inset-0 blueprint-grid pointer-events-none"></div>
        <div class="absolute -right-24 -top-24 w-96 h-96 bg-teal-600/10 rounded-full blur-3xl pointer-events-none"></div>
        <div class="absolute -left-24 -bottom-24 w-96 h-96 bg-teal-600/5 rounded-full blur-3xl pointer-events-none"></div>

        {{-- Logo & Nama App --}}
        <div class="relative z-10 flex items-center gap-3">
            <div class="w-10 h-10 rounded-xl bg-white/[0.06] border border-white/10 flex items-center justify-center">
                <svg class="w-5 h-5 text-teal-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                </svg>
            </div>
            <span class="font-display text-xl font-semibold text-white">{{ config('app.name', 'Stockify') }}</span>
        </div>

        {{-- Teks rotating + Manifest Card (signature element) --}}
        <div class="relative z-10 max-w-lg space-y-8">
            <div>
                <span class="inline-flex items-center gap-2 px-3 py-1 rounded-full text-[11px] font-mono font-semibold bg-white/5 text-teal-300 border border-teal-500/20 mb-6">
                    <span class="w-1.5 h-1.5 rounded-full bg-emerald-400 animate-pulse"></span>
                    SYSTEM&nbsp;·&nbsp;ONLINE
                </span>
                <p id="rotating-text" class="font-display text-3xl xl:text-4xl font-semibold text-white leading-snug">
                    Kelola stok tanpa drama.
                </p>
            </div>

            {{-- Manifest ticket card: signature visual, bertema label pengiriman gudang --}}
            <div class="relative bg-white/[0.04] border border-white/10 rounded-2xl overflow-hidden backdrop-blur-sm">
                <div class="flex items-center justify-between px-5 py-3 border-b border-dashed border-white/10">
                    <span class="font-mono text-[10px] font-bold text-teal-300 uppercase tracking-widest">Manifest · Hari Ini</span>
                    <span class="font-mono text-[10px] text-slate-500">{{ now()->format('d-m-Y') }}</span>
                </div>
                <div class="grid grid-cols-3 divide-x divide-white/10">
                    <div class="px-5 py-4">
                        <p class="font-mono text-2xl font-bold text-white">24/7</p>
                        <p class="text-[11px] text-slate-500 mt-1">Akses Sistem</p>
                    </div>
                    <div class="px-5 py-4">
                        <p class="font-mono text-2xl font-bold text-emerald-400">3</p>
                        <p class="text-[11px] text-slate-500 mt-1">Peran Pengguna</p>
                    </div>
                    <div class="px-5 py-4">
                        <p class="font-mono text-2xl font-bold text-teal-300">1:1</p>
                        <p class="text-[11px] text-slate-500 mt-1">Stok = Fisik</p>
                    </div>
                </div>
                <div class="h-3 manifest-perforation border-t border-dashed border-white/10"></div>
            </div>
        </div>

        {{-- Indikator titik + footer --}}
        <div class="relative z-10">
            <div class="flex items-center gap-2 mb-6" id="rotating-dots"></div>
            <p class="text-[11px] font-mono text-slate-500">
                {{ config('app.name', 'Stockify') }} · SISTEM MANAJEMEN INVENTARIS
            </p>
        </div>
    </div>

    {{-- ============ PANEL KANAN: FORM LOGIN ============ --}}
    <div class="w-full lg:w-[48%] flex items-center justify-center bg-white p-6 sm:p-12">
        <div class="w-full max-w-sm">

            {{-- Logo mobile-only --}}
            <div class="lg:hidden flex items-center gap-3 mb-8">
                <div class="w-10 h-10 rounded-xl bg-[#0B1220] flex items-center justify-center">
                    <svg class="w-5 h-5 text-teal-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                    </svg>
                </div>
                <span class="font-display text-xl font-semibold text-[#0B1220]">{{ config('app.name', 'Stockify') }}</span>
            </div>

            <h1 class="font-display text-2xl font-semibold text-[#0B1220] mb-1.5">Selamat Datang Kembali</h1>
            <p class="text-sm text-stone-400 mb-8">Masuk untuk mengelola inventaris dan aktivitas gudang Anda.</p>

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
                    <div class="input-focus-ring flex items-center gap-2.5 px-3.5 bg-stone-50 border border-stone-200 rounded-xl transition">
                        <svg class="w-4 h-4 text-stone-400 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9c1.657 0 3.183-.53 4.43-1.43"></path>
                        </svg>
                        <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus autocomplete="username"
                               placeholder="nama@perusahaan.com"
                               class="w-full py-2.5 bg-transparent text-sm text-stone-800 outline-none border-0 focus:ring-0">
                    </div>
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
                    <div class="input-focus-ring flex items-center gap-2.5 px-3.5 bg-stone-50 border border-stone-200 rounded-xl transition">
                        <svg class="w-4 h-4 text-stone-400 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                        </svg>
                        <input id="password" type="password" name="password" required autocomplete="current-password"
                               placeholder="••••••••"
                               class="w-full py-2.5 bg-transparent text-sm text-stone-800 outline-none border-0 focus:ring-0">
                        <button type="button" id="toggle-password" class="shrink-0 text-stone-400 hover:text-stone-600 transition" aria-label="Tampilkan password">
                            <svg id="eye-icon" class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                            </svg>
                        </button>
                    </div>
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

                <button type="submit" class="w-full flex items-center justify-center gap-2 px-4 py-2.5 bg-[#0B1220] hover:bg-[#151f33] text-white rounded-xl text-xs font-semibold shadow-sm hover:shadow-md hover:-translate-y-0.5 transition mt-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"></path></svg>
                    {{ __('Masuk') }}
                </button>
            </form>

            <p class="text-center text-[11px] font-mono text-stone-300 mt-10">
                {{ config('app.name', 'Stockify') }} © {{ now()->year }}
            </p>
        </div>
    </div>

    <script>
        const rotatingTexts = [
            'Kelola stok tanpa drama.',
            'Setiap barang tercatat, setiap perubahan terlacak.',
            'Dari staf hingga manajer, semua tersinkronisasi.',
            'Data akurat, keputusan lebih cepat.',
            'Barang masuk dan keluar, selalu ada jejaknya.'
        ];

        const textEl = document.getElementById('rotating-text');
        const dotsContainer = document.getElementById('rotating-dots');
        let currentIndex = 0;

        if (textEl && dotsContainer) {
            rotatingTexts.forEach((_, i) => {
                const dot = document.createElement('span');
                dot.className = 'h-1.5 rounded-full transition-all duration-300 ' + (i === 0 ? 'w-6 bg-teal-400' : 'w-1.5 bg-white/20');
                dotsContainer.appendChild(dot);
            });

            function updateDots() {
                Array.from(dotsContainer.children).forEach((dot, i) => {
                    dot.className = 'h-1.5 rounded-full transition-all duration-300 ' + (i === currentIndex ? 'w-6 bg-teal-400' : 'w-1.5 bg-white/20');
                });
            }

            setInterval(() => {
                textEl.classList.add('fade-out');
                setTimeout(() => {
                    currentIndex = (currentIndex + 1) % rotatingTexts.length;
                    textEl.textContent = rotatingTexts[currentIndex];
                    updateDots();
                    textEl.classList.remove('fade-out');
                }, 500);
            }, 4000);
        }

        // Toggle show/hide password
        const togglePassword = document.getElementById('toggle-password');
        const passwordInput = document.getElementById('password');
        const eyeIcon = document.getElementById('eye-icon');

        if (togglePassword && passwordInput) {
            togglePassword.addEventListener('click', function () {
                const isHidden = passwordInput.type === 'password';
                passwordInput.type = isHidden ? 'text' : 'password';

                eyeIcon.innerHTML = isHidden
                    ? '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.542-7a10.025 10.025 0 012.132-3.411m3.42-2.293A9.958 9.958 0 0112 5c4.478 0 8.268 2.943 9.542 7a9.965 9.965 0 01-1.563 3.029M3 3l18 18" />'
                    : '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>';
            });
        }
    </script>

</body>
</html>