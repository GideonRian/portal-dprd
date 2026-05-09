@extends('Non-Users.layouts.main')

@section('title', 'Detail Agenda')

@section('content')
<style>
    body { background-color: #f8fafc; }
</style>

<main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8 md:py-12 pb-20">
    
    <a href="{{ route('agenda') }}" class="inline-flex items-center text-gray-600 hover:text-blue-600 font-medium mb-6 transition group">
        <i class="fa-solid fa-arrow-left mr-2 transform group-hover:-translate-x-1 transition"></i> Kembali ke Agenda
    </a>

    <div class="relative w-full h-[300px] md:h-[400px] rounded-3xl overflow-hidden shadow-lg mb-8">
        <img src="https://images.unsplash.com/photo-1556761175-5973dc0f32d7?q=80&w=1200&auto=format&fit=crop" alt="Rapat Paripurna" class="w-full h-full object-cover">
        
        <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/30 to-transparent"></div>
        
        <div class="absolute top-6 right-6 bg-blue-600 text-white text-xs font-bold px-4 py-2 rounded-full shadow-md">
            Rapat Paripurna
        </div>

        <div class="absolute bottom-0 left-0 w-full p-6 md:p-10 text-white">
            <h1 class="text-3xl md:text-4xl lg:text-5xl font-bold leading-tight drop-shadow-md">Rapat Paripurna Pembahasan APBD 2027</h1>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        
        <div class="lg:col-span-2 space-y-6">
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 flex items-center gap-4">
                    <div class="w-14 h-14 bg-blue-50 text-blue-600 rounded-xl flex items-center justify-center text-2xl flex-shrink-0">
                        <i class="fa-regular fa-calendar-check"></i>
                    </div>
                    <div>
                        <p class="text-xs text-gray-500 font-medium mb-1">Tanggal</p>
                        <p class="text-base font-bold text-gray-900">Sabtu, 28 Maret 2026</p>
                    </div>
                </div>
                
                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 flex items-center gap-4">
                    <div class="w-14 h-14 bg-orange-50 text-orange-500 rounded-xl flex items-center justify-center text-2xl flex-shrink-0">
                        <i class="fa-regular fa-clock"></i>
                    </div>
                    <div>
                        <p class="text-xs text-gray-500 font-medium mb-1">Waktu</p>
                        <p class="text-base font-bold text-gray-900">09:00 - 12:00 WIB</p>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 flex items-center gap-4">
                <div class="w-14 h-14 bg-green-50 text-green-600 rounded-xl flex items-center justify-center text-2xl flex-shrink-0">
                    <i class="fa-solid fa-location-dot"></i>
                </div>
                <div>
                    <p class="text-xs text-gray-500 font-medium mb-1">Lokasi</p>
                    <p class="text-base font-bold text-gray-900">Ruang Paripurna Utama DPRD Tapsel</p>
                </div>
            </div>

            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 flex items-center gap-4">
                <div class="w-14 h-14 bg-purple-50 text-purple-600 rounded-xl flex items-center justify-center text-2xl flex-shrink-0">
                    <i class="fa-solid fa-user-group"></i>
                </div>
                <div>
                    <p class="text-xs text-gray-500 font-medium mb-1">Peserta</p>
                    <p class="text-base font-bold text-gray-900">Seluruh Anggota DPRD, Bupati, dan Tim Eksekutif</p>
                </div>
            </div>

            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-8">
                <h2 class="text-xl font-bold text-gray-900 mb-4">Deskripsi</h2>
                <p class="text-gray-600 leading-relaxed text-sm md:text-base">
                    Pembahasan dan persetujuan Anggaran Pendapatan dan Belanja Daerah tahun anggaran 2027. Rapat ini merupakan agenda penting dalam menentukan arah kebijakan pembangunan daerah untuk tahun mendatang. Rapat akan dipimpin langsung oleh Ketua DPRD dan dihadiri oleh seluruh fraksi untuk memberikan pandangan umumnya.
                </p>
            </div>

            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-8">
                <h2 class="text-xl font-bold text-gray-900 mb-6">Susunan Acara</h2>
                
                <div class="space-y-4">
                    <div class="flex items-center gap-4 bg-gray-50 p-3 rounded-xl border border-gray-100">
                        <div class="w-8 h-8 rounded-full bg-blue-600 text-white flex items-center justify-center font-bold text-sm flex-shrink-0">1</div>
                        <p class="text-gray-800 font-medium text-sm">Pembukaan oleh Ketua DPRD</p>
                    </div>
                    <div class="flex items-center gap-4 bg-gray-50 p-3 rounded-xl border border-gray-100">
                        <div class="w-8 h-8 rounded-full bg-blue-600 text-white flex items-center justify-center font-bold text-sm flex-shrink-0">2</div>
                        <p class="text-gray-800 font-medium text-sm">Laporan Bupati tentang RAPBD 2027</p>
                    </div>
                    <div class="flex items-center gap-4 bg-gray-50 p-3 rounded-xl border border-gray-100">
                        <div class="w-8 h-8 rounded-full bg-blue-600 text-white flex items-center justify-center font-bold text-sm flex-shrink-0">3</div>
                        <p class="text-gray-800 font-medium text-sm">Pembahasan dan tanggapan fraksi-fraksi</p>
                    </div>
                    <div class="flex items-center gap-4 bg-gray-50 p-3 rounded-xl border border-gray-100">
                        <div class="w-8 h-8 rounded-full bg-blue-600 text-white flex items-center justify-center font-bold text-sm flex-shrink-0">4</div>
                        <p class="text-gray-800 font-medium text-sm">Kesimpulan dan keputusan</p>
                    </div>
                    <div class="flex items-center gap-4 bg-gray-50 p-3 rounded-xl border border-gray-100">
                        <div class="w-8 h-8 rounded-full bg-blue-600 text-white flex items-center justify-center font-bold text-sm flex-shrink-0">5</div>
                        <p class="text-gray-800 font-medium text-sm">Penutupan</p>
                    </div>
                </div>
            </div>

        </div>

        <div class="lg:col-span-1 space-y-6">
            
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
                <h3 class="font-bold text-gray-900 mb-4">Aksi</h3>
                <div class="space-y-3">
                    <button class="w-full bg-[#2563eb] hover:bg-blue-700 text-white font-bold py-3 px-4 rounded-xl transition flex items-center justify-center gap-2 shadow-sm">
                        <i class="fa-solid fa-share-nodes"></i> Bagikan
                    </button>
                    <button class="w-full bg-white border-2 border-blue-600 text-blue-600 hover:bg-blue-50 font-bold py-3 px-4 rounded-xl transition flex items-center justify-center gap-2">
                        <i class="fa-regular fa-calendar-plus"></i> Tambah ke Kalender
                    </button>
                </div>
            </div>

            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
                <h3 class="font-bold text-gray-900 mb-4">Dokumen Terlampir</h3>
                
                <div class="space-y-3">
                    <a href="#" class="flex items-center justify-between p-3 rounded-xl border border-gray-100 hover:border-red-200 hover:bg-red-50 transition group">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 bg-red-100 text-red-500 rounded-lg flex items-center justify-center text-lg flex-shrink-0">
                                <i class="fa-solid fa-file-pdf"></i>
                            </div>
                            <div>
                                <p class="text-sm font-bold text-gray-900 leading-tight">Rancangan APBD 2027.pdf</p>
                                <p class="text-xs text-gray-500">2.5 MB</p>
                            </div>
                        </div>
                        <i class="fa-solid fa-download text-gray-400 group-hover:text-red-500 transition"></i>
                    </a>
                    
                    <a href="#" class="flex items-center justify-between p-3 rounded-xl border border-gray-100 hover:border-red-200 hover:bg-red-50 transition group">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 bg-red-100 text-red-500 rounded-lg flex items-center justify-center text-lg flex-shrink-0">
                                <i class="fa-solid fa-file-pdf"></i>
                            </div>
                            <div>
                                <p class="text-sm font-bold text-gray-900 leading-tight">Lampiran Teknis.pdf</p>
                                <p class="text-xs text-gray-500">1.8 MB</p>
                            </div>
                        </div>
                        <i class="fa-solid fa-download text-gray-400 group-hover:text-red-500 transition"></i>
                    </a>
                </div>
            </div>

            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
                <h3 class="font-bold text-gray-900 mb-4">Agenda Terkait</h3>
                
                <div class="space-y-4">
                    <a href="#" class="block p-4 rounded-xl border border-gray-100 hover:border-blue-300 hover:shadow-md transition group">
                        <h4 class="font-bold text-sm text-gray-900 mb-2 group-hover:text-blue-600 transition">Hearing dengan Asosiasi Petani Tapanuli Selatan</h4>
                        <div class="flex items-center justify-between">
                            <div class="flex items-center gap-2">
                                <span class="text-xs text-gray-500 font-medium">2026-03-30</span>
                                <span class="text-[10px] font-bold text-blue-600 bg-blue-50 px-2 py-0.5 rounded-full">Hearing</span>
                            </div>
                            <i class="fa-solid fa-angle-right text-gray-400 group-hover:text-blue-600"></i>
                        </div>
                    </a>

                    <a href="#" class="block p-4 rounded-xl border border-gray-100 hover:border-blue-300 hover:shadow-md transition group">
                        <h4 class="font-bold text-sm text-gray-900 mb-2 group-hover:text-blue-600 transition">Kunjungan Kerja ke Sipirok</h4>
                        <div class="flex items-center justify-between">
                            <div class="flex items-center gap-2">
                                <span class="text-xs text-gray-500 font-medium">2026-04-05</span>
                                <span class="text-[10px] font-bold text-blue-600 bg-blue-50 px-2 py-0.5 rounded-full">Kunjungan Kerja</span>
                            </div>
                            <i class="fa-solid fa-angle-right text-gray-400 group-hover:text-blue-600"></i>
                        </div>
                    </a>
                </div>
            </div>

        </div>

    </div>
</main>
@endsection