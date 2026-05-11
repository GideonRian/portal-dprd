<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') - Admin DPRD Tapsel</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="https://cdn.ckeditor.com/ckeditor5/39.0.1/classic/ckeditor.js"></script>
    <style>
        body {
            background-color: #f4f7fe;
        }

        .ck-editor__editable {
            min-height: 200px;
        }

        /* Transisi halus untuk dropdown */
        #profileDropdown.show {
            display: block;
            opacity: 1;
            transform: scale(100%);
        }
    </style>
</head>

<body class="font-sans antialiased text-gray-900 flex flex-col min-h-screen">

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
                        class="{{ request()->routeIs('staff.dashboard') ? 'bg-white text-[#1e1b4b] font-bold shadow-sm' : 'text-gray-300 hover:bg-white/10 font-medium' }} px-4 py-2 rounded-lg text-sm flex items-center gap-2 transition">
                        <i class="fa-solid fa-shield-halved"></i> Dashboard
                    </a>

                    <a href="{{ route('staff.anggota.index') }}"
                        class="{{ request()->routeIs('staff.anggota.*') ? 'bg-white text-[#1e1b4b] font-bold shadow-sm' : 'text-gray-300 hover:bg-white/10 font-medium' }} px-4 py-2 rounded-lg text-sm flex items-center gap-2 transition">
                        <i class="fa-solid fa-users"></i> Anggota
                    </a>

                    <a href="{{ route('staff.berita.index') }}"
                        class="{{ request()->routeIs('staff.berita.*') ? 'bg-white text-[#1e1b4b] font-bold shadow-sm' : 'text-gray-300 hover:bg-white/10 font-medium' }} px-4 py-2 rounded-lg text-sm flex items-center gap-2 transition">
                        <i class="fa-regular fa-newspaper"></i> Berita
                    </a>

                    {{-- PERUBAHAN DI SINI: Link Aspirasi sudah terhubung dan bisa menyala saat aktif --}}
                    <a href="{{ route('staff.aspirasi.index') }}"
                        class="{{ request()->routeIs('staff.aspirasi.*') ? 'bg-white text-[#1e1b4b] font-bold shadow-sm' : 'text-gray-300 hover:bg-white/10 font-medium' }} px-4 py-2 rounded-lg text-sm flex items-center gap-2 transition">
                        <i class="fa-regular fa-message"></i> Aspirasi
                    </a>

                    <a href="{{ route('staff.dokumen.index') }}"
                        class="{{ request()->routeIs('staff.dokumen.*') ? 'bg-white text-[#1e1b4b] font-bold shadow-sm' : 'text-gray-300 hover:bg-white/10 font-medium' }} px-4 py-2 rounded-lg text-sm flex items-center gap-2 transition">
                        <i class="fa-solid fa-file-lines"></i> Dokumen
                    </a>

                    <a href="{{ route('staff.agenda.index') }}"
                        class="{{ request()->routeIs('staff.agenda.*') ? 'bg-white text-[#1e1b4b] font-bold shadow-sm' : 'text-gray-300 hover:bg-white/10 font-medium' }} px-4 py-2 rounded-lg text-sm flex items-center gap-2 transition">
                        <i class="fa-regular fa-calendar"></i> Agenda
                    </a>
                </div>

                <div class="flex items-center gap-4">
                    <div class="relative">
                        <button id="profileButton"
                            class="flex items-center gap-2 cursor-pointer hover:bg-white/10 px-3 py-1.5 rounded-lg transition border border-white/20 focus:outline-none focus:bg-white/10">
                            <div
                                class="w-7 h-7 bg-blue-500 rounded-full flex items-center justify-center text-xs font-bold">
                                {{ strtoupper(substr(Auth::user()->nama ?? 'A', 0, 1)) }}
                            </div>
                            <span
                                class="text-sm font-medium hidden sm:inline">{{ Auth::user()->nama ?? 'Admin' }}</span>
                            <i class="fa-solid fa-chevron-down text-[10px] transition-transform duration-200"
                                id="profileIcon"></i>
                        </button>

                        <div id="profileDropdown"
                            class="hidden absolute right-0 mt-3 w-60 bg-white rounded-2xl shadow-2xl border border-gray-100 overflow-hidden z-50 origin-top-right transition-all duration-200 opacity-0 scale-95">

                            <div class="px-5 py-4 bg-gray-50/50 border-b border-gray-100">
                                <p class="text-sm font-black text-gray-900 leading-tight">
                                    {{ Auth::user()->nama ?? 'Administrator' }}</p>
                                <p class="text-[11px] text-gray-500 mt-0.5 font-medium uppercase tracking-wider">
                                    {{ Auth::user()->role ?? 'Staf Sekretariat' }}</p>
                            </div>

                            <div class="py-2">
                                <a href="{{ route('staff.password.edit') }}"
                                    class="flex items-center gap-3 px-5 py-2.5 text-sm font-bold text-gray-700 hover:bg-blue-50 hover:text-blue-600 transition group">
                                    <i
                                        class="fa-solid fa-key w-4 text-center text-gray-400 group-hover:text-blue-600"></i>
                                    Ganti Password
                                </a>

                                <div class="border-t border-gray-100 my-2"></div>

                                <form action="{{ route('staff.logout') }}" method="POST">
                                    @csrf
                                    <button type="submit"
                                        class="w-full flex items-center gap-3 px-5 py-2.5 text-sm font-bold text-red-600 hover:bg-red-50 transition">
                                        <i class="fa-solid fa-arrow-right-from-bracket w-4 text-center"></i>
                                        Logout
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>

                    <a href="{{ route('home') }}" target="_blank"
                        class="bg-blue-600 hover:bg-blue-500 px-4 py-2 rounded-lg font-bold text-sm transition shadow-md hidden sm:block">
                        Website
                    </a>
                </div>

            </div>
        </div>
    </nav>

    <main class="flex-grow">
        @yield('content')
    </main>

    <footer class="py-6 text-center text-gray-400 text-xs border-t border-gray-200 bg-white mt-auto">
        &copy; {{ date('Y') }} DPRD Kabupaten Tapanuli Selatan. All rights reserved.
    </footer>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const btn = document.getElementById('profileButton');
            const menu = document.getElementById('profileDropdown');
            const icon = document.getElementById('profileIcon');

            if (btn && menu && icon) {
                btn.addEventListener('click', e => {
                    e.stopPropagation();
                    const isHidden = menu.classList.contains('hidden');

                    if (isHidden) {
                        menu.classList.remove('hidden');
                        setTimeout(() => {
                            menu.classList.remove('opacity-0', 'scale-95');
                            icon.classList.add('rotate-180');
                        }, 10);
                    } else {
                        closeDropdown();
                    }
                });

                function closeDropdown() {
                    menu.classList.add('opacity-0', 'scale-95');
                    icon.classList.remove('rotate-180');
                    setTimeout(() => {
                        menu.classList.add('hidden');
                    }, 200);
                }

                window.addEventListener('click', e => {
                    if (!btn.contains(e.target) && !menu.contains(e.target)) {
                        closeDropdown();
                    }
                });
            }
        });
    </script>
</body>

</html>
