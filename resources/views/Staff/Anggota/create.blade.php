@extends('Staff.layouts.app')

@section('content')
    <main class="w-full px-4 sm:px-6 lg:px-8 py-8 max-w-4xl mx-auto">
        {{-- Back Navigation --}}
        <a href="{{ route('staff.anggota.index') }}"
            class="inline-flex items-center text-blue-600 font-bold hover:underline mb-6 text-sm">
            <i class="fa-solid fa-arrow-left mr-2"></i> Kembali ke Daftar Anggota
        </a>

        {{-- Header Section --}}
        <div class="flex items-center gap-4 mb-8">
            <div class="w-14 h-14 bg-blue-600 rounded-2xl flex items-center justify-center text-white shadow-md">
                <i class="fa-solid fa-user-plus text-xl"></i>
            </div>
            <div>
                <h2 class="text-3xl font-extrabold text-gray-900 mb-1">Tambah Anggota Baru</h2>
                <p class="text-gray-500 font-medium text-sm">Isi data lengkap anggota DPRD</p>
            </div>
        </div>

        {{-- Create Form --}}
        <div class="bg-white rounded-3xl shadow-sm border border-gray-100 p-8">
            <form action="{{ route('staff.anggota.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                {{-- FOTO PROFIL --}}
                <div class="mb-8">
                    <label class="block text-sm font-bold text-gray-700 mb-2">Foto Profil <span
                            class="text-gray-400 font-normal">(Opsional)</span></label>
                    <input type="file" name="foto" accept="image/*"
                        class="w-full border border-gray-300 rounded-xl px-4 py-3 text-sm focus:ring-2 focus:ring-blue-500 outline-none transition">
                    <p class="text-xs text-gray-400 mt-2">Maksimal ukuran file 2MB (JPG, PNG)</p>
                </div>

                <hr class="border-gray-100 mb-8">

                {{-- DATA PRIBADI & KONTAK --}}
                <h3 class="text-lg font-black text-gray-900 mb-5 flex items-center gap-2">
                    <i class="fa-regular fa-id-card text-blue-500"></i> Data Pribadi & Kontak
                </h3>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-2">Nama Lengkap <span
                                class="text-red-500">*</span></label>
                        <input type="text" name="nama" value="{{ old('nama') }}" required
                            placeholder="Contoh: Ir. Budi Santoso, M.Si"
                            class="w-full border border-gray-300 rounded-xl px-4 py-3 focus:ring-2 focus:ring-blue-500 outline-none transition">
                    </div>
                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-2">Tanggal Lahir <span
                                class="text-gray-400 font-normal">(Opsional)</span></label>
                        <input type="date" name="tanggal_lahir" value="{{ old('tanggal_lahir') }}"
                            class="w-full border border-gray-300 rounded-xl px-4 py-3 focus:ring-2 focus:ring-blue-500 outline-none transition text-gray-700">
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-2">Nomor Telepon <span
                                class="text-gray-400 font-normal">(Opsional)</span></label>
                        <input type="text" name="telepon" value="{{ old('telepon') }}"
                            placeholder="Contoh: (061) 123-4567"
                            class="w-full border border-gray-300 rounded-xl px-4 py-3 focus:ring-2 focus:ring-blue-500 outline-none transition">
                    </div>
                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-2">Email <span
                                class="text-gray-400 font-normal">(Opsional)</span></label>
                        <input type="email" name="email" value="{{ old('email') }}"
                            placeholder="Contoh: nama@dprd-tapsel.go.id"
                            class="w-full border border-gray-300 rounded-xl px-4 py-3 focus:ring-2 focus:ring-blue-500 outline-none transition">
                    </div>
                </div>

                <hr class="border-gray-100 mb-8">

                {{-- POSISI & JABATAN DEWAN --}}
                <h3 class="text-lg font-black text-gray-900 mb-5 flex items-center gap-2">
                    <i class="fa-solid fa-sitemap text-blue-500"></i> Posisi & Jabatan Dewan
                </h3>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-2">Jabatan Umum <span
                                class="text-red-500">*</span></label>
                        <input type="text" name="jabatan" value="{{ old('jabatan') }}" required
                            placeholder="Contoh: Ketua DPRD / Anggota"
                            class="w-full border border-gray-300 rounded-xl px-4 py-3 focus:ring-2 focus:ring-blue-500 outline-none transition">
                    </div>
                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-2">Partai/Fraksi <span
                                class="text-red-500">*</span></label>
                        <input type="text" name="partai" value="{{ old('partai') }}" required
                            placeholder="Contoh: Fraksi Golkar"
                            class="w-full border border-gray-300 rounded-xl px-4 py-3 focus:ring-2 focus:ring-blue-500 outline-none transition">
                    </div>
                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-2">Daerah Pemilihan (Dapil) <span
                                class="text-red-500">*</span></label>
                        <input type="text" name="dapil" value="{{ old('dapil') }}" required
                            placeholder="Contoh: Tapsel I"
                            class="w-full border border-gray-300 rounded-xl px-4 py-3 focus:ring-2 focus:ring-blue-500 outline-none transition">
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6 bg-gray-50 p-6 rounded-2xl border border-gray-100">
                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-2">Komisi <span
                                class="text-gray-400 font-normal">(Opsional)</span></label>
                        <div class="relative mb-3">
                            <select name="komisi"
                                class="w-full border border-gray-300 rounded-xl px-4 py-3 focus:ring-2 focus:ring-blue-500 outline-none transition appearance-none bg-white">
                                <option value="" {{ old('komisi') == '' ? 'selected' : '' }}>-- Kosongkan / Tidak Ada
                                    --</option>
                                <option value="Komisi A" {{ old('komisi') == 'Komisi A' ? 'selected' : '' }}>Komisi A
                                </option>
                                <option value="Komisi B" {{ old('komisi') == 'Komisi B' ? 'selected' : '' }}>Komisi B
                                </option>
                                <option value="Komisi C" {{ old('komisi') == 'Komisi C' ? 'selected' : '' }}>Komisi C
                                </option>
                            </select>
                            <i
                                class="fa-solid fa-chevron-down absolute right-4 top-1/2 -translate-y-1/2 text-gray-400 pointer-events-none"></i>
                        </div>
                        <input type="text" name="jabatan_komisi" value="{{ old('jabatan_komisi') }}"
                            placeholder="Sbg: Ketua / Wakil / Anggota"
                            class="w-full border border-gray-300 rounded-xl px-4 py-3 text-sm focus:ring-2 focus:ring-blue-500 outline-none transition">
                    </div>

                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-2">Badan Dewan <span
                                class="text-gray-400 font-normal">(Opsional)</span></label>
                        <div class="relative mb-3">
                            <select name="badan"
                                class="w-full border border-gray-300 rounded-xl px-4 py-3 focus:ring-2 focus:ring-blue-500 outline-none transition appearance-none bg-white">
                                <option value="" {{ old('badan') == '' ? 'selected' : '' }}>-- Kosongkan / Tidak Ada
                                    --</option>
                                <option value="Badan Anggaran (Banggar)"
                                    {{ old('badan') == 'Badan Anggaran (Banggar)' ? 'selected' : '' }}>Badan Anggaran
                                    (Banggar)</option>
                                <option value="Badan Musyawarah (Banmus)"
                                    {{ old('badan') == 'Badan Musyawarah (Banmus)' ? 'selected' : '' }}>Badan Musyawarah
                                    (Banmus)</option>
                                <option value="Badan Pembentukan Peraturan Daerah (Bapemperda)"
                                    {{ old('badan') == 'Badan Pembentukan Peraturan Daerah (Bapemperda)' ? 'selected' : '' }}>
                                    Bapemperda</option>
                                <option value="Badan Kehormatan (BK)"
                                    {{ old('badan') == 'Badan Kehormatan (BK)' ? 'selected' : '' }}>Badan Kehormatan (BK)
                                </option>
                            </select>
                            <i
                                class="fa-solid fa-chevron-down absolute right-4 top-1/2 -translate-y-1/2 text-gray-400 pointer-events-none"></i>
                        </div>
                        <input type="text" name="jabatan_badan" value="{{ old('jabatan_badan') }}"
                            placeholder="Sbg: Ketua / Wakil / Anggota"
                            class="w-full border border-gray-300 rounded-xl px-4 py-3 text-sm focus:ring-2 focus:ring-blue-500 outline-none transition">
                    </div>
                </div>

                <hr class="border-gray-100 mb-8 mt-8">

                {{-- RIWAYAT HIDUP & KARIR --}}
                <h3 class="text-lg font-black text-gray-900 mb-5 flex items-center gap-2">
                    <i class="fa-solid fa-clock-rotate-left text-blue-500"></i> Riwayat Hidup & Karir
                </h3>

                <div class="space-y-6 mb-8">
                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-2">Riwayat Pendidikan <span
                                class="text-gray-400 font-normal">(Opsional)</span></label>
                        <textarea name="riwayat_pendidikan" rows="3"
                            placeholder="Gunakan tanda strip (-) untuk membuat daftar baru.&#10;Contoh:&#10;- SD/SMP/SMA&#10;- S1 Hukum Universitas Sumatera Utara (2010)&#10;- S2 Ilmu Politik Universitas Indonesia (2015)"
                            class="w-full border border-gray-300 rounded-xl px-4 py-3 text-sm focus:ring-2 focus:ring-blue-500 outline-none transition">{{ old('riwayat_pendidikan') }}</textarea>
                    </div>
                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-2">Riwayat Pekerjaan <span
                                class="text-gray-400 font-normal">(Opsional)</span></label>
                        <textarea name="riwayat_pekerjaan" rows="3"
                            placeholder="Contoh:&#10;- Direktur Utama PT. Tapanuli Jaya (2015 - 2020)&#10;- Anggota DPRD Tapsel (2020 - Sekarang)"
                            class="w-full border border-gray-300 rounded-xl px-4 py-3 text-sm focus:ring-2 focus:ring-blue-500 outline-none transition">{{ old('riwayat_pekerjaan') }}</textarea>
                    </div>
                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-2">Riwayat Penghargaan <span
                                class="text-gray-400 font-normal">(Opsional)</span></label>
                        <textarea name="riwayat_penghargaan" rows="3"
                            placeholder="Contoh:&#10;- Tokoh Pemuda Inspiratif Tapanuli Selatan (2018)"
                            class="w-full border border-gray-300 rounded-xl px-4 py-3 text-sm focus:ring-2 focus:ring-blue-500 outline-none transition">{{ old('riwayat_penghargaan') }}</textarea>
                    </div>
                </div>

                {{-- BUTTONS --}}
                <div class="flex gap-4 pt-6 border-t border-gray-100">
                    <a href="{{ route('staff.anggota.index') }}"
                        class="w-1/3 text-center px-6 py-3.5 bg-gray-100 text-gray-700 font-bold rounded-xl hover:bg-gray-200 transition">Batal</a>
                    <button type="submit"
                        class="w-2/3 px-6 py-3.5 bg-blue-600 text-white font-bold rounded-xl hover:bg-blue-700 transition shadow-md flex justify-center items-center gap-2">
                        <i class="fa-regular fa-floppy-disk"></i> Simpan Data Anggota
                    </button>
                </div>
            </form>
        </div>
    </main>
@endsection
