@extends('Pimpinan-Sekretariat.layouts.app')

@section('title', 'Activity Log')

@section('content')
    <div class="w-full px-4 sm:px-6 lg:px-8 py-8 max-w-screen-2xl mx-auto font-sans">

        <a href="{{ route('sekretaris.dashboard') }}"
            class="inline-flex items-center text-purple-600 font-medium hover:underline mb-6 text-sm">
            <i class="fa-solid fa-arrow-left mr-2"></i> Kembali ke Dashboard
        </a>

        <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-8">
            <div class="flex items-center gap-4">
                <div class="w-14 h-14 bg-blue-600 rounded-2xl flex items-center justify-center text-white shadow-md">
                    <i class="fa-solid fa-heart-pulse text-2xl"></i>
                </div>
                <div>
                    <h1 class="text-3xl font-extrabold text-gray-900 mb-1">Log Aktivitas</h1>
                    <p class="text-gray-500 font-medium">Monitor semua aktivitas admin dan perubahan data</p>
                </div>
            </div>

            <div class="flex items-center gap-3">
                <button onclick="window.location.reload();"
                    class="bg-white border border-gray-300 text-gray-700 hover:bg-gray-50 px-4 py-2.5 rounded-xl font-bold transition shadow-sm flex items-center gap-2 text-sm">
                    <i class="fa-solid fa-rotate-right"></i> Refresh
                </button>
                <a href="{{ route('sekretaris.activity.export', request()->query()) }}"
                    class="bg-purple-600 hover:bg-purple-700 text-white px-5 py-2.5 rounded-xl font-bold shadow-md flex items-center gap-2 transition text-sm w-max">
                    <i class="fa-solid fa-download"></i> Ekspor Laporan
                </a>
            </div>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
            <div class="bg-white rounded-2xl p-6 shadow-sm border border-gray-200">
                <p class="text-gray-500 text-sm font-medium mb-2">Total Logs</p>
                <h3 class="text-4xl font-black text-gray-900">{{ $stats['total_logs'] }}</h3>
            </div>
            <div class="bg-white rounded-2xl p-6 shadow-sm border border-gray-200">
                <p class="text-gray-500 text-sm font-medium mb-2">Hari Ini</p>
                <h3 class="text-4xl font-black text-blue-600">{{ $stats['hari_ini'] }}</h3>
            </div>
            <div class="bg-white rounded-2xl p-6 shadow-sm border border-gray-200">
                <p class="text-gray-500 text-sm font-medium mb-2">Admin Aktif</p>
                <h3 class="text-4xl font-black text-green-500">{{ $stats['admin_aktif'] }}</h3>
            </div>
            <div class="bg-white rounded-2xl p-6 shadow-sm border border-gray-200">
                <p class="text-gray-500 text-sm font-medium mb-2">Filtered Results</p>
                <h3 class="text-4xl font-black text-purple-600">{{ $stats['filtered'] }}</h3>
            </div>
        </div>

        <div class="bg-white rounded-2xl p-6 shadow-sm border border-gray-200 mb-8">
            <div class="flex items-center gap-2 mb-4">
                <i class="fa-solid fa-filter text-gray-700"></i>
                <h3 class="font-bold text-gray-900">Filters</h3>
            </div>

            <form action="{{ route('sekretaris.activity') }}" method="GET" class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div>
                    <label class="block text-xs font-bold text-gray-600 mb-2">Search</label>
                    <div class="relative">
                        <i class="fa-solid fa-magnifying-glass absolute left-4 top-1/2 -translate-y-1/2 text-gray-400"></i>
                        <input type="text" name="search" value="{{ request('search') }}"
                            placeholder="Cari username, action, description..."
                            class="w-full pl-10 pr-4 py-2.5 bg-white border border-gray-300 rounded-xl focus:ring-2 focus:ring-purple-500 focus:border-purple-500 outline-none text-sm transition">
                    </div>
                </div>

                <div>
                    <label class="block text-xs font-bold text-gray-600 mb-2">Module</label>
                    <div class="relative">
                        <select name="module" onchange="this.form.submit()"
                            class="w-full pl-4 pr-10 py-2.5 bg-white border border-gray-300 rounded-xl focus:ring-2 focus:ring-purple-500 focus:border-purple-500 outline-none text-sm appearance-none transition text-gray-700">
                            <option value="">Semua Module</option>
                            <option value="Anggota" {{ request('module') == 'Anggota' ? 'selected' : '' }}>Anggota</option>
                            <option value="Berita" {{ request('module') == 'Berita' ? 'selected' : '' }}>Berita</option>
                            <option value="Aspirasi" {{ request('module') == 'Aspirasi' ? 'selected' : '' }}>Aspirasi
                            </option>
                            <option value="Dokumen" {{ request('module') == 'Dokumen' ? 'selected' : '' }}>Dokumen</option>
                            <option value="Agenda" {{ request('module') == 'Agenda' ? 'selected' : '' }}>Agenda</option>
                            <option value="Autentikasi" {{ request('module') == 'Autentikasi' ? 'selected' : '' }}>
                                Autentikasi (Auth)</option>
                            <option value="System" {{ request('module') == 'System' ? 'selected' : '' }}>System</option>
                        </select>
                        <i
                            class="fa-solid fa-chevron-down absolute right-4 top-1/2 -translate-y-1/2 text-gray-400 pointer-events-none text-xs"></i>
                    </div>
                </div>

                <div>
                    <label class="block text-xs font-bold text-gray-600 mb-2">Action Type</label>
                    <div class="relative">
                        <select name="action_type" onchange="this.form.submit()"
                            class="w-full pl-4 pr-10 py-2.5 bg-white border border-gray-300 rounded-xl focus:ring-2 focus:ring-purple-500 focus:border-purple-500 outline-none text-sm appearance-none transition text-gray-700">
                            <option value="">Semua Aksi</option>
                            <option value="Create" {{ request('action_type') == 'Create' ? 'selected' : '' }}>Create /
                                Tambah</option>
                            <option value="Update" {{ request('action_type') == 'Update' ? 'selected' : '' }}>Update / Edit
                            </option>
                            <option value="Delete" {{ request('action_type') == 'Delete' ? 'selected' : '' }}>Delete /
                                Hapus</option>
                            <option value="Login" {{ request('action_type') == 'Login' ? 'selected' : '' }}>Login</option>
                            <option value="Logout" {{ request('action_type') == 'Logout' ? 'selected' : '' }}>Logout
                            </option>
                        </select>
                        <i
                            class="fa-solid fa-chevron-down absolute right-4 top-1/2 -translate-y-1/2 text-gray-400 pointer-events-none text-xs"></i>
                    </div>
                </div>
            </form>
        </div>

        <div class="bg-white rounded-2xl shadow-sm border border-gray-200 overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr
                            class="bg-gray-50 border-b border-gray-200 text-xs font-bold text-gray-600 uppercase tracking-wider">
                            <th class="px-6 py-4"><i class="fa-regular fa-clock mr-1"></i> Timestamp</th>
                            <th class="px-6 py-4"><i class="fa-regular fa-user mr-1"></i> User</th>
                            <th class="px-6 py-4">Module</th>
                            <th class="px-6 py-4">Action</th>
                            <th class="px-6 py-4">Description</th>
                            <th class="px-6 py-4 text-center">Details</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @forelse($logs as $log)
                            <tr class="hover:bg-gray-50 transition">
                                <td class="px-6 py-4 text-sm text-gray-500 whitespace-nowrap">
                                    {{ $log->created_at->format('d M Y, H:i') }}
                                </td>
                                <td class="px-6 py-4 text-sm font-bold text-gray-900 whitespace-nowrap">
                                    {{ $log->user->name ?? 'System' }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span
                                        class="bg-gray-100 border border-gray-200 text-gray-600 px-2.5 py-1 rounded-md text-xs font-bold">
                                        {{ $log->module }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    @if ($log->action == 'Create')
                                        <span class="text-green-600 bg-green-50 px-2 py-1 rounded font-bold text-xs"><i
                                                class="fa-solid fa-plus mr-1"></i> Create</span>
                                    @elseif($log->action == 'Update')
                                        <span class="text-blue-600 bg-blue-50 px-2 py-1 rounded font-bold text-xs"><i
                                                class="fa-solid fa-pen mr-1"></i> Update</span>
                                    @elseif($log->action == 'Delete')
                                        <span class="text-red-600 bg-red-50 px-2 py-1 rounded font-bold text-xs"><i
                                                class="fa-solid fa-trash mr-1"></i> Delete</span>
                                    @elseif($log->action == 'Login')
                                        <span class="text-emerald-600 bg-emerald-50 px-2 py-1 rounded font-bold text-xs"><i
                                                class="fa-solid fa-arrow-right-to-bracket mr-1"></i> Login</span>
                                    @elseif($log->action == 'Logout')
                                        <span class="text-orange-600 bg-orange-50 px-2 py-1 rounded font-bold text-xs"><i
                                                class="fa-solid fa-arrow-right-from-bracket mr-1"></i> Logout</span>
                                    @else
                                        <span class="text-gray-600 font-bold text-xs">{{ $log->action }}</span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 text-sm text-gray-700 min-w-[250px]">
                                    {{ $log->description }}
                                </td>
                                <td class="px-6 py-4 text-center">
                                    <button
                                        class="text-purple-600 hover:text-purple-900 bg-purple-50 hover:bg-purple-100 p-2 rounded-lg transition"
                                        title="Lihat Detail">
                                        <i class="fa-solid fa-eye"></i>
                                    </button>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="px-6 py-20 text-center">
                                    <div class="flex flex-col items-center justify-center">
                                        <i class="fa-solid fa-heart-pulse text-5xl text-gray-300 mb-4"></i>
                                        <h3 class="text-gray-500 font-bold text-lg mb-1">Tidak ada log ditemukan</h3>
                                        <p class="text-gray-400 text-sm">Coba ubah filter atau search term</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
                <div class="p-4 border-t border-gray-200">
                    {{ $logs->links() }}
                </div>
            </div>
        </div>

    </div>
@endsection
