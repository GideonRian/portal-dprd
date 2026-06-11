{{-- @extends('SuperAdmin.layouts.app')

@section('title', 'User Management')

@section('content')
<div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-8 gap-4">
    <div>
        <h1 class="text-3xl font-extrabold text-gray-900 tracking-tight mb-1">User Management</h1>
        <p class="text-gray-500 text-sm font-medium">Kelola akun Admin dan Sekretariat DPRD</p>
    </div>
    
    <button class="bg-red-800 hover:bg-red-900 text-white px-5 py-2.5 rounded-lg text-sm font-bold flex items-center gap-2 shadow-sm transition">
        <i class="fa-solid fa-user-plus"></i> Tambah User
    </button>
</div>

<div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
    
    <div class="mb-6">
        <h2 class="text-lg font-bold text-gray-800">Daftar Users</h2>
        <p class="text-xs text-gray-500">Total 2 user terdaftar</p>
    </div>

    <div class="border border-red-500 rounded-xl p-4 sm:p-6 space-y-6">
        
        <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4 pb-6 border-b border-gray-100">
            <div>
                <div class="flex items-center gap-3 mb-2">
                    <h3 class="text-base font-bold text-gray-900">admin_fraksi</h3>
                    <span class="bg-gray-900 text-white text-[10px] font-bold px-2 py-1 rounded-md flex items-center gap-1">
                        <i class="fa-solid fa-circle-check text-green-400"></i> Active
                    </span>
                    <span class="bg-gray-100 text-gray-600 border border-gray-200 text-[10px] font-bold px-2 py-1 rounded-md">
                        Admin
                    </span>
                </div>
                <div class="text-xs text-gray-500 space-y-1">
                    <p>Email: fraksi@dprd.go.id</p>
                    <p>Last Login: 2026-04-09 14:30</p>
                    <p>Created: 2026-01-15</p>
                </div>
            </div>

            <div class="flex items-center gap-3">
                <div class="flex items-center gap-2 mr-2">
                    <span class="text-xs font-bold text-gray-700">Aktif</span>
                    <label class="relative inline-flex items-center cursor-pointer">
                        <input type="checkbox" value="" class="sr-only peer" checked>
                        <div class="w-9 h-5 bg-gray-200 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-4 after:w-4 after:transition-all peer-checked:bg-gray-900"></div>
                    </label>
                </div>
                
                <button title="Reset Token/Password" class="p-2 border border-gray-200 rounded-lg text-gray-500 hover:text-yellow-600 hover:bg-yellow-50 hover:border-yellow-200 transition">
                    <i class="fa-solid fa-key w-4 h-4 text-center"></i>
                </button>
                <button title="Edit User" class="p-2 border border-gray-200 rounded-lg text-gray-500 hover:text-blue-600 hover:bg-blue-50 hover:border-blue-200 transition">
                    <i class="fa-solid fa-pen-to-square w-4 h-4 text-center"></i>
                </button>
                <button title="Hapus User" class="p-2 border border-red-100 rounded-lg text-red-500 hover:bg-red-50 hover:border-red-200 transition">
                    <i class="fa-solid fa-trash-can w-4 h-4 text-center"></i>
                </button>
            </div>
        </div>

        <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
            <div>
                <div class="flex items-center gap-3 mb-2">
                    <h3 class="text-base font-bold text-gray-900">sekretariat_dprd</h3>
                    <span class="bg-gray-900 text-white text-[10px] font-bold px-2 py-1 rounded-md flex items-center gap-1">
                        <i class="fa-solid fa-circle-check text-green-400"></i> Active
                    </span>
                    <span class="bg-gray-100 text-gray-600 border border-gray-200 text-[10px] font-bold px-2 py-1 rounded-md">
                        Sekretariat
                    </span>
                </div>
                <div class="text-xs text-gray-500 space-y-1">
                    <p>Email: sekretariat.dprd@dprd.go.id</p>
                    <p>Last Login: 2026-04-09 11:20</p>
                    <p>Created: 2026-02-01</p>
                </div>
            </div>

            <div class="flex items-center gap-3">
                <div class="flex items-center gap-2 mr-2">
                    <span class="text-xs font-bold text-gray-700">Aktif</span>
                    <label class="relative inline-flex items-center cursor-pointer">
                        <input type="checkbox" value="" class="sr-only peer" checked>
                        <div class="w-9 h-5 bg-gray-200 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-4 after:w-4 after:transition-all peer-checked:bg-gray-900"></div>
                    </label>
                </div>
                
                <button title="Reset Token/Password" class="p-2 border border-gray-200 rounded-lg text-gray-500 hover:text-yellow-600 hover:bg-yellow-50 hover:border-yellow-200 transition">
                    <i class="fa-solid fa-key w-4 h-4 text-center"></i>
                </button>
                <button title="Edit User" class="p-2 border border-gray-200 rounded-lg text-gray-500 hover:text-blue-600 hover:bg-blue-50 hover:border-blue-200 transition">
                    <i class="fa-solid fa-pen-to-square w-4 h-4 text-center"></i>
                </button>
                <button title="Hapus User" class="p-2 border border-red-100 rounded-lg text-red-500 hover:bg-red-50 hover:border-red-200 transition">
                    <i class="fa-solid fa-trash-can w-4 h-4 text-center"></i>
                </button>
            </div>
        </div>

    </div>
</div>
@endsection --}}

@extends('SuperAdmin.layouts.app')

@section('title', 'User Management')

@section('content')

@if(session('success'))
<div class="mb-6 p-4 bg-green-100 border border-green-200 text-green-800 rounded-xl flex items-center gap-2 shadow-sm">
    <i class="fa-solid fa-circle-check text-green-600"></i>
    <span class="text-sm font-semibold">{{ session('success') }}</span>
</div>
@endif

@if($errors->any())
<div class="mb-6 p-4 bg-red-100 border border-red-200 text-red-800 rounded-xl">
    <div class="flex items-center gap-2 mb-1 font-bold text-sm">
        <i class="fa-solid fa-circle-exclamation text-red-600"></i>
        <span>Pendaftaran Gagal:</span>
    </div>
    <ul class="list-disc list-inside text-xs space-y-1 text-red-700 ml-1">
        @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif

<div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-8 gap-4">
    <div>
        <h1 class="text-3xl font-extrabold text-gray-900 tracking-tight mb-1">User Management</h1>
        <p class="text-gray-500 text-sm font-medium">Kelola akun Admin dan Sekretariat DPRD</p>
    </div>
    
    <button id="openModalBtn" class="bg-red-800 hover:bg-red-900 text-white px-5 py-2.5 rounded-lg text-sm font-bold flex items-center gap-2 shadow-sm transition">
        <i class="fa-solid fa-user-plus"></i> Tambah User
    </button>
</div>

<div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
    <div class="mb-6">
        <h2 class="text-lg font-bold text-gray-800">Daftar Users</h2>
        <p class="text-xs text-gray-500">Total {{ $total_users ?? 0 }} user terdaftar</p>
    </div>

    <div class="border border-gray-200 rounded-xl p-4 sm:p-6 space-y-6">
        @forelse($users as $user)
        <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4 pb-6 last:pb-0 border-b last:border-b-0 border-gray-100">
            <div>
                <div class="flex items-center gap-3 mb-2">
                    <h3 class="text-base font-bold text-gray-900">{{ $user->username }}</h3>
                    <span class="bg-gray-900 text-white text-[10px] font-bold px-2 py-1 rounded-md flex items-center gap-1">
                        <i class="fa-solid fa-circle-check text-green-400"></i> Active
                    </span>
                    <span class="bg-gray-100 text-gray-600 border border-gray-200 text-[10px] font-bold px-2 py-1 rounded-md uppercase">
                        {{ $user->role }}
                    </span>
                </div>
                <div class="text-xs text-gray-500 space-y-1">
                    <p>Email: {{ $user->email }}</p>
                    <p>Created: {{ $user->created_at->format('Y-m-d') }}</p>
                </div>
            </div>

            <div class="flex items-center gap-3">
                <div class="flex items-center gap-2 mr-2">
                    <span class="text-xs font-bold text-gray-700">Aktif</span>
                    <label class="relative inline-flex items-center cursor-pointer">
                        <input type="checkbox" value="" class="sr-only peer" checked disabled>
                        <div class="w-9 h-5 bg-gray-200 rounded-full peer peer-checked:after:translate-x-full peer-checked:bg-gray-900 after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:rounded-full after:h-4 after:w-4 after:transition-all"></div>
                    </label>
                </div>
                
                <button title="Reset Password" class="p-2 border border-gray-200 rounded-lg text-gray-500 hover:text-yellow-600 hover:bg-yellow-50 transition">
                    <i class="fa-solid fa-key w-4 h-4 text-center"></i>
                </button>
                <button title="Edit User" class="p-2 border border-gray-200 rounded-lg text-gray-500 hover:text-blue-600 hover:bg-blue-50 transition">
                    <i class="fa-solid fa-pen-to-square w-4 h-4 text-center"></i>
                </button>
                <button title="Hapus User" class="p-2 border border-red-100 rounded-lg text-red-500 hover:bg-red-50 transition">
                    <i class="fa-solid fa-trash-can w-4 h-4 text-center"></i>
                </button>
            </div>
        </div>
        @empty
        <p class="text-center text-sm text-gray-400 py-4">Belum ada user yang terdaftar.</p>
        @endforelse
    </div>
</div>

<div id="tambahUserModal" class="hidden fixed inset-0 bg-gray-900/50 backdrop-blur-sm z-50 flex items-center justify-center p-4 transition-all duration-300">
    
    <div id="modalCard" class="bg-white rounded-2xl shadow-2xl max-w-md w-full border border-gray-100 overflow-hidden transform scale-95 opacity-0 transition-all duration-200">
        
        <div class="px-6 py-4 border-b border-gray-100 flex justify-between items-start">
            <div>
                <h3 class="text-lg font-black text-gray-900">Tambah User Baru</h3>
                <p class="text-xs text-gray-500 mt-0.5">Buat akun Admin atau Sekretariat baru</p>
            </div>
            <button id="closeModalBtn" class="text-gray-400 hover:text-gray-600 focus:outline-none p-1 rounded-lg hover:bg-gray-50 transition">
                <i class="fa-solid fa-xmark text-lg"></i>
            </button>
        </div>

        <form action="{{ route('superadmin.users.store') }}" method="POST" class="p-6 space-y-4">
            @csrf
            
            <div>
                <label class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-1">Username</label>
                <input type="text" name="username" value="{{ old('username') }}" placeholder="admin_username" required
                       class="w-full px-3 py-2.5 bg-gray-50 border border-gray-200 rounded-xl text-sm focus:outline-none focus:border-red-800 focus:bg-white transition">
            </div>

            <div>
                <label class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-1">Email</label>
                <input type="email" name="email" value="{{ old('email') }}" placeholder="admin@dprd.go.id" required
                       class="w-full px-3 py-2.5 bg-gray-50 border border-gray-200 rounded-xl text-sm focus:outline-none focus:border-red-800 focus:bg-white transition">
            </div>

            <div>
                <label class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-1">Role</label>
                <select name="role" required
                        class="w-full px-3 py-2.5 bg-gray-50 border border-gray-200 rounded-xl text-sm focus:outline-none focus:border-red-800 focus:bg-white transition cursor-pointer">
                    <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>Admin</option>
                    <option value="sekretariat" {{ old('role') == 'sekretariat' ? 'selected' : '' }}>Sekretariat</option>
                </select>
            </div>

            <div>
                <label class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-1">Password Awal</label>
                <input type="password" name="password" placeholder="••••••••" required
                       class="w-full px-3 py-2.5 bg-gray-50 border border-gray-200 rounded-xl text-sm focus:outline-none focus:border-red-800 focus:bg-white transition">
            </div>

            <div class="pt-2">
                <button type="submit" class="w-full bg-red-800 hover:bg-red-900 text-white py-3 rounded-xl font-bold text-sm shadow-md transition flex items-center justify-center gap-2">
                    <i class="fa-solid fa-user-check"></i> Tambah User
                </button>
            </div>
        </form>

    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const modal = document.getElementById('tambahUserModal');
        const card = document.getElementById('modalCard');
        const openBtn = document.getElementById('openModalBtn');
        const closeBtn = document.getElementById('closeModalBtn');

        function openModal() {
            modal.classList.remove('hidden');
            setTimeout(() => {
                card.classList.remove('scale-95', 'opacity-0');
            }, 10);
        }

        function closeModal() {
            card.classList.add('scale-95', 'opacity-0');
            setTimeout(() => {
                modal.classList.add('hidden');
            }, 200);
        }

        // Event Listener Tombol Buka & Tutup
        if(openBtn) openBtn.addEventListener('click', openModal);
        if(closeBtn) closeBtn.addEventListener('click', closeModal);

        // Tutup jika user mengklik area gelap di luar box modal
        modal.addEventListener('click', function(e) {
            if (e.target === modal) closeModal();
        });

        // OTOMATIS BUKA MODAL JIKA VALIDASI ERROR
        // Agar user tidak perlu klik tombol tambah lagi untuk melihat errornya
        @if($errors->any())
            openModal();
        @endif
    });
</script>
@endsection