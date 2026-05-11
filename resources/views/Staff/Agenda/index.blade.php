@extends('Staff.layouts.app')

@section('title', 'Kelola Agenda')

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
    <div class="w-full px-4 sm:px-6 lg:px-8 py-8 max-w-screen-xl mx-auto">

        <!-- HEADER: Judul & Tombol Tambah -->
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 mb-8">
            <div class="flex items-center gap-4">
                <div class="w-14 h-14 bg-orange-500 rounded-2xl flex items-center justify-center text-white shadow-md">
                    <i class="fa-regular fa-calendar text-2xl"></i>
                </div>
                <div>
                    <h2 class="text-3xl font-extrabold text-gray-900 mb-1">Kelola Agenda Kegiatan</h2>
                    <p class="text-gray-500 font-medium text-sm">Tambah, edit, atau hapus jadwal kegiatan DPRD</p>
                </div>
            </div>
            <a href="{{ route('staff.agenda.create') }}"
                class="bg-orange-500 hover:bg-orange-600 text-white px-6 py-3 rounded-xl font-bold transition shadow-md flex items-center gap-2">
                <i class="fa-solid fa-plus"></i> Tambah Agenda
            </a>
        </div>

        <!-- NOTIFIKASI SUKSES -->
        @if (session('success'))
            <div class="bg-green-100 border-l-4 border-green-500 text-green-700 px-4 py-3 rounded-xl mb-6 shadow-sm">
                <i class="fa-solid fa-check-circle mr-1"></i> {{ session('success') }}
            </div>
        @endif

        <!-- KARTU STATISTIK -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
            <div class="bg-white p-6 rounded-2xl shadow-sm border-l-4 border-blue-500 flex justify-between items-center">
                <div>
                    <p class="text-sm text-gray-500 font-bold uppercase">Total Agenda</p>
                    <h3 class="text-3xl font-black text-gray-800">{{ $stats['total'] }}</h3>
                </div>
                <i class="fa-solid fa-layer-group text-3xl text-gray-200"></i>
            </div>
            <div class="bg-white p-6 rounded-2xl shadow-sm border-l-4 border-orange-500 flex justify-between items-center">
                <div>
                    <p class="text-sm text-gray-500 font-bold uppercase">Akan Datang</p>
                    <h3 class="text-3xl font-black text-gray-800">{{ $stats['mendatang'] }}</h3>
                </div>
                <i class="fa-solid fa-clock text-3xl text-gray-200"></i>
            </div>
            <div class="bg-white p-6 rounded-2xl shadow-sm border-l-4 border-green-500 flex justify-between items-center">
                <div>
                    <p class="text-sm text-gray-500 font-bold uppercase">Selesai</p>
                    <h3 class="text-3xl font-black text-gray-800">{{ $stats['selesai'] }}</h3>
                </div>
                <i class="fa-solid fa-circle-check text-3xl text-gray-200"></i>
            </div>
        </div>

        <!-- FILTER & PENCARIAN -->
        <form action="{{ route('staff.agenda.index') }}" method="GET" class="flex flex-col md:flex-row gap-4 mb-8">
            <div class="relative flex-1">
                <i class="fa-solid fa-magnifying-glass absolute left-4 top-1/2 -translate-y-1/2 text-gray-400"></i>
                <input type="text" name="search" value="{{ $search }}" placeholder="Cari agenda..."
                    class="w-full pl-11 pr-4 py-3 bg-white border border-gray-200 rounded-xl focus:ring-2 focus:ring-orange-500 outline-none text-sm">
            </div>
            <div class="md:w-64 relative">
                <select name="kategori" onchange="this.form.submit()"
                    class="w-full px-4 py-3 bg-white border border-gray-200 rounded-xl focus:ring-2 focus:ring-orange-500 outline-none text-sm appearance-none cursor-pointer">
                    <option value="Semua Kategori">Semua Kategori</option>
                    <option value="Rapat Paripurna" {{ $kategori == 'Rapat Paripurna' ? 'selected' : '' }}>Rapat Paripurna
                    </option>
                    <option value="Kunjungan Kerja" {{ $kategori == 'Kunjungan Kerja' ? 'selected' : '' }}>Kunjungan Kerja
                    </option>
                    <option value="Hearing" {{ $kategori == 'Hearing' ? 'selected' : '' }}>Hearing</option>
                    <option value="Rapat Komisi" {{ $kategori == 'Rapat Komisi' ? 'selected' : '' }}>Rapat Komisi</option>
                    <option value="Sosialisasi" {{ $kategori == 'Sosialisasi' ? 'selected' : '' }}>Sosialisasi</option>
                </select>
                <i
                    class="fa-solid fa-chevron-down absolute right-4 top-1/2 -translate-y-1/2 text-gray-400 pointer-events-none"></i>
            </div>
        </form>

        <!-- DAFTAR AGENDA -->
        <div class="space-y-4">
            @forelse($agendas as $item)
                <div
                    class="bg-white rounded-3xl p-6 border border-gray-100 shadow-sm hover:shadow-md transition flex flex-col md:flex-row gap-6 relative overflow-hidden">

                    <!-- Garis Warna Samping (Aksen Desain) -->
                    <div
                        class="absolute left-0 top-0 bottom-0 w-1.5 {{ $item->status == 'Akan Datang' ? 'bg-blue-500' : 'bg-green-500' }}">
                    </div>

                    <div class="flex-1">
                        <div class="flex items-center justify-between mb-3">
                            <span
                                class="bg-blue-50 text-blue-600 px-3 py-1 rounded-full text-[10px] font-black uppercase tracking-wider">
                                {{ $item->kategori }}
                            </span>
                            <span
                                class="{{ $item->status == 'Akan Datang' ? 'text-blue-500' : 'text-green-500' }} text-xs font-bold flex items-center gap-1">
                                <i
                                    class="fa-solid {{ $item->status == 'Akan Datang' ? 'fa-clock' : 'fa-circle-check' }}"></i>
                                {{ $item->status }}
                            </span>
                        </div>

                        <h3 class="text-xl font-bold text-gray-900 mb-2">{{ $item->judul }}</h3>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-y-2 text-sm text-gray-500 mb-4">
                            <div class="flex items-center gap-2">
                                <i class="fa-regular fa-calendar-days text-orange-500 w-4"></i>
                                {{ tanggalIndo($item->tanggal) }}
                            </div>
                            <div class="flex items-center gap-2">
                                <i class="fa-regular fa-clock text-orange-500 w-4"></i>
                                {{ $item->waktu }}
                            </div>
                            <div class="flex items-center gap-2 md:col-span-2">
                                <i class="fa-solid fa-location-dot text-orange-500 w-4"></i>
                                {{ $item->lokasi }}
                            </div>
                        </div>

                        <p class="text-gray-600 text-sm line-clamp-2 mb-2">{{ $item->deskripsi }}</p>
                    </div>

                    <!-- TOMBOL AKSI (LIHAT, EDIT, HAPUS) -->
                    <div class="flex flex-row md:flex-col gap-2 shrink-0 justify-center">
                        <a href="{{ route('staff.agenda.show', $item->id) }}"
                            class="flex-1 md:w-28 bg-gray-100 text-gray-700 px-4 py-2.5 rounded-xl font-bold text-sm flex items-center justify-center gap-2 hover:bg-gray-200 transition">
                            <i class="fa-regular fa-eye"></i> Lihat
                        </a>

                        <a href="{{ route('staff.agenda.edit', $item->id) }}"
                            class="flex-1 md:w-28 bg-blue-50 text-blue-600 px-4 py-2.5 rounded-xl font-bold text-sm flex items-center justify-center gap-2 hover:bg-blue-600 hover:text-white transition">
                            <i class="fa-regular fa-pen-to-square"></i> Edit
                        </a>

                        <form action="{{ route('staff.agenda.destroy', $item->id) }}" method="POST"
                            class="flex-1 md:w-28">
                            @csrf @method('DELETE')
                            <button type="submit" onclick="return confirm('Hapus agenda ini?')"
                                class="w-full bg-red-50 text-red-600 px-4 py-2.5 rounded-xl font-bold text-sm flex items-center justify-center gap-2 hover:bg-red-600 hover:text-white transition">
                                <i class="fa-regular fa-trash-can"></i> Hapus
                            </button>
                        </form>
                    </div>

                </div>
            @empty
                <div class="text-center py-20 bg-white rounded-3xl border-2 border-dashed border-gray-100">
                    <i class="fa-regular fa-calendar-xmark text-5xl text-gray-200 mb-4"></i>
                    <p class="text-gray-400 font-medium">Belum ada agenda kegiatan yang ditemukan.</p>
                </div>
            @endforelse
        </div>
    </div>
@endsection
