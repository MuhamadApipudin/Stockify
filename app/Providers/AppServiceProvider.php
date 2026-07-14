<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot()
{
    Paginator::useTailwind();
    \Illuminate\Support\Facades\View::composer('*', function ($view) {
        $view->with('app_settings', \App\Models\Setting::all());
    });
}
}


