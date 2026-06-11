<?php

namespace App\Http\Controllers\Sekretaris;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ActivityLog;
use App\Models\Aspirasi;
use App\Models\Berita;
use App\Models\Dokumen;
use App\Models\Agenda;
use App\Models\VisitLog;
use Carbon\Carbon;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Storage;

class ReportController extends Controller
{
    /**
     * Menampilkan Halaman System Reports
     */
    public function index()
    {
        // Pastikan folder reports ada
        if (!Storage::disk('public')->exists('reports')) {
            Storage::disk('public')->makeDirectory('reports');
        }

        // Ambil daftar file laporan terbaru dari storage
        $files = Storage::disk('public')->files('reports');
        
        $recentReports = [];
        foreach ($files as $file) {
            $recentReports[] = (object)[
                'name' => basename($file),
                'path' => $file,
                'size' => round(Storage::disk('public')->size($file) / 1024, 2) . ' KB',
                'time' => Carbon::createFromTimestamp(Storage::disk('public')->lastModified($file)),
            ];
        }

        // Urutkan dari yang paling baru di-generate
        usort($recentReports, function($a, $b) {
            return $b->time <=> $a->time;
        });

        // Ambil 5 teratas saja
        $recentReports = array_slice($recentReports, 0, 5);

        return view('Pimpinan-Sekretariat.reports', compact('recentReports'));
    }

    /**
     * Generate PDF berdasarkan tipe dan periode tanggal
     */
    public function generate(Request $request)
    {
        $request->validate([
            'type'       => 'required|string',
            'start_date' => 'required|date',
            'end_date'   => 'required|date|after_or_equal:start_date',
        ]);

        $type = $request->type;
        $start = Carbon::parse($request->start_date)->startOfDay();
        $end = Carbon::parse($request->end_date)->endOfDay();
        
        $data = [
            'type'  => $type,
            'start' => $start->translatedFormat('d F Y'),
            'end'   => $end->translatedFormat('d F Y'),
            'items' => []
        ];

        $titlePrefix = "";

        // Logika Pengambilan Data Berdasarkan Tipe
        if ($type == 'aktivitas') {
            $data['items'] = ActivityLog::with('user')->whereBetween('created_at', [$start, $end])->latest()->get();
            $titlePrefix = "Laporan_Aktivitas_Admin_";
        } 
        elseif ($type == 'aspirasi') {
            $data['items'] = Aspirasi::whereBetween('created_at', [$start, $end])->latest()->get();
            $titlePrefix = "Laporan_Aspirasi_Masyarakat_";
        } 
        elseif ($type == 'konten') {
            $beritas = Berita::whereBetween('created_at', [$start, $end])->get()->map(function($item) { $item->jenis = 'Berita'; return $item; });
            $dokumens = Dokumen::whereBetween('created_at', [$start, $end])->get()->map(function($item) { $item->jenis = 'Dokumen'; return $item; });
            $data['items'] = $beritas->concat($dokumens)->sortByDesc('created_at');
            $titlePrefix = "Laporan_Konten_Website_";
        } 
        elseif ($type == 'kunjungan') {
            $data['items'] = VisitLog::whereBetween('created_at', [$start, $end])->latest()->get();
            $titlePrefix = "Laporan_Kunjungan_Website_";
        }

        // Render PDF
        $pdf = Pdf::loadView('Pimpinan-Sekretariat.report-pdf', $data);
        $pdf->setPaper('A4', 'landscape');

        $fileName = $titlePrefix . $start->format('Y-m-d') . '_to_' . $end->format('Y-m-d') . '_' . time() . '.pdf';
        
        // Simpan ke Storage agar masuk ke daftar "Recent Reports"
        Storage::disk('public')->put('reports/' . $fileName, $pdf->output());

        return $pdf->download($fileName);
    }

    /**
     * Download laporan dari Recent Reports
     */
    public function downloadRecent($fileName)
    {
        $filePath = 'reports/' . $fileName;
        
        // PERBAIKAN: Menggunakan jalur absolut dengan storage_path() 
        // dan mengembalikannya melalui fungsi pembantu response()->download()
        $absolutePath = storage_path('app/public/' . $filePath);

        if (file_exists($absolutePath)) {
            return response()->download($absolutePath);
        }

        return back()->with('error', 'File laporan tidak ditemukan.');
    }
}