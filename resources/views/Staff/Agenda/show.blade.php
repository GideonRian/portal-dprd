@extends('Staff.layouts.app')

@section('title', 'Detail Agenda')

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
            $hari = $hari_array[date('l', $waktu)];
            $tgl = date('j', $waktu);
            $bln = $bulan_array[(int) date('n', $waktu)];
            $thn = date('Y', $waktu);

            return "$hari, $tgl $bln $thn";
        }
    @endphp
    <div class="w-full px-4 sm:px-6 lg:px-8 py-10 max-w-4xl mx-auto">
        <a href="{{ route('staff.agenda.index') }}"
            class="inline-flex items-center text-orange-600 font-bold hover:underline mb-6 text-sm">
            <i class="fa-solid fa-arrow-left mr-2"></i> Kembali ke Daftar Agenda
        </a>

        <div class="bg-white rounded-3xl shadow-sm border border-gray-100 overflow-hidden">
            <!-- Banner/Gambar Agenda -->
            <div class="h-64 bg-gray-200 relative">
                @if ($agenda->gambar)
                    <img src="{{ asset('storage/' . $agenda->gambar) }}" class="w-full h-full object-cover">
                @else
                    <div class="w-full h-full flex items-center justify-center bg-orange-50">
                        <i class="fa-regular fa-image text-5xl text-orange-200"></i>
                    </div>
                @endif
                <div class="absolute top-4 left-4">
                    <span class="bg-blue-600 text-white px-4 py-1.5 rounded-full text-xs font-black uppercase shadow-lg">
                        {{ $agenda->kategori }}
                    </span>
                </div>
            </div>

            <div class="p-8">
                <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-8">
                    <h1 class="text-3xl font-black text-gray-900 leading-tight">{{ $agenda->judul }}</h1>
                    <span
                        class="{{ $agenda->status == 'Akan Datang' ? 'bg-blue-100 text-blue-600' : 'bg-green-100 text-green-600' }} px-4 py-2 rounded-xl text-sm font-bold whitespace-nowrap">
                        <i
                            class="fa-solid {{ $agenda->status == 'Akan Datang' ? 'fa-clock' : 'fa-circle-check' }} mr-2"></i>
                        {{ $agenda->status }}
                    </span>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-8">
                    <div class="space-y-4">
                        <div class="flex items-start gap-4">
                            <div class="w-10 h-10 bg-orange-50 rounded-xl flex items-center justify-center shrink-0">
                                <i class="fa-regular fa-calendar-days text-orange-500"></i>
                            </div>
                            <div>
                                <p class="text-xs font-bold text-gray-400 uppercase tracking-widest">Tanggal</p>
                                <p class="font-bold text-gray-800">{{ tanggalIndo($agenda->tanggal) }}</p>
                            </div>
                        </div>
                        <div class="flex items-start gap-4">
                            <div class="w-10 h-10 bg-orange-50 rounded-xl flex items-center justify-center shrink-0">
                                <i class="fa-regular fa-clock text-orange-500"></i>
                            </div>
                            <div>
                                <p class="text-xs font-bold text-gray-400 uppercase tracking-widest">Waktu</p>
                                <p class="font-bold text-gray-800">{{ $agenda->waktu }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="space-y-4">
                        <div class="flex items-start gap-4">
                            <div class="w-10 h-10 bg-orange-50 rounded-xl flex items-center justify-center shrink-0">
                                <i class="fa-solid fa-location-dot text-orange-500"></i>
                            </div>
                            <div>
                                <p class="text-xs font-bold text-gray-400 uppercase tracking-widest">Lokasi</p>
                                <p class="font-bold text-gray-800">{{ $agenda->lokasi }}</p>
                            </div>
                        </div>
                        <div class="flex items-start gap-4">
                            <div class="w-10 h-10 bg-orange-50 rounded-xl flex items-center justify-center shrink-0">
                                <i class="fa-solid fa-users text-orange-500"></i>
                            </div>
                            <div>
                                <p class="text-xs font-bold text-gray-400 uppercase tracking-widest">Peserta</p>
                                <p class="font-bold text-gray-800">{{ $agenda->peserta }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="border-t border-gray-100 pt-8">
                    <h3 class="text-lg font-bold text-gray-900 mb-4">Deskripsi Kegiatan</h3>
                    <div class="text-gray-600 leading-relaxed space-y-4">
                        {!! nl2br(e($agenda->deskripsi)) !!}
                    </div>
                </div>

                <div class="flex gap-4 mt-12 pt-8 border-t border-gray-100">
                    <a href="{{ route('staff.agenda.edit', $agenda->id) }}"
                        class="flex-1 bg-blue-600 text-white px-6 py-3.5 rounded-2xl font-bold text-center hover:bg-blue-700 transition shadow-lg shadow-blue-100">
                        <i class="fa-regular fa-pen-to-square mr-2"></i> Edit Agenda
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection
