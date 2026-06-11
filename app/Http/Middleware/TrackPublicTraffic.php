<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Models\VisitLog;

class TrackPublicTraffic
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next): Response
    {
        // PERBAIKAN: Menggunakan expectsJson() (ada huruf 's')
        if ($request->isMethod('GET') && !$request->expectsJson() && !$request->ajax()) {
            VisitLog::create([
                'session_id' => $request->session()->getId(),
                'ip_address' => $request->ip() ?? '127.0.0.1',
                'path'       => $request->path(),
            ]);
        }

        return $next($request);
    }
}