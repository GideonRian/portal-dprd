<?php

namespace App\Http\Controllers\Sekretaris;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    // Menampilkan Halaman Login
    public function index()
    {
        return view('Pimpinan-Sekretariat.login');
    }

    // Memproses Data Login
    public function authenticate(Request $request)
    {
        $credentials = $request->validate([
            'username' => 'required',
            'password' => 'required'
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            
            // Redirect ke dashboard sekretaris setelah sukses login
            return redirect()->route('sekretaris.dashboard')->with('success', 'Selamat datang, Anda berhasil login!');
        }

        // Kembali ke halaman login jika gagal
        return back()->with('error', 'Username atau password salah!')->withInput();
    }

    // Memproses Logout
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('sekretaris.login')->with('success', 'Anda telah berhasil logout.');
    }
}