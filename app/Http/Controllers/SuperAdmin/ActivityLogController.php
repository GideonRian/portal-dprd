<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use App\Models\ActivityLog;
use Illuminate\Http\Request;

class ActivityLogController extends Controller
{
    public function index(Request $request)
    {
        $query = ActivityLog::with('user')->latest();

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

        // Fitur Filter Role
        if ($request->filled('role') && $request->role !== 'Semua Role') {
            $query->whereHas('user', function($q) use ($request) {
                $q->where('role', strtolower($request->role)); // Sesuaikan dengan nama kolom role di tabel users-mu
            });
        }

        $logs = $query->paginate(15)->withQueryString();

        return view('SuperAdmin.more.activity_logs', compact('logs'));
    }

    // Fungsi untuk tombol Export CSV
    public function exportCsv(Request $request)
    {
        $logs = ActivityLog::with('user')->latest()->get();
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