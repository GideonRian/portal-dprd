@extends('Non-Users.layouts.main')

@section('title', 'Agenda Kegiatan')

@section('content')

    @php
        // Fungsi untuk mendapatkan singkatan bulan dalam Bahasa Indonesia
        function getBulanSingkat($tanggal)
        {
            $bulan = ['JAN', 'FEB', 'MAR', 'APR', 'MEI', 'JUN', 'JUL', 'AGS', 'SEP', 'OKT', 'NOV', 'DES'];
            $waktu = strtotime($tanggal);
            return $bulan[(int) date('n', $waktu) - 1];
        }

        // Fungsi untuk memberikan warna dinamis berdasarkan kategori
        function getKategoriColor($kategori)
        {
            $kat = strtolower($kategori);
            if (str_contains($kat, 'paripurna')) {
                return 'bg-blue-500';
            }
            if (str_contains($kat, 'hearing')) {
                return 'bg-green-500';
            }
            if (str_contains($kat, 'kunjungan')) {
                return 'bg-purple-500';
            }
            if (str_contains($kat, 'komisi')) {
                return 'bg-orange-500';
            }
            return 'bg-gray-500'; // Default color
        }
    @endphp

    <style>
        body {
            background-color: #f8fafc;
        }

        .hero-gradient {
            background: linear-gradient(to right, #1e3a8a, #2563eb);
        }
    </style>

    <main>
        <section class="hero-gradient pt-24 pb-32 px-4 relative overflow-hidden">
            <div class="absolute inset-0 opacity-10"
                style="background-image: radial-gradient(#ffffff 1px, transparent 1px); background-size: 30px 30px;"></div>

            <div class="max-w-4xl mx-auto text-center relative z-10">
                <div
                    class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-white/10 border border-white/20 text-white text-xs font-bold mb-6 backdrop-blur-sm">
                    <i class="fa-regular fa-calendar-days text-blue-200"></i>
                    <span>Agenda Kegiatan DPRD</span>
                </div>
                <h1 class="text-4xl md:text-5xl font-extrabold text-white mb-4 drop-shadow-md">Agenda Kegiatan</h1>
                <p class="text-blue-100 text-lg md:text-xl font-medium">Jadwal lengkap kegiatan, rapat, dan program kerja
                    DPRD Tapanuli Selatan</p>
            </div>

            <div class="absolute bottom-0 left-0 w-full overflow-hidden leading-none">
                <svg class="relative block w-full h-[50px] md:h-[80px]" data-name="Layer 1"
                    xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1200 120" preserveAspectRatio="none">
                    <path
                        d="M321.39,56.44c58-10.79,114.16-30.13,172-41.86,82.39-16.72,168.19-17.73,250.45-.39C823.78,31,906.67,72,985.66,92.83c70.05,18.48,146.53,26.09,214.34,3V120H0V95.8C59.71,118.06,158.51,122.5,225.15,105,257.06,96.51,290.7,82.5,321.39,56.44Z"
                        fill="#f8fafc"></path>
                </svg>
            </div>
        </section>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-20 -mt-16 md:-mt-20">

            <form action="{{ route('publik.agenda') }}" method="GET"
                class="bg-white rounded-2xl shadow-xl shadow-blue-900/5 p-4 border border-gray-100 mb-12 flex flex-col md:flex-row gap-4">

                <div class="flex-1 relative">
                    <i class="fa-solid fa-magnifying-glass absolute left-4 top-1/2 -translate-y-1/2 text-gray-400"></i>
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari agenda..."
                        class="w-full pl-11 pr-4 py-3.5 bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-blue-500 focus:bg-white outline-none text-sm font-medium transition">
                </div>

                <div class="flex-1 relative">
                    <i class="fa-solid fa-filter absolute left-4 top-1/2 -translate-y-1/2 text-gray-400"></i>
                    <select name="kategori"
                        class="w-full pl-11 pr-4 py-3.5 bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-blue-500 focus:bg-white outline-none text-sm font-medium appearance-none cursor-pointer transition">
                        <option value="">Semua Kategori</option>
                        <option value="Rapat Paripurna" {{ request('kategori') == 'Rapat Paripurna' ? 'selected' : '' }}>
                            Rapat Paripurna</option>
                        <option value="Kunjungan Kerja" {{ request('kategori') == 'Kunjungan Kerja' ? 'selected' : '' }}>
                            Kunjungan Kerja</option>
                        <option value="Hearing" {{ request('kategori') == 'Hearing' ? 'selected' : '' }}>Hearing</option>
                        <option value="Rapat Komisi" {{ request('kategori') == 'Rapat Komisi' ? 'selected' : '' }}>Rapat
                            Komisi</option>
                    </select>
                    <i
                        class="fa-solid fa-chevron-down absolute right-4 top-1/2 -translate-y-1/2 text-gray-400 pointer-events-none text-xs"></i>
                </div>

                <div class="flex-1 relative">
                    <i class="fa-regular fa-calendar absolute left-4 top-1/2 -translate-y-1/2 text-gray-400"></i>
                    <select name="bulan"
                        class="w-full pl-11 pr-4 py-3.5 bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-blue-500 focus:bg-white outline-none text-sm font-medium appearance-none cursor-pointer transition">
                        <option value="">Semua Bulan</option>
                        @for ($i = 1; $i <= 12; $i++)
                            {{-- FIX BUG BAHASA INGGRIS: Menggunakan Carbon dengan pemaksaan locale('id') --}}
                            <option value="{{ sprintf('%02d', $i) }}"
                                {{ request('bulan') == sprintf('%02d', $i) ? 'selected' : '' }}>
                                {{ \Carbon\Carbon::create()->month($i)->locale('id')->translatedFormat('F') }}
                            </option>
                        @endfor
                    </select>
                    <i
                        class="fa-solid fa-chevron-down absolute right-4 top-1/2 -translate-y-1/2 text-gray-400 pointer-events-none text-xs"></i>
                </div>

                <button type="submit"
                    class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-3.5 px-8 rounded-xl transition shadow-md shadow-blue-200">
                    Terapkan
                </button>
            </form>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-8 pb-20">
                @forelse ($agendas as $dataItem)
                    @php
                        $item = (object) $dataItem;
                        $itemId = $item->id ?? ($item->ID ?? 0);
                        $katColor = getKategoriColor($item->kategori ?? '');
                    @endphp

                    <div
                        class="bg-white rounded-3xl overflow-hidden shadow-sm hover:shadow-xl transition-all duration-300 border border-gray-100 flex flex-col group h-full transform hover:-translate-y-1">

                        <div class="relative h-60 bg-gray-200 overflow-hidden">
                            @if (!empty($item->gambar))
                                <img src="{{ asset('storage/' . $item->gambar) }}"
                                    class="w-full h-full object-cover group-hover:scale-105 transition duration-700">
                            @else
                                <div class="w-full h-full flex items-center justify-center bg-gray-100">
                                    <i class="fa-regular fa-image text-6xl text-gray-300"></i>
                                </div>
                            @endif

                            <div class="absolute inset-0 bg-gradient-to-t from-black/40 via-transparent to-transparent">
                            </div>

                            <div
                                class="absolute top-4 left-4 bg-white rounded-2xl shadow-lg flex flex-col items-center justify-center w-[70px] h-[75px] border-b-4 border-blue-600">
                                <span class="text-blue-600 font-black text-3xl leading-none">
                                    {{ date('d', strtotime($item->tanggal ?? now())) }}
                                </span>
                                <span class="text-gray-500 font-extrabold text-[11px] uppercase mt-1 tracking-widest">
                                    {{ getBulanSingkat($item->tanggal ?? now()) }}
                                </span>
                            </div>

                            <span
                                class="absolute top-5 right-5 {{ $katColor }} text-white text-[11px] font-bold px-4 py-1.5 rounded-full shadow-md uppercase tracking-wider">
                                {{ $item->kategori ?? 'Umum' }}
                            </span>
                        </div>

                        <div class="p-8 flex flex-col flex-1">
                            <h3
                                class="text-xl md:text-2xl font-black text-gray-900 mb-5 leading-snug group-hover:text-blue-600 transition line-clamp-2">
                                {{ $item->judul ?? 'Agenda Kegiatan' }}
                            </h3>

                            <div class="space-y-3 mb-6">
                                <div class="flex items-start gap-3 text-sm text-gray-600">
                                    <i class="fa-regular fa-clock text-blue-500 mt-0.5 w-4 text-center"></i>
                                    <span class="font-medium">{{ $item->waktu ?? '-' }}</span>
                                </div>

                                {{-- BARIS TANGGAL LENGKAP: Pemaksaan locale('id') agar 100% Bahasa Indonesia --}}
                                <div class="flex items-start gap-3 text-sm text-gray-600">
                                    <i class="fa-regular fa-calendar-check text-blue-500 mt-0.5 w-4 text-center"></i>
                                    <span
                                        class="font-medium">{{ \Carbon\Carbon::parse($item->tanggal ?? now())->locale('id')->translatedFormat('d F Y') }}</span>
                                </div>

                                <div class="flex items-start gap-3 text-sm text-gray-600">
                                    <i class="fa-solid fa-location-dot text-blue-500 mt-0.5 w-4 text-center"></i>
                                    <span class="font-medium">{{ $item->lokasi ?? '-' }}</span>
                                </div>
                                <div class="flex items-start gap-3 text-sm text-gray-600">
                                    <i class="fa-solid fa-user-group text-blue-500 mt-0.5 w-4 text-center"></i>
                                    <span class="font-medium line-clamp-1">{{ $item->peserta ?? '-' }}</span>
                                </div>
                            </div>

                            <p class="text-gray-500 text-sm leading-relaxed mb-6 line-clamp-2 flex-grow">
                                {{ $item->deskripsi ?? 'Tidak ada deskripsi rinci untuk agenda ini.' }}
                            </p>

                            <div class="mt-auto border-t border-gray-100 pt-5">
                                <a href="{{ $itemId !== 0 ? route('publik.agenda.detail', $itemId) : '#' }}"
                                    class="inline-flex items-center text-sm font-bold text-blue-600 hover:text-blue-800 transition group/link">
                                    Lihat Detail
                                    <i
                                        class="fa-solid fa-angle-right ml-2 text-xs transform group-hover/link:translate-x-1 transition"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                @empty
                    <div
                        class="col-span-1 md:col-span-2 text-center py-20 bg-white rounded-3xl shadow-sm border-2 border-dashed border-gray-200">
                        <i class="fa-regular fa-calendar-xmark text-6xl text-gray-300 mb-4"></i>
                        <h3 class="text-xl font-bold text-gray-900 mb-2">Tidak Ada Agenda</h3>
                        <p class="text-gray-500 font-medium">Belum ada agenda kegiatan yang sesuai dengan filter Anda saat
                            ini.</p>
                    </div>
                @endforelse
            </div>
        </div>
    </main>
@endsection
