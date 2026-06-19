<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class SuperAdminSeeder extends Seeder
{
    public function run()
    {
        // Memanggil mesin Google2FA
        $google2fa = app('pragmarx.google2fa');

        // Membuat akun SuperAdmin
        User::create([
            'name' => 'Tim IT DPRD',
            'username' => 'superadmin', // Sesuai dengan form login kamu
            'email' => 'superadmin@dprd-tapsel.go.id',
            'password' => Hash::make('admin123'),
            'role'             => 'superadmin',
            'is_active'        => true,
            // Generate kunci rahasia unik saat akun dibuat!
            'google2fa_secret' => $google2fa->generateSecretKey(),
        ]);

        $this->command->info('Akun SuperAdmin berhasil dibuat dengan 2FA Secret!');
    }
}
