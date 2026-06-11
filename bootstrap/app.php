<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Http\Request; // <-- PASTIKAN IMPORT INI ADA DI ATAS

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/commands.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        
        // TAMBAHKAN LOGIKA PENGALIHAN DINAMIS DI SINI
        $middleware->redirectTo(function (Request $request) {
            if ($request->is('sekretaris*')) {
                return route('sekretaris.login');
            }
            return route('staff.login');
        });
        
        $middleware->alias([
            'role' => \App\Http\Middleware\CheckRole::class,
        ]);

    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();