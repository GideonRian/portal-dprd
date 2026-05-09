@extends('Non-Users.layouts.main')

@section('title', 'Kontak Kami')

@section('content')
<style>
    body {
        background-color: #fcfcfc; /* Latar belakang hampir putih polos sesuai desain */
    }
</style>

<main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12 lg:py-16">
    
    <div class="mb-10">
        <h1 class="text-3xl md:text-4xl font-bold text-gray-900 mb-2">Hubungi Kami</h1>
        <p class="text-gray-500 text-sm md:text-base">Silakan hubungi kami untuk informasi lebih lanjut</p>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
        
        <div class="lg:col-span-5 flex flex-col gap-6">
            
            <div class="bg-white p-8 rounded-2xl shadow-sm border border-gray-100">
                <h2 class="text-xl font-bold text-gray-900 mb-8">Informasi Kontak</h2>
                
                <div class="space-y-8">
                    <div class="flex items-start gap-4">
                        <div class="w-12 h-12 bg-blue-50 text-blue-600 rounded-full flex items-center justify-center text-xl flex-shrink-0">
                            <i class="fa-solid fa-location-dot"></i>
                        </div>
                        <div>
                            <h3 class="font-bold text-gray-900 text-sm mb-1">Alamat</h3>
                            <p class="text-gray-600 text-sm leading-relaxed">
                                Jl. Prof. Lafran Pane Kilang Papan,<br>
                                Sipirok, Kabupaten Tapanuli Selatan<br>
                                Sumatera Utara
                            </p>
                        </div>
                    </div>

                    <div class="flex items-start gap-4">
                        <div class="w-12 h-12 bg-blue-50 text-blue-600 rounded-full flex items-center justify-center text-xl flex-shrink-0">
                            <i class="fa-solid fa-phone"></i>
                        </div>
                        <div>
                            <h3 class="font-bold text-gray-900 text-sm mb-1">Telepon</h3>
                            <p class="text-gray-600 text-sm leading-relaxed">
                                (061) 123-4567<br>
                                (061) 123-4568 (Fax)
                            </p>
                        </div>
                    </div>

                    <div class="flex items-start gap-4">
                        <div class="w-12 h-12 bg-blue-50 text-blue-600 rounded-full flex items-center justify-center text-xl flex-shrink-0">
                            <i class="fa-solid fa-envelope"></i>
                        </div>
                        <div>
                            <h3 class="font-bold text-gray-900 text-sm mb-1">Email</h3>
                            <p class="text-gray-600 text-sm leading-relaxed">
                                sekretariatdprd@tapselkab.go.id
                            </p>
                        </div>
                    </div>

                    <div class="flex items-start gap-4">
                        <div class="w-12 h-12 bg-blue-50 text-blue-600 rounded-full flex items-center justify-center text-xl flex-shrink-0">
                            <i class="fa-solid fa-clock"></i>
                        </div>
                        <div>
                            <h3 class="font-bold text-gray-900 text-sm mb-1">Jam Operasional</h3>
                            <p class="text-gray-600 text-sm leading-relaxed">
                                Senin - Jumat: 08:00 - 16:00 WIB<br>
                                Sabtu - Minggu: Tutup
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="bg-[#f4f8ff] p-8 rounded-2xl border border-blue-100">
                <h2 class="text-lg font-bold text-blue-900 mb-5">Layanan Cepat</h2>
                <ul class="space-y-4">
                    <li>
                        <a href="{{ route('layanan.aspirasi') }}" class="flex items-center text-blue-600 hover:text-blue-800 text-sm font-medium transition">
                            <i class="fa-solid fa-arrow-right mr-3 text-xs"></i> Sampaikan Aspirasi
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('profil.anggota') }}" class="flex items-center text-blue-600 hover:text-blue-800 text-sm font-medium transition">
                            <i class="fa-solid fa-arrow-right mr-3 text-xs"></i> Lihat Profil Anggota
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('berita') }}" class="flex items-center text-blue-600 hover:text-blue-800 text-sm font-medium transition">
                            <i class="fa-solid fa-arrow-right mr-3 text-xs"></i> Baca Berita Terkini
                        </a>
                    </li>
                </ul>
            </div>

        </div>

        <div class="lg:col-span-7">
            <div class="bg-white p-8 rounded-2xl shadow-sm border border-gray-100 h-full flex flex-col">
                <h2 class="text-xl font-bold text-gray-900 mb-6">Lokasi</h2>
                
                <div class="w-full bg-gray-100 rounded-xl overflow-hidden mb-8 h-[350px] md:h-[400px] border border-gray-200">
                    <iframe 
                        src="https://maps.google.com/maps?q=Kantor+DPRD+Kabupaten+Tapanuli+Selatan,+Sipirok&t=&z=15&ie=UTF8&iwloc=&output=embed" 
                        width="100%" 
                        height="100%" 
                        style="border:0;" 
                        allowfullscreen="" 
                        loading="lazy" 
                        referrerpolicy="no-referrer-when-downgrade">
                    </iframe>
                </div>

                <div>
                    <h3 class="text-base font-bold text-gray-900 mb-4">Petunjuk Arah</h3>
                    <ul class="space-y-3 text-sm text-gray-600">
                        <li class="flex items-start">
                            <span class="text-gray-400 mr-2 mt-0.5">•</span> 
                            <span><strong>Dari Pusat Kota Padangsidimpuan:</strong> Ikuti jalan lintas Sumatera menuju arah Sipirok. Waktu tempuh kurang lebih 1 jam perjalanan.</span>
                        </li>
                        <li class="flex items-start">
                            <span class="text-gray-400 mr-2 mt-0.5">•</span> 
                            <span><strong>Dari Alun-Alun Sipirok:</strong> Lurus ikuti Jalan Prof. Lafran Pane sejauh 2 KM, Kantor DPRD berada di sebelah kanan jalan.</span>
                        </li>
                        <li class="flex items-start">
                            <span class="text-gray-400 mr-2 mt-0.5">•</span> 
                            <span><strong>Fasilitas Parkir:</strong> Tersedia area parkir gratis yang luas untuk pengunjung di bagian dalam gedung DPRD.</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

    </div>

</main>
@endsection