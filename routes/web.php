<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{
    ProductController, CategoryController, SupplierController, 
    ProfileController, DashboardController, TransactionController, 
    SettingsController, StockOpnameController, UserController, 
    ManagerController, ReportController
};

Route::redirect('/', '/login');

Route::middleware('auth')->group(function () {
    
    // --- Dashboard & Profile (Semua Role) ---
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    /**
     * --- HAK AKSES: ADMIN ---
     */
    Route::middleware('role:admin')->group(function () {
        // Supplier CRUD Penuh
        Route::delete('/suppliers/bulk-delete', [SupplierController::class, 'bulkDelete'])->name('suppliers.bulk-delete');
        Route::resource('suppliers', SupplierController::class);
        
        // CRUD Lainnya
        Route::delete('/categories/bulk-delete', [CategoryController::class, 'bulkDelete'])->name('categories.bulk-delete');
        Route::resource('categories', CategoryController::class)->except(['show']);
        Route::resource('products', ProductController::class)->except(['index', 'show']);
        Route::get('products/export', [ProductController::class, 'export'])->name('products.export');
        Route::post('products/import', [ProductController::class, 'import'])->name('products.import');
        Route::resource('/users', UserController::class);
        
        // Settings
        Route::get('/settings', [SettingsController::class, 'index'])->name('settings.index');
        Route::post('/settings', [SettingsController::class, 'update'])->name('settings.update');

        // --- DIUBAH: Stock Opname Admin sekarang READ-ONLY (bukan resource CRUD) ---
        Route::get('/stock-opname', [StockOpnameController::class, 'index'])->name('stock-opname.index');

        // Laporan Admin (URL: /reports/...)
        Route::prefix('reports')->name('reports.')->group(function () {
            Route::get('/stock', [ReportController::class, 'stock'])->name('stock');
            Route::get('/transactions', [ReportController::class, 'transactions'])->name('transactions');
            Route::get('/activities', [ReportController::class, 'activities'])->name('activities');
        });
    });

    /**
     * --- RUTE UMUM & TRANSAKSI (Bisa diakses staff/manajer) ---
     */
    Route::get('products', [ProductController::class, 'index'])->name('products.index');
    Route::get('products/{product}', [ProductController::class, 'show'])->name('products.show');
    
    Route::prefix('transactions')->name('transactions.')->group(function () {
        Route::post('/store', [TransactionController::class, 'store'])->name('store');
        Route::post('/confirm-direct/{id}', [TransactionController::class, 'confirmDirect'])->name('confirm.direct');
    });

    /**
     * --- RUTE STAFF ---
     */
    Route::middleware('role:Staff Gudang')->prefix('staff')->name('staff.')->group(function () {
        Route::get('/stock/incoming', [TransactionController::class, 'indexPending'])->name('stock.incoming');
        Route::get('/stock/outgoing', [TransactionController::class, 'indexPending'])->name('stock.outgoing');
        Route::get('/stock/create', [TransactionController::class, 'create'])->name('stock.create');
        Route::get('/stock/completed', [TransactionController::class, 'indexStaffCompleted'])->name('stock.completed');

        // --- BARU: Staff Gudang melaporkan selisih stok (stock opname) ---
        Route::get('/stock-opname', [StockOpnameController::class, 'index'])->name('stock-opname.index');
        Route::get('/stock-opname/create', [StockOpnameController::class, 'create'])->name('stock-opname.create');
        Route::post('/stock-opname', [StockOpnameController::class, 'store'])->name('stock-opname.store');
    });

    /**
     * --- RUTE MANAJER ---
     */
    Route::middleware('role:Manajer Gudang')->prefix('manager')->name('manager.')->group(function () {
        Route::get('/approve', [TransactionController::class, 'indexPending'])->name('pending');
        Route::post('/approve/{id}', [TransactionController::class, 'approve'])->name('approve');
        Route::post('/reject/{id}', [TransactionController::class, 'reject'])->name('reject');
        Route::get('/laporan', [TransactionController::class, 'indexLaporanSelesai'])->name('laporan');
        Route::get('/suppliers', [SupplierController::class, 'index'])->name('suppliers.index'); // Read-only view

        // Stock Opname Manajer: melihat pending + melakukan (approve/reject)
        Route::get('/stock-opname', [ManagerController::class, 'stockOpnames'])->name('stock-opname');
        Route::post('/stock-opname/approve/{id}', [ManagerController::class, 'approveOpname'])->name('stock-opname.approve');
        Route::post('/stock-opname/reject/{id}', [ManagerController::class, 'rejectOpname'])->name('stock-opname.reject'); // --- BARU

        Route::get('/reports/barang-masuk-keluar', [ReportController::class, 'stockFlow'])->name('reports.flow');
        
        // Laporan Manajer (URL: /manager/reports/...)
        Route::prefix('reports')->name('reports.')->group(function () {
            Route::get('/stock', [ReportController::class, 'stock'])->name('stock');
            Route::get('/transactions', [ReportController::class, 'transactions'])->name('transactions');
            Route::get('/activities', [ReportController::class, 'activities'])->name('activities');
        });
    });
});

require __DIR__.'/auth.php';