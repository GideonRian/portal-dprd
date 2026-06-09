<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class CheckRole
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        // 1. Jika user belum login sama sekali
        if (!Auth::check()) {
            if ($request->is('sekretaris*')) {
                return redirect()->route('sekretaris.login');
            }
            return redirect()->route('staff.login');
        }

        // 2. Jika user sudah login, tetapi role-nya tidak sesuai dengan halaman yang diakses
        if (!in_array(Auth::user()->role, $roles)) {
            
            // Kasus: Akun Staff (atau role lain) mencoba mengakses area Sekretaris
            if ($request->is('sekretaris*')) {
                Auth::logout();
                $request->session()->invalidate();
                $request->session()->regenerateToken();

                return redirect()->route('sekretaris.login')
                    ->with('error', 'Akses dialihkan. Silakan login menggunakan akun Sekretariat/Pimpinan.');
            }

            // Kasus: Akun Sekretaris mencoba mengakses area Staff
            if ($request->is('staff*')) {
                Auth::logout();
                $request->session()->invalidate();
                $request->session()->regenerateToken();

                return redirect()->route('staff.login')
                    ->with('error', 'Akses dialihkan. Silakan login menggunakan akun Staf.');
            }

            // Fallback jika ada area lain yang tidak cocok
            abort(403, 'Anda tidak memiliki hak akses untuk halaman ini.');
        }

        return $next($request);
    }
}