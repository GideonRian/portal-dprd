<?php

namespace App\Http\Controllers\Staff;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Aspirasi;
use App\Models\AspirasiHistory;
use Illuminate\Support\Facades\Auth;

class AspirasiController extends Controller
{
    // 1. Tampilkan Halaman Utama & Daftar Aspirasi
    public function index(Request $request)
    {
        // Hanya tampilkan aspirasi yang sudah diverifikasi OTP oleh masyarakat
        $query = Aspirasi::where('is_verified', true);

        // Fitur Pencarian (Sesuai Gambar 1 - No 14)
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('tiket_id', 'like', "%{$search}%")
                  ->orWhere('nama', 'like', "%{$search}%")
                  ->orWhere('judul', 'like', "%{$search}%")
                  ->orWhere('kategori', 'like', "%{$search}%");
            });
        }

        // Fitur Filter Status (Sesuai Gambar 1 - No 15)
        if ($request->filled('status') && $request->status !== '') {
            $query->where('status', $request->status);
        }

        $aspirasis = $query->latest()->paginate(10);

        // Data Card Statistik (Sesuai Gambar 1 - No 10-13)
        $counts = [
            'total'    => Aspirasi::where('is_verified', true)->count(),
            'menunggu' => Aspirasi::where('is_verified', true)->where('status', 'Menunggu')->count(),
            'diproses' => Aspirasi::where('is_verified', true)->where('status', 'Diproses')->count(),
            'selesai'  => Aspirasi::where('is_verified', true)->where('status', 'Selesai')->count(),
        ];

        return view('Staff.Aspirasi.index', compact('aspirasis', 'counts'));
    }

    // 2. Ambil Data Detail via AJAX (Untuk Modal - Gambar 2 & 3)
    public function show($id)
    {
        $aspirasi = Aspirasi::with('histories')->findOrFail($id);
        return response()->json($aspirasi);
    }

    // 3. Proses Update Status & Catat Riwayat (Sesuai Gambar 4)
    // 3. Proses Update Status & Catat Riwayat
    public function update(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:Menunggu,Diproses,Selesai,Ditolak',
            'pic'    => 'nullable|string',
            'catatan'=> 'nullable|string'
        ]);

        $aspirasi = Aspirasi::findOrFail($id);
        
        // Ambil rating & ulasan saat ini
        $rating = $aspirasi->rating;
        $ulasan = $aspirasi->ulasan;

        // LOGIKA BARU: Jika status dibatalkan dari Selesai (misal dikembalikan ke Diproses), 
        // maka reset rating dari masyarakat agar mereka bisa menilai ulang nanti.
        if ($aspirasi->status == 'Selesai' && $request->status != 'Selesai') {
            $rating = null;
            $ulasan = null;
        }

        // Update data utama di tabel aspirasis
        $aspirasi->update([
            'status'     => $request->status,
            'pic'        => $request->pic,
            'keterangan' => $request->catatan,
            'rating'     => $rating,
            'ulasan'     => $ulasan
        ]);

        // Catat ke Timeline History
        AspirasiHistory::create([
            'aspirasi_id' => $aspirasi->id,
            'status'      => $request->status,
            'catatan'     => $request->catatan,
            // Detektor otomatis: Menggunakan 'name' atau 'nama' sesuai struktur database Anda
            'user_name'   => Auth::check() ? (Auth::user()->name ?? Auth::user()->nama) : 'Admin DPRD'
        ]);

        return redirect()->route('staff.aspirasi.index')->with('success', 'Status aspirasi berhasil diperbarui dan dicatat ke riwayat!');
    }
}