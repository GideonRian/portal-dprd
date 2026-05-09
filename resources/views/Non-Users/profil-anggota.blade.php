@extends('Non-Users.layouts.main')

@section('title', 'Profil Anggota')

@section('content')
    <style>
        .member-card {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            border: 1px solid #f3f4f6;
            border-radius: 1rem;
            overflow: hidden;
        }

        .member-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
        }

        .member-image {
            width: 100%;
            height: 280px;
            object-fit: cover;
            object-position: top;
        }

        .badge-category {
            position: absolute;
            bottom: -12px;
            right: 20px;
            padding: 4px 16px;
            border-radius: 9999px;
            font-weight: bold;
            font-size: 0.75rem;
            color: white;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
        }
    </style>

    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">

        <div class="flex items-start mb-8">
            <div class="bg-blue-600 p-4 rounded-xl mr-5">
                <i class="fa-solid fa-users-viewfinder text-white text-3xl"></i>
            </div>
            <div>
                <h1 class="text-3xl font-bold text-gray-900">Profil Anggota DPRD</h1>
                <p class="text-gray-500 font-medium">Tapanuli Selatan - Periode 2024-2029</p>
                <p class="mt-2 text-gray-600 max-w-2xl">Kenali lebih dekat anggota DPRD yang mewakili aspirasi masyarakat
                    Tapanuli Selatan</p>
            </div>
        </div>

        <div class="flex flex-col md:flex-row gap-4 mb-6">
            <div class="relative flex-grow">
                <i class="fa-solid fa-magnifying-glass absolute left-4 top-1/2 -translate-y-1/2 text-gray-400"></i>
                <input type="text" placeholder="Cari nama anggota, jabatan, atau daerah pemilihan..."
                    class="w-full pl-11 pr-4 py-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-blue-500 outline-none transition text-sm">
            </div>
            <button
                class="bg-blue-600 hover:bg-blue-700 text-white px-8 py-2.5 rounded-lg font-semibold flex items-center justify-center transition-colors shadow-sm">
                <i class="fa-solid fa-sliders mr-2"></i> Filter
            </button>
        </div>

        <p class="text-sm text-gray-500 mb-8">Menampilkan <span
                class="font-bold text-gray-800">{{ $anggotas->count() }}</span> anggota</p>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 mb-12">

            @forelse($anggotas as $item)
                <div class="member-card bg-white">
                    <div class="relative">
                        <img src="{{ $item->foto ? asset('storage/' . $item->foto) : 'https://ui-avatars.com/api/?name=' . urlencode($item->nama) . '&background=random' }}"
                            alt="{{ $item->nama }}" class="member-image">

                        <div
                            class="badge-category {{ str_contains(strtolower($item->komisi), 'pimpinan') ? 'bg-red-500' : 'bg-blue-600' }}">
                            {{ $item->komisi }}
                        </div>
                    </div>

                    <div class="p-6 mt-2">
                        <h3 class="text-lg font-bold text-gray-900 leading-tight mb-1">{{ $item->nama }}</h3>
                        <p class="text-sm font-semibold text-blue-600 mb-4">{{ $item->jabatan }}</p>

                        <div class="space-y-2 mb-6">
                            <div class="flex items-center text-xs text-gray-500">
                                <span class="w-2 h-2 rounded-full bg-yellow-500 mr-2"></span>
                                {{ $item->partai }}
                            </div>
                            <div class="flex items-center text-xs text-gray-500">
                                <span class="w-2 h-2 rounded-full bg-green-500 mr-2"></span>
                                {{ $item->dapil }}
                            </div>
                            @if ($item->badan)
                                <div class="flex items-center text-xs text-gray-500">
                                    <span class="w-2 h-2 rounded-full bg-purple-500 mr-2"></span>
                                    {{ $item->badan }}
                                </div>
                            @endif
                        </div>

                        <div class="pt-4 border-t border-gray-100 space-y-3">
                            <div class="flex items-center text-xs text-gray-600">
                                <i class="fa-solid fa-phone text-blue-600 w-5"></i>
                                {{ $item->telepon ?? 'Tidak ada data telepon' }}
                            </div>
                            <div class="flex items-center text-xs text-gray-600">
                                <i class="fa-solid fa-envelope text-blue-600 w-5"></i>
                                <span
                                    class="truncate">{{ $item->email ?? strtolower(str_replace([' ', '.', ',', "'"], '', $item->nama)) . '@dprd-tapsel.go.id' }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div
                    class="col-span-1 md:col-span-2 lg:col-span-3 text-center py-16 bg-gray-50 rounded-2xl border border-dashed border-gray-300">
                    <i class="fa-solid fa-user-xmark text-4xl text-gray-300 mb-3"></i>
                    <p class="text-gray-500 font-medium">Belum ada data anggota DPRD yang dipublikasikan.</p>
                </div>
            @endforelse

        </div>
    </main>
@endsection
