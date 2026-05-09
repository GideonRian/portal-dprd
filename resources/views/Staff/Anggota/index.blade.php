<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Anggota - DPRD Tapanuli Selatan</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>body { background-color: #f4f7fe; }</style>
</head>
<body class="font-sans antialiased text-gray-900">

    <nav class="bg-[#1e1b4b] text-white shadow-lg sticky top-0 z-50">
        <div class="w-full px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-16">
                <div class="flex items-center gap-3">
                    <img src="{{ asset('images/logo.png') }}" alt="Logo" class="h-10 w-auto object-contain drop-shadow-md">
                    <div>
                        <h1 class="font-bold text-sm leading-tight">Admin DPRD</h1>
                        <p class="text-[10px] text-gray-400">Tapanuli Selatan</p>
                    </div>
                </div>

                <div class="hidden md:flex items-center space-x-1">
                    <a href="{{ route('staff.dashboard') }}" class="text-gray-300 hover:bg-white/10 px-4 py-2 rounded-lg font-medium text-sm flex items-center gap-2 transition"><i class="fa-solid fa-shield-halved"></i> Dashboard</a>
                    <a href="{{ route('staff.anggota.index') }}" class="bg-white text-[#1e1b4b] px-4 py-2 rounded-lg font-bold text-sm flex items-center gap-2"><i class="fa-solid fa-users"></i> Anggota</a>
                    <a href="#" class="text-gray-300 hover:bg-white/10 px-4 py-2 rounded-lg font-medium text-sm flex items-center gap-2 transition"><i class="fa-regular fa-newspaper"></i> Berita</a>
                    <a href="#" class="text-gray-300 hover:bg-white/10 px-4 py-2 rounded-lg font-medium text-sm flex items-center gap-2 transition"><i class="fa-regular fa-message"></i> Aspirasi</a>
                    <a href="#" class="text-gray-300 hover:bg-white/10 px-4 py-2 rounded-lg font-medium text-sm flex items-center gap-2 transition"><i class="fa-regular fa-file-lines"></i> Dokumen</a>
                    <a href="#" class="text-gray-300 hover:bg-white/10 px-4 py-2 rounded-lg font-medium text-sm flex items-center gap-2 transition"><i class="fa-regular fa-calendar"></i> Agenda</a>
                </div>

                <div class="flex items-center gap-4">
                    <div class="relative">
                        <button id="profileButton" class="flex items-center gap-1.5 cursor-pointer hover:bg-white/10 px-3 py-1.5 rounded-lg transition border border-white/20 focus:outline-none focus:bg-white/10">
                            <i class="fa-regular fa-user text-sm"></i>
                            <span class="text-sm font-medium">Staf Admin</span>
                            <i class="fa-solid fa-chevron-down text-xs transition-transform duration-200" id="profileIcon"></i>
                        </button>
                        <div id="profileDropdown" class="hidden absolute right-0 mt-3 w-56 bg-white rounded-xl shadow-xl border border-gray-100 overflow-hidden transform opacity-0 scale-95 transition-all duration-200 z-50 origin-top-right">
                            <div class="px-4 py-3 bg-gray-50 border-b border-gray-100">
                                <p class="text-sm font-bold text-gray-900">Staf Admin</p>
                                <p class="text-xs text-gray-500 truncate">Staf Sekretariat DPRD</p>
                            </div>
                            <div class="py-1">
                                <a href="#" class="flex items-center gap-3 px-4 py-2.5 text-sm text-gray-700 hover:bg-gray-100 transition"><i class="fa-solid fa-key text-gray-400 w-4 text-center"></i> Ganti Password</a>
                                <hr class="border-gray-100 my-1">
                                <a href="#" class="flex items-center gap-3 px-4 py-2.5 text-sm font-medium text-red-600 hover:bg-red-50 transition"><i class="fa-solid fa-arrow-right-from-bracket w-4 text-center"></i> Logout</a>
                            </div>
                        </div>
                    </div>
                    <a href="{{ route('layanan.aspirasi') }}" target="_blank" class="bg-blue-600 hover:bg-blue-500 px-4 py-2 rounded-lg font-bold text-sm transition shadow-md">Website</a>
                </div>
            </div>
        </div>
    </nav>

    <main class="w-full px-4 sm:px-6 lg:px-8 py-8 max-w-screen-2xl mx-auto">
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 mb-8">
            <div class="flex items-center gap-4">
                <div class="w-16 h-16 bg-blue-600 rounded-2xl flex items-center justify-center text-white shadow-md">
                    <i class="fa-solid fa-users text-2xl"></i>
                </div>
                <div>
                    <h2 class="text-3xl font-extrabold text-gray-900 mb-1">Kelola Anggota DPRD</h2>
                    <p class="text-gray-500 font-medium text-sm">Tambah, edit, atau hapus data anggota</p>
                </div>
            </div>
            <a href="{{ route('staff.anggota.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-xl font-bold transition shadow-md flex items-center gap-2">
                <i class="fa-solid fa-plus"></i> Tambah Anggota
            </a>
        </div>

        @if(session('success'))
            <div class="bg-green-100 border-l-4 border-green-500 text-green-700 px-4 py-3 rounded-xl mb-6 shadow-sm">
                <i class="fa-solid fa-check-circle mr-1"></i> {{ session('success') }}
            </div>
        @endif

        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-4 mb-6">
            <form action="{{ route('staff.anggota.index') }}" method="GET" class="relative">
                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-gray-400">
                    <i class="fa-solid fa-magnifying-glass"></i>
                </div>
                <input type="text" name="search" value="{{ $search ?? '' }}" placeholder="Cari nama anggota, jabatan, atau partai..." 
                       class="w-full pl-11 pr-4 py-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-blue-500 outline-none transition text-sm">
            </form>
        </div>

        <div class="bg-white rounded-3xl shadow-sm border border-gray-100 overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-gray-50 border-b border-gray-100 text-sm">
                            <th class="p-4 font-bold text-gray-900">Foto</th>
                            <th class="p-4 font-bold text-gray-900">Nama</th>
                            <th class="p-4 font-bold text-gray-900">Jabatan</th>
                            <th class="p-4 font-bold text-gray-900">Partai</th>
                            <th class="p-4 font-bold text-gray-900">Komisi</th>
                            <th class="p-4 font-bold text-gray-900">Dapil</th>
                            <th class="p-4 font-bold text-gray-900 text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @forelse($anggotas ?? [] as $anggota)
                        <tr class="hover:bg-gray-50 transition">
                            <td class="p-4">
                                <img src="{{ $anggota->foto ? asset('storage/'.$anggota->foto) : 'https://ui-avatars.com/api/?name='.urlencode($anggota->nama).'&background=random' }}" class="w-12 h-12 rounded-full object-cover border border-gray-200">
                            </td>
                            <td class="p-4">
                                <p class="font-bold text-gray-900">{{ $anggota->nama }}</p>
                                <p class="text-xs text-gray-500">{{ $anggota->email ?? '-' }}</p>
                            </td>
                            <td class="p-4 text-gray-700 text-sm">{{ $anggota->jabatan }}</td>
                            <td class="p-4 text-gray-700 text-sm">{{ $anggota->partai }}</td>
                            <td class="p-4">
                                <span class="bg-blue-50 text-blue-600 px-3 py-1 rounded-full text-xs font-bold">{{ $anggota->komisi }}</span>
                            </td>
                            <td class="p-4 text-gray-700 text-sm">{{ $anggota->dapil }}</td>
                            <td class="p-4 text-center space-x-2">
                                <a href="{{ route('staff.anggota.edit', $anggota->id) }}" class="inline-flex w-8 h-8 items-center justify-center bg-blue-50 text-blue-600 rounded-lg hover:bg-blue-600 hover:text-white transition">
                                    <i class="fa-regular fa-pen-to-square"></i>
                                </a>
                                <form action="{{ route('staff.anggota.destroy', $anggota->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Yakin ingin menghapus data ini?')">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="inline-flex w-8 h-8 items-center justify-center bg-red-50 text-red-600 rounded-lg hover:bg-red-600 hover:text-white transition">
                                        <i class="fa-regular fa-trash-can"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr><td colspan="7" class="p-8 text-center text-gray-500">Tidak ada data anggota ditemukan.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </main>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const btn = document.getElementById('profileButton');
            const menu = document.getElementById('profileDropdown');
            const icon = document.getElementById('profileIcon');
            btn.addEventListener('click', e => { e.stopPropagation(); menu.classList.toggle('hidden'); setTimeout(() => { menu.classList.toggle('opacity-0'); menu.classList.toggle('scale-95'); icon.classList.toggle('rotate-180'); }, 10); });
            window.addEventListener('click', e => { if (!btn.contains(e.target)) { menu.classList.add('hidden', 'opacity-0', 'scale-95'); icon.classList.remove('rotate-180'); } });
        });
    </script>
</body>
</html>