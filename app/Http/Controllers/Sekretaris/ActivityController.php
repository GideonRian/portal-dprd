<?php

namespace App\Http\Controllers\Sekretaris;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ActivityLog;
use Carbon\Carbon;

class ActivityController extends Controller
{
    public function index(Request $request)
    {
        // Mulai query dengan memanggil relasi 'user'
        $query = ActivityLog::with('user')->latest();

        // 1. Filter Pencarian Teks
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('description', 'like', "%{$search}%")
                  ->orWhere('action', 'like', "%{$search}%")
                  ->orWhereHas('user', function($userQuery) use ($search) {
                      $userQuery->where('name', 'like', "%{$search}%")
                                ->orWhere('username', 'like', "%{$search}%");
                  });
            });
        }

        // 2. Filter Modul
        if ($request->filled('module')) {
            $query->where('module', $request->module);
        }

        // 3. Filter Action Type
        if ($request->filled('action_type')) {
            $query->where('action', $request->action_type);
        }

        // Ambil data dengan Pagination (10 baris per halaman)
        $logs = $query->paginate(10)->withQueryString();

        // Kalkulasi Statistik Dinamis
        $stats = [
            'total_logs'  => ActivityLog::count(),
            'hari_ini'    => ActivityLog::whereDate('created_at', Carbon::today())->count(),
            'admin_aktif' => ActivityLog::whereDate('created_at', Carbon::today())->distinct('user_id')->count('user_id'),
            'filtered'    => $logs->total(),
        ];

        return view('Pimpinan-Sekretariat.activity', compact('stats', 'logs'));
    }
}