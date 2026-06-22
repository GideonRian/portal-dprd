<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Berita;

class BeritaController extends Controller
{
    // Halaman Daftar Berita (Publik)
    public function index(Request $request)
    {
        // 1. Ambil Berita Featured HANYA jika tidak ada request pencarian
        $featured = null;
        if (!$request->filled('search')) {
            $featured = Berita::where('is_featured', true)->latest()->first();
        }

        // 2. Mulai Query Data Berita
        $query = Berita::latest();

        // 3. Logika Filter Pencarian Dinamis (DIperbaiki: Hapus isi_berita)
        if ($request->filled('search')) {
            $searchTerm = $request->search;
            $query->where(function($q) use ($searchTerm) {
                $q->where('judul', 'LIKE', "%{$searchTerm}%")
                  ->orWhere('ringkasan', 'LIKE', "%{$searchTerm}%")
                  ->orWhere('kategori', 'LIKE', "%{$searchTerm}%");
            });
        }

        // 4. Ambil Data menggunakan Paginasi (9 Berita per halaman)
        $beritas = $query->paginate(9);

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

    // <-- 2. TOMBOL LIKE BERBASIS AJAX & SESSION (Mencegah Spamming Click)
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