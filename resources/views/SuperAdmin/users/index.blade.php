@extends('SuperAdmin.layouts.app')

@section('title', 'User Management')

@section('content')

@if(session('success'))
<div id="success-alert" class="mb-6 p-4 bg-green-100 border border-green-200 text-green-800 rounded-xl flex items-center gap-2 shadow-sm transition-all duration-500 opacity-100">
    <i class="fa-solid fa-circle-check text-green-600"></i>
    <span class="text-sm font-semibold">{{ session('success') }}</span>
</div>
@endif

@if($errors->any())
<div class="mb-6 p-4 bg-red-100 border border-red-200 text-red-800 rounded-xl shadow-sm">
    <div class="flex items-center gap-2 mb-1 font-bold text-sm">
        <i class="fa-solid fa-circle-exclamation text-red-600"></i>
        <span>Terjadi Kesalahan:</span>
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
        <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4 pb-6 last:pb-0 border-b last:border-b-0 border-gray-100 hover:bg-gray-50 p-2 rounded-lg transition-colors">
            
            <div>
                <div class="flex items-center gap-3 mb-2">
                    <h3 class="text-base font-bold text-gray-900">{{ $user->username }}</h3>
                    
                    @if($user->is_active)
                        <span class="bg-gray-900 text-white text-[10px] font-bold px-2 py-1 rounded-md flex items-center gap-1">
                            <i class="fa-solid fa-circle-check text-green-400"></i> Active
                        </span>
                    @else
                        <span class="bg-gray-200 text-gray-600 text-[10px] font-bold px-2 py-1 rounded-md flex items-center gap-1">
                            <i class="fa-solid fa-circle-xmark text-red-500"></i> Nonactive
                        </span>
                    @endif

                    <span class="bg-gray-100 text-gray-600 border border-gray-200 text-[10px] font-bold px-2 py-1 rounded-md uppercase">
                        {{ $user->role }}
                    </span>
                </div>
                <div class="text-xs text-gray-500 space-y-1">
                    <p>Email: {{ $user->email }}</p>
                    <p>Last Login: 
                        @if($user->last_login_at)
                            {{ $user->last_login_at->format('Y-m-d H:i') }}
                        @else
                            <span class="italic text-gray-400">Belum pernah login</span>
                        @endif
                    </p>
                    <p>Created: {{ $user->created_at->format('Y-m-d') }}</p>
                </div>
            </div>

            <div class="flex items-center gap-3">
                
                <form action="{{ route('superadmin.users.toggle-status', $user->id) }}" method="POST" class="flex items-center gap-2 mr-2">
                    @csrf
                    @method('PATCH')
                    <span class="text-xs font-bold {{ $user->is_active ? 'text-green-600' : 'text-gray-400' }}">
                        {{ $user->is_active ? 'Aktif' : 'Nonaktif' }}
                    </span>
                    <label class="relative inline-flex items-center cursor-pointer">
                        <input type="checkbox" class="sr-only peer" onchange="this.form.submit()" {{ $user->is_active ? 'checked' : '' }}>
                        <div class="w-9 h-5 bg-gray-200 rounded-full peer peer-checked:bg-green-600 after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:rounded-full after:h-4 after:w-4 after:transition-all peer-checked:after:translate-x-full"></div>
                    </label>
                </form>
                
                <button type="button" title="Reset Password" 
                        onclick="openResetModal({{ $user->id }}, '{{ $user->username }}', '{{ $user->role }}')" 
                        class="p-2 border border-gray-200 rounded-lg text-gray-500 hover:text-yellow-600 hover:bg-yellow-50 transition">
                    <i class="fa-solid fa-key w-4 h-4 text-center"></i>
                </button>

                <button type="button" title="Edit User" 
                        onclick="openEditModal({{ $user->id }}, '{{ $user->username }}', '{{ $user->email }}', '{{ $user->role }}')" 
                        class="p-2 border border-gray-200 rounded-lg text-gray-500 hover:text-blue-600 hover:bg-blue-50 transition">
                    <i class="fa-solid fa-pen-to-square w-4 h-4 text-center"></i>
                </button>

                <form action="{{ route('superadmin.users.destroy', $user->id) }}" method="POST" onsubmit="return confirm('Peringatan: Apakah Anda yakin ingin menghapus permanen akun {{ $user->username }}?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" title="Hapus User" class="p-2 border border-red-100 rounded-lg text-red-500 hover:bg-red-50 hover:text-red-700 transition">
                        <i class="fa-solid fa-trash-can w-4 h-4 text-center"></i>
                    </button>
                </form>
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
                <p class="text-xs text-gray-500 mt-0.5">Buat akun Staff atau Sekretariat baru</p>
            </div>
            <button id="closeModalBtn" class="text-gray-400 hover:text-gray-600 focus:outline-none p-1 rounded-lg hover:bg-gray-50 transition">
                <i class="fa-solid fa-xmark text-lg"></i>
            </button>
        </div>
        <form action="{{ route('superadmin.users.store') }}" method="POST" class="p-6 space-y-4">
            @csrf
            <div>
                <label class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-1">Username</label>
                <input type="text" name="username" value="{{ old('username') }}" placeholder="Contoh: staf_keuangan" required
                       class="w-full px-3 py-2.5 bg-gray-50 border border-gray-200 rounded-xl text-sm focus:outline-none focus:border-red-800 focus:bg-white transition">
            </div>
            <div>
                <label class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-1">Email</label>
                <input type="email" name="email" value="{{ old('email') }}" placeholder="admin@dprd-tapsel.go.id" required
                       class="w-full px-3 py-2.5 bg-gray-50 border border-gray-200 rounded-xl text-sm focus:outline-none focus:border-red-800 focus:bg-white transition">
            </div>
            <div>
                <label class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-1">Role</label>
                <select name="role" required class="w-full px-3 py-2.5 bg-gray-50 border border-gray-200 rounded-xl text-sm focus:outline-none focus:border-red-800 focus:bg-white transition cursor-pointer">
                    <option value="staff" {{ old('role') == 'staff' ? 'selected' : '' }}>Staff DPRD</option>
                    <option value="sekretaris" {{ old('role') == 'sekretaris' ? 'selected' : '' }}>Sekretaris / Pimpinan</option>
                </select>
            </div>
            <div>
                <label class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-1">Password Awal</label>
                <input type="password" name="password" placeholder="••••••••" required
                       class="w-full px-3 py-2.5 bg-gray-50 border border-gray-200 rounded-xl text-sm focus:outline-none focus:border-red-800 focus:bg-white transition">
            </div>
            <div class="pt-2">
                <button type="submit" class="w-full bg-red-800 hover:bg-red-900 text-white py-3 rounded-xl font-bold text-sm shadow-md transition flex items-center justify-center gap-2">
                    <i class="fa-solid fa-user-check"></i> Simpan User
                </button>
            </div>
        </form>
    </div>
</div>

<div id="editUserModal" class="hidden fixed inset-0 bg-gray-900/50 backdrop-blur-sm z-50 flex items-center justify-center p-4 transition-all duration-300">
    <div id="editModalCard" class="bg-white rounded-2xl shadow-xl max-w-md w-full border border-gray-100 overflow-hidden transform scale-95 opacity-0 transition-all duration-200">
        <div class="px-6 py-4 border-b border-gray-100 flex justify-between items-start">
            <div>
                <h3 class="text-lg font-black text-gray-900">Edit User</h3>
                <p class="text-xs text-gray-500 mt-0.5" id="edit_subtitle">Update informasi user</p>
            </div>
            <button onclick="closeEditModal()" class="text-gray-400 hover:text-gray-600 p-1 rounded-lg hover:bg-gray-50 transition">
                <i class="fa-solid fa-xmark text-lg"></i>
            </button>
        </div>
        <form id="editForm" method="POST" class="p-6 space-y-4">
            @csrf
            @method('PUT')
            <div>
                <label class="block text-xs font-bold text-gray-700 uppercase mb-1">Username</label>
                <input type="text" name="username" id="edit_username" required class="w-full px-3 py-2.5 bg-gray-50 border border-gray-200 rounded-xl text-sm focus:outline-none focus:border-red-800 focus:bg-white">
            </div>
            <div>
                <label class="block text-xs font-bold text-gray-700 uppercase mb-1">Email</label>
                <input type="email" name="email" id="edit_email" required class="w-full px-3 py-2.5 bg-gray-50 border border-gray-200 rounded-xl text-sm focus:outline-none focus:border-red-800 focus:bg-white">
            </div>
            <div>
                <label class="block text-xs font-bold text-gray-700 uppercase mb-1">Role</label>
                <select name="role" id="edit_role" required class="w-full px-3 py-2.5 bg-gray-50 border border-gray-200 rounded-xl text-sm focus:outline-none focus:border-red-800 focus:bg-white cursor-pointer">
                    <option value="staff">Staff DPRD</option>
                    <option value="sekretaris">Sekretaris / Pimpinan</option>
                </select>
            </div>
            <div class="pt-2">
                <button type="submit" class="w-full bg-[#9b1c1c] hover:bg-red-800 text-white py-3 rounded-xl font-bold text-sm shadow-md transition">
                    Update User
                </button>
            </div>
        </form>
    </div>
</div>

<div id="resetUserModal" class="hidden fixed inset-0 bg-gray-900/50 backdrop-blur-sm z-50 flex items-center justify-center p-4 transition-all duration-300">
    <div id="resetModalCard" class="bg-white rounded-2xl shadow-xl max-w-md w-full border border-gray-100 overflow-hidden transform scale-95 opacity-0 transition-all duration-200">
        <div class="px-6 py-4 border-b border-gray-100 flex justify-between items-start">
            <div>
                <h3 class="text-lg font-black text-gray-900">Reset Password</h3>
                <p class="text-xs text-gray-500 mt-0.5" id="reset_subtitle">Reset password untuk user</p>
            </div>
            <button onclick="closeResetModal()" class="text-gray-400 hover:text-gray-600 p-1 rounded-lg hover:bg-gray-50 transition">
                <i class="fa-solid fa-xmark text-lg"></i>
            </button>
        </div>
        <form id="resetForm" method="POST" class="p-6 space-y-4">
            @csrf
            @method('PUT')
            
            <div class="bg-yellow-50 border border-yellow-100 text-yellow-700 p-3 rounded-xl text-xs">
                SuperAdmin dapat mereset password pengguna apabila mereka lupa.
            </div>

            <div>
                <label class="block text-xs font-bold text-gray-700 uppercase mb-1">Password Baru</label>
                <input type="password" name="password" placeholder="Masukkan password baru" required class="w-full px-3 py-2.5 bg-gray-50 border border-gray-200 rounded-xl text-sm focus:outline-none focus:border-red-800 focus:bg-white">
            </div>
            <div>
                <label class="block text-xs font-bold text-gray-700 uppercase mb-1">Konfirmasi Password</label>
                <input type="password" name="password_confirmation" placeholder="Ketik ulang password" required class="w-full px-3 py-2.5 bg-gray-50 border border-gray-200 rounded-xl text-sm focus:outline-none focus:border-red-800 focus:bg-white">
            </div>
            <div class="pt-2">
                <button type="submit" class="w-full bg-[#9b1c1c] hover:bg-red-800 text-white py-3 rounded-xl font-bold text-sm shadow-md transition flex items-center justify-center gap-2">
                    <i class="fa-solid fa-key"></i> Konfirmasi Reset
                </button>
            </div>
        </form>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        
        // --- LOGIKA MODAL TAMBAH USER ---
        const tambahModal = document.getElementById('tambahUserModal');
        const tambahCard = document.getElementById('modalCard');
        const openTambahBtn = document.getElementById('openModalBtn');
        const closeTambahBtn = document.getElementById('closeModalBtn');

        function openTambahModal() {
            tambahModal.classList.remove('hidden');
            setTimeout(() => tambahCard.classList.remove('scale-95', 'opacity-0'), 10);
        }

        function closeTambahModal() {
            tambahCard.classList.add('scale-95', 'opacity-0');
            setTimeout(() => tambahModal.classList.add('hidden'), 200);
        }

        if(openTambahBtn) {
            // Paksa button agar tidak me-refresh halaman
            openTambahBtn.setAttribute('type', 'button'); 
            openTambahBtn.addEventListener('click', openTambahModal);
        }
        if(closeTambahBtn) closeTambahBtn.addEventListener('click', closeTambahModal);


        // --- LOGIKA MODAL EDIT USER ---
        const editModal = document.getElementById('editUserModal');
        const editCard = document.getElementById('editModalCard');
        const editForm = document.getElementById('editForm');

        window.openEditModal = function(id, username, email, role) {
            document.getElementById('edit_subtitle').innerText = `Update informasi user ${username}`;
            document.getElementById('edit_username').value = username;
            document.getElementById('edit_email').value = email;
            document.getElementById('edit_role').value = role.toLowerCase();
            
            // Gunakan URL Helper Laravel agar alamat selalu valid
            editForm.action = `{{ url('superadmin/users') }}/${id}`;
            
            editModal.classList.remove('hidden');
            setTimeout(() => editCard.classList.remove('scale-95', 'opacity-0'), 10);
        }

        window.closeEditModal = function() {
            editCard.classList.add('scale-95', 'opacity-0');
            setTimeout(() => editModal.classList.add('hidden'), 200);
        }


        // --- LOGIKA MODAL RESET PASSWORD ---
        const resetModal = document.getElementById('resetUserModal');
        const resetCard = document.getElementById('resetModalCard');
        const resetForm = document.getElementById('resetForm');

        window.openResetModal = function(id, username, role) {
            document.getElementById('reset_subtitle').innerText = `Reset password untuk ${username}`;
            
            // Gunakan URL Helper Laravel agar alamat selalu valid
            resetForm.action = `{{ url('superadmin/users') }}/${id}/reset-password`;
            
            resetModal.classList.remove('hidden');
            setTimeout(() => resetCard.classList.remove('scale-95', 'opacity-0'), 10);
        }

        window.closeResetModal = function() {
            resetCard.classList.add('scale-95', 'opacity-0');
            setTimeout(() => resetModal.classList.add('hidden'), 200);
        }

        // --- TUTUP MODAL JIKA KLIK AREA LUAR ---
        window.addEventListener('click', function(e) {
            if (e.target === tambahModal) closeTambahModal();
            if (e.target === editModal) closeEditModal();
            if (e.target === resetModal) closeResetModal();
        });
        
        // --- VALIDASI MINIMAL PASSWORD AGAR POP-UP TIDAK HILANG ---
        // Mencari semua input password dan memaksa minimal 6 karakter
        document.querySelectorAll('input[type="password"]').forEach(function(input) {
            input.setAttribute('minlength', '6');
        });

        // --- LOGIKA MENGHILANGKAN ALERT OTOMATIS (2 DETIK) ---
        const successAlert = document.getElementById('success-alert');
        if (successAlert) {
            setTimeout(() => {
                // Ubah opacity menjadi 0 (membuatnya pudar)
                successAlert.classList.replace('opacity-100', 'opacity-0');
                
                // Setelah pudar selama 0.5 detik, hapus elemen tersebut dari halaman
                setTimeout(() => {
                    successAlert.remove();
                }, 500); 
            }, 2000); // 2000 milidetik = 2 detik
        }
    });
</script>
@endsection