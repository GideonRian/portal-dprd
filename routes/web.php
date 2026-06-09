<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; // <-- TAMBAHAN IMPORT FACADE AUTH

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


/*
|--------------------------------------------------------------------------
| FRONTEND / NON-USER ROUTES (Area Publik)
|--------------------------------------------------------------------------
*/

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
    $dokumens = Dokumen::latest()->get();
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


// --- Layanan Aspirasi ---
Route::get('/layanan-aspirasi', [AspirasiController::class, 'index'])->name('layanan.aspirasi');
Route::post('/layanan-aspirasi/kirim-otp', [AspirasiController::class, 'prosesFormLaporan'])->name('aspirasi.kirim');
Route::get('/layanan-aspirasi/verifikasi', [AspirasiController::class, 'showOtpPage'])->name('aspirasi.otp');
Route::post('/layanan-aspirasi/verifikasi', [AspirasiController::class, 'verifyOtp'])->name('aspirasi.otp.verify');
Route::get('/layanan-aspirasi/lacak', [AspirasiController::class, 'lacakIndex'])->name('layanan.aspirasi.lacak');
Route::get('/layanan-aspirasi/lacak/cari', [AspirasiController::class, 'cariAspirasi'])->name('aspirasi.lacak.cari');
Route::post('/layanan-aspirasi/lacak/{id}/rating', [\App\Http\Controllers\Frontend\AspirasiController::class, 'submitRating'])->name('aspirasi.lacak.rating');

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
    
    // PERBAIKAN: Menggunakan Facade Auth::
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

        // Semua rute resource berita, dokumen, agenda, dll ada di sini...
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
    
    // PERBAIKAN: Menggunakan Facade Auth::
    Route::get('/', function () {
        if (Auth::check()) {
            return Auth::user()->role === 'sekretaris' 
                ? redirect()->route('sekretaris.dashboard') 
                : redirect()->route('staff.dashboard');
        }
        return redirect()->route('sekretaris.login');
    });

    // 1. RUTE GUEST
    Route::middleware('guest')->group(function () {
        Route::get('/login', [SekretarisAuthController::class, 'index'])->name('login');
        Route::post('/login', [SekretarisAuthController::class, 'authenticate'])->name('login.process');
    });

    // 2. RUTE TERLINDUNGI
    Route::middleware(['auth', 'role:sekretaris'])->group(function () {
        
        Route::post('/logout', [SekretarisAuthController::class, 'logout'])->name('logout');

        Route::get('/dashboard', [SekretarisDashboardController::class, 'index'])->name('dashboard');
        Route::get('/activity', [ActivityController::class, 'index'])->name('activity');
        
    });
});