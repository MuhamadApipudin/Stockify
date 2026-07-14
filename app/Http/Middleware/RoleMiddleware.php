<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        if (!$request->user()) {
            return redirect()->route('login');
        }

        // Ambil role dari DB, bersihkan spasi, dan kecilkan hurufnya
        $userRole = strtolower(trim($request->user()->role));
        
        // Bersihkan daftar role yang diizinkan (dari web.php)
        $allowedRoles = array_map(function($role) {
            return strtolower(trim($role));
        }, $roles);

        if (in_array($userRole, $allowedRoles)) {
            return $next($request);
        }

        // Gunakan abort 403 agar tidak terjadi loop refresh
        return abort(403, 'Anda tidak memiliki hak akses sebagai Manajer Gudang.');
    }
}