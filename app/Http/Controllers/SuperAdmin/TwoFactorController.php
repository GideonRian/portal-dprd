<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str; 
use App\Models\ActivityLog; // <-- Tambahkan import ini untuk forensik

class TwoFactorController extends Controller
{
    public function index()
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();

        if (!$user) {
            return redirect()->route('superadmin.login')->withErrors(['username' => 'Akses ditolak. Silakan login terlebih dahulu.']);
        }

        // Buat secret key jika belum punya
        if (!$user->google2fa_secret) {
            $google2fa = app('pragmarx.google2fa');
            $user->google2fa_secret = $google2fa->generateSecretKey();
            $user->save();
        }

        // Buat 10 Recovery Codes jika belum punya
        if (!$user->recovery_codes) {
            $this->generateNewCodes($user);
        }

        $google2fa = app('pragmarx.google2fa');
        $qrCode = $google2fa->getQRCodeInline('DPRD Tapsel', 'manisdurian646@gmail.com', $user->google2fa_secret);

        // Ubah JSON text dari database menjadi Array PHP
        $recoveryCodes = json_decode($user->recovery_codes, true) ?? [];

        // KODE YANG DIUBAH: Mengarah ke folder 2fa dan file 2fa.blade.php
        return view('SuperAdmin.2fa.2fa', [
            'qrCode' => $qrCode,
            'secret' => $user->google2fa_secret,
            'recoveryCodes' => $recoveryCodes 
        ]);
    }

    // Fungsi saat tombol "Generate Baru" ditekan
    public function generateRecoveryCodes(Request $request)
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();
        $this->generateNewCodes($user);

        // <-- TAMBAHAN FORENSIK: Catat aktivitas generate kode baru
        ActivityLog::record(
            'Keamanan', 
            'GENERATE_RECOVERY_CODES', 
            'SuperAdmin men-generate ulang 10 kode cadangan 2FA yang baru.', 
            'warning' // Pakai warning karena kode lama jadi hangus
        );

        return back()->with('success', 'Kode cadangan baru berhasil dibuat! Kode lama sudah tidak berlaku.');
    }

    // Mesin pembuat 10 kode acak (Format: XXXX-XXXX)
    private function generateNewCodes($user)
    {
        $codes = [];
        for ($i = 0; $i < 10; $i++) {
            $codes[] = strtoupper(Str::random(4)) . '-' . strtoupper(Str::random(4));
        }
        $user->recovery_codes = json_encode($codes);
        $user->save();
    }
}