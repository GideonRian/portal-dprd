<?php

namespace App\Http\Controllers\Sekretaris;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Dokumen;
use App\Models\ActivityLog;

class ApprovalController extends Controller
{
    // Menampilkan Halaman Approval dan Statistik
    public function index()
    {
        // Hitung statistik asli berdasarkan data riil dari tabel dokumens
        $stats = [
            'pending'  => Dokumen::where('status_persetujuan', 'Pending')->count(),
            'approved' => Dokumen::where('status_persetujuan', 'Approved')->count(),
            'rejected' => Dokumen::where('status_persetujuan', 'Rejected')->count(),
        ];

        // Ambil semua daftar dokumen yang statusnya masih Pending
        $pending_items = Dokumen::where('status_persetujuan', 'Pending')->latest()->get();

        return view('Pimpinan-Sekretariat.approval', compact('stats', 'pending_items'));
    }

    // Fungsi Aksi Menyetujui Konten Dokumen
    public function approve(Request $request, $id)
    {
        try {
            $dokumen = Dokumen::findOrFail($id);
            
            // Simpan status dan catatannya
            $dokumen->update([
                'status_persetujuan' => Dokumen::STATUS_APPROVED,
                'catatan_persetujuan' => $request->catatan // Menyimpan catatan dari modal
            ]);

            $catatanLog = $request->filled('catatan') ? " (Catatan: {$request->catatan})" : "";
            
            // CATAT AKTIVITAS SUKSES
            ActivityLog::record('Dokumen', 'APPROVE_DOKUMEN', "Menyetujui publikasi dokumen: {$dokumen->judul}{$catatanLog}", 'success');

            return redirect()->route('sekretaris.approval')->with('success', 'Dokumen resmi disetujui dan tayang di publik!');

        } catch (\Exception $e) {
            
            // CATAT AKTIVITAS GAGAL (Sistem/Database Error)
            ActivityLog::record('Dokumen', 'FAILED_APPROVE_DOKUMEN', "Gagal menyetujui dokumen (ID: {$id}). Error: " . $e->getMessage(), 'error');

            return back()->with('error', 'Terjadi kesalahan sistem saat menyetujui dokumen!');
        }
    }

    // Fungsi Aksi Menolak Konten Dokumen
    public function reject(Request $request, $id)
    {
        try {
            $dokumen = Dokumen::findOrFail($id);
            
            // Simpan status dan catatannya
            $dokumen->update([
                'status_persetujuan' => Dokumen::STATUS_REJECTED,
                'catatan_persetujuan' => $request->catatan // Menyimpan catatan dari modal
            ]);

            $catatanLog = $request->filled('catatan') ? " (Alasan Ditolak: {$request->catatan})" : "";
            
            // CATAT AKTIVITAS WARNING (Karena ini penolakan/revisi untuk staf)
            ActivityLog::record('Dokumen', 'REJECT_DOKUMEN', "Menolak/Revisi dokumen: {$dokumen->judul}{$catatanLog}", 'warning');

            return redirect()->route('sekretaris.approval')->with('error', 'Dokumen ditolak dan dikembalikan ke staf.');

        } catch (\Exception $e) {
            
            // CATAT AKTIVITAS GAGAL (Sistem/Database Error)
            ActivityLog::record('Dokumen', 'FAILED_REJECT_DOKUMEN', "Gagal menolak dokumen (ID: {$id}). Error: " . $e->getMessage(), 'error');

            return back()->with('error', 'Terjadi kesalahan sistem saat menolak dokumen!');
        }
    }
}