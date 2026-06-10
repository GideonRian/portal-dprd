@extends('Pimpinan-Sekretariat.layouts.app')

@section('title', 'Statistics Dashboard')

@section('content')
    <div class="w-full px-4 sm:px-6 lg:px-8 py-8 max-w-screen-2xl mx-auto font-sans text-gray-800">

        <a href="{{ route('sekretaris.dashboard') }}"
            class="inline-flex items-center text-purple-600 font-medium hover:underline mb-6 text-sm">
            <i class="fa-solid fa-arrow-left mr-2"></i> Kembali ke Dashboard
        </a>

        <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-8 gap-4">
            <div class="flex items-center gap-4">
                <div class="w-12 h-12 bg-green-600 rounded-xl flex items-center justify-center text-white shadow-md">
                    <i class="fa-solid fa-chart-simple text-xl"></i>
                </div>
                <div>
                    <h1 class="text-3xl font-extrabold text-gray-900 leading-tight">Statistik</h1>
                    <p class="text-gray-500 text-sm font-medium mt-1">Statistik lengkap website dan konten</p>
                </div>
            </div>

            <a href="{{ route('sekretaris.stats.export') }}"
                class="bg-purple-600 hover:bg-purple-700 text-white px-5 py-2.5 rounded-xl font-bold shadow-md flex items-center gap-2 transition w-max">
                <i class="fa-solid fa-download"></i> Export Report
            </a>
        </div>

        <h2 class="text-xl font-bold mb-4">Overview</h2>

        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-4 mb-8">
            <div class="bg-blue-500 rounded-2xl p-5 text-white shadow-md relative overflow-hidden">
                <div class="flex justify-between items-start mb-2">
                    <i class="fa-solid fa-users text-2xl opacity-80"></i>
                    <span class="bg-white/20 text-xs font-bold px-2 py-1 rounded-full flex items-center gap-1">
                        <i class="fa-solid fa-arrow-trend-up text-[10px]"></i> +{{ $overview['anggota']['trend'] }}
                    </span>
                </div>
                <h3 class="text-4xl font-black mb-1">{{ $overview['anggota']['total'] }}</h3>
                <p class="text-xs font-medium opacity-90">Total Anggota DPRD</p>
            </div>

            <div class="bg-purple-500 rounded-2xl p-5 text-white shadow-md relative overflow-hidden">
                <div class="flex justify-between items-start mb-2">
                    <i class="fa-regular fa-newspaper text-2xl opacity-80"></i>
                    <span class="bg-white/20 text-xs font-bold px-2 py-1 rounded-full flex items-center gap-1">
                        <i class="fa-solid fa-arrow-trend-up text-[10px]"></i> +{{ $overview['berita']['trend'] }}
                    </span>
                </div>
                <h3 class="text-4xl font-black mb-1">{{ $overview['berita']['total'] }}</h3>
                <p class="text-xs font-medium opacity-90">Total Berita</p>
            </div>

            <div class="bg-green-500 rounded-2xl p-5 text-white shadow-md relative overflow-hidden">
                <div class="flex justify-between items-start mb-2">
                    <i class="fa-regular fa-comments text-2xl opacity-80"></i>
                    <span class="bg-white/20 text-xs font-bold px-2 py-1 rounded-full flex items-center gap-1">
                        <i class="fa-solid fa-arrow-trend-up text-[10px]"></i> +{{ $overview['aspirasi']['trend'] }}
                    </span>
                </div>
                <h3 class="text-4xl font-black mb-1">{{ $overview['aspirasi']['total'] }}</h3>
                <p class="text-xs font-medium opacity-90">Aspirasi Masuk</p>
            </div>

            <div class="bg-red-500 rounded-2xl p-5 text-white shadow-md relative overflow-hidden">
                <div class="flex justify-between items-start mb-2">
                    <i class="fa-solid fa-file-invoice text-2xl opacity-80"></i>
                    <span class="bg-white/20 text-xs font-bold px-2 py-1 rounded-full flex items-center gap-1">
                        <i class="fa-solid fa-arrow-trend-up text-[10px]"></i> +{{ $overview['dokumen']['trend'] }}
                    </span>
                </div>
                <h3 class="text-4xl font-black mb-1">{{ $overview['dokumen']['total'] }}</h3>
                <p class="text-xs font-medium opacity-90">Total Dokumen</p>
            </div>

            <div class="bg-orange-500 rounded-2xl p-5 text-white shadow-md relative overflow-hidden">
                <div class="flex justify-between items-start mb-2">
                    <i class="fa-regular fa-calendar-days text-2xl opacity-80"></i>
                    <span class="bg-white/20 text-xs font-bold px-2 py-1 rounded-full flex items-center gap-1">
                        <i class="fa-solid fa-arrow-trend-up text-[10px]"></i> +{{ $overview['agenda']['trend'] }}
                    </span>
                </div>
                <h3 class="text-4xl font-black mb-1">{{ $overview['agenda']['total'] }}</h3>
                <p class="text-xs font-medium opacity-90">Agenda Kegiatan</p>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">

            <div class="bg-white border-2 border-red-500 rounded-2xl p-6 shadow-sm">
                <h3 class="text-lg font-bold mb-5">Status Aspirasi</h3>
                <div class="space-y-4">
                    @php $colorsAspirasi = ['Menunggu' => 'bg-yellow-400', 'Diproses' => 'bg-blue-500', 'Selesai' => 'bg-green-500', 'Ditolak' => 'bg-red-500']; @endphp
                    @foreach ($aspirasiStatus as $status => $count)
                        @php $percent = round(($count / $totalAspirasi) * 100); @endphp
                        <div>
                            <div class="flex justify-between text-sm font-bold mb-1">
                                <span class="flex items-center gap-2">
                                    <span class="w-3 h-3 rounded-full {{ $colorsAspirasi[$status] }}"></span>
                                    {{ $status }}
                                </span>
                                <span>{{ $count }}</span>
                            </div>
                            <div class="w-full bg-gray-100 rounded-full h-2.5">
                                <div class="{{ $colorsAspirasi[$status] }} h-2.5 rounded-full"
                                    style="width: {{ $percent }}%"></div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            <div class="bg-white border-2 border-red-500 rounded-2xl p-6 shadow-sm">
                <h3 class="text-lg font-bold mb-5">Berita per Kategori</h3>
                <div class="space-y-4">
                    @foreach ($kategoriBerita as $kategori => $count)
                        @php $percent = round(($count / $totalBerita) * 100); @endphp
                        <div>
                            <div class="flex justify-between text-sm font-bold mb-1">
                                <span>{{ $kategori }}</span>
                                <span>{{ $count }} ({{ $percent }}%)</span>
                            </div>
                            <div class="w-full bg-gray-100 rounded-full h-2.5">
                                <div class="bg-purple-600 h-2.5 rounded-full" style="width: {{ $percent }}%"></div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

        </div>

        <div class="bg-white border border-gray-200 rounded-2xl shadow-sm overflow-hidden mb-8">
            <div class="bg-purple-600 p-5 text-white">
                <h3 class="text-lg font-bold">Top Berita Paling Dilihat</h3>
                <p class="text-sm text-purple-200">Berita dengan views dan engagement tertinggi</p>
            </div>
            <div class="p-6 space-y-4">
                @foreach ($topBerita as $index => $berita)
                    <div
                        class="flex items-center gap-4 bg-gray-50 hover:bg-gray-100 transition p-4 rounded-xl border border-gray-100">
                        <div
                            class="w-10 h-10 shrink-0 bg-purple-600 text-white rounded-lg flex items-center justify-center font-bold text-sm shadow-sm">
                            #{{ $index + 1 }}
                        </div>
                        <div class="flex-1">
                            <h4 class="font-bold text-gray-900">{{ $berita->judul }}</h4>
                            <div class="text-xs text-gray-500 flex gap-4 mt-1">
                                <span><i class="fa-regular fa-eye mr-1"></i> {{ number_format($berita->views) }}
                                    views</span>
                                <span><i class="fa-regular fa-thumbs-up mr-1"></i> {{ number_format($berita->likes) }}
                                    likes</span>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <div class="bg-blue-50 border-2 border-blue-400 rounded-2xl p-6">
                <h3 class="font-bold text-blue-900 mb-4">Visitor Statistics</h3>
                <div class="space-y-2 text-sm">
                    <div class="flex justify-between text-blue-800"><span class="opacity-80">Total Visitors:</span> <strong
                            class="text-blue-900">{{ number_format($visitorStats['total']) }}</strong></div>
                    <div class="flex justify-between text-blue-800"><span class="opacity-80">This Month:</span> <strong
                            class="text-blue-900">{{ number_format($visitorStats['this_month']) }}</strong></div>
                    <div class="flex justify-between text-blue-800"><span class="opacity-80">Today:</span> <strong
                            class="text-blue-900">{{ number_format($visitorStats['today']) }}</strong></div>
                </div>
            </div>

            <div class="bg-green-50 border-2 border-green-400 rounded-2xl p-6">
                <h3 class="font-bold text-green-900 mb-4">User Engagement</h3>
                <div class="space-y-2 text-sm">
                    <div class="flex justify-between text-green-800"><span class="opacity-80">Avg. Time on Site:</span>
                        <strong class="text-green-900">{{ $avgTimeOnSite }}</strong>
                    </div>
                    <div class="flex justify-between text-green-800"><span class="opacity-80">Pages per Visit:</span>
                        <strong class="text-green-900">{{ $pagesPerVisit }}</strong>
                    </div>
                    <div class="flex justify-between text-green-800"><span class="opacity-80">Bounce Rate:</span> <strong
                            class="text-green-900">{{ $bounceRate }}</strong></div>
                </div>
            </div>

            <div class="bg-fuchsia-50 border-2 border-fuchsia-400 rounded-2xl p-6">
                <h3 class="font-bold text-fuchsia-900 mb-4">Content Growth</h3>
                <div class="space-y-2 text-sm">
                    <div class="flex justify-between text-fuchsia-800"><span class="opacity-80">This Month:</span> <strong
                            class="text-fuchsia-900">{{ $contentGrowth['this_month'] }}</strong></div>
                    <div class="flex justify-between text-fuchsia-800"><span class="opacity-80">Last Month:</span> <strong
                            class="text-fuchsia-900">{{ $contentGrowth['last_month'] }}</strong></div>
                    <div class="flex justify-between text-fuchsia-800"><span class="opacity-80">Growth Rate:</span>
                        <strong class="text-fuchsia-900">{{ $contentGrowth['growth_rate'] }}</strong>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
