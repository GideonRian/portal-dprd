@extends('Staff.layouts.app')

@section('title', 'Kelola Aspirasi Masyarakat')

@section('content')
    <main class="w-full px-4 sm:px-6 lg:px-8 py-8 mx-auto max-w-7xl">

        {{-- Header Section --}}
        <div class="flex items-center gap-4 mb-8">
            <div class="w-14 h-14 bg-[#059669] rounded-2xl flex items-center justify-center text-white shadow-lg">
                <i class="fa-solid fa-comment-dots text-2xl"></i>
            </div>
            <div>
                <h2 class="text-3xl font-extrabold text-gray-900 mb-1">Kelola Aspirasi Masyarakat</h2>
                <p class="text-gray-500 font-medium text-sm">Tinjau dan kelola aspirasi yang masuk</p>
            </div>
        </div>

        {{-- Alert Success Global --}}
        @if (session('success'))
            <div
                class="bg-green-50 border-l-4 border-green-500 text-green-700 p-4 mb-6 rounded-xl shadow-sm flex items-center gap-3">
                <i class="fa-solid fa-circle-check text-xl"></i>
                <p class="font-bold">{{ session('success') }}</p>
            </div>
        @endif

        {{-- Alert Error Global --}}
        @if ($errors->any())
            <div
                class="bg-red-50 border-l-4 border-red-500 text-red-700 p-4 mb-6 rounded-xl shadow-sm flex items-center gap-3">
                <i class="fa-solid fa-triangle-exclamation text-xl"></i>
                <p class="font-bold">Gagal memperbarui: {{ $errors->first() }}</p>
            </div>
        @endif

        {{-- Statistik Cards --}}
        <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-8">
            <div class="bg-[#2563eb] rounded-2xl p-6 text-white shadow-md">
                <h3 class="text-4xl font-black mb-1">{{ $counts['total'] }}</h3>
                <p class="text-sm font-medium opacity-90">Total Aspirasi</p>
            </div>
            <div class="bg-[#f59e0b] rounded-2xl p-6 text-white shadow-md">
                <h3 class="text-4xl font-black mb-1">{{ $counts['menunggu'] }}</h3>
                <p class="text-sm font-medium opacity-90">Menunggu</p>
            </div>
            <div class="bg-[#a855f7] rounded-2xl p-6 text-white shadow-md">
                <h3 class="text-4xl font-black mb-1">{{ $counts['diproses'] }}</h3>
                <p class="text-sm font-medium opacity-90">Ditinjau</p>
            </div>
            <div class="bg-[#059669] rounded-2xl p-6 text-white shadow-md">
                <h3 class="text-4xl font-black mb-1">{{ $counts['selesai'] }}</h3>
                <p class="text-sm font-medium opacity-90">Selesai</p>
            </div>
        </div>

        {{-- Search & Filter --}}
        <form action="{{ route('staff.aspirasi.index') }}" method="GET" class="flex flex-col md:flex-row gap-4 mb-8">
            <div class="relative flex-grow">
                <i class="fa-solid fa-magnifying-glass absolute left-4 top-1/2 -translate-y-1/2 text-gray-400"></i>
                <input type="text" name="search" value="{{ request('search') }}"
                    placeholder="Cari nama, nomor tiket, subjek, atau kategori..."
                    class="w-full pl-11 pr-4 py-3.5 bg-white border border-gray-200 rounded-2xl focus:ring-2 focus:ring-blue-500 outline-none transition font-medium text-sm shadow-sm">
            </div>
            <div class="relative w-full md:w-64">
                <i class="fa-solid fa-filter absolute left-4 top-1/2 -translate-y-1/2 text-gray-400"></i>
                <select name="status" onchange="this.form.submit()"
                    class="w-full pl-11 pr-10 py-3.5 bg-white border border-gray-200 rounded-2xl focus:ring-2 focus:ring-blue-500 outline-none transition font-medium text-sm cursor-pointer appearance-none shadow-sm">
                    <option value="">Semua Status</option>
                    <option value="Menunggu" {{ request('status') == 'Menunggu' ? 'selected' : '' }}>Menunggu</option>
                    <option value="Diproses" {{ request('status') == 'Diproses' ? 'selected' : '' }}>Ditinjau</option>
                    <option value="Selesai" {{ request('status') == 'Selesai' ? 'selected' : '' }}>Selesai</option>
                    <option value="Ditolak" {{ request('status') == 'Ditolak' ? 'selected' : '' }}>Ditolak</option>
                </select>
                <i
                    class="fa-solid fa-chevron-down absolute right-4 top-1/2 -translate-y-1/2 text-gray-400 text-xs pointer-events-none"></i>
            </div>
        </form>

        {{-- List Aspirasi Cards --}}
        <div class="space-y-4">
            @forelse($aspirasis as $item)
                <div
                    class="bg-white rounded-3xl p-6 border border-gray-100 shadow-sm flex flex-col md:flex-row gap-6 justify-between items-start md:items-center hover:shadow-md transition">
                    <div class="flex-grow">
                        <div class="flex flex-wrap items-center gap-3 mb-3 text-[11px] font-bold">
                            <span class="text-gray-400 uppercase tracking-widest">{{ $item->tiket_id }}</span>

                            @php
                                $stClass = match ($item->status) {
                                    'Menunggu' => 'text-yellow-700 bg-yellow-50',
                                    'Diproses' => 'text-purple-700 bg-purple-50',
                                    'Selesai' => 'text-green-700 bg-green-50',
                                    'Ditolak' => 'text-red-700 bg-red-50',
                                    default => 'text-gray-600 bg-gray-50',
                                };
                            @endphp

                            <span class="px-2.5 py-1 rounded-lg {{ $stClass }} flex items-center gap-1">
                                <i
                                    class="fa-solid {{ $item->status == 'Menunggu' ? 'fa-clock' : ($item->status == 'Diproses' ? 'fa-spinner' : ($item->status == 'Selesai' ? 'fa-check' : 'fa-xmark')) }}"></i>
                                {{ $item->status == 'Diproses' ? 'Ditinjau' : $item->status }}
                            </span>
                            <span class="px-2.5 py-1 rounded-lg text-purple-600 bg-purple-50">{{ $item->kategori }}</span>
                            <span
                                class="text-gray-400 uppercase">{{ \Carbon\Carbon::parse($item->created_at)->translatedFormat('d M Y') }}</span>
                        </div>

                        <h3 class="text-xl font-black text-gray-900 mb-2 leading-tight">{{ $item->judul }}</h3>
                        <p class="text-sm font-bold text-gray-600 mb-2">Dari: {{ $item->nama }} • {{ $item->email }} •
                            {{ $item->telepon }}</p>
                        <p class="text-sm text-gray-400 leading-relaxed line-clamp-2">{{ $item->pesan }}</p>
                    </div>

                    {{-- Action Buttons --}}
                    <div class="flex flex-col gap-3 w-full md:w-40 shrink-0">
                        <button type="button" onclick="openModal({{ $item->id }})"
                            class="w-full bg-[#2563eb] hover:bg-blue-700 text-white font-black py-2.5 rounded-xl text-sm transition flex items-center justify-center gap-2">
                            <i class="fa-regular fa-eye"></i> Detail
                        </button>
                    </div>
                </div>
            @empty
                <div class="text-center py-20 bg-white rounded-[2rem] border-2 border-dashed border-gray-200">
                    <i class="fa-regular fa-folder-open text-5xl text-gray-300 mb-4"></i>
                    <p class="text-gray-500 font-bold">Belum ada aspirasi terverifikasi yang masuk.</p>
                </div>
            @endforelse
        </div>

        <div class="mt-8">
            {{ $aspirasis->links() }}
        </div>
    </main>

    {{-- ======================================================== --}}
    {{-- MODAL DETAIL (ANTI-JUMP BUG FIXED)                       --}}
    {{-- ======================================================== --}}
    <div id="detailModal" class="relative z-[80] hidden" aria-labelledby="modal-title" role="dialog" aria-modal="true">

        {{-- Backdrop Gelap --}}
        <div class="fixed inset-0 bg-gray-900/75 backdrop-blur-sm transition-opacity" onclick="closeModal()"></div>

        {{-- Wadah Posisi Modal --}}
        <div class="fixed inset-0 z-10 w-screen overflow-y-auto">
            <div
                class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0 pointer-events-none">

                {{-- KOTAK MODAL UTAMA --}}
                <div
                    class="relative transform overflow-hidden rounded-[2rem] bg-white text-left shadow-2xl transition-all sm:my-8 sm:w-full sm:max-w-4xl border border-gray-100 pointer-events-auto">

                    {{-- MODAL HEADER --}}
                    <div
                        class="bg-white px-6 py-5 sm:px-8 border-b border-gray-100 flex justify-between items-center sticky top-0 z-20">
                        <div>
                            <h3 class="text-2xl font-black text-gray-900">Detail Aspirasi</h3>
                            <p id="m-tiket"
                                class="text-sm font-bold text-blue-600 bg-blue-50 px-2 py-0.5 rounded-lg mt-1 inline-block font-mono border border-blue-100">
                            </p>
                        </div>
                        <button type="button" onclick="closeModal()"
                            class="text-gray-400 hover:text-red-600 hover:bg-red-50 bg-gray-50 h-10 w-10 flex items-center justify-center rounded-full transition">
                            <i class="fa-solid fa-xmark text-xl"></i>
                        </button>
                    </div>

                    {{-- MODAL BODY --}}
                    <div class="px-6 sm:px-8 py-6 bg-white overflow-y-auto custom-scrollbar" style="max-height: 75vh;"
                        id="modal-content-area">

                        <div id="m-loader" class="text-center py-20">
                            <i class="fa-solid fa-circle-notch fa-spin text-4xl text-blue-600"></i>
                            <p class="text-gray-500 font-bold mt-4 text-sm">Mengambil Data...</p>
                        </div>

                        <div id="m-real-content" class="hidden space-y-10">

                            {{-- Data Pelapor --}}
                            <div class="border-2 border-gray-100 rounded-3xl p-6 relative bg-gray-50/30">
                                <div
                                    class="absolute -top-3.5 left-6 bg-white px-3 flex items-center gap-2 text-gray-800 font-black text-sm border border-gray-200 rounded-full py-1">
                                    <i class="fa-regular fa-user text-blue-600"></i> Profil Pelapor
                                </div>
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-y-6 gap-x-8 mt-2">
                                    <div>
                                        <p class="text-[11px] text-gray-500 font-bold uppercase mb-1">Nama Lengkap</p>
                                        <p id="m-nama" class="font-black text-gray-900"></p>
                                    </div>
                                    <div>
                                        <p class="text-[11px] text-gray-500 font-bold uppercase mb-1">Email</p>
                                        <p id="m-email" class="font-black text-gray-900"></p>
                                    </div>
                                    <div>
                                        <p class="text-[11px] text-gray-500 font-bold uppercase mb-1">Nomor Telepon</p>
                                        <p id="m-telepon" class="font-black text-gray-900"></p>
                                    </div>
                                    <div>
                                        <p class="text-[11px] text-gray-500 font-bold uppercase mb-1">Kategori</p>
                                        <span id="m-kategori"
                                            class="px-3 py-1 rounded-lg text-xs font-black text-purple-700 bg-purple-100 mt-1 inline-block"></span>
                                    </div>
                                    <div class="md:col-span-2">
                                        <p class="text-[11px] text-gray-500 font-bold uppercase mb-1">Lokasi Laporan</p>
                                        <p id="m-alamat" class="font-black text-gray-900 mb-2"></p>
                                        <div id="m-map-link"></div>
                                    </div>
                                </div>
                            </div>

                            {{-- Isi Aspirasi --}}
                            <div>
                                <h4 class="flex items-center gap-2 font-black text-gray-900 mb-4 text-lg"><i
                                        class="fa-regular fa-file-lines text-[#059669]"></i> Detail Masalah</h4>
                                <div class="space-y-4">
                                    <div>
                                        <p class="text-[11px] text-gray-500 font-bold uppercase mb-1">Judul Aspirasi</p>
                                        <p id="m-judul" class="font-black text-gray-900 text-xl"></p>
                                    </div>
                                    <div>
                                        <p class="text-[11px] text-gray-500 font-bold uppercase mb-1.5">Isi Laporan Lengkap
                                        </p>
                                        <div id="m-pesan"
                                            class="bg-gray-50 p-6 rounded-2xl text-gray-700 text-sm leading-relaxed border border-gray-200">
                                        </div>
                                    </div>
                                    <div id="m-lampiran-area" class="hidden pt-4">
                                        <p class="text-[11px] text-gray-500 font-bold uppercase mb-2.5"><i
                                                class="fa-solid fa-paperclip"></i> Bukti Lampiran</p>
                                        <div id="m-lampiran-images" class="flex flex-wrap gap-4"></div>
                                    </div>
                                </div>
                            </div>

                            {{-- KOTAK HASIL PENILAIAN MASYARAKAT --}}
                            <div id="m-rating-area"
                                class="hidden bg-[#fffdf7] border border-orange-200 rounded-3xl p-6 relative overflow-hidden">
                                <h4 class="font-black text-gray-900 mb-4 flex items-center gap-2"><i
                                        class="fa-solid fa-star text-orange-500 text-xl"></i> Feedback Masyarakat</h4>
                                <div class="flex items-center gap-2 mb-4" id="m-rating-stars"></div>
                                <div id="m-rating-ulasan-container">
                                    <p class="text-[11px] text-gray-500 font-bold uppercase mb-2">Komentar / Ulasan</p>
                                    <p id="m-rating-ulasan"
                                        class="text-sm text-gray-700 italic bg-white p-4 rounded-xl border border-orange-100 shadow-sm">
                                    </p>
                                </div>
                            </div>

                            {{-- Timeline --}}
                            <div>
                                <h4 class="flex items-center gap-2 font-black text-gray-900 mb-6 text-lg"><i
                                        class="fa-regular fa-clock text-blue-600"></i> Riwayat Penanganan</h4>
                                <div class="relative border-l-2 border-gray-200 ml-4 pl-8 space-y-8" id="m-timeline">
                                    {{-- Diisi via JS --}}
                                </div>
                            </div>

                            {{-- ======================================================== --}}
                            {{-- FORM UPDATE STATUS (BUG FIX: HAPUS CLASS SR-ONLY)        --}}
                            {{-- ======================================================== --}}
                            <div class="border-t border-gray-200 pt-8 mt-8">
                                <h4 class="font-black text-gray-900 mb-6 text-xl"><i
                                        class="fa-solid fa-pen-to-square text-gray-400 mr-2"></i>Tindak Lanjut Laporan</h4>

                                <form id="m-update-form" method="POST">
                                    @csrf
                                    @method('PUT')

                                    <div class="grid grid-cols-2 md:grid-cols-4 gap-3 mb-6">
                                        @foreach (['Menunggu', 'Diproses', 'Selesai', 'Ditolak'] as $st)
                                            {{-- PERUBAHAN ADA DISINI: relative block untuk label, absolute inset-0 opacity-0 untuk input --}}
                                            <label class="cursor-pointer group relative block">
                                                <input type="radio" name="status" value="{{ $st }}"
                                                    class="peer absolute inset-0 w-full h-full opacity-0 cursor-pointer m-0 p-0"
                                                    onchange="handleStatusChange(this.value)">
                                                <div
                                                    class="text-center py-3 border-2 border-gray-200 rounded-xl text-[11px] font-black text-gray-500 peer-checked:border-blue-500 peer-checked:bg-blue-50 peer-checked:text-blue-700 transition relative z-10 pointer-events-none">
                                                    <i
                                                        class="fa-solid {{ $st == 'Menunggu' ? 'fa-clock' : ($st == 'Diproses' ? 'fa-spinner' : ($st == 'Selesai' ? 'fa-check' : 'fa-xmark')) }} mb-1 block text-lg"></i>
                                                    {{ $st == 'Diproses' ? 'Ditinjau' : $st }}
                                                </div>
                                            </label>
                                        @endforeach
                                    </div>

                                    <div class="mb-5">
                                        <label class="block text-[11px] font-black text-gray-500 uppercase mb-2">Ditangani
                                            Oleh (PIC)</label>
                                        <input type="text" name="pic" id="m-input-pic"
                                            placeholder="Contoh: Komisi IV - Pendidikan"
                                            class="w-full border-2 border-gray-200 rounded-xl px-4 py-3 text-sm font-bold focus:border-blue-500 focus:ring-0 outline-none transition bg-gray-50 focus:bg-white">
                                    </div>

                                    <div id="m-box-tolak"
                                        class="hidden mb-6 p-5 bg-red-50 border border-red-200 rounded-2xl">
                                        <label class="block text-xs font-black text-red-700 mb-2">Alasan Penolakan <span
                                                class="text-red-500">*</span></label>
                                        <textarea id="m-catatan-tolak" rows="3" placeholder="Jelaskan alasan mengapa aspirasi ini ditolak..."
                                            class="w-full border border-red-200 rounded-xl p-3 text-sm font-medium text-red-900 focus:ring-1 focus:ring-red-400 outline-none"></textarea>
                                    </div>

                                    <div class="mb-8" id="m-box-catatan-biasa">
                                        <label class="block text-[11px] font-black text-gray-500 uppercase mb-2">Catatan
                                            Pengerjaan</label>
                                        <textarea name="catatan" id="m-catatan-biasa" rows="3"
                                            placeholder="Tambahkan catatan atau update untuk masyarakat..."
                                            class="w-full border-2 border-gray-200 rounded-xl p-4 text-sm font-medium text-gray-700 focus:border-blue-500 focus:ring-0 outline-none bg-gray-50 focus:bg-white"></textarea>
                                    </div>

                                    {{-- TOMBOL SUBMIT NATIVE --}}
                                    <button type="submit"
                                        onclick="this.innerHTML='<i class=\'fa-solid fa-spinner fa-spin text-lg\'></i> Memproses...'; this.classList.add('opacity-75', 'cursor-not-allowed');"
                                        class="w-full bg-[#10b981] hover:bg-[#059669] text-white font-black py-4 rounded-xl transition shadow-lg flex items-center justify-center gap-2 text-sm uppercase">
                                        <i class="fa-regular fa-floppy-disk text-lg"></i> Simpan Perubahan
                                    </button>
                                </form>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function openModal(id) {
            const modal = document.getElementById('detailModal');
            const loader = document.getElementById('m-loader');
            const content = document.getElementById('m-real-content');

            loader.classList.remove('hidden');
            content.classList.add('hidden');
            modal.classList.remove('hidden');
            document.body.style.overflow = 'hidden';

            fetch(`/staff/aspirasi/${id}`)
                .then(res => {
                    if (!res.ok) throw new Error("Gagal mengambil data");
                    return res.json();
                })
                .then(data => {
                    document.getElementById('m-tiket').innerText = data.tiket_id;
                    document.getElementById('m-nama').innerText = data.nama;
                    document.getElementById('m-email').innerText = data.email;
                    document.getElementById('m-telepon').innerText = data.telepon;
                    document.getElementById('m-alamat').innerText = data.alamat || '-';
                    document.getElementById('m-kategori').innerText = data.kategori;
                    document.getElementById('m-judul').innerText = data.judul;
                    document.getElementById('m-pesan').innerText = data.pesan;
                    document.getElementById('m-input-pic').value = data.pic || '';

                    document.getElementById('m-update-form').action = `/staff/aspirasi/${id}/update`;

                    const mapLink = document.getElementById('m-map-link');
                    if (data.latitude && data.longitude) {
                        mapLink.innerHTML =
                            `<a href="https://www.google.com/maps?q=$${data.latitude},${data.longitude}" target="_blank" class="inline-flex items-center gap-1 bg-red-50 text-red-600 hover:bg-red-100 border border-red-200 px-3 py-1.5 rounded-lg text-[11px] font-bold transition mt-1"><i class="fa-solid fa-map-location-dot"></i> Buka Google Maps</a>`;
                    } else {
                        mapLink.innerHTML =
                            '<span class="text-[10px] text-gray-400 italic block mt-1">Titik koordinat tidak direkam</span>';
                    }

                    document.querySelector(`input[name="status"][value="${data.status}"]`).checked = true;
                    handleStatusChange(data.status);

                    const lampiranArea = document.getElementById('m-lampiran-area');
                    const lampiranImages = document.getElementById('m-lampiran-images');
                    lampiranImages.innerHTML = '';

                    if (data.image1 || data.image2) {
                        lampiranArea.classList.remove('hidden');
                        if (data.image1) lampiranImages.innerHTML +=
                            `<a href="/storage/${data.image1}" target="_blank"><img src="/storage/${data.image1}" class="w-24 h-24 object-cover rounded-xl border border-gray-200"></a>`;
                        if (data.image2) lampiranImages.innerHTML +=
                            `<a href="/storage/${data.image2}" target="_blank"><img src="/storage/${data.image2}" class="w-24 h-24 object-cover rounded-xl border border-gray-200"></a>`;
                    } else {
                        lampiranArea.classList.add('hidden');
                    }

                    const ratingArea = document.getElementById('m-rating-area');
                    const ratingStars = document.getElementById('m-rating-stars');
                    const ratingUlasanContainer = document.getElementById('m-rating-ulasan-container');
                    const ratingUlasan = document.getElementById('m-rating-ulasan');

                    if (data.rating) {
                        ratingArea.classList.remove('hidden');
                        let starsHTML = '';
                        for (let i = 1; i <= 5; i++) {
                            starsHTML +=
                                `<i class="fa-solid fa-star ${i <= data.rating ? 'text-yellow-400' : 'text-gray-200'} text-2xl"></i>`;
                        }
                        starsHTML += `<span class="ml-2 font-black text-orange-600 text-lg">(${data.rating}/5)</span>`;
                        ratingStars.innerHTML = starsHTML;

                        if (data.ulasan) {
                            ratingUlasanContainer.classList.remove('hidden');
                            ratingUlasan.innerText = `"${data.ulasan}"`;
                        } else {
                            ratingUlasanContainer.classList.add('hidden');
                        }
                    } else {
                        ratingArea.classList.add('hidden');
                    }

                    let timelineHTML = '';
                    data.histories.forEach(h => {
                        let hColor = h.status == 'Ditolak' ? 'bg-red-500' : (h.status == 'Selesai' ?
                            'bg-green-500' : (h.status == 'Diproses' ? 'bg-purple-500' : 'bg-yellow-500'));
                        let hIcon = h.status == 'Ditolak' ? 'fa-xmark' : (h.status == 'Selesai' ? 'fa-check' : (
                            h.status == 'Diproses' ? 'fa-spinner' : 'fa-clock'));
                        let hDate = new Date(h.created_at);
                        let dateStr =
                            `${hDate.getDate()}/${hDate.getMonth()+1}/${hDate.getFullYear()} ${hDate.getHours().toString().padStart(2,'0')}:${hDate.getMinutes().toString().padStart(2,'0')}`;

                        timelineHTML += `
                        <div class="relative">
                            <div class="absolute -left-[41px] w-5 h-5 ${hColor} rounded-full border-4 border-white shadow-sm flex items-center justify-center"><i class="fa-solid ${hIcon} text-[8px] text-white"></i></div>
                            <div>
                                <p class="text-sm font-black text-gray-900">${h.status == 'Diproses' ? 'Ditinjau' : h.status} <span class="text-[10px] text-gray-400 ml-2">${dateStr}</span></p>
                                <p class="text-xs text-gray-600 mt-1">${h.catatan || 'Aspirasi diperbarui'}</p>
                                <p class="text-[9px] text-gray-400 mt-1 uppercase font-bold">Oleh: ${h.user_name || 'System'}</p>
                            </div>
                        </div>`;
                    });
                    document.getElementById('m-timeline').innerHTML = timelineHTML;

                    loader.classList.add('hidden');
                    content.classList.remove('hidden');
                })
                .catch(err => {
                    alert("Gagal memuat detail data. Silakan refresh halaman.");
                    closeModal();
                });
        }

        function closeModal() {
            document.getElementById('detailModal').classList.add('hidden');
            document.body.style.overflow = 'auto';
        }

        function handleStatusChange(val) {
            const boxTolak = document.getElementById('m-box-tolak');
            const boxBiasa = document.getElementById('m-box-catatan-biasa');
            const txtTolak = document.getElementById('m-catatan-tolak');
            const txtBiasa = document.getElementById('m-catatan-biasa');

            if (val === 'Ditolak') {
                boxTolak.classList.remove('hidden');
                boxBiasa.classList.add('hidden');
                txtTolak.name = 'catatan';
                txtTolak.required = true;
                txtBiasa.name = '';
            } else {
                boxTolak.classList.add('hidden');
                boxBiasa.classList.remove('hidden');
                txtBiasa.name = 'catatan';
                txtTolak.name = '';
                txtTolak.required = false;
            }
        }
    </script>

    <style>
        .line-clamp-2 {
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        .custom-scrollbar::-webkit-scrollbar {
            width: 6px;
        }

        .custom-scrollbar::-webkit-scrollbar-track {
            background: #f1f5f9;
            border-radius: 10px;
        }

        .custom-scrollbar::-webkit-scrollbar-thumb {
            background: #cbd5e1;
            border-radius: 10px;
        }

        .custom-scrollbar::-webkit-scrollbar-thumb:hover {
            background: #94a3b8;
        }
    </style>
@endsection
