<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        // Mengambil semua data user agar daftarnya dinamis
        $users = User::latest()->get();
        $total_users = $users->count();

        return view('SuperAdmin.users.index', compact('users', 'total_users'));
    }

    public function store(Request $request)
    {
        // 1. Validasi Input sesuai Form Pop-up
        $request->validate([
            'username' => 'required|string|max:255|unique:users,username',
            'email'    => 'required|string|email|max:255|unique:users,email',
            'role'     => 'required|string',
            'password' => 'required|string|min:6',
        ], [
            // Custom pesan error bahasa Indonesia
            'username.unique' => 'Username ini sudah terdaftar!',
            'email.unique'    => 'Email ini sudah terdaftar!',
            'password.min'    => 'Password minimal harus 6 karakter!',
        ]);

        // 2. Simpan ke database (Tabel users yang terhubung ke Login Staff)
        User::create([
            'name'     => $request->username, // Wajib menggunakan 'name' sesuai permintaan database
            'username' => $request->username,
            'email'    => $request->email,
            'role'     => $request->role,
            'password' => Hash::make($request->password),
        ]);

        // 3. Kembali ke halaman dengan notifikasi sukses
        return redirect()->route('superadmin.users.index')->with('success', 'User baru berhasil didaftarkan!');
    }
}