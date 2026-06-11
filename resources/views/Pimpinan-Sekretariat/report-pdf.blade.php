<!DOCTYPE html>
<html>

<head>
    <title>Laporan Sistem - {{ ucfirst($type) }}</title>
    <style>
        body {
            font-family: 'Helvetica', 'Arial', sans-serif;
            color: #333;
            line-height: 1.4;
            font-size: 11px;
        }

        .header {
            text-align: center;
            border-bottom: 2px solid #ea580c;
            padding-bottom: 8px;
            margin-bottom: 15px;
        }

        .header h1 {
            margin: 0;
            font-size: 18px;
            color: #111827;
            text-transform: uppercase;
        }

        .header p {
            margin: 4px 0 0;
            color: #4b5563;
            font-size: 11px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }

        th,
        td {
            border: 1px solid #cbd5e1;
            padding: 6px 8px;
            text-align: left;
        }

        th {
            background-color: #f8fafc;
            font-weight: bold;
            color: #334155;
            font-size: 10px;
            text-transform: uppercase;
        }

        .text-center {
            text-align: center;
        }

        .font-bold {
            font-weight: bold;
        }
    </style>
</head>

<body>

    <div class="header">
        <h1>Laporan {{ ucfirst($type) }} Website DPRD Tapanuli Selatan</h1>
        <p>Periode Laporan: <strong>{{ $start }}</strong> s/d <strong>{{ $end }}</strong></p>
        <p style="font-size: 9px; color: #6b7280; margin-top: 2px;">Dibuat otomatis oleh sistem pada:
            {{ \Carbon\Carbon::now()->translatedFormat('l, d F Y - H:i:s') }} WIB</p>
    </div>

    <table>
        <thead>
            @if ($type == 'aktivitas')
                <tr>
                    <th style="width: 5%;" class="text-center">No</th>
                    <th style="width: 18%;">Tanggal & Waktu</th>
                    <th style="width: 15%;">Nama Staf</th>
                    <th style="width: 12%;">Modul</th>
                    <th style="width: 10%;">Aksi</th>
                    <th style="width: 40%;">Deskripsi Aktivitas</th>
                </tr>
            @elseif($type == 'aspirasi')
                <tr>
                    <th style="width: 5%;" class="text-center">No</th>
                    <th style="width: 18%;">Tanggal & Waktu Masuk</th>
                    <th style="width: 20%;">Nama Pengirim</th>
                    <th style="width: 32%;">Judul / Topik Aspirasi</th>
                    <th style="width: 15%;">Kategori</th>
                    <th style="width: 10%;">Status</th>
                </tr>
            @elseif($type == 'konten')
                <tr>
                    <th style="width: 5%;" class="text-center">No</th>
                    <th style="width: 18%;">Tanggal & Waktu Publish</th>
                    <th style="width: 12%;">Jenis Konten</th>
                    <th style="width: 15%;">Kategori</th>
                    <th style="width: 40%;">Judul Konten</th>
                    <th style="width: 10%;">Status</th>
                </tr>
            @elseif($type == 'kunjungan')
                <tr>
                    <th style="width: 5%;" class="text-center">No</th>
                    <th style="width: 20%;">Tanggal & Waktu Kunjungan</th>
                    <th style="width: 30%;">ID Sesi (Session ID)</th>
                    <th style="width: 30%;">Halaman / Path Diakses</th>
                    <th style="width: 15%;">IP Address</th>
                </tr>
            @endif
        </thead>
        <tbody>
            @forelse($items as $item)
                @if ($type == 'aktivitas')
                    <tr>
                        <td class="text-center">{{ $loop->iteration }}</td>
                        <td>{{ $item->created_at->format('d-m-Y, H:i:s') }} WIB</td>
                        <td class="font-bold">{{ $item->user->name ?? 'System' }}</td>
                        <td>{{ $item->module }}</td>
                        <td>{{ strtoupper($item->action) }}</td>
                        <td>{{ $item->description }}</td>
                    </tr>
                @elseif($type == 'aspirasi')
                    <tr>
                        <td class="text-center">{{ $loop->iteration }}</td>
                        <td>{{ $item->created_at->format('d-m-Y, H:i:s') }} WIB</td>
                        <td class="font-bold">{{ $item->nama }}</td>
                        <td>{{ $item->judul }}</td>
                        <td>{{ $item->kategori }}</td>
                        <td>{{ $item->status }}</td>
                    </tr>
                @elseif($type == 'konten')
                    <tr>
                        <td class="text-center">{{ $loop->iteration }}</td>
                        <td>{{ $item->created_at->format('d-m-Y, H:i:s') }} WIB</td>
                        <td class="font-bold">{{ $item->jenis }}</td>
                        <td>{{ $item->kategori }}</td>
                        <td>{{ $item->judul }}</td>
                        <td>{{ $item->status_persetujuan ?? 'Approved' }}</td>
                    </tr>
                @elseif($type == 'kunjungan')
                    <tr>
                        <td class="text-center">{{ $loop->iteration }}</td>
                        <td>{{ $item->created_at->format('d-m-Y, H:i:s') }} WIB</td>
                        <td><code>{{ substr($item->session_id, 0, 15) }}...</code></td>
                        <td>/{{ $item->path }}</td>
                        <td>{{ $item->ip_address }}</td>
                    </tr>
                @endif
            @empty
                <tr>
                    <td colspan="{{ $type == 'kunjungan' ? 5 : 6 }}" class="text-center"
                        style="padding: 15px; color: #666;">
                        Tidak ada data yang ditemukan untuk periode ini.
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <div style="margin-top: 50px; float: right; text-align: right; width: 250px;">
        <p>Sipirok, {{ \Carbon\Carbon::now()->translatedFormat('d F Y') }}</p>
        <br><br><br>
        <p><strong>Sekretaris DPRD Tapsel</strong></p>
    </div>

</body>

</html>
