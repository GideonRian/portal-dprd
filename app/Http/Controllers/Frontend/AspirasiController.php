<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Mail;
use App\Models\Aspirasi;
use App\Models\AspirasiHistory;

class AspirasiController extends Controller
{
    // 1. Tampilkan Halaman Form Laporan
    public function index()
    {
        return view('Non-Users.layanan-aspirasi');
    }

    // 2. Terima Data Laporan -> Generate OTP -> Kirim Email -> Simpan di Session
    public function prosesFormLaporan(Request $request)
    {
        // 1. Validasi Super Ketat (Jika ada yang kosong/salah, akan dikembalikan dengan kotak merah)
        $request->validate([
            'nama'     => 'required|string',
            'email'    => 'required|email',
            'telepon'  => 'required',
            'wilayah'  => 'required', 
            'kategori' => 'required',
            'judul'    => 'required',
            'isi'      => 'required',
            'images'   => 'nullable|array|max:2',
            'images.*' => 'nullable|image|mimes:jpeg,png,jpg|max:5120',
            'latitude'  => 'nullable|string',
            'longitude' => 'nullable|string',
        ]);

        $data_laporan = $request->except(['images', '_token']);

        // 2. Cegah Error jika user tidak mengunggah foto (Inisialisasi array kosong)
        $data_laporan['temp_images'] = [null, null];

        // 3. Proses Foto Hanya Jika Ada File yang Diunggah
        if ($request->hasFile('images')) {
            $files = $request->file('images');
            foreach ($files as $index => $file) {
                if ($index < 2 && $file->isValid()) {
                    $data_laporan['temp_images'][$index] = $file->store('temp_aspirasi', 'public');
                }
            }
        }

        $otp_code = rand(100000, 999999);

        // Simpan ke Session
        Session::put('pending_aspirasi', $data_laporan);
        Session::put('otp_code', $otp_code);
        Session::put('email_pelapor', $request->email);

        // Bantuan Testing (Bisa dihapus jika aplikasi sudah online)
        Session::flash('dummy_otp', $otp_code);

        // 4. DETEKTOR ERROR (Try-Catch) PADA EMAIL
        try {
            Mail::raw("Halo!\n\nKode OTP untuk verifikasi Laporan Aspirasi Anda adalah: $otp_code \n\nJangan berikan kode ini kepada siapapun.", function ($message) use ($request) {
                $message->to($request->email)->subject('Kode OTP Verifikasi Aspirasi - DPRD Tapsel');
            });
        } catch (\Exception $e) {
            // JIKA EMAIL CRASH (Entah karena jaringan/kredensial), sistem tidak akan 500 Error, 
            // melainkan memunculkan kotak merah di form masyarakat.
            return back()->withInput()->withErrors(['email' => 'Gagal menghubungi server Email! Detail: ' . $e->getMessage()]);
        }

        return redirect()->route('aspirasi.otp');
    }

    // 3. Tampilkan Halaman Input OTP
    public function showOtpPage()
    {
        if (!Session::has('pending_aspirasi')) {
            return redirect()->route('layanan.aspirasi');
        }
        return view('Non-Users.otp-verifikasi');
    }

    // 4. Proses Pengecekan OTP & Simpan ke Database
    public function verifyOtp(Request $request)
    {
        $input_otp = $request->otp_code;
        $valid_otp = Session::get('otp_code');
        $user_email = Session::get('email_pelapor');

        if ($input_otp == $valid_otp) {
            $tanggal = date('Ymd');
            $angka_acak = rand(1000, 9999);
            $tracking_code = "ASP-" . $tanggal . "-" . $angka_acak;

            $data = Session::get('pending_aspirasi');

            // Simpan ke tabel utaman
            $aspirasi = Aspirasi::create([
                'tiket_id'      => $tracking_code,
                'nama'          => $data['nama'],
                'email'         => $data['email'],
                'telepon'       => $data['telepon'],
                'alamat'        => $data['wilayah'] ?? null, // Mengambil dari input 'wilayah'
                'latitude'      => $data['latitude'] ?? null,   // <-- TAMBAHKAN INI
                'longitude'     => $data['longitude'] ?? null,
                'kategori'      => $data['kategori'],
                'judul'         => $data['judul'],
                'pesan'         => $data['isi'],
                'image1'        => $data['temp_images'][0] ?? null,
                'image2'        => $data['temp_images'][1] ?? null,
                'status'        => 'Menunggu',
                'is_verified'   => true,
            ]);

            // Catat Timeline Awal
            AspirasiHistory::create([
                'aspirasi_id' => $aspirasi->id,
                'status'      => 'Menunggu',
                'catatan'     => 'Aspirasi diterima dan sedang menunggu peninjauan oleh tim sekretariat.',
                'user_name'   => 'System'
            ]);

            // Kirim Email Konfirmasi (Dengan Try-Catch juga)
            try {
                Mail::raw(
                    "Terima kasih! Aspirasi Anda telah kami terima.\n\n" .
                    "Gunakan kode di bawah ini untuk melacak status laporan Anda melalui website kami:\n" .
                    "KODE PELACAKAN: " . $tracking_code . "\n\n" .
                    "Tim kami akan segera meninjau aspirasi Anda.",
                    function ($message) use ($user_email, $tracking_code) {
                        $message->to($user_email)->subject('Aspirasi Terkirim - Kode Pelacakan: ' . $tracking_code);
                    }
                );
            } catch (\Exception $e) {
                // Diabaikan karena data aspirasi sudah berhasil tersimpan dengan aman
            }

            Session::forget(['pending_aspirasi', 'otp_code', 'email_pelapor']);

            return redirect()->route('layanan.aspirasi')
                             ->with('success', 'Aspirasi Berhasil Dikirim!')
                             ->with('tracking_code', $tracking_code);
        } else {
            return back()->withErrors(['otp_code' => 'Kode OTP salah. Silakan periksa kembali email Anda.']);
        }
    }

    // 5. Halaman Lacak
    public function lacakIndex()
    {
        return view('Non-Users.lacak-aspirasi');
    }

    // 6. Pencarian Database Lacak
    public function cariAspirasi(Request $request)
    {
        $request->validate([
            'tracking_code' => 'required|string',
        ]);

        $aspirasi = Aspirasi::where('tiket_id', $request->tracking_code)
                            ->where('is_verified', true)
                            ->first();

        if (!$aspirasi) {
            return redirect()->route('layanan.aspirasi.lacak')
                             ->with('error', 'Kode pelacakan tidak ditemukan. Pastikan kode yang Anda masukkan benar.');
        }

        return view('Non-Users.lacak-aspirasi', compact('aspirasi'));
    }

    public function submitRating(Request $request, $id)
    {
        $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'ulasan' => 'nullable|string|max:500'
        ]);

        $aspirasi = Aspirasi::where('id', $id)->where('is_verified', true)->firstOrFail();

        // Pastikan hanya bisa dinilai jika status Selesai dan belum pernah dinilai
        if ($aspirasi->status == 'Selesai' && is_null($aspirasi->rating)) {
            $aspirasi->update([
                'rating' => $request->rating,
                'ulasan' => $request->ulasan
            ]);

            return back()->with('success', 'Terima kasih! Penilaian Anda sangat berarti untuk peningkatan layanan kami.');
        }

        return back()->with('error', 'Aspirasi belum dapat dinilai atau sudah pernah dinilai.');
    }
}