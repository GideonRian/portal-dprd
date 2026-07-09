@extends('Staff.layouts.app')

@section('title', 'Dashboard')

@section('content')
    <style>
        .card-3d-blue {
            background: linear-gradient(135deg, #60a5fa 0%, #2563eb 100%);
            box-shadow: 0 15px 30px -5px rgba(37, 99, 235, 0.5), inset 0 2px 3px rgba(255, 255, 255, 0.4), inset 0 -3px 5px rgba(0, 0, 0, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        .card-3d-purple {
            background: linear-gradient(135deg, #c084fc 0%, #9333ea 100%);
            box-shadow: 0 15px 30px -5px rgba(147, 51, 234, 0.5), inset 0 2px 3px rgba(255, 255, 255, 0.4), inset 0 -3px 5px rgba(0, 0, 0, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        .card-3d-green {
            background: linear-gradient(135deg, #34d399 0%, #059669 100%);
            box-shadow: 0 15px 30px -5px rgba(5, 150, 105, 0.5), inset 0 2px 3px rgba(255, 255, 255, 0.4), inset 0 -3px 5px rgba(0, 0, 0, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        .card-3d-red {
            background: linear-gradient(135deg, #f87171 0%, #dc2626 100%);
            box-shadow: 0 15px 30px -5px rgba(220, 38, 38, 0.5), inset 0 2px 3px rgba(255, 255, 255, 0.4), inset 0 -3px 5px rgba(0, 0, 0, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        .card-3d-orange {
            background: linear-gradient(135deg, #fb923c 0%, #ea580c 100%);
            box-shadow: 0 15px 30px -5px rgba(234, 88, 12, 0.5), inset 0 2px 3px rgba(255, 255, 255, 0.4), inset 0 -3px 5px rgba(0, 0, 0, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }
    </style>

    <div class="w-full px-4 sm:px-6 lg:px-8 py-8 max-w-screen-2xl mx-auto">

        <div class="flex items-center gap-4 mb-8 animate-fade-in-down">
            <img src="{{ asset('images/logo.png') }}" alt="Logo" class="h-20 w-auto object-contain drop-shadow-lg">
            <div>
                <h2 class="text-3xl font-extrabold text-gray-900 mb-1">Admin Dashboard</h2>
                <p class="text-gray-600 font-medium">DPRD Tapanuli Selatan - Content Management System</p>
            </div>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-5 gap-6 mb-10">
            
            <div class="card-3d-blue relative overflow-hidden rounded-3xl p-6 text-white transform hover:-translate-y-2 hover:scale-[1.02] transition-all duration-300 cursor-pointer group">
                <i class="fa-solid fa-users absolute -right-6 -bottom-6 text-8xl opacity-20 transform group-hover:scale-110 group-hover:rotate-12 transition-transform duration-500"></i>
                
                <div class="relative z-10 flex justify-between items-start">
                    <div class="bg-white/20 p-3.5 rounded-2xl backdrop-blur-md border border-white/30 shadow-inner">
                        <i class="fa-solid fa-users text-2xl text-white drop-shadow-md"></i>
                    </div>
                    <h3 class="text-4xl font-black drop-shadow-lg tracking-tight">{{ $total_anggota }}</h3>
                </div>
                <p class="relative z-10 mt-6 font-bold text-sm tracking-wide uppercase drop-shadow-sm opacity-90">Total Anggota</p>
            </div>

            <div class="card-3d-purple relative overflow-hidden rounded-3xl p-6 text-white transform hover:-translate-y-2 hover:scale-[1.02] transition-all duration-300 cursor-pointer group">
                <i class="fa-regular fa-newspaper absolute -right-6 -bottom-6 text-8xl opacity-20 transform group-hover:scale-110 group-hover:-rotate-12 transition-transform duration-500"></i>
                
                <div class="relative z-10 flex justify-between items-start">
                    <div class="bg-white/20 p-3.5 rounded-2xl backdrop-blur-md border border-white/30 shadow-inner">
                        <i class="fa-regular fa-newspaper text-2xl text-white drop-shadow-md"></i>
                    </div>
                    <h3 class="text-4xl font-black drop-shadow-lg tracking-tight">{{ $total_berita }}</h3>
                </div>
                <p class="relative z-10 mt-6 font-bold text-sm tracking-wide uppercase drop-shadow-sm opacity-90">Total Berita</p>
            </div>

            <div class="card-3d-green relative overflow-hidden rounded-3xl p-6 text-white transform hover:-translate-y-2 hover:scale-[1.02] transition-all duration-300 cursor-pointer group">
                <i class="fa-regular fa-message absolute -right-6 -bottom-6 text-8xl opacity-20 transform group-hover:scale-110 group-hover:rotate-12 transition-transform duration-500"></i>
                
                <div class="relative z-10 flex justify-between items-start">
                    <div class="bg-white/20 p-3.5 rounded-2xl backdrop-blur-md border border-white/30 shadow-inner">
                        <i class="fa-regular fa-message text-2xl text-white drop-shadow-md"></i>
                    </div>
                    <h3 class="text-4xl font-black drop-shadow-lg tracking-tight">{{ $total_aspirasi }}</h3>
                </div>
                <p class="relative z-10 mt-6 font-bold text-sm tracking-wide uppercase drop-shadow-sm opacity-90">Aspirasi Masuk</p>
            </div>

            <div class="card-3d-red relative overflow-hidden rounded-3xl p-6 text-white transform hover:-translate-y-2 hover:scale-[1.02] transition-all duration-300 cursor-pointer group">
                <i class="fa-regular fa-file-lines absolute -right-6 -bottom-6 text-8xl opacity-20 transform group-hover:scale-110 group-hover:-rotate-12 transition-transform duration-500"></i>
                
                <div class="relative z-10 flex justify-between items-start">
                    <div class="bg-white/20 p-3.5 rounded-2xl backdrop-blur-md border border-white/30 shadow-inner">
                        <i class="fa-regular fa-file-lines text-2xl text-white drop-shadow-md"></i>
                    </div>
                    <h3 class="text-4xl font-black drop-shadow-lg tracking-tight">{{ $total_dokumen }}</h3>
                </div>
                <p class="relative z-10 mt-6 font-bold text-sm tracking-wide uppercase drop-shadow-sm opacity-90">Total Dokumen</p>
            </div>

            <div class="card-3d-orange relative overflow-hidden rounded-3xl p-6 text-white transform hover:-translate-y-2 hover:scale-[1.02] transition-all duration-300 cursor-pointer group">
                <i class="fa-regular fa-calendar absolute -right-6 -bottom-6 text-8xl opacity-20 transform group-hover:scale-110 group-hover:rotate-12 transition-transform duration-500"></i>
                
                <div class="relative z-10 flex justify-between items-start">
                    <div class="bg-white/20 p-3.5 rounded-2xl backdrop-blur-md border border-white/30 shadow-inner">
                        <i class="fa-regular fa-calendar text-2xl text-white drop-shadow-md"></i>
                    </div>
                    <h3 class="text-4xl font-black drop-shadow-lg tracking-tight">{{ $total_agenda }}</h3>
                </div>
                <p class="relative z-10 mt-6 font-bold text-sm tracking-wide uppercase drop-shadow-sm opacity-90">Agenda Kegiatan</p>
            </div>
            
        </div>

        <div class="bg-white rounded-3xl p-8 shadow-sm border border-gray-100">
            <h3 class="text-xl font-bold text-gray-900 mb-6 border-b border-gray-100 pb-4">Quick Actions</h3>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-5 gap-4">

                <a href="{{ route('staff.anggota.create') }}"
                    class="flex flex-col items-center justify-center p-4 rounded-xl border-2 border-blue-100 hover:border-blue-500 hover:bg-blue-50 text-blue-700 font-bold text-sm transition-all duration-300 gap-3 text-center group">
                    <div class="bg-blue-100 p-3 rounded-full group-hover:bg-blue-600 group-hover:text-white transition-colors duration-300">
                        <i class="fa-solid fa-user-plus text-xl"></i>
                    </div>
                    Tambah Anggota
                </a>

                <a href="{{ route('staff.berita.create') }}"
                    class="flex flex-col items-center justify-center p-4 rounded-xl border-2 border-purple-100 hover:border-purple-500 hover:bg-purple-50 text-purple-700 font-bold text-sm transition-all duration-300 gap-3 text-center group">
                    <div class="bg-purple-100 p-3 rounded-full group-hover:bg-purple-600 group-hover:text-white transition-colors duration-300">
                        <i class="fa-regular fa-pen-to-square text-xl"></i>
                    </div>
                    Buat Berita
                </a>

                <a href="{{ route('staff.aspirasi.index') }}"
                    class="flex flex-col items-center justify-center p-4 rounded-xl border-2 border-green-100 hover:border-green-500 hover:bg-green-50 text-green-700 font-bold text-sm transition-all duration-300 gap-3 text-center group">
                    <div class="bg-green-100 p-3 rounded-full group-hover:bg-green-600 group-hover:text-white transition-colors duration-300">
                        <i class="fa-regular fa-comments text-xl"></i>
                    </div>
                    Kelola Aspirasi
                </a>

                <a href="{{ route('staff.dokumen.index') }}"
                    class="flex flex-col items-center justify-center p-4 rounded-xl border-2 border-red-100 hover:border-red-500 hover:bg-red-50 text-red-700 font-bold text-sm transition-all duration-300 gap-3 text-center group">
                    <div class="bg-red-100 p-3 rounded-full group-hover:bg-red-600 group-hover:text-white transition-colors duration-300">
                        <i class="fa-solid fa-folder-open text-xl"></i>
                    </div>
                    Kelola Dokumen
                </a>

                <a href="{{ route('staff.agenda.index') }}"
                    class="flex flex-col items-center justify-center p-4 rounded-xl border-2 border-orange-100 hover:border-orange-500 hover:bg-orange-50 text-orange-700 font-bold text-sm transition-all duration-300 gap-3 text-center group">
                    <div class="bg-orange-100 p-3 rounded-full group-hover:bg-orange-600 group-hover:text-white transition-colors duration-300">
                        <i class="fa-regular fa-calendar-plus text-xl"></i>
                    </div>
                    Tambah Agenda
                </a>

            </div>
        </div>

    </div>
@endsection