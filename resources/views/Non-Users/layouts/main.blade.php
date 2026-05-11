<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') - DPRD Tapanuli Selatan</title>
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    @vite(['resources/css/Non-Users/app.css', 'resources/js/Non-Users/app.js'])
</head>
<!--  kami gunakan flex flex-col min-h-screen untuk memaksa halaman agar selalu membentang minimal seukuran tinggi layar perangkat-->
<body class="font-sans antialiased text-gray-900 flex flex-col min-h-screen">

    <nav class="bg-white border-b border-gray-100 sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-20">
                <div class="flex items-center">
                    <img src="{{ asset('images/logo.png') }}" alt="Logo Tapsel" class="h-16 w-auto">
                    <div class="ml-3">
                        <span class="block text-xl font-bold leading-none text-gray-800">DPRD</span>
                        <span class="block text-sm font-medium text-blue-600">Tapanuli Selatan</span>
                    </div>
                </div>
                
                <div class="hidden md:flex items-center space-x-8">
                    <a href="{{ route('home') }}" class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}">Beranda</a>
                    <a href="{{ route('profil.anggota') }}" class="nav-link {{ request()->routeIs('profil.anggota') ? 'active' : '' }}">Profil Anggota</a>
                    <a href="{{ route('layanan.aspirasi') }}" class="nav-link {{ request()->routeIs('layanan.aspirasi') ? 'active' : '' }}">Layanan Aspirasi</a>
                    <a href="{{ route('berita') }}" class="nav-link {{ request()->routeIs('berita') ? 'active' : '' }}">Berita</a>
                    <a href="{{ route('tentang') }}" class="nav-link {{ request()->routeIs('tentang') ? 'active' : '' }}">Tentang</a>
                    <a href="{{ route('kontak') }}" class="nav-link {{ request()->routeIs('kontak') ? 'active' : '' }}">Kontak</a>
                    <button class="text-gray-400 hover:text-blue-600">
                        <i class="fa-solid fa-magnifying-glass"></i>
                    </button>
                </div>
            </div>
        </div>
    </nav>

    <!-- 2. WRAPPER KONTEN, menambah main dengan class flex-grow guna bertugas mendorong sisa 
        area kosong agar footer selalu dipaksa ke paling bawah-->
    <main class="flex-grow">
        @yield('content')
    </main>
    <footer class="bg-dark-footer text-white pt-16 mt-auto">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 mb-12">
                <div>
                    <div class="flex items-center mb-6">
                        <img src="{{ asset('images/logo.png') }}" alt="Logo" class="h-20 w-auto">
                        <div class="ml-4">
                            <h2 class="text-xl font-bold uppercase leading-tight">Dewan Perwakilan Rakyat Daerah</h2>
                            <p class="text-blue-300 font-medium">Tapanuli Selatan</p>
                        </div>
                    </div>
                    <p class="text-blue-100 text-sm leading-relaxed max-w-md opacity-80">
                        Dewan Perwakilan Rakyat Daerah Kabupaten Tapanuli Selatan yang bertugas melaksanakan fungsi legislasi, anggaran, dan pengawasan untuk kepentingan masyarakat.
                    </p>
                    <div class="flex space-x-4 mt-8">
                        <a href="#" class="w-10 h-10 rounded-full bg-blue-800 flex items-center justify-center hover:bg-blue-700 transition-colors"><i class="fa-brands fa-facebook-f"></i></a>
                        <a href="#" class="w-10 h-10 rounded-full bg-blue-800 flex items-center justify-center hover:bg-blue-700 transition-colors"><i class="fa-brands fa-x-twitter"></i></a>
                        <a href="#" class="w-10 h-10 rounded-full bg-blue-800 flex items-center justify-center hover:bg-blue-700 transition-colors"><i class="fa-brands fa-instagram"></i></a>
                        <a href="#" class="w-10 h-10 rounded-full bg-blue-800 flex items-center justify-center hover:bg-blue-700 transition-colors"><i class="fa-brands fa-youtube"></i></a>
                    </div>
                </div>
                <div class="lg:pl-20">
                    <h3 class="text-lg font-bold mb-6">Kontak</h3>
                    <ul class="space-y-5 text-sm">
                        <li class="flex items-start">
                            <i class="fa-solid fa-location-dot mt-1 text-blue-400 mr-4"></i>
                            <span class="opacity-80">Jl. Prof. Lafran Pane Kilang Papan, Sipirok, Kabupaten Tapanuli Selatan Sumatera Utara</span>
                        </li>
                        <li class="flex items-center">
                            <i class="fa-solid fa-phone text-blue-400 mr-4"></i>
                            <span class="opacity-80">(061) 123-4567</span>
                        </li>
                        <li class="flex items-center">
                            <i class="fa-solid fa-envelope text-blue-400 mr-4"></i>
                            <span class="opacity-80">info@dprd-tapsel.go.id</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        
        <div class="bg-copyright py-6 mt-12 border-t border-white/5">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex flex-col md:flex-row justify-between items-center text-xs text-gray-400">
                <p>© 2026 DPRD Tapanuli Selatan. Hak Cipta Dilindungi Undang-Undang.</p>
                <div class="flex space-x-6 mt-4 md:mt-0">
                    <a href="https://tapselkab.go.id/" class="hover:text-white transition-colors">Pemerintah Tapsel <i class="fa-solid fa-arrow-up-right-from-square ml-1 text-[10px]"></i></a>
                    <a href="https://indonesia.go.id/" class="hover:text-white transition-colors">Portal Nasional <i class="fa-solid fa-arrow-up-right-from-square ml-1 text-[10px]"></i></a>
                </div>
            </div>
        </div>
    </footer>
</body>
</html>