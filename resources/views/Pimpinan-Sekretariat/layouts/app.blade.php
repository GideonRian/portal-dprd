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

                    <a href="{{ route('sekretaris.dashboard') }}"
                        class="{{ request()->routeIs('sekretaris.dashboard') ? 'bg-white text-purple-800 font-bold shadow-sm' : 'border border-purple-500 hover:bg-purple-700 text-white font-medium' }} px-3 py-1.5 rounded-lg text-sm flex items-center gap-2 transition">
                        <i
                            class="fa-regular fa-life-ring {{ request()->routeIs('sekretaris.dashboard') ? 'text-purple-600' : '' }}"></i>
                        Dashboard
                    </a>

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

                    <a href="{{ route('sekretaris.reports') }}"
                        class="{{ request()->routeIs('sekretaris.reports') ? 'bg-white text-purple-800 font-bold shadow-sm' : 'border border-purple-500 hover:bg-purple-700 text-white font-medium' }} px-3 py-1.5 rounded-lg text-sm flex items-center gap-2 transition">
                        <i
                            class="fa-regular fa-file-lines {{ request()->routeIs('sekretaris.reports') ? 'text-purple-600' : '' }}"></i>
                        Reports
                    </a>

                    <div x-data="{ open: false }" class="relative">
                        <button @click="open = !open" @click.away="open = false"
                            class="border border-purple-500 hover:bg-purple-700 px-3 py-1.5 rounded-lg font-medium text-sm text-white flex items-center gap-2 transition">
                            <i class="fa-regular fa-user"></i> 
                            {{ Auth::user()->nama ?? Auth::user()->username ?? 'Sekretariat' }} 
                            <i class="fa-solid fa-chevron-down text-xs"></i>
                        </button>

                        <div x-show="open" x-transition style="display: none;"
                            class="absolute right-0 mt-2 w-60 bg-white rounded-xl shadow-xl py-2 z-50 border border-gray-100 text-gray-800">
                            
                            <div class="px-4 py-3 border-b border-gray-100 mb-1">
                                <p class="text-sm font-bold truncate">
                                    {{ Auth::user()->nama ?? Auth::user()->username ?? 'Sekretaris' }}
                                </p>
                                <p class="text-xs text-gray-500 uppercase tracking-wider truncate">
                                    SEKRETARIS
                                </p>
                            </div>

                            @if(strtolower(Auth::user()->username ?? '') === 'superadmin' || strtolower(Auth::user()->role ?? '') === 'superadmin')
                                <a href="{{ url('/superadmin/dashboard') }}" class="block px-4 py-2 text-sm font-bold text-indigo-700 hover:bg-indigo-50 transition">
                                    <i class="fa-solid fa-arrow-left mr-2"></i> Kembali ke SuperAdmin
                                </a>
                                <div class="border-t border-gray-100 my-1"></div>
                            @elseif(strtolower(Auth::user()->role ?? '') === 'staff' || strtolower(Auth::user()->username ?? '') === 'admin_fraksi')
                                <a href="{{ url('/staff/dashboard') }}" class="block px-4 py-2 text-sm font-bold text-blue-700 hover:bg-blue-50 transition">
                                    <i class="fa-solid fa-arrow-left mr-2"></i> Kembali ke Panel Staff
                                </a>
                                <div class="border-t border-gray-100 my-1"></div>
                            @endif

                            <a href="{{ route('sekretaris.password.edit') }}"
                                class="block px-4 py-2 text-sm hover:bg-purple-50 hover:text-purple-700 transition">
                                <i class="fa-solid fa-key mr-2"></i> Ganti Password
                            </a>

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