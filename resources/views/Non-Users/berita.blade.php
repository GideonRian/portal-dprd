@extends('Non-Users.layouts.main')

@section('title', 'Kumpulan Berita')

@section('content')
<main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    
    <!-- HEADER HALAMAN -->
    <div class="flex items-start mb-12">
        <div class="bg-purple-600 p-4 rounded-xl mr-5 shadow-lg shadow-purple-200">
            <i class="fa-regular fa-newspaper text-white text-3xl"></i>
        </div>
        <div>
            <h1 class="text-3xl font-extrabold text-gray-900 mb-1">Berita DPRD</h1>
            <p class="text-gray-500 font-medium text-sm md:text-base">Kumpulan informasi, kegiatan, dan liputan terbaru dari DPRD Tapanuli Selatan</p>
        </div>
    </div>

    <!-- BERITA UNGGULAN (FEATURED) -->
    @if($featured)
    <div class="bg-white rounded-3xl shadow-xl overflow-hidden mb-16 border border-gray-100 flex flex-col md:flex-row group">
        <!-- Gambar Featured -->
        <div class="md:w-1/2 h-64 md:h-auto relative overflow-hidden bg-gray-100">
            <!-- PERBAIKAN: Cek apakah gambar adalah array, dan panggil index ke [0] -->
            @if(is_array($featured->gambar) && count($featured->gambar) > 0)
                <img src="{{ asset('storage/'.$featured->gambar[0]) }}" alt="{{ $featured->judul }}" class="w-full h-full object-cover group-hover:scale-105 transition duration-700">
            @else
                <div class="w-full h-full flex items-center justify-center"><i class="fa-regular fa-image text-5xl text-gray-300"></i></div>
            @endif
            
            <div class="absolute top-4 left-4 bg-red-500 text-white text-xs font-black px-3 py-1.5 rounded-md uppercase tracking-widest shadow-lg">
                FEATURED
            </div>
        </div>
        
        <!-- Info Featured -->
        <div class="md:w-1/2 p-8 md:p-12 flex flex-col justify-center">
            <div class="flex items-center gap-3 mb-4 text-sm">
                <span class="bg-purple-100 text-purple-700 font-bold px-3 py-1 rounded-full">{{ $featured->kategori }}</span>
                <span class="text-gray-500"><i class="fa-regular fa-calendar mr-1"></i> {{ \Carbon\Carbon::parse($featured->tanggal)->translatedFormat('d F Y') }}</span>
            </div>
            
            <h2 class="text-2xl md:text-4xl font-extrabold text-gray-900 mb-4 leading-tight group-hover:text-purple-600 transition">
                {{ $featured->judul }}
            </h2>
            
            <p class="text-gray-600 mb-8 leading-relaxed line-clamp-3">
                {{ $featured->ringkasan }}
            </p>
            
            <a href="{{ route('berita.detail', $featured->slug) }}" class="bg-purple-600 hover:bg-purple-700 text-white px-7 py-3.5 rounded-xl font-bold text-sm w-max transition shadow-md shadow-purple-200 flex items-center gap-2">
                Baca Selengkapnya <i class="fa-solid fa-arrow-right"></i>
            </a>
        </div>
    </div>
    @endif

    <!-- GRID BERITA LAINNYA -->
    <h3 class="text-2xl font-bold text-gray-900 mb-6 border-b border-gray-200 pb-4">Berita Terbaru</h3>
    
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 mb-16">
        @forelse($beritas as $item)
            <!-- Sembunyikan berita yang sudah tampil di Featured agar tidak dobel -->
            @if(!($featured && $featured->id == $item->id))
            <div class="bg-white rounded-2xl shadow-md hover:shadow-xl overflow-hidden border border-gray-100 group flex flex-col transition-all duration-300 transform hover:-translate-y-1">
                
                <!-- Gambar Grid -->
                <div class="relative h-56 overflow-hidden bg-gray-100">
                    <!-- PERBAIKAN: Cek apakah gambar adalah array, dan panggil index ke [0] -->
                    @if(is_array($item->gambar) && count($item->gambar) > 0)
                        <img src="{{ asset('storage/'.$item->gambar[0]) }}" alt="{{ $item->judul }}" class="w-full h-full object-cover group-hover:scale-110 transition duration-500">
                    @else
                        <div class="w-full h-full flex items-center justify-center"><i class="fa-regular fa-image text-4xl text-gray-300"></i></div>
                    @endif
                    
                    <div class="absolute top-4 left-4 bg-white/90 backdrop-blur-sm text-purple-700 text-xs font-bold px-3 py-1.5 rounded-full shadow-sm">
                        {{ $item->kategori }}
                    </div>
                </div>
                
                <!-- Info Grid -->
                <div class="p-6 flex flex-col flex-1">
                    <p class="text-gray-500 text-xs mb-3 font-medium">
                        <i class="fa-regular fa-calendar mr-1"></i> {{ \Carbon\Carbon::parse($item->tanggal)->translatedFormat('d F Y') }}
                    </p>
                    <h3 class="text-xl font-extrabold text-gray-900 mb-3 leading-snug group-hover:text-purple-600 transition line-clamp-2">
                        {{ $item->judul }}
                    </h3>
                    <p class="text-gray-600 text-sm mb-6 line-clamp-3 flex-1 leading-relaxed">
                        {{ $item->ringkasan }}
                    </p>
                    
                    <a href="{{ route('berita.detail', $item->slug) }}" class="text-purple-600 font-bold text-sm hover:text-purple-800 transition flex items-center gap-1 mt-auto w-max">
                        Baca Selengkapnya <i class="fa-solid fa-arrow-right text-xs"></i>
                    </a>
                </div>
            </div>
            @endif
        @empty
            <div class="col-span-1 md:col-span-3 text-center py-20 bg-gray-50 rounded-3xl border border-dashed border-gray-300">
                <i class="fa-regular fa-newspaper text-5xl text-gray-400 mb-4"></i>
                <p class="text-gray-500 font-medium text-lg">Belum ada berita yang dipublikasikan saat ini.</p>
            </div>
        @endforelse
    </div>

</main>
@endsection