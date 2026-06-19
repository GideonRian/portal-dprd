<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use App\Models\ActivityLog;
use Illuminate\Http\Request;

class ActivityLogController extends Controller
{
    public function index(Request $request)
    {
        // PERUBAHAN DI SINI: Tambahkan query() dan filter whereNull
        $query = ActivityLog::query()
            ->with('user')
            ->whereNull('old_data')
            ->whereNull('new_data')
            ->latest();

        // Fitur Pencarian
        if ($request->filled('search')) {
            $query->where(function($q) use ($request) {
                $q->where('description', 'like', '%' . $request->search . '%')
                  ->orWhere('action', 'like', '%' . $request->search . '%')
                  ->orWhereHas('user', function($userQuery) use ($request) {
                      $userQuery->where('username', 'like', '%' . $request->search . '%');
                  });
            });
        }

        // Fitur Filter Status
        if ($request->filled('status') && $request->status !== 'Semua Status') {
            $query->where('status', strtolower($request->status));
        }

        // ========================================================
        // Fitur Filter Role (Diperbarui agar bisa membaca System Error)
        // ========================================================
        if ($request->filled('role') && $request->role !== 'Semua Role') {
            $roleName = $request->role; // Ambil teks asli dari dropdown, misal: 'Staff' atau 'Sekretaris'

            $query->where(function($q) use ($roleName) {
                // 1. Cari berdasarkan Role asli User yang login
                $q->whereHas('user', function($userQuery) use ($roleName) {
                    $userQuery->where('role', strtolower($roleName)); 
                })
                // 2. ATAU cari kata peran tersebut di dalam deskripsi khusus untuk log 'System' (gagal login)
                ->orWhere(function($subQ) use ($roleName) {
                    $subQ->whereNull('user_id')
                         ->where('description', 'LIKE', '%' . $roleName . '%');
                });
            });
        }
        // ========================================================

        $logs = $query->paginate(15)->withQueryString();

        return view('SuperAdmin.more.activity_logs', compact('logs'));
    }

    // Fungsi untuk tombol Export CSV
    public function exportCsv(Request $request)
    {
        // PERUBAHAN DI SINI: Pastikan data CSV juga bersih dari log Audit (old_data/new_data)
        $logs = ActivityLog::query()
            ->with('user')
            ->whereNull('old_data')
            ->whereNull('new_data')
            ->latest()
            ->get();
            
        $filename = "activity_logs_" . date('Y-m-d_H-i') . ".csv";
        
        $handle = fopen('php://memory', 'w');
        fputcsv($handle, ['Waktu', 'User', 'Role', 'Action', 'Deskripsi', 'Status', 'IP Address']);

        foreach ($logs as $log) {
            fputcsv($handle, [
                $log->created_at->format('Y-m-d H:i:s'),
                $log->user ? $log->user->username : 'System',
                $log->user ? $log->user->role : '-',
                $log->action,
                $log->description,
                strtoupper($log->status),
                $log->ip_address
            ]);
        }

        fseek($handle, 0);
        
        return response()->stream(
            function () use ($handle) { fpassthru($handle); },
            200,
            [
                'Content-Type' => 'text/csv',
                'Content-Disposition' => 'attachment; filename="' . $filename . '"',
            ]
        );
    }
}