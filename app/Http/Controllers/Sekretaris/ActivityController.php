<?php

namespace App\Http\Controllers\Sekretaris;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ActivityLog;
use Carbon\Carbon;
use Barryvdh\DomPDF\Facade\Pdf; // <-- Pastikan Façade PDF di-import

class ActivityController extends Controller
{
    /**
     * Menampilkan Log Aktivitas di Halaman Web
     */
    public function index(Request $request)
    {
        $query = ActivityLog::with('user')->latest();

        // Filter Pencarian Teks
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

        // Filter Modul
        if ($request->filled('module')) {
            $query->where('module', $request->module);
        }

        // Filter Tipe Aksi
        if ($request->filled('action_type')) {
            $query->where('action', $request->action_type);
        }

        $logs = $query->paginate(10)->withQueryString();

        $stats = [
            'total_logs'  => ActivityLog::count(),
            'hari_ini'    => ActivityLog::whereDate('created_at', Carbon::today())->count(),
            'admin_aktif' => ActivityLog::whereDate('created_at', Carbon::today())->distinct('user_id')->count('user_id'),
            'filtered'    => $logs->total(),
        ];

        return view('Pimpinan-Sekretariat.activity', compact('stats', 'logs'));
    }

    /**
     * Mengekspor Log Aktivitas menjadi Dokumen PDF (Mendukung Filter)
     */
    public function exportReport(Request $request)
    {
        // Gunakan query dasar yang sama dengan halaman utama
        $query = ActivityLog::with('user')->latest();

        // Terapkan filter pencarian yang sama jika ada
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

        if ($request->filled('module')) {
            $query->where('module', $request->module);
        }

        if ($request->filled('action_type')) {
            $query->where('action', $request->action_type);
        }

        // Ambil semua log yang sesuai tanpa pagination agar laporan tercetak lengkap
        $logs = $query->get();

        // Memuat view khusus cetak PDF aktivitas
        $pdf = Pdf::loadView('Pimpinan-Sekretariat.activity-pdf', compact('logs'));
        
        // Set kertas ke A4 posisi Landscape (Mendatar) agar space kolom deskripsi luas
        $pdf->setPaper('A4', 'landscape');

        return $pdf->download('Laporan_Log_Aktivitas_Staf_' . date('d-M-Y') . '.pdf');
    }
}