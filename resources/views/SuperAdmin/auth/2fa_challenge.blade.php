<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>2FA Verification - SuperAdmin</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="min-h-screen flex items-center justify-center bg-gradient-to-br from-[#6b1414] to-[#3a0b0b] font-sans">

    <div class="bg-white rounded-[20px] shadow-2xl w-full max-w-[420px] p-8">
        
        <div class="flex flex-col items-center mb-6 text-center">
            <img src="{{ asset('images/logo.png') }}" alt="Logo Tapsel" class="h-16 w-auto mb-4 drop-shadow-sm">
            
            <h1 id="form-title" class="text-[22px] font-bold text-gray-900 mb-2">Verifikasi Dual-Factor</h1>
            <p id="form-subtitle" class="text-[13px] text-gray-500 leading-relaxed px-2">Masukkan 6-digit kode dari aplikasi Google Authenticator Anda</p>
        </div>

        <form id="otp-form" action="{{ route('superadmin.2fa.verify') }}" method="POST">
            @csrf
            
            @if($errors->has('otp'))
                <div class="bg-red-50 border border-red-200 text-red-600 text-xs font-bold px-4 py-3 rounded-lg text-center mb-4">
                    {{ $errors->first('otp') }}
                </div>
            @endif
            
            <div class="flex justify-between gap-2 mb-6" id="otp-container">
                <input type="text" name="otp[]" maxlength="1" class="w-12 h-14 bg-[#f4f5f7] border border-gray-200 rounded-lg text-center text-xl font-bold text-gray-900 focus:outline-none focus:ring-2 focus:ring-[#8b1c1c]/30 focus:border-[#8b1c1c] transition" required autocomplete="off">
                <input type="text" name="otp[]" maxlength="1" class="w-12 h-14 bg-[#f4f5f7] border border-gray-200 rounded-lg text-center text-xl font-bold text-gray-900 focus:outline-none focus:ring-2 focus:ring-[#8b1c1c]/30 focus:border-[#8b1c1c] transition" required autocomplete="off">
                <input type="text" name="otp[]" maxlength="1" class="w-12 h-14 bg-[#f4f5f7] border border-gray-200 rounded-lg text-center text-xl font-bold text-gray-900 focus:outline-none focus:ring-2 focus:ring-[#8b1c1c]/30 focus:border-[#8b1c1c] transition" required autocomplete="off">
                <input type="text" name="otp[]" maxlength="1" class="w-12 h-14 bg-[#f4f5f7] border border-gray-200 rounded-lg text-center text-xl font-bold text-gray-900 focus:outline-none focus:ring-2 focus:ring-[#8b1c1c]/30 focus:border-[#8b1c1c] transition" required autocomplete="off">
                <input type="text" name="otp[]" maxlength="1" class="w-12 h-14 bg-[#f4f5f7] border border-gray-200 rounded-lg text-center text-xl font-bold text-gray-900 focus:outline-none focus:ring-2 focus:ring-[#8b1c1c]/30 focus:border-[#8b1c1c] transition" required autocomplete="off">
                <input type="text" name="otp[]" maxlength="1" class="w-12 h-14 bg-[#f4f5f7] border border-gray-200 rounded-lg text-center text-xl font-bold text-gray-900 focus:outline-none focus:ring-2 focus:ring-[#8b1c1c]/30 focus:border-[#8b1c1c] transition" required autocomplete="off">
            </div>

            <button type="submit" class="w-full bg-[#b57a7a] hover:bg-[#8b1c1c] text-white font-bold py-3.5 rounded-lg transition text-sm tracking-wide shadow-sm mb-4">
                VERIFIKASI
            </button>

            <div class="text-center mt-2">
                <button type="button" onclick="toggleForms()" class="text-[13px] font-medium text-gray-500 hover:text-[#8b1c1c] underline decoration-gray-300 hover:decoration-[#8b1c1c] underline-offset-4 transition">
                    Gunakan Kode Cadangan?
                </button>
            </div>
        </form>

        <form id="recovery-form" action="{{ route('superadmin.2fa.verify') }}" method="POST" class="hidden">
            @csrf
            
            @if($errors->has('recovery_code'))
                <div class="bg-red-50 border border-red-200 text-red-600 text-xs font-bold px-4 py-3 rounded-lg text-center mb-4">
                    {{ $errors->first('recovery_code') }}
                </div>
            @endif
            
            <input type="text" name="recovery_code" placeholder="Misal: A8F3-K9L2" class="w-full px-4 py-4 mb-6 bg-[#f4f5f7] border border-gray-200 rounded-lg text-center text-lg font-mono font-bold tracking-[0.2em] focus:outline-none focus:ring-2 focus:ring-[#8b1c1c]/30 focus:border-[#8b1c1c] uppercase transition" autocomplete="off">

            <button type="submit" class="w-full bg-gray-800 hover:bg-black text-white font-bold py-3.5 rounded-lg transition text-sm tracking-wide shadow-sm mb-4">
                GUNAKAN KODE
            </button>
            
            <div class="text-center mt-2">
                <button type="button" onclick="toggleForms()" class="text-[13px] font-medium text-gray-500 hover:text-[#8b1c1c] underline decoration-gray-300 hover:decoration-[#8b1c1c] underline-offset-4 transition">
                    Kembali ke Google Authenticator
                </button>
            </div>
        </form>
    </div>

    <script>
        // Fungsi untuk bolak-balik form
        function toggleForms() {
            const otpForm = document.getElementById('otp-form');
            const recoveryForm = document.getElementById('recovery-form');
            const title = document.getElementById('form-title');
            const subtitle = document.getElementById('form-subtitle');

            otpForm.classList.toggle('hidden');
            recoveryForm.classList.toggle('hidden');
            
            // Ubah teks judul agar sesuai dengan form yang sedang dibuka
            if (!recoveryForm.classList.contains('hidden')) {
                title.innerText = 'Akses Darurat';
                subtitle.innerText = 'Masukkan salah satu kode cadangan darurat Anda';
            } else {
                title.innerText = 'Verifikasi Dual-Factor';
                subtitle.innerText = 'Masukkan 6-digit kode dari aplikasi Google Authenticator Anda';
            }
        }

        // Script interaksi otomatis kotak OTP
        const inputs = document.querySelectorAll('#otp-container input');
        
        inputs.forEach((input, index) => {
            input.addEventListener('input', (e) => {
                e.target.value = e.target.value.replace(/[^0-9]/g, '');
                if(e.target.value.length === 1 && index < inputs.length - 1) {
                    inputs[index + 1].focus();
                }
            });

            input.addEventListener('keydown', (e) => {
                if(e.key === 'Backspace' && e.target.value === '' && index > 0) {
                    inputs[index - 1].focus();
                }
            });

            input.addEventListener('paste', (e) => {
                e.preventDefault();
                const pastedData = e.clipboardData.getData('text').replace(/[^0-9]/g, '').slice(0, 6);
                for (let i = 0; i < pastedData.length; i++) {
                    if (index + i < inputs.length) {
                        inputs[index + i].value = pastedData[i];
                        if (index + i < inputs.length - 1) {
                            inputs[index + i + 1].focus();
                        }
                    }
                }
            });
        });
    </script>
</body>
</html>