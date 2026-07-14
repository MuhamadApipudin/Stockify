<aside id="sidebar" class="fixed top-0 left-0 z-30 flex flex-col flex-shrink-0 hidden w-64 h-full pt-[88px] duration-200 lg:flex transition-all font-[Inter]" aria-label="Sidebar">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@500;600;700&family=Inter:wght@400;500;600;700&family=JetBrains+Mono:wght@400;500;600;700&display=swap" rel="stylesheet">

    <div class="relative flex flex-col flex-1 min-h-0 bg-white border-r border-stone-200/70 shadow-[1px_0_2px_rgba(0,0,0,0.02)]">

        <div class="flex flex-col flex-1 pt-6 pb-4 overflow-y-auto px-4 space-y-7">

            {{-- ============ MAIN NAVIGATION ============ --}}
            <div>
                <p class="px-3 text-[10px] font-mono font-bold text-stone-400 uppercase tracking-wider mb-2.5">Main Navigation</p>

                <ul class="space-y-1.5 font-medium text-xs">

                    <li>
                        <a href="{{ route('dashboard') }}"
                           class="group flex items-center gap-3 px-3.5 py-2.5 rounded-xl transition duration-150 {{ request()->routeIs('dashboard') ? 'bg-[#0B1220] text-white shadow-sm font-semibold' : 'text-stone-600 hover:bg-stone-50 hover:text-[#0B1220]' }}">
                            <svg class="w-4 h-4 shrink-0 {{ request()->routeIs('dashboard') ? 'text-teal-400' : 'text-stone-400 group-hover:text-teal-600' }} transition" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"></path>
                            </svg>
                            <span>Dashboard</span>
                        </a>
                    </li>

                    @php
                        $isCrudActive = request()->is('products*') || request()->is('categories*') || request()->is('suppliers*');
                    @endphp
                    <li>
                        <button type="button"
                                class="group flex items-center justify-between w-full px-3.5 py-2.5 text-xs font-semibold rounded-xl transition duration-150 {{ $isCrudActive ? 'text-[#0B1220] bg-stone-100/80' : 'text-stone-600 hover:bg-stone-50 hover:text-[#0B1220]' }}"
                                aria-controls="dropdown-crud"
                                data-collapse-toggle="dropdown-crud">
                            <div class="flex items-center gap-3">
                                <svg class="w-4 h-4 shrink-0 {{ $isCrudActive ? 'text-teal-600' : 'text-stone-400 group-hover:text-teal-600' }} transition" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                                </svg>
                                <span>Manajemen Data</span>
                            </div>
                            <svg class="w-3.5 h-3.5 text-stone-400 transition-transform duration-200 {{ $isCrudActive ? 'rotate-180' : '' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                            </svg>
                        </button>

                        <ul id="dropdown-crud" class="space-y-1 pt-1.5 pl-4 ml-3.5 border-l border-dashed border-stone-200 {{ $isCrudActive ? 'block' : 'hidden' }}">

                            <li>
                                <a href="{{ url('products') }}"
                                   class="flex items-center gap-2.5 pl-3.5 pr-3 py-2 rounded-lg transition text-xs font-medium {{ request()->is('products*') ? 'bg-teal-50 text-teal-800 font-semibold' : 'text-stone-500 hover:text-stone-800 hover:bg-stone-50' }}">
                                    <span class="w-1.5 h-1.5 rounded-full shrink-0 {{ request()->is('products*') ? 'bg-teal-600' : 'bg-stone-300' }}"></span>
                                    Daftar Produk
                                </a>
                            </li>

                            <li>
                                <a href="{{ url('categories') }}"
                                   class="flex items-center gap-2.5 pl-3.5 pr-3 py-2 rounded-lg transition text-xs font-medium {{ request()->is('categories*') ? 'bg-teal-50 text-teal-800 font-semibold' : 'text-stone-500 hover:text-stone-800 hover:bg-stone-50' }}">
                                    <span class="w-1.5 h-1.5 rounded-full shrink-0 {{ request()->is('categories*') ? 'bg-teal-600' : 'bg-stone-300' }}"></span>
                                    Kategori
                                </a>
                            </li>

                            <li>
                                <a href="{{ url('suppliers') }}"
                                   class="flex items-center gap-2.5 pl-3.5 pr-3 py-2 rounded-lg transition text-xs font-medium {{ request()->is('suppliers*') ? 'bg-teal-50 text-teal-800 font-semibold' : 'text-stone-500 hover:text-stone-800 hover:bg-stone-50' }}">
                                    <span class="w-1.5 h-1.5 rounded-full shrink-0 {{ request()->is('suppliers*') ? 'bg-teal-600' : 'bg-stone-300' }}"></span>
                                    Supplier
                                </a>
                            </li>

                        </ul>
                    </li>

                    <li>
                        <a href="{{ url('stock-opname') }}"
                           class="group flex items-center gap-3 px-3.5 py-2.5 rounded-xl transition duration-150 {{ request()->is('stock-opname*') ? 'bg-[#0B1220] text-white shadow-sm font-semibold' : 'text-stone-600 hover:bg-stone-50 hover:text-[#0B1220]' }}">
                            <svg class="w-4 h-4 shrink-0 {{ request()->is('stock-opname*') ? 'text-teal-400' : 'text-stone-400 group-hover:text-teal-600' }} transition" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0zM9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                            </svg>
                            <span>Stock Opname</span>
                        </a>
                    </li>

                </ul>
            </div>

            {{-- ============ LAPORAN ============ --}}
            <div>
                <p class="px-3 text-[10px] font-mono font-bold text-stone-400 uppercase tracking-wider mb-2.5">Laporan</p>

                <ul class="space-y-1.5 font-medium text-xs">

                    <li>
                        <a href="{{ url('/reports/stock') }}"
                           class="group flex items-center gap-3 px-3.5 py-2.5 rounded-xl transition duration-150 {{ request()->is('reports/stock*') ? 'bg-[#0B1220] text-white shadow-sm font-semibold' : 'text-stone-600 hover:bg-stone-50 hover:text-[#0B1220]' }}">
                            <svg class="w-4 h-4 shrink-0 {{ request()->is('reports/stock*') ? 'text-teal-400' : 'text-stone-400 group-hover:text-teal-600' }} transition" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2H7a2 2 0 01-2-2h2"></path>
                            </svg>
                            <span>Laporan Stok</span>
                        </a>
                    </li>

                    <li>
                        <a href="{{ url('/reports/transactions') }}"
                           class="group flex items-center gap-3 px-3.5 py-2.5 rounded-xl transition duration-150 {{ request()->is('reports/transactions*') ? 'bg-[#0B1220] text-white shadow-sm font-semibold' : 'text-stone-600 hover:bg-stone-50 hover:text-[#0B1220]' }}">
                            <svg class="w-4 h-4 shrink-0 {{ request()->is('reports/transactions*') ? 'text-teal-400' : 'text-stone-400 group-hover:text-teal-600' }} transition" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7h12m0 0l-4-4m4 4l-4 4M16 17H4m0 0l4 4m-4-4l4-4"></path>
                            </svg>
                            <span>Laporan Transaksi</span>
                        </a>
                    </li>

                    <li>
                        <a href="{{ route('reports.activities') }}"
                           class="group flex items-center gap-3 px-3.5 py-2.5 rounded-xl transition duration-150 {{ request()->routeIs('reports.activities') ? 'bg-[#0B1220] text-white shadow-sm font-semibold' : 'text-stone-600 hover:bg-stone-50 hover:text-[#0B1220]' }}">
                            <svg class="w-4 h-4 shrink-0 {{ request()->routeIs('reports.activities') ? 'text-teal-400' : 'text-stone-400 group-hover:text-teal-600' }} transition" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            <span>Laporan Aktivitas</span>
                        </a>
                    </li>

                </ul>
            </div>

            {{-- ============ ADMINISTRASI ============ --}}
            <div>
                <p class="px-3 text-[10px] font-mono font-bold text-stone-400 uppercase tracking-wider mb-2.5">Administrasi</p>

                <ul class="space-y-1.5 font-medium text-xs">

                    <li>
                        <a href="{{ url('/users') }}"
                           class="group flex items-center gap-3 px-3.5 py-2.5 rounded-xl transition duration-150 {{ request()->is('users*') ? 'bg-[#0B1220] text-white shadow-sm font-semibold' : 'text-stone-600 hover:bg-stone-50 hover:text-[#0B1220]' }}">
                            <svg class="w-4 h-4 shrink-0 {{ request()->is('users*') ? 'text-teal-400' : 'text-stone-400 group-hover:text-teal-600' }} transition" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a4 4 0 00-3-3.87M9 20H4v-2a4 4 0 013-3.87m6-1.13a4 4 0 100-8 4 4 0 000 8zm6 4v-2a4 4 0 00-3-3.87m-9 0a4 4 0 00-3 3.87v2"></path>
                            </svg>
                            <span>Pengguna</span>
                        </a>
                    </li>

                    <li>
                        <a href="{{ url('/settings') }}"
                           class="group flex items-center gap-3 px-3.5 py-2.5 rounded-xl transition duration-150 {{ request()->is('settings*') ? 'bg-[#0B1220] text-white shadow-sm font-semibold' : 'text-stone-600 hover:bg-stone-50 hover:text-[#0B1220]' }}">
                            <svg class="w-4 h-4 shrink-0 {{ request()->is('settings*') ? 'text-teal-400' : 'text-stone-400 group-hover:text-teal-600' }} transition" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            </svg>
                            <span>Pengaturan</span>
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