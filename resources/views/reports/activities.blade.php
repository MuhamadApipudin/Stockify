@extends('example.layouts.default.dashboard')

@section('content')
<link rel="preconnect" href="https://fonts.googleapis.com">
<link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@500;600;700&family=Inter:wght@400;500;600;700&family=JetBrains+Mono:wght@400;500;600;700&display=swap" rel="stylesheet">

<style>
    .font-display { font-family: 'Space Grotesk', sans-serif; }
    .font-mono { font-family: 'JetBrains Mono', monospace; }
</style>

<div class="p-6 space-y-6 max-w-[1200px] mx-auto font-[Inter]">

    <div class="flex items-center gap-3.5 pb-4 border-b border-dashed border-stone-200">
        <div class="p-2.5 bg-[#0B1220] text-teal-400 rounded-xl shrink-0">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
            </svg>
        </div>
        <div>
            <h1 class="font-display text-2xl font-semibold text-[#0B1220] tracking-tight">Log Aktivitas Pengguna</h1>
            <p class="text-xs text-stone-400 mt-1">Riwayat seluruh aktivitas yang tercatat di sistem, terurut dari yang terbaru.</p>
        </div>
    </div>

    <div class="bg-white border border-stone-200/70 rounded-2xl shadow-[0_1px_2px_rgba(0,0,0,0.04)] overflow-hidden">

        <div class="flex items-center justify-between px-6 py-4 border-b border-dashed border-stone-200 bg-stone-50/40">
            <h3 class="font-display text-sm font-semibold text-[#0B1220]">Riwayat Log</h3>
            <span class="px-2 py-0.5 text-[10px] font-mono font-semibold text-emerald-700 bg-emerald-50 border border-emerald-100 rounded-md">LIVE</span>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-stone-50/80 border-b border-stone-100 text-[10px] font-mono font-bold text-stone-400 uppercase tracking-wider">
                        <th class="py-3.5 px-6">Pengguna</th>
                        <th class="py-3.5 px-4">Aksi</th>
                        <th class="py-3.5 px-6 text-right">Waktu</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-stone-100 text-xs">
                    @forelse($activities as $activity)
                    <tr class="hover:bg-teal-50/20 transition duration-150">
                        <td class="py-4 px-6 whitespace-nowrap">
                            <div class="flex items-center gap-3">
                                <div class="w-8 h-8 rounded-lg bg-[#0B1220] flex items-center justify-center text-teal-400 font-mono font-bold shrink-0 text-xs">
                                    {{ strtoupper(substr($activity->user->name ?? 'S', 0, 1)) }}
                                </div>
                                <span class="font-semibold text-stone-800">{{ $activity->user->name ?? 'System' }}</span>
                            </div>
                        </td>

                        <td class="py-4 px-4 text-stone-600">
                            {{ $activity->description }}
                        </td>

                        <td class="py-4 px-6 text-right font-mono text-stone-400 whitespace-nowrap">
                            {{ $activity->created_at->diffForHumans() }}
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="3" class="py-14 text-center text-stone-400">
                            <div class="flex flex-col items-center justify-center">
                                <div class="w-12 h-12 rounded-2xl bg-stone-100 flex items-center justify-center mb-3">
                                    <svg class="w-6 h-6 text-stone-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                </div>
                                <span class="text-sm font-semibold text-stone-600">Belum ada aktivitas tercatat</span>
                                <span class="text-xs text-stone-400 mt-0.5 font-mono">Log akan muncul di sini saat ada aktivitas baru.</span>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="p-4 border-t border-dashed border-stone-200">
            {{ $activities->links() }}
        </div>
    </div>
</div>
@endsection