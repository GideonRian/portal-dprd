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
            // Jika ada rute superadmin.login, Anda bisa menambahkannya di sini
            // if ($request->is('superadmin*')) { return redirect()->route('superadmin.login'); }
            
            return redirect()->route('staff.login');
        }

        // --- JALUR VIP: KUNCI MASTER ANTI-GAGAL ---
        $user = Auth::user();
        $userRole = strtolower($user->role ?? '');
        $userName = strtolower($user->username ?? '');
        $userNama = strtolower($user->nama ?? '');

        // Jika salah satu dari kolom role, username, atau nama berisi 'superadmin', LANGSUNG IZINKAN MASUK
        if ($userRole === 'superadmin' || $userName === 'superadmin' || $userNama === 'superadmin') {
            return $next($request);
        }

        // B. Sekretaris diizinkan masuk ke halaman Staff
        if (in_array($userRole, ['sekretaris', 'sekretariat']) && $request->is('staff*')) {
            return $next($request);
        }
        // ------------------------------------------

        // 2. Jika user sudah login, tetapi role-nya tidak sesuai dengan halaman yang diakses
        if (!in_array($user->role, $roles)) {
            
            // PENGUATAN: Kasus akun biasa mencoba menyusup ke area Superadmin
            if ($request->is('superadmin*')) {
                Auth::logout();
                $request->session()->invalidate();
                $request->session()->regenerateToken();

                return redirect()->route('staff.login')
                    ->with('error', 'Akses Ilegal! Anda tidak memiliki otoritas SuperAdmin. Sesi Anda telah diakhiri.');
            }

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
                    ->with('error', 'Akses dialihkan. Silakan login menggunakan akun Staff.');
            }

            // Fallback jika ada area lain yang tidak cocok
            abort(403, 'Anda tidak memiliki hak akses untuk halaman ini.');
        }

        return $next($request);
    }
}