<!DOCTYPE html>
<html>

<head>
    <title>Laporan Log Aktivitas Staf DPRD Tapanuli Selatan</title>
    <style>
        body {
            font-family: 'Helvetica', 'Arial', sans-serif;
            color: #333;
            line-height: 1.4;
            font-size: 11px;
        }

        .header {
            text-align: center;
            border-bottom: 2px solid #6b21a8;
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
            font-size: 10px;
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

        /* Pewarnaan Tipe Aksi Singkat */
        .text-green {
            color: #16a34a;
            font-weight: bold;
        }

        .text-blue {
            color: #2563eb;
            font-weight: bold;
        }

        .text-red {
            color: #dc2626;
            font-weight: bold;
        }

        .text-orange {
            color: #ea580c;
            font-weight: bold;
        }
    </style>
</head>

<body>

    <div class="header">
        <h1>Laporan Log Aktivitas Sistem Informasi DPRD Tapanuli Selatan</h1>
        <p>Data diambil pada: {{ \Carbon\Carbon::now()->translatedFormat('l, d F Y - H:i') }} | Hak Akses: Sekretariat
            DPRD</p>
    </div>

    <table>
        <thead>
            <tr>
                <th style="width: 4%;" class="text-center">No</th>
                <th style="width: 14%;">Waktu Aktivitas</th>
                <th style="width: 15%;">Nama Pengguna (Staf)</th>
                <th style="width: 12%;">Modul</th>
                <th style="width: 10%;">Tipe Aksi</th>
                <th style="width: 45%;">Deskripsi Aktivitas Lengkap</th>
            </tr>
        </thead>
        <tbody>
            @forelse($logs as $index => $log)
                <tr>
                    <td class="text-center">{{ $index + 1 }}</td>
                    <td>{{ $log->created_at->format('d M Y, H:i') }} WIB</td>
                    <td class="font-bold">{{ $log->user->name ?? 'System' }}</td>
                    <td>{{ $log->module }}</td>
                    <td>
                        @if ($log->action == 'Create')
                            <span class="text-green">CREATE</span>
                        @elseif($log->action == 'Update')
                            <span class="text-blue">UPDATE</span>
                        @elseif($log->action == 'Delete')
                            <span class="text-red">DELETE</span>
                        @elseif($log->action == 'Login')
                            <span class="text-green">LOGIN</span>
                        @elseif($log->action == 'Logout')
                            <span class="text-orange">LOGOUT</span>
                        @else
                            <span>{{ strtoupper($log->action) }}</span>
                        @endif
                    </td>
                    <td>{{ $log->description }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="text-center" style="padding: 20px; color: #64748b;">
                        Tidak ada riwayat aktivitas yang terekam pada periode ini.
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <div style="margin-top: 40px; float: right; text-align: right; width: 250px;">
        <p>Sipirok, {{ \Carbon\Carbon::now()->translatedFormat('d F Y') }}</p>
        <br><br><br>
        <p><strong>Sekretaris DPRD Tapsel</strong></p>
    </div>

</body>

</html>
