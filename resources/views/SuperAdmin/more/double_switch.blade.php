@extends('SuperAdmin.layouts.app')

@section('title', 'Double Switch Access')

@section('content')
<div class="mb-6">
    <h1 class="text-3xl font-extrabold text-gray-900 mb-1">Double Switch Access</h1>
    <p class="text-gray-500 text-sm">Akses ruangan dasbor pengguna lain menggunakan identitas SuperAdmin (Master Key).</p>
</div>

<div class="bg-blue-50 border-l-4 border-blue-400 p-4 mb-8 rounded-r-lg shadow-sm">
    <div class="flex items-start">
        <div class="flex-shrink-0">
            <i class="fa-solid fa-circle-info text-blue-500 text-xl"></i>
        </div>
        <div class="ml-3">
            <h3 class="text-sm font-bold text-blue-800">Master Key Mode Aktif</h3>
            <p class="text-xs text-blue-700 mt-1">Anda akan memasuki halaman Admin lain tanpa mengubah identitas Anda. Semua aktivitas (Tambah, Edit, Hapus) yang Anda lakukan di dalam ruangan mereka akan tercatat di Digital Footprint atas nama <b>SuperAdmin</b>.</p>
        </div>
    </div>
</div>

<div class="grid grid-cols-1 md:grid-cols-2 gap-8">
    
    <div class="bg-white rounded-2xl shadow-sm border border-gray-200 overflow-hidden relative group">
        <div class="absolute inset-0 bg-blue-500 opacity-0 group-hover:opacity-5 transition duration-300 pointer-events-none"></div>
        
        <div class="p-8 text-center relative z-10">
            <div class="w-20 h-20 bg-blue-100 text-blue-600 rounded-full flex items-center justify-center mx-auto mb-4 group-hover:scale-110 transition duration-300">
                <i class="fa-solid fa-user-tie text-3xl"></i>
            </div>
            <h2 class="text-2xl font-bold text-gray-900 mb-2">Admin 1 (Fraksi/Staff)</h2>
            <p class="text-sm text-gray-500 mb-6 px-4">Akses panel staf untuk memeriksa unggahan berita, draf dokumen, dan manajemen anggota dewan.</p>
            
            <a href="{{ url('/staff/dashboard') }}" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 px-4 rounded-xl shadow-lg hover:shadow-xl transition flex items-center justify-center gap-2">
                <i class="fa-solid fa-door-open"></i> Masuk ke Ruangan Staff
            </a>
        </div>
    </div>

    <div class="bg-white rounded-2xl shadow-sm border border-gray-200 overflow-hidden relative group">
        <div class="absolute inset-0 bg-green-500 opacity-0 group-hover:opacity-5 transition duration-300 pointer-events-none"></div>
        
        <div class="p-8 text-center relative z-10">
            <div class="w-20 h-20 bg-green-100 text-green-600 rounded-full flex items-center justify-center mx-auto mb-4 group-hover:scale-110 transition duration-300">
                <i class="fa-solid fa-user-shield text-3xl"></i>
            </div>
            <h2 class="text-2xl font-bold text-gray-900 mb-2">Admin 2 (Sekretariat)</h2>
            <p class="text-sm text-gray-500 mb-6 px-4">Akses panel Sekretaris untuk memeriksa persetujuan dokumen (Approval) dan pembuatan laporan.</p>
            
            <a href="{{ url('/sekretaris/dashboard') }}" class="w-full bg-green-600 hover:bg-green-700 text-white font-bold py-3 px-4 rounded-xl shadow-lg hover:shadow-xl transition flex items-center justify-center gap-2">
                <i class="fa-solid fa-door-open"></i> Masuk ke Ruangan Sekretaris
            </a>
        </div>
    </div>

</div>
@endsection