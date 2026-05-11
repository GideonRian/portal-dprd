<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Berita;

class BeritaController extends Controller
{
    // Halaman Daftar Berita (Publik)
    public function index()
    {
        // Mengambil semua berita dari yang paling baru
        $beritas = Berita::latest()->get();
        
        // Mengambil 1 berita unggulan (jika ada)
        $featured = Berita::where('is_featured', true)->latest()->first();

        return view('Non-Users.berita', compact('beritas', 'featured'));
    }

    // Halaman Detail Berita (Publik)
    public function show($slug)
    {
        // Cari berita berdasarkan slug di URL, jika tidak ada tampilkan 404
        $berita = Berita::where('slug', $slug)->firstOrFail();
        
        // Ambil 3 berita lainnya untuk rekomendasi di bagian bawah
        $berita_lainnya = Berita::where('id', '!=', $berita->id)->latest()->take(3)->get();

        return view('Non-Users.berita-detail', compact('berita', 'berita_lainnya'));
    }
}