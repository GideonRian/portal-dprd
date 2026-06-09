<?php

namespace App\Http\Controllers\Frontend; // <-- DISESUAIKAN DENGAN FOLDER FRONTEND

use App\Http\Controllers\Controller; // <-- WAJIB DIPANGGIL KARENA BERADA DI SUB-FOLDER
use Illuminate\Http\Request;
use App\Models\Anggota; 
use App\Models\Aspirasi;
use App\Models\Dokumen; 
use App\Models\Berita;

class PublicHomeController extends Controller
{
    public function index()
    {
        // Menghitung statistik untuk ditampilkan di beranda publik
        $jumlah_anggota = Anggota::count();
        $jumlah_aspirasi = Aspirasi::count();
        $jumlah_perda = Dokumen::where('kategori', 'Peraturan Daerah')->count(); 

        // Mengambil 3 berita terbaru
        $berita_terkini = Berita::latest()->take(3)->get();

        // Mengirim semua data ke view welcome publik
        return view('Non-Users.welcome', compact(
            'jumlah_anggota',
            'jumlah_aspirasi',
            'jumlah_perda',
            'berita_terkini'
        ));
    }
}