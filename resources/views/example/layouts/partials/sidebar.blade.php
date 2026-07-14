<aside id="sidebar" class="fixed top-0 left-0 z-30 flex flex-col flex-shrink-0 hidden w-64 h-full pt-16 duration-200 lg:flex transition-all" aria-label="Sidebar">
    <div class="relative flex flex-col flex-1 min-h-0 bg-white border-r border-slate-100 shadow-xs">
        
        <div class="flex flex-col flex-1 pt-5 pb-4 overflow-y-auto px-4 space-y-6">
            
            <div>
                <p class="px-3 text-[10px] font-bold text-slate-400 uppercase tracking-wider mb-2">Main Navigation</p>
                
                <ul class="space-y-1.5 font-medium text-xs">
                    
                    <li>
                        <a href="{{ route('dashboard') }}" 
                           class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl transition duration-150 {{ request()->routeIs('dashboard') ? 'bg-slate-900 text-white shadow-xs font-semibold' : 'text-slate-600 hover:bg-slate-50 hover:text-slate-900' }}">
                            <svg class="w-4 h-4 {{ request()->routeIs('dashboard') ? 'text-white' : 'text-slate-400 group-hover:text-slate-600' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
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
                                class="flex items-center justify-between w-full px-3.5 py-2.5 text-xs font-semibold rounded-xl transition duration-150 {{ $isCrudActive ? 'text-slate-900 bg-slate-100/70' : 'text-slate-600 hover:bg-slate-50 hover:text-slate-900' }}" 
                                aria-controls="dropdown-crud" 
                                data-collapse-toggle="dropdown-crud">
                            <div class="flex items-center gap-3">
                                <svg class="w-4 h-4 {{ $isCrudActive ? 'text-slate-900' : 'text-slate-400' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                                </svg>
                                <span>Manajemen Data</span>
                            </div>
                            <svg class="w-3.5 h-3.5 text-slate-400 transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                            </svg>
                        </button>
                        
                        <ul id="dropdown-crud" class="space-y-1 pt-1.5 pl-4 {{ $isCrudActive ? 'block' : 'hidden' }}">
                            <li>
                                <a href="{{ url('products') }}" 
                                   class="flex items-center gap-2 px-3 py-2 rounded-lg transition text-xs font-medium {{ request()->is('products*') ? 'bg-blue-50 text-blue-700 font-semibold' : 'text-slate-500 hover:text-slate-800 hover:bg-slate-50' }}">
                                    <span class="w-1.5 h-1.5 rounded-full {{ request()->is('products*') ? 'bg-blue-600' : 'bg-slate-300' }}"></span>
                                    Daftar Produk
                                </a>
                            </li>
                            <li>
                                <a href="{{ url('categories') }}" 
                                   class="flex items-center gap-2 px-3 py-2 rounded-lg transition text-xs font-medium {{ request()->is('categories*') ? 'bg-blue-50 text-blue-700 font-semibold' : 'text-slate-500 hover:text-slate-800 hover:bg-slate-50' }}">
                                    <span class="w-1.5 h-1.5 rounded-full {{ request()->is('categories*') ? 'bg-blue-600' : 'bg-slate-300' }}"></span>
                                    Kategori
                                </a>
                            </li>
                            <li>
                                <a href="{{ url('suppliers') }}" 
                                   class="flex items-center gap-2 px-3 py-2 rounded-lg transition text-xs font-medium {{ request()->is('suppliers*') ? 'bg-blue-50 text-blue-700 font-semibold' : 'text-slate-500 hover:text-slate-800 hover:bg-slate-50' }}">
                                    <span class="w-1.5 h-1.5 rounded-full {{ request()->is('suppliers*') ? 'bg-blue-600' : 'bg-slate-300' }}"></span>
                                    Supplier
                                </a>
                            </li>
                        </ul>
                    </li>

                </ul>
            </div>

            <div>
                <p class="px-3 text-[10px] font-bold text-slate-400 uppercase tracking-wider mb-2">Pengaturan</p>
                <ul class="space-y-1.5 font-medium text-xs">
                    <li>
                        <a href="{{ url('/settings') }}" 
                           class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl transition duration-150 {{ request()->is('settings*') ? 'bg-slate-900 text-white shadow-xs font-semibold' : 'text-slate-600 hover:bg-slate-50 hover:text-slate-900' }}">
                            <svg class="w-4 h-4 {{ request()->is('settings*') ? 'text-white' : 'text-slate-400' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            </svg>
                            <span>Pengaturan</span>
                        </a>
                    </li>
                </ul>
            </div>

        </div>

        <div class="p-3 border-t border-slate-100 bg-slate-50/50">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" 
                        class="flex items-center gap-3 w-full px-3.5 py-2.5 text-xs font-semibold text-rose-600 hover:bg-rose-50 rounded-xl transition duration-150">
                    <svg class="w-4 h-4 text-rose-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                    </svg>
                    <span>Keluar / Logout</span>
                </button>
            </form>
        </div>

    </div>
</aside>