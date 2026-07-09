<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Berita;
use Illuminate\Support\Facades\Cache; // <-- Tambahkan ini untuk pelacakan IP

class BeritaController extends Controller
{
    // Halaman Daftar Berita (Publik)
    public function index(Request $request)
    {
        $featured = null;
        if (!$request->filled('search')) {
            $featured = Berita::where('is_featured', true)->latest()->first();
        }

        $query = Berita::latest();

        if ($request->filled('search')) {
            $searchTerm = $request->search;
            $query->where(function($q) use ($searchTerm) {
                $q->where('judul', 'LIKE', "%{$searchTerm}%")
                  ->orWhere('ringkasan', 'LIKE', "%{$searchTerm}%")
                  ->orWhere('kategori', 'LIKE', "%{$searchTerm}%");
            });
        }

        $beritas = $query->paginate(9);

        return view('Non-Users.berita', compact('beritas', 'featured'));
    }

    // Halaman Detail Berita (Publik)
    public function show(Request $request, $slug) 
    {
        $berita = Berita::where('slug', $slug)->firstOrFail();
        
        $berita->increment('views');
        
        $berita_lainnya = Berita::where('id', '!=', $berita->id)->latest()->take(3)->get();

        // --- PENGECEKAN STATUS LIKE BERDASARKAN IP & SESSION ---
        $ipAddress = $request->ip();
        $cacheKey = 'liked_berita_' . $berita->id . '_ip_' . $ipAddress;
        $likedInSession = in_array($berita->id, session()->get('liked_beritas', []));
        
        // Jika IP ada di Cache ATAU ada di Session, tandai sebagai sudah dilike
        $hasLiked = Cache::has($cacheKey) || $likedInSession;

        // Lempar variabel $hasLiked ke View
        return view('Non-Users.berita-detail', compact('berita', 'berita_lainnya', 'hasLiked'));
    }

    // Tombol Like (Toggle: Bisa Like dan Unlike, anti-spam via IP & Session)
    public function like(Request $request, $id)
    {
        $berita = Berita::findOrFail($id);
        
        $ipAddress = $request->ip();
        $cacheKey = 'liked_berita_' . $id . '_ip_' . $ipAddress;
        $likedBeritas = session()->get('liked_beritas', []);

        $hasLikedCache = Cache::has($cacheKey);
        $hasLikedSession = in_array($id, $likedBeritas);

        // JIKA SUDAH PERNAH LIKE -> PROSES UNLIKE
        if ($hasLikedCache || $hasLikedSession) {
            
            // Kurangi jumlah like (pastikan tidak minus)
            if ($berita->likes > 0) {
                $berita->decrement('likes');
            }

            // Hapus jejak dari Cache
            Cache::forget($cacheKey);
            
            // Hapus jejak dari Session
            $likedBeritas = array_diff($likedBeritas, [$id]);
            session()->put('liked_beritas', $likedBeritas);

            return response()->json([
                'success' => true,
                'action'  => 'unliked', // Beritahu Javascript bahwa ini proses Unlike
                'message' => 'Batal menyukai berita.',
                'likes'   => $berita->likes
            ]);
        } 
        
        // JIKA BELUM PERNAH LIKE -> PROSES LIKE
        else {
            $berita->increment('likes');

            // Simpan jejak ke Cache (1 Tahun) & Session
            Cache::put($cacheKey, true, now()->addYears(1));
            session()->push('liked_beritas', $id);

            return response()->json([
                'success' => true,
                'action'  => 'liked', // Beritahu Javascript bahwa ini proses Like
                'message' => 'Berhasil menyukai berita.',
                'likes'   => $berita->likes
            ]);
        }
    }
}