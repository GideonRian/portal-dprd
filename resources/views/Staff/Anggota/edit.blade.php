<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Anggota - DPRD Tapanuli Selatan</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body {
            background-color: #f4f7fe;
        }
    </style>
</head>

<body class="font-sans antialiased text-gray-900">

    <nav class="bg-[#1e1b4b] text-white shadow-lg sticky top-0 z-50">
        <div class="w-full px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-16">
                <div class="flex items-center gap-3">
                    <img src="{{ asset('images/logo.png') }}" alt="Logo"
                        class="h-10 w-auto object-contain drop-shadow-md">
                    <div>
                        <h1 class="font-bold text-sm leading-tight">Admin DPRD</h1>
                        <p class="text-[10px] text-gray-400">Tapanuli Selatan</p>
                    </div>
                </div>

                <div class="hidden md:flex items-center space-x-1">
                    <a href="{{ route('staff.dashboard') }}"
                        class="text-gray-300 hover:bg-white/10 px-4 py-2 rounded-lg font-medium text-sm flex items-center gap-2 transition"><i
                            class="fa-solid fa-shield-halved"></i> Dashboard</a>
                    <a href="{{ route('staff.anggota.index') }}"
                        class="bg-white text-[#1e1b4b] px-4 py-2 rounded-lg font-bold text-sm flex items-center gap-2"><i
                            class="fa-solid fa-users"></i> Anggota</a>
                    <a href="#"
                        class="text-gray-300 hover:bg-white/10 px-4 py-2 rounded-lg font-medium text-sm flex items-center gap-2 transition"><i
                            class="fa-regular fa-newspaper"></i> Berita</a>
                    <a href="#"
                        class="text-gray-300 hover:bg-white/10 px-4 py-2 rounded-lg font-medium text-sm flex items-center gap-2 transition"><i
                            class="fa-regular fa-message"></i> Aspirasi</a>
                    <a href="#"
                        class="text-gray-300 hover:bg-white/10 px-4 py-2 rounded-lg font-medium text-sm flex items-center gap-2 transition"><i
                            class="fa-regular fa-file-lines"></i> Dokumen</a>
                    <a href="#"
                        class="text-gray-300 hover:bg-white/10 px-4 py-2 rounded-lg font-medium text-sm flex items-center gap-2 transition"><i
                            class="fa-regular fa-calendar"></i> Agenda</a>
                </div>

                <div class="flex items-center gap-4">
                    <a href="{{ route('layanan.aspirasi') }}" target="_blank"
                        class="bg-blue-600 hover:bg-blue-500 px-4 py-2 rounded-lg font-bold text-sm transition shadow-md">Website</a>
                </div>
            </div>
        </div>
    </nav>

    <main class="w-full px-4 sm:px-6 lg:px-8 py-8 max-w-3xl mx-auto">
        <a href="{{ route('staff.anggota.index') }}"
            class="inline-flex items-center text-blue-600 font-bold hover:underline mb-6 text-sm">
            <i class="fa-solid fa-arrow-left mr-2"></i> Kembali ke Daftar Anggota
        </a>

        <div class="flex items-center gap-4 mb-8">
            <div class="w-14 h-14 bg-blue-600 rounded-2xl flex items-center justify-center text-white shadow-md">
                <i class="fa-solid fa-user-pen text-xl"></i>
            </div>
            <div>
                <h2 class="text-3xl font-extrabold text-gray-900 mb-1">Edit Anggota DPRD</h2>
                <p class="text-gray-500 font-medium text-sm">Perbarui data anggota</p>
            </div>
        </div>

        <div class="bg-white rounded-3xl shadow-sm border border-gray-100 p-8">
            <form action="{{ route('staff.anggota.update', $anggota->id) }}" method="POST"
                enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="mb-6">
                    <label class="block text-sm font-bold text-gray-700 mb-2">Foto Profil <span
                            class="text-gray-400 font-normal">(Opsional)</span></label>
                    <input type="file" name="foto" accept="image/*"
                        class="w-full border border-gray-300 rounded-xl px-4 py-3 text-sm focus:ring-2 focus:ring-blue-500 outline-none transition">
                    <p class="text-xs text-gray-400 mt-2">Biarkan kosong jika tidak ingin mengubah foto. Maksimal 2MB.
                    </p>
                </div>

                <div class="mb-6">
                    <label class="block text-sm font-bold text-gray-700 mb-2">Nama Lengkap <span
                            class="text-red-500">*</span></label>
                    <input type="text" name="nama" value="{{ $anggota->nama }}" required
                        class="w-full border border-gray-300 rounded-xl px-4 py-3 focus:ring-2 focus:ring-blue-500 outline-none transition">
                </div>

                <div class="mb-6">
                    <label class="block text-sm font-bold text-gray-700 mb-2">Jabatan <span
                            class="text-red-500">*</span></label>
                    <input type="text" name="jabatan" value="{{ $anggota->jabatan }}" required
                        class="w-full border border-gray-300 rounded-xl px-4 py-3 focus:ring-2 focus:ring-blue-500 outline-none transition">
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-2">Partai/Fraksi <span
                                class="text-red-500">*</span></label>
                        <input type="text" name="partai" value="{{ $anggota->partai }}" required
                            class="w-full border border-gray-300 rounded-xl px-4 py-3 focus:ring-2 focus:ring-blue-500 outline-none transition">
                    </div>
                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-2">Komisi <span
                                class="text-red-500">*</span></label>
                        <input type="text" name="komisi" value="{{ $anggota->komisi }}" required
                            class="w-full border border-gray-300 rounded-xl px-4 py-3 focus:ring-2 focus:ring-blue-500 outline-none transition">
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-2">Daerah Pemilihan <span
                                class="text-red-500">*</span></label>
                        <input type="text" name="dapil" value="{{ $anggota->dapil }}" required
                            class="w-full border border-gray-300 rounded-xl px-4 py-3 focus:ring-2 focus:ring-blue-500 outline-none transition">
                    </div>
                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-2">Badan Dewan <span
                                class="text-gray-400 font-normal">(Opsional)</span></label>
                        <div class="relative">
                            <select name="badan"
                                class="w-full border border-gray-300 rounded-xl px-4 py-3 focus:ring-2 focus:ring-blue-500 outline-none transition appearance-none bg-white">
                                <option value="" {{ empty($anggota->badan) ? 'selected' : '' }}>-- Kosongkan /
                                    Tidak Ada --</option>
                                <option value="Badan Anggaran (Banggar)"
                                    {{ $anggota->badan == 'Badan Anggaran (Banggar)' ? 'selected' : '' }}>Badan
                                    Anggaran (Banggar)</option>
                                <option value="Badan Musyawarah (Banmus)"
                                    {{ $anggota->badan == 'Badan Musyawarah (Banmus)' ? 'selected' : '' }}>Badan
                                    Musyawarah (Banmus)</option>
                                <option value="Badan Pembentukan Peraturan Daerah (Bapemperda)"
                                    {{ $anggota->badan == 'Badan Pembentukan Peraturan Daerah (Bapemperda)' ? 'selected' : '' }}>
                                    Badan Pembentukan Peraturan Daerah (Bapemperda)</option>
                                <option value="Badan Kehormatan (BK)"
                                    {{ $anggota->badan == 'Badan Kehormatan (BK)' ? 'selected' : '' }}>Badan Kehormatan
                                    (BK)</option>
                            </select>
                            <i
                                class="fa-solid fa-chevron-down absolute right-4 top-1/2 -translate-y-1/2 text-gray-400 pointer-events-none"></i>
                        </div>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-2">Nomor Telepon</label>
                        <input type="text" name="telepon" value="{{ $anggota->telepon }}"
                            class="w-full border border-gray-300 rounded-xl px-4 py-3 focus:ring-2 focus:ring-blue-500 outline-none transition">
                    </div>
                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-2">Email</label>
                        <input type="email" name="email" value="{{ $anggota->email }}"
                            class="w-full border border-gray-300 rounded-xl px-4 py-3 focus:ring-2 focus:ring-blue-500 outline-none transition">
                    </div>
                </div>

                <div class="flex gap-4 pt-6 border-t border-gray-100">
                    <a href="{{ route('staff.anggota.index') }}"
                        class="w-1/3 text-center px-6 py-3.5 bg-gray-100 text-gray-700 font-bold rounded-xl hover:bg-gray-200 transition">Batal</a>
                    <button type="submit"
                        class="w-2/3 px-6 py-3.5 bg-blue-600 text-white font-bold rounded-xl hover:bg-blue-700 transition shadow-md flex justify-center items-center gap-2">
                        <i class="fa-regular fa-floppy-disk"></i> Simpan Perubahan
                    </button>
                </div>
            </form>
        </div>
    </main>

</body>

</html>
