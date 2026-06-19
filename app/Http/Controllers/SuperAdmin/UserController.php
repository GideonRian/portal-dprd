<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    // =====================================================================
    // 1. Menampilkan Halaman Daftar User
    // =====================================================================
    public function index()
    {
        // Ambil semua data user KECUALI akun dengan username 'superadmin'
        $users = \App\Models\User::where('username', '!=', 'superadmin')
                    ->latest() 
                    ->get(); // (Ganti get() menjadi paginate(10) jika sebelumnya kamu memakai pagination)

        return view('SuperAdmin.users.index', compact('users'));
    }

    // =====================================================================
    // 2. Menyimpan User Baru (Tambah User)
    // =====================================================================
    public function store(Request $request)
    {
        // Validasi Input
        $request->validate([
            'username' => 'required|string|max:255|unique:users,username',
            'email'    => 'required|string|email|max:255|unique:users,email',
            // Menambahkan admin agar sesuai dengan opsi di tampilanmu
            'role'     => 'required|in:staff,sekretaris,admin', 
            'password' => 'required|string|min:6',
        ], [
            'username.unique' => 'Username ini sudah terdaftar!',
            'email.unique'    => 'Email ini sudah terdaftar!',
            'password.min'    => 'Password minimal harus 6 karakter!',
            'role.in'         => 'Role yang dipilih tidak valid!',
        ]);

        // Simpan ke database
        User::create([
            'name'     => $request->username, // Wajib menggunakan 'name' sesuai permintaan database
            'username' => $request->username,
            'email'    => $request->email,
            'role'     => $request->role,
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('superadmin.users.index')->with('success', 'User baru berhasil didaftarkan!');
    }

    // =====================================================================
    // 3. Memperbarui Informasi User (Edit User)
    // =====================================================================
    public function update(Request $request, User $user)
    {
        $request->validate([
            // Pengecualian unique id agar tidak error saat edit milik sendiri
            'username' => 'required|string|max:255|unique:users,username,' . $user->id,
            'email'    => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'role'     => 'required|in:staff,sekretaris,admin', 
        ]);

        $user->update([
            'name'     => $request->username, // Update name juga agar sinkron
            'username' => $request->username,
            'email'    => $request->email,
            'role'     => $request->role,
        ]);

        return back()->with('success', 'Data informasi user berhasil diperbarui!');
    }

    // =====================================================================
    // 4. Mereset Password User
    // =====================================================================
    public function resetPassword(Request $request, User $user)
    {
        $request->validate([
            // confirmed otomatis mencari input bernama password_confirmation
            'password' => 'required|string|min:6|confirmed', 
        ]);

        $user->update([
            'password' => Hash::make($request->password)
        ]);

        return back()->with('success', "Password untuk akun {$user->username} berhasil direset!");
    }

    // =====================================================================
    // 5. Menghapus User Permanen
    // =====================================================================
    public function destroy(User $user)
    {
        $user->delete();
        return back()->with('success', 'User berhasil dihapus secara permanen!');
    }

    // =====================================================================
    // 6. Mengubah Status Aktif/Nonaktif (Toggle Status)
    // =====================================================================
    public function toggleStatus(User $user)
    {
        $user->update([
            'is_active' => !$user->is_active // Membalikkan status (true jadi false, dst)
        ]);
        
        $status = $user->is_active ? 'diaktifkan' : 'dinonaktifkan';
        return back()->with('success', "Akun berhasil $status!");
    }
}