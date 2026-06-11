@extends('Non-Users.layouts.main')

@section('title', $berita->judul)

@section('content')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.css" />

    <main class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-12">

        <div class="flex flex-wrap items-center gap-x-4 gap-y-2 mb-4 text-sm text-gray-500">
            <span class="bg-blue-100 text-blue-700 font-bold px-3 py-1 rounded-full">{{ $berita->kategori }}</span>
            <span><i class="fa-regular fa-calendar mr-1"></i>
                {{ \Carbon\Carbon::parse($berita->tanggal)->translatedFormat('d F Y') }}</span>
            <span><i class="fa-regular fa-eye mr-1"></i> {{ number_format($berita->views) }} Tayangan</span>
            <span id="top-likes-counter"><i class="fa-regular fa-thumbs-up mr-1"></i> {{ number_format($berita->likes) }}
                Menyukai</span>
        </div>

        <h1 class="text-3xl md:text-5xl font-extrabold text-gray-900 mb-6 leading-tight">{{ $berita->judul }}</h1>

        <div class="mb-8">
            <p class="text-xl md:text-2xl text-gray-600 font-medium leading-relaxed border-l-4 border-purple-500 pl-5">
                {{ $berita->ringkasan }}
            </p>
        </div>

        <div
            class="swiper mySwiper w-full h-[300px] md:h-[500px] rounded-3xl overflow-hidden mb-12 shadow-lg relative group">
            <div class="swiper-wrapper">
                @if (is_array($berita->gambar) && count($berita->gambar) > 0)
                    @foreach ($berita->gambar as $img)
                        <div class="swiper-slide">
                            <img src="{{ asset('storage/' . $img) }}" alt="{{ $berita->judul }}"
                                class="w-full h-full object-cover">
                        </div>
                    @endforeach
                @else
                    <div class="swiper-slide flex items-center justify-center bg-gray-200">
                        <i class="fa-regular fa-image text-5xl text-gray-400"></i>
                    </div>
                @endif
            </div>

            <div
                class="swiper-button-next text-white drop-shadow-md opacity-0 group-hover:opacity-100 transition duration-300">
            </div>
            <div
                class="swiper-button-prev text-white drop-shadow-md opacity-0 group-hover:opacity-100 transition duration-300">
            </div>
            <div class="swiper-pagination"></div>
        </div>

        <div class="prose prose-lg max-w-none text-gray-800 mb-12">
            {!! $berita->konten !!}
        </div>

        <hr class="border-gray-200 mb-8">

        <div class="flex flex-col md:flex-row justify-between items-center gap-6 mb-16 bg-gray-50 p-6 rounded-2xl">
            <div class="w-full md:w-auto text-center md:text-left">
                <p class="text-xs text-gray-400 font-bold uppercase tracking-wider mb-1">Dipublikasikan pada</p>
                <p class="font-bold text-gray-900">
                    {{ \Carbon\Carbon::parse($berita->tanggal)->translatedFormat('l, d F Y') }}</p>
            </div>

            <div class="flex flex-wrap items-center justify-center gap-3 w-full md:w-auto">
                @php
                    // Cek status apakah browser saat ini sudah pernah klik like untuk berita ini
                    $hasLiked = in_array($berita->id, session()->get('liked_beritas', []));
                @endphp

                <button id="btn-like-berita" data-id="{{ $berita->id }}"
                    data-status="{{ $hasLiked ? 'liked' : 'unliked' }}"
                    class="w-full sm:w-auto flex-1 md:flex-none {{ $hasLiked ? 'bg-red-50 text-red-600 border-red-200' : 'bg-white text-gray-700 border-gray-200 hover:bg-red-50 hover:text-red-600' }} px-5 py-3 rounded-xl font-bold border transition shadow-sm flex items-center justify-center gap-2">
                    <i class="{{ $hasLiked ? 'fa-solid' : 'fa-regular' }} fa-heart text-red-500 text-lg"></i>
                    <span id="text-like-btn">{{ $hasLiked ? 'Disukai' : 'Suka' }}</span> (<span
                        id="bottom-likes-counter">{{ $berita->likes }}</span>)
                </button>

                <button
                    onclick="if(navigator.share) { navigator.share({title: document.title, url: window.location.href}) } else { alert('Browser Anda tidak mendukung share.') }"
                    class="w-full sm:w-auto flex-1 md:flex-none bg-white text-gray-700 px-5 py-3 rounded-xl font-bold border border-gray-200 hover:bg-purple-50 hover:text-purple-700 transition shadow-sm flex items-center justify-center gap-2">
                    <i class="fa-solid fa-share-nodes"></i> Bagikan
                </button>

                <a href="{{ route('berita') }}"
                    class="w-full sm:w-auto flex-1 md:flex-none bg-blue-600 text-white px-6 py-3 rounded-xl font-bold hover:bg-blue-700 transition shadow-md flex items-center justify-center gap-2 text-center">
                    Berita Lainnya <i class="fa-solid fa-arrow-right"></i>
                </a>
            </div>
        </div>

        <h3 class="text-2xl font-bold text-gray-900 mb-6">Baca Juga</h3>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            @foreach ($berita_lainnya as $item)
                <a href="{{ route('berita.detail', $item->slug) }}"
                    class="group bg-white rounded-2xl border border-gray-100 overflow-hidden shadow-sm hover:shadow-md transition">
                    <div class="h-40 bg-gray-100 overflow-hidden">
                        @if (is_array($item->gambar) && count($item->gambar) > 0)
                            <img src="{{ asset('storage/' . $item->gambar[0]) }}"
                                class="w-full h-full object-cover group-hover:scale-105 transition duration-500">
                        @endif
                    </div>
                    <div class="p-5">
                        <span class="text-xs font-bold text-blue-600 mb-2 block">{{ $item->kategori }}</span>
                        <h4 class="font-bold text-gray-900 leading-snug group-hover:text-blue-600 transition line-clamp-2">
                            {{ $item->judul }}</h4>
                    </div>
                </a>
            @endforeach
        </div>

    </main>

    <script src="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Inisialisasi Slider Swiper
            var swiper = new Swiper(".mySwiper", {
                spaceBetween: 0,
                centeredSlides: true,
                loop: true,
                autoplay: {
                    delay: 3500,
                    disableOnInteraction: false,
                },
                pagination: {
                    el: ".swiper-pagination",
                    clickable: true,
                },
                navigation: {
                    nextEl: ".swiper-button-next",
                    prevEl: ".swiper-button-prev",
                },
            });

            // ==========================================
            // LOGIK HANDLING AJAX FETCH UNTUK TOMBOL LIKE
            // ==========================================
            const likeBtn = document.getElementById('btn-like-berita');
            if (likeBtn) {
                likeBtn.addEventListener('click', function() {
                    const beritaId = this.getAttribute('data-id');
                    const status = this.getAttribute('data-status');

                    // Jika sudah pernah di-like, jangan kirim request apa pun ke server
                    if (status === 'liked') {
                        alert('Anda sudah menyukai berita ini sebelumnya.');
                        return;
                    }

                    // Tembak Ajax Request menggunakan Fetch API bawaan browser
                    fetch(`/berita/${beritaId}/like`, {
                            method: 'POST',
                            headers: {
                                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                                'Accept': 'application/json',
                                'Content-Type': 'application/json'
                            }
                        })
                        .then(response => response.json())
                        .then(data => {
                            if (data.success) {
                                // 1. Ubah desain tampilan tombol menjadi mode "Sudah Disukai"
                                this.setAttribute('data-status', 'liked');
                                this.className =
                                    "w-full sm:w-auto flex-1 md:flex-none bg-red-50 text-red-600 border-red-200 px-5 py-3 rounded-xl font-bold border transition shadow-sm flex items-center justify-center gap-2";

                                // 2. Ganti teks tombol & ikon hati ke mode solid filling
                                document.getElementById('text-like-btn').innerText = "Disukai";
                                this.querySelector('i').className =
                                    "fa-solid fa-heart text-red-500 text-lg";

                                // 3. Perbarui teks jumlah angka counter di bagian bawah dan atas secara instan
                                document.getElementById('bottom-likes-counter').innerText = data.likes;
                                document.getElementById('top-likes-counter').innerHTML =
                                    `<i class="fa-regular fa-thumbs-up mr-1"></i> ${data.likes} Menyukai`;
                            } else {
                                alert(data.message);
                            }
                        })
                        .catch(error => {
                            console.error('Error:', error);
                            alert('Terjadi kendala koneksi jaringan saat memproses permintaan.');
                        });
                });
            }
        });
    </script>
    <style>
        .swiper-button-next,
        .swiper-button-prev {
            color: white !important;
            text-shadow: 0 2px 4px rgba(0, 0, 0, 0.5);
        }

        .swiper-pagination-bullet-active {
            background: #9333ea !important;
        }
    </style>
@endsection
