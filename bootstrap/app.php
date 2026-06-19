<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Http\Request;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/commands.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        
        // LOGIKA PENGALIHAN DINAMIS YANG SUDAH DI-UPGRADE
        $middleware->redirectTo(function (Request $request) {
            
            // 1. Anti-Bug untuk interaksi JavaScript / API
            if ($request->expectsJson()) {
                return null; 
            }

            // 2. Pemisahan jalur yang presisi
            if ($request->is('superadmin*')) {
                // Pastikan nama route ini sesuai dengan yang ada di routes/web.php Anda
                return route('superadmin.login'); 
            }

            if ($request->is('sekretaris*')) {
                return route('sekretaris.login');
            }

            // Fallback default jika mengakses halaman lain
            return route('staff.login');
        });
        
        $middleware->alias([
            'role' => \App\Http\Middleware\CheckRole::class,
        ]);

    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();