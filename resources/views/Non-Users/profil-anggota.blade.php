@extends('Non-Users.layouts.main')

@section('title', 'Profil Anggota')

@section('content')
    <style>
        .member-card {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            border: 1px solid #f3f4f6;
            border-radius: 1rem;
            overflow: hidden;
            cursor: pointer;
        }

        .member-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1);
        }

        .member-image {
            width: 100%;
            height: 280px;
            object-fit: cover;
            object-position: top;
        }

        .badge-category {
            position: absolute;
            bottom: -12px;
            right: 20px;
            padding: 4px 16px;
            border-radius: 9999px;
            font-weight: bold;
            font-size: 0.75rem;
            color: white;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
        }

        /* CUSTOM SCROLLBAR UNTUK MODAL */
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

    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">

        {{-- Header --}}
        <div class="flex items-start mb-8">
            <div class="bg-blue-600 p-4 rounded-xl mr-5">
                <i class="fa-solid fa-users-viewfinder text-white text-3xl"></i>
            </div>
            <div>
                <h1 class="text-3xl font-bold text-gray-900">Profil Anggota DPRD</h1>
                <p class="text-gray-500 font-medium">Tapanuli Selatan - Periode 2024-2029</p>
            </div>
        </div>

        {{-- Form Search & Filter --}}
        <form action="{{ route('profil.anggota') }}" method="GET" class="space-y-4 mb-8">
            <div class="flex flex-col lg:flex-row gap-4">
                {{-- Input Search --}}
                <div class="relative flex-grow">
                    <i class="fa-solid fa-magnifying-glass absolute left-4 top-1/2 -translate-y-1/2 text-gray-400"></i>
                    <input type="text" name="search" value="{{ request('search') }}"
                        placeholder="Cari nama anggota, jabatan, atau dapil..."
                        class="w-full pl-11 pr-4 py-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-blue-500 outline-none transition text-sm">
                </div>

                {{-- Filter Komisi --}}
                <select name="komisi" onchange="this.form.submit()"
                    class="px-4 py-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-blue-500 outline-none text-sm bg-white cursor-pointer">
                    <option value="">Semua Komisi</option>
                    @foreach ($list_komisi as $kom)
                        <option value="{{ $kom }}" {{ request('komisi') == $kom ? 'selected' : '' }}>
                            {{ $kom }}</option>
                    @endforeach
                </select>

                {{-- Filter Badan --}}
                <select name="badan" onchange="this.form.submit()"
                    class="px-4 py-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-blue-500 outline-none text-sm bg-white cursor-pointer">
                    <option value="">Semua Alat Kelengkapan (Badan)</option>
                    @foreach ($list_badan as $bad)
                        <option value="{{ $bad }}" {{ request('badan') == $bad ? 'selected' : '' }}>
                            {{ $bad }}</option>
                    @endforeach
                </select>

                {{-- Tombol Reset --}}
                @if (request('search') || request('komisi') || request('badan'))
                    <a href="{{ route('profil.anggota') }}"
                        class="inline-flex items-center justify-center px-6 py-3 text-sm font-semibold text-red-600 bg-red-50 rounded-xl hover:bg-red-100 transition">
                        <i class="fa-solid fa-rotate-left mr-2"></i> Reset
                    </a>
                @endif

                <button type="submit"
                    class="bg-blue-600 hover:bg-blue-700 text-white px-8 py-3 rounded-xl font-semibold transition-all shadow-md">
                    C Cari
                </button>
            </div>
        </form>

        <p class="text-sm text-gray-500 mb-8">Menampilkan <span
                class="font-bold text-gray-800">{{ $anggotas->count() }}</span> anggota</p>

        {{-- Grid Member --}}
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 mb-12">
            @forelse($anggotas as $item)
                {{-- KARTU ANGGOTA: Tambahkan onclick untuk membuka modal --}}
                <div class="member-card bg-white" onclick="openMemberModal({{ $item->id }})"
                    title="Klik untuk melihat biodata lengkap">
                    <div class="relative group">
                        <img src="{{ $item->foto ? asset('storage/' . $item->foto) : 'https://ui-avatars.com/api/?name=' . urlencode($item->nama) . '&background=random' }}"
                            alt="{{ $item->nama }}" class="member-image group-hover:brightness-90 transition">

                        <div
                            class="absolute inset-0 bg-black/40 flex items-center justify-center opacity-0 group-hover:opacity-100 transition duration-300">
                            <span class="bg-white/90 text-gray-900 px-4 py-2 rounded-full text-sm font-bold shadow-lg"><i
                                    class="fa-solid fa-user text-blue-600 mr-2"></i>Lihat Profil</span>
                        </div>

                        @if ($item->komisi)
                            <div
                                class="badge-category z-10 {{ str_contains(strtolower($item->jabatan), 'ketua') ? 'bg-red-500' : 'bg-blue-600' }}">
                                {{ $item->komisi }}
                            </div>
                        @endif
                    </div>

                    <div class="p-6 mt-2">
                        <h3 class="text-lg font-bold text-gray-900 leading-tight mb-1">{{ $item->nama }}</h3>
                        <p class="text-sm font-semibold text-blue-600 mb-4">{{ $item->jabatan }}</p>

                        <div class="space-y-2 mb-6">
                            <div class="flex items-center text-xs text-gray-500">
                                <span class="w-2 h-2 rounded-full bg-yellow-500 mr-2"></span>
                                {{ $item->partai }}
                            </div>
                            <div class="flex items-center text-xs text-gray-500">
                                <span class="w-2 h-2 rounded-full bg-green-500 mr-2"></span>
                                {{ $item->dapil }}
                            </div>
                            @if ($item->badan)
                                <div class="flex items-center text-xs text-gray-500">
                                    <span class="w-2 h-2 rounded-full bg-purple-500 mr-2"></span>
                                    {{ $item->badan }}
                                </div>
                            @endif
                        </div>

                        <div class="pt-4 border-t border-gray-100 space-y-3">
                            <div class="flex items-center text-xs text-gray-600">
                                <i class="fa-solid fa-phone text-blue-600 w-5"></i>
                                {{ $item->telepon ?? 'Tidak ada data telepon' }}
                            </div>
                            <div class="flex items-center text-xs text-gray-600">
                                <i class="fa-solid fa-envelope text-blue-600 w-5"></i>
                                <span
                                    class="truncate">{{ $item->email ?? strtolower(str_replace([' ', '.', ',', "'"], '', $item->nama)) . '@dprd-tapsel.go.id' }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-span-full text-center py-16 bg-gray-50 rounded-2xl border border-dashed border-gray-300">
                    <i class="fa-solid fa-user-xmark text-4xl text-gray-300 mb-3"></i>
                    <p class="text-gray-500 font-medium">Pencarian tidak ditemukan.</p>
                    <a href="{{ route('profil.anggota') }}"
                        class="text-blue-600 text-sm font-bold hover:underline mt-2 inline-block">Lihat semua anggota</a>
                </div>
            @endforelse
        </div>
    </main>

    {{-- ======================================================== --}}
    {{-- MODAL DETAIL BIODATA ANGGOTA                             --}}
    {{-- ======================================================== --}}
    <div id="memberModal" class="relative z-[80] hidden" aria-labelledby="modal-title" role="dialog" aria-modal="true">

        {{-- Backdrop Gelap --}}
        <div class="fixed inset-0 bg-gray-900/75 backdrop-blur-sm transition-opacity" onclick="closeMemberModal()"></div>

        {{-- Wadah Posisi Modal --}}
        <div class="fixed inset-0 z-10 w-screen overflow-y-auto">
            <div
                class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0 pointer-events-none">

                {{-- KOTAK MODAL UTAMA --}}
                <div
                    class="relative transform overflow-hidden rounded-[2rem] bg-white text-left shadow-2xl transition-all sm:my-8 sm:w-full sm:max-w-4xl border border-gray-100 pointer-events-auto flex flex-col max-h-[90vh]">

                    {{-- MODAL HEADER (Sticky) --}}
                    <div
                        class="shrink-0 bg-white px-6 py-5 sm:px-8 border-b border-gray-100 flex justify-between items-center z-20 shadow-sm">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 bg-blue-50 text-blue-600 rounded-full flex items-center justify-center">
                                <i class="fa-solid fa-id-badge text-xl"></i>
                            </div>
                            <h3 class="text-xl sm:text-2xl font-black text-gray-900">Biodata Anggota DPRD</h3>
                        </div>
                        <button type="button" onclick="closeMemberModal()"
                            class="text-gray-400 hover:text-red-600 hover:bg-red-50 bg-gray-50 h-10 w-10 flex items-center justify-center rounded-full transition">
                            <i class="fa-solid fa-xmark text-xl"></i>
                        </button>
                    </div>

                    {{-- MODAL BODY (Area yang di-scroll independen) --}}
                    <div class="flex-1 min-h-0 overflow-y-auto custom-scrollbar bg-gray-50/30" id="member-modal-content">

                        {{-- Loader --}}
                        <div id="m-member-loader" class="text-center py-32">
                            <i class="fa-solid fa-circle-notch fa-spin text-4xl text-blue-600"></i>
                            <p class="text-gray-500 font-bold mt-4 text-sm">Mengambil Biodata...</p>
                        </div>

                        {{-- Konten Asli --}}
                        <div id="m-member-real-content" class="hidden p-6 sm:p-8 space-y-8">

                            {{-- KARTU IDENTITAS UTAMA (Atas) --}}
                            <div
                                class="bg-white rounded-3xl p-6 md:p-8 border border-gray-100 shadow-sm flex flex-col md:flex-row gap-8 items-center md:items-start relative overflow-hidden">
                                {{-- Aksen dekoratif --}}
                                <div class="absolute top-0 right-0 w-32 h-32 bg-blue-50 rounded-bl-full z-0 opacity-50">
                                </div>

                                <div class="w-32 h-32 md:w-40 md:h-40 shrink-0 relative z-10">
                                    <img id="m-member-foto" src="" alt="Foto"
                                        class="w-full h-full object-cover rounded-2xl shadow-md border-4 border-white">
                                </div>

                                <div class="flex-grow text-center md:text-left relative z-10">
                                    <span id="m-member-partai"
                                        class="bg-yellow-100 text-yellow-800 text-[10px] font-black px-3 py-1 rounded-full uppercase tracking-wider mb-3 inline-block"></span>
                                    <h2 id="m-member-nama"
                                        class="text-2xl md:text-3xl font-black text-gray-900 mb-1 leading-tight"></h2>
                                    <p id="m-member-jabatan" class="text-lg font-bold text-blue-600 mb-4"></p>

                                    <div
                                        class="flex flex-wrap items-center justify-center md:justify-start gap-4 text-sm text-gray-600">
                                        <div class="flex items-center gap-1.5"><i
                                                class="fa-solid fa-location-dot text-gray-400"></i> <span
                                                id="m-member-dapil" class="font-medium"></span></div>
                                        <div class="hidden md:block w-1 h-1 bg-gray-300 rounded-full"></div>
                                        <div class="flex items-center gap-1.5"><i
                                                class="fa-solid fa-cake-candles text-gray-400"></i> <span
                                                id="m-member-ttl" class="font-medium"></span></div>
                                    </div>
                                    <div
                                        class="flex flex-wrap items-center justify-center md:justify-start gap-4 text-sm text-gray-600 mt-2">
                                        <div class="flex items-center gap-1.5"><i
                                                class="fa-solid fa-phone text-gray-400"></i> <span id="m-member-telp"
                                                class="font-medium"></span></div>
                                        <div class="hidden md:block w-1 h-1 bg-gray-300 rounded-full"></div>
                                        <div class="flex items-center gap-1.5"><i
                                                class="fa-solid fa-envelope text-gray-400"></i> <span id="m-member-email"
                                                class="font-medium"></span></div>
                                    </div>
                                </div>
                            </div>

                            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                                {{-- KOLOM KIRI: Posisi Dewan --}}
                                <div class="space-y-6">
                                    <div class="bg-white rounded-2xl p-6 border border-gray-100 shadow-sm h-full">
                                        <h4
                                            class="font-black text-gray-900 mb-5 flex items-center gap-2 text-lg border-b border-gray-50 pb-3">
                                            <i class="fa-solid fa-sitemap text-blue-500"></i> Alat Kelengkapan
                                        </h4>

                                        <div class="space-y-4">
                                            <div id="wrapper-komisi" class="hidden">
                                                <p
                                                    class="text-[11px] text-gray-400 font-bold uppercase tracking-wider mb-1">
                                                    Komisi</p>
                                                <p
                                                    class="font-bold text-gray-800 bg-gray-50 px-3 py-2 rounded-lg border border-gray-100">
                                                    <span id="m-member-komisi"></span>
                                                    <span id="m-member-jabatan-komisi"
                                                        class="text-blue-600 ml-1 text-sm block mt-1"></span>
                                                </p>
                                            </div>
                                            <div id="wrapper-badan" class="hidden">
                                                <p
                                                    class="text-[11px] text-gray-400 font-bold uppercase tracking-wider mb-1 mt-4">
                                                    Badan Dewan</p>
                                                <p
                                                    class="font-bold text-gray-800 bg-gray-50 px-3 py-2 rounded-lg border border-gray-100">
                                                    <span id="m-member-badan"></span>
                                                    <span id="m-member-jabatan-badan"
                                                        class="text-purple-600 ml-1 text-sm block mt-1"></span>
                                                </p>
                                            </div>

                                            <div id="wrapper-kosong" class="text-center py-6 hidden">
                                                <i class="fa-regular fa-folder-open text-3xl text-gray-300 mb-2"></i>
                                                <p class="text-xs font-medium text-gray-500">Belum terdaftar di
                                                    komisi/badan</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                {{-- KOLOM KANAN: Riwayat --}}
                                <div class="lg:col-span-2 space-y-6">
                                    <div class="bg-white rounded-2xl p-6 md:p-8 border border-gray-100 shadow-sm">
                                        <h4
                                            class="font-black text-gray-900 mb-6 flex items-center gap-2 text-lg border-b border-gray-50 pb-3">
                                            <i class="fa-solid fa-clock-rotate-left text-blue-500"></i> Riwayat Hidup &
                                            Karir
                                        </h4>

                                        <div class="space-y-6">
                                            <div>
                                                <div class="flex items-center gap-2 mb-2">
                                                    <div
                                                        class="w-6 h-6 rounded-full bg-blue-50 flex items-center justify-center shrink-0">
                                                        <i class="fa-solid fa-graduation-cap text-blue-600 text-xs"></i>
                                                    </div>
                                                    <h5 class="font-bold text-gray-800">Riwayat Pendidikan</h5>
                                                </div>
                                                <div id="m-member-pendidikan"
                                                    class="pl-8 text-sm text-gray-600 leading-relaxed font-medium"></div>
                                            </div>

                                            <div class="w-full h-px bg-gray-50"></div>

                                            <div>
                                                <div class="flex items-center gap-2 mb-2">
                                                    <div
                                                        class="w-6 h-6 rounded-full bg-orange-50 flex items-center justify-center shrink-0">
                                                        <i class="fa-solid fa-briefcase text-orange-600 text-xs"></i>
                                                    </div>
                                                    <h5 class="font-bold text-gray-800">Riwayat Pekerjaan</h5>
                                                </div>
                                                <div id="m-member-pekerjaan"
                                                    class="pl-8 text-sm text-gray-600 leading-relaxed font-medium"></div>
                                            </div>

                                            <div class="w-full h-px bg-gray-50"></div>

                                            <div>
                                                <div class="flex items-center gap-2 mb-2">
                                                    <div
                                                        class="w-6 h-6 rounded-full bg-yellow-50 flex items-center justify-center shrink-0">
                                                        <i class="fa-solid fa-medal text-yellow-600 text-xs"></i>
                                                    </div>
                                                    <h5 class="font-bold text-gray-800">Penghargaan</h5>
                                                </div>
                                                <div id="m-member-penghargaan"
                                                    class="pl-8 text-sm text-gray-600 leading-relaxed font-medium"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function openMemberModal(id) {
            const modal = document.getElementById('memberModal');
            const loader = document.getElementById('m-member-loader');
            const content = document.getElementById('m-member-real-content');

            loader.classList.remove('hidden');
            content.classList.add('hidden');
            modal.classList.remove('hidden');
            document.body.style.overflow = 'hidden';

            fetch(`/profil-anggota/${id}/detail`)
                .then(res => {
                    if (!res.ok) throw new Error("Gagal mengambil data");
                    return res.json();
                })
                .then(data => {
                    // Foto
                    const fotoUrl = data.foto ? `/storage/${data.foto}` :
                        `https://ui-avatars.com/api/?name=${encodeURIComponent(data.nama)}&background=random`;
                    document.getElementById('m-member-foto').src = fotoUrl;

                    // Data Dasar
                    document.getElementById('m-member-nama').innerText = data.nama;
                    document.getElementById('m-member-jabatan').innerText = data.jabatan;
                    document.getElementById('m-member-partai').innerText = data.partai;
                    document.getElementById('m-member-dapil').innerText = data.dapil;

                    // Kontak
                    document.getElementById('m-member-telp').innerText = data.telepon || '-';
                    document.getElementById('m-member-email').innerText = data.email || '-';

                    // Tanggal Lahir (Format ke Indonesia)
                    if (data.tanggal_lahir) {
                        const date = new Date(data.tanggal_lahir);
                        const options = {
                            year: 'numeric',
                            month: 'long',
                            day: 'numeric'
                        };
                        document.getElementById('m-member-ttl').innerText = date.toLocaleDateString('id-ID', options);
                    } else {
                        document.getElementById('m-member-ttl').innerText = '-';
                    }

                    // Alat Kelengkapan (Komisi & Badan)
                    const wKomisi = document.getElementById('wrapper-komisi');
                    const wBadan = document.getElementById('wrapper-badan');
                    const wKosong = document.getElementById('wrapper-kosong');

                    wKomisi.classList.add('hidden');
                    wBadan.classList.add('hidden');
                    wKosong.classList.add('hidden');

                    let adaKelengkapan = false;

                    if (data.komisi) {
                        wKomisi.classList.remove('hidden');
                        document.getElementById('m-member-komisi').innerText = data.komisi;
                        document.getElementById('m-member-jabatan-komisi').innerText = data.jabatan_komisi ?
                            `(Sebagai: ${data.jabatan_komisi})` : '';
                        adaKelengkapan = true;
                    }

                    if (data.badan) {
                        wBadan.classList.remove('hidden');
                        document.getElementById('m-member-badan').innerText = data.badan;
                        document.getElementById('m-member-jabatan-badan').innerText = data.jabatan_badan ?
                            `(Sebagai: ${data.jabatan_badan})` : '';
                        adaKelengkapan = true;
                    }

                    if (!adaKelengkapan) {
                        wKosong.classList.remove('hidden');
                    }

                    // Format Riwayat (Ubah baris baru \n menjadi tag <br>)
                    const formatText = (text) => text ? text.replace(/\n/g, '<br>') :
                        '<span class="text-gray-400 italic">Belum ada data riwayat</span>';

                    document.getElementById('m-member-pendidikan').innerHTML = formatText(data.riwayat_pendidikan);
                    document.getElementById('m-member-pekerjaan').innerHTML = formatText(data.riwayat_pekerjaan);
                    document.getElementById('m-member-penghargaan').innerHTML = formatText(data.riwayat_penghargaan);

                    // Tampilkan konten
                    loader.classList.add('hidden');
                    content.classList.remove('hidden');
                })
                .catch(err => {
                    alert("Gagal memuat biodata. Silakan coba lagi.");
                    closeMemberModal();
                });
        }

        function closeMemberModal() {
            document.getElementById('memberModal').classList.add('hidden');
            document.body.style.overflow = 'auto';
        }
    </script>
@endsection
