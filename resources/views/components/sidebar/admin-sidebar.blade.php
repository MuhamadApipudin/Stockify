<x-sidebar-dashboard>
    <!-- 1. GANTI KODE INI (Menggunakan tag manual agar tidak dibajak komponen) -->
    <a href="{{ route('dashboard') }}" class="flex items-center p-2 text-base font-normal text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group {{ request()->routeIs('dashboard') ? 'bg-gray-100 dark:bg-gray-700' : '' }}">
        <svg class="w-6 h-6 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M2 10a8 8 0 018-8v8h8a8 8 0 11-16 0z"></path><path d="M12 2.252A8.014 8.014 0 0117.748 8H12V2.252z"></path></svg>
        <span class="ml-3 font-medium">Dashboard</span>
    </a>
    
    <!-- Menu sisanya biarkan tetap menggunakan komponen bawaan -->
    <x-sidebar-menu-dropdown-dashboard routeName="practice.*" title="Judul Dropdown">
        <x-sidebar-menu-dropdown-item-dashboard routeName="practice.first" title="Judul Item1"/>
        <x-sidebar-menu-dropdown-item-dashboard routeName="practice.second" title="Judul Item2"/>
    </x-sidebar-menu-dropdown-dashboard>
</x-sidebar-dashboard>