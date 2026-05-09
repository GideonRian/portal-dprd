<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - DPRD Tapanuli Selatan</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body { background-color: #f4f7fe; }
        .gradient-blue { background: linear-gradient(135deg, #3b82f6 0%, #2563eb 100%); }
        .gradient-purple { background: linear-gradient(135deg, #a855f7 0%, #9333ea 100%); }
        .gradient-green { background: linear-gradient(135deg, #10b981 0%, #059669 100%); }
        .gradient-red { background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%); }
        .gradient-orange { background: linear-gradient(135deg, #f97316 0%, #ea580c 100%); }
        .animate-fade-in-down { animation: fadeInDown 0.5s ease-out; }
        @keyframes fadeInDown {
            0% { opacity: 0; transform: translateY(-10px); }
            100% { opacity: 1; transform: translateY(0); }
        }
    </style>
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
                    <a href="#" class="bg-white text-[#1e1b4b] px-4 py-2 rounded-lg font-bold text-sm flex items-center gap-2"><i class="fa-solid fa-shield-halved"></i> Dashboard</a>
                    <a href="{{ route('staff.anggota.index') }}" class="text-gray-300 hover:bg-white/10 px-4 py-2 rounded-lg font-medium text-sm flex items-center gap-2 transition"><i class="fa-solid fa-users"></i> Anggota</a>
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
                                <a href="#" class="flex items-center gap-3 px-4 py-2.5 text-sm text-gray-700 hover:bg-gray-100 transition">
                                    <i class="fa-solid fa-key text-gray-400 w-4 text-center"></i> Ganti Password
                                </a>
                                <hr class="border-gray-100 my-1">
                                <form method="POST" action="#">
                                    @csrf
                                    <button type="submit" class="w-full text-left flex items-center gap-3 px-4 py-2.5 text-sm font-medium text-red-600 hover:bg-red-50 transition">
                                        <i class="fa-solid fa-arrow-right-from-bracket w-4 text-center"></i> Logout
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                    <a href="{{ route('layanan.aspirasi') }}" target="_blank" class="bg-blue-600 hover:bg-blue-500 px-4 py-2 rounded-lg font-bold text-sm transition shadow-md">
                        Website
                    </a>
                </div>
            </div>
        </div>
    </nav>

    <main class="w-full px-4 sm:px-6 lg:px-8 py-8 max-w-screen-2xl mx-auto">
        <div class="flex items-center gap-4 mb-8">
            <img src="{{ asset('images/logo.png') }}" alt="Logo" class="h-20 w-auto object-contain drop-shadow-lg">
            <div>
                <h2 class="text-3xl font-extrabold text-gray-900 mb-1">Admin Dashboard</h2>
                <p class="text-gray-600 font-medium">DPRD Tapanuli Selatan - Content Management System</p>
            </div>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-5 gap-6 mb-8">
            <div class="gradient-blue rounded-2xl p-6 text-white shadow-lg transform hover:-translate-y-1 transition duration-300">
                <div class="flex justify-between items-start">
                    <i class="fa-solid fa-users text-3xl opacity-80"></i>
                    <h3 class="text-4xl font-black">85</h3>
                </div>
                <p class="mt-4 font-bold text-sm">Total Anggota</p>
            </div>
            <div class="gradient-purple rounded-2xl p-6 text-white shadow-lg transform hover:-translate-y-1 transition duration-300">
                <div class="flex justify-between items-start">
                    <i class="fa-regular fa-newspaper text-3xl opacity-80"></i>
                    <h3 class="text-4xl font-black">142</h3>
                </div>
                <p class="mt-4 font-bold text-sm">Total Berita</p>
            </div>
            <div class="gradient-green rounded-2xl p-6 text-white shadow-lg transform hover:-translate-y-1 transition duration-300">
                <div class="flex justify-between items-start">
                    <i class="fa-regular fa-message text-3xl opacity-80"></i>
                    <h3 class="text-4xl font-black">67</h3>
                </div>
                <p class="mt-4 font-bold text-sm">Aspirasi Masuk</p>
            </div>
            <div class="gradient-red rounded-2xl p-6 text-white shadow-lg transform hover:-translate-y-1 transition duration-300">
                <div class="flex justify-between items-start">
                    <i class="fa-regular fa-file-lines text-3xl opacity-80"></i>
                    <h3 class="text-4xl font-black">48</h3>
                </div>
                <p class="mt-4 font-bold text-sm">Total Dokumen</p>
            </div>
            <div class="gradient-orange rounded-2xl p-6 text-white shadow-lg transform hover:-translate-y-1 transition duration-300">
                <div class="flex justify-between items-start">
                    <i class="fa-regular fa-calendar text-3xl opacity-80"></i>
                    <h3 class="text-4xl font-black">35</h3>
                </div>
                <p class="mt-4 font-bold text-sm">Agenda Kegiatan</p>
            </div>
        </div>

        <div class="bg-white rounded-3xl p-8 shadow-sm border border-gray-100">
            <h3 class="text-xl font-bold text-gray-900 mb-6">Quick Actions</h3>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-5 gap-4">
                
                <a href="{{ route('staff.anggota.create') }}" class="flex flex-col items-center justify-center p-4 rounded-xl border-2 border-blue-500 bg-blue-600 text-white font-bold text-sm hover:bg-blue-700 transition shadow-md gap-2">
                    <i class="fa-solid fa-user-plus"></i> Tambah Anggota Baru
                </a>
                
                <button class="flex flex-col items-center justify-center p-4 rounded-xl border-2 border-purple-500 bg-purple-600 text-white font-bold text-sm hover:bg-purple-700 transition shadow-md gap-2">
                    <i class="fa-regular fa-pen-to-square"></i> Buat Berita Baru
                </button>
                <button class="flex flex-col items-center justify-center p-4 rounded-xl border-2 border-green-500 bg-green-600 text-white font-bold text-sm hover:bg-green-700 transition shadow-md gap-2">
                    <i class="fa-regular fa-comments"></i> Kelola Aspirasi
                </button>
                <button class="flex flex-col items-center justify-center p-4 rounded-xl border-2 border-red-500 bg-red-600 text-white font-bold text-sm hover:bg-red-700 transition shadow-md gap-2">
                    <i class="fa-solid fa-folder-open"></i> Kelola Dokumen
                </button>
                <button class="flex flex-col items-center justify-center p-4 rounded-xl border-2 border-orange-500 bg-orange-600 text-white font-bold text-sm hover:bg-orange-700 transition shadow-md gap-2">
                    <i class="fa-regular fa-calendar-plus"></i> Tambah Agenda Baru
                </button>
            </div>
        </div>
    </main>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const profileButton = document.getElementById('profileButton');
            const profileDropdown = document.getElementById('profileDropdown');
            const profileIcon = document.getElementById('profileIcon');

            function closeDropdown() {
                if (!profileDropdown.classList.contains('hidden')) {
                    profileDropdown.classList.remove('opacity-100', 'scale-100');
                    profileDropdown.classList.add('opacity-0', 'scale-95');
                    profileIcon.classList.remove('rotate-180');
                    setTimeout(() => {
                        profileDropdown.classList.add('hidden');
                    }, 200);
                }
            }

            profileButton.addEventListener('click', function(event) {
                event.stopPropagation();
                if (profileDropdown.classList.contains('hidden')) {
                    profileDropdown.classList.remove('hidden');
                    setTimeout(() => {
                        profileDropdown.classList.remove('opacity-0', 'scale-95');
                        profileDropdown.classList.add('opacity-100', 'scale-100');
                        profileIcon.classList.add('rotate-180');
                    }, 10);
                } else {
                    closeDropdown();
                }
            });

            window.addEventListener('click', function(event) {
                if (!profileButton.contains(event.target) && !profileDropdown.contains(event.target)) {
                    closeDropdown();
                }
            });
        });
    </script>
</body>
</html>