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
        ]);

        // 2. TAMBAHAN: Membuat akun Sekretaris Default
        User::create([
            'name'     => 'Sekretaris DPRD',
            'email'    => 'sekretaris@dprd-tapsel.go.id',
            'username' => 'sekretarisdprdtapsel',
            'password' => bcrypt('sekretaris123'), // Silakan ganti password-nya sesuai keinginan
            'role'     => 'sekretaris',
        ]);
    }
}