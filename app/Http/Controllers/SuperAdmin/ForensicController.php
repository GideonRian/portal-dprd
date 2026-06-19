<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use App\Models\ActivityLog;
use Illuminate\Http\Request;

class ForensicController extends Controller
{
    public function index()
    {
        // 1. TAB: Aktivitas Mencurigakan (Hanya ambil status Warning & Error)
        $suspiciousActivities = ActivityLog::with('user')
            ->whereIn('status', ['warning', 'error'])
            ->latest()
            ->get();

        // 2. TAB: Data Changes (Hanya ambil log yang punya riwayat perubahan data)
        $dataChanges = ActivityLog::with('user')
            ->where(function($query) {
                $query->whereNotNull('old_data')->orWhereNotNull('new_data');
            })
            ->latest()
            ->get();

        // 3. TAB: Login History (Hanya ambil aktivitas dari modul Autentikasi)
        $loginHistory = ActivityLog::with('user')
            ->where('module', 'Autentikasi')
            ->latest()
            ->get();

        // Hitung Widget Atas
        $highRisk = ActivityLog::where('status', 'error')->count();
        $mediumRisk = ActivityLog::where('status', 'warning')->count();
        $lowRisk = ActivityLog::where('module', 'Autentikasi')->where('status', 'success')->count();

        return view('SuperAdmin.more.forensics', compact(
            'suspiciousActivities', 'dataChanges', 'loginHistory',
            'highRisk', 'mediumRisk', 'lowRisk'
        ));
    }
}