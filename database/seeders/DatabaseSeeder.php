<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Membuat akun Staf Default
        User::create([
            'name'     => 'Staf Sekretariat DPRD',
            'email'    => 'staff@dprd-tapsel.go.id',
            'username' => 'staffdprdtapsel',
            'password' => bcrypt('bangke123'),
            'role'     => 'staff',
            'is_active'        => true,
        ]);

        // 2. Membuat akun Sekretaris Default
        User::create([
            'name'     => 'Sekretaris DPRD',
            'email'    => 'sekretaris@dprd-tapsel.go.id',
            'username' => 'sekretarisdprdtapsel',
            'password' => bcrypt('sekretaris123'),
            'role'     => 'sekretaris',
            'is_active'        => true,
        ]);

        // 3. PANGGIL SUPER ADMIN SEEDER DI SINI
        $this->call(SuperAdminSeeder::class);
    }
}