<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Stoxura') }} — Daftar</title>

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

        .perforation-vertical {
            background-image: radial-gradient(circle, rgba(45,212,191,0.35) 1.5px, transparent 1.5px);
            background-size: 2px 10px;
            background-repeat: repeat-y;
            background-position: center;
        }

        .perforation-horizontal {
            background-image: radial-gradient(circle, rgba(45,212,191,0.35) 1.5px, transparent 1.5px);
            background-size: 10px 2px;
            background-repeat: repeat-x;
            background-position: center;
        }

        @keyframes float-crate {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-6px); }
        }
        .float-crate { animation: float-crate 6s ease-in-out infinite; }

        @media (prefers-reduced-motion: reduce) {
            .float-crate { animation: none; }
        }
    </style>
</head>
<body class="bg-[#F4F4F2] min-h-screen flex items-center justify-center p-4">

    <div class="w-full max-w-4xl grid grid-cols-1 lg:grid-cols-[1.05fr_1fr] rounded-2xl overflow-hidden shadow-[0_1px_2px_rgba(0,0,0,0.04)] border border-stone-200/70">

        {{-- ============ PANEL KIRI: SAMBUTAN ============ --}}
        <div class="relative overflow-hidden bg-[#0B1220] text-white px-8 py-10 lg:py-12 flex flex-col justify-between">
            <div class="absolute inset-0 blueprint-grid pointer-events-none"></div>
            <div class="absolute -right-16 -top-16 w-64 h-64 bg-teal-600/10 rounded-full blur-3xl pointer-events-none"></div>
            <div class="absolute -left-10 bottom-0 w-52 h-52 bg-teal-500/5 rounded-full blur-3xl pointer-events-none"></div>

            <div class="hidden lg:block absolute right-0 top-0 bottom-0 w-px perforation-vertical"></div>

            <div class="relative z-10">
                <div class="inline-flex items-center justify-center w-11 h-11 rounded-xl bg-white/[0.06] border border-white/10 mb-8">
                    <svg class="w-5 h-5 text-teal-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                    </svg>
                </div>

                <p class="font-mono text-[11px] font-bold text-teal-400 uppercase tracking-[0.2em] mb-3">
                    Sistem Manajemen Inventaris
                </p>
                <h1 id="rotating-headline" class="font-display text-3xl lg:text-[2.15rem] font-semibold tracking-tight leading-tight min-h-[5.5rem] lg:min-h-[6.5rem] transition-opacity duration-500 ease-out">
                    Buat akun<br class="hidden lg:block"> baru Anda.
                </h1>
                <p id="rotating-subtext" class="text-sm text-slate-400 mt-4 leading-relaxed max-w-sm min-h-[2.6rem] transition-opacity duration-500 ease-out">
                    Satu akun untuk mengelola stok, mengajukan barang masuk &amp; keluar,
                    dan memantau seluruh aktivitas gudang Anda.
                </p>

                <div id="rotating-dots" class="flex items-center gap-1.5 mt-5" aria-hidden="true">
                    <span class="w-1.5 h-1.5 rounded-full bg-teal-400 transition-colors duration-300"></span>
                    <span class="w-1.5 h-1.5 rounded-full bg-white/15 transition-colors duration-300"></span>
                    <span class="w-1.5 h-1.5 rounded-full bg-white/15 transition-colors duration-300"></span>
                </div>
            </div>

            <div class="relative z-10 mt-10 float-crate hidden sm:block">
                <div class="bg-white/[0.04] border border-white/10 rounded-xl px-4 py-3.5 backdrop-blur-sm max-w-[15rem]">
                    <div class="flex items-center justify-between mb-2.5">
                        <span class="font-mono text-[9px] font-bold text-teal-400 uppercase tracking-widest">Akun Baru</span>
                        <span class="w-1.5 h-1.5 rounded-full bg-teal-400"></span>
                    </div>
                    <div class="h-px perforation-horizontal mb-2.5"></div>
                    <div class="space-y-1.5">
                        <div class="flex items-center justify-between text-[11px]">
                            <span class="text-slate-400 font-mono">Akses dasbor</span>
                            <span class="text-white font-mono font-semibold">Instan</span>
                        </div>
                        <div class="flex items-center justify-between text-[11px]">
                            <span class="text-slate-400 font-mono">Role default</span>
                            <span class="text-amber-400 font-mono font-semibold">Menunggu</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- ============ PANEL KANAN: FORM DAFTAR ============ --}}
        <div class="bg-white px-8 py-10 lg:py-12 flex flex-col justify-center">

            <div class="mb-7">
                <h2 class="font-display text-xl font-semibold text-[#0B1220] tracking-tight">Daftar akun baru</h2>
                <p class="text-xs text-stone-400 mt-1.5">Lengkapi data di bawah untuk membuat akun.</p>
            </div>

            <form method="POST" action="{{ route('register') }}" class="space-y-4">
                @csrf

                {{-- Name --}}
                <div class="space-y-1.5">
                    <label for="name" class="text-xs font-mono font-bold text-stone-600 uppercase tracking-wider block">{{ __('Name') }}</label>
                    <input id="name" type="text" name="name" value="{{ old('name') }}" required autofocus autocomplete="name"
                           placeholder="Nama lengkap"
                           class="w-full px-4 py-2.5 bg-stone-50 border border-stone-200 rounded-xl text-sm text-stone-800 focus:ring-2 focus:ring-teal-500/20 focus:border-teal-500 transition outline-none">
                    @error('name')
                        <p class="text-xs text-rose-600 font-medium mt-1 flex items-center gap-1">
                            <svg class="w-3.5 h-3.5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                {{-- Email --}}
                <div class="space-y-1.5">
                    <label for="email" class="text-xs font-mono font-bold text-stone-600 uppercase tracking-wider block">{{ __('Email') }}</label>
                    <input id="email" type="email" name="email" value="{{ old('email') }}" required autocomplete="username"
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
                    <label for="password" class="text-xs font-mono font-bold text-stone-600 uppercase tracking-wider block">{{ __('Password') }}</label>
                    <input id="password" type="password" name="password" required autocomplete="new-password"
                           placeholder="••••••••"
                           class="w-full px-4 py-2.5 bg-stone-50 border border-stone-200 rounded-xl text-sm text-stone-800 focus:ring-2 focus:ring-teal-500/20 focus:border-teal-500 transition outline-none">
                    @error('password')
                        <p class="text-xs text-rose-600 font-medium mt-1 flex items-center gap-1">
                            <svg class="w-3.5 h-3.5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                {{-- Confirm Password --}}
                <div class="space-y-1.5">
                    <label for="password_confirmation" class="text-xs font-mono font-bold text-stone-600 uppercase tracking-wider block">{{ __('Confirm Password') }}</label>
                    <input id="password_confirmation" type="password" name="password_confirmation" required autocomplete="new-password"
                           placeholder="••••••••"
                           class="w-full px-4 py-2.5 bg-stone-50 border border-stone-200 rounded-xl text-sm text-stone-800 focus:ring-2 focus:ring-teal-500/20 focus:border-teal-500 transition outline-none">
                    @error('password_confirmation')
                        <p class="text-xs text-rose-600 font-medium mt-1 flex items-center gap-1">
                            <svg class="w-3.5 h-3.5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                <div class="flex items-center justify-between pt-2">
                    <a href="{{ route('login') }}" class="text-xs font-semibold text-teal-700 hover:text-teal-800 transition">
                        {{ __('Sudah punya akun?') }}
                    </a>

                    <button type="submit" class="flex items-center justify-center gap-2 px-5 py-2.5 bg-[#0B1220] hover:bg-[#151f33] text-white rounded-xl text-xs font-semibold shadow-sm hover:shadow-md transition">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                        {{ __('Daftar') }}
                    </button>
                </div>
            </form>

            <p class="text-center text-[11px] font-mono text-stone-400 mt-7">
                {{ config('app.name', 'Stoxura') }} · SISTEM MANAJEMEN INVENTARIS
            </p>
        </div>
    </div>

    <script>
        (function () {
            var messages = [
                {
                    title: 'Buat akun<br class="hidden lg:block"> baru Anda.',
                    subtitle: 'Satu akun untuk mengelola stok, mengajukan barang masuk &amp; keluar, dan memantau seluruh aktivitas gudang Anda.'
                },
                {
                    title: 'Satu tim,<br class="hidden lg:block"> satu data stok.',
                    subtitle: 'Staff, manajer, dan admin bekerja dari data yang sama — tidak ada lagi selisih catatan antar bagian.'
                },
                {
                    title: 'Mulai dalam<br class="hidden lg:block"> hitungan menit.',
                    subtitle: 'Isi data di samping, dan akun Anda siap dipakai untuk mengelola gudang hari ini juga.'
                }
            ];

            var headlineEl = document.getElementById('rotating-headline');
            var subtextEl = document.getElementById('rotating-subtext');
            var dots = document.querySelectorAll('#rotating-dots span');
            var index = 0;
            var prefersReducedMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;

            if (!headlineEl || !subtextEl || messages.length <= 1) return;

            function setActiveDot(i) {
                dots.forEach(function (dot, dotIndex) {
                    dot.classList.toggle('bg-teal-400', dotIndex === i);
                    dot.classList.toggle('bg-white/15', dotIndex !== i);
                });
            }

            function showMessage(i) {
                headlineEl.innerHTML = messages[i].title;
                subtextEl.innerHTML = messages[i].subtitle;
                setActiveDot(i);
            }

            function rotate() {
                index = (index + 1) % messages.length;

                if (prefersReducedMotion) {
                    showMessage(index);
                    return;
                }

                headlineEl.style.opacity = '0';
                subtextEl.style.opacity = '0';

                setTimeout(function () {
                    showMessage(index);
                    headlineEl.style.opacity = '1';
                    subtextEl.style.opacity = '1';
                }, 500);
            }

            setInterval(rotate, 4500);
        })();
    </script>

</body>
</html>