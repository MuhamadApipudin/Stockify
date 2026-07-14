<?php

namespace App\Services;

use App\Repositories\DashboardRepository;

class DashboardService
{
    protected $dashboardRepository;

    // Perbaikan dari __class menjadi __construct
    public function __construct(DashboardRepository $dashboardRepository)
    {
        $this->dashboardRepository = $dashboardRepository;
    }

    public function getAdminDashboardData(): array
    {
        $transactionCounts = $this->dashboardRepository->getTransactionCounts();

        return [
            'total_products'    => $this->dashboardRepository->getProductCount(),
            'transactions_in'   => $transactionCounts['masuk'],
            'transactions_out'  => $transactionCounts['keluar'],
            'latest_activities' => $this->dashboardRepository->getLatestUserActivities(),
            'stock_data'        => $this->dashboardRepository->getStockChartData(), // Diubah dari chart_data ke stock_data
        ];
    }
}