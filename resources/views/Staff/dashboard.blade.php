@extends('Staff.layouts.app')

@section('title', 'Dashboard')

@section('content')
    <!-- Gaya CSS khusus untuk warna gradient Dashboard -->
    <style>
        .gradient-blue {
            background: linear-gradient(135deg, #3b82f6 0%, #2563eb 100%);
        }

        .gradient-purple {
            background: linear-gradient(135deg, #a855f7 0%, #9333ea 100%);
        }

        .gradient-green {
            background: linear-gradient(135deg, #10b981 0%, #059669 100%);
        }

        .gradient-red {
            background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%);
        }

        .gradient-orange {
            background: linear-gradient(135deg, #f97316 0%, #ea580c 100%);
        }
    </style>

    <div class="w-full px-4 sm:px-6 lg:px-8 py-8 max-w-screen-2xl mx-auto">

        <!-- Header Dashboard -->
        <div class="flex items-center gap-4 mb-8 animate-fade-in-down">
            <img src="{{ asset('images/logo.png') }}" alt="Logo" class="h-20 w-auto object-contain drop-shadow-lg">
            <div>
                <h2 class="text-3xl font-extrabold text-gray-900 mb-1">Admin Dashboard</h2>
                <p class="text-gray-600 font-medium">DPRD Tapanuli Selatan - Content Management System</p>
            </div>
        </div>

        <!-- 5 Kotak Statistik -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-5 gap-6 mb-8">
            <div
                class="gradient-blue rounded-2xl p-6 text-white shadow-lg transform hover:-translate-y-1 transition duration-300">
                <div class="flex justify-between items-start">
                    <i class="fa-solid fa-users text-3xl opacity-80"></i>
                    <h3 class="text-4xl font-black">85</h3>
                </div>
                <p class="mt-4 font-bold text-sm">Total Anggota</p>
            </div>
            <div
                class="gradient-purple rounded-2xl p-6 text-white shadow-lg transform hover:-translate-y-1 transition duration-300">
                <div class="flex justify-between items-start">
                    <i class="fa-regular fa-newspaper text-3xl opacity-80"></i>
                    <h3 class="text-4xl font-black">142</h3>
                </div>
                <p class="mt-4 font-bold text-sm">Total Berita</p>
            </div>
            <div
                class="gradient-green rounded-2xl p-6 text-white shadow-lg transform hover:-translate-y-1 transition duration-300">
                <div class="flex justify-between items-start">
                    <i class="fa-regular fa-message text-3xl opacity-80"></i>
                    <h3 class="text-4xl font-black">67</h3>
                </div>
                <p class="mt-4 font-bold text-sm">Aspirasi Masuk</p>
            </div>
            <div
                class="gradient-red rounded-2xl p-6 text-white shadow-lg transform hover:-translate-y-1 transition duration-300">
                <div class="flex justify-between items-start">
                    <i class="fa-regular fa-file-lines text-3xl opacity-80"></i>
                    <h3 class="text-4xl font-black">48</h3>
                </div>
                <p class="mt-4 font-bold text-sm">Total Dokumen</p>
            </div>
            <div
                class="gradient-orange rounded-2xl p-6 text-white shadow-lg transform hover:-translate-y-1 transition duration-300">
                <div class="flex justify-between items-start">
                    <i class="fa-regular fa-calendar text-3xl opacity-80"></i>
                    <h3 class="text-4xl font-black">35</h3>
                </div>
                <p class="mt-4 font-bold text-sm">Agenda Kegiatan</p>
            </div>
        </div>

        <!-- Quick Actions (Tombol Cepat) -->
        <div class="bg-white rounded-3xl p-8 shadow-sm border border-gray-100">
            <h3 class="text-xl font-bold text-gray-900 mb-6">Quick Actions</h3>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-5 gap-4">

                <a href="{{ route('staff.anggota.create') }}"
                    class="flex flex-col items-center justify-center p-4 rounded-xl border-2 border-blue-500 bg-blue-600 text-white font-bold text-sm hover:bg-blue-700 transition shadow-md gap-2 text-center">
                    <i class="fa-solid fa-user-plus text-xl"></i> Tambah Anggota Baru
                </a>

                <!-- Link sudah diarahkan ke halaman Buat Berita -->
                <a href="{{ route('staff.berita.create') }}"
                    class="flex flex-col items-center justify-center p-4 rounded-xl border-2 border-purple-500 bg-purple-600 text-white font-bold text-sm hover:bg-purple-700 transition shadow-md gap-2 text-center">
                    <i class="fa-regular fa-pen-to-square text-xl"></i> Buat Berita Baru
                </a>

                <a href="#"
                    class="flex flex-col items-center justify-center p-4 rounded-xl border-2 border-green-500 bg-green-600 text-white font-bold text-sm hover:bg-green-700 transition shadow-md gap-2 text-center">
                    <i class="fa-regular fa-comments text-xl"></i> Kelola Aspirasi
                </a>

                <!-- Link sudah diarahkan ke halaman Kelola Dokumen -->
                <a href="{{ route('staff.dokumen.index') }}"
                    class="flex flex-col items-center justify-center p-4 rounded-xl border-2 border-red-500 bg-red-600 text-white font-bold text-sm hover:bg-red-700 transition shadow-md gap-2 text-center">
                    <i class="fa-solid fa-folder-open text-xl"></i> Kelola Dokumen
                </a>

                <a href="#"
                    class="flex flex-col items-center justify-center p-4 rounded-xl border-2 border-orange-500 bg-orange-600 text-white font-bold text-sm hover:bg-orange-700 transition shadow-md gap-2 text-center">
                    <i class="fa-regular fa-calendar-plus text-xl"></i> Tambah Agenda Baru
                </a>

            </div>
        </div>

    </div>
@endsection
