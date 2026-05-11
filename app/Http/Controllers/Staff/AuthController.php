<?php

namespace App\Http\Controllers\Staff;
use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    /**
     * Menampilkan halaman login
     */
    public function index()
    {
        return view('Staff.login');
    }

    /**
     * Memproses otentikasi login staf
     */
    public function authenticate(Request $request)
    {
        $credentials = $request->validate([
            'username' => ['required'],
            'password' => ['required'],
        ]);

        // LOGIKA OTENTIKASI NYATA
        if (Auth::attempt($credentials)) {
            $user = Auth::user();

            // Proteksi: Hanya role 'staff' atau 'admin' yang bisa masuk panel ini
            // (Sesuaikan nama role dengan yang ada di database kamu)
            if (in_array($user->role, ['pimpinan', 'anggota_dewan'])) {
                Auth::logout();
                return back()->with('error', 'Akses ditolak. Panel ini khusus untuk Staf Sekretariat.');
            }

            $request->session()->regenerate();
            return redirect()->route('staff.dashboard');
        }

        return back()->withErrors([
            'username' => 'Username atau password yang Anda masukkan salah.',
        ])->onlyInput('username');
    }

    /**
     * Menampilkan halaman ganti password
     */
    public function editPassword()
    {
        return view('Staff.Password.edit');
    }

    /**
     * Memproses perubahan password
     */
    public function updatePassword(Request $request)
{
    $request->validate([
        'current_password' => 'required',
        'password' => 'required|min:8|confirmed',
    ]);

    // Ambil ID user yang sedang login
    $userId = Auth::id();
    
    // Ambil instance Model User berdasarkan ID agar bisa menggunakan method update()
    $user = User::find($userId);

    // Cek password lama
    if (!Hash::check($request->current_password, $user->password)) {
        return back()->withErrors(['current_password' => 'Password lama tidak sesuai.']);
    }

    // Update password
    $user->password = Hash::make($request->password);
    $user->save(); // Menggunakan save() lebih aman daripada update() jika terjadi masalah method

    return redirect()->route('staff.dashboard')->with('success', 'Password berhasil diperbarui!');
}

    /**
     * Proses Logout
     */
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('staff.login');
    }
}