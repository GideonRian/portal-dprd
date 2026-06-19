<?php

namespace App\Http\Controllers\Sekretaris;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\ActivityLog;

class AuthController extends Controller
{
    public function index()
    {
        return view('Pimpinan-Sekretariat.login');
    }

    public function authenticate(Request $request)
    {
        $request->validate([
            'username' => ['required'],
            'password' => ['required'],
        ]);

        $loginType = filter_var($request->username, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';

        $credentials = [
            $loginType => $request->username,
            'password' => $request->password
        ];

        if (Auth::attempt($credentials)) {
            $user = User::find(Auth::id());
            $user->last_login_at = now();
            $user->save();

            // 1. PROTEKSI AKUN NONAKTIF
            if (!$user->is_active) {
                ActivityLog::record('Autentikasi', 'BLOCKED_LOGIN', 'Login diblokir - akun Sekretaris dinonaktifkan (Username: ' . $request->username . ')', 'warning');
                Auth::logout();
                return back()->withErrors([
                    'username' => 'Akun Anda telah dinonaktifkan oleh Super Admin.',
                ])->onlyInput('username');
            }

            // 2. Proteksi Role Sekretaris
            $roleUser = strtolower($user->role);
            if (!in_array($roleUser, ['sekretaris', 'sekretariat', 'pimpinan'])) {
                ActivityLog::record('Autentikasi', 'UNAUTHORIZED_LOGIN', 'Akses ditolak - mencoba masuk ke panel Sekretaris dengan role ' . $roleUser, 'warning');
                Auth::logout();
                return back()->with('error', 'Akses ditolak. Panel ini khusus untuk Pimpinan & Sekretariat.');
            }

            $request->session()->regenerate();
            ActivityLog::record('Autentikasi', 'LOGIN', 'Pimpinan / Sekretaris berhasil masuk ke sistem.');

            return redirect()->route('sekretaris.dashboard');
        }

        // CATAT JIKA GAGAL LOGIN
        ActivityLog::record('Autentikasi', 'FAILED_LOGIN', 'Login gagal - kredensial salah (Mencoba login sebagai Sekretaris: ' . $request->username . ')', 'error');

        return back()->withErrors([
            'username' => 'Username atau password yang Anda masukkan salah.',
        ])->onlyInput('username');
    }

    public function editPassword()
    {
        return view('Pimpinan-Sekretariat.Password.edit');
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'password' => 'required|min:8|confirmed',
        ]);

        $user = User::find(Auth::id());

        if (!Hash::check($request->current_password, $user->password)) {
            // CATAT JIKA GAGAL GANTI PASSWORD
            ActivityLog::record('Autentikasi', 'FAILED_CHANGE_PASSWORD', 'Gagal mengganti password - password lama tidak cocok.', 'error');
            return back()->withErrors(['current_password' => 'Password lama tidak sesuai.']);
        }

        $user->password = Hash::make($request->password);
        $user->save(); 

        ActivityLog::record('Autentikasi', 'UPDATE_PASSWORD', 'Pimpinan / Sekretaris mengubah password akunnya.');

        return redirect()->route('sekretaris.dashboard')->with('success', 'Password Anda berhasil diperbarui!');
    }

    public function logout(Request $request)
    {
        ActivityLog::record('Autentikasi', 'LOGOUT', 'Pimpinan / Sekretaris keluar dari sistem.');

        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        
        return redirect()->route('sekretaris.login');
    }
}