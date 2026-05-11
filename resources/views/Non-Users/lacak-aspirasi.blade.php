@extends('Non-Users.layouts.main')

@section('title', 'Lacak Aspirasi')

@section('content')
    {{-- CSS Khusus untuk Bintang Penilaian --}}
    <style>
        .star-rating-custom {
            display: inline-flex;
            flex-direction: row-reverse;
            justify-content: flex-end;
        }

        .star-rating-custom input {
            display: none;
        }

        .star-rating-custom label {
            color: #d1d5db;
            /* gray-300 */
            cursor: pointer;
            font-size: 2.5rem;
            padding: 0 0.1rem;
            transition: color 0.2s;
        }

        .star-rating-custom :checked~label {
            color: #fbbf24;
            /* yellow-400 */
        }

        .star-rating-custom label:hover,
        .star-rating-custom label:hover~label {
            color: #f59e0b;
            /* yellow-500 */
        }
    </style>

    <main class="max-w-4xl mx-auto px-4 py-12">

        <div class="text-center mb-8">
            <div class="inline-flex items-center justify-center w-16 h-16 rounded-2xl bg-blue-600 text-white shadow-lg mb-6">
                <i class="fa-solid fa-message text-2xl"></i>
            </div>
            <h1 class="text-3xl font-bold text-gray-900 mb-2">Layanan Aspirasi Masyarakat</h1>
            <p class="text-gray-600 text-sm md:text-base">Suara Anda adalah prioritas kami. Sampaikan aspirasi, saran, atau
                keluhan untuk pembangunan Tapanuli Selatan yang lebih baik.</p>
        </div>

        <div class="flex justify-center mb-10">
            <div class="bg-white p-1 rounded-xl shadow-sm border border-gray-200 inline-flex">
                <a href="{{ route('layanan.aspirasi') }}"
                    class="text-gray-600 hover:bg-gray-50 px-6 py-2.5 rounded-lg font-medium text-sm flex items-center gap-2 transition">
                    <i class="fa-regular fa-message"></i> Kirim Aspirasi
                </a>
                <a href="{{ route('layanan.aspirasi.lacak') }}"
                    class="bg-[#059669] text-white px-6 py-2.5 rounded-lg font-semibold text-sm flex items-center gap-2 shadow-sm">
                    <i class="fa-solid fa-magnifying-glass"></i> Lacak Status
                </a>
            </div>
        </div>

        <div class="bg-white rounded-3xl shadow-xl border border-gray-100 overflow-hidden max-w-3xl mx-auto p-6 md:p-10">

            <div class="text-center mb-8">
                <div
                    class="w-16 h-16 bg-[#059669] text-white rounded-full flex items-center justify-center text-2xl mx-auto mb-4 shadow-md shadow-green-200">
                    <i class="fa-solid fa-magnifying-glass"></i>
                </div>
                <h2 class="text-2xl font-bold text-gray-900">Lacak Status Aspirasi</h2>
                <p class="text-gray-500 text-sm mt-1">Masukkan kode tracking untuk melihat status dan perkembangan aspirasi
                    Anda</p>
            </div>

            <form action="{{ route('aspirasi.lacak.cari') }}" method="GET" class="mb-8 relative">
                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-gray-400">
                    <i class="fa-solid fa-magnifying-glass"></i>
                </div>
                <input type="text" name="tracking_code" required
                    value="{{ request('tracking_code', $aspirasi->tiket_id ?? '') }}" placeholder="ASP-20260302-0001"
                    class="w-full pl-11 pr-32 py-4 border-2 border-gray-200 rounded-xl focus:ring-0 focus:border-[#059669] outline-none transition text-gray-700 font-mono text-sm uppercase">

                <div class="absolute inset-y-0 right-0">
                    <button type="submit"
                        class="bg-[#059669] text-white px-6 py-1 rounded-lg font-bold hover:bg-green-700 transition shadow-sm flex items-center gap-2 h-14">
                        <i class="fa-solid fa-magnifying-glass text-sm"></i> Lacak
                    </button>
                </div>
                <p class="text-[10px] text-gray-400 mt-2 ml-1">Format kode: ASP-YYYYMMDD-XXXX (contoh: ASP-20260302-0001)
                </p>
            </form>

            {{-- Pesan Alert Global (Error/Success) --}}
            @if (session('error'))
                <div class="mb-6 bg-red-50 border-l-4 border-red-500 text-red-700 p-4 rounded-xl shadow-sm">
                    <p class="font-bold text-sm"><i class="fa-solid fa-circle-exclamation mr-1"></i> {{ session('error') }}
                    </p>
                </div>
            @endif
            @if (session('success'))
                <div class="mb-6 bg-green-50 border-l-4 border-green-500 text-green-700 p-4 rounded-xl shadow-sm">
                    <p class="font-bold text-sm"><i class="fa-solid fa-circle-check mr-1"></i> {{ session('success') }}</p>
                </div>
            @endif

            @if (isset($aspirasi))
                <div class="border border-gray-200 rounded-2xl overflow-hidden shadow-sm">
                    <div
                        class="bg-[#059669] p-6 text-white flex flex-col md:flex-row md:justify-between md:items-start gap-4">
                        <div>
                            <p class="text-xs text-green-100 uppercase tracking-widest mb-1 font-medium">Kode Tracking</p>
                            <h3 class="text-xl font-bold font-mono tracking-wider mb-2">{{ $aspirasi->tiket_id }}</h3>
                            <p class="font-bold text-lg leading-tight">{{ $aspirasi->judul }}</p>
                        </div>
                        <div
                            class="inline-flex items-center gap-2 bg-[#fef08a] text-yellow-800 px-4 py-2 rounded-lg font-bold text-sm shadow-sm whitespace-nowrap">
                            <i class="fa-regular fa-clock"></i>
                            {{ $aspirasi->status == 'Diproses' ? 'Menunggu Peninjauan' : $aspirasi->status }}
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
                                    <p class="font-bold text-gray-900 text-sm">
                                        {{ \Carbon\Carbon::parse($aspirasi->created_at)->translatedFormat('d F Y') }}</p>
                                </div>
                                <div>
                                    <p class="text-xs text-gray-500 mb-1">Kategori</p>
                                    <span
                                        class="bg-purple-100 text-purple-700 px-3 py-1 rounded-md text-xs font-bold">{{ $aspirasi->kategori }}</span>
                                </div>
                                <div>
                                    <p class="text-xs text-gray-500 mb-1">Ditangani Oleh (PIC)</p>
                                    @if ($aspirasi->pic)
                                        <span
                                            class="bg-blue-100 text-blue-800 px-3 py-1 rounded-md text-xs font-bold border border-blue-200">
                                            <i class="fa-solid fa-user-tie mr-1"></i> {{ $aspirasi->pic }}
                                        </span>
                                    @else
                                        <span class="text-gray-400 text-xs font-medium italic">Belum ditentukan</span>
                                    @endif
                                </div>
                                <div class="md:col-span-2">
                                    <p class="text-xs text-gray-500 mb-1">Lokasi Kejadian / Wilayah</p>
                                    <p class="font-bold text-gray-900 text-sm mb-2">
                                        {{ $aspirasi->alamat ?? 'Lokasi tidak disertakan' }}</p>

                                    @if ($aspirasi->latitude && $aspirasi->longitude)
                                        <a href="https://www.google.com/maps?q={{ $aspirasi->latitude }},{{ $aspirasi->longitude }}"
                                            target="_blank"
                                            class="inline-flex items-center gap-1.5 bg-red-50 text-red-600 hover:bg-red-100 border border-red-200 px-3 py-1.5 rounded-lg text-xs font-bold transition shadow-sm">
                                            <i class="fa-solid fa-map-location-dot"></i> Buka Titik Peta (Google Maps)
                                        </a>
                                    @endif
                                </div>
                            </div>

                            <div>
                                <p class="text-xs text-gray-500 mb-2">Isi Aspirasi</p>
                                <p class="text-gray-700 text-sm leading-relaxed">{{ $aspirasi->pesan }}</p>
                            </div>

                            @if ($aspirasi->image1 || $aspirasi->image2)
                                <div class="mt-6 pt-6 border-t border-gray-50">
                                    <p class="text-xs text-gray-500 mb-3 font-bold uppercase tracking-widest">Lampiran Foto
                                        Bukti:</p>
                                    <div class="flex flex-wrap gap-4">
                                        @if ($aspirasi->image1)
                                            <a href="{{ asset('storage/' . $aspirasi->image1) }}" target="_blank"
                                                class="block group relative">
                                                <img src="{{ asset('storage/' . $aspirasi->image1) }}" alt="Bukti 1"
                                                    class="w-32 h-32 object-cover rounded-2xl border-2 border-gray-100 group-hover:border-blue-400 transition duration-300">
                                            </a>
                                        @endif
                                        @if ($aspirasi->image2)
                                            <a href="{{ asset('storage/' . $aspirasi->image2) }}" target="_blank"
                                                class="block group relative">
                                                <img src="{{ asset('storage/' . $aspirasi->image2) }}" alt="Bukti 2"
                                                    class="w-32 h-32 object-cover rounded-2xl border-2 border-gray-100 group-hover:border-blue-400 transition duration-300">
                                            </a>
                                        @endif
                                    </div>
                                </div>
                            @endif
                        </div>

                        <hr class="border-gray-100">

                        <div>
                            <h4 class="font-bold text-gray-900 mb-6 text-lg flex items-center gap-2">
                                <i class="fa-regular fa-clock text-blue-600"></i> Timeline Perkembangan
                            </h4>

                            <div class="space-y-0">
                                @foreach ($aspirasi->histories as $history)
                                    @php
                                        $statusColor = match ($history->status) {
                                            'Ditolak' => 'bg-red-100 text-red-700',
                                            'Selesai' => 'bg-green-100 text-green-700',
                                            'Diproses' => 'bg-purple-100 text-purple-700',
                                            default => 'bg-[#fef08a] text-yellow-700',
                                        };
                                        $icon = match ($history->status) {
                                            'Ditolak' => 'fa-xmark',
                                            'Selesai' => 'fa-check',
                                            'Diproses' => 'fa-spinner',
                                            default => 'fa-clock',
                                        };
                                    @endphp
                                    <div class="flex gap-4">
                                        <div class="flex flex-col items-center">
                                            <div
                                                class="w-10 h-10 rounded-full {{ $statusColor }} flex items-center justify-center shadow-sm z-10">
                                                <i class="fa-solid {{ $icon }}"></i>
                                            </div>
                                            @if (!$loop->last)
                                                <div class="w-0.5 h-full bg-gray-200 mt-2 min-h-[40px]"></div>
                                            @endif
                                        </div>
                                        <div class="pb-8 pt-1.5">
                                            <div class="flex flex-wrap items-baseline gap-2 mb-1">
                                                <h5 class="font-bold text-gray-900 text-sm md:text-base">
                                                    {{ $history->status == 'Diproses' ? 'Sedang Ditinjau' : $history->status }}
                                                </h5>
                                                <span
                                                    class="text-xs text-gray-500">{{ \Carbon\Carbon::parse($history->created_at)->translatedFormat('d F Y \p\u\k\u\l H:i') }}</span>
                                            </div>
                                            <p class="text-sm text-gray-600 mb-1">{{ $history->catatan }}</p>
                                            <p class="text-[10px] text-gray-400 uppercase tracking-wide">Diupdate oleh:
                                                {{ $history->user_name }}</p>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>

                        {{-- ======================================================== --}}
                        {{-- BLOK PENILAIAN / RATING (MUNCUL JIKA STATUS SELESAI) --}}
                        {{-- ======================================================== --}}
                        @if ($aspirasi->status == 'Selesai')
                            <div class="bg-[#fffdf7] border border-orange-200 rounded-2xl p-6 md:p-8">
                                <h4 class="font-bold text-gray-900 mb-5 text-lg flex items-center gap-2">
                                    <i class="fa-regular fa-star text-orange-500"></i> Penilaian Kinerja Staf
                                </h4>

                                @if (is_null($aspirasi->rating))
                                    {{-- TAMPILAN AWAL: INFO & TOMBOL --}}
                                    <div id="rating-intro">
                                        <p class="text-sm text-gray-700 mb-5 leading-relaxed">Aspirasi Anda telah selesai
                                            ditindaklanjuti. Bantu kami meningkatkan kualitas pelayanan dengan memberikan
                                            penilaian.</p>
                                        <button type="button" onclick="showRatingForm()"
                                            class="bg-gradient-to-r from-orange-400 to-orange-500 hover:from-orange-500 hover:to-orange-600 text-white px-6 py-2.5 rounded-lg font-bold text-sm transition shadow-sm flex items-center gap-2">
                                            <i class="fa-regular fa-star"></i> Berikan Penilaian
                                        </button>
                                    </div>

                                    {{-- TAMPILAN FORM: BINTANG & ULASAN (Tersembunyi secara default) --}}
                                    <div id="rating-form" class="hidden">
                                        <form action="{{ route('aspirasi.lacak.rating', $aspirasi->id) }}"
                                            method="POST">
                                            @csrf

                                            <div class="mb-5 border border-orange-100 rounded-xl p-5 bg-white shadow-sm">
                                                <label class="block text-sm font-bold text-gray-800 mb-2">Berikan Rating
                                                    <span class="text-red-500">*</span></label>
                                                <div class="star-rating-custom mb-1">
                                                    <input type="radio" id="star5" name="rating" value="5"
                                                        required onclick="updateRatingText('Sangat Baik')" />
                                                    <label for="star5" title="Sangat Baik"><i
                                                            class="fa-solid fa-star"></i></label>

                                                    <input type="radio" id="star4" name="rating" value="4"
                                                        onclick="updateRatingText('Baik')" />
                                                    <label for="star4" title="Baik"><i
                                                            class="fa-solid fa-star"></i></label>

                                                    <input type="radio" id="star3" name="rating" value="3"
                                                        onclick="updateRatingText('Cukup')" />
                                                    <label for="star3" title="Cukup"><i
                                                            class="fa-solid fa-star"></i></label>

                                                    <input type="radio" id="star2" name="rating" value="2"
                                                        onclick="updateRatingText('Buruk')" />
                                                    <label for="star2" title="Buruk"><i
                                                            class="fa-solid fa-star"></i></label>

                                                    <input type="radio" id="star1" name="rating" value="1"
                                                        onclick="updateRatingText('Sangat Buruk')" />
                                                    <label for="star1" title="Sangat Buruk"><i
                                                            class="fa-solid fa-star"></i></label>
                                                </div>
                                                <p id="rating-text" class="text-xs font-bold text-orange-500 ml-1 mt-1">
                                                    Pilih bintang</p>
                                            </div>

                                            <div class="mb-6 border border-orange-100 rounded-xl p-5 bg-white shadow-sm">
                                                <label class="block text-sm font-bold text-gray-800 mb-3">Komentar
                                                    (Opsional)</label>
                                                <textarea name="ulasan" rows="3" placeholder="Berikan komentar tentang pelayanan yang Anda terima..."
                                                    class="w-full bg-gray-50 border border-gray-200 rounded-xl px-4 py-3 text-sm focus:ring-2 focus:ring-orange-400 focus:bg-white outline-none transition"></textarea>
                                            </div>

                                            <div class="flex flex-col sm:flex-row gap-3">
                                                <button type="button" onclick="hideRatingForm()"
                                                    class="w-full sm:w-1/2 px-6 py-3 border border-orange-500 text-orange-600 bg-white hover:bg-orange-50 rounded-xl font-bold text-sm transition">
                                                    Batal
                                                </button>
                                                <button type="submit"
                                                    class="w-full sm:w-1/2 bg-gradient-to-r from-orange-400 to-orange-500 hover:from-orange-500 hover:to-orange-600 text-white px-6 py-3 rounded-xl font-bold text-sm transition shadow-md flex items-center justify-center gap-2">
                                                    <i class="fa-regular fa-star"></i> Kirim Penilaian
                                                </button>
                                            </div>
                                        </form>
                                    </div>
                                @else
                                    {{-- TAMPILAN JIKA SUDAH DINILAI SEBELUMNYA --}}
                                    <div class="bg-white border border-orange-100 rounded-xl p-5 shadow-sm">
                                        <p class="text-sm font-bold text-gray-800 mb-2">Rating yang Anda Berikan:</p>
                                        <div class="flex items-center gap-1 mb-4">
                                            @for ($i = 1; $i <= 5; $i++)
                                                <i
                                                    class="fa-solid fa-star {{ $i <= $aspirasi->rating ? 'text-yellow-400' : 'text-gray-200' }} text-2xl"></i>
                                            @endfor
                                            <span
                                                class="ml-2 font-bold text-orange-600 text-sm">({{ $aspirasi->rating }}/5)</span>
                                        </div>
                                        @if ($aspirasi->ulasan)
                                            <p class="text-sm font-bold text-gray-800 mb-2">Komentar:</p>
                                            <p
                                                class="text-sm text-gray-600 italic bg-gray-50 p-4 rounded-xl border border-gray-100">
                                                "{{ $aspirasi->ulasan }}"</p>
                                        @endif
                                    </div>
                                @endif
                            </div>

                            {{-- JS KHUSUS UNTUK INTERAKSI FORM RATING --}}
                            <script>
                                function showRatingForm() {
                                    document.getElementById('rating-intro').classList.add('hidden');
                                    document.getElementById('rating-form').classList.remove('hidden');
                                }

                                function hideRatingForm() {
                                    document.getElementById('rating-form').classList.add('hidden');
                                    document.getElementById('rating-intro').classList.remove('hidden');
                                }

                                function updateRatingText(text) {
                                    document.getElementById('rating-text').innerText = text;
                                }
                            </script>
                        @endif

                        <div class="bg-blue-50 border border-blue-100 rounded-xl p-5 flex items-start gap-4 mt-8">
                            <i class="fa-solid fa-circle-info text-blue-600 mt-0.5 text-lg"></i>
                            <div>
                                <h5 class="font-bold text-blue-900 mb-1 text-sm">Informasi Penting</h5>
                                <p class="text-blue-700 text-xs leading-relaxed">
                                    Status aspirasi akan diperbarui secara berkala. Jika ada pertanyaan lebih lanjut,
                                    silakan hubungi layanan kami di email: aspirasi@dprd-tapsel.go.id atau telepon (061)
                                    123-4567
                                </p>
                            </div>
                        </div>

                    </div>
                </div>
            @endif

        </div>

    </main>
@endsection
