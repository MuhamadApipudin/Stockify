<aside id="sidebar" class="fixed top-0 left-0 z-20 flex flex-col flex-shrink-0 hidden w-64 h-full pt-[88px] duration-200 lg:flex transition-all font-[Inter]" aria-label="Sidebar">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@500;600;700&family=Inter:wght@400;500;600;700&family=JetBrains+Mono:wght@400;500;600;700&display=swap" rel="stylesheet">

    <div class="relative flex flex-col flex-1 min-h-0 bg-white border-r border-stone-200/70 shadow-[1px_0_2px_rgba(0,0,0,0.02)] justify-between">

        <div class="flex flex-col flex-1 pt-6 pb-4 overflow-y-auto px-4 space-y-7">

            {{-- ============ MENU MANAGER ============ --}}
            <div>
                <p class="px-3 text-[10px] font-mono font-bold text-stone-400 uppercase tracking-wider mb-2.5">Menu Manager</p>

                <ul class="space-y-1.5 font-medium text-xs">

                    <li>
                        <a href="{{ route('dashboard') }}"
                           class="group flex items-center gap-3 px-3.5 py-2.5 rounded-xl transition duration-150 {{ request()->routeIs('dashboard') ? 'bg-[#0B1220] text-white shadow-sm font-semibold' : 'text-stone-600 hover:bg-stone-50 hover:text-[#0B1220]' }}">
                            <svg class="w-4 h-4 shrink-0 {{ request()->routeIs('dashboard') ? 'text-teal-400' : 'text-stone-400 group-hover:text-teal-600' }} transition" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                            </svg>
                            <span>Dashboard</span>
                        </a>
                    </li>

                    <li>
                        <a href="{{ route('products.index') }}"
                           class="group flex items-center gap-3 px-3.5 py-2.5 rounded-xl transition duration-150 {{ request()->routeIs('products.*') ? 'bg-[#0B1220] text-white shadow-sm font-semibold' : 'text-stone-600 hover:bg-stone-50 hover:text-[#0B1220]' }}">
                            <svg class="w-4 h-4 shrink-0 {{ request()->routeIs('products.*') ? 'text-teal-400' : 'text-stone-400 group-hover:text-teal-600' }} transition" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                            </svg>
                            <span>Data Produk</span>
                        </a>
                    </li>

                </ul>
            </div>

            {{-- ============ ANALISIS & LAPORAN ============ --}}
            <div>
                <p class="px-3 text-[10px] font-mono font-bold text-stone-400 uppercase tracking-wider mb-2.5">Analisis &amp; Laporan</p>

                <ul class="space-y-1.5 font-medium text-xs">

                    <li>
                        <a href="{{ route('manager.reports.stock') }}"
                           class="group flex items-center gap-3 px-3.5 py-2.5 rounded-xl transition duration-150 {{ request()->routeIs('manager.reports.stock') ? 'bg-[#0B1220] text-white shadow-sm font-semibold' : 'text-stone-600 hover:bg-stone-50 hover:text-[#0B1220]' }}">
                            <svg class="w-4 h-4 shrink-0 {{ request()->routeIs('manager.reports.stock') ? 'text-teal-400' : 'text-stone-400 group-hover:text-teal-600' }} transition" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2H7a2 2 0 01-2-2h2"></path>
                            </svg>
                            <span>Laporan Stok</span>
                        </a>
                    </li>

                    <li>
                        <a href="{{ url('/manager/laporan') }}"
                           class="group flex items-center gap-3 px-3.5 py-2.5 rounded-xl transition duration-150 {{ request()->is('manager/laporan*') ? 'bg-[#0B1220] text-white shadow-sm font-semibold' : 'text-stone-600 hover:bg-stone-50 hover:text-[#0B1220]' }}">
                            <svg class="w-4 h-4 shrink-0 {{ request()->is('manager/laporan*') ? 'text-teal-400' : 'text-stone-400 group-hover:text-teal-600' }} transition" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7h12m0 0l-4-4m4 4l-4 4M16 17H4m0 0l4 4m-4-4l4-4"></path>
                            </svg>
                            <span>Laporan Barang Masuk/Keluar</span>
                        </a>
                    </li>

                    <li>
                        <a href="{{ route('manager.suppliers.index') }}"
                           class="group flex items-center gap-3 px-3.5 py-2.5 rounded-xl transition duration-150 {{ request()->routeIs('manager.suppliers.index') ? 'bg-[#0B1220] text-white shadow-sm font-semibold' : 'text-stone-600 hover:bg-stone-50 hover:text-[#0B1220]' }}">
                            <svg class="w-4 h-4 shrink-0 {{ request()->routeIs('manager.suppliers.index') ? 'text-teal-400' : 'text-stone-400 group-hover:text-teal-600' }} transition" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 21h18M5 21V5a2 2 0 012-2h10a2 2 0 012 2v16M9 8h1m-1 4h1m-1 4h1m4-8h1m-1 4h1m-1 4h1"></path>
                            </svg>
                            <span>Daftar Supplier</span>
                        </a>
                    </li>

                </ul>
            </div>

            {{-- ============ OPERASIONAL ============ --}}
            <div>
                <p class="px-3 text-[10px] font-mono font-bold text-stone-400 uppercase tracking-wider mb-2.5">Operasional</p>

                <ul class="space-y-1.5 font-medium text-xs">

                    @php
                        $pendingCount = \App\Models\Transaction::where('status', 'pending')->count();
                    @endphp
                    <li>
                        <a href="{{ route('manager.pending') }}"
                           class="group flex items-center justify-between px-3.5 py-2.5 rounded-xl transition duration-150 {{ request()->routeIs('manager.pending') ? 'bg-[#0B1220] text-white shadow-sm font-semibold' : 'text-stone-600 hover:bg-stone-50 hover:text-[#0B1220]' }}">

                            <div class="flex items-center gap-3">
                                <svg class="w-4 h-4 shrink-0 {{ request()->routeIs('manager.pending') ? 'text-teal-400' : 'text-stone-400 group-hover:text-teal-600' }} transition" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                <span>Persetujuan Stok</span>
                            </div>
                            @if($pendingCount > 0)
                                <span class="inline-flex items-center justify-center min-w-[1.25rem] px-1.5 py-0.5 text-[10px] font-mono font-bold rounded-full {{ request()->routeIs('manager.pending') ? 'text-[#0B1220] bg-teal-400' : 'text-amber-700 bg-amber-100' }}">
                                    {{ $pendingCount }}
                                </span>
                            @endif
                        </a>
                    </li>

                    <li>
                        <a href="{{ route('manager.stock-opname') }}"
                           class="group flex items-center gap-3 px-3.5 py-2.5 rounded-xl transition duration-150 {{ request()->routeIs('manager.stock-opname') ? 'bg-[#0B1220] text-white shadow-sm font-semibold' : 'text-stone-600 hover:bg-stone-50 hover:text-[#0B1220]' }}">
                            <svg class="w-4 h-4 shrink-0 {{ request()->routeIs('manager.stock-opname') ? 'text-teal-400' : 'text-stone-400 group-hover:text-teal-600' }} transition" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0zM9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                            </svg>
                            <span>Stock Opname</span>
                        </a>
                    </li>

                </ul>
            </div>

        </div>

        <div class="p-3 border-t border-dashed border-stone-200 bg-stone-50/60">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit"
                        class="group flex items-center gap-3 w-full px-3.5 py-2.5 text-xs font-semibold text-rose-600 hover:bg-rose-50 rounded-xl transition duration-150">
                    <svg class="w-4 h-4 text-rose-500 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                    </svg>
                    <span>Keluar / Logout</span>
                </button>
            </form>
        </div>

    </div>
</aside>