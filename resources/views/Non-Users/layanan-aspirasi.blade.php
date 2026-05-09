@extends('Non-Users.layouts.main')

@section('title', 'Layanan Aspirasi')

@section('content')
<style>
    .category-radio:checked + div {
        border-color: #2563eb; /* Blue 600 */
        background-color: #eff6ff; /* Blue 50 */
    }
    .category-radio:checked + div i {
        color: #2563eb;
    }
    .category-radio:checked + div span {
        color: #1e3a8a;
        font-weight: 600;
    }
    body {
        background-color: #f8fafc;
    }
</style>

<main class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    
    <div class="text-center mb-10">
        <div class="inline-flex items-center justify-center w-16 h-16 rounded-2xl bg-blue-600 text-white shadow-lg mb-6">
            <i class="fa-solid fa-message text-2xl"></i>
        </div>
        <h1 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">Layanan Aspirasi Masyarakat</h1>
        <p class="text-gray-600 max-w-2xl mx-auto text-sm md:text-base">
            Suara Anda adalah prioritas kami. Sampaikan aspirasi, saran, atau keluhan untuk pembangunan Tapanuli Selatan yang lebih baik.
        </p>
    </div>

    <div class="flex justify-center mb-10">
        <div class="bg-white p-1 rounded-xl shadow-sm border border-gray-200 inline-flex">
            <a href="{{ route('layanan.aspirasi') }}" class="bg-blue-600 text-white px-6 py-2.5 rounded-lg font-semibold text-sm flex items-center gap-2 shadow-sm">
                <i class="fa-solid fa-message"></i> Kirim Aspirasi
            </a>
            <a href="{{ route('layanan.aspirasi.lacak') }}" class="text-gray-600 hover:bg-gray-50 px-6 py-2.5 rounded-lg font-medium text-sm flex items-center gap-2 transition">
                <i class="fa-solid fa-magnifying-glass"></i> Lacak Status
            </a>
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-10">
        <div class="bg-blue-600 rounded-xl p-5 text-white shadow-md transform hover:-translate-y-1 transition duration-300">
            <i class="fa-solid fa-bolt text-yellow-300 text-xl mb-3 block"></i>
            <h3 class="font-bold text-lg mb-1">Cepat</h3>
            <p class="text-blue-100 text-xs">Respons maksimal 14 hari kerja</p>
        </div>
        <div class="bg-[#10b981] rounded-xl p-5 text-white shadow-md transform hover:-translate-y-1 transition duration-300">
            <i class="fa-solid fa-lock text-yellow-200 text-xl mb-3 block"></i>
            <h3 class="font-bold text-lg mb-1">Aman</h3>
            <p class="text-green-100 text-xs">Data Anda terjamin kerahasiaannya</p>
        </div>
        <div class="bg-[#a855f7] rounded-xl p-5 text-white shadow-md transform hover:-translate-y-1 transition duration-300">
            <i class="fa-solid fa-chart-simple text-blue-100 text-xl mb-3 block"></i>
            <h3 class="font-bold text-lg mb-1">Transparan</h3>
            <p class="text-purple-100 text-xs">Tracking status dengan kode unik</p>
        </div>
    </div>

    @if(session('success'))
    <div class="bg-[#16a34a] rounded-2xl p-6 md:p-8 text-white mb-10 shadow-lg animate-fade-in-down">
        <div class="flex items-start gap-4 mb-5">
            <div class="w-8 h-8 rounded-full border-2 border-white flex items-center justify-center flex-shrink-0 mt-0.5">
                <i class="fa-solid fa-check text-sm"></i>
            </div>
            <div>
                <h2 class="text-xl md:text-2xl font-bold mb-1">Aspirasi Berhasil Dikirim!</h2>
                <p class="text-green-100 text-sm leading-relaxed">Terima kasih atas partisipasi Anda. Tim kami akan meninjau dan menindaklanjuti aspirasi Anda sesegera mungkin.</p>
            </div>
        </div>
        
        <div class="bg-white/20 rounded-xl p-5 border border-white/20 backdrop-blur-sm">
            <p class="text-green-50 text-xs font-bold uppercase tracking-wider mb-1">Kode Tracking Anda:</p>
            <p class="text-2xl md:text-3xl font-mono font-bold tracking-widest mb-2 drop-shadow-sm">{{ session('tracking_code') }}</p>
            <p class="text-xs text-green-100">Simpan kode ini untuk melacak status laporan Anda. Klik tab "Lacak Status" untuk melihat perkembangan.</p>
        </div>
    </div>
    @endif

    <div class="bg-white rounded-2xl shadow-xl border border-blue-600 overflow-hidden mb-12">
        <div class="bg-blue-600 px-8 py-6">
            <h2 class="text-xl font-bold text-white mb-1">Form Aspirasi</h2>
            <p class="text-blue-100 text-sm">Lengkapi formulir di bawah ini dengan data yang benar</p>
        </div>

        <div class="p-8">
            <form action="{{ route('aspirasi.kirim') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="mb-8">
                    <div class="flex items-center gap-3 mb-6">
                        <span class="flex items-center justify-center w-6 h-6 rounded-md bg-blue-100 text-blue-600 font-bold text-sm">1</span>
                        <h3 class="font-bold text-gray-900 text-lg">Data Diri</h3>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Nama Lengkap <span class="text-red-500">*</span></label>
                            <input type="text" name="nama" required placeholder="Masukkan nama lengkap" class="w-full border border-gray-300 rounded-lg px-4 py-2.5 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition text-sm">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Email <span class="text-red-500">*</span></label>
                            <input type="email" name="email" required placeholder="contoh@email.com" class="w-full border border-gray-300 rounded-lg px-4 py-2.5 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition text-sm">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Nomor Telepon <span class="text-red-500">*</span></label>
                            <input type="tel" name="telepon" required placeholder="08xxxxxxxxxx" class="w-full border border-gray-300 rounded-lg px-4 py-2.5 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition text-sm">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Wilayah/Daerah <span class="text-red-500">*</span></label>
                            <input type="text" name="wilayah" required placeholder="Contoh: Sipirok" class="w-full border border-gray-300 rounded-lg px-4 py-2.5 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition text-sm">
                        </div>
                    </div>
                </div>

                <div>
                    <div class="flex items-center gap-3 mb-6">
                        <span class="flex items-center justify-center w-6 h-6 rounded-md bg-blue-100 text-blue-600 font-bold text-sm">2</span>
                        <h3 class="font-bold text-gray-900 text-lg">Detail Aspirasi</h3>
                    </div>

                    <div class="mb-6">
                        <label class="block text-sm font-medium text-gray-700 mb-3">Kategori <span class="text-red-500">*</span></label>
                        
                        @php
                            $kategori = [
                                ['id' => 'pendidikan', 'icon' => 'fa-book-open', 'label' => 'Pendidikan', 'color' => 'text-orange-500'],
                                ['id' => 'kesehatan', 'icon' => 'fa-briefcase-medical', 'label' => 'Kesehatan', 'color' => 'text-teal-500'],
                                ['id' => 'infrastruktur', 'icon' => 'fa-building-wheat', 'label' => 'Infrastruktur', 'color' => 'text-yellow-600'],
                                ['id' => 'ekonomi', 'icon' => 'fa-store', 'label' => 'Ekonomi', 'color' => 'text-amber-700'],
                                ['id' => 'lingkungan', 'icon' => 'fa-leaf', 'label' => 'Lingkungan', 'color' => 'text-green-500'],
                                ['id' => 'keamanan', 'icon' => 'fa-shield-halved', 'label' => 'Keamanan', 'color' => 'text-red-600'],
                                ['id' => 'sosial', 'icon' => 'fa-users', 'label' => 'Sosial Budaya', 'color' => 'text-yellow-500'],
                                ['id' => 'pariwisata', 'icon' => 'fa-umbrella-beach', 'label' => 'Pariwisata', 'color' => 'text-cyan-500'],
                                ['id' => 'pertanian', 'icon' => 'fa-tractor', 'label' => 'Pertanian', 'color' => 'text-green-600'],
                                ['id' => 'lainnya', 'icon' => 'fa-box', 'label' => 'Lainnya', 'color' => 'text-gray-400'],
                            ];
                        @endphp

                        <div class="grid grid-cols-2 md:grid-cols-5 gap-3">
                            @foreach($kategori as $kat)
                            <label class="cursor-pointer relative">
                                <input type="radio" name="kategori" value="{{ $kat['id'] }}" required class="category-radio peer sr-only">
                                <div class="border border-gray-200 rounded-xl p-3 text-center hover:border-blue-300 transition h-full flex flex-col items-center justify-center">
                                    <i class="fa-solid {{ $kat['icon'] }} {{ $kat['color'] }} text-xl mb-2"></i>
                                    <span class="text-[10px] md:text-xs text-gray-600 font-medium leading-tight">{{ $kat['label'] }}</span>
                                </div>
                            </label>
                            @endforeach
                        </div>
                    </div>

                    <div class="mb-6">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Judul Aspirasi <span class="text-red-500">*</span></label>
                        <input type="text" name="judul" required placeholder="Ringkasan singkat aspirasi Anda..." class="w-full border border-gray-300 rounded-lg px-4 py-2.5 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition text-sm">
                    </div>

                    <div class="mb-2">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Isi Aspirasi <span class="text-red-500">*</span></label>
                        <textarea name="isi" rows="5" required placeholder="Jelaskan aspirasi, keluhan, atau saran Anda secara detail..." class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition text-sm resize-none"></textarea>
                    </div>
                    
                    <div class="flex justify-between text-xs text-gray-400 mb-6">
                        <span>Minimal 30 karakter</span>
                        <span>0 karakter</span>
                    </div>

                    <div class="mb-6 p-5 bg-blue-50 border border-blue-100 rounded-xl">
                        <label class="block text-sm font-bold text-gray-800 mb-1">Lokasi Kejadian (TKP) <span class="text-red-500">*</span></label>
                        <p class="text-xs text-gray-600 mb-4">Mohon izinkan akses lokasi pada browser Anda agar kami dapat memvalidasi titik pasti laporan ini.</p>
                        
                        <div class="flex flex-col sm:flex-row items-start sm:items-center gap-4">
                            <button type="button" id="btn_lokasi" class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-2.5 rounded-lg font-medium text-sm transition shadow-sm flex items-center gap-2 whitespace-nowrap">
                                <i class="fa-solid fa-location-crosshairs"></i> Ambil Titik Lokasi
                            </button>
                            
                            <div class="w-full">
                                <input type="text" id="koordinat_lokasi" name="koordinat_lokasi" required readonly placeholder="Lokasi belum diambil..." class="w-full bg-white border border-gray-300 rounded-lg px-4 py-2.5 outline-none text-sm font-mono text-gray-500 cursor-not-allowed placeholder-red-400">
                                <input type="hidden" id="latitude" name="latitude">
                                <input type="hidden" id="longitude" name="longitude">
                            </div>
                        </div>
                    </div>

                    <div class="mb-8">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Lampiran Bukti <span class="text-gray-400 font-normal">(Opsional)</span></label>
                        <div class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-xl hover:border-blue-400 hover:bg-blue-50 transition duration-300 bg-gray-50 group">
                            <div class="space-y-2 text-center">
                                <i class="fa-solid fa-cloud-arrow-up text-gray-400 group-hover:text-blue-500 text-3xl mb-1 transition"></i>
                                <div class="flex text-sm text-gray-600 justify-center items-center">
                                    <label for="file-upload" class="relative cursor-pointer bg-white rounded-md font-medium text-blue-600 hover:text-blue-700 focus-within:outline-none px-3 py-1.5 shadow-sm border border-gray-200 hover:border-blue-300 transition">
                                        <span>Pilih File</span>
                                        <input id="file-upload" name="lampiran" type="file" class="sr-only" accept=".jpg,.jpeg,.png">
                                    </label>
                                    <p class="pl-2 pt-1 text-xs">atau seret file ke sini</p>
                                </div>
                                <p class="text-xs text-gray-500">Hanya JPG, JPEG, PNG (Maks. 5MB)</p>
                            </div>
                        </div>
                    </div>

                </div>

                <div class="flex justify-end gap-3 pt-6 border-t border-gray-100">
                    <button type="reset" class="px-6 py-2.5 border border-gray-300 text-gray-700 rounded-lg font-medium text-sm hover:bg-gray-50 transition">
                        Reset Form
                    </button>
                    <button type="submit" class="px-6 py-2.5 bg-blue-600 text-white rounded-lg font-medium text-sm hover:bg-blue-700 transition shadow-md flex items-center gap-2">
                        <i class="fa-solid fa-paper-plane"></i> Kirim Aspirasi
                    </button>
                </div>

            </form>
        </div>
    </div>

    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-8">
        <h2 class="text-xl font-bold text-gray-900 mb-6">Pertanyaan yang Sering Diajukan</h2>
        <div class="space-y-6">
            <div class="flex gap-4">
                <div class="flex-shrink-0 mt-1">
                    <div class="w-6 h-6 rounded-full bg-blue-100 text-blue-600 flex items-center justify-center text-xs"><i class="fa-solid fa-question"></i></div>
                </div>
                <div>
                    <h4 class="font-bold text-sm text-gray-900 mb-1">Berapa lama aspirasi saya akan ditindaklanjuti?</h4>
                    <p class="text-sm text-gray-600 leading-relaxed">Setiap aspirasi akan ditinjau dan ditindaklanjuti maksimal 14 hari kerja sejak diterima oleh DPRD Tapanuli Selatan.</p>
                </div>
            </div>
            <div class="flex gap-4">
                <div class="flex-shrink-0 mt-1">
                    <div class="w-6 h-6 rounded-full bg-green-100 text-green-600 flex items-center justify-center text-xs"><i class="fa-solid fa-shield"></i></div>
                </div>
                <div>
                    <h4 class="font-bold text-sm text-gray-900 mb-1">Apakah identitas saya akan dirahasiakan?</h4>
                    <p class="text-sm text-gray-600 leading-relaxed">Ya, semua data pribadi dan aspirasi Anda dijamin kerahasiaannya sesuai dengan peraturan perundang-undangan yang berlaku.</p>
                </div>
            </div>
            <div class="flex gap-4">
                <div class="flex-shrink-0 mt-1">
                    <div class="w-6 h-6 rounded-full bg-purple-100 text-purple-600 flex items-center justify-center text-xs"><i class="fa-solid fa-magnifying-glass"></i></div>
                </div>
                <div>
                    <h4 class="font-bold text-sm text-gray-900 mb-1">Bagaimana cara melacak status aspirasi saya?</h4>
                    <p class="text-sm text-gray-600 leading-relaxed">Setelah mengirim aspirasi, Anda akan menerima kode tracking unik. Gunakan kode tersebut di tab "Lacak Status" untuk melihat perkembangan aspirasi Anda secara real-time.</p>
                </div>
            </div>
        </div>
    </div>

</main>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const btnLokasi = document.getElementById('btn_lokasi');
        const inputKoordinat = document.getElementById('koordinat_lokasi');
        const inputLat = document.getElementById('latitude');
        const inputLng = document.getElementById('longitude');

        if(btnLokasi) {
            btnLokasi.addEventListener('click', function() {
                if (navigator.geolocation) {
                    btnLokasi.innerHTML = '<i class="fa-solid fa-spinner fa-spin"></i> Memproses...';
                    btnLokasi.classList.add('opacity-75', 'cursor-not-allowed');
                    btnLokasi.disabled = true;

                    navigator.geolocation.getCurrentPosition(
                        function(position) {
                            const lat = position.coords.latitude;
                            const lng = position.coords.longitude;

                            inputKoordinat.value = `Titik Valid: ${lat.toFixed(6)}, ${lng.toFixed(6)}`;
                            inputLat.value = lat;
                            inputLng.value = lng;

                            inputKoordinat.classList.remove('text-gray-500', 'placeholder-red-400');
                            inputKoordinat.classList.add('text-green-700', 'font-bold', 'border-green-300', 'bg-green-50');
                            
                            btnLokasi.innerHTML = '<i class="fa-solid fa-check"></i> Lokasi Diperbarui';
                            btnLokasi.classList.replace('bg-blue-600', 'bg-green-600');
                            btnLokasi.classList.replace('hover:bg-blue-700', 'hover:bg-green-700');
                            btnLokasi.classList.remove('opacity-75', 'cursor-not-allowed');
                            btnLokasi.disabled = false;
                        },
                        function(error) {
                            let errorMessage = "Gagal mengambil lokasi.";
                            if (error.code === error.PERMISSION_DENIED) {
                                errorMessage = "Anda menolak akses lokasi. Harap izinkan lokasi di pengaturan browser untuk mengirim form ini.";
                            }
                            alert(errorMessage);
                            
                            btnLokasi.innerHTML = '<i class="fa-solid fa-location-crosshairs"></i> Coba Lagi';
                            btnLokasi.classList.remove('opacity-75', 'cursor-not-allowed');
                            btnLokasi.classList.replace('bg-green-600', 'bg-red-600');
                            btnLokasi.classList.replace('hover:bg-green-700', 'hover:bg-red-700');
                            btnLokasi.disabled = false;
                        },
                        { enableHighAccuracy: true, timeout: 15000, maximumAge: 0 }
                    );
                } else {
                    alert("Browser Anda tidak mendukung fitur lokasi (Geolocation). Harap gunakan browser versi terbaru.");
                }
            });
        }
    });
</script>
@endsection