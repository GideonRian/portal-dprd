<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SuperAdmin Login</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="min-h-screen flex items-center justify-center bg-gradient-to-br from-[#6b1414] to-[#3a0b0b] font-sans">

    <div class="bg-white rounded-[20px] shadow-2xl w-full max-w-[420px] p-8">
        
        <div class="flex flex-col items-center mb-8 text-center">
            <img src="{{ asset('images/logo.png') }}" alt="Logo Tapsel" class="h-16 w-auto mb-4 drop-shadow-sm">
            
            <h1 class="text-[22px] font-bold text-gray-900 mb-1">SuperAdmin Access</h1>
            <p class="text-[13px] text-gray-500">Autentikasi Keamanan Tingkat Tinggi</p>
        </div>

        <form action="{{ route('superadmin.login.submit') }}" method="POST" class="space-y-4">
            @csrf
            @if($errors->any())
                <div class="bg-red-50 border border-red-200 text-red-600 text-xs font-bold px-4 py-3 rounded-lg text-center">
                    {{ $errors->first() }}
                </div>
            @endif
            
            <div>
                <label class="block text-sm font-bold text-gray-700 mb-1.5">Username</label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none">
                        <i class="fa-regular fa-user text-gray-400 text-sm"></i>
                    </div>
                    <input type="text" name="username" placeholder="superadmin" class="w-full pl-10 pr-4 py-3 bg-[#f4f5f7] border border-gray-200 rounded-lg text-sm text-gray-800 focus:outline-none focus:ring-2 focus:ring-[#8b1c1c]/20 focus:border-[#8b1c1c] transition" required>
                </div>
            </div>

            <div>
                <label class="block text-sm font-bold text-gray-700 mb-1.5">Password</label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none">
                        <i class="fa-solid fa-lock text-gray-400 text-sm"></i>
                    </div>
                    <input type="password" name="password" placeholder="••••••••" class="w-full pl-10 pr-4 py-3 bg-[#f4f5f7] border border-gray-200 rounded-lg text-sm text-gray-800 focus:outline-none focus:ring-2 focus:ring-[#8b1c1c]/20 focus:border-[#8b1c1c] transition" required>
                </div>
            </div>

            <div class="pt-2">
                <button type="submit" class="w-full bg-[#8b1c1c] hover:bg-[#6b1414] text-white font-bold py-3.5 rounded-lg transition text-sm tracking-wide shadow-md">
                    MASUK
                </button>
            </div>
        </form>

    </div>

</body>
</html>