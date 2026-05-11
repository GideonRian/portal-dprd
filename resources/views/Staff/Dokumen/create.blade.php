@extends('Staff.layouts.app')

@section('title', 'Tambah Dokumen')

@section('content')
    <div class="w-full px-4 sm:px-6 lg:px-8 py-10 max-w-3xl mx-auto">
        <a href="{{ route('staff.dokumen.index') }}"
            class="inline-flex items-center text-rose-600 font-bold hover:underline mb-6 text-sm">
            <i class="fa-solid fa-arrow-left mr-2"></i> Kembali ke Daftar Dokumen
        </a>

        <div class="flex items-center gap-4 mb-8">
            <div class="w-14 h-14 bg-rose-600 rounded-2xl flex items-center justify-center text-white shadow-md"><i
                    class="fa-solid fa-file-arrow-up text-xl"></i></div>
            <div>
                <h2 class="text-3xl font-extrabold text-gray-900 mb-1">Tambah Dokumen Baru</h2>
                <p class="text-gray-500 text-sm">Upload dokumen baru ke sistem</p>
            </div>
        </div>

        <!-- TAMBAHAN: Menampilkan Pesan Error Jika Upload Gagal -->
        @if ($errors->any())
            <div class="bg-red-50 border-l-4 border-red-500 p-4 rounded-xl mb-6 shadow-sm">
                <div class="flex items-center mb-2">
                    <i class="fa-solid fa-triangle-exclamation text-red-500 mr-2"></i>
                    <h3 class="text-red-800 font-bold text-sm">Gagal menyimpan dokumen:</h3>
                </div>
                <ul class="list-disc pl-6 text-sm text-red-600">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="bg-white rounded-3xl shadow-sm border border-rose-200 p-8">
            <form action="{{ route('staff.dokumen.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="mb-6">
                    <label class="block text-sm font-bold text-gray-700 mb-2">Upload File Dokumen <span
                            class="text-rose-500">*</span></label>
                    <div
                        class="border-2 border-dashed border-gray-300 rounded-2xl p-8 text-center hover:bg-gray-50 transition relative">
                        <i class="fa-solid fa-arrow-up-from-bracket text-2xl text-gray-400 mb-2"></i>
                        <p class="font-bold text-gray-700 text-sm">Klik untuk upload file</p>
                        <p class="text-xs text-gray-500 mt-1">PDF, DOC, DOCX, atau XLSX (Max 50MB)</p>
                        <input type="file" name="file_dokumen" required accept=".pdf,.doc,.docx,.xls,.xlsx"
                            class="absolute inset-0 w-full h-full opacity-0 cursor-pointer">
                    </div>
                </div>

                <div class="mb-6">
                    <label class="block text-sm font-bold text-gray-700 mb-2">Judul Dokumen <span
                            class="text-rose-500">*</span></label>
                    <input type="text" name="judul" required value="{{ old('judul') }}"
                        placeholder="Contoh: Peraturan Daerah Provinsi Sumatera Utara Nomor 1 Tahun 2026"
                        class="w-full border border-gray-300 rounded-xl px-4 py-3 focus:ring-2 focus:ring-rose-500 outline-none">
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-2">Kategori <span
                                class="text-rose-500">*</span></label>
                        <select name="kategori" required
                            class="w-full border border-gray-300 rounded-xl px-4 py-3 focus:ring-2 focus:ring-rose-500 outline-none bg-white">
                            <option value="Peraturan Daerah">Peraturan Daerah</option>
                            <option value="Keputusan DPRD">Keputusan DPRD</option>
                            <option value="Risalah Rapat">Risalah Rapat</option>
                            <option value="Laporan Keuangan">Laporan Keuangan</option>
                            <option value="Hasil Hearing">Hasil Hearing</option>
                            <option value="Peraturan Tata Tertib">Peraturan Tata Tertib</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-2">Tahun <span
                                class="text-rose-500">*</span></label>
                        <input type="number" name="tahun" required placeholder="Contoh: 2026" value="{{ old('tahun') }}"
                            class="w-full border border-gray-300 rounded-xl px-4 py-3 focus:ring-2 focus:ring-rose-500 outline-none">
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-2">Tipe File</label>
                        <input type="text" name="tipe_file" placeholder="Opsional (Otomatis dideteksi)"
                            value="{{ old('tipe_file') }}"
                            class="w-full border border-gray-300 rounded-xl px-4 py-3 focus:ring-2 focus:ring-rose-500 outline-none bg-gray-50">
                    </div>
                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-2">Nama File</label>
                        <input type="text" name="nama_file" placeholder="Opsional (Sesuai nama asli file)"
                            value="{{ old('nama_file') }}"
                            class="w-full border border-gray-300 rounded-xl px-4 py-3 focus:ring-2 focus:ring-rose-500 outline-none bg-gray-50">
                    </div>
                </div>

                <div class="mb-6">
                    <label class="block text-sm font-bold text-gray-700 mb-2">Deskripsi Dokumen <span
                            class="text-rose-500">*</span></label>
                    <textarea name="deskripsi" required rows="4" placeholder="Masukkan deskripsi lengkap tentang dokumen ini..."
                        class="w-full border border-gray-300 rounded-xl px-4 py-3 focus:ring-2 focus:ring-rose-500 outline-none">{{ old('deskripsi') }}</textarea>
                    <p class="text-xs text-gray-400 mt-2">Deskripsi akan ditampilkan di halaman publik</p>
                </div>

                <div class="mb-8 bg-blue-50 border border-blue-100 text-blue-800 p-4 rounded-xl text-sm leading-relaxed">
                    <strong>Catatan:</strong> Pastikan dokumen yang diupload adalah versi final dan sudah diverifikasi.
                    Dokumen akan langsung tersedia untuk diunduh oleh publik setelah disimpan.
                </div>

                <div class="flex gap-4 pt-6 border-t border-gray-100">
                    <a href="{{ route('staff.dokumen.index') }}"
                        class="w-1/3 text-center px-6 py-3.5 bg-white border border-gray-300 text-gray-700 font-bold rounded-xl hover:bg-gray-50 transition">Batal</a>
                    <button type="submit"
                        class="w-2/3 px-6 py-3.5 bg-rose-600 text-white font-bold rounded-xl hover:bg-rose-700 transition shadow-md flex justify-center items-center gap-2">
                        <i class="fa-regular fa-floppy-disk"></i> Simpan Dokumen
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
