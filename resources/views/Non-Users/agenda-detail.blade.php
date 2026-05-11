@extends('Non-Users.layouts.main')

@section('title', $agenda->judul)

@section('content')
    @php
        function tanggalIndo($tanggal)
        {
            $hari_array = [
                'Sunday' => 'Minggu',
                'Monday' => 'Senin',
                'Tuesday' => 'Selasa',
                'Wednesday' => 'Rabu',
                'Thursday' => 'Kamis',
                'Friday' => 'Jumat',
                'Saturday' => 'Sabtu',
            ];
            $bulan_array = [
                1 => 'Januari',
                2 => 'Februari',
                3 => 'Maret',
                4 => 'April',
                5 => 'Mei',
                6 => 'Juni',
                7 => 'Juli',
                8 => 'Agustus',
                9 => 'September',
                10 => 'Oktober',
                11 => 'November',
                12 => 'Desember',
            ];
            $waktu = strtotime($tanggal);
            return $hari_array[date('l', $waktu)] .
                ', ' .
                date('j', $waktu) .
                ' ' .
                $bulan_array[(int) date('n', $waktu)] .
                ' ' .
                date('Y', $waktu);
        }
    @endphp

    <style>
        body {
            background-color: #f8fafc;
        }
    </style>

    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8 md:py-12 pb-20">

        <a href="{{ route('publik.agenda') }}"
            class="inline-flex items-center text-gray-600 hover:text-orange-600 font-medium mb-6 transition group">
            <i class="fa-solid fa-arrow-left mr-2 transform group-hover:-translate-x-1 transition"></i> Kembali ke Agenda
        </a>

        <!-- Banner Agenda -->
        <div class="relative w-full h-[300px] md:h-[400px] rounded-3xl overflow-hidden shadow-lg mb-8">
            @if ($agenda->gambar)
                <img src="{{ asset('storage/' . $agenda->gambar) }}" class="w-full h-full object-cover">
            @else
                <div class="w-full h-full bg-orange-100 flex items-center justify-center">
                    <i class="fa-regular fa-calendar-check text-8xl text-orange-200"></i>
                </div>
            @endif

            <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/30 to-transparent"></div>

            <div
                class="absolute top-6 right-6 bg-orange-600 text-white text-xs font-bold px-4 py-2 rounded-full shadow-md uppercase tracking-wider">
                {{ $agenda->kategori }}
            </div>

            <div class="absolute bottom-0 left-0 w-full p-6 md:p-10 text-white">
                <h1 class="text-3xl md:text-4xl lg:text-5xl font-bold leading-tight drop-shadow-md">{{ $agenda->judul }}
                </h1>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

            <div class="lg:col-span-2 space-y-6">

                <!-- Informasi Utama -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 flex items-center gap-4">
                        <div
                            class="w-14 h-14 bg-blue-50 text-blue-600 rounded-xl flex items-center justify-center text-2xl flex-shrink-0">
                            <i class="fa-regular fa-calendar-check"></i>
                        </div>
                        <div>
                            <p class="text-xs text-gray-500 font-medium mb-1">Tanggal</p>
                            <p class="text-base font-bold text-gray-900">{{ tanggalIndo($agenda->tanggal) }}</p>
                        </div>
                    </div>

                    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 flex items-center gap-4">
                        <div
                            class="w-14 h-14 bg-orange-50 text-orange-500 rounded-xl flex items-center justify-center text-2xl flex-shrink-0">
                            <i class="fa-regular fa-clock"></i>
                        </div>
                        <div>
                            <p class="text-xs text-gray-500 font-medium mb-1">Waktu</p>
                            <p class="text-base font-bold text-gray-900">{{ $agenda->waktu }}</p>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 flex items-center gap-4">
                    <div
                        class="w-14 h-14 bg-green-50 text-green-600 rounded-xl flex items-center justify-center text-2xl flex-shrink-0">
                        <i class="fa-solid fa-location-dot"></i>
                    </div>
                    <div>
                        <p class="text-xs text-gray-500 font-medium mb-1">Lokasi</p>
                        <p class="text-base font-bold text-gray-900">{{ $agenda->lokasi }}</p>
                    </div>
                </div>

                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 flex items-center gap-4">
                    <div
                        class="w-14 h-14 bg-purple-50 text-purple-600 rounded-xl flex items-center justify-center text-2xl flex-shrink-0">
                        <i class="fa-solid fa-user-group"></i>
                    </div>
                    <div>
                        <p class="text-xs text-gray-500 font-medium mb-1">Peserta</p>
                        <p class="text-base font-bold text-gray-900">{{ $agenda->peserta }}</p>
                    </div>
                </div>

                <!-- Deskripsi -->
                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-8">
                    <h2 class="text-xl font-bold text-gray-900 mb-4 border-l-4 border-orange-500 pl-4">Deskripsi Kegiatan
                    </h2>
                    <div class="text-gray-600 leading-relaxed text-sm md:text-base">
                        {!! nl2br(e($agenda->deskripsi)) !!}
                    </div>
                </div>

                <!-- Susunan Acara (Dinamis dari Baris Baru) -->
                @if ($agenda->susunan_acara)
                    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-8">
                        <h2 class="text-xl font-bold text-gray-900 mb-6">Susunan Acara</h2>
                        <div class="space-y-4">
                            @php
                                // Memecah teks berdasarkan baris baru
                                $poin_acara = explode("\n", str_replace("\r", '', $agenda->susunan_acara));
                            @endphp
                            @foreach ($poin_acara as $index => $poin)
                                @if (trim($poin) !== '')
                                    <div
                                        class="flex items-center gap-4 bg-gray-50 p-3 rounded-xl border border-gray-100 group hover:bg-orange-50 transition">
                                        <div
                                            class="w-8 h-8 rounded-full bg-orange-600 text-white flex items-center justify-center font-bold text-sm flex-shrink-0">
                                            {{ $index + 1 }}
                                        </div>
                                        <p class="text-gray-800 font-medium text-sm">{{ trim($poin) }}</p>
                                    </div>
                                @endif
                            @endforeach
                        </div>
                    </div>
                @endif

            </div>

            <!-- Sidebar -->
            <div class="lg:col-span-1 space-y-6">
                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 sticky top-24">
                    <h3 class="font-bold text-gray-900 mb-4">Agenda Terkait</h3>
                    <div class="space-y-4">
                        @forelse($related as $rel)
                            <a href="{{ route('publik.agenda.detail', $rel->id) }}"
                                class="block p-4 rounded-xl border border-gray-100 hover:border-orange-300 hover:shadow-md transition group">
                                <h4
                                    class="font-bold text-sm text-gray-900 mb-2 group-hover:text-orange-600 transition line-clamp-2">
                                    {{ $rel->judul }}</h4>
                                <div class="flex items-center justify-between">
                                    <span
                                        class="text-[10px] text-gray-500 font-medium">{{ tanggalIndo($rel->tanggal) }}</span>
                                    <i class="fa-solid fa-angle-right text-gray-400 group-hover:text-orange-600"></i>
                                </div>
                            </a>
                        @empty
                            <p class="text-xs text-gray-400 italic">Tidak ada agenda terkait lainnya.</p>
                        @endforelse
                    </div>
                </div>
            </div>

        </div>
    </main>
@endsection
