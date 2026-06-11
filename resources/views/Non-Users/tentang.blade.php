@extends('Non-Users.layouts.main')

@section('title', 'Tentang DPRD')

@section('content')
<main class="w-full bg-slate-50/50 min-h-screen pb-20">

    <!-- Hero Section: Modern Techno-Gradient -->
    <div class="relative bg-gradient-to-br from-slate-950 via-blue-950 to-indigo-950 py-16 md:py-24 px-6 overflow-hidden border-b border-blue-900/30">
        <div class="absolute inset-0 bg-[radial-gradient(circle_at_top_right,rgba(59,130,246,0.15),transparent_45%)]"></div>
        <div class="absolute -left-20 -top-20 w-80 h-80 bg-indigo-600/10 rounded-full blur-3xl"></div>

        <div class="max-w-7xl mx-auto relative z-10 flex flex-col md:flex-row items-center gap-6">
            <div class="bg-gradient-to-b from-blue-500 to-indigo-600 p-4 rounded-2xl shadow-[0_0_30px_rgba(59,130,246,0.3)] border border-blue-400/30">
                <i class="fa-solid fa-building text-3xl text-white animate-pulse"></i>
            </div>
            <div class="text-center md:text-left">
                <span class="text-xs font-bold tracking-widest text-blue-400 uppercase bg-blue-950/60 px-3 py-1 rounded-full border border-blue-800/50">Profil Lembaga</span>
                <h1 class="text-3xl md:text-5xl font-extrabold text-white tracking-tight mt-2 bg-clip-text text-transparent bg-gradient-to-r from-white via-slate-200 to-slate-400">
                    Tentang DPRD
                </h1>
                <p class="text-slate-400 font-medium text-sm md:text-base mt-1.5 tracking-wide">
                    Dewan Perwakilan Rakyat Daerah Kabupaten Tapanuli Selatan
                </p>
            </div>
        </div>
    </div>

    <div class="max-w-7xl mx-auto px-4 mt-12 space-y-12">

        <!-- Profil Section: Glassmorphism Accent -->
        <div class="bg-white rounded-3xl p-8 md:p-10 border border-slate-100 shadow-[0_4px_30px_rgba(0,0,0,0.02)] relative overflow-hidden group">
            <div class="absolute left-0 top-0 bottom-0 w-1.5 bg-gradient-to-b from-blue-500 to-indigo-600"></div>
            <h2 class="text-2xl font-bold text-slate-900 mb-5 flex items-center gap-3">
                <span class="w-2 h-2 rounded-full bg-blue-600"></span> Profil Utama
            </h2>
            <div class="space-y-4 text-slate-600 text-sm md:text-base leading-relaxed max-w-5xl">
                <p>
                    Dewan Perwakilan Rakyat Daerah (DPRD) merupakan pilar perwakilan rakyat di tingkat daerah yang
                    memegang posisi sentral sebagai unsur penyelenggara pemerintahan. Keberadaannya menjamin arah
                    kebijakan daerah tetap demokratis, transparan, dan berorientasi penuh pada kemaslahatan publik.
                </p>
                <p class="text-slate-500 border-l-2 border-slate-200 pl-4 italic">
                    Sebagai artikulator aspirasi warga Tapanuli Selatan, DPRD mendedikasikan fungsinya untuk
                    menjembatani, merumuskan, dan mengawal suara masyarakat demi percepatan pembangunan daerah yang
                    inklusif.
                </p>
            </div>
        </div>

        <!-- Visi & Misi Section: Split Neo-Cards -->
        <div class="grid md:grid-cols-2 gap-8">

            <!-- Visi -->
            <div class="bg-white p-8 md:p-10 rounded-3xl border border-slate-100 shadow-[0_10px_30px_rgba(0,0,0,0.02)] transition-all duration-300 hover:-translate-y-1 hover:shadow-xl hover:border-blue-100">
                <div class="flex items-center space-x-4 mb-6">
                    <div class="bg-blue-50 p-3 rounded-xl text-blue-600 border border-blue-100/50">
                        <i class="fa-solid fa-eye text-xl"></i>
                    </div>
                    <h2 class="text-xl font-bold text-slate-900 tracking-tight">Visi Daerah</h2>
                </div>
                <p class="text-slate-700 font-semibold text-base md:text-lg leading-relaxed border-l-4 border-blue-500 pl-4 bg-gradient-to-r from-blue-50/50 to-transparent py-2 rounded-r-xl">
                    "Tapanuli Selatan yang Maju dan Berkarakter Unggul, Sehat, Cerdas, dan Sejahtera Menyongsong
                    Indonesia Emas 2045."
                </p>
            </div>

            <!-- Misi -->
            <div class="bg-white p-8 md:p-10 rounded-3xl border border-slate-100 shadow-[0_10px_30px_rgba(0,0,0,0.02)] transition-all duration-300 hover:-translate-y-1 hover:shadow-xl hover:border-indigo-100">
                <div class="flex items-center space-x-4 mb-6">
                    <div class="bg-indigo-50 p-3 rounded-xl text-indigo-600 border border-indigo-100/50">
                        <i class="fa-solid fa-rocket text-xl"></i>
                    </div>
                    <h2 class="text-xl font-bold text-slate-900 tracking-tight">Misi Strategis</h2>
                </div>
                <ul class="space-y-3.5 text-slate-600 text-sm md:text-base font-medium">
                    <li class="flex items-start gap-3">
                        <span class="flex-shrink-0 mt-1 w-5 h-5 rounded-full bg-indigo-50 flex items-center justify-center text-indigo-600 text-xs"><i class="fa-solid fa-check"></i></span>
                        <span>Modernisasi dan pemerataan infrastruktur jalan, jembatan, irigasi, air bersih, listrik, serta konektivitas digital perdesaan.</span>
                    </li>
                    <li class="flex items-start gap-3">
                        <span class="flex-shrink-0 mt-1 w-5 h-5 rounded-full bg-indigo-50 flex items-center justify-center text-indigo-600 text-xs"><i class="fa-solid fa-check"></i></span>
                        <span>Akselerasi pertumbuhan ekonomi guna peningkatan pendapatan riil masyarakat.</span>
                    </li>
                    <li class="flex items-start gap-3">
                        <span class="flex-shrink-0 mt-1 w-5 h-5 rounded-full bg-indigo-50 flex items-center justify-center text-indigo-600 text-xs"><i class="fa-solid fa-check"></i></span>
                        <span>Pengembangan kapasitas SDM yang unggul, adaptif, sehat, dan berdaya saing tinggi.</span>
                    </li>
                    <li class="flex items-start gap-3">
                        <span class="flex-shrink-0 mt-1 w-5 h-5 rounded-full bg-indigo-50 flex items-center justify-center text-indigo-600 text-xs"><i class="fa-solid fa-check"></i></span>
                        <span>Transformasi reformasi birokrasi dan digitalisasi pelayanan publik yang akuntabel.</span>
                    </li>
                    <li class="flex items-start gap-3">
                        <span class="flex-shrink-0 mt-1 w-5 h-5 rounded-full bg-indigo-50 flex items-center justify-center text-indigo-600 text-xs"><i class="fa-solid fa-check"></i></span>
                        <span>Pemberdayaan lingkungan permukiman yang asri, tangguh, dan berkelanjutan.</span>
                    </li>
                </ul>
            </div>

        </div>

        <!-- Tugas & Fungsi Section: Interactive Cards -->
        <div class="bg-white p-8 md:p-10 rounded-3xl border border-slate-100 shadow-[0_10px_30px_rgba(0,0,0,0.02)]">
            <div class="flex items-center space-x-4 mb-8">
                <div class="bg-slate-900 p-3 rounded-xl text-white">
                    <i class="fa-solid fa-shield-halved text-xl"></i>
                </div>
                <div>
                    <h2 class="text-2xl font-bold text-slate-900 tracking-tight">Tugas dan Fungsi Konstitusional</h2>
                    <p class="text-xs text-slate-400 font-medium mt-0.5">Tiga fungsi utama penopang Dewan Perwakilan Rakyat Daerah</p>
                </div>
            </div>

            <div class="grid md:grid-cols-3 gap-6">
                <!-- Fungsi 1 -->
                <div class="bg-slate-50 p-6 rounded-2xl border border-slate-100/80 transition-all duration-300 hover:bg-white hover:shadow-xl hover:border-blue-500/30 group">
                    <div class="w-10 h-10 rounded-xl bg-blue-50 flex items-center justify-center text-blue-600 mb-4 group-hover:bg-blue-600 group-hover:text-white transition-all duration-300">
                        <i class="fa-solid fa-gavel text-sm"></i>
                    </div>
                    <h3 class="text-lg font-bold text-slate-900 mb-2">Fungsi Legislasi</h3>
                    <p class="text-sm text-slate-500 leading-relaxed">
                        Merumuskan dan menetapkan Peraturan Daerah (Perda) bersama Kepala Daerah secara progresif dan adaptif terhadap kebutuhan hukum masyarakat.
                    </p>
                </div>

                <!-- Fungsi 2 -->
                <div class="bg-slate-50 p-6 rounded-2xl border border-slate-100/80 transition-all duration-300 hover:bg-white hover:shadow-xl hover:border-emerald-500/30 group">
                    <div class="w-10 h-10 rounded-xl bg-emerald-50 flex items-center justify-center text-emerald-600 mb-4 group-hover:bg-emerald-600 group-hover:text-white transition-all duration-300">
                        <i class="fa-solid fa-chart-pie text-sm"></i>
                    </div>
                    <h3 class="text-lg font-bold text-slate-900 mb-2">Fungsi Anggaran</h3>
                    <p class="text-sm text-slate-500 leading-relaxed">
                        Membahas, menelaah, dan menyetujui alokasi APBD secara presisi guna menjamin efisiensi fiskal dan ketepatan sasaran pembangunan.
                    </p>
                </div>

                <!-- Fungsi 3 (Updated CCTV Icon) -->
                <div class="bg-slate-50 p-6 rounded-2xl border border-slate-100/80 transition-all duration-300 hover:bg-white hover:shadow-xl hover:border-indigo-500/30 group">
                    <div class="w-10 h-10 rounded-xl bg-indigo-50 flex items-center justify-center text-indigo-600 mb-4 group-hover:bg-indigo-600 group-hover:text-white transition-all duration-300">
                        <i class="fa-solid fa-video text-sm"></i>
                    </div>
                    <h3 class="text-lg font-bold text-slate-900 mb-2">Fungsi Pengawasan</h3>
                    <p class="text-sm text-slate-500 leading-relaxed">
                        Mengawal ketat implementasi Perda, kebijakan strategis, serta realisasi kinerja eksekutif demi menjaga transparansi tata kelola pemerintahan.
                    </p>
                </div>
            </div>
        </div>

        <!-- Komisi-Komisi Section: Tech Accent Pill Cards -->
        <div class="bg-white p-8 md:p-10 rounded-3xl border border-slate-100 shadow-[0_10px_30px_rgba(0,0,0,0.02)]">
            <div class="mb-8">
                <h2 class="text-2xl font-bold text-slate-900 tracking-tight">Komisi Alat Kelengkapan</h2>
                <p class="text-xs text-slate-400 font-medium mt-0.5">Pembagian fokus kerja dan spesialisasi penanganan aspirasi</p>
            </div>

            <div class="grid md:grid-cols-3 gap-6">

                <!-- Komisi A -->
                <div class="bg-gradient-to-br from-slate-50 to-slate-100/50 p-6 rounded-2xl border border-slate-200/60 transition-all duration-300 hover:bg-slate-900 hover:from-slate-900 hover:to-slate-950 group relative overflow-hidden">
                    <div class="absolute right-3 bottom-1 text-slate-200/50 text-7xl font-extrabold select-none pointer-events-none group-hover:text-slate-800/20 transition-all duration-300">A</div>
                    <span class="text-xs font-bold text-blue-600 bg-blue-50 px-2.5 py-1 rounded-md group-hover:bg-blue-500/20 group-hover:text-blue-300 transition-all duration-300">Bidang Hukum</span>
                    <h3 class="text-lg font-bold text-slate-900 mt-4 mb-1 group-hover:text-white transition-all duration-300">Komisi A</h3>
                    <p class="text-sm text-slate-500 group-hover:text-slate-400 transition-all duration-300">Pemerintahan, Hukum, dan Politik</p>
                </div>

                <!-- Komisi B -->
                <div class="bg-gradient-to-br from-slate-50 to-slate-100/50 p-6 rounded-2xl border border-slate-200/60 transition-all duration-300 hover:bg-slate-900 hover:from-slate-900 hover:to-slate-950 group relative overflow-hidden">
                    <div class="absolute right-3 bottom-1 text-slate-200/50 text-7xl font-extrabold select-none pointer-events-none group-hover:text-slate-800/20 transition-all duration-300">B</div>
                    <span class="text-xs font-bold text-emerald-600 bg-emerald-50 px-2.5 py-1 rounded-md group-hover:bg-emerald-500/20 group-hover:text-emerald-300 transition-all duration-300">Bidang Ekonomi</span>
                    <h3 class="text-lg font-bold text-slate-900 mt-4 mb-1 group-hover:text-white transition-all duration-300">Komisi B</h3>
                    <p class="text-sm text-slate-500 group-hover:text-slate-400 transition-all duration-300">Perekonomian dan Pembangunan</p>
                </div>

                <!-- Komisi C -->
                <div class="bg-gradient-to-br from-slate-50 to-slate-100/50 p-6 rounded-2xl border border-slate-200/60 transition-all duration-300 hover:bg-slate-900 hover:from-slate-900 hover:to-slate-950 group relative overflow-hidden">
                    <div class="absolute right-3 bottom-1 text-slate-200/50 text-7xl font-extrabold select-none pointer-events-none group-hover:text-slate-800/20 transition-all duration-300">C</div>
                    <span class="text-xs font-bold text-indigo-600 bg-indigo-50 px-2.5 py-1 rounded-md group-hover:bg-indigo-500/20 group-hover:text-indigo-300 transition-all duration-300">Bidang Sosial</span>
                    <h3 class="text-lg font-bold text-slate-900 mt-4 mb-1 group-hover:text-white transition-all duration-300">Komisi C</h3>
                    <p class="text-sm text-slate-500 group-hover:text-slate-400 transition-all duration-300">Kesejahteraan Masyarakat</p>
                </div>

            </div>
        </div>

    </div>
</main>
@endsection