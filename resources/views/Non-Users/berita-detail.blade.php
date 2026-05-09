@extends('Non-Users.layouts.main')

@section('title', 'Detail Berita')

@section('content')
<style>
    body { background-color: #ffffff; } /* Background putih bersih untuk fokus membaca */
</style>

<main class="w-full pb-20">

    <div class="relative w-full h-[60vh] min-h-[400px] md:min-h-[500px]">
        <img src="https://images.unsplash.com/photo-1596422846543-75c6ff1978f4?q=80&w=1920&auto=format&fit=crop" alt="Kunjungan Kerja" class="absolute inset-0 w-full h-full object-cover">
        
        <div class="absolute inset-0 bg-gradient-to-t from-[#0f172a] via-[#0f172a]/70 to-transparent"></div>

        <div class="absolute bottom-0 w-full">
            <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 pb-12 pt-20">
                
                <a href="{{ route('berita') }}" class="inline-flex items-center text-white/80 hover:text-white font-medium mb-8 transition group text-sm backdrop-blur-sm bg-white/10 px-4 py-2 rounded-full border border-white/20 hover:bg-white/20">
                    <i class="fa-solid fa-arrow-left mr-2 transform group-hover:-translate-x-1 transition"></i> Kembali ke Berita
                </a>

                <div class="mb-5">
                    <span class="bg-purple-600 text-white text-xs font-bold px-4 py-1.5 rounded-full shadow-lg">
                        <i class="fa-solid fa-map-location-dot mr-1"></i> Kunjungan Kerja
                    </span>
                </div>

                <h1 class="text-3xl md:text-4xl lg:text-5xl font-bold text-white mb-6 leading-tight drop-shadow-md">
                    Kunjungan Kerja ke Berbagai Kecamatan se-Tapanuli Selatan
                </h1>

                <div class="flex flex-wrap items-center gap-4 md:gap-6 text-gray-300 text-sm font-medium">
                    <div class="flex items-center gap-2">
                        <i class="fa-regular fa-calendar"></i>
                        <span>18 Februari 2026</span>
                    </div>
                    <div class="hidden md:block w-1 h-1 rounded-full bg-gray-500"></div>
                    <div class="flex items-center gap-2">
                        <i class="fa-regular fa-user"></i>
                        <span>Tim Liputan Humas DPRD</span>
                    </div>
                    <div class="hidden md:block w-1 h-1 rounded-full bg-gray-500"></div>
                    <div class="flex items-center gap-2">
                        <i class="fa-regular fa-clock"></i>
                        <span>4 menit baca</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-10 md:py-16">
        
        <div class="flex flex-wrap gap-2 mb-10">
            <a href="#" class="text-xs font-bold text-purple-700 bg-purple-50 px-3 py-1.5 rounded-md hover:bg-purple-100 transition">#KunjunganKerja</a>
            <a href="#" class="text-xs font-bold text-purple-700 bg-purple-50 px-3 py-1.5 rounded-md hover:bg-purple-100 transition">#AspirasiWarga</a>
            <a href="#" class="text-xs font-bold text-purple-700 bg-purple-50 px-3 py-1.5 rounded-md hover:bg-purple-100 transition">#PembangunanTapsel</a>
        </div>

        <p class="text-lg md:text-xl font-medium text-gray-800 italic leading-relaxed border-l-4 border-purple-500 pl-5 mb-8">
            Anggota DPRD Kabupaten Tapanuli Selatan melakukan kunjungan kerja terpadu ke berbagai kecamatan untuk menampung aspirasi masyarakat dan meninjau langsung progres pembangunan infrastruktur daerah.
        </p>

        <div class="prose prose-lg max-w-none text-gray-600">
            <p class="mb-6 leading-relaxed">
                <strong>SIPirok</strong> — Dewan Perwakilan Rakyat Daerah (DPRD) Kabupaten Tapanuli Selatan kembali menggelar agenda Kunjungan Kerja (Kunker) ke sejumlah kecamatan pada pertengahan Februari 2026. Kunjungan ini merupakan bagian dari fungsi pengawasan dewan untuk memastikan program-program pemerintah daerah berjalan sesuai rencana dan tepat sasaran.
            </p>

            <h2 class="text-2xl font-bold text-gray-900 mt-10 mb-4">Fokus Peninjauan Infrastruktur</h2>
            <p class="mb-6 leading-relaxed">
                Dalam lawatan kali ini, rombongan anggota dewan yang dibagi ke dalam beberapa tim komisi menitikberatkan pantauan pada proyek pengerjaan jalan poros antar desa dan perbaikan fasilitas kesehatan di tingkat kecamatan. Peninjauan lapangan sangat krusial untuk mengevaluasi kualitas pengerjaan fisik yang bersumber dari Anggaran Pendapatan dan Belanja Daerah (APBD) Tapsel tahun berjalan.
            </p>

            <div class="bg-blue-50/50 p-6 md:p-8 rounded-2xl border border-blue-100 my-10 relative">
                <i class="fa-solid fa-quote-left absolute text-5xl text-blue-200/50 -top-3 -left-2 z-0"></i>
                <p class="relative z-10 text-lg md:text-xl font-medium text-gray-800 italic leading-relaxed mb-4">
                    "Kami turun langsung ke lapangan bukan sekadar rutinitas, melainkan untuk memastikan bahwa setiap rupiah dari APBD benar-benar dirasakan manfaatnya oleh masyarakat Tapanuli Selatan, terutama yang berada di pelosok desa."
                </p>
                <p class="relative z-10 font-bold text-purple-700 text-sm">
                    — Pimpinan DPRD Tapanuli Selatan
                </p>
            </div>

            <p class="mb-6 leading-relaxed">
                Selain meninjau proyek fisik, para legislator juga menggelar dialog tatap muka dengan perangkat desa, tokoh adat, dan kelompok tani. Dialog ini menjadi wadah strategis bagi masyarakat untuk menyampaikan keluh kesah secara langsung tanpa perantara.
            </p>

            <h2 class="text-2xl font-bold text-gray-900 mt-10 mb-4">Poin Aspirasi Masyarakat</h2>
            <p class="mb-4 leading-relaxed">Dari hasil pertemuan dengan warga, tim kunker DPRD Tapsel merangkum beberapa catatan penting yang akan dibawa ke meja paripurna:</p>
            <ul class="list-disc pl-6 space-y-2 mb-6 text-gray-600 marker:text-purple-500">
                <li>Kebutuhan mendesak pengadaan pupuk subsidi yang tepat waktu menjelang masa tanam.</li>
                <li>Peningkatan sarana prasarana sekolah dasar di wilayah Kecamatan Batang Toru dan sekitarnya.</li>
                <li>Optimalisasi pelayanan kesehatan di Puskesmas, termasuk ketersediaan stok obat-obatan esensial.</li>
                <li>Usulan perbaikan saluran irigasi untuk mendukung ketahanan pangan lokal.</li>
            </ul>

            <h2 class="text-2xl font-bold text-gray-900 mt-10 mb-4">Langkah Tindak Lanjut</h2>
            <p class="mb-6 leading-relaxed">
                Seluruh aspirasi dan temuan dari kunjungan kerja ini akan dikompilasi menjadi Pokok-Pokok Pikiran (Pokir) DPRD. Dokumen Pokir tersebut nantinya akan diserahkan kepada pihak eksekutif (Pemerintah Kabupaten Tapanuli Selatan) untuk disinkronkan ke dalam Rencana Kerja Pemerintah Daerah (RKPD) tahun berikutnya.
            </p>

            <h2 class="text-2xl font-bold text-gray-900 mt-10 mb-4">Kesimpulan</h2>
            <p class="mb-6 leading-relaxed">
                DPRD Kabupaten Tapanuli Selatan berkomitmen penuh untuk terus mengawal kebijakan daerah. Kunjungan kerja ini membuktikan bahwa sinergi antara legislatif, eksekutif, dan masyarakat adalah kunci utama dalam mewujudkan Tapanuli Selatan yang lebih sejahtera, maju, dan berkelanjutan.
            </p>

            <div class="bg-gradient-to-r from-purple-600 to-blue-600 p-8 md:p-10 rounded-3xl text-white my-12 shadow-xl shadow-purple-200">
                <div class="flex items-center gap-3 mb-4">
                    <div class="w-10 h-10 rounded-full bg-white/20 flex items-center justify-center backdrop-blur-sm">
                        <i class="fa-solid fa-circle-info text-xl"></i>
                    </div>
                    <h3 class="text-xl font-bold m-0 text-white">Informasi Lanjutan</h3>
                </div>
                <p class="text-purple-50 leading-relaxed mb-4 text-sm md:text-base">
                    Masyarakat yang belum sempat menyampaikan usulannya secara langsung saat kunjungan kerja, dapat menggunakan fasilitas layanan digital kami.
                </p>
                <p class="text-purple-100 font-medium text-sm flex items-center gap-2">
                    <i class="fa-solid fa-envelope"></i> Hubungi Sekretariat DPRD Kabupaten Tapanuli Selatan atau akses menu Layanan Aspirasi di portal ini.
                </p>
            </div>

        </div>

        <hr class="border-gray-200 my-8">

        <div class="flex flex-col md:flex-row justify-between items-center gap-6">
            <div class="w-full md:w-auto text-center md:text-left">
                <p class="text-xs text-gray-400 font-bold uppercase tracking-wider mb-1">Dipublikasikan</p>
                <p class="font-bold text-gray-900">18 Februari 2026</p>
            </div>
            
            <div class="flex items-center justify-center gap-3 w-full md:w-auto">
                <button onclick="if(navigator.share) { navigator.share({title: document.title, url: window.location.href}) } else { alert('Gagal: Browser Anda tidak mendukung fitur share ini.') }" 
                        class="flex-1 md:flex-none bg-gray-100 text-gray-700 px-5 py-3 rounded-xl font-bold hover:bg-purple-50 hover:text-purple-700 hover:border-purple-200 border border-transparent transition-all duration-300 flex items-center justify-center gap-2">
                    <i class="fa-solid fa-share-nodes"></i> Bagikan
                </button>
                
                <a href="{{ route('berita') }}" class="flex-1 md:flex-none bg-blue-600 text-white px-6 py-3 rounded-xl font-bold hover:bg-blue-700 transition shadow-md flex items-center justify-center gap-2 whitespace-nowrap">
                    Berita Lainnya <i class="fa-solid fa-arrow-right text-sm"></i>
                </a>
            </div>
        </div>

    </div>

</main>
@endsection