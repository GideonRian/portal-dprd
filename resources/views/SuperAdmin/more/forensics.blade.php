@extends('SuperAdmin.layouts.app')

@section('title', 'Digital Footprint')

@section('content')
<div class="mb-6">
    <h1 class="text-3xl font-extrabold text-gray-900 mb-1">Digital Footprint</h1>
    <p class="text-gray-500 text-sm">Pelacakan rekam jejak digital dan investigasi aktivitas mencurigakan</p>
</div>

<div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
    <div class="bg-white border-l-4 border-red-500 shadow-sm rounded-lg p-5 flex justify-between items-center">
        <div><p class="text-xs text-gray-500 font-semibold uppercase">High Risk Alerts</p><h2 class="text-3xl font-bold text-red-600">{{ $highRisk }}</h2></div>
        <i class="fa-solid fa-triangle-exclamation text-red-500 text-3xl opacity-80"></i>
    </div>
    <div class="bg-white border-l-4 border-yellow-400 shadow-sm rounded-lg p-5 flex justify-between items-center">
        <div><p class="text-xs text-gray-500 font-semibold uppercase">Medium Risk</p><h2 class="text-3xl font-bold text-yellow-500">{{ $mediumRisk }}</h2></div>
        <i class="fa-solid fa-circle-exclamation text-yellow-400 text-3xl opacity-80"></i>
    </div>
    <div class="bg-white border-l-4 border-blue-500 shadow-sm rounded-lg p-5 flex justify-between items-center">
        <div><p class="text-xs text-gray-500 font-semibold uppercase">Low Risk (Logins)</p><h2 class="text-3xl font-bold text-blue-600">{{ $lowRisk }}</h2></div>
        <i class="fa-solid fa-circle-info text-blue-500 text-3xl opacity-80"></i>
    </div>
</div>

<div class="bg-white rounded-t-xl shadow-sm border border-gray-200">
    <ul class="flex border-b border-gray-200 text-sm font-medium text-center text-gray-500">
        <li class="w-1/3">
            <button onclick="switchTab('suspicious')" id="tab-suspicious" class="w-full inline-block p-4 text-red-600 bg-gray-50 rounded-tl-xl border-b-2 border-red-600 font-bold active-tab">Aktivitas Mencurigakan</button>
        </li>
        <li class="w-1/3">
            <button onclick="switchTab('changes')" id="tab-changes" class="w-full inline-block p-4 border-b-2 border-transparent hover:text-gray-600 hover:bg-gray-50">Data Changes</button>
        </li>
        <li class="w-1/3">
            <button onclick="switchTab('logins')" id="tab-logins" class="w-full inline-block p-4 border-b-2 border-transparent hover:text-gray-600 hover:bg-gray-50 rounded-tr-xl">Login History</button>
        </li>
    </ul>
</div>

<div class="bg-white rounded-b-xl shadow-sm border-x border-b border-gray-200 p-6 mb-10">

    <div id="content-suspicious" class="tab-content">
        <div class="mb-4">
            <h3 class="text-lg font-bold">Aktivitas Mencurigakan</h3>
            <p class="text-xs text-gray-500">Daftar aktivitas yang terdeteksi tidak normal atau berpotensi berbahaya.</p>
        </div>
        <div class="space-y-4">
            @foreach($suspiciousActivities as $log)
            <div class="border border-gray-100 p-4 rounded-lg flex justify-between items-center hover:shadow-md transition">
                <div>
                    <span class="text-[10px] font-bold px-2 py-1 rounded {{ $log->status == 'error' ? 'bg-red-600 text-white' : 'bg-yellow-100 text-yellow-800 border border-yellow-300' }}">{{ strtoupper($log->status) }}</span>
                    <span class="text-[10px] text-gray-400 font-mono ml-2">{{ $log->action }}</span>
                    <h4 class="font-bold text-gray-900 mt-2 text-sm">{{ $log->description }}</h4>
                    <div class="text-[11px] text-gray-500 mt-2 flex gap-4">
                        <span><i class="fa-solid fa-user"></i> {{ $log->user->username ?? 'System/Guest' }}</span>
                        <span><i class="fa-regular fa-clock"></i> {{ $log->created_at->format('Y-m-d H:i:s') }}</span>
                        <span><i class="fa-solid fa-network-wired"></i> IP: {{ $log->ip_address }}</span>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>

    <div id="content-changes" class="tab-content hidden">
        <div class="mb-4">
            <h3 class="text-lg font-bold">Audit Trail - Data Changes</h3>
            <p class="text-xs text-gray-500">Riwayat perubahan data untuk melacak manipulasi.</p>
        </div>
        <div class="space-y-6">
            @foreach($dataChanges as $log)
            <div class="border border-gray-200 p-4 rounded-lg">
                <div class="flex justify-between border-b pb-2 mb-3">
                    <div class="text-xs font-bold text-gray-700">
                        <span class="bg-gray-900 text-white px-2 py-0.5 rounded">{{ $log->action }}</span>
                        <span class="ml-2 text-gray-500">Modul: {{ $log->module }}</span>
                    </div>
                    <div class="text-[10px] text-gray-400">By <b>{{ $log->user->username ?? 'System' }}</b> at {{ $log->created_at }}</div>
                </div>
                
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <span class="text-xs font-bold text-red-500 mb-1 block">Before:</span>
                        <pre class="bg-red-50 text-red-800 p-3 rounded text-[11px] overflow-x-auto border border-red-100">{{ $log->old_data ? json_encode(json_decode($log->old_data), JSON_PRETTY_PRINT) : 'NULL' }}</pre>
                    </div>
                    <div>
                        <span class="text-xs font-bold text-green-500 mb-1 block">After:</span>
                        <pre class="bg-green-50 text-green-800 p-3 rounded text-[11px] overflow-x-auto border border-green-100">{{ $log->new_data ? json_encode(json_decode($log->new_data), JSON_PRETTY_PRINT) : 'DELETED/NULL' }}</pre>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>

    <div id="content-logins" class="tab-content hidden">
        <div class="mb-4">
            <h3 class="text-lg font-bold">Login History</h3>
            <p class="text-xs text-gray-500">Riwayat otentikasi semua user untuk analisis pola akses.</p>
        </div>
        <div class="space-y-3">
            @foreach($loginHistory as $log)
            <div class="border border-gray-100 p-4 rounded-lg hover:shadow-md transition">
                <div class="flex items-center gap-3">
                    <h4 class="font-bold text-sm text-gray-900">{{ $log->user->username ?? 'Unknown' }}</h4>
                    <span class="text-[9px] font-bold px-2 py-0.5 rounded {{ $log->status == 'success' ? 'bg-gray-900 text-white' : 'bg-red-600 text-white' }}">{{ $log->action }}</span>
                </div>
                <div class="text-[11px] text-gray-500 mt-2 space-y-1">
                    <p><i class="fa-regular fa-clock w-4"></i> Time: {{ $log->created_at }}</p>
                    <p><i class="fa-solid fa-network-wired w-4"></i> IP: <span class="{{ $log->status == 'error' ? 'text-red-500 font-bold' : '' }}">{{ $log->ip_address }}</span></p>
                    <p><i class="fa-solid fa-desktop w-4"></i> Device: {{ \Illuminate\Support\Str::limit($log->user_agent, 60) }}</p>
                </div>
            </div>
            @endforeach
        </div>
    </div>

</div>

<script>
    function switchTab(tabName) {
        // Sembunyikan semua konten
        document.querySelectorAll('.tab-content').forEach(el => el.classList.add('hidden'));
        // Hapus style aktif dari semua tombol
        document.querySelectorAll('ul button').forEach(btn => {
            btn.classList.remove('text-red-600', 'bg-gray-50', 'border-red-600', 'font-bold');
            btn.classList.add('border-transparent', 'hover:text-gray-600');
        });

        // Tampilkan konten yang dipilih
        document.getElementById('content-' + tabName).classList.remove('hidden');
        
        // Tambahkan style aktif ke tombol yang diklik
        let activeBtn = document.getElementById('tab-' + tabName);
        activeBtn.classList.remove('border-transparent', 'hover:text-gray-600');
        activeBtn.classList.add('text-red-600', 'bg-gray-50', 'border-red-600', 'font-bold');
    }
</script>
@endsection