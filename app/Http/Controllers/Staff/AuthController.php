<?php

namespace App\Http\Controllers\Staff;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function index()
    {
        return view('Staff.login');
    }

    public function authenticate(Request $request)
    {
        $credentials = $request->validate([
            'username' => ['required'],
            'password' => ['required'],
        ]);

        // Simulasi Logika Otentikasi & Pembatasan Hak Akses
        /* if (Auth::attempt($credentials)) {
            $user = Auth::user();

            // Tolak akses jika yang login adalah Pimpinan / Anggota Dewan
            if (in_array($user->role, ['pimpinan', 'anggota_dewan'])) {
                Auth::logout();
                return back()->with('error', 'Akses ditolak. Panel ini khusus untuk Staf Sekretariat.');
            }

            // Jika role adalah Superadmin, arahkan ke verifikasi 2FA Google Authenticator
            if ($user->role === 'superadmin') {
                return redirect()->route('admin.2fa.verify');
            }

            // Jika Staf Sekretariat biasa (tanpa 2FA), langsung masuk
            $request->session()->regenerate();
            return redirect()->route('admin.dashboard');
        }
        */

        // Bypass sementara untuk keperluan testing UI (Hapus saat database sudah siap)
        return redirect()->route('admin.dashboard');
    }
}