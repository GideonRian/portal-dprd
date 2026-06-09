<?php

namespace App\Http\Controllers\Staff;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

// Panggil semua model yang dibutuhkan
use App\Models\Anggota;
use App\Models\Berita;
use App\Models\Aspirasi;
use App\Models\Dokumen;
use App\Models\Agenda;

class DashboardController extends Controller
{
    public function index()
    {
        // Menghitung jumlah (count) dari masing-masing tabel
        $total_anggota = Anggota::count();
        $total_berita = Berita::count();
        $total_aspirasi = Aspirasi::count();
        $total_dokumen = Dokumen::count();
        $total_agenda = Agenda::count();

        // Mengirimkan data ke view dashboard staff
        return view('Staff.dashboard', compact(
            'total_anggota',
            'total_berita',
            'total_aspirasi',
            'total_dokumen',
            'total_agenda'
        ));
    }
}