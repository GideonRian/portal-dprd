<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Berita;
use App\Models\Agenda;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        // Mengambil data ringkasan untuk ditampilkan di widget dashboard
        $data = [
            'total_user'     => User::count(),
            'total_berita'   => Berita::count(),
            'total_agenda'   => Agenda::count(),
            // Sesuaikan dengan nama tabel aspirasi milikmu jika berbeda
            'total_aspirasi' => DB::table('aspirasis')->count(), 
        ];

        // Memanggil tampilan dashboard.blade.php yang ada di folder resources/views/SuperAdmin/
        return view('SuperAdmin.dashboard', $data);
    }
}
