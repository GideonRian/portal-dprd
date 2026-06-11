<!DOCTYPE html>
<html>

<head>
    <title>Laporan Statistik DPRD Tapanuli Selatan</title>
    <style>
        body {
            font-family: 'Helvetica', 'Arial', sans-serif;
            color: #333;
            line-height: 1.5;
            font-size: 12px;
        }

        .header {
            text-align: center;
            border-bottom: 2px solid #7e22ce;
            padding-bottom: 10px;
            margin-bottom: 20px;
        }

        .header h1 {
            margin: 0;
            font-size: 20px;
            color: #1f2937;
            text-transform: uppercase;
        }

        .header p {
            margin: 5px 0 0;
            color: #6b7280;
            font-size: 11px;
        }

        .section-title {
            font-size: 14px;
            font-weight: bold;
            background-color: #f3f4f6;
            padding: 6px 10px;
            margin-top: 20px;
            border-left: 4px solid #7e22ce;
        }

        table {
            w-full;
            border-collapse: collapse;
            margin-top: 10px;
            margin-bottom: 15px;
            width: 100%;
        }

        th,
        td {
            border: 1px solid #ddd;
            padding: 8px 12px;
            text-align: left;
        }

        th {
            background-color: #f9fafb;
            font-weight: bold;
            color: #4b5563;
        }

        .text-right {
            text-align: right;
        }

        .text-center {
            text-align: center;
        }

        .badge {
            display: inline-block;
            padding: 2px 6px;
            border-radius: 4px;
            font-size: 10px;
            color: #fff;
        }
    </style>
</head>

<body>

    <div class="header">
        <h1>Laporan Statistik Portal Web DPRD Tapsel</h1>
        <p>Dicetak pada: {{ \Carbon\Carbon::now()->translatedFormat('l, d F Y - H:i') }} | Area: Pimpinan Sekretariat
        </p>
    </div>

    <!-- 1. OVERVIEW DATA -->
    <div class="section-title">1. Ringkasan Data Utama (Overview)</div>
    <table>
        <tr>
            <th>Modul Sistem</th>
            <th class="text-center">Total Keseluruhan</th>
            <th class="text-center">Penambahan Bulan Ini</th>
        </tr>
        <tr>
            <td>Data Anggota Dewan</td>
            <td class="text-center">{{ $overview['anggota']['total'] }}</td>
            <td class="text-center">+{{ $overview['anggota']['trend'] }}</td>
        </tr>
        <tr>
            <td>Berita Terpublikasi</td>
            <td class="text-center">{{ $overview['berita']['total'] }}</td>
            <td class="text-center">+{{ $overview['berita']['trend'] }}</td>
        </tr>
        <tr>
            <td>Dokumen Resmi</td>
            <td class="text-center">{{ $overview['dokumen']['total'] }}</td>
            <td class="text-center">+{{ $overview['dokumen']['trend'] }}</td>
        </tr>
        <tr>
            <td>Agenda Kegiatan</td>
            <td class="text-center">{{ $overview['agenda']['total'] }}</td>
            <td class="text-center">+{{ $overview['agenda']['trend'] }}</td>
        </tr>
        <tr>
            <td>Aspirasi Masyarakat</td>
            <td class="text-center">{{ $overview['aspirasi']['total'] }}</td>
            <td class="text-center">+{{ $overview['aspirasi']['trend'] }}</td>
        </tr>
    </table>

    <!-- 2. ANALISIS ASPIRASI & BERITA -->
    <table style="border: none;">
        <tr>
            <td style="border: none; padding: 0; width: 48%; vertical-align: top;">
                <div class="section-title" style="margin-top: 0;">2. Status Laporan Aspirasi</div>
                <table>
                    <tr>
                        <th>Status</th>
                        <th class="text-right">Jumlah</th>
                    </tr>
                    @foreach ($aspirasiStatus as $status => $count)
                        <tr>
                            <td>{{ $status }}</td>
                            <td class="text-right">{{ $count }} ({{ round(($count / $totalAspirasi) * 100) }}%)
                            </td>
                        </tr>
                    @endforeach
                </table>
            </td>
            <td style="border: none; width: 4%;"></td> <!-- Spacer -->
            <td style="border: none; padding: 0; width: 48%; vertical-align: top;">
                <div class="section-title" style="margin-top: 0;">3. Kategori Berita Publik</div>
                <table>
                    <tr>
                        <th>Kategori</th>
                        <th class="text-right">Jumlah</th>
                    </tr>
                    @foreach ($kategoriBerita as $kategori => $count)
                        <tr>
                            <td>{{ $kategori }}</td>
                            <td class="text-right">{{ $count }} ({{ round(($count / $totalBerita) * 100) }}%)
                            </td>
                        </tr>
                    @endforeach
                </table>
            </td>
        </tr>
    </table>

    <!-- 4. TOP BERITA -->
    <div class="section-title">4. Top 5 Berita Paling Banyak Dilihat</div>
    <table>
        <tr>
            <th style="width: 5%; text-center">#</th>
            <th style="width: 65%;">Judul Berita</th>
            <th style="width: 15%;" class="text-center">Tayangan</th>
            <th style="width: 15%;" class="text-center">Suka</th>
        </tr>
        @foreach ($topBerita as $index => $berita)
            <tr>
                <td class="text-center">{{ $index + 1 }}</td>
                <td><strong>{{ $berita->judul }}</strong><br><span style="font-size: 10px; color: #666;">Tgl:
                        {{ \Carbon\Carbon::parse($berita->tanggal)->format('d M Y') }}</span></td>
                <td class="text-center">{{ number_format($berita->views) }}</td>
                <td class="text-center">{{ number_format($berita->likes) }}</td>
            </tr>
        @endforeach
    </table>

    <!-- 5. ANALITIK TRAFIK -->
    <div class="section-title">5. Analitik Kunjungan & Interaksi Web (Traffic Analyzer)</div>
    <table>
        <tr>
            <th colspan="2" style="text-align: center; background-color: #e0f2fe;">Statistik Pengunjung</th>
            <th colspan="2" style="text-align: center; background-color: #dcfce7;">Interaksi Pengguna</th>
            <th colspan="2" style="text-align: center; background-color: #fae8ff;">Pertumbuhan Konten</th>
        </tr>
        <tr>
            <td>Total Visitor</td>
            <td class="text-right"><strong>{{ number_format($visitorStats['total']) }}</strong></td>
            <td>Avg. Time on Site</td>
            <td class="text-right"><strong>{{ $avgTimeOnSite }}</strong></td>
            <td>Bulan Ini</td>
            <td class="text-right"><strong>{{ $contentGrowth['this_month'] }}</strong></td>
        </tr>
        <tr>
            <td>Bulan Ini</td>
            <td class="text-right"><strong>{{ number_format($visitorStats['this_month']) }}</strong></td>
            <td>Pages per Visit</td>
            <td class="text-right"><strong>{{ $pagesPerVisit }}</strong></td>
            <td>Bulan Lalu</td>
            <td class="text-right"><strong>{{ $contentGrowth['last_month'] }}</strong></td>
        </tr>
        <tr>
            <td>Hari Ini</td>
            <td class="text-right"><strong>{{ number_format($visitorStats['today']) }}</strong></td>
            <td>Bounce Rate</td>
            <td class="text-right"><strong>{{ $bounceRate }}</strong></td>
            <td>Growth Rate</td>
            <td class="text-right"><strong>{{ $contentGrowth['growth_rate'] }}</strong></td>
        </tr>
    </table>

    <div style="margin-top: 50px; text-align: right; font-size: 12px;">
        <p>Tapanuli Selatan, {{ \Carbon\Carbon::now()->translatedFormat('d F Y') }}</p>
        <br><br><br>
        <p><strong>Pimpinan Sekretariat DPRD</strong></p>
    </div>

</body>

</html>
