<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use App\Models\ActivityLog;
use Illuminate\Http\Request;

class ForensicController extends Controller
{
    /**
     * Menangani Tampilan Halaman Utama Digital Footprint / Forensik
     */
    public function index(Request $request)
    {
        $search = $request->input('search');

        // TAMBAHKAN query() DI SINI
        // 1. TAB: Aktivitas Mencurigakan
        $suspiciousActivities = ActivityLog::query()
            ->with('user')
            ->whereIn('status', ['warning', 'error'])
            ->when($search, function($query) use ($search) {
                $query->where('description', 'like', "%{$search}%");
            })
            ->latest()
            ->take(100) 
            ->get();

        // TAMBAHKAN query() DI SINI
        // 2. TAB: Data Changes (Audit Trail)
        $dataChanges = ActivityLog::query()
            ->with('user')
            ->where(function($query) {
                $query->whereNotNull('old_data')->orWhereNotNull('new_data');
            })
            ->when($search, function($query) use ($search) {
                $query->where('description', 'like', "%{$search}%")
                      ->orWhere('module', 'like', "%{$search}%");
            })
            ->latest()
            ->take(100)
            ->get();

        // TAMBAHKAN query() DI SINI
        // 3. TAB: Login History
        $loginHistory = ActivityLog::query()
            ->with('user')
            ->where('module', 'Autentikasi')
            ->when($search, function($query) use ($search) {
                $query->whereHas('user', function($q) use ($search) {
                    $q->where('username', 'like', "%{$search}%")
                      ->orWhere('name', 'like', "%{$search}%");
                });
            })
            ->latest()
            ->take(100)
            ->get();

        // TAMBAHKAN query() DI SINI JUGA
        // Hitung Widget Atas (Real-time)
        $highRisk = ActivityLog::query()->where('status', 'error')->count();
        $mediumRisk = ActivityLog::query()->where('status', 'warning')->count();
        $lowRisk = ActivityLog::query()->where('module', 'Autentikasi')->where('status', 'success')->count();

        return view('SuperAdmin.more.forensics', compact(
            'suspiciousActivities', 'dataChanges', 'loginHistory',
            'highRisk', 'mediumRisk', 'lowRisk'
        ));
    }
}