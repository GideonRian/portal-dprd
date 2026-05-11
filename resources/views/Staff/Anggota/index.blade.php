@extends('Staff.layouts.app')

@section('content')
    <div class="w-full px-4 sm:px-6 lg:px-8 py-8 max-w-screen-2xl mx-auto">

        {{-- Header Section --}}
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 mb-8">
            <div class="flex items-center gap-4">
                <div class="w-16 h-16 bg-blue-600 rounded-2xl flex items-center justify-center text-white shadow-md">
                    <i class="fa-solid fa-users text-2xl"></i>
                </div>
                <div>
                    <h2 class="text-3xl font-extrabold text-gray-900 mb-1">Kelola Anggota DPRD</h2>
                    <p class="text-gray-500 font-medium text-sm">Tambah, edit, atau hapus data anggota</p>
                </div>
            </div>
            <a href="{{ route('staff.anggota.create') }}"
                class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-xl font-bold transition shadow-md flex items-center gap-2">
                <i class="fa-solid fa-plus"></i> Tambah Anggota
            </a>
        </div>

        {{-- Flash Message --}}
        @if (session('success'))
            <div class="bg-green-100 border-l-4 border-green-500 text-green-700 px-4 py-3 rounded-xl mb-6 shadow-sm">
                <i class="fa-solid fa-check-circle mr-1"></i> {{ session('success') }}
            </div>
        @endif

        {{-- Search Bar --}}
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-4 mb-6">
            <form action="{{ route('staff.anggota.index') }}" method="GET" class="relative">
                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-gray-400">
                    <i class="fa-solid fa-magnifying-glass"></i>
                </div>
                <input type="text" name="search" value="{{ $search ?? '' }}"
                    placeholder="Cari nama anggota, jabatan, atau partai..."
                    class="w-full pl-11 pr-4 py-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-blue-500 outline-none transition text-sm">
            </form>
        </div>

        {{-- Data Table --}}
        <div class="bg-white rounded-3xl shadow-sm border border-gray-100 overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-gray-50 border-b border-gray-100 text-sm">
                            <th class="p-4 font-bold text-gray-900">Foto</th>
                            <th class="p-4 font-bold text-gray-900">Nama</th>
                            <th class="p-4 font-bold text-gray-900">Jabatan</th>
                            <th class="p-4 font-bold text-gray-900">Partai</th>
                            <th class="p-4 font-bold text-gray-900">Komisi</th>
                            <th class="p-4 font-bold text-gray-900">Dapil</th>
                            <th class="p-4 font-bold text-gray-900 text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @forelse($anggotas ?? [] as $anggota)
                            <tr class="hover:bg-gray-50 transition">
                                <td class="p-4">
                                    <img src="{{ $anggota->foto ? asset('storage/' . $anggota->foto) : 'https://ui-avatars.com/api/?name=' . urlencode($anggota->nama) . '&background=random' }}"
                                        class="w-12 h-12 rounded-full object-cover border border-gray-200">
                                </td>
                                <td class="p-4">
                                    <p class="font-bold text-gray-900">{{ $anggota->nama }}</p>
                                    <p class="text-xs text-gray-500">{{ $anggota->email ?? '-' }}</p>
                                </td>
                                <td class="p-4 text-gray-700 text-sm">{{ $anggota->jabatan }}</td>
                                <td class="p-4 text-gray-700 text-sm">{{ $anggota->partai }}</td>
                                <td class="p-4">
                                    <span
                                        class="bg-blue-50 text-blue-600 px-3 py-1 rounded-full text-xs font-bold">{{ $anggota->komisi }}</span>
                                </td>
                                <td class="p-4 text-gray-700 text-sm">{{ $anggota->dapil }}</td>
                                <td class="p-4 text-center space-x-2">
                                    <a href="{{ route('staff.anggota.edit', $anggota->id) }}"
                                        class="inline-flex w-8 h-8 items-center justify-center bg-blue-50 text-blue-600 rounded-lg hover:bg-blue-600 hover:text-white transition">
                                        <i class="fa-regular fa-pen-to-square"></i>
                                    </a>
                                    <form action="{{ route('staff.anggota.destroy', $anggota->id) }}" method="POST"
                                        class="inline-block" onsubmit="return confirm('Yakin ingin menghapus data ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            class="inline-flex w-8 h-8 items-center justify-center bg-red-50 text-red-600 rounded-lg hover:bg-red-600 hover:text-white transition">
                                            <i class="fa-regular fa-trash-can"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="p-8 text-center text-gray-500">Tidak ada data anggota ditemukan.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
