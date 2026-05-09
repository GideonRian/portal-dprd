@extends('Non-Users.layouts.main')

@section('title', 'Berita & Informasi')

@section('content')
    <style>
        body {
            background-color: #f8fafc;
            /* Latar belakang abu-abu sangat muda */
        }

        .line-clamp-2 {
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        .line-clamp-3 {
            display: -webkit-box;
            -webkit-line-clamp: 3;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }
    </style>

    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">

        <div class="flex items-center gap-5 mb-10">
            <div
                class="w-14 h-14 bg-purple-600 rounded-2xl flex items-center justify-center text-white text-2xl shadow-lg shadow-purple-200">
                <i class="fa-solid fa-arrow-trend-up"></i>
            </div>
            <div>
                <h1 class="text-3xl md:text-4xl font-bold text-gray-900 mb-1">Berita & Informasi</h1>
                <p class="text-gray-500">Informasi terkini dari DPRD Tapanuli Selatan</p>
            </div>
        </div>

        <div class="flex flex-wrap gap-3 mb-10">
            <a href="#"
                class="px-6 py-2.5 bg-purple-600 text-white rounded-lg text-sm font-bold shadow-md shadow-purple-200 transition">Semua</a>
            <a href="#"
                class="px-6 py-2.5 bg-white border border-gray-200 text-gray-600 rounded-lg text-sm font-medium hover:bg-gray-50 transition">Rapat
                Paripurna</a>
            <a href="#"
                class="px-6 py-2.5 bg-white border border-gray-200 text-gray-600 rounded-lg text-sm font-medium hover:bg-gray-50 transition">Kunjungan
                Kerja</a>
            <a href="#"
                class="px-6 py-2.5 bg-white border border-gray-200 text-gray-600 rounded-lg text-sm font-medium hover:bg-gray-50 transition">Hearing</a>
            <a href="#"
                class="px-6 py-2.5 bg-white border border-gray-200 text-gray-600 rounded-lg text-sm font-medium hover:bg-gray-50 transition">Peraturan
                Daerah</a>
            <a href="#"
                class="px-6 py-2.5 bg-white border border-gray-200 text-gray-600 rounded-lg text-sm font-medium hover:bg-gray-50 transition">Kegiatan
                Sosial</a>
        </div>

        <div
            class="bg-white rounded-2xl shadow-xl overflow-hidden mb-12 flex flex-col lg:flex-row border border-gray-100 group cursor-pointer">
            <div class="lg:w-1/2 relative h-72 lg:h-auto overflow-hidden">
                <img src="https://images.unsplash.com/photo-1556761175-5973dc0f32d7?q=80&w=1000&auto=format&fit=crop"
                    alt="Rapat Paripurna" class="w-full h-full object-cover group-hover:scale-105 transition duration-700">
                <span
                    class="absolute top-5 left-5 bg-red-500 text-white text-xs font-bold px-3 py-1.5 rounded-full flex items-center gap-1.5 shadow-md">
                    <i class="fa-solid fa-bolt"></i> FEATURED
                </span>
            </div>
            <div class="lg:w-1/2 p-8 md:p-12 flex flex-col justify-center">
                <div class="flex items-center gap-4 mb-4">
                    <span class="bg-purple-100 text-purple-700 text-xs font-bold px-3 py-1 rounded-full">Rapat
                        Paripurna</span>
                    <span class="text-gray-400 text-sm flex items-center gap-1.5 font-medium"><i
                            class="fa-regular fa-calendar"></i> 20 Februari 2026</span>
                </div>
                <h2
                    class="text-3xl font-bold text-gray-900 mb-4 leading-tight group-hover:text-purple-600 transition duration-300">
                    Rapat Paripurna Pembahasan APBD Provinsi Tapsel 2026</h2>
                <p class="text-gray-600 mb-8 leading-relaxed line-clamp-3">
                    DPRD Sumut menggelar rapat paripurna untuk membahas rancangan APBD tahun 2026 dengan fokus pada
                    pembangunan infrastruktur, peningkatan layanan kesehatan dan pendidikan, serta program kesejahteraan
                    masyarakat.
                </p>
                <a href="{{ route('berita.detail') }}"
                    class="bg-purple-600 hover:bg-purple-700 text-white px-7 py-3 rounded-xl font-bold text-sm w-max transition shadow-md flex items-center gap-2">
                    Baca Selengkapnya <i class="fa-solid fa-arrow-right"></i>
                </a>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 mb-16">

            <div
                class="bg-white rounded-2xl shadow-lg overflow-hidden border border-gray-100 group cursor-pointer flex flex-col">
                <div class="relative h-56 overflow-hidden">
                    <img src="https://images.unsplash.com/photo-1596422846543-75c6ff1978f4?q=80&w=600&auto=format&fit=crop"
                        class="w-full h-full object-cover group-hover:scale-110 transition duration-700">
                    <span
                        class="absolute bottom-4 left-4 bg-purple-600 text-white text-xs font-bold px-3 py-1 rounded-full shadow-md">Kunjungan
                        Kerja</span>
                </div>
                <div class="p-6 flex-grow flex flex-col">
                    <div class="flex items-center gap-2 text-purple-600 text-sm font-bold mb-3">
                        <i class="fa-regular fa-calendar"></i> 18 Februari 2026
                    </div>
                    <h3
                        class="text-xl font-bold text-gray-900 mb-3 leading-snug group-hover:text-purple-600 transition duration-300">
                        Kunjungan Kerja ke Kabupaten/Kota se-Tapsel</h3>
                    <p class="text-gray-500 text-sm mb-6 line-clamp-2 flex-grow">Anggota DPRD melakukan kunjungan ke
                        berbagai kabupaten/kota untuk menampung aspirasi masyarakat dan memantau proyek daerah.</p>
                    <a href="{{ route('berita.detail') }}"
                        class="text-purple-600 font-bold text-sm flex items-center gap-1.5 hover:underline mt-auto">Baca
                        Selengkapnya <i class="fa-solid fa-arrow-right"></i></a>
                </div>
            </div>

            <div
                class="bg-white rounded-2xl shadow-lg overflow-hidden border border-gray-100 group cursor-pointer flex flex-col">
                <div class="relative h-56 overflow-hidden">
                    <img src="https://images.unsplash.com/photo-1573164574572-cb89e39749b4?q=80&w=600&auto=format&fit=crop"
                        class="w-full h-full object-cover group-hover:scale-110 transition duration-700">
                    <span
                        class="absolute bottom-4 left-4 bg-purple-600 text-white text-xs font-bold px-3 py-1 rounded-full shadow-md">Hearing</span>
                </div>
                <div class="p-6 flex-grow flex flex-col">
                    <div class="flex items-center gap-2 text-purple-600 text-sm font-bold mb-3">
                        <i class="fa-regular fa-calendar"></i> 15 Februari 2026
                    </div>
                    <h3
                        class="text-xl font-bold text-gray-900 mb-3 leading-snug group-hover:text-purple-600 transition duration-300">
                        Hearing dengan Pelaku UMKM Tapanuli Selatan</h3>
                    <p class="text-gray-500 text-sm mb-6 line-clamp-2 flex-grow">Komisi Ekonomi DPRD menggelar hearing
                        dengan para pelaku UMKM membahas permasalahan dan solusi untuk mendukung perekonomian lokal.</p>
                    <a href="#"
                        class="text-purple-600 font-bold text-sm flex items-center gap-1.5 hover:underline mt-auto">Baca
                        Selengkapnya <i class="fa-solid fa-arrow-right"></i></a>
                </div>
            </div>

            <div
                class="bg-white rounded-2xl shadow-lg overflow-hidden border border-gray-100 group cursor-pointer flex flex-col">
                <div class="relative h-56 overflow-hidden">
                    <img src="https://images.unsplash.com/photo-1600880292203-757bb62b4baf?q=80&w=600&auto=format&fit=crop"
                        class="w-full h-full object-cover group-hover:scale-110 transition duration-700">
                    <span
                        class="absolute bottom-4 left-4 bg-purple-600 text-white text-xs font-bold px-3 py-1 rounded-full shadow-md">Peraturan
                        Daerah</span>
                </div>
                <div class="p-6 flex-grow flex flex-col">
                    <div class="flex items-center gap-2 text-purple-600 text-sm font-bold mb-3">
                        <i class="fa-regular fa-calendar"></i> 12 Februari 2026
                    </div>
                    <h3
                        class="text-xl font-bold text-gray-900 mb-3 leading-snug group-hover:text-purple-600 transition duration-300">
                        Pengesahan Perda tentang Retribusi Daerah</h3>
                    <p class="text-gray-500 text-sm mb-6 line-clamp-2 flex-grow">DPRD mengesahkan Peraturan Daerah tentang
                        Retribusi Daerah yang bertujuan meningkatkan pendapatan asli daerah.</p>
                    <a href="#"
                        class="text-purple-600 font-bold text-sm flex items-center gap-1.5 hover:underline mt-auto">Baca
                        Selengkapnya <i class="fa-solid fa-arrow-right"></i></a>
                </div>
            </div>

            <div
                class="bg-white rounded-2xl shadow-lg overflow-hidden border border-gray-100 group cursor-pointer flex flex-col">
                <div class="relative h-56 overflow-hidden">
                    <img src="https://images.unsplash.com/photo-1464029902022-f42944061a3c?q=80&w=600&auto=format&fit=crop"
                        class="w-full h-full object-cover group-hover:scale-110 transition duration-700">
                    <span
                        class="absolute bottom-4 left-4 bg-purple-600 text-white text-xs font-bold px-3 py-1 rounded-full shadow-md">Kegiatan
                        Sosial</span>
                </div>
                <div class="p-6 flex-grow flex flex-col">
                    <div class="flex items-center gap-2 text-purple-600 text-sm font-bold mb-3">
                        <i class="fa-regular fa-calendar"></i> 10 Februari 2026
                    </div>
                    <h3
                        class="text-xl font-bold text-gray-900 mb-3 leading-snug group-hover:text-purple-600 transition duration-300">
                        Rapat Koordinasi Program Kesejahteraan</h3>
                    <p class="text-gray-500 text-sm mb-6 line-clamp-2 flex-grow">Pimpinan DPRD melaksanakan rapat koordinasi
                        dengan pemerintah daerah membahas program kesejahteraan sosial untuk masyarakat tidak mampu.</p>
                    <a href="#"
                        class="text-purple-600 font-bold text-sm flex items-center gap-1.5 hover:underline mt-auto">Baca
                        Selengkapnya <i class="fa-solid fa-arrow-right"></i></a>
                </div>
            </div>

            <div
                class="bg-white rounded-2xl shadow-lg overflow-hidden border border-gray-100 group cursor-pointer flex flex-col">
                <div class="relative h-56 overflow-hidden">
                    <img src="https://images.unsplash.com/photo-1523240795612-9a054b0db644?q=80&w=600&auto=format&fit=crop"
                        class="w-full h-full object-cover group-hover:scale-110 transition duration-700">
                    <span
                        class="absolute bottom-4 left-4 bg-purple-600 text-white text-xs font-bold px-3 py-1 rounded-full shadow-md">Pendidikan</span>
                </div>
                <div class="p-6 flex-grow flex flex-col">
                    <div class="flex items-center gap-2 text-purple-600 text-sm font-bold mb-3">
                        <i class="fa-regular fa-calendar"></i> 8 Februari 2026
                    </div>
                    <h3
                        class="text-xl font-bold text-gray-900 mb-3 leading-snug group-hover:text-purple-600 transition duration-300">
                        Sosialisasi Program Beasiswa Pendidikan</h3>
                    <p class="text-gray-500 text-sm mb-6 line-clamp-2 flex-grow">Komisi Pendidikan DPRD menggelar
                        sosialisasi program beasiswa untuk pelajar dan mahasiswa berprestasi dari keluarga kurang mampu.</p>
                    <a href="#"
                        class="text-purple-600 font-bold text-sm flex items-center gap-1.5 hover:underline mt-auto">Baca
                        Selengkapnya <i class="fa-solid fa-arrow-right"></i></a>
                </div>
            </div>

        </div>

    </main>
@endsection
