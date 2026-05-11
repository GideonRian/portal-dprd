@extends('Staff.layouts.app')

@section('title', 'Edit Agenda')

@section('content')
    <div class="w-full px-4 sm:px-6 lg:px-8 py-10 max-w-3xl mx-auto">
        <a href="{{ route('staff.agenda.index') }}"
            class="inline-flex items-center text-orange-600 font-bold hover:underline mb-6 text-sm">
            <i class="fa-solid fa-arrow-left mr-2"></i> Kembali ke Daftar Agenda
        </a>

        <div class="flex items-center gap-4 mb-8">
            <div class="w-14 h-14 bg-orange-500 rounded-2xl flex items-center justify-center text-white shadow-md"><i
                    class="fa-regular fa-calendar-check text-xl"></i></div>
            <div>
                <h2 class="text-3xl font-extrabold text-gray-900 mb-1">Edit Agenda</h2>
                <p class="text-gray-500 text-sm">Perbarui informasi agenda kegiatan DPRD</p>
            </div>
        </div>

        <div class="bg-white rounded-3xl shadow-sm border border-gray-100 p-8">
            <form action="{{ route('staff.agenda.update', $agenda->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="mb-6">
                    <label class="block text-sm font-bold text-gray-700 mb-2">Judul Agenda <span
                            class="text-red-500">*</span></label>
                    <input type="text" name="judul" value="{{ $agenda->judul }}" required
                        placeholder="Contoh: Rapat Paripurna Pembahasan APBD 2027"
                        class="w-full border border-gray-300 rounded-xl px-4 py-3 focus:ring-2 focus:ring-orange-500 outline-none">
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-2">Tanggal <span
                                class="text-red-500">*</span></label>
                        <input type="date" name="tanggal"
                            value="{{ \Carbon\Carbon::parse($agenda->tanggal)->format('Y-m-d') }}" required
                            class="w-full border border-gray-300 rounded-xl px-4 py-3 focus:ring-2 focus:ring-orange-500 outline-none">
                    </div>
                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-2">Waktu <span
                                class="text-red-500">*</span></label>
                        <input type="text" name="waktu" value="{{ $agenda->waktu }}" required
                            placeholder="09:00 - 12:00 WIB"
                            class="w-full border border-gray-300 rounded-xl px-4 py-3 focus:ring-2 focus:ring-orange-500 outline-none">
                    </div>
                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-2">Status <span
                                class="text-red-500">*</span></label>
                        <select name="status" required
                            class="w-full border border-gray-300 rounded-xl px-4 py-3 focus:ring-2 focus:ring-orange-500 outline-none bg-white">
                            <option value="Akan Datang" {{ $agenda->status == 'Akan Datang' ? 'selected' : '' }}>Akan Datang
                            </option>
                            <option value="Selesai" {{ $agenda->status == 'Selesai' ? 'selected' : '' }}>Selesai</option>
                        </select>
                    </div>
                </div>

                <div class="mb-6">
                    <label class="block text-sm font-bold text-gray-700 mb-2">Lokasi <span
                            class="text-red-500">*</span></label>
                    <input type="text" name="lokasi" value="{{ $agenda->lokasi }}" required
                        placeholder="Contoh: Ruang Rapat Paripurna"
                        class="w-full border border-gray-300 rounded-xl px-4 py-3 focus:ring-2 focus:ring-orange-500 outline-none">
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-2">Kategori <span
                                class="text-red-500">*</span></label>
                        <select name="kategori" required
                            class="w-full border border-gray-300 rounded-xl px-4 py-3 focus:ring-2 focus:ring-orange-500 outline-none bg-white">
                            <option value="Rapat Paripurna" {{ $agenda->kategori == 'Rapat Paripurna' ? 'selected' : '' }}>
                                Rapat Paripurna</option>
                            <option value="Kunjungan Kerja" {{ $agenda->kategori == 'Kunjungan Kerja' ? 'selected' : '' }}>
                                Kunjungan Kerja</option>
                            <option value="Hearing" {{ $agenda->kategori == 'Hearing' ? 'selected' : '' }}>Hearing</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-2">Peserta <span
                                class="text-red-500">*</span></label>
                        <input type="text" name="peserta" value="{{ $agenda->peserta }}" required
                            placeholder="Contoh: Seluruh Anggota DPRD"
                            class="w-full border border-gray-300 rounded-xl px-4 py-3 focus:ring-2 focus:ring-orange-500 outline-none">
                    </div>
                </div>

                <div class="mb-6">
                    <label class="block text-sm font-bold text-gray-700 mb-2">Deskripsi Agenda <span
                            class="text-red-500">*</span></label>
                    <textarea name="deskripsi" required rows="4" placeholder="Jelaskan detail agenda..."
                        class="w-full border border-gray-300 rounded-xl px-4 py-3 focus:ring-2 focus:ring-orange-500 outline-none">{{ $agenda->deskripsi }}</textarea>
                </div>

                <div class="mb-6">
                    <label class="block text-sm font-bold text-gray-700 mb-2">Susunan Acara (Opsional)</label>
                    <textarea name="susunan_acara" rows="5"
                        placeholder="Contoh:&#10;Pembukaan oleh Ketua&#10;Laporan Bupati&#10;Penutup"
                        class="w-full border border-gray-300 rounded-xl px-4 py-3 focus:ring-2 focus:ring-orange-500 outline-none">{{ $agenda->susunan_acara ?? old('susunan_acara') }}</textarea>
                    <p class="text-xs text-gray-400 mt-2 italic">*Gunakan baris baru (Enter) untuk memisahkan setiap poin
                        acara.</p>
                </div>

                <div class="mb-8">
                    <label class="block text-sm font-bold text-gray-700 mb-2">Ganti Gambar <span
                            class="text-gray-400 font-normal">(Opsional)</span></label>
                    
                    {{-- Tambahkan ID upload-gambar --}}
                    <input type="file" id="upload-gambar" name="gambar" accept="image/*"
                        class="w-full border border-gray-300 rounded-xl px-4 py-3 focus:ring-2 focus:ring-orange-500 outline-none transition">
                    
                    {{-- Pesan Error Tersembunyi --}}
                    <p id="error-gambar" class="text-sm font-bold text-red-500 mt-2 hidden">
                        <i class="fa-solid fa-triangle-exclamation mr-1"></i> Ukuran gambar terlalu besar! Maksimal 2MB.
                    </p>
                    <p class="text-xs text-gray-400 mt-2" id="hint-gambar">Biarkan kosong jika tidak ingin mengubah gambar lama. Format: JPG, PNG. Maksimal 2MB.</p>
                </div>

                <div class="flex gap-4 pt-6 border-t border-gray-100">
                    <a href="{{ route('staff.agenda.index') }}"
                        class="w-1/3 text-center px-6 py-3.5 bg-gray-100 text-gray-700 font-bold rounded-xl hover:bg-gray-200 transition">Batal</a>
                    <button type="submit"
                        class="w-2/3 px-6 py-3.5 bg-orange-500 text-white font-bold rounded-xl hover:bg-orange-600 transition shadow-md flex justify-center items-center gap-2">
                        <i class="fa-regular fa-floppy-disk"></i> Simpan Perubahan
                    </button>
                </div>
            </form>
        </div>
    </div>

    {{-- Script Pengecekan Ukuran File 2MB --}}
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const fileInput = document.getElementById('upload-gambar');
            const errorMsg = document.getElementById('error-gambar');
            const hintMsg = document.getElementById('hint-gambar');

            if (fileInput) {
                fileInput.addEventListener('change', function () {
                    const file = this.files[0];
                    if (file) {
                        const maxSize = 2 * 1024 * 1024; // 2MB dalam Bytes
                        if (file.size > maxSize) {
                            // Tampilkan error, sembunyikan hint, reset input
                            errorMsg.classList.remove('hidden');
                            hintMsg.classList.add('hidden');
                            this.value = ''; // Mengosongkan file yang dipilih
                        } else {
                            // Jika aman, sembunyikan error
                            errorMsg.classList.add('hidden');
                            hintMsg.classList.remove('hidden');
                        }
                    }
                });
            }
        });
    </script>
@endsection