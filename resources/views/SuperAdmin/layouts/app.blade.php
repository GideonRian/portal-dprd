<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') - Panel Keamanan DPRD</title>
    
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <style>
        body {
            background-color: #f4f7fe;
        }
    </style>
</head>
<body class="font-sans antialiased text-gray-900 flex flex-col min-h-screen">

    <nav class="bg-red-800 text-white shadow-lg sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-16">
                
                <div class="flex items-center gap-3">
                    <div class="bg-white p-1 rounded-full">
                        <img src="{{ asset('images/logo.png') }}" alt="Logo" class="h-8 w-8 object-contain">
                    </div>
                    <div>
                        <h1 class="text-lg font-bold leading-tight">SuperAdmin</h1>
                        <p class="text-xs text-red-200">Tim IT DPRD</p>
                    </div>
                </div>

                <div class="hidden md:flex items-center space-x-1">
                    
                    <a href="{{ route('superadmin.dashboard') }}" 
                    class="{{ request()->routeIs('superadmin.dashboard') ? 'bg-red-900 text-white font-bold border border-red-700 shadow-sm' : 'text-red-100 hover:bg-red-700 font-medium border border-transparent' }} px-3 py-2 rounded-md text-sm flex items-center gap-2 transition">
                        <i class="fa-solid fa-shield-halved"></i> Dashboard
                    </a>

                    <a href="{{ route('superadmin.users.index') }}" 
                    class="{{ request()->routeIs('superadmin.users.*') ? 'bg-red-900 text-white font-bold border border-red-700 shadow-sm' : 'text-red-100 hover:bg-red-700 font-medium border border-transparent' }} px-3 py-2 rounded-md text-sm flex items-center gap-2 transition">
                        <i class="fa-solid fa-users"></i> Users
                    </a>

                    <a href="#" 
                    class="text-red-100 hover:bg-red-700 font-medium px-3 py-2 rounded-md text-sm flex items-center gap-2 transition border border-transparent">
                        <i class="fa-solid fa-lock"></i> 2FA
                    </a>
                    
                    <div class="relative inline-block text-left">
                        <button id="moreDropdownButton" class="hover:bg-red-700 text-red-100 px-3 py-2 rounded-md text-sm font-medium flex items-center gap-2 focus:outline-none transition border border-transparent">
                            <i class="fa-solid fa-ellipsis-v"></i> More
                            <i id="moreDropdownIcon" class="fa-solid fa-chevron-down text-[10px] transition-transform duration-200"></i>
                        </button>

                        <div id="moreDropdownMenu" class="hidden absolute right-0 mt-2 w-48 bg-white rounded-xl shadow-xl border border-gray-100 overflow-hidden z-50 origin-top-right transition-all duration-200 opacity-0 scale-95">
                            <div class="py-1">
                                <a href="#" class="flex items-center gap-3 px-4 py-2 text-sm text-gray-700 hover:bg-red-50 hover:text-red-700 transition">
                                    <i class="fa-solid fa-gear w-5 text-center text-gray-400"></i> Pengaturan Sistem
                                </a>
                                <a href="#" class="flex items-center gap-3 px-4 py-2 text-sm text-gray-700 hover:bg-red-50 hover:text-red-700 transition">
                                    <i class="fa-solid fa-database w-5 text-center text-gray-400"></i> Backup Data
                                </a>
                                <a href="#" class="flex items-center gap-3 px-4 py-2 text-sm text-gray-700 hover:bg-red-50 hover:text-red-700 transition">
                                    <i class="fa-solid fa-shield-virus w-5 text-center text-gray-400"></i> Audit Log
                                </a>
                            </div>
                        </div>
                    </div>

                    <form action="{{ route('staff.logout') }}" method="POST" class="inline">
                        @csrf
                        <button type="submit" class="hover:bg-red-700 text-red-100 px-3 py-2 rounded-md text-sm font-medium flex items-center gap-2 border border-transparent hover:border-red-500 transition">
                            <i class="fa-solid fa-arrow-right-from-bracket"></i> Logout
                        </button>
                    </form>

                </div>
            </div>
        </div>
    </nav>

    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8 flex-grow w-full">
        @yield('content')
    </main>

    <footer class="py-6 text-center text-gray-400 text-xs border-t border-gray-200 bg-white mt-auto">
        &copy; {{ date('Y') }} DPRD Kabupaten Tapanuli Selatan. All rights reserved.
    </footer>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const moreBtn = document.getElementById('moreDropdownButton');
            const moreMenu = document.getElementById('moreDropdownMenu');
            const moreIcon = document.getElementById('moreDropdownIcon');

            if (moreBtn && moreMenu && moreIcon) {
                moreBtn.addEventListener('click', e => {
                    e.stopPropagation();
                    const isHidden = moreMenu.classList.contains('hidden');

                    if (isHidden) {
                        moreMenu.classList.remove('hidden');
                        setTimeout(() => {
                            moreMenu.classList.remove('opacity-0', 'scale-95');
                            moreIcon.classList.add('rotate-180');
                        }, 10);
                    } else {
                        closeMoreDropdown();
                    }
                });

                function closeMoreDropdown() {
                    moreMenu.classList.add('opacity-0', 'scale-95');
                    moreIcon.classList.remove('rotate-180');
                    setTimeout(() => {
                        moreMenu.classList.add('hidden');
                    }, 200);
                }

                window.addEventListener('click', e => {
                    if (!moreBtn.contains(e.target) && !moreMenu.contains(e.target)) {
                        closeMoreDropdown();
                    }
                });
            }
        });
    </script>
</body>
</html>