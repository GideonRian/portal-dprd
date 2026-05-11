@extends('Non-Users.layouts.main')

@section('title', 'Pusat Dokumen')

@section('content')
    <div class="bg-gray-50 min-h-screen pb-12">
        <!-- HEADER SECTION (Warna Merah/Magenta) -->
        <div class="bg-[#D12053] pt-16 pb-28 px-4 text-center">
            <div
                class="inline-flex items-center justify-center p-3 bg-white/20 rounded-2xl mb-6 backdrop-blur-sm border border-white/30">
                <i class="fa-solid fa-file-lines text-white text-4xl"></i>
            </div>
            <h1 class="text-4xl md:text-5xl font-bold text-white mb-4">Pusat Dokumen</h1>
            <p class="text-rose-100 max-w-2xl mx-auto text-lg leading-relaxed">
                Akses dokumen resmi DPRD Tapanuli Selatan termasuk Peraturan Daerah, Keputusan, Risalah Rapat, dan dokumen
                penting lainnya.
            </p>
        </div>

        <main class="max-w-6xl mx-auto px-4 -mt-16">
            <!-- FILTER BAR (Floating) -->
            <div class="bg-white rounded-2xl shadow-xl p-6 mb-8 border border-gray-100">
                <form action="" method="GET" class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <!-- Search -->
                    <div class="relative">
                        <i class="fa-solid fa-magnifying-glass absolute left-4 top-1/2 -translate-y-1/2 text-gray-400"></i>
                        <input type="text" name="search" placeholder="Cari dokumen..."
                            class="w-full pl-11 pr-4 py-3 rounded-xl border border-gray-200 focus:ring-2 focus:ring-rose-500 focus:border-rose-500 transition-all outline-none">
                    </div>
                    <!-- Category -->
                    <div class="relative">
                        <i class="fa-solid fa-filter absolute left-4 top-1/2 -translate-y-1/2 text-gray-400"></i>
                        <select name="kategori"
                            class="w-full pl-11 pr-4 py-3 rounded-xl border border-gray-200 focus:ring-2 focus:ring-rose-500 focus:border-rose-500 appearance-none outline-none">
                            <option value="">Semua Dokumen</option>
                            <option value="Perda">Peraturan Daerah</option>
                            <option value="Keputusan">Keputusan DPRD</option>
                        </select>
                    </div>
                    <!-- Year -->
                    <div class="relative">
                        <i class="fa-solid fa-calendar-days absolute left-4 top-1/2 -translate-y-1/2 text-gray-400"></i>
                        <select name="tahun"
                            class="w-full pl-11 pr-4 py-3 rounded-xl border border-gray-200 focus:ring-2 focus:ring-rose-500 focus:border-rose-500 appearance-none outline-none">
                            <option value="">Semua Tahun</option>
                            <option value="2026">2026</option>
                            <option value="2025">2025</option>
                        </select>
                    </div>
                </form>
                <div class="mt-4 text-sm text-gray-500 font-medium">
                    Menampilkan <span class="text-rose-600">{{ $dokumens->count() }}</span> dokumen
                </div>
            </div>

            <!-- DAFTAR DOKUMEN -->
            <div class="space-y-4">
                @forelse($dokumens as $doc)
                    <div
                        class="bg-white rounded-2xl p-5 md:p-6 shadow-sm border border-gray-100 hover:shadow-md transition-all flex flex-col md:flex-row md:items-center gap-6 group">

                        <!-- Icon File -->
                        <div
                            class="hidden md:flex shrink-0 w-16 h-16 bg-gray-50 rounded-xl items-center justify-center group-hover:bg-rose-50 transition-colors">
                            @php $ext = strtolower(pathinfo($doc->file_path, PATHINFO_EXTENSION)); @endphp
                            <i
                                class="fa-solid @if ($ext == 'pdf') fa-file-pdf text-rose-500 @elseif(in_array($ext, ['xls', 'xlsx'])) fa-file-excel text-green-500 @else fa-file-lines text-rose-500 @endif text-3xl"></i>
                        </div>

                        <!-- Content -->
                        <div class="flex-1">
                            <div class="flex flex-wrap items-center gap-2 mb-3">
                                <span
                                    class="bg-rose-600 text-white text-[10px] uppercase tracking-wider font-bold px-3 py-1 rounded-full">
                                    {{ $doc->kategori }}
                                </span>
                                <span
                                    class="bg-gray-100 text-gray-600 text-[10px] font-bold px-3 py-1 rounded-full border border-gray-200">
                                    {{ strtoupper($ext) }} • {{ $doc->ukuran_file }}
                                </span>
                            </div>

                            <h3 class="text-lg font-bold text-gray-900 mb-1 group-hover:text-rose-600 transition-colors">
                                {{ $doc->judul }}
                            </h3>
                            <p class="text-gray-500 text-sm mb-3 line-clamp-1">{{ $doc->deskripsi }}</p>

                            <div class="flex items-center text-xs text-gray-400 font-medium">
                                <i class="fa-regular fa-calendar-check mr-1.5"></i>
                                {{ \Carbon\Carbon::parse($doc->created_at)->translatedFormat('d F Y') }}
                            </div>
                        </div>

                        <!-- Tombol Aksi -->
                        <div class="flex flex-row md:flex-col lg:flex-row gap-3 border-t md:border-t-0 pt-4 md:pt-0">
                            @if ($ext == 'pdf')
                                <a href="{{ asset('storage/' . $doc->file_path) }}" target="_blank"
                                    class="flex-1 md:flex-none inline-flex items-center justify-center gap-2 px-6 py-2.5 rounded-xl border-2 border-rose-600 text-rose-600 font-bold text-sm hover:bg-rose-50 transition-colors">
                                    <i class="fa-regular fa-eye text-base"></i> Preview
                                </a>
                            @endif

                            <a href="{{ asset('storage/' . $doc->file_path) }}" download
                                class="flex-1 md:flex-none inline-flex items-center justify-center gap-2 px-6 py-2.5 rounded-xl bg-rose-600 text-white font-bold text-sm hover:bg-rose-700 shadow-lg shadow-rose-200 transition-all">
                                <i class="fa-solid fa-download"></i> Download
                            </a>
                        </div>
                    </div>
                @empty
                    <div class="bg-white rounded-3xl p-20 text-center border border-dashed border-gray-300">
                        <div class="w-20 h-20 bg-gray-50 rounded-full flex items-center justify-center mx-auto mb-4">
                            <i class="fa-regular fa-folder-open text-4xl text-gray-300"></i>
                        </div>
                        <h3 class="text-gray-900 font-bold text-xl mb-1">Belum Ada Dokumen</h3>
                        <p class="text-gray-500">Silakan cek kembali nanti untuk pembaruan data.</p>
                    </div>
                @endforelse
            </div>
        </main>
    </div>
@endsection
