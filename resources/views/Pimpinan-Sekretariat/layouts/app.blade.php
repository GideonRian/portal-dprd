<!DOCTYPE html>
<html lang="ms">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Sekretariat Dashboard') - DPRD Tapanuli Selatan</title>

    <script src="https://cdn.tailwindcss.com"></script>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>

<body class="bg-gray-50 min-h-screen">

    <nav class="bg-purple-800 text-white shadow-md">
        <div class="max-w-screen-2xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-16">

                <div class="flex items-center gap-3">
                    <img src="{{ asset('images/logo.png') }}" alt="Logo"
                        class="h-10 w-auto bg-green-500 rounded-full p-1 border-2 border-green-600">
                    <div>
                        <h1 class="font-bold text-sm leading-tight">Sekretariat DPRD</h1>
                        <p class="text-[11px] text-purple-200">Tapanuli Selatan</p>
                    </div>
                </div>

                <div class="hidden md:flex items-center space-x-2">

                    <!-- Tombol Dashboard Dinamis -->
                    <a href="{{ route('sekretaris.dashboard') }}"
                        class="{{ request()->routeIs('sekretaris.dashboard') ? 'bg-white text-purple-800 font-bold shadow-sm' : 'border border-purple-500 hover:bg-purple-700 text-white font-medium' }} px-3 py-1.5 rounded-lg text-sm flex items-center gap-2 transition">
                        <i
                            class="fa-regular fa-life-ring {{ request()->routeIs('sekretaris.dashboard') ? 'text-purple-600' : '' }}"></i>
                        Dashboard
                    </a>

                    <!-- Tombol Activity Dinamis -->
                    <a href="{{ route('sekretaris.activity') }}"
                        class="{{ request()->routeIs('sekretaris.activity') ? 'bg-white text-purple-800 font-bold shadow-sm' : 'border border-purple-500 hover:bg-purple-700 text-white font-medium' }} px-3 py-1.5 rounded-lg text-sm flex items-center gap-2 transition">
                        <i
                            class="fa-solid fa-chart-line {{ request()->routeIs('sekretaris.activity') ? 'text-purple-600' : '' }}"></i>
                        Activity
                    </a>

                    <a href="{{ route('sekretaris.approval') }}"
                        class="{{ request()->routeIs('sekretaris.approval') ? 'bg-white text-purple-800 font-bold shadow-sm' : 'border border-purple-500 hover:bg-purple-700 text-white font-medium' }} px-3 py-1.5 rounded-lg text-sm flex items-center gap-2 transition">
                        <i
                            class="fa-regular fa-user {{ request()->routeIs('sekretaris.approval') ? 'text-purple-600' : '' }}"></i>
                        Approvals
                    </a>

                    <a href="{{ route('sekretaris.stats') }}"
                        class="{{ request()->routeIs('sekretaris.stats') ? 'bg-white text-purple-800 font-bold shadow-sm' : 'border border-purple-500 hover:bg-purple-700 text-white font-medium' }} px-3 py-1.5 rounded-lg text-sm flex items-center gap-2 transition">
                        <i
                            class="fa-solid fa-chart-bar {{ request()->routeIs('sekretaris.stats') ? 'text-purple-600' : '' }}"></i>
                        Stats
                    </a>

                    <a href="#"
                        class="border border-purple-500 hover:bg-purple-700 px-3 py-1.5 rounded-lg font-medium text-sm text-white flex items-center gap-2 transition">
                        <i class="fa-regular fa-file-lines"></i> Reports
                    </a>

                    <div x-data="{ open: false }" class="relative">
                        <button @click="open = !open" @click.away="open = false"
                            class="border border-purple-500 hover:bg-purple-700 px-3 py-1.5 rounded-lg font-medium text-sm text-white flex items-center gap-2 transition">
                            <i class="fa-regular fa-user"></i> Sekretariat <i
                                class="fa-solid fa-chevron-down text-xs"></i>
                        </button>

                        <div x-show="open" x-transition style="display: none;"
                            class="absolute right-0 mt-2 w-56 bg-white rounded-xl shadow-xl py-2 z-50 border border-gray-100 text-gray-800">
                            <div class="px-4 py-3 border-b border-gray-100 mb-1">
                                <p class="text-sm font-bold">Sekretariat</p>
                                <p class="text-xs text-gray-500">Admin 2 (Sekretariat)</p>
                            </div>

                            <a href="{{ route('sekretaris.password.edit') }}"
                                class="block px-4 py-2 text-sm hover:bg-purple-50 hover:text-purple-700 transition">
                                <i class="fa-solid fa-key mr-2"></i> Ganti Password
                            </a>

                            <!-- Ganti bagian form logout ini di dalam app.blade.php Anda -->
                            <form method="POST" action="{{ route('sekretaris.logout') }}">
                                @csrf
                                <button type="submit"
                                    class="w-full text-left px-4 py-2 text-sm text-red-600 hover:bg-red-50 transition">
                                    <i class="fa-solid fa-arrow-right-from-bracket mr-2"></i> Logout
                                </button>
                            </form>
                        </div>
                    </div>

                    <a href="{{ route('staff.dashboard') }}" target="_blank"
                        class="border border-purple-500 hover:bg-purple-700 px-3 py-1.5 rounded-lg font-medium text-sm text-white transition">
                        Admin Panel
                    </a>
                    <a href="{{ route('home') }}" target="_blank"
                        class="border border-purple-500 hover:bg-purple-700 px-3 py-1.5 rounded-lg font-medium text-sm text-white transition">
                        Website
                    </a>

                </div>

                <div class="md:hidden flex items-center">
                    <button class="text-white hover:text-purple-200 focus:outline-none">
                        <i class="fa-solid fa-bars text-2xl"></i>
                    </button>
                </div>

            </div>
        </div>
    </nav>

    <main>
        @yield('content')
    </main>

</body>

</html>
