@extends('SuperAdmin.layouts.app')

@section('title', 'Global Activity Logs')

@section('content')
<div class="mb-8">
    <h1 class="text-3xl font-extrabold text-gray-900 tracking-tight mb-1">Global Activity Logs</h1>
    <p class="text-gray-500 text-sm font-medium">Monitor semua aktivitas sistem dan rekam jejak setiap pengguna</p>
</div>

<div class="bg-white border border-gray-100 rounded-t-2xl shadow-sm p-6 mb-0">
    <form action="{{ route('superadmin.activity-logs.index') }}" method="GET" class="flex flex-col md:flex-row gap-4 justify-between items-center">
        
        <div class="relative w-full md:w-1/2">
            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                <i class="fa-solid fa-magnifying-glass text-gray-400"></i>
            </div>
            <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari user, action, atau details..." class="w-full pl-10 pr-4 py-2.5 bg-gray-50 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-red-500/20 focus:border-red-500 transition">
        </div>

        <div class="flex flex-col sm:flex-row w-full md:w-auto gap-3">
            <select name="role" onchange="this.form.submit()" class="px-4 py-2.5 bg-white border border-gray-200 rounded-xl text-sm text-gray-700 focus:outline-none focus:ring-2 focus:ring-red-500/20 focus:border-red-500 transition">
                <option value="Semua Role" {{ request('role') == 'Semua Role' ? 'selected' : '' }}>Semua Role</option>
                <option value="Staff" {{ request('role') == 'Staff' ? 'selected' : '' }}>Staff</option>
                <option value="Sekretaris" {{ request('role') == 'Sekretaris' ? 'selected' : '' }}>Sekretaris</option>
            </select>

            <select name="status" onchange="this.form.submit()" class="px-4 py-2.5 bg-white border border-gray-200 rounded-xl text-sm text-gray-700 focus:outline-none focus:ring-2 focus:ring-red-500/20 focus:border-red-500 transition">
                <option value="Semua Status" {{ request('status') == 'Semua Status' ? 'selected' : '' }}>Semua Status</option>
                <option value="Success" {{ request('status') == 'Success' ? 'selected' : '' }}>Success</option>
                <option value="Warning" {{ request('status') == 'Warning' ? 'selected' : '' }}>Warning</option>
                <option value="Error" {{ request('status') == 'Error' ? 'selected' : '' }}>Error</option>
            </select>

            <a href="{{ route('superadmin.activity-logs.export') }}" class="px-5 py-2.5 bg-white border border-gray-200 text-gray-700 font-bold text-sm rounded-xl hover:bg-gray-50 transition flex items-center justify-center gap-2 shadow-sm whitespace-nowrap">
                <i class="fa-solid fa-download"></i> Export CSV
            </a>
        </div>
    </form>
</div>

<div class="bg-white border-x border-b border-red-500/20 rounded-b-2xl shadow-sm p-6 mb-6">
    
    <div class="mb-6 flex justify-between items-center">
        <div>
            <h2 class="text-lg font-bold text-gray-900">Recent Activities</h2>
            <p class="text-xs text-gray-500 mt-1">Menampilkan aktivitas real-time dari semua user</p>
        </div>
    </div>

    <div class="space-y-4">
        @forelse($logs as $log)
            <div class="bg-white border border-gray-100 rounded-xl p-4 shadow-sm hover:shadow-md transition duration-200">
                <div class="flex items-center gap-3 mb-2">
                    @if($log->status === 'success')
                        <span class="bg-gray-900 text-white text-[10px] font-bold px-2 py-1 rounded tracking-wide">SUCCESS</span>
                    @elseif($log->status === 'warning')
                        <span class="bg-gray-100 border border-gray-300 text-gray-700 text-[10px] font-bold px-2 py-1 rounded tracking-wide">WARNING</span>
                    @else
                        <span class="bg-red-600 text-white text-[10px] font-bold px-2 py-1 rounded tracking-wide">ERROR</span>
                    @endif
                    
                    <span class="text-[11px] font-mono text-gray-400 font-semibold">{{ $log->action }}</span>
                </div>
                
                <h3 class="text-sm font-bold text-gray-900 mb-2">{{ $log->description }}</h3>
                
                <div class="flex flex-wrap items-center gap-x-4 gap-y-2 text-[11px] font-medium text-gray-500">
                    <span class="flex items-center gap-1.5">
                        <i class="fa-regular fa-user"></i> {{ $log->user ? $log->user->username : 'System' }} 
                        @if($log->user)
                            <span class="text-gray-400">({{ ucfirst($log->user->role) }})</span>
                        @endif
                    </span>
                    <span class="flex items-center gap-1.5">
                        <i class="fa-regular fa-clock"></i> {{ $log->created_at->format('Y-m-d H:i:s') }}
                    </span>
                    <span class="flex items-center gap-1.5 font-mono">
                        <i class="fa-solid fa-network-wired"></i> IP: {{ $log->ip_address ?? 'Unknown' }}
                    </span>
                </div>
            </div>
        @empty
            <div class="text-center py-10">
                <i class="fa-solid fa-folder-open text-gray-300 text-4xl mb-3"></i>
                <p class="text-gray-500 text-sm font-medium">Belum ada rekam jejak aktivitas.</p>
            </div>
        @endforelse
    </div>

    <div class="mt-6">
        {{ $logs->links() }}
    </div>
</div>
@endsection