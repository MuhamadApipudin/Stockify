@extends('example.layouts.default.dashboard')

@section('content')
<link rel="preconnect" href="https://fonts.googleapis.com">
<link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@500;600;700&family=Inter:wght@400;500;600;700&family=JetBrains+Mono:wght@400;500;600;700&display=swap" rel="stylesheet">

<style>
    .font-display { font-family: 'Space Grotesk', sans-serif; }
    .font-mono { font-family: 'JetBrains Mono', monospace; }
</style>

<div class="p-6 space-y-6 max-w-[1400px] mx-auto font-[Inter]">

    <div class="flex items-center justify-between gap-3.5 pb-4 border-b border-dashed border-stone-200">
        <div class="flex items-center gap-3.5">
            <div class="p-2.5 bg-[#0B1220] text-teal-400 rounded-xl shrink-0">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a4 4 0 00-3-3.87M9 20H4v-2a4 4 0 013-3.87m6-1.13a4 4 0 100-8 4 4 0 000 8zm6 4v-2a4 4 0 00-3-3.87m-9 0a4 4 0 00-3 3.87v2"></path>
                </svg>
            </div>
            <div>
                <h2 class="font-display text-2xl font-semibold text-[#0B1220] tracking-tight">Manajemen Pengguna</h2>
                <p class="text-xs text-stone-400 mt-1">Kelola akun, peran, dan hak akses pengguna sistem.</p>
            </div>
        </div>

        <a href="{{ route('users.create') }}"
           class="inline-flex items-center gap-2 px-4 py-2.5 bg-[#0B1220] hover:bg-stone-800 text-white rounded-xl text-xs font-semibold transition shadow-sm shrink-0">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
            </svg>
            Tambah Pengguna
        </a>
    </div>

    @if(session('success'))
        <div class="flex items-center gap-3 p-4 text-xs font-semibold text-emerald-800 bg-emerald-50/90 border border-emerald-200 rounded-2xl shadow-[0_1px_2px_rgba(0,0,0,0.04)]">
            <svg class="w-4 h-4 text-emerald-600 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
            </svg>
            <span>{{ session('success') }}</span>
        </div>
    @endif

    <div class="bg-white border border-stone-200/70 rounded-2xl shadow-[0_1px_2px_rgba(0,0,0,0.04)] overflow-hidden">

        <div class="p-6 border-b border-dashed border-stone-200 bg-stone-50/40">
            <form method="GET" class="flex flex-col sm:flex-row items-stretch sm:items-center gap-2.5">
                <div class="relative flex-1 sm:w-72">
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari nama atau email..."
                           class="w-full pl-9 pr-3 py-2.5 bg-stone-50 border border-stone-200 rounded-xl text-xs focus:ring-2 focus:ring-teal-500/20 focus:border-teal-500 transition outline-none">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-stone-400">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                    </div>
                </div>
                <button type="submit" class="inline-flex items-center justify-center gap-2 px-4 py-2.5 bg-[#0B1220] hover:bg-[#151f33] text-white rounded-xl text-xs font-semibold transition shadow-sm shrink-0">
                    Cari
                </button>
            </form>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-stone-50/80 border-b border-stone-100 text-[10px] font-mono font-bold text-stone-400 uppercase tracking-wider">
                        <th class="py-3.5 px-6">Nama</th>
                        <th class="py-3.5 px-4">Email</th>
                        <th class="py-3.5 px-4 text-center">Role</th>
                        <th class="py-3.5 px-6 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-stone-100 text-xs">
                    @forelse($users as $user)
                    <tr class="hover:bg-teal-50/20 transition duration-150">
                        <td class="py-4 px-6">
                            <div class="flex items-center gap-3">
                                <div class="w-8 h-8 rounded-lg bg-[#0B1220] flex items-center justify-center text-teal-400 font-mono font-bold shrink-0 text-xs">
                                    {{ strtoupper(substr($user->name, 0, 1)) }}
                                </div>
                                <span class="font-semibold text-stone-800">{{ $user->name }}</span>
                            </div>
                        </td>

                        <td class="py-4 px-4 text-stone-500 font-mono">
                            {{ $user->email }}
                        </td>

                        <td class="py-4 px-4 text-center">
                            <span class="inline-flex items-center px-2.5 py-1 rounded-full text-[11px] font-mono font-bold uppercase
                                {{ strtolower($user->role) === 'admin' ? 'bg-teal-50 text-teal-800 border border-teal-200' : 'bg-stone-100 text-stone-600 border border-stone-200' }}">
                                {{ $user->role }}
                            </span>
                        </td>

                        <td class="py-4 px-6">
                            <div class="flex items-center justify-center gap-2">
                                <a href="{{ route('users.edit', $user->id) }}"
                                   class="px-2.5 py-1.5 font-semibold text-blue-700 bg-blue-50 hover:bg-blue-100 border border-blue-200/80 rounded-lg transition">
                                    Edit
                                </a>

                                <form action="{{ route('users.destroy', $user->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus pengguna ini?')" class="inline-block">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="px-2.5 py-1.5 font-semibold text-rose-700 bg-rose-50 hover:bg-rose-100 border border-rose-200/80 rounded-lg transition">
                                        Hapus
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="py-14 text-center text-xs text-stone-400">
                            @if(request('search'))
                                Pengguna dengan kata kunci "<span class="font-semibold text-stone-600">{{ request('search') }}</span>" tidak ditemukan.
                            @else
                                Belum ada data pengguna.
                            @endif
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="p-4 border-t border-dashed border-stone-200">
            {{ $users->appends(request()->query())->links() }}
        </div>
    </div>
</div>
@endsection