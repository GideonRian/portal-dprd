@extends('Staff.layouts.app')

@section('title', 'Kelola Dokumen')

@section('content')
    <div class="w-full px-4 sm:px-6 lg:px-8 py-8 max-w-screen-xl mx-auto">
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 mb-8">
            <div class="flex items-center gap-4">
                <div class="w-14 h-14 bg-rose-600 rounded-2xl flex items-center justify-center text-white shadow-md">
                    <i class="fa-solid fa-file-lines text-2xl"></i>
                </div>
                <div>
                    <h2 class="text-3xl font-extrabold text-gray-900 mb-1">Kelola Dokumen</h2>
                    <p class="text-gray-500 font-medium text-sm">Kelola dokumen resmi DPRD Tapanuli Selatan</p>
                </div>
            </div>
            <a href="{{ route('staff.dokumen.create') }}"
                class="bg-rose-600 hover:bg-rose-700 text-white px-6 py-3 rounded-xl font-bold transition shadow-md flex items-center gap-2">
                <i class="fa-solid fa-plus"></i> Tambah Dokumen Baru
            </a>
        </div>

        @if (session('success'))
            <div class="bg-green-100 border-l-4 border-green-500 text-green-700 px-4 py-3 rounded-xl mb-6 shadow-sm"><i
                    class="fa-solid fa-check-circle mr-1"></i> {{ session('success') }}</div>
        @endif

        <!-- 4 Kotak Statistik -->
        <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-6">
            <div class="bg-blue-500 text-white p-5 rounded-2xl shadow-md border-b-4 border-blue-700">
                <h3 class="text-3xl font-bold mb-1">{{ $stats['total'] }}</h3>
                <p class="text-sm font-medium">Total Dokumen</p>
            </div>
            <div class="bg-purple-500 text-white p-5 rounded-2xl shadow-md border-b-4 border-purple-700">
                <h3 class="text-3xl font-bold mb-1">{{ $stats['perda'] }}</h3>
                <p class="text-sm font-medium">Peraturan Daerah</p>
            </div>
            <div class="bg-emerald-500 text-white p-5 rounded-2xl shadow-md border-b-4 border-emerald-700">
                <h3 class="text-3xl font-bold mb-1">{{ $stats['risalah'] }}</h3>
                <p class="text-sm font-medium">Risalah Rapat</p>
            </div>
            <div class="bg-amber-500 text-white p-5 rounded-2xl shadow-md border-b-4 border-amber-700">
                <h3 class="text-3xl font-bold mb-1">{{ $stats['laporan'] }}</h3>
                <p class="text-sm font-medium">Laporan</p>
            </div>
        </div>

        <!-- Filter & Search -->
        <form action="{{ route('staff.dokumen.index') }}" method="GET" class="flex flex-col md:flex-row gap-4 mb-8">
            <div class="relative flex-1">
                <i class="fa-solid fa-magnifying-glass absolute left-4 top-1/2 -translate-y-1/2 text-gray-400"></i>
                <input type="text" name="search" value="{{ $search ?? '' }}"
                    placeholder="Cari judul, deskripsi, atau nama file..."
                    class="w-full pl-11 pr-4 py-3 bg-white border border-rose-300 rounded-xl focus:ring-2 focus:ring-rose-500 outline-none text-sm shadow-sm">
            </div>
            <div class="w-full md:w-64 relative">
                <select name="kategori" onchange="this.form.submit()"
                    class="w-full pl-4 pr-10 py-3 bg-white border border-rose-300 rounded-xl focus:ring-2 focus:ring-rose-500 outline-none text-sm appearance-none shadow-sm text-gray-700">
                    <option value="Semua Kategori">Semua Kategori</option>
                    <option value="Peraturan Daerah" {{ ($kategori ?? '') == 'Peraturan Daerah' ? 'selected' : '' }}>
                        Peraturan Daerah</option>
                    <option value="Keputusan DPRD" {{ ($kategori ?? '') == 'Keputusan DPRD' ? 'selected' : '' }}>Keputusan
                        DPRD</option>
                    <option value="Risalah Rapat" {{ ($kategori ?? '') == 'Risalah Rapat' ? 'selected' : '' }}>Risalah
                        Rapat</option>
                    <option value="Laporan Keuangan" {{ ($kategori ?? '') == 'Laporan Keuangan' ? 'selected' : '' }}>
                        Laporan Keuangan</option>
                    <option value="Hasil Hearing" {{ ($kategori ?? '') == 'Hasil Hearing' ? 'selected' : '' }}>Hasil
                        Hearing</option>
                    <option value="Peraturan Tata Tertib"
                        {{ ($kategori ?? '') == 'Peraturan Tata Tertib' ? 'selected' : '' }}>Peraturan Tata Tertib</option>
                </select>
                <i
                    class="fa-solid fa-caret-down absolute right-4 top-1/2 -translate-y-1/2 text-gray-400 pointer-events-none"></i>
            </div>
        </form>

        <p class="text-sm text-gray-500 mb-4">Menampilkan {{ $dokumens->count() }} dokumen</p>

        <!-- Daftar Dokumen Bergaya List Card -->
        <div class="space-y-4">
            @forelse($dokumens as $doc)
                <div
                    class="bg-white rounded-2xl shadow-sm hover:shadow-md transition border border-gray-100 p-5 flex flex-col md:flex-row md:items-center justify-between gap-4">

                    <div class="flex-1">
                        <div class="flex items-center gap-3 mb-2 text-xs">
                            <span
                                class="bg-blue-50 text-blue-600 font-bold px-2.5 py-1 rounded-md">{{ $doc->kategori }}</span>
                            <span class="font-bold text-gray-700">{{ $doc->tipe_file }} • {{ $doc->ukuran_file }}</span>
                            <span class="text-gray-400"><i class="fa-regular fa-calendar mr-1"></i>
                                {{ \Carbon\Carbon::parse($doc->created_at)->format('d F Y') }}</span>
                        </div>
                        <h3 class="text-lg font-bold text-gray-900 mb-1">{{ $doc->judul }}</h3>
                        <p class="text-gray-500 text-sm mb-2 line-clamp-1">{{ $doc->deskripsi }}</p>
                        <div
                            class="text-xs font-mono text-gray-400 bg-gray-50 px-2 py-1 rounded w-max border border-gray-100">
                            File: {{ $doc->nama_file }}
                        </div>
                    </div>

                    <div class="flex flex-row md:flex-col gap-2 shrink-0">
                        <a href="{{ route('staff.dokumen.edit', $doc->id) }}"
                            class="w-full bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg font-medium text-sm flex items-center justify-center gap-2 transition shadow-sm">
                            <i class="fa-regular fa-pen-to-square"></i> Edit
                        </a>
                        <form action="{{ route('staff.dokumen.destroy', $doc->id) }}" method="POST"
                            onsubmit="return confirm('Hapus dokumen ini secara permanen?');" class="w-full">
                            @csrf @method('DELETE')
                            <button type="submit"
                                class="w-full bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded-lg font-medium text-sm flex items-center justify-center gap-2 transition shadow-sm">
                                <i class="fa-regular fa-trash-can"></i> Hapus
                            </button>
                        </form>
                    </div>
                </div>
            @empty
                <div class="text-center py-12 bg-white rounded-3xl border border-gray-200">
                    <i class="fa-regular fa-folder-open text-5xl text-gray-300 mb-4"></i>
                    <p class="text-gray-500">Belum ada dokumen yang sesuai.</p>
                </div>
            @endforelse
        </div>
    </div>
@endsection
