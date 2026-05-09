@extends('Non-Users.layouts.main')

@section('title', 'Lacak Aspirasi')

@section('content')
<main class="max-w-4xl mx-auto px-4 py-12">

    <div class="text-center mb-8">
        <div class="inline-flex items-center justify-center w-16 h-16 rounded-2xl bg-blue-600 text-white shadow-lg mb-6">
            <i class="fa-solid fa-message text-2xl"></i>
        </div>
        <h1 class="text-3xl font-bold text-gray-900 mb-2">Layanan Aspirasi Masyarakat</h1>
        <p class="text-gray-600 text-sm md:text-base">Suara Anda adalah prioritas kami. Sampaikan aspirasi, saran, atau keluhan untuk pembangunan Tapanuli Selatan yang lebih baik.</p>
    </div>

    <div class="flex justify-center mb-10">
        <div class="bg-white p-1 rounded-xl shadow-sm border border-gray-200 inline-flex">
            <a href="{{ route('layanan.aspirasi') }}" class="text-gray-600 hover:bg-gray-50 px-6 py-2.5 rounded-lg font-medium text-sm flex items-center gap-2 transition">
                <i class="fa-regular fa-message"></i> Kirim Aspirasi
            </a>
            <a href="{{ route('layanan.aspirasi.lacak') }}" class="bg-[#059669] text-white px-6 py-2.5 rounded-lg font-semibold text-sm flex items-center gap-2 shadow-sm">
                <i class="fa-solid fa-magnifying-glass"></i> Lacak Status
            </a>
        </div>
    </div>

    <div class="bg-white rounded-3xl shadow-xl border border-gray-100 overflow-hidden max-w-3xl mx-auto p-6 md:p-10">
        
        <div class="text-center mb-8">
            <div class="w-16 h-16 bg-[#059669] text-white rounded-full flex items-center justify-center text-2xl mx-auto mb-4 shadow-md shadow-green-200">
                <i class="fa-solid fa-magnifying-glass"></i>
            </div>
            <h2 class="text-2xl font-bold text-gray-900">Lacak Status Aspirasi</h2>
            <p class="text-gray-500 text-sm mt-1">Masukkan kode tracking untuk melihat status dan perkembangan aspirasi Anda</p>
        </div>

        <form action="{{ route('aspirasi.lacak.cari') }}" method="GET" class="mb-8 relative">
            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-gray-400">
                <i class="fa-solid fa-magnifying-glass"></i>
            </div>
            <input type="text" name="tracking_code" required value="{{ request('tracking_code', $aspirasi->tracking_code ?? '') }}"
                placeholder="ASP-20260302-0001"
                class="w-full pl-11 pr-32 py-4 border-2 border-gray-200 rounded-xl focus:ring-0 focus:border-[#059669] outline-none transition text-gray-700 font-mono text-sm uppercase">
            
            <div class="absolute inset-y-1.5 right-1.5">
                <button type="submit" class="bg-[#059669] text-white px-6 py-2.5 rounded-lg font-bold hover:bg-green-700 transition shadow-sm flex items-center gap-2 h-full">
                    <i class="fa-solid fa-magnifying-glass text-sm"></i> Lacak
                </button>
            </div>
            <p class="text-[10px] text-gray-400 mt-2 ml-1">Format kode: ASP-YYYYMMDD-XXXX (contoh: ASP-20260302-0001)</p>

            @if(session('error'))
            <p class="text-red-500 text-sm mt-2 font-medium"><i class="fa-solid fa-circle-exclamation mr-1"></i> {{ session('error') }}</p>
            @endif
        </form>

        @if(isset($aspirasi))
        <div class="border border-gray-200 rounded-2xl overflow-hidden shadow-sm">
            
            <div class="bg-[#059669] p-6 text-white flex flex-col md:flex-row md:justify-between md:items-start gap-4">
                <div>
                    <p class="text-xs text-green-100 uppercase tracking-widest mb-1 font-medium">Kode Tracking</p>
                    <h3 class="text-xl font-bold font-mono tracking-wider mb-2">{{ $aspirasi->tracking_code }}</h3>
                    <p class="font-bold text-lg leading-tight">{{ $aspirasi->judul }}</p>
                </div>
                <div class="inline-flex items-center gap-2 bg-[#fef08a] text-yellow-800 px-4 py-2 rounded-lg font-bold text-sm shadow-sm whitespace-nowrap">
                    <i class="fa-regular fa-clock"></i> {{ $aspirasi->status == 'Diproses' ? 'Menunggu Peninjauan' : $aspirasi->status }}
                </div>
            </div>

            <div class="p-6 md:p-8 space-y-8 bg-white">
                
                <div>
                    <h4 class="font-bold text-gray-900 mb-5 text-lg">Detail Aspirasi</h4>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-y-6 gap-x-4 mb-6">
                        <div>
                            <p class="text-xs text-gray-500 mb-1">Nama Pelapor</p>
                            <p class="font-bold text-gray-900 text-sm">{{ $aspirasi->nama }}</p>
                        </div>
                        <div>
                            <p class="text-xs text-gray-500 mb-1">Tanggal Submit</p>
                            <p class="font-bold text-gray-900 text-sm">{{ date('Y-m-d', strtotime($aspirasi->tgl_masuk)) }}</p>
                        </div>
                        <div>
                            <p class="text-xs text-gray-500 mb-1">Kategori</p>
                            <span class="bg-purple-100 text-purple-700 px-3 py-1 rounded-md text-xs font-bold">{{ $aspirasi->kategori }}</span>
                        </div>
                        <div>
                            <p class="text-xs text-gray-500 mb-1">Lokasi Kejadian</p>
                            <p class="font-bold text-gray-900 text-sm font-mono text-[11px]">{{ $aspirasi->lokasi ?? 'Sipirok (Valid)' }}</p>
                        </div>
                    </div>
                    <div>
                        <p class="text-xs text-gray-500 mb-2">Isi Aspirasi</p>
                        <p class="text-gray-700 text-sm leading-relaxed">
                            {{ $aspirasi->isi }}
                        </p>
                    </div>
                </div>

                <hr class="border-gray-100">

                <div>
                    <h4 class="font-bold text-gray-900 mb-6 text-lg flex items-center gap-2">
                        <i class="fa-regular fa-clock text-blue-600"></i> Timeline Perkembangan
                    </h4>
                    
                    <div class="space-y-0">
                        <div class="flex gap-4">
                            <div class="flex flex-col items-center">
                                <div class="w-10 h-10 rounded-full bg-[#fef08a] text-yellow-700 flex items-center justify-center shadow-sm z-10">
                                    <i class="fa-regular fa-clock"></i>
                                </div>
                                <div class="w-0.5 h-full bg-gray-200 mt-2 min-h-[40px]"></div>
                            </div>
                            <div class="pb-8 pt-1.5">
                                <div class="flex flex-wrap items-baseline gap-2 mb-1">
                                    <h5 class="font-bold text-gray-900 text-sm md:text-base">Menunggu Peninjauan</h5>
                                    <span class="text-xs text-gray-500">{{ date('d F Y \p\u\k\u\l H:i', strtotime($aspirasi->tgl_masuk)) }}</span>
                                </div>
                                <p class="text-sm text-gray-600 mb-1">Aspirasi diterima dan menunggu peninjauan</p>
                                <p class="text-[10px] text-gray-400 uppercase tracking-wide">Diupdate oleh: System</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="bg-blue-50 border border-blue-100 rounded-xl p-5 flex items-start gap-4">
                    <i class="fa-solid fa-circle-info text-blue-600 mt-0.5 text-lg"></i>
                    <div>
                        <h5 class="font-bold text-blue-900 mb-1 text-sm">Informasi Penting</h5>
                        <p class="text-blue-700 text-xs leading-relaxed">
                            Status aspirasi akan diperbarui secara berkala. Jika ada pertanyaan lebih lanjut, silakan hubungi layanan kami di email: aspirasi@dprd-tapsel.go.id atau telepon (061) 123-4567
                        </p>
                    </div>
                </div>

            </div>
        </div>
        @endif

    </div>

</main>
@endsection