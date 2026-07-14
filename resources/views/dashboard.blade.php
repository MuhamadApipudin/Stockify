@extends('example.layouts.default.dashboard')

@section('content')
<link rel="preconnect" href="https://fonts.googleapis.com">
<link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@500;600;700&family=Inter:wght@400;500;600;700&family=JetBrains+Mono:wght@400;500;600;700&display=swap" rel="stylesheet">

<style>
    .font-display { font-family: 'Space Grotesk', sans-serif; }
    .font-mono { font-family: 'JetBrains Mono', monospace; }
    .manifest-perforation {
        background-image: radial-gradient(circle, rgba(180,83,9,0.35) 1.5px, transparent 1.5px);
        background-size: 10px 2px;
        background-repeat: repeat-x;
        background-position: center;
    }
    .blueprint-grid {
        background-image:
            linear-gradient(rgba(255,255,255,0.04) 1px, transparent 1px),
            linear-gradient(90deg, rgba(255,255,255,0.04) 1px, transparent 1px);
        background-size: 28px 28px;
    }
    .bin-tag { font-family: 'JetBrains Mono', monospace; letter-spacing: 0.06em; }
</style>

<div class="px-4 py-6 space-y-6 max-w-[1600px] mx-auto font-[Inter]">

    {{-- ============ HERO MANIFEST HEADER ============ --}}
    <div class="relative overflow-hidden bg-[#0B1220] rounded-2xl shadow-sm text-white border border-black/20">
        <div class="absolute inset-0 blueprint-grid pointer-events-none"></div>
        <div class="absolute -right-16 -top-16 w-72 h-72 bg-teal-600/10 rounded-full blur-3xl pointer-events-none"></div>

        <div class="relative z-10 flex flex-col sm:flex-row sm:items-center justify-between gap-5 p-6">
            <div>
                <span class="inline-flex items-center gap-2 px-3 py-1 rounded-full text-[11px] font-mono font-semibold bg-white/5 text-teal-300 border border-teal-500/20 mb-3">
                    <span class="w-1.5 h-1.5 rounded-full bg-emerald-400 animate-pulse"></span>
                    SYSTEM&nbsp;·&nbsp;ONLINE
                </span>
                <h1 class="font-display text-2xl sm:text-3xl font-semibold tracking-tight text-white">Selamat Datang di Stockify</h1>
                <p class="text-sm text-slate-400 mt-1.5 max-w-md">Pantau pergerakan stok, analisis transaksi, dan aktivitas sistem kamu secara terpusat.</p>
            </div>

            <div class="shrink-0">
                <div class="bg-white/[0.04] border border-white/10 px-4 py-3 rounded-xl flex items-center gap-3">
                    <div class="p-2 bg-teal-500/10 text-teal-400 rounded-lg border border-teal-500/10">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                    </div>
                    <div>
                        <p class="text-[10px] uppercase font-mono font-semibold tracking-wider text-slate-500">Hak Akses</p>
                        <p class="text-xs font-mono font-bold text-white uppercase tracking-wide">{{ strtoupper(Auth::user()->role) }}</p>
                    </div>
                </div>
            </div>
        </div>

        {{-- perforated tear-off edge — the manifest signature --}}
        <div class="relative h-4 border-t border-dashed border-white/10 manifest-perforation"></div>
    </div>

    {{-- ============ STAT CARDS — "MANIFEST LINE ITEMS" ============ --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-5 gap-4">

        <div class="relative p-5 bg-white rounded-2xl border border-stone-200/70 shadow-[0_1px_2px_rgba(0,0,0,0.04)] hover:shadow-md hover:-translate-y-0.5 transition-all duration-200 group overflow-hidden">
            <div class="flex items-start justify-between">
                <div class="space-y-1.5">
                    <p class="bin-tag text-[10px] font-semibold text-stone-400">01 · SKU-TOTAL</p>
                    <h3 class="font-mono text-2xl font-bold text-[#0B1220] group-hover:text-teal-700 transition">{{ number_format($total_products ?? 0) }}</h3>
                    <p class="text-[11px] text-stone-400 font-medium">Total Produk</p>
                </div>
                <div class="p-2.5 bg-stone-50 text-stone-500 rounded-xl border border-stone-100 group-hover:border-teal-200 group-hover:text-teal-600 transition">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path></svg>
                </div>
            </div>
        </div>

        <div class="relative p-5 bg-white rounded-2xl border border-stone-200/70 shadow-[0_1px_2px_rgba(0,0,0,0.04)] hover:shadow-md hover:-translate-y-0.5 transition-all duration-200 group overflow-hidden">
            <div class="flex items-start justify-between">
                <div class="space-y-1.5">
                    <p class="bin-tag text-[10px] font-semibold text-stone-400">02 · IN-FLOW</p>
                    <h3 class="font-mono text-2xl font-bold text-emerald-700">{{ number_format($transactions_in ?? 0) }}</h3>
                    <p class="text-[11px] text-stone-400 font-medium">Barang Masuk</p>
                </div>
                <div class="p-2.5 bg-emerald-50 text-emerald-600 rounded-xl border border-emerald-100 group-hover:scale-105 transition">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"></path></svg>
                </div>
            </div>
        </div>

        <div class="relative p-5 bg-white rounded-2xl border border-stone-200/70 shadow-[0_1px_2px_rgba(0,0,0,0.04)] hover:shadow-md hover:-translate-y-0.5 transition-all duration-200 group overflow-hidden">
            <div class="flex items-start justify-between">
                <div class="space-y-1.5">
                    <p class="bin-tag text-[10px] font-semibold text-stone-400">03 · OUT-FLOW</p>
                    <h3 class="font-mono text-2xl font-bold text-rose-700">{{ number_format($transactions_out ?? 0) }}</h3>
                    <p class="text-[11px] text-stone-400 font-medium">Barang Keluar</p>
                </div>
                <div class="p-2.5 bg-rose-50 text-rose-600 rounded-xl border border-rose-100 group-hover:scale-105 transition">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path></svg>
                </div>
            </div>
        </div>

        <div class="relative p-5 bg-white rounded-2xl border border-stone-200/70 shadow-[0_1px_2px_rgba(0,0,0,0.04)] hover:shadow-md hover:-translate-y-0.5 transition-all duration-200 group overflow-hidden">
            <div class="flex items-start justify-between">
                <div class="space-y-1.5">
                    <p class="bin-tag text-[10px] font-semibold text-stone-400">04 · FULFILLED</p>
                    <h3 class="font-mono text-2xl font-bold text-teal-700">{{ number_format($success_shipments ?? 0) }}</h3>
                    <p class="text-[11px] text-stone-400 font-medium">Berhasil</p>
                </div>
                <div class="p-2.5 bg-teal-50 text-teal-600 rounded-xl border border-teal-100 group-hover:scale-105 transition">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                </div>
            </div>
        </div>

        <div class="relative p-5 bg-white rounded-2xl border border-stone-200/70 shadow-[0_1px_2px_rgba(0,0,0,0.04)] hover:shadow-md hover:-translate-y-0.5 transition-all duration-200 group overflow-hidden">
            <div class="flex items-start justify-between">
                <div class="space-y-1.5">
                    <p class="bin-tag text-[10px] font-semibold text-stone-400">05 · LOW-STOCK</p>
                    <h3 class="font-mono text-2xl font-bold text-red-600">{{ number_format($low_stock_count ?? 0) }}</h3>
                    <p class="text-[11px] text-stone-400 font-medium">Stok Tipis</p>
                </div>
                <div class="p-2.5 bg-red-50 text-red-500 rounded-xl border border-red-100 group-hover:scale-105 transition">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>
                </div>
            </div>
        </div>

    </div>

    {{-- ============ CHART + ACTIVITY ============ --}}
    <div class="grid grid-cols-1 lg:grid-cols-4 gap-6">

        <div class="lg:col-span-3 p-6 bg-white rounded-2xl border border-stone-200/70 shadow-[0_1px_2px_rgba(0,0,0,0.04)]">
            <div class="flex items-center justify-between mb-6 gap-4 flex-wrap">
                <div>
                    <h3 class="font-display text-base font-semibold text-[#0B1220]">Tren Masuk vs Keluar (30 Hari)</h3>
                    <p class="text-xs text-stone-400 mt-0.5">Total seluruh barang masuk dan keluar, semua kategori digabung</p>
                </div>
                <div class="flex items-center gap-4 text-xs font-medium">
                    <span class="flex items-center gap-1.5 text-stone-600 font-mono"><span class="w-2 h-2 rounded-full bg-teal-600"></span> BARANG MASUK</span>
                    <span class="flex items-center gap-1.5 text-stone-600 font-mono"><span class="w-2 h-2 rounded-full bg-rose-500"></span> BARANG KELUAR</span>
                </div>
            </div>
            <div class="relative w-full" style="height: 300px;">
                <canvas id="trendChart"></canvas>
            </div>
        </div>

        <div class="lg:col-span-1 p-6 bg-white rounded-2xl border border-stone-200/70 shadow-[0_1px_2px_rgba(0,0,0,0.04)] flex flex-col">
            <div class="flex items-center justify-between mb-4 pb-3 border-b border-dashed border-stone-200">
                <h3 class="font-display text-base font-semibold text-[#0B1220]">Aktivitas Terakhir</h3>
                <span class="px-2 py-0.5 text-[10px] font-mono font-semibold text-emerald-700 bg-emerald-50 border border-emerald-100 rounded-md">LIVE</span>
            </div>

            <div class="flex-1 overflow-y-auto max-h-[320px] pr-1 space-y-0.5">
                @forelse($activities ?? [] as $activity)
                    <div class="flex items-start gap-3 text-xs py-3 border-b border-dashed border-stone-100 last:border-0">
                        <div class="mt-0.5 p-1.5 bg-stone-50 text-teal-600 rounded-lg shrink-0 border border-stone-100">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        </div>
                        <div class="space-y-1 min-w-0">
                            <p class="text-stone-700 font-medium leading-snug break-words line-clamp-2">{{ $activity->description }}</p>
                            <span class="text-[10px] text-stone-400 font-mono">{{ $activity->created_at->diffForHumans() }}</span>
                        </div>
                    </div>
                @empty
                    <div class="py-12 text-center text-stone-400">
                        <svg class="w-8 h-8 mx-auto mb-2 text-stone-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"></path></svg>
                        <p class="text-xs italic font-mono">Belum ada aktivitas baru.</p>
                    </div>
                @endforelse
            </div>
        </div>

    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const ctx = document.getElementById('trendChart').getContext('2d');

        const trendData = @json($trend_data ?? []);

        if (trendData.length === 0) {
            ctx.font = "14px Inter, sans-serif";
            ctx.fillStyle = "#64748b";
            ctx.textAlign = "center";
            ctx.fillText("Tidak ada data tren untuk ditampilkan.", ctx.canvas.width/2, ctx.canvas.height/2);
        } else {

        const labels = trendData.map((item, idx) => {
            if (idx === trendData.length - 1) return 'SEKARANG';
            const interval = trendData.length <= 10 ? 1 : 7;
            if (idx % interval === 0) {
                const d = new Date(item.date);
                return d.getDate() + ' ' + d.toLocaleDateString('id-ID', { month: 'short' }).toUpperCase();
            }
            return '';
        });

        const gradientMasukFill = ctx.createLinearGradient(0, 0, 0, 300);
        gradientMasukFill.addColorStop(0, 'rgba(13, 148, 136, 0.15)');
        gradientMasukFill.addColorStop(1, 'rgba(13, 148, 136, 0)');

        const gradientKeluarFill = ctx.createLinearGradient(0, 0, 0, 300);
        gradientKeluarFill.addColorStop(0, 'rgba(244, 63, 94, 0.12)');
        gradientKeluarFill.addColorStop(1, 'rgba(244, 63, 94, 0)');

        const lineShadowPlugin = {
            id: 'lineShadow',
            beforeDatasetsDraw(chart) {
                const { ctx } = chart;
                ctx.save();
                ctx.shadowColor = 'rgba(15, 23, 42, 0.10)';
                ctx.shadowBlur = 6;
                ctx.shadowOffsetY = 3;
            },
            afterDatasetsDraw(chart) {
                chart.ctx.restore();
            }
        };

        new Chart(ctx, {
            type: 'line',
            data: {
                labels: labels,
                datasets: [
                    {
                        label: 'Barang Masuk',
                        data: trendData.map(item => item.masuk),
                        borderColor: '#0D9488',
                        backgroundColor: gradientMasukFill,
                        borderWidth: 3,
                        tension: 0.4,
                        fill: true,
                        pointRadius: 0,
                        pointHoverRadius: 6,
                        pointHoverBackgroundColor: '#0D9488',
                        pointHoverBorderColor: '#fff',
                        pointHoverBorderWidth: 2
                    },
                    {
                        label: 'Barang Keluar',
                        data: trendData.map(item => item.keluar),
                        borderColor: '#F43F5E',
                        backgroundColor: gradientKeluarFill,
                        borderWidth: 3,
                        tension: 0.4,
                        fill: true,
                        pointRadius: 0,
                        pointHoverRadius: 6,
                        pointHoverBackgroundColor: '#F43F5E',
                        pointHoverBorderColor: '#fff',
                        pointHoverBorderWidth: 2
                    }
                ]
            },
            plugins: [lineShadowPlugin],
            options: {
                responsive: true,
                maintainAspectRatio: false,
                interaction: { mode: 'index', intersect: false },
                plugins: {
                    legend: { display: false },
                    tooltip: {
                        backgroundColor: '#0B1220',
                        titleFont: { size: 12, weight: 'bold', family: 'JetBrains Mono, monospace' },
                        bodyFont: { size: 12, family: 'JetBrains Mono, monospace' },
                        padding: 12,
                        cornerRadius: 10,
                        displayColors: true,
                        usePointStyle: true,
                        callbacks: {
                            label: function(context) {
                                return `  ${context.dataset.label}: ${context.parsed.y.toLocaleString('id-ID')}`;
                            }
                        }
                    }
                },
                scales: {
                    x: {
                        grid: { display: false },
                        ticks: {
                            font: { size: 10, family: 'JetBrains Mono, monospace' },
                            color: '#a8a29e',
                            padding: 10,
                            autoSkip: false
                        },
                        border: { display: false }
                    },
                    y: {
                        grid: {
                            color: '#f5f5f4',
                            drawTicks: false
                        },
                        ticks: {
                            font: { size: 11, family: 'JetBrains Mono, monospace' },
                            color: '#a8a29e',
                            padding: 8,
                            callback: function(value) {
                                return value.toLocaleString('id-ID');
                            }
                        },
                        border: { display: false },
                        beginAtZero: true,
                        grace: '15%'
                    }
                },
                animation: {
                    duration: 1200,
                    easing: 'easeOutQuint'
                }
            }
        });

        }
    });
</script>
@endsection