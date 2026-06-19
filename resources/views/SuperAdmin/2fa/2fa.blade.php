@extends('SuperAdmin.layouts.app')

@section('title', '2FA Management')

@section('content')
<div class="mb-8">
    <h1 class="text-3xl font-extrabold text-gray-900 tracking-tight mb-1">2FA Management</h1>
    <p class="text-gray-500 text-sm font-medium">Kelola Google Authenticator dan Recovery Codes untuk keamanan maksimal</p>
</div>

@if(session('success'))
    <div id="alert-message" class="bg-green-50 border-l-4 border-green-500 p-4 mb-6 rounded-r-lg shadow-sm transition-opacity duration-500 opacity-100">
        <div class="flex items-center">
            <i class="fa-solid fa-circle-check text-green-500 mr-3 text-lg"></i>
            <p class="text-green-800 text-sm font-bold">{{ session('success') }}</p>
        </div>
    </div>
@endif

<div class="bg-white border border-red-500/20 rounded-2xl shadow-sm p-6 mb-6">
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-6 gap-4">
        <div>
            <h2 class="text-lg font-bold text-gray-900">Status 2FA</h2>
            <p class="text-sm text-gray-500">Two-Factor Authentication menggunakan Google Authenticator</p>
        </div>
        <span class="bg-gray-900 text-white text-[11px] font-bold px-3 py-1.5 rounded-lg flex items-center gap-1.5 shadow-sm">
            <i class="fa-solid fa-circle-check text-green-400"></i> Aktif
        </span>
    </div>

    <div class="bg-blue-50 border border-blue-100 rounded-xl p-4 mb-6 flex items-start gap-3">
        <i class="fa-solid fa-shield-halved text-blue-600 mt-0.5 text-lg"></i>
        <div>
            <h4 class="text-sm font-bold text-blue-900">2FA Wajib Aktif</h4>
            <p class="text-xs text-blue-700 mt-1 leading-relaxed">
                SuperAdmin wajib menggunakan 2FA setiap kali login. Jangan nonaktifkan fitur ini kecuali dalam keadaan darurat.
            </p>
        </div>
    </div>

    <button type="button" onclick="toggleSetupSection()" class="bg-[#9b1c1c] hover:bg-red-800 text-white text-sm font-bold py-2.5 px-5 rounded-xl transition flex items-center gap-2 shadow-sm">
        <i class="fa-solid fa-arrows-rotate"></i> Resync / Ganti Perangkat
    </button>
</div>

<div id="setup-section" class="bg-white border border-red-500/20 rounded-2xl shadow-sm p-6 mb-6 hidden transition-all duration-300">
    <div class="mb-6">
        <h2 class="text-lg font-bold text-gray-900">Setup Google Authenticator</h2>
        <p class="text-sm text-gray-500">Scan QR code ini dengan aplikasi Google Authenticator di ponsel baru</p>
    </div>

    <div class="flex flex-col items-center justify-center mb-8">
        <div class="p-4 bg-white border-2 border-red-500 rounded-2xl shadow-sm mb-6 bg-gray-50">
            {!! $qrCode !!}
        </div>
        
        <div class="text-center">
            <p class="text-xs font-bold text-gray-700 mb-1 uppercase tracking-wide">Manual Entry Key:</p>
            <div class="bg-gray-100 border border-gray-200 px-5 py-2.5 rounded-lg shadow-inner">
                <p class="text-[15px] font-mono font-bold text-gray-800 tracking-[0.25em] select-all">{{ $secret }}</p>
            </div>
        </div>
    </div>

    <div class="border-t border-gray-100 pt-6">
        <h3 class="text-sm font-bold text-gray-900 mb-2">Verifikasi Setup</h3>
        <p class="text-xs text-gray-500 mb-4">Masukkan kode 6-digit dari Google Authenticator untuk memverifikasi:</p>
        
        <div class="flex flex-col sm:flex-row gap-3">
            <input type="text" maxlength="6" placeholder="123456" class="flex-1 px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl text-center text-lg font-mono font-bold tracking-[0.5em] focus:outline-none focus:ring-2 focus:ring-red-500/20 focus:border-red-500 transition">
            <button type="button" class="bg-green-500 hover:bg-green-600 text-white font-bold py-3 px-6 rounded-xl transition flex items-center justify-center gap-2 shadow-sm whitespace-nowrap">
                <i class="fa-solid fa-check"></i> Verifikasi & Aktifkan 2FA
            </button>
        </div>
    </div>
</div>

<div class="bg-white border border-red-500/20 rounded-2xl shadow-sm p-6">
    <div class="mb-6">
        <h2 class="text-lg font-bold text-gray-900">Recovery Codes (Kode Cadangan)</h2>
        <p class="text-sm text-gray-500">Gunakan kode ini untuk login jika HP hilang atau Google Authenticator tidak bisa diakses</p>
    </div>

    <div class="bg-yellow-50 border border-yellow-100 rounded-xl p-4 mb-6 flex items-start gap-3">
        <i class="fa-solid fa-triangle-exclamation text-yellow-600 mt-0.5 text-lg"></i>
        <div>
            <h4 class="text-sm font-bold text-yellow-900">Simpan dengan Aman!</h4>
            <p class="text-xs text-yellow-700 mt-1 leading-relaxed">
                Simpan recovery codes ini di tempat yang aman. Setiap kode hanya bisa digunakan sekali dan tidak bisa di-recover jika hilang.
            </p>
        </div>
    </div>

    <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-5 gap-3 mb-6">
        @if(count($recoveryCodes) > 0)
            @foreach($recoveryCodes as $code)
                <div class="bg-gray-50 border border-gray-200 rounded-lg text-center py-3.5 text-xs font-bold text-gray-700 tracking-wider">
                    {{ $code }}
                </div>
            @endforeach
        @else
            <div class="col-span-full bg-red-50 border border-red-200 rounded-lg text-center py-4 text-sm font-bold text-red-600">
                Belum ada kode cadangan. Silakan generate baru.
            </div>
        @endif
    </div>

    <div class="flex flex-col sm:flex-row gap-3 mb-3">
        <button type="button" onclick="copyRecoveryCodes()" class="flex-1 border-2 border-gray-200 text-gray-700 hover:bg-gray-50 hover:border-gray-300 font-bold text-sm py-2.5 rounded-xl transition flex items-center justify-center gap-2">
            <i class="fa-regular fa-copy"></i> Copy All Codes
        </button>
        <button type="button" onclick="downloadRecoveryCodes()" class="flex-1 border-2 border-gray-200 text-gray-700 hover:bg-gray-50 hover:border-gray-300 font-bold text-sm py-2.5 rounded-xl transition flex items-center justify-center gap-2">
            <i class="fa-solid fa-download"></i> Download as TXT
        </button>
    </div>
    
    <form action="{{ route('superadmin.2fa.generate_recovery') }}" method="POST">
        @csrf
        <button type="submit" onclick="return confirm('PERINGATAN: Kode lama akan hangus dan tidak bisa digunakan lagi. Yakin ingin membuat kode baru?')" class="w-full border-2 border-gray-200 text-gray-700 hover:bg-gray-50 hover:border-gray-300 font-bold text-sm py-2.5 rounded-xl transition flex items-center justify-center gap-2 mt-2">
            <i class="fa-solid fa-arrows-rotate"></i> Generate Recovery Codes Baru
        </button>
    </form>
</div>

<script>
    // Menyuntikkan array dari Laravel ke dalam variabel JavaScript
    const codes = @json($recoveryCodes);

    // Fungsi Toggle Setup
    function toggleSetupSection() {
        const setupSection = document.getElementById('setup-section');
        setupSection.classList.toggle('hidden');
        
        if (!setupSection.classList.contains('hidden')) {
            setupSection.scrollIntoView({ behavior: 'smooth', block: 'center' });
        }
    }

    // Fungsi Copy
    function copyRecoveryCodes() {
        if(codes.length === 0) {
            alert('Tidak ada kode untuk disalin!');
            return;
        }
        navigator.clipboard.writeText(codes.join('\n')).then(() => {
            alert('Berhasil! Seluruh kode cadangan telah disalin ke clipboard.');
        }).catch(err => {
            console.error('Gagal menyalin text: ', err);
        });
    }

    // Fungsi Download TXT
    function downloadRecoveryCodes() {
        if(codes.length === 0) {
            alert('Tidak ada kode untuk di-download!');
            return;
        }
        
        const headerText = "=== RECOVERY CODES SUPERADMIN DPRD TAPSEL ===\n\n";
        const footerText = "\n\nSimpan file ini di tempat yang sangat aman.\nSetiap kode hanya bisa digunakan 1 kali.";
        const fullText = headerText + codes.join('\n') + footerText;

        const element = document.createElement('a');
        const file = new Blob([fullText], {type: 'text/plain'});
        element.href = URL.createObjectURL(file);
        element.download = 'Recovery_Codes_SuperAdmin_DPRD.txt';
        document.body.appendChild(element);
        element.click();
        document.body.removeChild(element);
    }

    // Fungsi untuk menghilangkan alert secara otomatis setelah 4 detik
    setTimeout(function() {
        const alertBox = document.getElementById('alert-message');
        if (alertBox) {
            // 1. Ubah opacity menjadi 0 agar efek memudar (fade-out) berjalan
            alertBox.classList.replace('opacity-100', 'opacity-0');
            
            // 2. Hapus elemen sepenuhnya dari halaman setelah animasi selesai (500 milidetik)
            setTimeout(() => {
                alertBox.style.display = 'none';
            }, 500);
        }
    }, 2000); // 4000 milidetik = 4 detik
</script>
@endsection