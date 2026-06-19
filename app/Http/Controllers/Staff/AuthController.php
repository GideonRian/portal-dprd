<?php

namespace App\Http\Controllers\Staff;

use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\ActivityLog; 

class AuthController extends Controller
{
    public function index()
    {
        return view('Staff.login');
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

            // Proteksi A: Blokir jika nonaktif
            if (!$user->is_active) {
                ActivityLog::record('Autentikasi', 'BLOCKED_LOGIN', 'Login diblokir - akun Staff dinonaktifkan (Username: ' . $request->username . ')', 'warning');
                Auth::logout();
                return back()->withErrors([
                    'username' => 'Akun Anda telah dinonaktifkan oleh Super Admin.',
                ])->onlyInput('username');
            }

            // Proteksi B: Pastikan role staf
            $roleUser = strtolower($user->role);
            if (!in_array($roleUser, ['staff', 'staf'])) {
                ActivityLog::record('Autentikasi', 'UNAUTHORIZED_LOGIN', 'Akses ditolak - mencoba masuk ke panel Staff dengan role ' . $roleUser, 'warning');
                Auth::logout();
                return back()->withErrors([
                    'username' => 'Akses ditolak! Akun Anda tidak memiliki hak akses sebagai Staf.',
                ])->onlyInput('username');
            }

            $request->session()->regenerate();
            ActivityLog::record('Autentikasi', 'LOGIN', 'Staf berhasil masuk ke sistem.');

            return redirect()->route('staff.dashboard');
        }

        // CATAT JIKA GAGAL LOGIN
        ActivityLog::record('Autentikasi', 'FAILED_LOGIN', 'Login gagal - kredensial salah (Mencoba login sebagai Staff: ' . $request->username . ')', 'error');

        return back()->withErrors([
            'username' => 'Username atau password yang Anda masukkan salah.',
        ])->onlyInput('username');
    }

    public function editPassword()
    {
        return view('Staff.Password.edit');
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

        ActivityLog::record('Autentikasi', 'UPDATE_PASSWORD', 'Staff mengubah password akunnya.');

        return redirect()->route('staff.dashboard')->with('success', 'Password berhasil diperbarui!');
    }

    public function logout(Request $request)
    {
        ActivityLog::record('Autentikasi', 'LOGOUT', 'Staff keluar dari sistem.');

        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        
        return redirect()->route('staff.login');
    }
}