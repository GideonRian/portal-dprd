@extends('Non-Users.layouts.main')

@section('title', 'Agenda Kegiatan')

@section('content')
<style>
    body { background-color: #f8fafc; }
    /* Efek kurva halus di bagian bawah hero section */
    .hero-curve {
        border-bottom-left-radius: 2rem;
        border-bottom-right-radius: 2rem;
    }
</style>

<main class="w-full pb-20">
    
    <div class="bg-[#1e3a8a] pt-16 pb-28 md:pt-20 md:pb-32 px-4 text-center hero-curve relative">
        <div class="inline-flex items-center justify-center gap-2 px-4 py-1.5 rounded-full bg-white/10 border border-white/20 text-xs md:text-sm font-medium text-white mb-6 backdrop-blur-sm">
            <i class="fa-regular fa-calendar-days text-blue-300"></i> Agenda Kegiatan DPRD
        </div>
        <h1 class="text-3xl md:text-5xl font-bold text-white mb-4">Agenda Kegiatan</h1>
        <p class="text-blue-100 text-sm md:text-base max-w-2xl mx-auto">Jadwal lengkap kegiatan, rapat, dan program kerja DPRD Tapanuli Selatan</p>
    </div>

    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 -mt-12 md:-mt-16 relative z-10 mb-12">
        <div class="bg-white rounded-2xl shadow-xl border border-gray-100 p-4">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                        <i class="fa-solid fa-magnifying-glass text-gray-400"></i>
                    </div>
                    <input type="text" placeholder="Cari agenda..." class="w-full pl-11 pr-4 py-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none text-sm transition">
                </div>
                
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                        <i class="fa-solid fa-filter text-gray-400"></i>
                    </div>
                    <select class="w-full pl-11 pr-10 py-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none text-sm appearance-none bg-white text-gray-700 transition cursor-pointer">
                        <option value="">Semua Kategori</option>
                        <option value="paripurna">Rapat Paripurna</option>
                        <option value="hearing">Hearing</option>
                        <option value="kunjungan">Kunjungan Kerja</option>
                        <option value="komisi">Rapat Komisi</option>
                        <option value="sosialisasi">Sosialisasi</option>
                        <option value="koordinasi">Rapat Koordinasi</option>
                    </select>
                    <div class="absolute inset-y-0 right-0 pr-4 flex items-center pointer-events-none">
                        <i class="fa-solid fa-chevron-down text-gray-400 text-xs"></i>
                    </div>
                </div>
                
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                        <i class="fa-regular fa-calendar text-gray-400"></i>
                    </div>
                    <input type="date" class="w-full pl-11 pr-4 py-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none text-sm text-gray-600 transition">
                </div>

            </div>
        </div>
    </div>

    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            
            @php
                $agendas = [
                    [
                        'tgl' => '28', 'bln' => 'MAR', 'kategori' => 'Rapat Paripurna', 'color' => 'bg-blue-600',
                        'judul' => 'Rapat Paripurna Pembahasan APBD 2027',
                        'waktu' => '09:00 - 12:00 WIB', 'lokasi' => 'Ruang Paripurna Utama DPRD Tapsel', 'peserta' => 'Seluruh Anggota DPRD, Bupati, dan Tim Eksekutif',
                        'deskripsi' => 'Pembahasan dan persetujuan Anggaran Pendapatan dan Belanja Daerah tahun anggaran 2027.',
                        'img' => 'https://images.unsplash.com/photo-1556761175-5973dc0f32d7?q=80&w=800&auto=format&fit=crop'
                    ],
                    [
                        'tgl' => '30', 'bln' => 'MAR', 'kategori' => 'Hearing', 'color' => 'bg-[#059669]',
                        'judul' => 'Hearing dengan Asosiasi Petani Tapanuli Selatan',
                        'waktu' => '13:00 - 16:00 WIB', 'lokasi' => 'Ruang Komisi II DPRD Tapsel', 'peserta' => 'Komisi II DPRD, Asosiasi Petani, Dinas Pertanian',
                        'deskripsi' => 'Dialog dan pembahasan kebijakan pertanian untuk meningkatkan kesejahteraan petani di Tapanuli Selatan.',
                        'img' => 'https://images.unsplash.com/photo-1595804364239-c1e13eb98db5?q=80&w=800&auto=format&fit=crop'
                    ],
                    [
                        'tgl' => '5', 'bln' => 'APR', 'kategori' => 'Kunjungan Kerja', 'color' => 'bg-purple-600',
                        'judul' => 'Kunjungan Kerja ke Kabupaten Sipirok',
                        'waktu' => '08:00 - 17:00 WIB', 'lokasi' => 'Sipirok', 'peserta' => 'Pansus Pembangunan DPRD, Bupati Deli Serdang',
                        'deskripsi' => 'Kunjungan kerja dan tinjauan pembangunan infrastruktur serta penampungan aspirasi masyarakat Sipirok.',
                        'img' => 'https://images.unsplash.com/photo-1596422846543-75c6ff1978f4?q=80&w=800&auto=format&fit=crop'
                    ],
                    [
                        'tgl' => '8', 'bln' => 'APR', 'kategori' => 'Rapat Komisi', 'color' => 'bg-orange-500',
                        'judul' => 'Rapat Komisi II - Pembahasan Infrastruktur',
                        'waktu' => '10:00 - 14:00 WIB', 'lokasi' => 'Ruang Komisi II DPRD Tapsel', 'peserta' => 'Anggota Komisi II, Dinas PUPR',
                        'deskripsi' => 'Evaluasi dan pembahasan proyek infrastruktur jalan dan jembatan di wilayah Tapanuli Selatan.',
                        'img' => 'https://images.unsplash.com/photo-1517245386807-bb43f82c33c4?q=80&w=800&auto=format&fit=crop'
                    ],
                    [
                        'tgl' => '12', 'bln' => 'APR', 'kategori' => 'Sosialisasi', 'color' => 'bg-pink-600',
                        'judul' => 'Sosialisasi Perda Perlindungan Lingkungan',
                        'waktu' => '09:00 - 12:00 WIB', 'lokasi' => 'Gedung Serbaguna DPRD Tapsel', 'peserta' => 'Komisi IV, Dinas LH, Masyarakat, LSM',
                        'deskripsi' => 'Sosialisasi Peraturan Daerah tentang Perlindungan dan Pengelolaan Lingkungan Hidup kepada masyarakat dan stakeholder.',
                        'img' => 'https://images.unsplash.com/photo-1542601906990-b4d3fb778b09?q=80&w=800&auto=format&fit=crop'
                    ],
                    [
                        'tgl' => '15', 'bln' => 'APR', 'kategori' => 'Hearing', 'color' => 'bg-[#059669]',
                        'judul' => 'Hearing dengan Pelaku UMKM',
                        'waktu' => '13:00 - 17:00 WIB', 'lokasi' => 'Ruang Auditorium DPRD Tapsel', 'peserta' => 'Komisi I, Pelaku UMKM, Dinas Koperasi & UMKM',
                        'deskripsi' => 'Menampung aspirasi dan membahas solusi untuk pengembangan UMKM di era digital.',
                        'img' => 'https://images.unsplash.com/photo-1556742049-0cfed4f6a45d?q=80&w=800&auto=format&fit=crop'
                    ],
                    [
                        'tgl' => '18', 'bln' => 'APR', 'kategori' => 'Rapat Koordinasi', 'color' => 'bg-blue-600',
                        'judul' => 'Rapat Koordinasi dengan SKPD',
                        'waktu' => '09:00 - 12:00 WIB', 'lokasi' => 'Ruang Rapat Pimpinan DPRD Tapsel', 'peserta' => 'Pimpinan DPRD, Sekretaris Daerah, Kepala SKPD',
                        'deskripsi' => 'Koordinasi pelaksanaan program dan kegiatan antara DPRD dengan seluruh Satuan Kerja Perangkat Daerah.',
                        'img' => 'https://images.unsplash.com/photo-1600880292203-757bb62b4baf?q=80&w=800&auto=format&fit=crop'
                    ],
                    [
                        'tgl' => '22', 'bln' => 'APR', 'kategori' => 'Kunjungan Kerja', 'color' => 'bg-purple-600',
                        'judul' => 'Kunjungan Kerja ke Batang Toru',
                        'waktu' => '08:00 - 17:00 WIB', 'lokasi' => 'Kecamatan Batang Toru', 'peserta' => 'Komisi III & V',
                        'deskripsi' => 'Kunjungan kerja lapangan untuk meninjau fasilitas kesehatan dan pendidikan di Kecamatan Batang Toru.',
                        'img' => 'https://images.unsplash.com/photo-1464029902022-f42944061a3c?q=80&w=800&auto=format&fit=crop'
                    ]
                ];
            @endphp

            @foreach($agendas as $agenda)
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden group hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1 flex flex-col">
                
                <div class="relative h-56 overflow-hidden">
                    <img src="{{ $agenda['img'] }}" alt="{{ $agenda['judul'] }}" class="w-full h-full object-cover group-hover:scale-105 transition duration-500">
                    
                    <div class="absolute top-4 left-4 bg-white rounded-xl shadow-lg px-3 py-1.5 flex flex-col items-center justify-center min-w-[56px]">
                        <span class="text-xl font-black text-blue-700 leading-none mb-0.5">{{ $agenda['tgl'] }}</span>
                        <span class="text-[10px] font-bold text-gray-500 uppercase tracking-widest">{{ $agenda['bln'] }}</span>
                    </div>

                    <div class="absolute top-4 right-4 {{ $agenda['color'] }} text-white text-[10px] font-bold px-3 py-1.5 rounded-full shadow-md">
                        {{ $agenda['kategori'] }}
                    </div>
                </div>

                <div class="p-6 md:p-8 flex flex-col flex-grow">
                    <h2 class="text-xl font-bold text-gray-900 mb-5 leading-snug group-hover:text-blue-600 transition-colors">{{ $agenda['judul'] }}</h2>
                    
                    <div class="space-y-3 mb-6">
                        <div class="flex items-start gap-3 text-sm text-gray-600">
                            <i class="fa-regular fa-clock mt-0.5 text-blue-500 w-4 text-center"></i>
                            <span>{{ $agenda['waktu'] }}</span>
                        </div>
                        <div class="flex items-start gap-3 text-sm text-gray-600">
                            <i class="fa-solid fa-location-dot mt-0.5 text-blue-500 w-4 text-center"></i>
                            <span class="leading-tight">{{ $agenda['lokasi'] }}</span>
                        </div>
                        <div class="flex items-start gap-3 text-sm text-gray-600">
                            <i class="fa-solid fa-user-group mt-0.5 text-blue-500 w-4 text-center"></i>
                            <span class="leading-tight">{{ $agenda['peserta'] }}</span>
                        </div>
                    </div>

                    <p class="text-gray-500 text-sm mb-6 line-clamp-2 leading-relaxed flex-grow">
                        {{ $agenda['deskripsi'] }}
                    </p>

                    <div class="mt-auto pt-4 border-t border-gray-100">
                        <a href="{{ route('agenda.detail') }}" class="inline-flex items-center text-sm font-bold text-blue-600 hover:text-blue-800 transition-colors">
                            Lihat Detail <i class="fa-solid fa-angle-right ml-2 text-xs"></i>
                        </a>
                    </div>
                </div>
            </div>
            @endforeach

        </div>
    </div>
</main>
@endsection