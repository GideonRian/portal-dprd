<?php

use App\Models\Anggota;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Frontend\AspirasiController;
use App\Http\Controllers\Staff\AuthController;
use App\Http\Controllers\Staff\DashboardController;
use App\Http\Controllers\Staff\AnggotaController;

// Rute Beranda
Route::get('/', function () {
    // Sesuaikan dengan nama file kamu, asumsikan namanya welcome.blade.php
    return view('Non-Users.welcome'); 
})->name('home');

// RUTE ANGGOTA(Mengambil data dari database)
Route::get('/profil-anggota', function () {
    // Ambil semua data anggota dari database, urutkan dari yang terbaru
    $anggotas = Anggota::latest()->get(); 
    
    // Kirim variabel $anggotas ke halaman view
    return view('Non-Users.profil-anggota', compact('anggotas')); 
})->name('profil.anggota');

// Rute Form Pengisian Aspirasi
Route::get('/layanan-aspirasi', function () {
    return view('Non-Users.layanan-aspirasi');
})->name('layanan.aspirasi');

// Rute Form Pelacakan Aspirasi (BARU)
Route::get('/layanan-aspirasi/lacak', function () {
    return view('Non-Users.lacak-aspirasi');
})->name('layanan.aspirasi.lacak');

Route::get('/tentang-dprd', function () {
    return view('Non-Users.tentang'); // <-- Tambahkan awalan Non-Users
})->name('tentang');

// Rute untuk Halaman Daftar Berita
Route::get('/berita', function () {
    return view('Non-Users.berita');
})->name('berita');

// Rute untuk Halaman Detail Berita (BARU)
Route::get('/berita/detail', function () {
    return view('Non-Users.berita-detail');
})->name('berita.detail');

Route::get('/kontak', function () {
    return view('Non-Users.kontak');
})->name('kontak');

Route::get('/agenda', function () {
    return view('Non-Users.agenda-kegiatan');
})->name('agenda');

Route::get('/agenda/detail', function () {
    return view('Non-Users.agenda-detail');
})->name('agenda.detail');

Route::get('/pusat-dokumen', function () {
    return view('Non-Users.pusat-dokumen');
})->name('pusat.dokumen');



// Rute Form Aspirasi (Tampilan)
Route::get('/layanan-aspirasi', [AspirasiController::class, 'index'])->name('layanan.aspirasi');

// Rute untuk Menerima data form & Mengirim Email OTP
Route::post('/layanan-aspirasi/kirim-otp', [AspirasiController::class, 'prosesFormLaporan'])->name('aspirasi.kirim');

// Rute Menampilkan Halaman Input OTP
Route::get('/layanan-aspirasi/verifikasi', [AspirasiController::class, 'showOtpPage'])->name('aspirasi.otp');

// Rute untuk Memverifikasi OTP dan Menyimpan ke Database
Route::post('/layanan-aspirasi/verifikasi', [AspirasiController::class, 'verifyOtp'])->name('aspirasi.otp.verify');

// Rute untuk Menampilkan Halaman Lacak & Memproses Pencarian
Route::get('/layanan-aspirasi/lacak', [AspirasiController::class, 'lacakIndex'])->name('layanan.aspirasi.lacak');
Route::get('/layanan-aspirasi/lacak/cari', [AspirasiController::class, 'cariAspirasi'])->name('aspirasi.lacak.cari');


// Rute Halaman Login Staff
Route::get('/staff/login', [AuthController::class, 'index'])->name('staff.login');
Route::post('/staff/login', [AuthController::class, 'authenticate'])->name('staff.login.process');

// Rute Dashboard Staff (Nantinya wajib dilindungi Middleware 'auth')
Route::get('/staff/dashboard', [DashboardController::class, 'index'])->name('staff.dashboard');


// Taruh di bawah rute staff.dashboard
Route::resource('/staff/anggota', AnggotaController::class)->names('staff.anggota');