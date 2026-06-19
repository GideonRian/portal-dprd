<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Berita;
use App\Models\Agenda;
use App\Models\ActivityLog; // <-- 1. JANGAN LUPA IMPORT MODEL INI
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $data = [
            'total_user'      => User::where('username', '!=', 'superadmin')->count(),
            
            'active_sessions' => User::where('username', '!=', 'superadmin')
                                     ->where('is_active', true)
                                     ->count(), 
            
            'total_berita'    => Berita::count(),
            'total_agenda'    => Agenda::count(),
            'total_aspirasi'  => DB::table('aspirasis')->count(), 
            
            // ---> 2. INI TAMBAHANNYA: Menghitung log yang berstatus ERROR
            'security_alerts' => ActivityLog::where('status', 'error')->count(),

            'recent_activities' => ActivityLog::with('user')->latest()->take(5)->get(),
        ];

        return view('SuperAdmin.dashboard', $data);
    }
}