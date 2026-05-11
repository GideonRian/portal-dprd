@extends('Staff.layouts.app')

@section('title', 'Ganti Password')

@section('content')
    <div class="w-full px-4 sm:px-6 lg:px-8 py-8 max-w-4xl mx-auto">

        <div class="mb-10 text-center md:text-left">
            <h2 class="text-3xl md:text-4xl font-extrabold text-gray-900 mb-2">Ganti Password</h2>
            <p class="text-gray-500 text-sm md:text-base">Ubah password akun Anda untuk menjaga keamanan sistem</p>
        </div>

        @if (session('success'))
            <div
                class="bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-xl mb-6 flex items-center gap-2">
                <i class="fa-solid fa-circle-check"></i> {{ session('success') }}
            </div>
        @endif

        <div class="bg-white rounded-3xl shadow-sm border border-gray-200 p-6 md:p-10">

            <div class="flex items-center gap-3 mb-2">
                <i class="fa-solid fa-lock text-xl text-gray-800"></i>
                <h3 class="text-lg font-bold text-gray-900">Masukkan Password Baru</h3>
            </div>
            <p class="text-sm text-gray-500 mb-8 ml-8">Masukkan password lama dan password baru Anda</p>

            <div class="bg-blue-50 border border-blue-100 rounded-xl p-5 mb-8 flex items-start gap-3">
                <i class="fa-solid fa-circle-info text-blue-600 mt-0.5 text-lg"></i>
                <div class="text-sm text-blue-800">
                    <p class="font-bold mb-1">Informasi Penting:</p>
                    <ul class="space-y-1">
                        <li>• Pastikan password baru minimal 8 karakter.</li>
                        <li>• Disarankan menggunakan kombinasi huruf dan angka.</li>
                        <li>• Jangan pernah membagikan password ini kepada siapapun.</li>
                    </ul>
                </div>
            </div>

            <form action="{{ route('staff.password.update') }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-6">
                    <label class="block text-sm font-bold text-gray-900 mb-2">Password Lama</label>
                    <input type="password" name="current_password" required placeholder="Masukkan password lama"
                        class="w-full bg-gray-50 border border-gray-200 rounded-xl px-4 py-3.5 focus:bg-white focus:ring-2 focus:ring-blue-500 outline-none transition @error('current_password') border-red-500 ring-1 ring-red-500 @enderror">
                    @error('current_password')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-6">
                    <label class="block text-sm font-bold text-gray-900 mb-2">Password Baru</label>
                    <input type="password" name="password" required placeholder="Masukkan password baru (min. 8 karakter)"
                        class="w-full bg-gray-50 border border-gray-200 rounded-xl px-4 py-3.5 focus:bg-white focus:ring-2 focus:ring-blue-500 outline-none transition @error('password') border-red-500 ring-1 ring-red-500 @enderror">
                    @error('password')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-10">
                    <label class="block text-sm font-bold text-gray-900 mb-2">Konfirmasi Password Baru</label>
                    <input type="password" name="password_confirmation" required placeholder="Ketik ulang password baru"
                        class="w-full bg-gray-50 border border-gray-200 rounded-xl px-4 py-3.5 focus:bg-white focus:ring-2 focus:ring-blue-500 outline-none transition">
                </div>

                <div class="flex flex-col sm:flex-row gap-4 pt-2">
                    <a href="{{ route('staff.dashboard') }}"
                        class="w-full sm:w-1/2 text-center px-6 py-4 bg-white border-2 border-gray-200 text-gray-700 font-bold rounded-xl hover:bg-gray-50 hover:border-gray-300 transition">
                        Batal
                    </a>
                    <button type="submit"
                        class="w-full sm:w-1/2 px-6 py-4 bg-blue-600 text-white font-bold rounded-xl hover:bg-blue-700 transition shadow-md flex justify-center items-center gap-2">
                        <i class="fa-solid fa-key"></i> Perbarui Password
                    </button>
                </div>
            </form>

        </div>
    </div>
@endsection
