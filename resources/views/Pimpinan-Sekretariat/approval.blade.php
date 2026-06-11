@extends('Pimpinan-Sekretariat.layouts.app')

@section('title', 'Content Approvals')

@section('content')
    <div x-data="{
        showModal: false,
        doc: {},
        fileUrl: '',
        approveUrl: '',
        rejectUrl: '',
    
        openReviewModal(itemData, fileLink, approveLink, rejectLink) {
            this.doc = itemData;
            this.fileUrl = fileLink;
            this.approveUrl = approveLink;
            this.rejectUrl = rejectLink;
            this.showModal = true;
        }
    }" class="w-full px-4 sm:px-6 lg:px-8 py-8 max-w-screen-2xl mx-auto font-sans">

        <a href="{{ route('sekretaris.dashboard') }}"
            class="inline-flex items-center text-purple-600 font-medium hover:underline mb-6 text-sm">
            <i class="fa-solid fa-arrow-left mr-2"></i> Kembali ke Dashboard
        </a>

        <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-8">
            <div class="flex items-center gap-4">
                <div class="w-14 h-14 bg-amber-500 rounded-2xl flex items-center justify-center text-white shadow-md">
                    <i class="fa-solid fa-check-double text-2xl"></i>
                </div>
                <div>
                    <h1 class="text-3xl font-extrabold text-gray-900 mb-1">Persetujuan Pimpinan Sekretariat</h1>
                    <p class="text-gray-500 font-medium">Review dan setujui konten sebelum dipublikasikan ke publik</p>
                </div>
            </div>

            <button onclick="window.location.reload();"
                class="bg-white border border-gray-300 text-gray-700 hover:bg-gray-50 px-4 py-2.5 rounded-xl font-bold transition shadow-sm flex items-center gap-2 text-sm w-max">
                <i class="fa-solid fa-rotate-right"></i> Refresh Data
            </button>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
            <div class="bg-amber-50 rounded-2xl p-6 shadow-sm border border-amber-200 flex items-center justify-between">
                <div>
                    <p class="text-amber-700 text-sm font-bold mb-1">Menunggu Review (Pending)</p>
                    <h3 class="text-4xl font-black text-amber-600">{{ $stats['pending'] }}</h3>
                </div>
                <i class="fa-solid fa-clock-rotate-left text-5xl text-amber-200"></i>
            </div>
            <div class="bg-green-50 rounded-2xl p-6 shadow-sm border border-green-200 flex items-center justify-between">
                <div>
                    <p class="text-green-700 text-sm font-bold mb-1">Telah Disetujui (Approved)</p>
                    <h3 class="text-4xl font-black text-green-600">{{ $stats['approved'] }}</h3>
                </div>
                <i class="fa-solid fa-circle-check text-5xl text-green-200"></i>
            </div>
            <div class="bg-red-50 rounded-2xl p-6 shadow-sm border border-red-200 flex items-center justify-between">
                <div>
                    <p class="text-red-700 text-sm font-bold mb-1">Ditolak / Revisi (Rejected)</p>
                    <h3 class="text-4xl font-black text-red-600">{{ $stats['rejected'] }}</h3>
                </div>
                <i class="fa-solid fa-circle-xmark text-5xl text-red-200"></i>
            </div>
        </div>

        {{-- Flash Messages --}}
        @if (session('success'))
            <div
                class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-xl mb-6 flex items-center gap-2 shadow-sm">
                <i class="fa-solid fa-circle-check"></i> {{ session('success') }}
            </div>
        @endif
        @if (session('error'))
            <div
                class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-xl mb-6 flex items-center gap-2 shadow-sm">
                <i class="fa-solid fa-circle-xmark"></i> {{ session('error') }}
            </div>
        @endif

        <div class="bg-white rounded-2xl shadow-sm border border-gray-200 overflow-hidden mb-8">
            <div class="px-6 py-5 border-b border-gray-200 flex items-center gap-2 bg-gray-50/50">
                <i class="fa-solid fa-list-check text-purple-600"></i>
                <h3 class="font-bold text-gray-900">Daftar Antrean Persetujuan</h3>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr
                            class="bg-gray-50 border-b border-gray-200 text-xs font-bold text-gray-600 uppercase tracking-wider">
                            <th class="px-6 py-4">Modul Konten</th>
                            <th class="px-6 py-4">Judul / Keterangan</th>
                            <th class="px-6 py-4">Diajukan Oleh</th>
                            <th class="px-6 py-4"><i class="fa-regular fa-clock mr-1"></i> Waktu Pengajuan</th>
                            <th class="px-6 py-4 text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @forelse($pending_items as $item)
                            <tr class="hover:bg-purple-50/30 transition">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span
                                        class="bg-purple-100 text-purple-700 px-2.5 py-1 rounded-md text-xs font-bold border border-purple-200">
                                        Dokumen
                                    </span>
                                </td>
                                <td class="px-6 py-4 text-sm font-bold text-gray-900">
                                    <div class="mb-1">{{ $item->judul }}</div>
                                    <div class="text-xs text-gray-400 font-normal">Kategori: {{ $item->kategori }} • Tahun:
                                        {{ $item->tahun }}</div>
                                </td>
                                <td class="px-6 py-4 text-sm text-gray-600">
                                    <i class="fa-regular fa-user mr-1 opacity-50"></i> Staf Sekretariat
                                </td>
                                <td class="px-6 py-4 text-sm text-gray-500 whitespace-nowrap">
                                    {{ $item->created_at->format('d M Y, H:i') }}
                                </td>
                                <td class="px-6 py-4 text-center">
                                    <button
                                        @click="openReviewModal(
                                        {{ json_encode($item) }}, 
                                        '{{ asset('storage/' . $item->file_path) }}', 
                                        '{{ route('sekretaris.approval.approve', $item->id) }}', 
                                        '{{ route('sekretaris.approval.reject', $item->id) }}'
                                    )"
                                        class="bg-amber-100 text-amber-700 hover:bg-amber-500 hover:text-white border border-amber-300 px-4 py-2 rounded-lg text-xs font-bold transition shadow-sm flex items-center gap-2 mx-auto">
                                        <i class="fa-solid fa-magnifying-glass"></i> Review
                                    </button>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="px-6 py-20 text-center">
                                    <div class="flex flex-col items-center justify-center">
                                        <i class="fa-solid fa-clipboard-check text-5xl text-gray-300 mb-4"></i>
                                        <h3 class="text-gray-500 font-bold text-lg mb-1">Semua Selesai!</h3>
                                        <p class="text-gray-400 text-sm">Tidak ada dokumen yang menunggu persetujuan saat
                                            ini.</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <div x-show="showModal" style="display: none;" class="fixed inset-0 z-50 overflow-y-auto"
            aria-labelledby="modal-title" role="dialog" aria-modal="true">
            <div class="flex items-end justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:block sm:p-0">

                <div x-show="showModal" x-transition.opacity
                    class="fixed inset-0 transition-opacity bg-gray-900 bg-opacity-60 backdrop-blur-sm" aria-hidden="true"
                    @click="showModal = false"></div>
                <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>

                <div x-show="showModal" x-transition.scale
                    class="inline-block w-full max-w-2xl p-6 my-8 text-left align-middle transition-all transform bg-white shadow-2xl rounded-2xl sm:align-middle border-t-8 border-[#ff0015]">

                    <div class="flex items-center justify-between mb-5">
                        <h3 class="text-2xl font-extrabold text-gray-900" id="modal-title">Review untuk Persetujuan</h3>
                        <button @click="showModal = false"
                            class="text-gray-400 hover:text-gray-600 bg-gray-100 hover:bg-gray-200 rounded-full w-8 h-8 flex items-center justify-center transition">
                            <i class="fa-solid fa-xmark"></i>
                        </button>
                    </div>

                    <div class="flex flex-wrap items-center gap-2 mb-4">
                        <span
                            class="px-4 py-1.5 text-xs font-black text-amber-700 bg-amber-100 border border-amber-300 rounded-md tracking-wider flex items-center gap-1.5"><i
                                class="fa-regular fa-clock"></i> MENUNGGU REVIEW</span>
                        <span
                            class="px-3 py-1.5 text-xs font-bold text-red-600 border border-red-500 rounded-md flex items-center gap-1"><i
                                class="fa-solid fa-caret-up"></i> PRIORITAS DOKUMEN</span>
                        <span class="px-3 py-1.5 text-xs font-bold text-purple-600 bg-purple-50 rounded-md"
                            x-text="doc.kategori"></span>
                    </div>

                    <h4 class="text-xl font-bold text-gray-900 mb-2 leading-snug" x-text="doc.judul"></h4>
                    <p class="text-sm text-gray-600 mb-6 leading-relaxed" x-text="doc.deskripsi"></p>

                    <div class="grid grid-cols-2 gap-y-4 mb-6 text-sm bg-gray-50 p-4 rounded-xl border border-gray-100">
                        <div>
                            <p class="text-gray-500 mb-0.5 text-xs">Diajukan Oleh</p>
                            <p class="font-bold text-gray-900">Staf Sekretariat DPRD</p>
                        </div>
                        <div>
                            <p class="text-gray-500 mb-0.5 text-xs">Waktu Pengajuan</p>
                            <p class="font-bold text-gray-900"
                                x-text="new Date(doc.created_at).toLocaleDateString('id-ID', { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' })">
                            </p>
                        </div>
                        <div>
                            <p class="text-gray-500 mb-0.5 text-xs">Kategori Arsip</p>
                            <p class="font-bold text-gray-900" x-text="doc.kategori"></p>
                        </div>
                        <div>
                            <p class="text-gray-500 mb-0.5 text-xs">Jenis Dokumen / Ukuran</p>
                            <p class="font-bold text-gray-900"><span x-text="doc.tipe_file"></span> • <span
                                    x-text="doc.ukuran_file"></span></p>
                        </div>
                    </div>

                    <form method="POST">
                        @csrf

                        <div class="mb-6">
                            <label class="block mb-2 text-sm font-medium text-gray-700">Catatan Persetujuan
                                (Opsional)</label>
                            <textarea name="catatan" rows="3"
                                class="w-full px-4 py-3 text-sm bg-white border border-gray-300 rounded-xl focus:ring-2 focus:ring-purple-500 focus:border-purple-500 outline-none resize-none transition shadow-inner"
                                placeholder="Tambahkan catatan atau komentar untuk keputusan ini (misal: 'Harap perbaiki halaman 2')..."></textarea>
                        </div>

                        <div class="flex flex-col sm:flex-row flex-wrap items-center gap-3">
                            <button type="submit" :formaction="approveUrl"
                                class="w-full sm:w-auto px-6 py-3 text-sm font-bold text-white transition bg-[#00b84c] rounded-xl hover:bg-green-600 flex items-center justify-center gap-2 shadow-md">
                                <i class="fa-solid fa-circle-check"></i> Setujui
                            </button>

                            <button type="submit" :formaction="rejectUrl"
                                class="w-full sm:w-auto px-6 py-3 text-sm font-bold text-white transition bg-[#ff0015] rounded-xl hover:bg-red-700 flex items-center justify-center gap-2 shadow-md">
                                <i class="fa-regular fa-circle-xmark"></i> Tolak
                            </button>

                            <a :href="fileUrl" target="_blank"
                                class="w-full sm:w-auto px-6 py-3 text-sm font-bold text-white transition bg-[#0055ff] rounded-xl hover:bg-blue-700 flex items-center justify-center gap-2 shadow-md">
                                <i class="fa-regular fa-file-pdf"></i> Lihat Dokumen
                            </a>

                            <button type="button" @click="showModal = false"
                                class="w-full sm:w-auto mt-4 sm:mt-0 sm:ml-auto px-6 py-3 text-sm font-bold text-gray-700 transition bg-gray-100 border border-gray-300 rounded-xl hover:bg-gray-200">
                                Tutup
                            </button>
                        </div>
                    </form>

                </div>
            </div>
        </div>

    </div>
@endsection
