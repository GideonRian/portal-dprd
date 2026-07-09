@extends('Non-Users.layouts.main')

@section('title', 'Beranda')

@section('content')
    <!-- Panggil CSS Swiper -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.css" />

    <style>
        .bg-hero-pattern {
            background-image: url('{{ asset('images/tapanuliselatans.jpg') }}');
            background-size: cover;
            background-position: center;
        }

        .bg-cta-pattern {
            background-image: url('{{ asset('images/tapselsidangfoto.jpg') }}');
            background-size: cover;
            background-position: center;
        }

        .bg-banner-pattern {
            background-image: url('https://images.unsplash.com/photo-1464029902022-f42944061a3c?q=80&w=2070&auto=format&fit=crop');
            background-size: cover;
            background-position: center;
        }

        .glass-card {
            background: rgba(255, 255, 255, 0.85);
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.3);
        }

        .dot-pattern {
            background-image: radial-gradient(#2563eb 1.5px, transparent 1.5px);
            background-size: 24px 24px;
            opacity: 0.1;
        }

        /* CUSTOM ANIMATIONS */
        @keyframes float {
            0% {
                transform: translateY(0px);
            }

            50% {
                transform: translateY(-15px);
            }

            100% {
                transform: translateY(0px);
            }
        }

        .animate-float {
            animation: float 5s ease-in-out infinite;
        }

        /* Scroll Reveal */
        .reveal {
            opacity: 0;
            transform: translateY(40px);
            transition: all 0.8s cubic-bezier(0.5, 0, 0, 1);
        }

        .reveal.active {
            opacity: 1;
            transform: translateY(0);
        }

        .delay-100 {
            transition-delay: 100ms;
        }

        .delay-200 {
            transition-delay: 200ms;
        }

        .delay-300 {
            transition-delay: 300ms;
        }

        .delay-400 {
            transition-delay: 400ms;
        }

        /* Swiper Custom Pagination Color */
        .swiper-pagination-bullet-active {
            background: white !important;
        }

        /* =========================================
           KODE BARU: 3D KOTAK STATISTIK PUBLIK
           ========================================= */
        .stat-card-blue {
            background: linear-gradient(135deg, #3b82f6 0%, #1d4ed8 100%);
            box-shadow: 0 15px 30px -5px rgba(29, 78, 216, 0.4), inset 0 2px 3px rgba(255, 255, 255, 0.3), inset 0 -3px 5px rgba(0, 0, 0, 0.2);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        .stat-card-purple {
            background: linear-gradient(135deg, #8b5cf6 0%, #6d28d9 100%);
            box-shadow: 0 15px 30px -5px rgba(109, 40, 217, 0.4), inset 0 2px 3px rgba(255, 255, 255, 0.3), inset 0 -3px 5px rgba(0, 0, 0, 0.2);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        .stat-card-emerald {
            background: linear-gradient(135deg, #10b981 0%, #047857 100%);
            box-shadow: 0 15px 30px -5px rgba(4, 120, 87, 0.4), inset 0 2px 3px rgba(255, 255, 255, 0.3), inset 0 -3px 5px rgba(0, 0, 0, 0.2);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        .stat-card-orange {
            background: linear-gradient(135deg, #f59e0b 0%, #b45309 100%);
            box-shadow: 0 15px 30px -5px rgba(180, 83, 9, 0.4), inset 0 2px 3px rgba(255, 255, 255, 0.3), inset 0 -3px 5px rgba(0, 0, 0, 0.2);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }
    </style>

    <section class="relative bg-hero-pattern pt-20 pb-32 lg:pt-28 lg:pb-40 overflow-hidden">
        <div class="absolute inset-0 bg-gradient-to-r from-[#0f172a] via-[#1e3a8a]/90 to-[#1e3a8a]/70"></div>

        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col lg:flex-row items-center justify-between">
                <div class="w-full lg:w-1/2 text-white mb-12 lg:mb-0 reveal active">
                    <div
                        class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-white/10 border border-white/20 text-sm font-medium mb-6 backdrop-blur-sm">
                        <i class="fa-solid fa-shield-halved text-blue-300"></i>
                        <span>Portal Resmi DPRD Kabupaten Tapanuli Selatan</span>
                    </div>
                    <h1 class="text-4xl md:text-5xl lg:text-6xl font-bold leading-tight mb-4">
                        Mewujudkan <br>
                        <span class="text-blue-300">Tapsel Sejahtera</span>
                    </h1>
                    <p class="text-gray-300 text-lg mb-8 max-w-lg leading-relaxed">
                        Berkomitmen melayani masyarakat melalui fungsi legislasi, anggaran, dan pengawasan untuk pembangunan
                        Tapanuli Selatan yang lebih baik.
                    </p>
                    <div class="flex flex-col sm:flex-row gap-4">
                        <a href="{{ route('layanan.aspirasi') }}"
                            class="bg-white text-blue-700 hover:bg-gray-50 px-6 py-3 rounded-lg font-bold transition flex items-center justify-center gap-2 shadow-[0_0_20px_rgba(255,255,255,0.3)] hover:shadow-[0_0_30px_rgba(255,255,255,0.5)] transform hover:-translate-y-1">
                            <i class="fa-regular fa-message"></i> Sampaikan Aspirasi <i
                                class="fa-solid fa-arrow-right text-sm ml-1"></i>
                        </a>
                        <a href="{{ route('profil.anggota') }}"
                            class="border-2 border-white/50 hover:bg-white/10 text-white px-6 py-3 rounded-lg font-bold transition flex items-center justify-center gap-2 backdrop-blur-sm hover:-translate-y-1">
                            <i class="fa-solid fa-user-group"></i> Profil Anggota
                        </a>
                    </div>
                </div>

                <div class="w-full lg:w-5/12 reveal active delay-200">
                    <div
                        class="animate-float rounded-2xl overflow-hidden shadow-2xl border-4 border-white/20 relative h-[250px] lg:h-[350px]">
                        <div class="swiper heroSwiper w-full h-full relative cursor-grab active:cursor-grabbing">
                            <div class="swiper-wrapper">
                                <!-- Slide 1 -->
                                <div class="swiper-slide">
                                    <img src="{{ asset('images/tapanuliselatans.jpg') }}"
                                        class="w-full h-full object-cover">
                                </div>
                                <!-- Slide 2 -->
                                <div class="swiper-slide">
                                    <img src="{{ asset('images/bphdprd.png') }}" class="w-full h-full object-cover">
                                </div>
                            </div>
                            <!-- Pagination -->
                            <div class="swiper-pagination"></div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <!-- SECTION STATISTIK 3D -->
    <section class="relative z-10 -mt-16 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-2 md:grid-cols-4 gap-4 lg:gap-6">
            
            <!-- Kotak 1: Anggota DPRD -->
            <div class="stat-card-blue relative overflow-hidden rounded-2xl p-6 text-center transform hover:-translate-y-2 hover:scale-[1.03] transition-all duration-300 group reveal cursor-default">
                <!-- Watermark Background -->
                <i class="fa-solid fa-user-tie absolute -right-4 -bottom-4 text-7xl opacity-20 transform group-hover:scale-110 group-hover:rotate-12 transition-transform duration-500 text-white"></i>
                
                <div class="relative z-10 flex flex-col items-center">
                    <div class="w-14 h-14 bg-white/20 text-white rounded-full flex items-center justify-center text-2xl mb-3 backdrop-blur-md border border-white/30 shadow-inner">
                        <i class="fa-solid fa-user-tie drop-shadow-md"></i>
                    </div>
                    <h3 class="text-4xl font-black text-white mb-1 drop-shadow-lg tracking-tight">{{ $jumlah_anggota }}</h3>
                    <p class="text-xs font-bold text-white/90 uppercase tracking-wider drop-shadow-sm mt-1" style="color:white">Anggota DPRD</p>
                </div>
            </div>

            <!-- Kotak 2: Komisi -->
            <div class="stat-card-purple relative overflow-hidden rounded-2xl p-6 text-center transform hover:-translate-y-2 hover:scale-[1.03] transition-all duration-300 group reveal delay-100 cursor-default">
                <!-- Watermark Background -->
                <i class="fa-solid fa-building-user absolute -right-4 -bottom-4 text-7xl opacity-20 transform group-hover:scale-110 group-hover:-rotate-12 transition-transform duration-500 text-white"></i>
                
                <div class="relative z-10 flex flex-col items-center">
                    <div class="w-14 h-14 bg-white/20 text-white rounded-full flex items-center justify-center text-2xl mb-3 backdrop-blur-md border border-white/30 shadow-inner">
                        <i class="fa-solid fa-building-user drop-shadow-md"></i>
                    </div>
                    <h3 class="text-4xl font-black text-white mb-1 drop-shadow-lg tracking-tight">3</h3>
                    <p class="text-xs font-bold text-white/90 uppercase tracking-wider drop-shadow-sm mt-1" style="color:white">Komisi</p>
                </div>
            </div>

            <!-- Kotak 3: Aspirasi -->
            <div class="stat-card-emerald relative overflow-hidden rounded-2xl p-6 text-center transform hover:-translate-y-2 hover:scale-[1.03] transition-all duration-300 group reveal delay-200 cursor-default">
                <!-- Watermark Background -->
                <i class="fa-solid fa-comments absolute -right-4 -bottom-4 text-7xl opacity-20 transform group-hover:scale-110 group-hover:rotate-12 transition-transform duration-500 text-white"></i>
                
                <div class="relative z-10 flex flex-col items-center">
                    <div class="w-14 h-14 bg-white/20 text-white rounded-full flex items-center justify-center text-2xl mb-3 backdrop-blur-md border border-white/30 shadow-inner">
                        <i class="fa-solid fa-comments drop-shadow-md"></i>
                    </div>
                    <h3 class="text-4xl font-black text-white mb-1 drop-shadow-lg tracking-tight">{{ number_format($jumlah_aspirasi, 0, ',', '.') }}</h3>
                    <p class="text-xs font-bold text-white/90 uppercase tracking-wider drop-shadow-sm mt-1" style="color:white">Aspirasi Diterima</p>
                </div>
            </div>

            <!-- Kotak 4: Perda -->
            <div class="stat-card-orange relative overflow-hidden rounded-2xl p-6 text-center transform hover:-translate-y-2 hover:scale-[1.03] transition-all duration-300 group reveal delay-300 cursor-default">
                <!-- Watermark Background -->
                <i class="fa-solid fa-file-signature absolute -right-4 -bottom-4 text-7xl opacity-20 transform group-hover:scale-110 group-hover:-rotate-12 transition-transform duration-500 text-white"></i>
                
                <div class="relative z-10 flex flex-col items-center">
                    <div class="w-14 h-14 bg-white/20 text-white rounded-full flex items-center justify-center text-2xl mb-3 backdrop-blur-md border border-white/30 shadow-inner">
                        <i class="fa-solid fa-file-signature drop-shadow-md"></i>
                    </div>
                    <h3 class="text-4xl font-black text-white mb-1 drop-shadow-lg tracking-tight">{{ $jumlah_perda }}</h3>
                    <p class="text-xs font-bold text-white/90 uppercase tracking-wider drop-shadow-sm mt-1" style="color:white">Perda Disahkan</p>
                </div>
            </div>

        </div>
    </section>

    <section class="py-20 bg-white relative overflow-hidden">
        <div class="absolute right-0 top-0 w-64 h-full dot-pattern"></div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="text-center mb-12 reveal">
                <h2 class="text-3xl font-bold text-gray-900 mb-3">Layanan Digital Kami</h2>
                <p class="text-gray-500">Akses mudah dan cepat untuk berbagai layanan dan informasi DPRD Tapanuli Selatan
                </p>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                <div class="group relative h-80 rounded-2xl overflow-hidden shadow-lg cursor-pointer reveal">
                    <img src="{{ asset('images/photodprd.png') }}"
                        class="absolute inset-0 w-full h-full object-cover group-hover:scale-110 transition duration-700">
                    <div class="absolute inset-0 bg-gradient-to-t from-blue-900/80 via-black/10 to-transparent"></div>
                    <div
                        class="absolute bottom-0 inset-x-0 p-5 bg-white/90 backdrop-blur-sm border border-white/50 m-2 rounded-xl transform translate-y-2 group-hover:translate-y-0 transition duration-300">
                        <h3 class="text-lg font-bold text-gray-900 mb-1">Profil Anggota</h3>
                        <p class="text-xs text-gray-700 mb-3 opacity-90 group-hover:opacity-100 transition">Kenali anggota
                            DPRD yang mewakili aspirasi rakyat Tapanuli Selatan</p>
                        <a href="{{ route('profil.anggota') }}"
                            class="text-sm font-bold text-blue-700 flex items-center gap-1 group-hover:text-blue-900">Selengkapnya
                            <i class="fa-solid fa-angle-right"></i></a>
                    </div>
                </div>

                <div class="group relative h-80 rounded-2xl overflow-hidden shadow-lg cursor-pointer reveal delay-100">
                    <img src="{{ asset('images/aspirasirakyat.png') }}"
                        class="absolute inset-0 w-full h-full object-cover group-hover:scale-110 transition duration-700">
                    <div class="absolute inset-0 bg-gradient-to-t from-blue-900/80 via-black/10 to-transparent"></div>
                    <div
                        class="absolute bottom-0 inset-x-0 p-5 bg-white/90 backdrop-blur-sm border border-white/50 m-2 rounded-xl transform translate-y-2 group-hover:translate-y-0 transition duration-300">
                        <h3 class="text-lg font-bold text-gray-900 mb-1">Layanan Aspirasi</h3>
                        <p class="text-xs text-gray-700 mb-3 opacity-90 group-hover:opacity-100 transition">Sampaikan
                            aspirasi dan keluhan Anda langsung kepada DPRD</p>
                        <a href="{{ route('layanan.aspirasi') }}"
                            class="text-sm font-bold text-blue-700 flex items-center gap-1 group-hover:text-blue-900">Selengkapnya
                            <i class="fa-solid fa-angle-right"></i></a>
                    </div>
                </div>

                <div class="group relative h-80 rounded-2xl overflow-hidden shadow-lg cursor-pointer reveal delay-200">
                    <img src="{{ asset('images/beritadaninfo.png') }}"
                        class="absolute inset-0 w-full h-full object-cover group-hover:scale-110 transition duration-700">
                    <div class="absolute inset-0 bg-gradient-to-t from-blue-900/80 via-black/10 to-transparent"></div>
                    <div
                        class="absolute bottom-0 inset-x-0 p-5 bg-white/90 backdrop-blur-sm border border-white/50 m-2 rounded-xl transform translate-y-2 group-hover:translate-y-0 transition duration-300">
                        <h3 class="text-lg font-bold text-gray-900 mb-1">Berita & Informasi</h3>
                        <p class="text-xs text-gray-700 mb-3 opacity-90 group-hover:opacity-100 transition">Informasi
                            terkini tentang kegiatan dan program DPRD</p>
                        <a href="{{ route('berita') }}"
                            class="text-sm font-bold text-blue-700 flex items-center gap-1 group-hover:text-blue-900">Selengkapnya
                            <i class="fa-solid fa-angle-right"></i></a>
                    </div>
                </div>

                <div class="group relative h-80 rounded-2xl overflow-hidden shadow-lg cursor-pointer reveal delay-300">
                    <img src="{{ asset('images/agenda.png') }}"
                        class="absolute inset-0 w-full h-full object-cover group-hover:scale-110 transition duration-700">
                    <div class="absolute inset-0 bg-gradient-to-t from-blue-900/80 via-black/10 to-transparent"></div>
                    <div
                        class="absolute bottom-0 inset-x-0 p-5 bg-white/90 backdrop-blur-sm border border-white/50 m-2 rounded-xl transform translate-y-2 group-hover:translate-y-0 transition duration-300">
                        <h3 class="text-lg font-bold text-gray-900 mb-1">Agenda Kegiatan</h3>
                        <p class="text-xs text-gray-700 mb-3 opacity-90 group-hover:opacity-100 transition">Jadwal rapat,
                            hearing, dan kegiatan DPRD secara berkala</p>
                        <a href="{{ route('publik.agenda') }}"
                            class="text-sm font-bold text-blue-700 flex items-center gap-1 group-hover:text-blue-900">Selengkapnya
                            <i class="fa-solid fa-angle-right"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="relative bg-banner-pattern bg-fixed">
        <div class="absolute inset-0 bg-blue-700/80 backdrop-blur-sm"></div>
        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10 reveal">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 divide-y md:divide-y-0 md:divide-x divide-white/20">
                <a href="{{ route('publik.agenda') }}"
                    class="flex flex-col items-center text-white p-6 hover:bg-white/10 rounded-lg transition transform hover:scale-105">
                    <i class="fa-regular fa-calendar-check text-4xl mb-3"></i>
                    <span class="font-bold">Agenda Kegiatan</span>
                </a>
                <a href="https://youtube.com/@kominfotapsel?si=jeTDCBDvnA1amquC"
                    class="flex flex-col items-center text-white p-6 hover:bg-white/10 rounded-lg transition transform hover:scale-105">
                    <i class="fa-brands fa-youtube text-4xl mb-3"></i>
                    <span class="font-bold">YouTube DPRD</span>
                </a>
                <a href="{{ route('pusat.dokumen') }}"
                    class="flex flex-col items-center text-white p-6 hover:bg-white/10 rounded-lg transition transform hover:scale-105">
                    <i class="fa-solid fa-download text-4xl mb-3"></i>
                    <span class="font-bold">Dokumen Regulasi</span>
                </a>
            </div>
        </div>
    </section>

    <section class="py-20 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col sm:flex-row justify-between items-end mb-10 gap-4 reveal">
                <div>
                    <h2 class="text-3xl font-bold text-gray-900 mb-2">Berita Terkini</h2>
                    <p class="text-gray-500">Informasi terbaru dari DPRD Tapanuli Selatan</p>
                </div>
                <a href="{{ route('berita') }}"
                    class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2.5 rounded-lg font-medium transition text-sm flex items-center gap-2 hover:shadow-lg transform hover:-translate-y-1">
                    Lihat Semua <i class="fa-solid fa-arrow-right"></i>
                </a>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @forelse($berita_terkini ?? [] as $index => $item)
                    <div
                        class="bg-white rounded-2xl overflow-hidden shadow-sm hover:shadow-xl transition duration-300 border border-gray-100 flex flex-col reveal">
                        <div class="relative h-56 overflow-hidden group bg-gray-100">
                            @if (is_array($item->gambar) && count($item->gambar) > 0)
                                <img src="{{ asset('storage/' . $item->gambar[0]) }}"
                                    class="w-full h-full object-cover group-hover:scale-110 transition duration-700">
                            @else
                                <div class="w-full h-full flex items-center justify-center"><i
                                        class="fa-regular fa-image text-5xl text-gray-300"></i></div>
                            @endif
                            <span
                                class="absolute top-4 left-4 bg-blue-600 text-white text-xs font-bold px-3 py-1 rounded-full shadow-md">{{ $item->kategori }}</span>
                        </div>
                        <div class="p-6 flex flex-col flex-1">
                            <p class="text-blue-600 text-xs font-bold mb-2">
                                {{ \Carbon\Carbon::parse($item->tanggal)->translatedFormat('d F Y') }}</p>
                            <h3
                                class="text-xl font-bold text-gray-900 mb-3 leading-tight hover:text-blue-600 transition line-clamp-2">
                                {{ $item->judul }}</h3>
                            <p class="text-gray-500 text-sm mb-4 line-clamp-2 flex-grow">{{ $item->ringkasan }}</p>
                            <a href="{{ route('berita.detail', $item->slug) }}"
                                class="text-blue-600 text-sm font-bold flex items-center gap-1 hover:underline mt-auto w-max">
                                Baca Selengkapnya <i class="fa-solid fa-angle-right"></i>
                            </a>
                        </div>
                    </div>
                @empty
                    <div
                        class="col-span-1 md:col-span-3 text-center py-10 bg-white rounded-2xl border border-dashed border-gray-200">
                        <i class="fa-regular fa-newspaper text-4xl text-gray-300 mb-3"></i>
                        <p class="text-gray-500 font-medium">Belum ada berita terbaru yang dipublikasikan.</p>
                    </div>
                @endforelse
            </div>
        </div>
    </section>

    <section class="relative bg-cta-pattern py-24 reveal">
        <div class="absolute inset-0 bg-[#0f172a]/80"></div>
        <div class="relative max-w-4xl mx-auto px-4 text-center text-white">
            <h2 class="text-3xl md:text-4xl font-bold mb-4">Suara Anda Penting Bagi Kami</h2>
            <p class="text-gray-300 mb-8 text-lg">Sampaikan aspirasi, saran, atau keluhan Anda untuk pembangunan Tapanuli
                Selatan yang lebih baik dan transparan.</p>
            <a href="{{ route('layanan.aspirasi') }}"
                class="inline-flex bg-white text-blue-800 hover:bg-blue-50 px-8 py-4 rounded-xl font-bold transition duration-300 items-center gap-3 shadow-[0_0_20px_rgba(255,255,255,0.2)] hover:shadow-[0_0_30px_rgba(255,255,255,0.5)] transform hover:scale-105 hover:-translate-y-1">
                <i class="fa-regular fa-message text-xl"></i> Sampaikan Aspirasi Sekarang <i
                    class="fa-solid fa-arrow-right"></i>
            </a>
        </div>
    </section>

    <!-- Panggil Javascript Swiper -->
    <script src="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var heroSwiper = new Swiper(".heroSwiper", {
                loop: true,
                grabCursor: true,
                effect: "slide",
                autoplay: {
                    delay: 3500, // Geser setiap 3.5 detik
                    disableOnInteraction: false,
                },
                pagination: {
                    el: ".swiper-pagination",
                    clickable: true,
                },
            });

            const revealElements = document.querySelectorAll('.reveal');
            const revealObserver = new IntersectionObserver((entries, observer) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.classList.add('active');
                        observer.unobserve(entry.target);
                    }
                });
            }, {
                threshold: 0.1,
                rootMargin: "0px 0px -50px 0px"
            });

            revealElements.forEach(el => {
                if (!el.classList.contains('active')) {
                    revealObserver.observe(el);
                }
            });
        });
    </script>
@endsection