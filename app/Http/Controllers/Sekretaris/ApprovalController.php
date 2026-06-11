<?php

namespace App\Http\Controllers\Sekretaris;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Dokumen;
use App\Models\ActivityLog;

class ApprovalController extends Controller
{
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
        $dokumen = Dokumen::findOrFail($id);
        
        // Simpan status dan catatannya
        $dokumen->update([
            'status_persetujuan' => Dokumen::STATUS_APPROVED,
            'catatan_persetujuan' => $request->catatan // Menyimpan catatan dari modal
        ]);

        $catatanLog = $request->filled('catatan') ? " (Catatan: {$request->catatan})" : "";
        ActivityLog::record('Dokumen', 'Update', "Menyetujui publikasi dokumen: {$dokumen->judul}{$catatanLog}");

        return redirect()->route('sekretaris.approval')->with('success', 'Dokumen resmi disetujui dan tayang di publik!');
    }

    // Fungsi Aksi Menolak Konten Dokumen
    public function reject(Request $request, $id)
    {
        $dokumen = Dokumen::findOrFail($id);
        
        // Simpan status dan catatannya
        $dokumen->update([
            'status_persetujuan' => Dokumen::STATUS_REJECTED,
            'catatan_persetujuan' => $request->catatan // Menyimpan catatan dari modal
        ]);

        $catatanLog = $request->filled('catatan') ? " (Alasan Ditolak: {$request->catatan})" : "";
        ActivityLog::record('Dokumen', 'Update', "Menolak/Revisi dokumen: {$dokumen->judul}{$catatanLog}");

        return redirect()->route('sekretaris.approval')->with('error', 'Dokumen ditolak dan dikembalikan ke staf.');
    }
}