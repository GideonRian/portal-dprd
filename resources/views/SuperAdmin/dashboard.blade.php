@extends('SuperAdmin.layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class="mb-8">
    <div class="flex items-center gap-3 mb-1">
        <h1 class="text-3xl font-extrabold text-gray-900 tracking-tight">Selamat Datang, SuperAdmin</h1>
    </div>
    <div class="mb-8">
        <p class="text-gray-500 text-sm font-medium">Tim IT DPRD - Panel kontrol keamanan dan manajemen sistem</p>
    </div>
</div>

<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 mb-8">
    <div class="bg-white rounded-xl shadow-sm p-5 flex justify-between items-center hover:shadow-md transition">
        <div>
            <p class="text-xs font-semibold text-gray-500 mb-1">Total Admin Users</p>
            <h2 class="text-3xl font-black text-gray-900">{{ $total_user ?? 2 }}</h2>
        </div>
        <div class="text-blue-500">
            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
        </div>
    </div>
    <div class="bg-white rounded-xl shadow-sm p-5 flex justify-between items-center hover:shadow-md transition">
        <div>
            <p class="text-xs font-semibold text-gray-500 mb-1">Active Sessions</p>
            <h2 class="text-3xl font-black text-gray-900">1</h2>
        </div>
        <div class="text-green-500">
            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path></svg>
        </div>
    </div>
    <div class="bg-white rounded-xl shadow-sm p-5 flex justify-between items-center hover:shadow-md transition">
        <div>
            <p class="text-xs font-semibold text-gray-500 mb-1">Tokens Generated Today</p>
            <h2 class="text-3xl font-black text-gray-900">3</h2>
        </div>
        <div class="text-yellow-500">
            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z"></path></svg>
        </div>
    </div>
    <div class="bg-white rounded-xl shadow-sm p-5 flex justify-between items-center hover:shadow-md transition">
        <div>
            <p class="text-xs font-semibold text-gray-500 mb-1">Security Alerts</p>
            <h2 class="text-3xl font-black text-gray-900">0</h2>
        </div>
        <div class="text-red-500">
            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>
        </div>
    </div>
</div>

<div class="bg-white rounded-2xl shadow-sm p-6 mb-8 border border-gray-100">
    <div class="mb-4">
        <h3 class="text-lg font-bold text-gray-800">Quick Actions</h3>
        <p class="text-sm text-gray-500">Akses cepat ke fitur utama SuperAdmin</p>
    </div>
    
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
        <button class="flex items-start gap-4 p-4 rounded-xl hover:bg-gray-50 transition text-left group shadow-sm border border-gray-100">
            <div class="bg-blue-500 text-white p-3 rounded-lg group-hover:scale-105 transition">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
            </div>
            <div>
                <h4 class="font-bold text-gray-900 mb-1">Kelola User</h4>
                <p class="text-xs text-gray-500 leading-tight">Tambah, nonaktifkan, atau hapus akun Admin</p>
            </div>
        </button>

        <button class="flex items-start gap-4 p-4 rounded-xl hover:bg-gray-50 transition text-left group shadow-sm border border-gray-100">
            <div class="bg-yellow-500 text-white p-3 rounded-lg group-hover:scale-105 transition">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z"></path></svg>
            </div>
            <div>
                <h4 class="font-bold text-gray-900 mb-1">Cetak Token Reset</h4>
                <p class="text-xs text-gray-500 leading-tight">Generate token 6-digit untuk reset password</p>
            </div>
        </button>

        <button class="flex items-start gap-4 p-4 rounded-xl hover:bg-gray-50 transition text-left group shadow-sm border border-gray-100">
            <div class="bg-green-500 text-white p-3 rounded-lg group-hover:scale-105 transition">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path></svg>
            </div>
            <div>
                <h4 class="font-bold text-gray-900 mb-1">Setup 2FA</h4>
                <p class="text-xs text-gray-500 leading-tight">Kelola Google Authenticator & recovery codes</p>
            </div>
        </button>

        <button class="flex items-start gap-4 p-4 rounded-xl hover:bg-gray-50 transition text-left group shadow-sm border border-gray-100">
            <div class="bg-purple-500 text-white p-3 rounded-lg group-hover:scale-105 transition">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path></svg>
            </div>
            <div>
                <h4 class="font-bold text-gray-900 mb-1">Activity Logs</h4>
                <p class="text-xs text-gray-500 leading-tight">Monitor semua aktivitas sistem</p>
            </div>
        </button>

        <button class="flex items-start gap-4 p-4 rounded-xl hover:bg-gray-50 transition text-left group shadow-sm border border-gray-100">
            <div class="bg-red-500 text-white p-3 rounded-lg group-hover:scale-105 transition">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
            </div>
            <div>
                <h4 class="font-bold text-gray-900 mb-1">Digital Forensics</h4>
                <p class="text-xs text-gray-500 leading-tight">Pelacakan forensik & investigasi</p>
            </div>
        </button>

        <button class="flex items-start gap-4 p-4 rounded-xl hover:bg-gray-50 transition text-left group shadow-sm border border-gray-100">
            <div class="bg-indigo-500 text-white p-3 rounded-lg group-hover:scale-105 transition">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4"></path></svg>
            </div>
            <div>
                <h4 class="font-bold text-gray-900 mb-1">Double Switch</h4>
                <p class="text-xs text-gray-500 leading-tight">Akses langsung ke Admin 1 atau Admin 2</p>
            </div>
        </button>
    </div>
</div>

<div class="bg-white rounded-2xl shadow-sm p-6 border border-gray-100">
    <div class="mb-5">
        <h3 class="text-lg font-bold text-gray-800">Recent Activity</h3>
        <p class="text-sm text-gray-500">Aktivitas terbaru di sistem</p>
    </div>

    <div class="space-y-3">
        <div class="flex items-center gap-4 bg-gray-50 p-3 rounded-lg border border-gray-100">
            <div class="text-green-500 bg-green-100 p-2 rounded-full">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
            </div>
            <div>
                <p class="text-sm font-bold text-gray-800">SuperAdmin <span class="font-normal text-gray-600 text-xs ml-1">Login berhasil dengan 2FA</span></p>
                <p class="text-xs text-gray-400">2 menit lalu</p>
            </div>
        </div>

        <div class="flex items-center gap-4 bg-gray-50 p-3 rounded-lg border border-gray-100">
            <div class="text-blue-500 bg-blue-100 p-2 rounded-full">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path></svg>
            </div>
            <div>
                <p class="text-sm font-bold text-gray-800">Admin 1 (Fraksi) <span class="font-normal text-gray-600 text-xs ml-1">Mengubah data anggota: Drs. H. Ahmad</span></p>
                <p class="text-xs text-gray-400">15 menit lalu</p>
            </div>
        </div>

        <div class="flex items-center gap-4 bg-gray-50 p-3 rounded-lg border border-gray-100">
            <div class="text-green-500 bg-green-100 p-2 rounded-full">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
            </div>
            <div>
                <p class="text-sm font-bold text-gray-800">Admin 2 (Sekretariat) <span class="font-normal text-gray-600 text-xs ml-1">Menyetujui berita: Rapat Paripurna</span></p>
                <p class="text-xs text-gray-400">1 jam lalu</p>
            </div>
        </div>

        <div class="flex items-center gap-4 bg-gray-50 p-3 rounded-lg border border-gray-100">
            <div class="text-yellow-600 bg-yellow-100 p-2 rounded-full">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
            </div>
            <div>
                <p class="text-sm font-bold text-gray-800">SuperAdmin <span class="font-normal text-gray-600 text-xs ml-1">Generate token reset untuk Admin 1</span></p>
                <p class="text-xs text-gray-400">2 jam lalu</p>
            </div>
        </div>
    </div>

    <div class="mt-5">
        <button class="w-full py-2 rounded-lg border border-gray-200 text-gray-700 font-bold hover:bg-gray-50 transition shadow-sm">
            Lihat Semua Activity Logs
        </button>
    </div>
</div>
@endsection