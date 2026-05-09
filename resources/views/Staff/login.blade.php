<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Admin - DPRD Tapanuli Selatan</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="h-screen w-full overflow-hidden font-sans">

    <div class="absolute inset-0 bg-[url('https://images.unsplash.com/photo-1596422846543-75c6ff1978f4?q=80&w=1920&auto=format&fit=crop')] bg-cover bg-center"></div>
    <div class="absolute inset-0 bg-[#3b82f6]/40 mix-blend-multiply"></div>
    <div class="absolute inset-0 bg-gradient-to-b from-[#1e3a8a]/80 via-[#1e3a8a]/50 to-[#0f172a]/90"></div>

    <div class="relative z-10 flex flex-col items-center justify-center h-full px-4">
        
        <div class="text-center mb-8 animate-fade-in-down">
            <div class="w-20 h-24 mx-auto items-center justify-center">
                <img src="{{ asset('images/logo.png') }}" alt="Logo">
            </div>
            <h1 class="text-3xl md:text-4xl font-bold text-white drop-shadow-lg mb-1">DPRD Tapanuli Selatan</h1>
            <p class="text-blue-200 font-medium tracking-wide">Sistem Manajemen Konten</p>
        </div>

        <div class="w-full max-w-md backdrop-blur-md bg-white/10 border border-white/20 rounded-3xl p-8 shadow-[0_8px_32px_0_rgba(0,0,0,0.37)]">
            <form action="{{ route('staff.login.process') }}" method="POST">
                @csrf
                
                @if(session('error'))
                <div class="bg-red-500/80 text-white text-sm p-3 rounded-xl mb-4 text-center backdrop-blur-sm border border-red-400">
                    <i class="fa-solid fa-circle-exclamation mr-1"></i> {{ session('error') }}
                </div>
                @endif

                <div class="mb-5">
                    <label class="block text-white text-sm font-bold mb-2">Username</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-white/70">
                            <i class="fa-regular fa-user"></i>
                        </div>
                        <input type="text" name="username" placeholder="Masukkan username" required
                            class="w-full bg-white/20 border border-white/30 text-white placeholder-white/60 rounded-xl pl-11 pr-4 py-3.5 focus:outline-none focus:ring-2 focus:ring-white/50 focus:bg-white/30 transition backdrop-blur-sm">
                    </div>
                </div>

                <div class="mb-8">
                    <label class="block text-white text-sm font-bold mb-2">Password</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-white/70">
                            <i class="fa-solid fa-lock"></i>
                        </div>
                        <input type="password" name="password" placeholder="Masukkan password" required
                            class="w-full bg-white/20 border border-white/30 text-white placeholder-white/60 rounded-xl pl-11 pr-10 py-3.5 focus:outline-none focus:ring-2 focus:ring-white/50 focus:bg-white/30 transition backdrop-blur-sm">
                        <div class="absolute inset-y-0 right-0 pr-4 flex items-center cursor-pointer text-white/70 hover:text-white transition">
                            <i class="fa-regular fa-eye"></i>
                        </div>
                    </div>
                </div>

                <button type="submit" class="w-full bg-blue-600 hover:bg-blue-500 text-white font-bold py-3.5 rounded-xl transition duration-300 shadow-lg shadow-blue-900/50 flex items-center justify-center gap-2">
                    <i class="fa-solid fa-right-to-bracket"></i> Masuk ke Dashboard
                </button>
            </form>

            <div class="mt-6 text-center border-t border-white/20 pt-4">
                <p class="text-xs text-white/60">Hanya untuk staf sekretariat resmi DPRD Tapanuli Selatan</p>
            </div>
        </div>

        <div class="absolute bottom-6 text-center w-full">
            <p class="text-xs text-white/50">© 2026 DPRD Kabupaten Tapanuli Selatan. All rights reserved.</p>
        </div>
    </div>

</body>
</html>