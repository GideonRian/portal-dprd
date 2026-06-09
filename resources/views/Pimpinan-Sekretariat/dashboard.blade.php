@extends('Pimpinan-Sekretariat.layouts.app')

@section('title', 'Sekretariat Dashboard')

@section('content')
    <div class="w-full px-4 sm:px-6 lg:px-8 py-8 max-w-screen-2xl mx-auto font-sans">

        <div class="flex items-center gap-4 mb-6">
            <img src="{{ asset('images/logo.png') }}" alt="Logo" class="h-20 w-auto object-contain drop-shadow-md">
            <div>
                <h1 class="text-3xl font-extrabold text-gray-900 mb-1">Sekretariat Dashboard</h1>
                <p class="text-gray-500 font-medium">DPRD Tapanuli Selatan - Control & Monitoring System</p>
            </div>
        </div>

        <div class="bg-indigo-50 border border-indigo-100 rounded-2xl p-6 mb-8 flex items-start gap-4 shadow-sm">
            <div class="mt-1">
                <i class="fa-solid fa-shield-halved text-indigo-600 text-2xl"></i>
            </div>
            <div>
                <h2 class="text-indigo-900 font-bold text-lg mb-1">Selamat datang, Sekretariat DPRD!</h2>
                <p class="text-indigo-700 text-sm">Anda memiliki akses penuh untuk monitoring dan manajemen sistem.</p>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-10">

            <div
                class="bg-amber-500 rounded-2xl p-6 text-white shadow-lg border-b-4 border-amber-600 transform hover:-translate-y-1 transition duration-300">
                <div class="flex justify-between items-start">
                    <i class="fa-regular fa-circle-check text-3xl opacity-80"></i>
                    <h3 class="text-5xl font-black">{{ $pending_approvals }}</h3>
                </div>
                <p class="mt-4 font-bold text-sm">Pending Approvals</p>
            </div>

            <div
                class="bg-blue-600 rounded-2xl p-6 text-white shadow-lg border-b-4 border-blue-700 transform hover:-translate-y-1 transition duration-300">
                <div class="flex justify-between items-start">
                    <i class="fa-solid fa-users text-3xl opacity-80"></i>
                    <h3 class="text-5xl font-black">{{ $total_anggota }}</h3>
                </div>
                <p class="mt-4 font-bold text-sm">Total Anggota</p>
            </div>

            <div
                class="bg-green-500 rounded-2xl p-6 text-white shadow-lg border-b-4 border-green-600 transform hover:-translate-y-1 transition duration-300">
                <div class="flex justify-between items-start">
                    <i class="fa-regular fa-newspaper text-3xl opacity-80"></i>
                    <h3 class="text-5xl font-black">{{ $total_berita }}</h3>
                </div>
                <p class="mt-4 font-bold text-sm">Total Berita</p>
            </div>

            <div
                class="bg-red-600 rounded-2xl p-6 text-white shadow-lg border-b-4 border-red-700 transform hover:-translate-y-1 transition duration-300">
                <div class="flex justify-between items-start">
                    <i class="fa-regular fa-comment-dots text-3xl opacity-80"></i>
                    <h3 class="text-5xl font-black">{{ $total_aspirasi }}</h3>
                </div>
                <p class="mt-4 font-bold text-sm">Aspirasi Masuk</p>
            </div>

            <div
                class="bg-orange-600 rounded-2xl p-6 text-white shadow-lg border-b-4 border-orange-700 transform hover:-translate-y-1 transition duration-300">
                <div class="flex justify-between items-start">
                    <i class="fa-regular fa-file-lines text-3xl opacity-80"></i>
                    <h3 class="text-5xl font-black">{{ $total_dokumen }}</h3>
                </div>
                <p class="mt-4 font-bold text-sm">Total Dokumen</p>
            </div>

            <div
                class="bg-indigo-500 rounded-2xl p-6 text-white shadow-lg border-b-4 border-indigo-600 transform hover:-translate-y-1 transition duration-300">
                <div class="flex justify-between items-start">
                    <i class="fa-regular fa-calendar-days text-3xl opacity-80"></i>
                    <h3 class="text-5xl font-black">{{ $total_agenda }}</h3>
                </div>
                <p class="mt-4 font-bold text-sm">Agenda Kegiatan</p>
            </div>
        </div>

        <h3 class="text-xl font-bold text-gray-900 mb-4">Monitoring & Control</h3>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-10">

            <a href="#"
                class="bg-white rounded-2xl p-5 border border-gray-200 shadow-sm flex items-center gap-4 hover:shadow-md transition hover:border-blue-300 group">
                <div
                    class="w-14 h-14 rounded-xl bg-blue-50 text-blue-600 flex items-center justify-center group-hover:bg-blue-600 group-hover:text-white transition">
                    <i class="fa-solid fa-chart-line text-2xl"></i>
                </div>
                <div>
                    <h4 class="font-bold text-gray-900">Activity Log</h4>
                    <p class="text-xs text-gray-500 mt-1">Monitor aktivitas admin dan perubahan data</p>
                </div>
            </a>

            <a href="#"
                class="bg-white rounded-2xl p-5 border border-gray-200 shadow-sm flex items-center gap-4 hover:shadow-md transition hover:border-purple-300 group">
                <div
                    class="w-14 h-14 rounded-xl bg-purple-50 text-purple-600 flex items-center justify-center group-hover:bg-purple-600 group-hover:text-white transition">
                    <i class="fa-solid fa-check-double text-2xl"></i>
                </div>
                <div>
                    <h4 class="font-bold text-gray-900">Content Approval</h4>
                    <p class="text-xs text-gray-500 mt-1">Review dan approve konten yang diajukan</p>
                </div>
            </a>

            <a href="#"
                class="bg-white rounded-2xl p-5 border border-gray-200 shadow-sm flex items-center gap-4 hover:shadow-md transition hover:border-green-300 group">
                <div
                    class="w-14 h-14 rounded-xl bg-green-50 text-green-600 flex items-center justify-center group-hover:bg-green-600 group-hover:text-white transition">
                    <i class="fa-solid fa-chart-simple text-2xl"></i>
                </div>
                <div>
                    <h4 class="font-bold text-gray-900">Statistics</h4>
                    <p class="text-xs text-gray-500 mt-1">Lihat statistik lengkap website</p>
                </div>
            </a>

            <a href="#"
                class="bg-white rounded-2xl p-5 border border-gray-200 shadow-sm flex items-center gap-4 hover:shadow-md transition hover:border-orange-300 group">
                <div
                    class="w-14 h-14 rounded-xl bg-orange-50 text-orange-600 flex items-center justify-center group-hover:bg-orange-600 group-hover:text-white transition">
                    <i class="fa-solid fa-clipboard-list text-2xl"></i>
                </div>
                <div>
                    <h4 class="font-bold text-gray-900">System Reports</h4>
                    <p class="text-xs text-gray-500 mt-1">Generate laporan sistem dan audit</p>
                </div>
            </a>
        </div>

        <div class="bg-gray-50 rounded-2xl p-6 border border-gray-100">
            <div class="flex items-center gap-3 mb-2">
                <i class="fa-solid fa-grip text-indigo-600 text-xl"></i>
                <h3 class="text-xl font-bold text-gray-900">Admin Features Access</h3>
            </div>
            <p class="text-sm text-gray-500 mb-6">Sebagai Sekretariat, Anda juga memiliki akses penuh ke semua fitur admin
                untuk manajemen konten:</p>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <a href="#"
                    class="bg-blue-600 hover:bg-blue-700 text-white py-4 px-4 rounded-xl font-bold text-center shadow-md hover:shadow-lg transition flex justify-center items-center gap-2">
                    <i class="fa-solid fa-user-group"></i> Kelola Anggota
                </a>

                <a href="#"
                    class="bg-purple-600 hover:bg-purple-700 text-white py-4 px-4 rounded-xl font-bold text-center shadow-md hover:shadow-lg transition flex justify-center items-center gap-2">
                    <i class="fa-regular fa-newspaper"></i> Kelola Berita
                </a>

                <a href="#"
                    class="bg-green-600 hover:bg-green-700 text-white py-4 px-4 rounded-xl font-bold text-center shadow-md hover:shadow-lg transition flex justify-center items-center gap-2">
                    <i class="fa-regular fa-comments"></i> Kelola Aspirasi
                </a>
            </div>
        </div>

    </div>
@endsection
