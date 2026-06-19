<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

// ==========================================
// IMPORT MODELS
// ==========================================
use App\Models\Agenda;
use App\Models\Anggota;
use App\Models\Berita;
use App\Models\Dokumen;

// ==========================================
// IMPORT CONTROLLERS (FRONTEND / NON-USER)
// ==========================================
use App\Http\Controllers\Frontend\PublicHomeController;
use App\Http\Controllers\Frontend\AspirasiController;
use App\Http\Controllers\Frontend\BeritaController as FrontBeritaController;

// ==========================================
// IMPORT CONTROLLERS (BACKEND / STAFF)
// ==========================================
use App\Http\Controllers\Staff\AgendaController;
use App\Http\Controllers\Staff\AnggotaController;
use App\Http\Controllers\Staff\AuthController;
use App\Http\Controllers\Staff\BeritaController as StaffBeritaController;
use App\Http\Controllers\Staff\DashboardController;
use App\Http\Controllers\Staff\DokumenController;

// ==========================================
// IMPORT CONTROLLERS (BACKEND / SEKRETARIS)
// ==========================================
use App\Http\Controllers\Sekretaris\DashboardController as SekretarisDashboardController;
use App\Http\Controllers\Sekretaris\ActivityController;
use App\Http\Controllers\Sekretaris\AuthController as SekretarisAuthController;
use App\Http\Controllers\Sekretaris\ApprovalController;
use App\Http\Controllers\Sekretaris\StatsController;
use App\Http\Controllers\Sekretaris\ReportController;

/*
|--------------------------------------------------------------------------
| FRONTEND / NON-USER ROUTES (Area Publik)
|--------------------------------------------------------------------------
*/

// Bungkus area publik dengan middleware pelacak lalu lintas
Route::middleware([\App\Http\Middleware\TrackPublicTraffic::class])->group(function () {

    // --- Beranda ---
    Route::get('/', [PublicHomeController::class, 'index'])->name('home');

    // --- Halaman Statis & Profil ---
    Route::get('/tentang-dprd', function () {
        return view('Non-Users.tentang');
    })->name('tentang');

    Route::get('/kontak', function () {
        return view('Non-Users.kontak');
    })->name('kontak');

    Route::get('/profil-anggota', function (Illuminate\Http\Request $request) {
        $search = $request->input('search');
        $komisi = $request->input('komisi');
        $badan = $request->input('badan');

        $query = App\Models\Anggota::query();

        if ($search) {
            $query->where(function($q) use ($search) {
                $q->where('nama', 'like', "%{$search}%")
                  ->orWhere('jabatan', 'like', "%{$search}%")
                  ->orWhere('dapil', 'like', "%{$search}%");
            });
        }

        if ($komisi) {
            $query->where('komisi', $komisi);
        }

        if ($badan) {
            $query->where('badan', $badan);
        }

        $anggotas = $query->orderByRaw("CASE 
                WHEN jabatan LIKE '%Ketua%' AND jabatan NOT LIKE '%Wakil%' THEN 1 
                WHEN jabatan LIKE '%Wakil Ketua%' THEN 2 
                ELSE 3 END")
            ->orderBy('nama', 'asc')
            ->get();

        $list_komisi = App\Models\Anggota::whereNotNull('komisi')->distinct()->pluck('komisi');
        $list_badan = App\Models\Anggota::whereNotNull('badan')->distinct()->pluck('badan');

        return view('Non-Users.profil-anggota', compact('anggotas', 'list_komisi', 'list_badan'));
    })->name('profil.anggota');

    Route::get('/profil-anggota/{id}/detail', function ($id) {
        return response()->json(App\Models\Anggota::findOrFail($id));
    })->name('profil.anggota.detail');


    // --- Pusat Dokumen ---
    Route::get('/pusat-dokumen', function () {
        $dokumens = Dokumen::where('status_persetujuan', 'Approved')->latest()->get();
        return view('Non-Users.pusat-dokumen', compact('dokumens'));
    })->name('pusat.dokumen');


    // --- Agenda Publik ---
    Route::get('/agenda-kegiatan', function (Request $request) {
        Agenda::where('status', 'Akan Datang')
            ->where('tanggal', '<', now()->toDateString())
            ->update(['status' => 'Selesai']);

        $query = Agenda::latest('tanggal');

        if ($request->filled('search')) {
            $query->where('judul', 'like', '%' . $request->search . '%');
        }

        if ($request->filled('kategori') && $request->kategori !== '') {
            $query->where('kategori', $request->kategori);
        }

        if ($request->filled('bulan') && $request->bulan !== '') {
            $query->whereMonth('tanggal', $request->bulan);
        }

        $agendas = $query->get();
        return view('Non-Users.agenda', compact('agendas'));
    })->name('publik.agenda');

    Route::get('/agenda-kegiatan/{id}', function ($id) {
        $agenda = Agenda::findOrFail($id);
        $related = Agenda::where('id', '!=', $id)->limit(3)->latest()->get();
        
        return view('Non-Users.agenda-detail', compact('agenda', 'related'));
    })->name('publik.agenda.detail');


    // --- Berita Publik ---
    Route::get('/berita', [FrontBeritaController::class, 'index'])->name('berita');
    Route::get('/berita/{slug}', [FrontBeritaController::class, 'show'])->name('berita.detail');
    Route::post('/berita/{id}/like', [FrontBeritaController::class, 'like'])->name('berita.like');


    // --- Layanan Aspirasi ---
    Route::get('/layanan-aspirasi', [AspirasiController::class, 'index'])->name('layanan.aspirasi');
    Route::post('/layanan-aspirasi/kirim-otp', [AspirasiController::class, 'prosesFormLaporan'])->name('aspirasi.kirim');
    Route::get('/layanan-aspirasi/verifikasi', [AspirasiController::class, 'showOtpPage'])->name('aspirasi.otp');
    Route::post('/layanan-aspirasi/verifikasi', [AspirasiController::class, 'verifyOtp'])->name('aspirasi.otp.verify');
    Route::get('/layanan-aspirasi/lacak', [AspirasiController::class, 'lacakIndex'])->name('layanan.aspirasi.lacak');
    Route::get('/layanan-aspirasi/lacak/cari', [AspirasiController::class, 'cariAspirasi'])->name('aspirasi.lacak.cari');
    Route::post('/layanan-aspirasi/lacak/{id}/rating', [\App\Http\Controllers\Frontend\AspirasiController::class, 'submitRating'])->name('aspirasi.lacak.rating');

});

// --- Rute Penunjuk Jalan Default Laravel ---
Route::get('/login', function () {
    return redirect()->route('staff.login');
})->name('login');


/*
|--------------------------------------------------------------------------
| BACKEND / STAFF ROUTES (Area Admin)
|--------------------------------------------------------------------------
*/
Route::prefix('staff')->name('staff.')->group(function () {
    
    Route::get('/', function () {
        if (Auth::check()) {
            return Auth::user()->role === 'staff' 
                ? redirect()->route('staff.dashboard') 
                : redirect()->route('sekretaris.dashboard');
        }
        return redirect()->route('staff.login');
    });

    // 1. RUTE GUEST
    Route::middleware('guest')->group(function () {
        Route::get('/login', [AuthController::class, 'index'])->name('login');
        Route::post('/login', [AuthController::class, 'authenticate'])->name('login.process');
    });

    // 2. RUTE TERLINDUNGI
    Route::middleware(['auth', 'role:staff,sekretaris'])->group(function () {
        
        Route::get('/ganti-password', [AuthController::class, 'editPassword'])->name('password.edit');
        Route::put('/ganti-password', [AuthController::class, 'updatePassword'])->name('password.update');
        Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
        Route::resource('/anggota', AnggotaController::class)->names('anggota');
        Route::resource('/dokumen', DokumenController::class)->names('dokumen');
        Route::resource('/agenda', AgendaController::class)->names('agenda');

        Route::resource('/berita', StaffBeritaController::class)->names('berita');
        Route::patch('/berita/{id}/toggle-featured', [StaffBeritaController::class, 'toggleFeatured'])->name('berita.toggle_featured');
        
        Route::get('/aspirasi', [\App\Http\Controllers\Staff\AspirasiController::class, 'index'])->name('aspirasi.index');
        Route::get('/aspirasi/{id}', [\App\Http\Controllers\Staff\AspirasiController::class, 'show'])->name('aspirasi.show');
        Route::put('/aspirasi/{id}/update', [\App\Http\Controllers\Staff\AspirasiController::class, 'update'])->name('aspirasi.update');
    });
});


/*
|--------------------------------------------------------------------------
| BACKEND / SEKRETARIS ROUTES (Area Sekretariat)
|--------------------------------------------------------------------------
*/
Route::prefix('sekretaris')->name('sekretaris.')->group(function () {
    
    // 1. GERBANG UTAMA
    Route::get('/', function () {
        if (Auth::check()) {
            $userRole = strtolower(Auth::user()->role ?? '');
            $userName = strtolower(Auth::user()->username ?? '');

            if ($userRole === 'sekretaris' || $userRole === 'superadmin' || $userName === 'superadmin') {
                return redirect()->route('sekretaris.dashboard');
            }
            
            return redirect()->route('staff.dashboard');
        }
        return redirect()->route('sekretaris.login');
    });

    // 2. RUTE GUEST
    Route::middleware('guest')->group(function () {
        Route::get('/login', [SekretarisAuthController::class, 'index'])->name('login');
        Route::post('/login', [SekretarisAuthController::class, 'authenticate'])->name('login.process');
    });

    // 3. RUTE TERLINDUNGI
    Route::middleware(['auth', 'role:sekretaris'])->group(function () {
        
        Route::post('/logout', [SekretarisAuthController::class, 'logout'])->name('logout');
        Route::get('/ganti-password', [SekretarisAuthController::class, 'editPassword'])->name('password.edit');
        Route::put('/ganti-password', [SekretarisAuthController::class, 'updatePassword'])->name('password.update');

        Route::get('/dashboard', [SekretarisDashboardController::class, 'index'])->name('dashboard');
        Route::get('/activity', [ActivityController::class, 'index'])->name('activity');
        Route::get('/activity/export', [ActivityController::class, 'exportReport'])->name('activity.export');
        Route::get('/approval', [ApprovalController::class, 'index'])->name('approval');
        Route::post('/approval/{id}/approve', [ApprovalController::class, 'approve'])->name('approval.approve');
        Route::post('/approval/{id}/reject', [ApprovalController::class, 'reject'])->name('approval.reject');
        Route::get('/stats', [StatsController::class, 'index'])->name('stats');
        Route::get('/stats/export', [StatsController::class, 'exportReport'])->name('stats.export');
        Route::get('/reports', [ReportController::class, 'index'])->name('reports');
        Route::post('/reports/generate', [ReportController::class, 'generate'])->name('reports.generate');
        Route::get('/reports/download/{fileName}', [ReportController::class, 'downloadRecent'])->name('reports.download');
    });
});


/*
|--------------------------------------------------------------------------
| BACKEND / SuperAdmin (Area Super Admin)
|--------------------------------------------------------------------------
*/
Route::prefix('superadmin')->name('superadmin.')->group(function () {
    
    // ==========================================
    // 1. GERBANG UTAMA & GUEST (Tidak perlu login)
    // ==========================================
    Route::get('/', function () {
        if (Auth::check()) {
            $userRole = strtolower(Auth::user()->role ?? '');
            $userName = strtolower(Auth::user()->username ?? '');

            if ($userRole === 'superadmin' || $userName === 'superadmin') {
                return redirect()->route('superadmin.dashboard');
            }
            return redirect()->route('staff.dashboard');
        }
        return redirect()->route('superadmin.login');
    });

    Route::middleware('guest')->group(function () {
        Route::get('/login', [\App\Http\Controllers\SuperAdmin\AuthController::class, 'showLoginForm'])->name('login');
        Route::post('/login', [\App\Http\Controllers\SuperAdmin\AuthController::class, 'login'])->name('login.submit');
    });

    // ==========================================
    // 2. RUTE TERLINDUNGI (Wajib Login & Wajib SuperAdmin)
    // ==========================================
    // PERBAIKAN: Middleware 'role:superadmin' ditambahkan di sini!
    Route::middleware(['auth', 'role:superadmin'])->group(function () {
        
        // Verifikasi 2FA Challenge & Proses Logout
        Route::get('/2fa-challenge', [\App\Http\Controllers\SuperAdmin\AuthController::class, 'show2faForm'])->name('2fa.challenge');
        Route::post('/2fa-challenge', [\App\Http\Controllers\SuperAdmin\AuthController::class, 'verify2fa'])->name('2fa.verify');
        Route::post('/logout', [\App\Http\Controllers\SuperAdmin\AuthController::class, 'logout'])->name('logout');
        
        // Dashboard
        Route::get('/dashboard', [\App\Http\Controllers\SuperAdmin\DashboardController::class, 'index'])->name('dashboard');

        // Pengaturan
        Route::get('/pengaturan', [\App\Http\Controllers\SuperAdmin\SettingController::class, 'index'])->name('pengaturan');
        Route::put('/pengaturan/update', [\App\Http\Controllers\SuperAdmin\SettingController::class, 'update'])->name('pengaturan.update');

        // Manajemen 2FA
        Route::get('/2fa', [\App\Http\Controllers\SuperAdmin\TwoFactorController::class, 'index'])->name('2fa.index');
        Route::post('/2fa/generate-recovery', [\App\Http\Controllers\SuperAdmin\TwoFactorController::class, 'generateRecoveryCodes'])->name('2fa.generate_recovery');

        // Activity Logs & Forensics
        Route::get('/activity-logs', [\App\Http\Controllers\SuperAdmin\ActivityLogController::class, 'index'])->name('activity-logs.index');
        Route::get('/digital-footprint', [\App\Http\Controllers\SuperAdmin\ForensicController::class, 'index'])->name('digital-footprint.index');
        Route::get('/activity-logs/export', [\App\Http\Controllers\SuperAdmin\ActivityLogController::class, 'exportCsv'])->name('activity-logs.export');

        // Manajemen Users
        Route::patch('/users/{user}/toggle-status', [\App\Http\Controllers\SuperAdmin\UserController::class, 'toggleStatus'])->name('users.toggle-status');
        Route::put('/users/{user}/reset-password', [\App\Http\Controllers\SuperAdmin\UserController::class, 'resetPassword'])->name('users.reset-password');
        Route::resource('/users', \App\Http\Controllers\SuperAdmin\UserController::class)->names('users');

        // Ganti Password SuperAdmin
        Route::get('/ganti-password', [\App\Http\Controllers\SuperAdmin\AuthController::class, 'editPassword'])->name('password.edit');
        Route::put('/ganti-password', [\App\Http\Controllers\SuperAdmin\AuthController::class, 'updatePassword'])->name('password.update');

        // Fitur Double Switch (Impersonation)
        Route::get('/double-switch', [\App\Http\Controllers\SuperAdmin\DoubleSwitchController::class, 'index']);
        Route::post('/double-switch/login-as', [\App\Http\Controllers\SuperAdmin\DoubleSwitchController::class, 'loginAs'])->name('double-switch.login');

    });
});