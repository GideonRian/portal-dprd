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
    /**
     * 1. Menampilkan halaman login Sekretaris
     */
    public function index()
    {
        return view('Pimpinan-Sekretariat.login');
    }

    /**
     * 2. Memproses otentikasi login Sekretaris
     */
    public function authenticate(Request $request)
    {
        $credentials = $request->validate([
            'username' => ['required'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            $user = Auth::user();

            // Proteksi: Hanya role 'sekretaris' yang bisa masuk panel ini
            if ($user->role !== 'sekretaris') {
                Auth::logout();
                return back()->with('error', 'Akses ditolak. Panel ini khusus untuk Pimpinan Sekretariat.');
            }

            $request->session()->regenerate();

            // Catat aktivitas Login
            ActivityLog::record('Autentikasi', 'Login', 'Pimpinan / Sekretaris berhasil masuk ke sistem.');

            return redirect()->route('sekretaris.dashboard');
        }

        return back()->withErrors([
            'username' => 'Username atau password yang Anda masukkan salah.',
        ])->onlyInput('username');
    }

    /**
     * 3. Menampilkan halaman ganti password Sekretaris
     */
    public function editPassword()
    {
        return view('Pimpinan-Sekretariat.Password.edit');
    }

    /**
     * 4. Memproses perubahan password Sekretaris
     */
    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'password' => 'required|min:8|confirmed',
        ]);

        $userId = Auth::id();
        $user = User::find($userId);

        if (!Hash::check($request->current_password, $user->password)) {
            return back()->withErrors(['current_password' => 'Password lama tidak sesuai.']);
        }

        $user->password = Hash::make($request->password);
        $user->save(); 

        ActivityLog::record('Autentikasi', 'Update', 'Pimpinan / Sekretaris mengubah password akunnya.');

        return redirect()->route('sekretaris.dashboard')->with('success', 'Password Anda berhasil diperbarui!');
    }

    /**
     * 5. Proses Logout Sekretaris
     */
    public function logout(Request $request)
    {
        // Catat aktivitas Logout SEBELUM sesi dihancurkan
        ActivityLog::record('Autentikasi', 'Logout', 'Pimpinan / Sekretaris keluar dari sistem.');

        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        
        return redirect()->route('sekretaris.login');
    }
}