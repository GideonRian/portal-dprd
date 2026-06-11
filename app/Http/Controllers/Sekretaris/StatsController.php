<?php

namespace App\Http\Controllers\Sekretaris;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Anggota;
use App\Models\Berita;
use App\Models\Aspirasi;
use App\Models\Dokumen;
use App\Models\Agenda;
use App\Models\VisitLog;
use Carbon\Carbon;
use Barryvdh\DomPDF\Facade\Pdf; // <-- TAMBAHAN IMPORT PDF

class StatsController extends Controller
{
    // Pindahkan semua logika pengambilan data ke private function ini
    private function getStatsData()
    {
        $startOfMonth = Carbon::now()->startOfMonth();
        $today = Carbon::today();

        // 1. Overview
        $overview = [
            'anggota'  => ['total' => Anggota::count(), 'trend' => Anggota::where('created_at', '>=', $startOfMonth)->count()],
            'berita'   => ['total' => Berita::count(), 'trend' => Berita::where('created_at', '>=', $startOfMonth)->count()],
            'aspirasi' => ['total' => Aspirasi::count(), 'trend' => Aspirasi::where('created_at', '>=', $startOfMonth)->count()],
            'dokumen'  => ['total' => Dokumen::count(), 'trend' => Dokumen::where('created_at', '>=', $startOfMonth)->count()],
            'agenda'   => ['total' => Agenda::count(), 'trend' => Agenda::where('created_at', '>=', $startOfMonth)->count()],
        ];

        // 2. Status Aspirasi
        $aspirasiStatus = [
            'Menunggu' => Aspirasi::where('status', 'Menunggu')->count(),
            'Diproses' => Aspirasi::where('status', 'Diproses')->count(),
            'Selesai'  => Aspirasi::where('status', 'Selesai')->count(),
            'Ditolak'  => Aspirasi::where('status', 'Ditolak')->count(),
        ];
        $totalAspirasi = array_sum($aspirasiStatus) ?: 1;

        // 3. Berita Kategori
        $kategoriBeritaRaw = Berita::selectRaw('kategori, count(*) as total')->groupBy('kategori')->pluck('total', 'kategori')->toArray();
        $totalBerita = array_sum($kategoriBeritaRaw) ?: 1;
        $kategoriBerita = [
            'Kegiatan DPRD' => $kategoriBeritaRaw['Kegiatan DPRD'] ?? 0,
            'Pengumuman'    => $kategoriBeritaRaw['Pengumuman'] ?? 0,
            'Rapat'         => $kategoriBeritaRaw['Rapat'] ?? 0,
            'Lainnya'       => 0
        ];
        foreach ($kategoriBeritaRaw as $key => $val) {
            if (!in_array($key, ['Kegiatan DPRD', 'Pengumuman', 'Rapat'])) { $kategoriBerita['Lainnya'] += $val; }
        }

        // 4. Top Berita
        $topBerita = Berita::orderByDesc('views')->orderByDesc('likes')->take(5)->get();

        // 5. Visitor & Engagement
        $visitorStats = [
            'total'     => VisitLog::distinct('session_id')->count('session_id'),
            'this_month'=> VisitLog::where('created_at', '>=', $startOfMonth)->distinct('session_id')->count('session_id'),
            'today'     => VisitLog::where('created_at', '>=', $today)->distinct('session_id')->count('session_id'),
        ];

        $totalSessions  = $visitorStats['total'] ?: 1;
        $totalPageViews = VisitLog::count();

        $pagesPerVisit = round($totalPageViews / $totalSessions, 1);

        $sessionDurations = VisitLog::selectRaw('session_id, TIMESTAMPDIFF(SECOND, MIN(created_at), MAX(created_at)) as duration')
            ->groupBy('session_id')->get();
        $totalDuration = $sessionDurations->sum('duration');
        $avgSeconds    = $sessionDurations->count() > 0 ? ($totalDuration / $sessionDurations->count()) : 0;
        $avgTimeOnSite = floor($avgSeconds / 60) . "m " . round($avgSeconds % 60) . "s";

        $bounceSessions = VisitLog::selectRaw('session_id, count(*) as total')
            ->groupBy('session_id')->having('total', '=', 1)->get()->count();
        $bounceRate = round(($bounceSessions / $totalSessions) * 100) . '%';

        // 6. Content Growth
        $startOfLastMonth = Carbon::now()->subMonth()->startOfMonth();
        $endOfLastMonth   = Carbon::now()->subMonth()->endOfMonth();

        $itemsThisMonth = Berita::where('created_at', '>=', $startOfMonth)->count() + Dokumen::where('created_at', '>=', $startOfMonth)->count() + Agenda::where('created_at', '>=', $startOfMonth)->count();
        $itemsLastMonth = Berita::whereBetween('created_at', [$startOfLastMonth, $endOfLastMonth])->count() + Dokumen::whereBetween('created_at', [$startOfLastMonth, $endOfLastMonth])->count() + Agenda::whereBetween('created_at', [$startOfLastMonth, $endOfLastMonth])->count();
        
        $growthDiff = $itemsThisMonth - $itemsLastMonth;
        $growthRate = $itemsLastMonth > 0 ? round(($growthDiff / $itemsLastMonth) * 100, 1) : 100;

        $contentGrowth = [
            'this_month'  => '+' . $itemsThisMonth . ' items',
            'last_month'  => '+' . $itemsLastMonth . ' items',
            'growth_rate' => ($growthRate >= 0 ? '+' : '') . $growthRate . '%'
        ];

        return compact(
            'overview', 'aspirasiStatus', 'totalAspirasi', 
            'kategoriBerita', 'totalBerita', 'topBerita',
            'visitorStats', 'pagesPerVisit', 'avgTimeOnSite', 'bounceRate', 'contentGrowth'
        );
    }

    // Tampilkan ke Halaman Web
    public function index()
    {
        return view('Pimpinan-Sekretariat.stats', $this->getStatsData());
    }

    // Ekspor Menjadi PDF
    public function exportReport()
    {
        $data = $this->getStatsData();
        
        // Memuat view khusus PDF (Kita buat di langkah 3)
        $pdf = Pdf::loadView('Pimpinan-Sekretariat.stats-pdf', $data);
        
        // Atur ukuran kertas
        $pdf->setPaper('A4', 'portrait');

        // Unduh file secara otomatis
        return $pdf->download('Laporan_Statistik_DPRD_' . date('d-M-Y') . '.pdf');
    }
}