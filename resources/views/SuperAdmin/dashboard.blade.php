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

<div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-8">
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
            <h2 class="text-3xl font-black text-gray-900">{{ $active_sessions ?? 0 }}</h2>
        </div>
        <div class="text-green-500">
            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path></svg>
        </div>
    </div>
    <div class="bg-white rounded-xl shadow-sm p-5 flex justify-between items-center hover:shadow-md transition">
        <div>
            <p class="text-xs font-semibold text-gray-500 mb-1">Security Alerts</p>
            <h2 class="text-3xl font-black text-gray-900">{{ $security_alerts }}</h2>
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
        
        <a href="{{ route('superadmin.users.index') }}" class="flex items-center p-4 bg-white border border-gray-100 rounded-xl shadow-sm hover:shadow-md hover:border-blue-300 hover:bg-blue-50 transition duration-200 cursor-pointer group">
            <div class="flex-shrink-0 w-12 h-12 bg-blue-500 text-white rounded-lg flex items-center justify-center group-hover:bg-blue-600 transition">
                <i class="fa-solid fa-users-gear text-xl"></i>
            </div>
            <div class="ml-4">
                <h3 class="text-sm font-bold text-gray-900 group-hover:text-blue-700 transition">Kelola User</h3>
                <p class="text-xs text-gray-500 mt-1">Tambah, nonaktifkan, atau hapus akun Admin</p>
            </div>
        </a>

        <a href="{{ route('superadmin.2fa.index') }}" class="flex items-center p-4 bg-white border border-gray-100 rounded-xl shadow-sm hover:shadow-md hover:border-green-300 hover:bg-green-50 transition duration-200 cursor-pointer group">
            <div class="flex-shrink-0 w-12 h-12 bg-green-500 text-white rounded-lg flex items-center justify-center group-hover:bg-green-600 transition">
                <i class="fa-solid fa-shield-halved text-xl"></i>
            </div>
            <div class="ml-4">
                <h3 class="text-sm font-bold text-gray-900 group-hover:text-green-700 transition">Setup 2FA</h3>
                <p class="text-xs text-gray-500 mt-1">Kelola Google Authenticator & recovery codes</p>
            </div>
        </a>

        <a href="{{ url('/superadmin/activity-logs') }}" class="flex items-center p-4 bg-white border border-gray-100 rounded-xl shadow-sm hover:shadow-md hover:border-purple-300 hover:bg-purple-50 transition duration-200 cursor-pointer group">
            <div class="flex-shrink-0 w-12 h-12 bg-purple-500 text-white rounded-lg flex items-center justify-center group-hover:bg-purple-600 transition">
                <i class="fa-solid fa-arrow-trend-up text-xl"></i>
            </div>
            <div class="ml-4">
                <h3 class="text-sm font-bold text-gray-900 group-hover:text-purple-700 transition">Activity Logs</h3>
                <p class="text-xs text-gray-500 mt-1">Monitor semua aktivitas sistem</p>
            </div>
        </a>

        <a href="{{ url('/superadmin/digital-footprint') }}" class="flex items-center p-4 bg-white border border-gray-100 rounded-xl shadow-sm hover:shadow-md hover:border-red-300 hover:bg-red-50 transition duration-200 cursor-pointer group">
            <div class="flex-shrink-0 w-12 h-12 bg-red-500 text-white rounded-lg flex items-center justify-center group-hover:bg-red-600 transition">
                <i class="fa-solid fa-magnifying-glass text-xl"></i>
            </div>
            <div class="ml-4">
                <h3 class="text-sm font-bold text-gray-900 group-hover:text-red-700 transition">Digital Footprint</h3>
                <p class="text-xs text-gray-500 mt-1">Pelacakan forensik & investigasi</p>
            </div>
        </a>

        <a href="{{ url('/superadmin/double-switch') }}" class="flex items-center p-4 bg-white border border-gray-100 rounded-xl shadow-sm hover:shadow-md hover:border-indigo-300 hover:bg-indigo-50 transition duration-200 cursor-pointer group">
            <div class="flex-shrink-0 w-12 h-12 bg-indigo-500 text-white rounded-lg flex items-center justify-center group-hover:bg-indigo-600 transition">
                <i class="fa-solid fa-right-left text-xl"></i>
            </div>
            <div class="ml-4">
                <h3 class="text-sm font-bold text-gray-900 group-hover:text-indigo-700 transition">Double Switch</h3>
                <p class="text-xs text-gray-500 mt-1">Akses langsung ke Admin 1 atau Admin 2</p>
            </div>
        </a>

        <a href="{{ route('superadmin.password.edit') }}" class="flex items-center p-4 bg-white border border-gray-100 rounded-xl shadow-sm hover:shadow-md hover:border-orange-300 hover:bg-orange-50 transition duration-200 cursor-pointer group">
            <div class="flex-shrink-0 w-12 h-12 bg-orange-500 text-white rounded-lg flex items-center justify-center group-hover:bg-orange-600 transition">
                <i class="fa-solid fa-key text-xl"></i>
            </div>
            <div class="ml-4">
                <h3 class="text-sm font-bold text-gray-900 group-hover:text-orange-700 transition">Ganti Password</h3>
                <p class="text-xs text-gray-500 mt-1">Perbarui kata sandi akun keamanan Anda</p>
            </div>
        </a>
    </div>
</div>

<div class="mt-8 bg-white border border-gray-100 rounded-xl shadow-sm p-6">
    <div class="mb-5">
        <h2 class="text-lg font-bold text-gray-900">Recent Activity</h2>
        <p class="text-xs text-gray-500">Aktivitas terbaru di sistem</p>
    </div>

    <div class="space-y-3">
        @forelse($recent_activities as $log)
            <div class="flex items-start p-3 hover:bg-gray-50 rounded-lg transition duration-150 border border-transparent hover:border-gray-100">
                <div class="flex-shrink-0 w-10 h-10 rounded-full flex items-center justify-center mt-1
                    @if($log->status == 'success') bg-green-100 text-green-600
                    @elseif($log->status == 'warning') bg-yellow-100 text-yellow-600
                    @else bg-red-100 text-red-600 @endif">
                    
                    @if($log->status == 'success')
                        <i class="fa-solid fa-check"></i>
                    @elseif($log->status == 'warning')
                        <i class="fa-solid fa-exclamation"></i>
                    @else
                        <i class="fa-solid fa-triangle-exclamation"></i>
                    @endif
                </div>
                
                <div class="ml-4 flex-1">
                    <p class="text-sm text-gray-900">
                        <span class="font-bold">{{ $log->user->username ?? 'System/Guest' }}</span> 
                        <span class="text-gray-600">{{ $log->description }}</span>
                    </p>
                    <p class="text-[11px] text-gray-400 mt-1">
                        <i class="fa-regular fa-clock"></i> {{ $log->created_at->diffForHumans() }} 
                        &bull; <span class="font-semibold">{{ $log->module }}</span>
                    </p>
                </div>
            </div>
        @empty
            <div class="text-center py-6 text-gray-400 text-sm">
                Belum ada aktivitas yang terekam di sistem.
            </div>
        @endforelse
    </div>

    <a href="{{ url('/superadmin/activity-logs') }}" class="mt-5 block w-full text-center py-3 bg-white border border-gray-200 text-gray-700 font-bold rounded-lg hover:bg-gray-50 transition shadow-sm hover:shadow">
        Lihat Semua Activity Logs
    </a>
</div>
@endsection