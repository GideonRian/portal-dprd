@extends('Staff.layouts.app')

@section('title', 'Edit Berita')

@section('content')
    <main class="w-full px-4 sm:px-6 lg:px-8 py-8 max-w-4xl mx-auto">
        <a href="{{ route('staff.berita.index') }}"
            class="inline-flex items-center text-purple-600 font-bold hover:underline mb-6 text-sm">
            <i class="fa-solid fa-arrow-left mr-2"></i> Kembali ke Daftar Berita
        </a>

        <div class="flex items-center gap-4 mb-8">
            <div class="w-14 h-14 bg-purple-600 rounded-2xl flex items-center justify-center text-white shadow-md"><i
                    class="fa-solid fa-file-pen text-xl"></i></div>
            <div>
                <h2 class="text-3xl font-extrabold text-gray-900 mb-1">Edit Berita</h2>
                <p class="text-gray-500 text-sm">Perbarui informasi berita</p>
            </div>
        </div>

        <div class="bg-white rounded-3xl shadow-sm border border-gray-100 p-8">
            <form action="{{ route('staff.berita.update', $berita->id) }}" method="POST" enctype="multipart/form-data">
                @csrf @method('PUT')

                <div class="mb-6">
                    <label class="block text-sm font-bold text-gray-700 mb-2">Judul Berita <span
                            class="text-red-500">*</span></label>
                    <input type="text" name="judul" value="{{ $berita->judul }}" required
                        class="w-full border border-gray-300 rounded-xl px-4 py-3 focus:ring-2 focus:ring-purple-500 outline-none">
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-2">Tanggal <span
                                class="text-red-500">*</span></label>
                        <input type="date" name="tanggal" value="{{ date('Y-m-d', strtotime($berita->tanggal)) }}"
                            required
                            class="w-full border border-gray-300 rounded-xl px-4 py-3 focus:ring-2 focus:ring-purple-500 outline-none">
                    </div>
                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-2">Kategori <span
                                class="text-red-500">*</span></label>
                        <select name="kategori" required
                            class="w-full border border-gray-300 rounded-xl px-4 py-3 focus:ring-2 focus:ring-purple-500 outline-none bg-white">
                            <option value="Rapat Paripurna" {{ $berita->kategori == 'Rapat Paripurna' ? 'selected' : '' }}>
                                Rapat Paripurna</option>
                            <option value="Kunjungan Kerja" {{ $berita->kategori == 'Kunjungan Kerja' ? 'selected' : '' }}>
                                Kunjungan Kerja</option>
                            <option value="Hearing" {{ $berita->kategori == 'Hearing' ? 'selected' : '' }}>Hearing</option>
                            <option value="Peraturan Daerah"
                                {{ $berita->kategori == 'Peraturan Daerah' ? 'selected' : '' }}>Peraturan Daerah</option>
                            <option value="Kegiatan Sosial" {{ $berita->kategori == 'Kegiatan Sosial' ? 'selected' : '' }}>
                                Kegiatan Sosial</option>
                        </select>
                    </div>
                </div>

                <div class="mb-6">
                    <label class="block text-sm font-bold text-gray-700 mb-2">Upload Gambar <span
                            class="text-gray-400 font-normal">(Opsional)</span></label>
                    <!-- Gambar opsional saat di edit -->
                    <input type="file" name="gambar[]" id="gambarInput" multiple accept="image/*"
                        class="w-full border border-gray-300 rounded-xl px-4 py-3 focus:ring-2 focus:ring-purple-500 outline-none">
                    <p class="text-xs text-gray-400 mt-2">Biarkan kosong jika tidak ingin mengubah foto lama. Maksimal 5
                        Foto.</p>
                </div>

                <div class="mb-6">
                    <label class="block text-sm font-bold text-gray-700 mb-2">Ringkasan <span
                            class="text-red-500">*</span></label>
                    <textarea name="ringkasan" required rows="3"
                        class="w-full border border-gray-300 rounded-xl px-4 py-3 focus:ring-2 focus:ring-purple-500 outline-none">{{ $berita->ringkasan }}</textarea>
                </div>

                <div class="mb-8">
                    <label class="block text-sm font-bold text-gray-700 mb-2">Konten Lengkap <span
                            class="text-red-500">*</span></label>
                    <textarea name="konten" id="editor">{{ $berita->konten }}</textarea>
                </div>

                <div class="mb-8 bg-gray-50 border border-gray-200 rounded-xl p-4">
                    <label class="flex items-center gap-3 cursor-pointer">
                        <input type="checkbox" name="is_featured" {{ $berita->is_featured ? 'checked' : '' }}
                            class="w-5 h-5 text-purple-600 rounded focus:ring-purple-500 cursor-pointer">
                        <span class="font-bold text-gray-700 text-sm">Jadikan berita unggulan (Featured)</span>
                    </label>
                </div>

                <div class="flex gap-4 pt-6 border-t border-gray-100">
                    <a href="{{ route('staff.berita.index') }}"
                        class="w-1/3 text-center px-6 py-3.5 bg-gray-100 text-gray-700 font-bold rounded-xl hover:bg-gray-200 transition">Batal</a>
                    <button type="submit"
                        class="w-2/3 px-6 py-3.5 bg-purple-600 text-white font-bold rounded-xl hover:bg-purple-700 transition shadow-md flex justify-center items-center gap-2">
                        <i class="fa-regular fa-floppy-disk"></i> Simpan Perubahan
                    </button>
                </div>
            </form>
        </div>
    </main>

    <script>
        ClassicEditor.create(document.querySelector('#editor')).catch(error => {
            console.error(error);
        });
        document.getElementById('gambarInput').addEventListener('change', function() {
            if (this.files.length > 5) {
                alert('Maksimal hanya boleh mengunggah 5 foto!');
                this.value = '';
            }
        });
    </script>
@endsection
