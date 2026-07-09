<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Ensure2FA
{
    public function handle(Request $request, Closure $next)
    {
        // Jika user sudah login, TAPI tanda 2FA-nya masih false...
        if (Auth::check() && session('2fa_verified') === false) {
            
            // Tendang dia kembali ke halaman input 2FA!
            // (Sesuaikan nama route ini dengan nama route halaman form 2FA Anda)
            return redirect()->route('superadmin.2fa.index')->with('error', 'Silakan selesaikan verifikasi 2FA terlebih dahulu.');
        }

        // Jika sudah lulus, biarkan lewat
        return $next($request);
    }
}