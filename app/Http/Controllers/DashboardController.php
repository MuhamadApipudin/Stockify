<?php

namespace App\Http\Controllers;

use App\Services\DashboardService;
use App\Repositories\DashboardRepository;
use Illuminate\Http\Request;
use App\Models\Transaction;
use App\Models\Activity;

class DashboardController extends Controller
{
    protected $dashboardService;
    protected $dashboardRepository;

    public function __construct(DashboardService $dashboardService, DashboardRepository $dashboardRepository)
    {
        $this->dashboardService = $dashboardService;
        $this->dashboardRepository = $dashboardRepository;
    }

    public function index()
    {
        $user = auth()->user();
        $role = strtolower($user->role ?? 'staff');

        // 1. LOGIKA DASHBOARD STAFF
        if (str_contains($role, 'staff')) {
            $pendingEntries = Transaction::where('type', 'masuk')
                                         ->where('status', 'pending')
                                         ->with('product')
                                         ->get();

            $pendingExits = Transaction::where('type', 'keluar')
                                       ->where('status', 'pending')
                                       ->with('product')
                                       ->get();

            return view('dashboard-staff', compact('pendingEntries', 'pendingExits'));
        }

        // 2. DATA UNTUK ADMIN & MANAJER
        $lowStockCount = $this->dashboardRepository->getLowStockCount();
        $transactionCounts = $this->dashboardRepository->getTransactionCounts();

        $data = [
            'total_products'      => $this->dashboardRepository->getProductCount(),
            'low_stock_count'     => $lowStockCount,
            'low_stock_products'  => $this->dashboardRepository->getLowStockProducts(),
            'transactions_in'     => $transactionCounts['masuk'] ?? 0,
            'transactions_out'    => $transactionCounts['keluar'] ?? 0,
            'stokMenipisCount'    => $lowStockCount,
            'barangMasukHariIni'  => $transactionCounts['masuk'] ?? 0,
            'barangKeluarHariIni' => $transactionCounts['keluar'] ?? 0,
            'latest_activities'   => $this->dashboardRepository->getLatestUserActivities(),
            'stock_data'          => $this->dashboardRepository->getStockChartData(),
            'trend_data'          => $this->getTrendData(), // --- BARU
            'activities'          => Activity::latest()->take(10)->get(),
            'success_shipments'   => Transaction::where('status', 'berhasil')->count(),
        ];

        // 3. LOGIKA DASHBOARD MANAJER
        if (str_contains($role, 'manager') || str_contains($role, 'manajer')) {
            return view('dashboard-manajer', $data);
        }

        // 4. DEFAULT: DASHBOARD ADMIN
        return view('dashboard', $data);
    }

    public function indexPending()
    {
        $transactions = Transaction::where('status', 'pending')
                    ->with('product')
                    ->latest()
                    ->get();

        return view('admin.transaksi.approve', compact('transactions'));
    }

    /**
     * Ambil data tren barang masuk/keluar 30 hari terakhir,
     * dikelompokkan per tanggal, TOTAL SEMUA PRODUK digabung.
     * Dipakai untuk grafik line chart di dashboard.
     */
    private function getTrendData()
{
    $firstTransaction = Transaction::where('status', 'berhasil')->oldest()->first();

    $startDate = $firstTransaction
        ? $firstTransaction->created_at->startOfDay()
        : now()->subDays(6)->startOfDay();

    $daysRange = now()->diffInDays($startDate);

    // Minimum 6 hari ke belakang, biar chart tetap punya beberapa titik
    // walau semua transaksi numpuk di hari yang sama
    $daysRange = max(6, min(29, $daysRange));

    $transactions = Transaction::where('status', 'berhasil')
        ->where('created_at', '>=', now()->subDays($daysRange)->startOfDay())
        ->get()
        ->groupBy(function ($item) {
            return $item->created_at->format('Y-m-d');
        });

    $trend = collect(range($daysRange, 0))->map(function ($daysAgo) use ($transactions) {
        $date = now()->subDays($daysAgo)->format('Y-m-d');
        $dayTransactions = $transactions->get($date, collect());

        return [
            'date'   => $date,
            'masuk'  => $dayTransactions->where('type', 'masuk')->count(),
            'keluar' => $dayTransactions->where('type', 'keluar')->count(),
        ];
    });

    return $trend->values();
}
}