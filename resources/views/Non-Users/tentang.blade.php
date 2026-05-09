@extends('Non-Users.layouts.main')

@section('title', 'Tentang DPRD')

@section('content')
<main class="w-full">
    
    <div class="bg-blue-600 p-8 md:p-12">
        <div class="max-w-7xl mx-auto flex items-center space-x-5">
            <div class="bg-white p-3.5 rounded-xl text-blue-600 shadow-inner">
                <i class="fa-solid fa-building text-3xl"></i>
            </div>
            <div class="text-white">
                <h1 class="text-3xl font-bold">Tentang DPRD</h1>
                <p class="text-blue-100">Dewan Perwakilan Rakyat Daerah Kabupaten Tapanuli Selatan</p>
            </div>
        </div>
    </div>

    <div class="max-w-7xl mx-auto px-4 py-12 md:py-16">
        
        <div class="bg-white p-8 md:p-10 rounded-2xl shadow-xl border border-gray-100 mb-10 transform transition-all duration-300 hover:scale-[1.02] hover:shadow-2xl hover:border-blue-200 cursor-default">
            <h2 class="text-2xl font-bold text-gray-900 mb-5">Profil DPRD</h2>
            <p class="text-gray-700 leading-relaxed text-sm md:text-base">
                Dewan Perwakilan Rakyat Daerah (DPRD) adalah lembaga perwakilan rakyat daerah yang berkedudukan sebagai unsur penyelenggara pemerintahan daerah. DPRD memiliki peran penting dalam mewujudkan pemerintahan yang demokratis dan aspiratif.
            </p>
            <p class="text-gray-700 leading-relaxed text-sm md:text-base mt-4">
                Sebagai representasi masyarakat di tingkat daerah, DPRD bertugas menyerap, menghimpun, menampung, dan menindaklanjuti aspirasi masyarakat untuk kepentingan pembangunan daerah yang lebih baik.
            </p>
        </div>

        <div class="grid md:grid-cols-2 gap-8 mb-10">
            
            <div class="bg-white p-8 md:p-10 rounded-2xl shadow-xl border border-gray-100 transform transition-all duration-300 hover:scale-[1.03] hover:shadow-2xl hover:border-blue-200 cursor-default">
                <div class="flex items-center space-x-4 mb-6">
                    <div class="bg-blue-100 p-3 rounded-full text-blue-600">
                        <i class="fa-solid fa-eye text-2xl"></i>
                    </div>
                    <h2 class="text-2xl font-bold text-gray-900">Visi</h2>
                </div>
                <p class="text-gray-700 leading-relaxed text-sm md:text-base">
                    TAPANULI SELATAN YANG MAJU DAN BERKARAKTER UNGGUL, SEHAT, CERDAS DAN SEJAHTERA MENYONGSONG INDONESIA EMAS 2045.
                </p>
            </div>

            <div class="bg-white p-8 md:p-10 rounded-2xl shadow-xl border border-gray-100 transform transition-all duration-300 hover:scale-[1.03] hover:shadow-2xl hover:border-blue-200 cursor-default">
                <div class="flex items-center space-x-4 mb-6">
                    <div class="bg-blue-100 p-3 rounded-full text-blue-600">
                        <i class="fa-solid fa-rocket text-2xl"></i>
                    </div>
                    <h2 class="text-2xl font-bold text-gray-900">Misi</h2>
                </div>
                <ul class="list-disc list-inside text-gray-700 space-y-2.5 text-sm md:text-base">
                    <li>PERBAIKAN DAN PEMBANGUNAN INFRASTRUKTUR JALAN,JEMBATAN, IRIGASI, SARANA AIR BERSIH,LISTRIK DESA
                        DAN JARINGAN TELEKOMUNIKASI</li>
                    <li>PENINGKATAN PENDAPATAN MASYARAKAT</li>
                    <li>PENCIPTAAN KUALITAS SUMBER DAYA MANUSIA YANG UNGGUL, SEHAT DAN CERDAS</li>
                    <li>REFORMASI BIROKRASI DAN PELAYANAN PUBLIK</li>
                    <li>PERBAIKAN PRASARANA DAN SARANA LINGKUNGAN PERMUKIMAN YANG ASRI DAN BERKELANJUTAN</li>
                </ul>
            </div>

        </div>

        <div class="bg-white p-8 md:p-10 rounded-2xl shadow-xl border border-gray-100 mb-10 relative">
            
            <div class="flex items-center space-x-4 mb-8">
                <div class="bg-blue-100 p-3 rounded-full text-blue-600">
                    <i class="fa-solid fa-clipboard-list text-2xl"></i>
                </div>
                <h2 class="text-2xl font-bold text-gray-900">Tugas dan Fungsi</h2>
            </div>

            <div class="grid md:grid-cols-3 gap-6">
                <div class="bg-gray-50 p-6 rounded-xl border border-gray-100 transform transition-all duration-300 hover:scale-105 hover:bg-white hover:shadow-xl hover:border-blue-300 cursor-default">
                    <h3 class="text-lg font-bold text-gray-900 mb-2">Fungsi Legislasi</h3>
                    <p class="text-sm text-gray-700 leading-relaxed">
                        Membentuk Peraturan Daerah bersama dengan Kepala Daerah untuk kepentingan masyarakat.
                    </p>
                </div>
                
                <div class="bg-gray-50 p-6 rounded-xl border border-gray-100 transform transition-all duration-300 hover:scale-105 hover:bg-white hover:shadow-xl hover:border-blue-300 cursor-default">
                    <h3 class="text-lg font-bold text-gray-900 mb-2">Fungsi Anggaran</h3>
                    <p class="text-sm text-gray-700 leading-relaxed">
                        Membahas dan menyetujui APBD bersama pemerintah daerah untuk pembangunan daerah.
                    </p>
                </div>

                <div class="bg-gray-50 p-6 rounded-xl border border-gray-100 transform transition-all duration-300 hover:scale-105 hover:bg-white hover:shadow-xl hover:border-blue-300 cursor-default">
                    <h3 class="text-lg font-bold text-gray-900 mb-2">Fungsi Pengawasan</h3>
                    <p class="text-sm text-gray-700 leading-relaxed">
                        Melakukan pengawasan terhadap pelaksanaan Perda dan peraturan perundang-undangan lainnya.
                    </p>
                </div>
            </div>

        </div>

        <div class="bg-white p-8 md:p-10 rounded-2xl shadow-xl border border-gray-100">
            <h2 class="text-2xl font-bold text-gray-900 mb-8">Komisi-Komisi</h2>
            
            <div class="grid md:grid-cols-3 gap-6">
                
                <div class="bg-blue-50 p-6 rounded-xl border border-blue-100 text-blue-900 transform transition-all duration-300 hover:scale-105 hover:shadow-lg hover:bg-blue-600 hover:text-white cursor-pointer group">
                    <h3 class="text-lg font-bold mb-2 transition-colors duration-300">Komisi A</h3>
                    <p class="text-sm group-hover:text-blue-100 transition-colors duration-300">Pemerintahan, Hukum, dan Politik</p>
                </div>

                <div class="bg-blue-50 p-6 rounded-xl border border-blue-100 text-blue-900 transform transition-all duration-300 hover:scale-105 hover:shadow-lg hover:bg-blue-600 hover:text-white cursor-pointer group">
                    <h3 class="text-lg font-bold mb-2 transition-colors duration-300">Komisi B</h3>
                    <p class="text-sm group-hover:text-blue-100 transition-colors duration-300">Perekonomian dan Pembangunan</p>
                </div>

                <div class="bg-blue-50 p-6 rounded-xl border border-blue-100 text-blue-900 transform transition-all duration-300 hover:scale-105 hover:shadow-lg hover:bg-blue-600 hover:text-white cursor-pointer group">
                    <h3 class="text-lg font-bold mb-2 transition-colors duration-300">Komisi C</h3>
                    <p class="text-sm group-hover:text-blue-100 transition-colors duration-300">Kesejahteraan Masyarakat</p>
                </div>

            </div>
        </div>

    </div>

</main>
@endsection