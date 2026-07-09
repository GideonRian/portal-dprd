<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; // <-- WAJIB DITAMBAHKAN UNTUK CEK LOGIN

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/commands.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        
        // =========================================================
        // 1. LOGIKA UNTUK USER YANG *BELUM* LOGIN (Unauthenticated)
        // Jika mencoba akses halaman tertutup, lempar ke form login
        // =========================================================
        $middleware->redirectTo(function (Request $request) {
            
            // Anti-Bug untuk interaksi JavaScript / API
            if ($request->expectsJson()) {
                return null; 
            }

            // Pemisahan jalur yang presisi
            if ($request->is('superadmin*')) {
                return route('superadmin.login'); 
            }

            if ($request->is('sekretaris*')) {
                return route('sekretaris.login');
            }

            // Fallback default jika mengakses halaman lain
            return route('staff.login');
        });

       
        // 2. LOGIKA UNTUK USER YANG *SUDAH* LOGIN (Authenticated)
        // Jika iseng buka halaman login, lempar kembali ke dashboard
        $middleware->redirectUsersTo(function (Request $request) {
            if (Auth::check()) {
                $userRole = strtolower(Auth::user()->role ?? '');
                $userName = strtolower(Auth::user()->username ?? '');

                // Jika SuperAdmin belum lulus 2FA tapi mencoba membuka halaman login lagi,
                // maka kita HANCURKAN sesinya secara paksa agar bisa mengulang dari logijn.
                if (($userRole === 'superadmin' || $userName === 'superadmin') && session('2fa_verified') === false) {
                    Auth::logout();
                    $request->session()->invalidate();
                    $request->session()->regenerateToken();
                    
                    return route('superadmin.login');
                }
                // ---------------------------------------------------

                // Arahkan ke Dashboard masing-masing sesuai hak aksesnya
                if ($userRole === 'superadmin' || $userName === 'superadmin') {
                    return route('superadmin.dashboard');
                } elseif ($userRole === 'sekretaris') {
                    return route('sekretaris.dashboard');
                } elseif ($userRole === 'staff') {
                    return route('staff.dashboard');
                }
            }
            
            // Default jika entah bagaimana role tidak terbaca
            return '/'; 
        });
        
        // =========================================================
        // 3. DAFTAR MIDDLEWARE ALIAS
        // =========================================================
        $middleware->alias([
            'role' => \App\Http\Middleware\CheckRole::class,
            '2fa'  => \App\Http\Middleware\Ensure2FA::class,
        ]);

    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();