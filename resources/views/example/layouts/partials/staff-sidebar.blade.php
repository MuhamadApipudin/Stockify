<aside id="sidebar" class="fixed top-0 left-0 z-30 flex flex-col flex-shrink-0 hidden w-64 h-full pt-[88px] duration-200 lg:flex transition-all font-[Inter]" aria-label="Sidebar">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@500;600;700&family=Inter:wght@400;500;600;700&family=JetBrains+Mono:wght@400;500;600;700&display=swap" rel="stylesheet">

    <div class="relative flex flex-col flex-1 min-h-0 bg-white border-r border-stone-200/70 shadow-[1px_0_2px_rgba(0,0,0,0.02)] justify-between">

        <div class="flex flex-col flex-1 pt-6 pb-4 overflow-y-auto px-4 space-y-7">

            {{-- ============ MENU STAFF GUDANG ============ --}}
            <div>
                <p class="px-3 text-[10px] font-mono font-bold text-stone-400 uppercase tracking-wider mb-2.5">Menu Staff Gudang</p>

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

                </ul>
            </div>

            {{-- ============ STOK ============ --}}
            <div>
                <p class="px-3 text-[10px] font-mono font-bold text-stone-400 uppercase tracking-wider mb-2.5">Stok</p>

                <ul class="space-y-1.5 font-medium text-xs">

                    @php
                        $incomingCount = \App\Models\Transaction::where('type', 'masuk')->where('status', 'pending')->count();
                    @endphp
                    <li>
                        <a href="{{ route('staff.stock.incoming') }}"
                           class="group flex items-center justify-between px-3.5 py-2.5 rounded-xl transition duration-150 {{ request()->routeIs('staff.stock.incoming') ? 'bg-[#0B1220] text-white shadow-sm font-semibold' : 'text-stone-600 hover:bg-stone-50 hover:text-[#0B1220]' }}">
                            <div class="flex items-center gap-3">
                                <svg class="w-4 h-4 shrink-0 {{ request()->routeIs('staff.stock.incoming') ? 'text-teal-400' : 'text-stone-400 group-hover:text-teal-600' }} transition" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"></path>
                                </svg>
                                <span>Konfirmasi Barang Masuk</span>
                            </div>
                            @if($incomingCount > 0)
                                <span class="inline-flex items-center justify-center min-w-[1.25rem] px-1.5 py-0.5 text-[10px] font-mono font-bold rounded-full {{ request()->routeIs('staff.stock.incoming') ? 'text-[#0B1220] bg-teal-400' : 'text-emerald-700 bg-emerald-100' }}">
                                    {{ $incomingCount }}
                                </span>
                            @endif
                        </a>
                    </li>

                    @php
                        $outgoingCount = \App\Models\Transaction::where('type', 'keluar')->where('status', 'pending')->count();
                    @endphp
                    <li>
                        <a href="{{ route('staff.stock.outgoing') }}"
                           class="group flex items-center justify-between px-3.5 py-2.5 rounded-xl transition duration-150 {{ request()->routeIs('staff.stock.outgoing') ? 'bg-[#0B1220] text-white shadow-sm font-semibold' : 'text-stone-600 hover:bg-stone-50 hover:text-[#0B1220]' }}">
                            <div class="flex items-center gap-3">
                                <svg class="w-4 h-4 shrink-0 {{ request()->routeIs('staff.stock.outgoing') ? 'text-teal-400' : 'text-stone-400 group-hover:text-teal-600' }} transition" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                                </svg>
                                <span>Konfirmasi Barang Keluar</span>
                            </div>
                            @if($outgoingCount > 0)
                                <span class="inline-flex items-center justify-center min-w-[1.25rem] px-1.5 py-0.5 text-[10px] font-mono font-bold rounded-full {{ request()->routeIs('staff.stock.outgoing') ? 'text-[#0B1220] bg-teal-400' : 'text-rose-700 bg-rose-100' }}">
                                    {{ $outgoingCount }}
                                </span>
                            @endif
                        </a>
                    </li>

                    <li>
                        <a href="{{ route('staff.stock-opname.create') }}"
                           class="group flex items-center gap-3 px-3.5 py-2.5 rounded-xl transition duration-150 {{ request()->routeIs('staff.stock-opname.create') ? 'bg-[#0B1220] text-white shadow-sm font-semibold' : 'text-stone-600 hover:bg-stone-50 hover:text-[#0B1220]' }}">
                            <svg class="w-4 h-4 shrink-0 {{ request()->routeIs('staff.stock-opname.create') ? 'text-teal-400' : 'text-stone-400 group-hover:text-teal-600' }} transition" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 6l3 1m0 0l-3 9a5.002 5.002 0 006.001 0M6 7l3 9M6 7l6-2m6 2l3-1m-3 1l-3 9a5.002 5.002 0 006.001 0M18 7l3 9m-3-9l-6-2m0-2v2m0 16V5"></path>
                            </svg>
                            <span>Lapor Selisih Stok</span>
                        </a>
                    </li>

                    <li>
                        <a href="{{ route('staff.stock-opname.index') }}"
                           class="group flex items-center gap-3 px-3.5 py-2.5 rounded-xl transition duration-150 {{ request()->routeIs('staff.stock-opname.index') ? 'bg-[#0B1220] text-white shadow-sm font-semibold' : 'text-stone-600 hover:bg-stone-50 hover:text-[#0B1220]' }}">
                            <svg class="w-4 h-4 shrink-0 {{ request()->routeIs('staff.stock-opname.index') ? 'text-teal-400' : 'text-stone-400 group-hover:text-teal-600' }} transition" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"></path>
                            </svg>
                            <span>Riwayat Laporan Saya</span>
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