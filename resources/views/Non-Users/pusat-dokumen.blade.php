@extends('Non-Users.layouts.main')

@section('title', 'Pusat Dokumen')

@section('content')
<style>
    body { background-color: #f8fafc; }
    /* Warna utama tema dokumen (Magenta/Pink Gelap) */
    .theme-doc-bg { background-color: #d81b60; }
    .theme-doc-text { color: #d81b60; }
    .theme-doc-border { border-color: #d81b60; }
    .theme-doc-hover:hover { background-color: #ad144b; }
    .theme-doc-hover-text:hover { background-color: #fdf2f8; }
</style>

<main class="w-full pb-20">
    
    <div class="theme-doc-bg pt-16 pb-28 md:pt-20 md:pb-32 px-4 text-center relative">
        <div class="inline-flex items-center justify-center w-14 h-14 rounded-2xl bg-white/20 border border-white/30 text-white text-2xl mb-6 backdrop-blur-sm shadow-lg">
            <i class="fa-solid fa-file-lines"></i>
        </div>
        <h1 class="text-3xl md:text-5xl font-bold text-white mb-4">Pusat Dokumen</h1>
        <p class="text-pink-100 text-sm md:text-base max-w-2xl mx-auto">Akses dokumen resmi DPRD Tapanuli Selatan termasuk Peraturan Daerah, Keputusan, Risalah Rapat, dan dokumen penting lainnya</p>
    </div>

    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 -mt-12 md:-mt-16 relative z-10 mb-8">
        <div class="bg-white rounded-2xl shadow-xl border border-gray-100 p-5 md:p-6">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-4">
                
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                        <i class="fa-solid fa-magnifying-glass text-gray-400"></i>
                    </div>
                    <input type="text" placeholder="Cari dokumen..." class="w-full pl-11 pr-4 py-3 border border-gray-200 rounded-xl focus:ring-1 focus:ring-[#d81b60] focus:border-[#d81b60] outline-none text-sm transition text-gray-700">
                </div>
                
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                        <i class="fa-solid fa-filter text-gray-400"></i>
                    </div>
                    <select class="w-full pl-11 pr-10 py-3 border border-gray-200 rounded-xl focus:ring-1 focus:ring-[#d81b60] focus:border-[#d81b60] outline-none text-sm appearance-none bg-white text-gray-700 transition cursor-pointer">
                        <option value="">Semua Dokumen</option>
                        <option value="perda">Peraturan Daerah</option>
                        <option value="keputusan">Keputusan DPRD</option>
                        <option value="risalah">Risalah Rapat</option>
                        <option value="laporan">Laporan Keuangan</option>
                        <option value="hearing">Hasil Hearing</option>
                        <option value="tatib">Peraturan Tata Tertib</option>
                        <option value="anggaran">Dokumen Anggaran</option>
                    </select>
                    <div class="absolute inset-y-0 right-0 pr-4 flex items-center pointer-events-none">
                        <i class="fa-solid fa-chevron-down text-gray-400 text-xs"></i>
                    </div>
                </div>
                
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                        <i class="fa-regular fa-calendar text-gray-400"></i>
                    </div>
                    <select class="w-full pl-11 pr-10 py-3 border border-gray-200 rounded-xl focus:ring-1 focus:ring-[#d81b60] focus:border-[#d81b60] outline-none text-sm appearance-none bg-white text-gray-700 transition cursor-pointer">
                        <option value="">Semua Tahun</option>
                        <option value="2026">2026</option>
                        <option value="2025">2025</option>
                        <option value="2024">2024</option>
                    </select>
                    <div class="absolute inset-y-0 right-0 pr-4 flex items-center pointer-events-none">
                        <i class="fa-solid fa-chevron-down text-gray-400 text-xs"></i>
                    </div>
                </div>
                
            </div>
            
            <div class="text-xs text-gray-500 ml-1">
                Menampilkan <span class="font-bold theme-doc-text">10</span> dokumen
            </div>
        </div>
    </div>

    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="space-y-4">
            
            @php
                $dokumen = [
                    ['kategori' => 'Peraturan Daerah', 'tipe' => 'PDF', 'size' => '2.4 MB', 'icon_color' => 'text-red-500', 'bg_icon' => 'bg-red-50', 'judul' => 'Peraturan Daerah Nomor 1 Tahun 2026 tentang APBD', 'desc' => 'Peraturan Daerah tentang Anggaran Pendapatan dan Belanja Daerah Tahun Anggaran 2026', 'tgl' => '15 Januari 2026'],
                    ['kategori' => 'Keputusan DPRD', 'tipe' => 'PDF', 'size' => '1.8 MB', 'icon_color' => 'text-red-500', 'bg_icon' => 'bg-red-50', 'judul' => 'Keputusan DPRD No. 5/DPRD/2026 tentang Pembentukan Pansus', 'desc' => 'Keputusan pembentukan Panitia Khusus untuk pengawasan proyek infrastruktur', 'tgl' => '10 Januari 2026'],
                    ['kategori' => 'Risalah Rapat', 'tipe' => 'PDF', 'size' => '5.1 MB', 'icon_color' => 'text-red-500', 'bg_icon' => 'bg-red-50', 'judul' => 'Risalah Rapat Paripurna DPRD Tapanuli Selatan Desember 2025', 'desc' => 'Risalah lengkap rapat paripurna pembahasan RAPBD Tapanuli Selatan 2026', 'tgl' => '20 Desember 2025'],
                    ['kategori' => 'Laporan Keuangan', 'tipe' => 'XLSX', 'size' => '4.2 MB', 'icon_color' => 'text-green-600', 'bg_icon' => 'bg-green-50', 'judul' => 'Laporan Keuangan DPRD Tapanuli Selatan Tahun 2025', 'desc' => 'Laporan realisasi anggaran dan pertanggungjawaban keuangan DPRD Tapanuli Selatan tahun 2025', 'tgl' => '31 Desember 2025'],
                    ['kategori' => 'Hasil Hearing', 'tipe' => 'PDF', 'size' => '2.7 MB', 'icon_color' => 'text-red-500', 'bg_icon' => 'bg-red-50', 'judul' => 'Hasil Hearing dengan Pelaku UMKM Tapanuli Selatan', 'desc' => 'Dokumen hasil hearing Komisi Ekonomi DPRD Tapanuli Selatan dengan pelaku UMKM', 'tgl' => '15 Februari 2026'],
                    ['kategori' => 'Peraturan Tata Tertib', 'tipe' => 'PDF', 'size' => '1.5 MB', 'icon_color' => 'text-red-500', 'bg_icon' => 'bg-red-50', 'judul' => 'Peraturan Tata Tertib DPRD Tapanuli Selatan', 'desc' => 'Peraturan Tata Tertib DPRD Tapanuli Selatan Periode 2024-2029', 'tgl' => '1 Januari 2025'],
                    ['kategori' => 'Dokumen Anggaran', 'tipe' => 'PDF', 'size' => '3.8 MB', 'icon_color' => 'text-red-500', 'bg_icon' => 'bg-red-50', 'judul' => 'Dokumen Anggaran Belanja Langsung DPRD Tapanuli Selatan 2026', 'desc' => 'Rincian anggaran belanja langsung untuk program dan kegiatan DPRD Tapanuli Selatan 2026', 'tgl' => '5 Januari 2026'],
                    ['kategori' => 'Peraturan Daerah', 'tipe' => 'PDF', 'size' => '2.1 MB', 'icon_color' => 'text-red-500', 'bg_icon' => 'bg-red-50', 'judul' => 'Peraturan Daerah No. 8 Tahun 2025 tentang Retribusi Daerah Tapanuli Selatan', 'desc' => 'Peraturan Daerah tentang jenis dan tarif retribusi daerah Tapanuli Selatan', 'tgl' => '15 November 2025'],
                    ['kategori' => 'Risalah Rapat', 'tipe' => 'PDF', 'size' => '1.9 MB', 'icon_color' => 'text-red-500', 'bg_icon' => 'bg-red-50', 'judul' => 'Risalah Rapat Komisi I - Pendidikan dan Kesehatan', 'desc' => 'Risalah rapat komisi pembahasan program kesehatan masyarakat DPRD Tapanuli Selatan', 'tgl' => '8 Februari 2026'],
                    ['kategori' => 'Hasil Hearing', 'tipe' => 'PDF', 'size' => '2.3 MB', 'icon_color' => 'text-red-500', 'bg_icon' => 'bg-red-50', 'judul' => 'Hasil Hearing Infrastruktur Jalan dan Jembatan DPRD', 'desc' => 'Dokumen hasil hearing pembangunan infrastruktur jalan dan jembatan di Tapanuli Selatan', 'tgl' => '20 Januari 2026'],
                ];
            @endphp

            @foreach($dokumen as $doc)
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-5 md:p-6 hover:shadow-md transition-all duration-300 flex flex-col md:flex-row gap-5 items-start md:items-center">
                
                <div class="w-14 h-14 {{ $doc['bg_icon'] }} {{ $doc['icon_color'] }} rounded-xl flex items-center justify-center text-2xl flex-shrink-0">
                    @if($doc['tipe'] == 'PDF')
                        <i class="fa-regular fa-file-pdf"></i>
                    @else
                        <i class="fa-regular fa-file-excel"></i>
                    @endif
                </div>

                <div class="flex-grow">
                    <div class="flex flex-wrap items-center gap-2 mb-2">
                        <span class="theme-doc-bg text-white text-[10px] font-bold px-3 py-1 rounded-full">{{ $doc['kategori'] }}</span>
                        <span class="text-xs font-bold text-gray-500 bg-gray-100 px-2 py-1 rounded-md">{{ $doc['tipe'] }} • {{ $doc['size'] }}</span>
                    </div>
                    <h3 class="text-lg font-bold text-gray-900 mb-1 leading-snug hover:theme-doc-text cursor-pointer transition">{{ $doc['judul'] }}</h3>
                    <p class="text-gray-500 text-sm mb-2 line-clamp-1">{{ $doc['desc'] }}</p>
                    <div class="text-gray-400 text-xs flex items-center gap-1.5 font-medium">
                        <i class="fa-regular fa-calendar"></i> {{ $doc['tgl'] }}
                    </div>
                </div>

                <div class="flex flex-row md:flex-col lg:flex-row gap-2 w-full md:w-auto flex-shrink-0 mt-4 md:mt-0">
                    <button class="flex-1 md:flex-none px-5 py-2.5 rounded-xl border theme-doc-border theme-doc-text theme-doc-hover-text font-bold text-sm flex items-center justify-center gap-2 transition bg-white">
                        <i class="fa-regular fa-eye"></i> Preview
                    </button>
                    <button class="flex-1 md:flex-none px-5 py-2.5 rounded-xl theme-doc-bg text-white theme-doc-hover font-bold text-sm flex items-center justify-center gap-2 transition shadow-md shadow-pink-200">
                        <i class="fa-solid fa-download"></i> Download
                    </button>
                </div>
                
            </div>
            @endforeach

        </div>
    </div>
</main>
@endsection