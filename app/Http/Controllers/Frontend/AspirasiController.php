<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Mail;
// use App\Models\Aspirasi; // (Aktifkan ini nanti kalau Model Database sudah siap)

class AspirasiController extends Controller
{
    // 1. Tampilkan Halaman Form Laporan
    public function index()
    {
        return view('Non-Users.layanan-aspirasi');
    }

    // 2. Terima Data Laporan -> Generate OTP -> Kirim Email -> Simpan di Session
    // 2. Terima Data Laporan -> Generate OTP -> Kirim Email -> Simpan di Session
    public function prosesFormLaporan(Request $request)
    {
        // 1. Ambil semua input KECUALI file lampiran
        $data_laporan = $request->except('lampiran');

        // 2. Cek apakah pelapor mengunggah file lampiran
        if ($request->hasFile('lampiran')) {
            $file = $request->file('lampiran');
            // Upload file ke folder 'storage/app/public/temp_aspirasi'
            $path = $file->store('temp_aspirasi', 'public');

            // Simpan teks lokasi file-nya ke dalam array data laporan
            $data_laporan['lampiran_path'] = $path;
        }

        // 3. Generate 6 Digit OTP Acak
        $otp_code = rand(100000, 999999);

        // 4. Simpan Data Laporan (yang sekarang sudah berupa teks semua) ke Session
        Session::put('pending_aspirasi', $data_laporan);
        Session::put('otp_code', $otp_code);
        Session::put('email_pelapor', $request->email);

        // 5. Logika Kirim Email 
        Mail::raw("Halo!\n\nKode OTP untuk verifikasi Laporan Aspirasi Anda adalah: $otp_code \n\nJangan berikan kode ini kepada siapapun.", function ($message) use ($request) {
            $message->to($request->email)->subject('Kode OTP Verifikasi Aspirasi - DPRD Tapsel');
        });

        // 6. Arahkan pelapor ke halaman input OTP
        return redirect()->route('aspirasi.otp');
    }

    // 3. Tampilkan Halaman Input OTP
    public function showOtpPage()
    {
        // Jika tidak ada session pending laporan, tendang balik ke awal
        if (!Session::has('pending_aspirasi')) {
            return redirect()->route('layanan.aspirasi');
        }
        return view('Non-Users.otp-verifikasi');
    }

    // 4. Proses Pengecekan OTP yang diinput Pelapor
    public function verifyOtp(Request $request)
    {
        $input_otp = $request->otp_code;
        $valid_otp = Session::get('otp_code');
        $user_email = Session::get('email_pelapor');

        if ($input_otp == $valid_otp) {
            // 1. GENERATE KODE PELACAKAN (Format: ASP-YYYYMMDD-XXXX)
            $tanggal = date('Ymd');
            $angka_acak = rand(1000, 9999);
            $tracking_code = "ASP-" . $tanggal . "-" . $angka_acak;

            // 2. LOGIKA SIMPAN KE DATABASE (Opsional untuk saat ini)
            // $data = Session::get('pending_aspirasi');
            // Aspirasi::create([...]);

            // 3. KIRIM EMAIL KONFIRMASI & KODE PELACAKAN
            Mail::raw(
                "Terima kasih! Aspirasi Anda telah kami terima.\n\n" .
                    "Gunakan kode di bawah ini untuk melacak status laporan Anda melalui website kami:\n" .
                    "KODE PELACAKAN: " . $tracking_code . "\n\n" .
                    "Tim kami akan segera meninjau aspirasi Anda. Mohon tunggu informasi selanjutnya.",
                function ($message) use ($user_email) {
                    $message->to($user_email)->subject('Aspirasi Terkirim - Kode Pelacakan: DPRD Tapsel');
                }
            );

            // 4. HAPUS SESSION LAMA
            Session::forget(['pending_aspirasi', 'otp_code', 'email_pelapor']);

            // 5. ARAHKAN KE HALAMAN KIRIM ASPIRASI DENGAN PESAN SUKSES
            return redirect()->route('layanan.aspirasi')
                             ->with('success', 'Aspirasi Berhasil Dikirim!')
                             ->with('tracking_code', $tracking_code);
        } else {
            return back()->withErrors(['otp_code' => 'Kode OTP salah. Silakan periksa kembali email Anda.']);
        }
    }

    // 1. Tampilkan Halaman Lacak (Bawaan awal)
    public function lacakIndex()
    {
        return view('Non-Users.lacak-aspirasi');
    }

    // 2. Fungsi Pencarian Status Berdasarkan Kode
    public function cariAspirasi(Request $request)
    {
        $request->validate([
            'tracking_code' => 'required|string',
        ]);

        $tracking_code = $request->tracking_code;

        // DATA DUMMY (Hanya untuk simulasi)
        if ($tracking_code == "ASP-20260507-1234") {
            $aspirasi = (object)[
                'tracking_code' => 'ASP-20260507-1234',
                'nama' => 'Gideon',
                'kategori' => 'Infrastruktur',
                'judul' => 'Perbaikan Jalan di Wilayah Sipirok',
                'tgl_masuk' => '2026-05-07',
                'status' => 'Diproses',
                'isi' => 'Mohon bantuan perbaikan jalan rusak di depan pasar Sipirok yang sangat menghambat akses warga.'
            ];
        } else {
            $aspirasi = null;
        }

        if (!$aspirasi) {
            // UBAH BAGIAN INI: Jangan pakai back(), arahkan langsung ke halaman utama lacak
            return redirect()->route('layanan.aspirasi.lacak')->with('error', 'Kode pelacakan tidak ditemukan. Pastikan kode yang Anda masukkan benar.');
        }

        return view('Non-Users.lacak-aspirasi', compact('aspirasi'));
    }
}
