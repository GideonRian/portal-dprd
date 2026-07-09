@extends('Non-Users.layouts.main')

@section('title', 'Kontak Kami')

@section('content')
<style>
    body {
        background-color: #fafafa;
    }
    
    /* Dekorasi Background Blob */
    .bg-blob {
        position: absolute;
        filter: blur(80px);
        z-index: 0;
        opacity: 0.6;
        border-radius: 50%;
        animation: float 8s infinite ease-in-out;
    }

    @keyframes float {
        0%, 100% { transform: translateY(0) scale(1); }
        50% { transform: translateY(-20px) scale(1.05); }
    }
</style>

<main class="relative w-full overflow-hidden">
    <!-- Latar Belakang Dekoratif -->
    <div class="bg-blob bg-blue-200 w-96 h-96 top-10 left-[-100px]"></div>
    <div class="bg-blob bg-purple-200 w-80 h-80 bottom-20 right-[-50px]"></div>

    <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16 lg:py-20">
        
        <!-- Header Section -->
        <div class="mb-12 max-w-3xl">
            <span class="inline-block py-1 px-3 rounded-full bg-blue-100 text-blue-700 font-bold text-xs uppercase tracking-widest mb-4 border border-blue-200 shadow-sm">
                Pusat Layanan
            </span>
            <h1 class="text-4xl md:text-5xl font-extrabold text-gray-900 mb-4 tracking-tight">Hubungi Kami</h1>
            <p class="text-gray-500 text-base md:text-lg leading-relaxed">
                Kami selalu terbuka untuk mendengar aspirasi, saran, dan pertanyaan Anda. Silakan hubungi Sekretariat DPRD Kabupaten Tapanuli Selatan melalui saluran resmi di bawah ini.
            </p>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 lg:gap-10">
            
            <!-- KOLOM KIRI (Informasi & Link Cepat) -->
            <div class="lg:col-span-5 flex flex-col gap-8">
                
                <!-- Card Informasi Kontak -->
                <div class="bg-white/90 backdrop-blur-xl p-8 rounded-3xl shadow-lg shadow-gray-200/50 border border-gray-100 relative">
                    
                    <div class="flex items-center mb-8">
                        <div class="w-1.5 h-7 bg-blue-600 rounded-full mr-3"></div>
                        <h2 class="text-2xl font-extrabold text-gray-900">Informasi Kontak</h2>
                    </div>
                    
                    <div class="space-y-8">
                        <!-- Alamat -->
                        <div class="flex items-start">
                            <div class="w-12 h-12 bg-blue-50 text-blue-600 rounded-2xl flex items-center justify-center text-xl flex-shrink-0 mr-4 shadow-sm">
                                <i class="fa-solid fa-location-dot"></i>
                            </div>
                            <div>
                                <h3 class="font-bold text-gray-900 text-base mb-1">Alamat Kantor</h3>
                                <p class="text-gray-600 text-sm leading-relaxed">
                                    Jl. Prof. Lafran Pane Kilang Papan,<br>
                                    Sipirok, Kabupaten Tapanuli Selatan<br>
                                    Sumatera Utara
                                </p>
                            </div>
                        </div>

                        <!-- Telepon -->
                        <div class="flex items-start">
                            <div class="w-12 h-12 bg-blue-50 text-blue-600 rounded-2xl flex items-center justify-center text-xl flex-shrink-0 mr-4 shadow-sm">
                                <i class="fa-solid fa-phone"></i>
                            </div>
                            <div>
                                <h3 class="font-bold text-gray-900 text-base mb-1">Telepon & Fax</h3>
                                <p class="text-gray-600 text-sm leading-relaxed">
                                    (061) 123-4567<br>
                                    (061) 123-4568 (Fax)
                                </p>
                            </div>
                        </div>

                        <!-- Email -->
                        <div class="flex items-start">
                            <div class="w-12 h-12 bg-blue-50 text-blue-600 rounded-2xl flex items-center justify-center text-xl flex-shrink-0 mr-4 shadow-sm">
                                <i class="fa-solid fa-envelope"></i>
                            </div>
                            <div>
                                <h3 class="font-bold text-gray-900 text-base mb-1">Email Resmi</h3>
                                <p class="text-gray-600 text-sm leading-relaxed">
                                    sekretariatdprd@tapselkab.go.id
                                </p>
                            </div>
                        </div>

                        <!-- Jam Operasional -->
                        <div class="flex items-start">
                            <div class="w-12 h-12 bg-blue-50 text-blue-600 rounded-2xl flex items-center justify-center text-xl flex-shrink-0 mr-4 shadow-sm">
                                <i class="fa-solid fa-clock"></i>
                            </div>
                            <div>
                                <h3 class="font-bold text-gray-900 text-base mb-1">Jam Operasional</h3>
                                <p class="text-gray-600 text-sm leading-relaxed">
                                    Senin - Jumat: 08:00 - 16:00 WIB<br>
                                    <span class="text-red-500 font-medium">Sabtu - Minggu: Tutup</span>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Card Layanan Cepat -->
                <div class="bg-blue-50 p-8 rounded-3xl border border-blue-200 shadow-sm">
                    <div class="flex items-center mb-6">
                        <i class="fa-solid fa-bolt text-blue-600 text-xl mr-3"></i>
                        <h2 class="text-xl font-extrabold text-blue-900">Akses Cepat</h2>
                    </div>
                    
                    <ul class="space-y-4">
                        <li>
                            <a href="{{ route('layanan.aspirasi') }}" class="group flex items-center justify-between bg-white hover:bg-blue-600 px-5 py-4 rounded-2xl text-sm font-bold text-gray-700 hover:text-white transition-all duration-300 border border-gray-100 shadow-sm">
                                <div class="flex items-center">
                                    <div class="w-8 h-8 rounded-full bg-blue-50 group-hover:bg-white/20 flex items-center justify-center transition-colors mr-3">
                                        <i class="fa-regular fa-comment-dots text-blue-600 group-hover:text-white"></i>
                                    </div>
                                    Sampaikan Aspirasi
                                </div>
                                <i class="fa-solid fa-arrow-right transform group-hover:translate-x-1 transition-transform"></i>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('profil.anggota') }}" class="group flex items-center justify-between bg-white hover:bg-blue-600 px-5 py-4 rounded-2xl text-sm font-bold text-gray-700 hover:text-white transition-all duration-300 border border-gray-100 shadow-sm">
                                <div class="flex items-center">
                                    <div class="w-8 h-8 rounded-full bg-blue-50 group-hover:bg-white/20 flex items-center justify-center transition-colors mr-3">
                                        <i class="fa-solid fa-user-group text-blue-600 group-hover:text-white"></i>
                                    </div>
                                    Profil Anggota DPRD
                                </div>
                                <i class="fa-solid fa-arrow-right transform group-hover:translate-x-1 transition-transform"></i>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('berita') }}" class="group flex items-center justify-between bg-white hover:bg-blue-600 px-5 py-4 rounded-2xl text-sm font-bold text-gray-700 hover:text-white transition-all duration-300 border border-gray-100 shadow-sm">
                                <div class="flex items-center">
                                    <div class="w-8 h-8 rounded-full bg-blue-50 group-hover:bg-white/20 flex items-center justify-center transition-colors mr-3">
                                        <i class="fa-regular fa-newspaper text-blue-600 group-hover:text-white"></i>
                                    </div>
                                    Berita & Kegiatan
                                </div>
                                <i class="fa-solid fa-arrow-right transform group-hover:translate-x-1 transition-transform"></i>
                            </a>
                        </li>
                    </ul>
                </div>

            </div>

            <!-- KOLOM KANAN (Peta & Petunjuk) -->
            <div class="lg:col-span-7">
                <div class="bg-white/90 backdrop-blur-xl p-8 rounded-3xl shadow-lg shadow-gray-200/50 border border-gray-100 h-full flex flex-col">
                    
                    <div class="flex items-center mb-6">
                        <div class="w-1.5 h-7 bg-red-500 rounded-full mr-3"></div>
                        <h2 class="text-2xl font-extrabold text-gray-900">Peta Lokasi</h2>
                    </div>
                    
                    <div class="w-full bg-gray-100 rounded-2xl overflow-hidden mb-8 h-[350px] md:h-[450px] border border-gray-200 shadow-inner relative">
                        <div class="absolute inset-0 flex items-center justify-center bg-gray-50 -z-10">
                            <i class="fa-solid fa-spinner fa-spin text-3xl text-gray-300"></i>
                        </div>
                        <iframe 
                            src="https://maps.google.com/maps?q=Kantor+DPRD+Kabupaten+Tapanuli+Selatan,+Sipirok&t=&z=15&ie=UTF8&iwloc=&output=embed" 
                            width="100%" 
                            height="100%" 
                            style="border:0;" 
                            allowfullscreen="" 
                            loading="lazy" 
                            referrerpolicy="no-referrer-when-downgrade"
                            class="relative z-10">
                        </iframe>
                    </div>

                    <div class="bg-blue-50/50 p-6 rounded-2xl border border-blue-100/50">
                        <div class="flex items-center mb-5">
                            <i class="fa-solid fa-route text-blue-600 text-lg mr-2"></i>
                            <h3 class="text-lg font-bold text-gray-900">Panduan Rute Perjalanan</h3>
                        </div>
                        <ul class="space-y-4 text-sm text-gray-600">
                            <li class="flex items-start bg-white p-4 rounded-xl shadow-sm border border-gray-100 hover:border-blue-200 transition-colors">
                                <div class="mt-0.5 text-blue-500 mr-3"><i class="fa-solid fa-car-side"></i></div> 
                                <div>
                                    <strong class="text-gray-900 block mb-0.5">Dari Pusat Kota Padangsidimpuan:</strong> 
                                    Ikuti jalan lintas Sumatera menuju arah Sipirok. Waktu tempuh kurang lebih 1 jam perjalanan (tergantung kondisi lalu lintas).
                                </div>
                            </li>
                            <li class="flex items-start bg-white p-4 rounded-xl shadow-sm border border-gray-100 hover:border-blue-200 transition-colors">
                                <div class="mt-0.5 text-blue-500 mr-3"><i class="fa-solid fa-map-pin"></i></div> 
                                <div>
                                    <strong class="text-gray-900 block mb-0.5">Dari Alun-Alun Sipirok:</strong> 
                                    Lurus terus mengikuti Jalan Prof. Lafran Pane sejauh ± 2 KM. Gedung Kantor DPRD akan terlihat megah di sebelah kanan jalan.
                                </div>
                            </li>
                            <li class="flex items-start bg-white p-4 rounded-xl shadow-sm border border-gray-100 hover:border-blue-200 transition-colors">
                                <div class="mt-0.5 text-blue-500 mr-3"><i class="fa-solid fa-square-parking"></i></div> 
                                <div>
                                    <strong class="text-gray-900 block mb-0.5">Fasilitas Parkir:</strong> 
                                    Tersedia area parkir gratis, aman, dan luas yang dikhususkan untuk pengunjung tamu di bagian dalam kompleks gedung DPRD.
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

        </div>
    </div>
</main>
@endsection