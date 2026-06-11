<?php

namespace App\Http\Controllers\Staff;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Dokumen;
use App\Models\ActivityLog;
use Illuminate\Support\Facades\Storage;

class DokumenController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');
        $kategori = $request->input('kategori');

        $stats = [
            'total' => Dokumen::count(),
            'perda' => Dokumen::where('kategori', 'Peraturan Daerah')->count(),
            'risalah' => Dokumen::where('kategori', 'Risalah Rapat')->count(),
            'laporan' => Dokumen::where('kategori', 'Laporan Keuangan')->count(),
            'keputusan' => Dokumen::where('kategori', 'Keputusan DPRD')->count(),
            'hearing' => Dokumen::where('kategori', 'Hasil Hearing')->count(),
            'tatib' => Dokumen::where('kategori', 'Peraturan Tata Tertib')->count(),
        ];

        $dokumens = Dokumen::when($search, function ($query, $search) {
            return $query->where('judul', 'like', "%{$search}%")
                         ->orWhere('deskripsi', 'like', "%{$search}%")
                         ->orWhere('nama_file', 'like', "%{$search}%");
        })->when($kategori && $kategori !== 'Semua Kategori', function ($query) use ($kategori) {
            return $query->where('kategori', $kategori);
        })->latest()->get();

        return view('Staff.Dokumen.index', compact('dokumens', 'search', 'kategori', 'stats'));
    }

    public function create() { return view('Staff.Dokumen.create'); }

    public function store(Request $request)
    {
        $data = $request->validate([
            'judul' => 'required|string|max:255',
            'kategori' => 'required|string',
            'tahun' => 'required|string|max:4',
            'tipe_file' => 'nullable|string',
            'nama_file' => 'nullable|string',
            'deskripsi' => 'required|string',
            'file_dokumen' => 'required|file|mimes:pdf,doc,docx,xls,xlsx|max:51200', 
        ]);

        $file = $request->file('file_dokumen');
        $data['file_path'] = $file->store('dokumen_resmi', 'public');
        
        $data['tipe_file'] = $data['tipe_file'] ?? strtoupper($file->getClientOriginalExtension());
        $data['ukuran_file'] = $this->formatBytes($file->getSize());
        $data['nama_file'] = $data['nama_file'] ?? $file->getClientOriginalName();
        
        // Menggunakan konstanta Model untuk status
        $data['status_persetujuan'] = Dokumen::STATUS_PENDING;

        unset($data['file_dokumen']); 
        Dokumen::create($data);

        ActivityLog::record('Dokumen', 'Create', "Mengunggah dokumen baru: {$request->judul} (Menunggu persetujuan Sekretaris)");

        return redirect()->route('staff.dokumen.index')->with('success', 'Dokumen berhasil diunggah dan sedang menunggu persetujuan Sekretaris!');
    }

    public function edit($id)
    {
        $dokumen = Dokumen::findOrFail($id);
        return view('Staff.Dokumen.edit', compact('dokumen'));
    }

    public function update(Request $request, $id)
    {
        $dokumen = Dokumen::findOrFail($id);
        $data = $request->validate([
            'judul' => 'required|string|max:255',
            'kategori' => 'required|string',
            'tahun' => 'required|string|max:4',
            'tipe_file' => 'nullable|string',
            'nama_file' => 'nullable|string',
            'deskripsi' => 'required|string',
            'file_dokumen' => 'nullable|file|mimes:pdf,doc,docx,xls,xlsx|max:51200',
        ]);

        if ($request->hasFile('file_dokumen')) {
            if ($dokumen->file_path) Storage::disk('public')->delete($dokumen->file_path);
            
            $file = $request->file('file_dokumen');
            $data['file_path'] = $file->store('dokumen_resmi', 'public');
            $data['tipe_file'] = $data['tipe_file'] ?? strtoupper($file->getClientOriginalExtension());
            $data['ukuran_file'] = $this->formatBytes($file->getSize());
            $data['nama_file'] = $data['nama_file'] ?? $file->getClientOriginalName();
        }

        // Kembalikan ke status Pending dan hapus catatan lama (reset)
        $data['status_persetujuan'] = Dokumen::STATUS_PENDING;
        $data['catatan_persetujuan'] = null;

        unset($data['file_dokumen']);
        $dokumen->update($data);

        ActivityLog::record('Dokumen', 'Update', "Memperbarui dokumen: {$request->judul} (Status di-reset ke menunggu persetujuan)");

        return redirect()->route('staff.dokumen.index')->with('success', 'Dokumen berhasil diperbarui dan status kembali menunggu persetujuan.');
    }

    public function destroy($id)
    {
        $dokumen = Dokumen::findOrFail($id);
        $judulDokumen = $dokumen->judul;

        if ($dokumen->file_path) Storage::disk('public')->delete($dokumen->file_path);
        $dokumen->delete();

        ActivityLog::record('Dokumen', 'Delete', "Menghapus dokumen: {$judulDokumen}");

        return redirect()->route('staff.dokumen.index')->with('success', 'Dokumen berhasil dihapus!');
    }

    private function formatBytes($bytes, $precision = 1) { 
        $units = array('B', 'KB', 'MB', 'GB', 'TB'); 
        $bytes = max($bytes, 0); 
        $pow = floor(($bytes ? log($bytes) : 0) / log(1024)); 
        $pow = min($pow, count($units) - 1); 
        $bytes /= pow(1024, $pow);
        return round($bytes, $precision) . ' ' . $units[$pow]; 
    } 
}