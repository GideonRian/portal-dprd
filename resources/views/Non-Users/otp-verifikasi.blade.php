@extends('Non-Users.layouts.main')

@section('title', 'Verifikasi OTP')

@section('content')
<main class="min-h-screen flex items-center justify-center bg-gray-50 py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-md w-full bg-white rounded-2xl shadow-xl p-8 border border-gray-100 text-center">
        
        <div class="w-16 h-16 bg-blue-100 text-blue-600 rounded-full flex items-center justify-center text-3xl mx-auto mb-6 shadow-sm">
            <i class="fa-solid fa-envelope-open-text"></i>
        </div>
        
        <h2 class="text-2xl font-bold text-gray-900 mb-2">Verifikasi Email Anda</h2>
        <p class="text-gray-500 text-sm mb-8">
            Kami telah mengirimkan 6 digit kode OTP ke email <br>
            <span class="font-bold text-gray-800">{{ session('email_pelapor') ?? 'email Anda' }}</span>
        </p>

        <form action="{{ route('aspirasi.otp.verify') }}" method="POST">
            @csrf
            
            <div class="mb-6">
                <label class="block text-sm font-bold text-gray-700 mb-2">Masukkan Kode OTP</label>
                <input type="text" name="otp_code" maxlength="6" required placeholder="Contoh: 123456" 
                       class="w-full text-center tracking-[0.5em] font-mono text-2xl border-2 border-gray-300 rounded-xl px-4 py-4 focus:ring-4 focus:ring-blue-100 focus:border-blue-600 outline-none transition">
            </div>

            <button type="submit" class="w-full bg-blue-600 text-white font-bold py-3.5 rounded-xl hover:bg-blue-700 transition shadow-md flex items-center justify-center gap-2">
                Verifikasi & Kirim Aspirasi <i class="fa-solid fa-check-circle"></i>
            </button>
        </form>

        <div class="mt-6 text-sm text-gray-500">
            Belum menerima email? 
            <a href="#" class="text-blue-600 font-bold hover:underline">Kirim ulang kode</a>
        </div>
    </div>
</main>
@endsection