@extends('SuperAdmin.layouts.app')

@section('title', 'Ganti Password')

@section('content')
<div class="max-w-2xl mx-auto">
    <div class="mb-8">
        <h1 class="text-3xl font-extrabold text-gray-900 tracking-tight mb-1">Ganti Password</h1>
        <p class="text-gray-500 text-sm font-medium">Perbarui kata sandi Anda secara berkala untuk menjaga keamanan akun.</p>
    </div>

    @if(session('success'))
        <div id="alert-message" class="bg-green-50 border-l-4 border-green-500 p-4 mb-6 rounded-r-lg shadow-sm transition-opacity duration-500 opacity-100">
            <div class="flex items-center">
                <i class="fa-solid fa-circle-check text-green-500 mr-3 text-lg"></i>
                <p class="text-green-800 text-sm font-bold">{{ session('success') }}</p>
            </div>
        </div>
    @endif

    <div class="bg-white border border-gray-100 rounded-2xl shadow-sm p-8">
        <form action="{{ route('superadmin.password.update') }}" method="POST" class="space-y-6">
            @csrf
            @method('PUT')

            <div>
                <label class="block text-sm font-bold text-gray-700 mb-2">Password Saat Ini</label>
                <input type="password" name="current_password" required class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-red-500/20 focus:border-red-500 transition @error('current_password') border-red-500 @enderror">
                @error('current_password')
                    <p class="text-red-500 text-xs font-bold mt-2">{{ $message }}</p>
                @enderror
            </div>

            <hr class="border-gray-100">

            <div>
                <label class="block text-sm font-bold text-gray-700 mb-2">Password Baru</label>
                <input type="password" name="new_password" required class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-red-500/20 focus:border-red-500 transition @error('new_password') border-red-500 @enderror">
                @error('new_password')
                    <p class="text-red-500 text-xs font-bold mt-2">{{ $message }}</p>
                @enderror
                <p class="text-xs text-gray-400 mt-2"><i class="fa-solid fa-circle-info mr-1"></i>Minimal 8 karakter.</p>
            </div>

            <div>
                <label class="block text-sm font-bold text-gray-700 mb-2">Konfirmasi Password Baru</label>
                <input type="password" name="new_password_confirmation" required class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-red-500/20 focus:border-red-500 transition">
            </div>

            <div class="pt-4">
                <button type="submit" class="w-full sm:w-auto bg-[#9b1c1c] hover:bg-red-800 text-white font-bold py-3 px-8 rounded-xl transition shadow-sm flex items-center justify-center gap-2">
                    <i class="fa-solid fa-floppy-disk"></i> Simpan Password Baru
                </button>
            </div>
        </form>
    </div>
</div>

<script>
    // Menghilangkan alert otomatis setelah 4 detik
    setTimeout(function() {
        const alertBox = document.getElementById('alert-message');
        if (alertBox) {
            alertBox.classList.replace('opacity-100', 'opacity-0');
            setTimeout(() => alertBox.style.display = 'none', 500);
        }
    }, 4000);
</script>
@endsection