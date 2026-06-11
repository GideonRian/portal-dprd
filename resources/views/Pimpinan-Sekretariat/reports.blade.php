@extends('Pimpinan-Sekretariat.layouts.app')

@section('title', 'System Reports')

@section('content')
    <div class="w-full px-4 sm:px-6 lg:px-8 py-8 max-w-screen-xl mx-auto font-sans text-gray-800">

        <a href="{{ route('sekretaris.dashboard') }}"
            class="inline-flex items-center text-purple-600 font-medium hover:underline mb-6 text-sm">
            <i class="fa-solid fa-arrow-left mr-2"></i> Kembali ke Dashboard
        </a>

        <div class="flex items-center gap-4 mb-8">
            <div class="w-14 h-14 bg-orange-600 rounded-2xl flex items-center justify-center text-white shadow-md">
                <i class="fa-solid fa-clipboard-list text-2xl"></i>
            </div>
            <div>
                <h1 class="text-3xl font-extrabold text-gray-900 leading-tight mb-1">System Reports</h1>
                <p class="text-gray-500 text-sm font-medium">Generate dan export berbagai laporan sistem</p>
            </div>
        </div>

        @if (session('error'))
            <div
                class="bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-xl mb-6 flex items-center gap-2 shadow-sm">
                <i class="fa-solid fa-circle-xmark"></i> {{ session('error') }}
            </div>
        @endif

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-10">

            <div class="bg-white border-2 border-blue-500 rounded-2xl p-6 shadow-sm flex flex-col justify-between">
                <div class="flex items-start gap-4 mb-6">
                    <div class="w-12 h-12 rounded-xl bg-blue-500 text-white flex items-center justify-center shrink-0">
                        <i class="fa-solid fa-clipboard-user text-xl"></i>
                    </div>
                    <div>
                        <h3 class="font-bold text-lg text-gray-900">Laporan Aktivitas Admin</h3>
                        <p class="text-xs text-gray-500 mt-1">Export semua aktivitas admin dalam periode tertentu</p>
                    </div>
                </div>
                <form action="{{ route('sekretaris.reports.generate') }}" method="POST">
                    @csrf
                    <input type="hidden" name="type" value="aktivitas">
                    <div class="mb-4">
                        <label class="block text-xs font-bold text-gray-700 mb-1">Periode</label>
                        <div class="flex items-center gap-2">
                            <input type="date" name="start_date" required
                                class="w-full bg-gray-50 border border-gray-200 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-blue-500 outline-none">
                            <span class="text-gray-400">-</span>
                            <input type="date" name="end_date" required
                                class="w-full bg-gray-50 border border-gray-200 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-blue-500 outline-none">
                        </div>
                    </div>
                    <button type="submit"
                        class="w-full bg-blue-600 hover:bg-blue-700 text-white font-bold py-2.5 rounded-lg transition shadow-sm flex items-center justify-center gap-2 text-sm">
                        <i class="fa-solid fa-download"></i> Generate & Download
                    </button>
                </form>
            </div>

            <div class="bg-white border-2 border-green-500 rounded-2xl p-6 shadow-sm flex flex-col justify-between">
                <div class="flex items-start gap-4 mb-6">
                    <div class="w-12 h-12 rounded-xl bg-green-500 text-white flex items-center justify-center shrink-0">
                        <i class="fa-regular fa-comments text-xl"></i>
                    </div>
                    <div>
                        <h3 class="font-bold text-lg text-gray-900">Laporan Aspirasi Masyarakat</h3>
                        <p class="text-xs text-gray-500 mt-1">Statistik dan detail semua aspirasi yang masuk</p>
                    </div>
                </div>
                <form action="{{ route('sekretaris.reports.generate') }}" method="POST">
                    @csrf
                    <input type="hidden" name="type" value="aspirasi">
                    <div class="mb-4">
                        <label class="block text-xs font-bold text-gray-700 mb-1">Periode</label>
                        <div class="flex items-center gap-2">
                            <input type="date" name="start_date" required
                                class="w-full bg-gray-50 border border-gray-200 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-green-500 outline-none">
                            <span class="text-gray-400">-</span>
                            <input type="date" name="end_date" required
                                class="w-full bg-gray-50 border border-gray-200 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-green-500 outline-none">
                        </div>
                    </div>
                    <button type="submit"
                        class="w-full bg-green-600 hover:bg-green-700 text-white font-bold py-2.5 rounded-lg transition shadow-sm flex items-center justify-center gap-2 text-sm">
                        <i class="fa-solid fa-download"></i> Generate & Download
                    </button>
                </form>
            </div>

            <div class="bg-white border-2 border-purple-500 rounded-2xl p-6 shadow-sm flex flex-col justify-between">
                <div class="flex items-start gap-4 mb-6">
                    <div class="w-12 h-12 rounded-xl bg-purple-500 text-white flex items-center justify-center shrink-0">
                        <i class="fa-regular fa-file-lines text-xl"></i>
                    </div>
                    <div>
                        <h3 class="font-bold text-lg text-gray-900">Laporan Konten Website</h3>
                        <p class="text-xs text-gray-500 mt-1">Overview berita, dokumen, dan agenda yang dipublikasi</p>
                    </div>
                </div>
                <form action="{{ route('sekretaris.reports.generate') }}" method="POST">
                    @csrf
                    <input type="hidden" name="type" value="konten">
                    <div class="mb-4">
                        <label class="block text-xs font-bold text-gray-700 mb-1">Periode</label>
                        <div class="flex items-center gap-2">
                            <input type="date" name="start_date" required
                                class="w-full bg-gray-50 border border-gray-200 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-purple-500 outline-none">
                            <span class="text-gray-400">-</span>
                            <input type="date" name="end_date" required
                                class="w-full bg-gray-50 border border-gray-200 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-purple-500 outline-none">
                        </div>
                    </div>
                    <button type="submit"
                        class="w-full bg-purple-600 hover:bg-purple-700 text-white font-bold py-2.5 rounded-lg transition shadow-sm flex items-center justify-center gap-2 text-sm">
                        <i class="fa-solid fa-download"></i> Generate & Download
                    </button>
                </form>
            </div>

            <div class="bg-white border-2 border-orange-500 rounded-2xl p-6 shadow-sm flex flex-col justify-between">
                <div class="flex items-start gap-4 mb-6">
                    <div class="w-12 h-12 rounded-xl bg-orange-500 text-white flex items-center justify-center shrink-0">
                        <i class="fa-solid fa-chart-line text-xl"></i>
                    </div>
                    <div>
                        <h3 class="font-bold text-lg text-gray-900">Laporan Kunjungan Website</h3>
                        <p class="text-xs text-gray-500 mt-1">Analytics dan statistik pengunjung website</p>
                    </div>
                </div>
                <form action="{{ route('sekretaris.reports.generate') }}" method="POST">
                    @csrf
                    <input type="hidden" name="type" value="kunjungan">
                    <div class="mb-4">
                        <label class="block text-xs font-bold text-gray-700 mb-1">Periode</label>
                        <div class="flex items-center gap-2">
                            <input type="date" name="start_date" required
                                class="w-full bg-gray-50 border border-gray-200 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-orange-500 outline-none">
                            <span class="text-gray-400">-</span>
                            <input type="date" name="end_date" required
                                class="w-full bg-gray-50 border border-gray-200 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-orange-500 outline-none">
                        </div>
                    </div>
                    <button type="submit"
                        class="w-full bg-orange-600 hover:bg-orange-700 text-white font-bold py-2.5 rounded-lg transition shadow-sm flex items-center justify-center gap-2 text-sm">
                        <i class="fa-solid fa-download"></i> Generate & Download
                    </button>
                </form>
            </div>
        </div>

        <div class="bg-[#111827] rounded-t-2xl p-6 text-white border-b border-gray-700">
            <h3 class="font-bold text-lg mb-1">Recent Reports</h3>
            <p class="text-xs text-gray-400">Laporan yang baru-baru ini di-generate</p>
        </div>
        <div class="bg-white border-x border-b border-gray-200 rounded-b-2xl p-4 shadow-sm border-b-4 border-b-red-500">
            <div class="space-y-3">
                @forelse($recentReports as $report)
                    <div
                        class="flex items-center justify-between p-4 border border-gray-100 rounded-xl hover:bg-gray-50 transition">
                        <div class="flex items-center gap-4">
                            <div class="text-gray-400">
                                <i class="fa-regular fa-file-pdf text-2xl"></i>
                            </div>
                            <div>
                                <p class="font-bold text-sm text-gray-900 truncate max-w-[200px] sm:max-w-md">
                                    {{ str_replace('_', ' ', $report->name) }}</p>
                                <p class="text-xs text-gray-500 mt-0.5">
                                    <i class="fa-regular fa-calendar mr-1"></i> {{ $report->time->format('Y-m-d H:i') }} •
                                    {{ $report->size }}
                                </p>
                            </div>
                        </div>
                        <a href="{{ route('sekretaris.reports.download', $report->name) }}"
                            class="bg-purple-600 hover:bg-purple-700 text-white px-4 py-2 rounded-lg font-bold transition flex items-center gap-2 text-xs shadow-sm shrink-0">
                            <i class="fa-solid fa-download"></i> <span class="hidden sm:inline">Download</span>
                        </a>
                    </div>
                @empty
                    <div class="text-center py-8">
                        <i class="fa-regular fa-folder-open text-4xl text-gray-300 mb-3"></i>
                        <p class="text-sm text-gray-500">Belum ada laporan yang pernah di-generate.</p>
                    </div>
                @endforelse
            </div>
        </div>

    </div>
@endsection
