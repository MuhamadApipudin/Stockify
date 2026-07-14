<?php

namespace App\Providers;

use App\Models\User; // Tambahkan ini
use Illuminate\Support\Facades\Gate; // Hapus tanda komentar (//) di depan ini
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        $this->registerPolicies();

        // Gate untuk membatasi akses Admin
        Gate::define('access-admin', function (User $user) {
            return $user->role === 'Admin';
        });
    }
}