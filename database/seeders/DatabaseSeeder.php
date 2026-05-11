<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Membuat akun Staf Default
        User::create([
            'name'     => 'Staf Sekretariat DPRD',
            'email'    => 'staff@dprd-tapsel.go.id',
            'username' => 'staffdprdtapsel',
            'password' => bcrypt('rahasia123'),
            'role'     => 'staff',
        ]);
    }
}