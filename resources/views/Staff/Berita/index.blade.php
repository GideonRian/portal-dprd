@extends('Staff.layouts.app')

@section('title', 'Kelola Berita')

@section('content')
    <main class="w-full px-4 sm:px-6 lg:px-8 py-8 max-w-screen-2xl mx-auto">
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 mb-8">
            <div class="flex items-center gap-4">
                <div class="w-16 h-16 bg-purple-600 rounded-2xl flex items-center justify-center text-white shadow-md">
                    <i class="fa-regular fa-newspaper text-2xl"></i>
                </div>
                <div>
                    <h2 class="text-3xl font-extrabold text-gray-900 mb-1">Kelola Berita</h2>
                    <p class="text-gray-500 font-medium text-sm">Tambah, edit, atau hapus berita</p>
                </div>
            </div>
            <a href="{{ route('staff.berita.create') }}"
                class="bg-purple-600 hover:bg-purple-700 text-white px-6 py-3 rounded-xl font-bold transition shadow-md flex items-center gap-2">
                <i class="fa-solid fa-plus"></i> Tambah Berita
            </a>
        </div>

        @if (session('success'))
            <div class="bg-green-100 border-l-4 border-green-500 text-green-700 px-4 py-3 rounded-xl mb-6 shadow-sm">
                <i class="fa-solid fa-check-circle mr-1"></i> {{ session('success') }}
            </div>
        @endif

        <!-- Filter & Pencarian -->
        <form action="{{ route('staff.berita.index') }}" method="GET" class="flex flex-col md:flex-row gap-4 mb-8">
            <div class="relative flex-1">
                <i class="fa-solid fa-magnifying-glass absolute left-4 top-1/2 -translate-y-1/2 text-gray-400"></i>
                <input type="text" name="search" value="{{ $search ?? '' }}"
                    placeholder="Cari judul atau konten berita..."
                    class="w-full pl-11 pr-4 py-3.5 bg-white border border-gray-200 rounded-2xl focus:ring-2 focus:ring-purple-500 outline-none transition text-sm shadow-sm">
            </div>
            <div class="w-full md:w-64 relative">
                <select name="kategori" onchange="this.form.submit()"
                    class="w-full pl-4 pr-10 py-3.5 bg-white border border-gray-200 rounded-2xl focus:ring-2 focus:ring-purple-500 outline-none transition text-sm appearance-none shadow-sm cursor-pointer">
                    <option value="Semua" {{ ($kategori ?? '') == 'Semua' ? 'selected' : '' }}>Semua Kategori</option>
                    <option value="Rapat Paripurna" {{ ($kategori ?? '') == 'Rapat Paripurna' ? 'selected' : '' }}>
                        Rapat Paripurna</option>
                    <option value="Kunjungan Kerja" {{ ($kategori ?? '') == 'Kunjungan Kerja' ? 'selected' : '' }}>
                        Kunjungan Kerja</option>
                    <option value="Hearing" {{ ($kategori ?? '') == 'Hearing' ? 'selected' : '' }}>Hearing</option>
                    <option value="Peraturan Daerah" {{ ($kategori ?? '') == 'Peraturan Daerah' ? 'selected' : '' }}>
                        Peraturan Daerah</option>
                    <option value="Kegiatan Sosial" {{ ($kategori ?? '') == 'Kegiatan Sosial' ? 'selected' : '' }}>
                        Kegiatan Sosial</option>
                </select>
                <i
                    class="fa-solid fa-chevron-down absolute right-4 top-1/2 -translate-y-1/2 text-gray-400 pointer-events-none"></i>
            </div>
        </form>

        <!-- Grid Cards Berita -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @forelse($beritas as $berita)
                <div
                    class="bg-white rounded-3xl overflow-hidden border border-gray-100 shadow-sm hover:shadow-md transition flex flex-col relative group">

                    <!-- Badge Featured (Kiri Atas Gambar) -->
                    @if ($berita->is_featured)
                        <div
                            class="absolute top-4 left-4 bg-red-500 text-white text-[10px] font-black tracking-wider px-3 py-1 rounded-md z-10 uppercase shadow-sm">
                            FEATURED</div>
                    @endif

                    <!-- Gambar -->
                    <div class="h-48 bg-gray-100 relative overflow-hidden flex items-center justify-center">
                        @if (is_array($berita->gambar) && count($berita->gambar) > 0)
                            <img src="{{ asset('storage/' . $berita->gambar[0]) }}" class="w-full h-full object-cover">
                        @else
                            <i class="fa-regular fa-image text-5xl text-gray-300"></i>
                        @endif
                    </div>

                    <!-- Konten Card -->
                    <div class="p-6 flex-1 flex flex-col">
                        <div class="flex items-center gap-3 mb-3 text-xs">
                            <span
                                class="bg-purple-50 text-purple-600 font-bold px-2.5 py-1 rounded-md">{{ $berita->kategori }}</span>
                            <span class="text-gray-500 flex items-center gap-1"><i class="fa-regular fa-calendar"></i>
                                {{ \Carbon\Carbon::parse($berita->tanggal)->format('d F Y') }}</span>
                        </div>

                        <h3 class="font-bold text-gray-900 text-lg leading-tight mb-2 line-clamp-2">
                            {{ $berita->judul }}</h3>
                        <p class="text-gray-500 text-sm mb-6 line-clamp-2">{{ $berita->ringkasan }}</p>

                        <!-- Tombol Aksi di Bawah Card -->
                        <div class="mt-auto flex items-center justify-between gap-2 pt-4 border-t border-gray-50">

                            <!-- Form Set Unggulan -->
                            <form action="{{ route('staff.berita.toggle_featured', $berita->id) }}" method="POST"
                                class="flex-1">
                                @csrf @method('PATCH')
                                @if ($berita->is_featured)
                                    <button type="submit"
                                        class="w-full py-2 bg-yellow-50 border border-yellow-200 text-yellow-700 rounded-xl text-xs font-bold hover:bg-yellow-100 transition shadow-sm">
                                        <i class="fa-solid fa-star text-yellow-500 mr-1"></i> Batal Unggulan
                                    </button>
                                @else
                                    <button type="submit"
                                        class="w-full py-2 bg-gray-50 border border-gray-200 text-gray-600 rounded-xl text-xs font-bold hover:bg-gray-100 transition">
                                        Set Unggulan
                                    </button>
                                @endif
                            </form>

                            <!-- Edit & Delete -->
                            <a href="{{ route('staff.berita.edit', $berita->id) }}"
                                class="w-10 h-10 flex items-center justify-center bg-purple-50 text-purple-600 rounded-xl hover:bg-purple-600 hover:text-white transition">
                                <i class="fa-regular fa-pen-to-square"></i>
                            </a>
                            <form action="{{ route('staff.berita.destroy', $berita->id) }}" method="POST"
                                class="inline-block">
                                @csrf @method('DELETE')
                                <button type="submit" onclick="return confirm('Hapus berita ini?')"
                                    class="w-10 h-10 flex items-center justify-center bg-red-50 text-red-600 rounded-xl hover:bg-red-600 hover:text-white transition">
                                    <i class="fa-regular fa-trash-can"></i>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-span-1 md:col-span-3 text-center py-16 bg-white rounded-3xl border border-gray-100">
                    <i class="fa-regular fa-newspaper text-5xl text-gray-300 mb-4"></i>
                    <p class="text-gray-500 font-medium">Belum ada berita yang diterbitkan.</p>
                </div>
            @endforelse
        </div>
    </main>
@endsection
