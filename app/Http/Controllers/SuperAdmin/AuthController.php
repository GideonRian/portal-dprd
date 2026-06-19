<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\ActivityLog; // JANGAN LUPA IMPORT INI

class AuthController extends Controller
{
    public function showLoginForm()
    {
        if (Auth::check()) {
            return redirect()->route('superadmin.dashboard');
        }
        return view('SuperAdmin.auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ]);

        if (Auth::attempt(['username' => $request->username, 'password' => $request->password])) {
            return redirect()->route('superadmin.2fa.challenge');
        }

        // CATAT JIKA GAGAL TAHAP 1
        ActivityLog::record('Autentikasi', 'FAILED_LOGIN', 'Peringatan: Upaya login SuperAdmin gagal (Kredensial salah: ' . $request->username . ')', 'error');

        return back()->withErrors([
            'username' => 'Username atau password yang Anda masukkan salah.',
        ])->onlyInput('username');
    }

    public function show2faForm()
    {
        return view('SuperAdmin.auth.2fa_challenge');
    }

    public function verify2fa(Request $request)
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();

        // SKENARIO 1: KODE CADANGAN
        if ($request->filled('recovery_code')) {
            $inputCode = strtoupper(trim($request->recovery_code));
            $recoveryCodes = json_decode($user->recovery_codes, true) ?? [];

            if (in_array($inputCode, $recoveryCodes)) {
                $recoveryCodes = array_diff($recoveryCodes, [$inputCode]);
                $user->recovery_codes = json_encode(array_values($recoveryCodes));
                $user->save();

                ActivityLog::record('Autentikasi', 'LOGIN_2FA', 'SuperAdmin berhasil masuk menggunakan Kode Cadangan.');
                return redirect()->route('superadmin.dashboard');
            }
            
            // CATAT GAGAL KODE CADANGAN
            ActivityLog::record('Autentikasi', 'FAILED_2FA', 'Peringatan: SuperAdmin gagal memverifikasi Kode Cadangan.', 'error');
            return back()->withErrors(['recovery_code' => 'Kode Cadangan tidak valid atau sudah pernah digunakan.']);
        }

        // SKENARIO 2: GOOGLE AUTHENTICATOR
        if ($request->filled('otp')) {
            $otp = implode('', $request->otp);
            $google2fa = app('pragmarx.google2fa');
            
            if ($google2fa->verifyKey($user->google2fa_secret, $otp)) {
                ActivityLog::record('Autentikasi', 'LOGIN_2FA', 'SuperAdmin berhasil masuk menggunakan Google Authenticator.');
                return redirect()->route('superadmin.dashboard');
            }

            // CATAT GAGAL GOOGLE AUTHENTICATOR
            ActivityLog::record('Autentikasi', 'FAILED_2FA', 'Peringatan: SuperAdmin gagal memverifikasi kode Google Authenticator.', 'error');
            return back()->withErrors(['otp' => 'Kode 2FA tidak valid atau sudah kedaluwarsa.']);
        }

        return back()->withErrors(['otp' => 'Silakan masukkan kode verifikasi.']);
    }

    public function logout(Request $request)
    {
        ActivityLog::record('Autentikasi', 'LOGOUT', 'SuperAdmin keluar dari sistem.');

        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('superadmin.login');
    }

    public function editPassword()
    {
        return view('SuperAdmin.more.change_password');
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|min:8|confirmed',
        ], [
            'new_password.min' => 'Password baru minimal harus 8 karakter.',
            'new_password.confirmed' => 'Konfirmasi password baru tidak cocok.'
        ]);

        /** @var \App\Models\User $user */
        $user = Auth::user();

        if (!Hash::check($request->current_password, $user->password)) {
            // CATAT JIKA GAGAL GANTI PASSWORD
            ActivityLog::record('Autentikasi', 'FAILED_CHANGE_PASSWORD', 'Gagal mengganti password SuperAdmin - password lama tidak cocok.', 'error');
            return back()->withErrors(['current_password' => 'Password saat ini yang Anda masukkan salah.']);
        }

        $user->password = Hash::make($request->new_password);
        $user->save();

        ActivityLog::record('Autentikasi', 'UPDATE_PASSWORD', 'SuperAdmin berhasil mengubah password akunnya.');

        return back()->with('success', 'Password Anda berhasil diperbarui!');
    }
}