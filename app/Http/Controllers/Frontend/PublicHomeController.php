<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
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
        
        // PERBAIKAN DI SINI: Tambahkan kondisi status_persetujuan = 'Approved'
        $jumlah_perda = Dokumen::where('kategori', 'Peraturan Daerah')
                               ->where('status_persetujuan', 'Approved')
                               ->count(); 

        // Mengambil 3 berita terbaru (Hanya opsional jika ingin berita yang statusnya disetujui juga, 
        // tapi asusmsi di sini berita_terkini langsung tayang atau punya filter tersendiri)
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