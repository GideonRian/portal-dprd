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
        $beritas = Berita::latest()->get();
        $featured = Berita::where('is_featured', true)->latest()->first();

        return view('Non-Users.berita', compact('beritas', 'featured'));
    }

    // Halaman Detail Berita (Publik)
    public function show($slug)
    {
        $berita = Berita::where('slug', $slug)->firstOrFail();
        
        // <-- 1. OTOMATISASI VIEW COUNTER: Naikkan jumlah tayangan (+1) setiap kali dibuka
        $berita->increment('views');
        
        $berita_lainnya = Berita::where('id', '!=', $berita->id)->latest()->take(3)->get();

        return view('Non-Users.berita-detail', compact('berita', 'berita_lainnya'));
    }

    // <-- 2. TOMBOL LIKE BERBASIS AJAH & SESSION (Mencegah Spamming Click)
    public function like($id)
    {
        $berita = Berita::findOrFail($id);
        
        // Ambil daftar ID berita yang sudah pernah di-like oleh user ini dari session browser
        $likedBeritas = session()->get('liked_beritas', []);

        // Jika ID berita ini sudah ada di dalam catatan sesi browser, tolak penambahan
        if (in_array($id, $likedBeritas)) {
            return response()->json([
                'success' => false,
                'message' => 'Anda sudah menyukai berita ini.',
                'likes'   => $berita->likes
            ]);
        }

        // Jika belum ada, naikkan jumlah likes (+1) di database
        $berita->increment('likes');

        // Simpan ID berita ini ke dalam catatan sesi browser agar tidak bisa klik lagi
        session()->push('liked_beritas', $id);

        return response()->json([
            'success' => true,
            'message' => 'Berhasil menyukai berita.',
            'likes'   => $berita->likes
        ]);
    }
}