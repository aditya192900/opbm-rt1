<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Kampung Digital OPBM RT 01</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        * { box-sizing: border-box; }
        html, body {
            margin: 0;
            padding: 0;
            height: 100vh;
            overflow: hidden;
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif;
        }

        /* Particle Animation */
        @keyframes float {
            0%, 100% { transform: translateY(0) translateX(0); opacity: 0.4; }
            50% { transform: translateY(-30px) translateX(15px); opacity: 0.8; }
        }
        .particle { position: absolute; background: rgba(255,255,255,0.15); border-radius: 50%; pointer-events: none; }
        .particle-1 { width: 60px; height: 60px; top: 20%; left: 10%; animation: float 8s ease-in-out infinite; }
        .particle-2 { width: 40px; height: 40px; top: 60%; left: 80%; animation: float 6s ease-in-out infinite; animation-delay: 1s; }
        .particle-3 { width: 80px; height: 80px; top: 70%; left: 20%; animation: float 10s ease-in-out infinite; animation-delay: 2s; }
        .particle-4 { width: 30px; height: 30px; top: 15%; left: 70%; animation: float 7s ease-in-out infinite; animation-delay: 0.5s; }

        /* Form Styles */
        .form-group {
            margin-bottom: 16px;
        }
        .form-label {
            display: block;
            font-weight: 600;
            font-size: 13px;
            color: #374151;
            margin-bottom: 6px;
        }
        .form-input {
            width: 100%;
            border: 2px solid #e5e7eb;
            border-radius: 10px;
            padding: 11px 14px 11px 40px;
            font-size: 14px;
            outline: none;
            transition: all 0.2s;
            background: #f9fafb;
        }
        .form-input:focus {
            border-color: #10b981;
            background: #ffffff;
            box-shadow: 0 0 0 4px rgba(16, 185, 129, 0.1);
        }
        .input-icon {
            position: absolute;
            left: 12px;
            top: 50%;
            transform: translateY(-50%);
            color: #9ca3af;
            pointer-events: none;
        }
        .show-password {
            position: absolute;
            right: 12px;
            top: 50%;
            transform: translateY(-50%);
            color: #6b7280;
            cursor: pointer;
            background: none;
            border: none;
            padding: 4px;
        }
        .show-password:hover { color: #047857; }

        .btn-login {
            width: 100%;
            padding: 12px;
            border-radius: 10px;
            border: none;
            color: white;
            font-size: 15px;
            font-weight: 700;
            cursor: pointer;
            background: linear-gradient(135deg, #10b981 0%, #047857 100%);
            box-shadow: 0 4px 12px rgba(16, 185, 129, 0.3);
            transition: all 0.3s;
        }
        .btn-login:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(16, 185, 129, 0.4);
        }

        .captcha-wrapper {
            display: flex;
            gap: 10px;
            align-items: center;
        }
        .captcha-box {
            flex: 1;
            background: #ecfdf5;
            border: 2px dashed #10b981;
            border-radius: 10px;
            padding: 10px 14px;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }
        .captcha-question {
            font-weight: 800;
            font-size: 16px;
            color: #047857;
            letter-spacing: 1px;
        }
        .captcha-refresh {
            background: white;
            border: 1px solid #10b981;
            color: #047857;
            width: 28px;
            height: 28px;
            border-radius: 6px;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.2s;
        }
        .captcha-refresh:hover { background: #d1fae5; }
        .captcha-refresh.spinning { animation: spin 0.6s linear; }
        @keyframes spin { from { transform: rotate(0deg); } to { transform: rotate(360deg); } }

        @keyframes slideUp {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .slide-up { animation: slideUp 0.4s ease-out; }
    </style>
</head>
<body class="bg-gray-50">

<div class="flex h-screen w-screen">

    {{-- KIRI: BRANDING PANEL --}}
    <div class="hidden lg:flex w-1/2 relative overflow-hidden text-white p-12 flex-col justify-center" style="background: linear-gradient(135deg, #047857 0%, #064e3b 100%);">
        <div class="particle particle-1"></div>
        <div class="particle particle-2"></div>
        <div class="particle particle-3"></div>
        <div class="particle particle-4"></div>

        <div class="relative z-10 max-w-lg mx-auto w-full">
            <div class="flex items-center gap-4 mb-10">
                <div class="w-14 h-14 bg-white rounded-2xl flex items-center justify-center font-extrabold text-xl text-emerald-700 shadow-xl">RT</div>
                <div>
                    <div class="font-extrabold text-xl leading-tight">Kampung Digital</div>
                    <div class="text-sm text-emerald-200">RT 01 - Kota Jambi</div>
                </div>
            </div>

            <h1 class="text-4xl font-extrabold leading-tight mb-4">
                Selamat Datang <span class="text-yellow-400 block mt-1">Kembali 👋</span>
            </h1>
            <p class="text-emerald-100 text-sm leading-relaxed mb-10">
                Masuk ke sistem informasi dan pelayanan warga RT 01 Kampung Digital. Kelola data warga, jadwal penjemputan sampah, dan iuran OPBM dalam satu platform.
            </p>

            <div class="space-y-6">
                <div class="flex items-center gap-4">
                    <div class="w-10 h-10 bg-white/10 rounded-xl flex items-center justify-center flex-shrink-0 border border-white/10">
                        <svg class="w-5 h-5 text-yellow-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    </div>
                    <div>
                        <div class="font-bold text-sm">Pengelolaan Sampah Digital</div>
                        <div class="text-xs text-emerald-200">Program OPBM terintegrasi</div>
                    </div>
                </div>
                <div class="flex items-center gap-4">
                    <div class="w-10 h-10 bg-white/10 rounded-xl flex items-center justify-center flex-shrink-0 border border-white/10">
                        <svg class="w-5 h-5 text-yellow-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                    </div>
                    <div>
                        <div class="font-bold text-sm">Multi-Role System</div>
                        <div class="text-xs text-emerald-200">RT, Bendahara & Super Admin</div>
                    </div>
                </div>
                <div class="flex items-center gap-4">
                    <div class="w-10 h-10 bg-white/10 rounded-xl flex items-center justify-center flex-shrink-0 border border-white/10">
                        <svg class="w-5 h-5 text-yellow-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg>
                    </div>
                    <div>
                        <div class="font-bold text-sm">Sistem Anti-Kecurangan</div>
                        <div class="text-xs text-emerald-200">Double confirmation untuk iuran</div>
                    </div>
                </div>
            </div>

            <div class="mt-12 pt-6 text-xs text-emerald-200">
                © {{ date('Y') }} Kampung Digital OPBM RT 01 · Jambi Smart City Fest 2026
            </div>
        </div>
    </div>

    {{-- KANAN: FORM LOGIN (KARTU) --}}
    <div class="w-full lg:w-1/2 flex items-center justify-center p-4">
        
        <div class="w-full max-w-md bg-white rounded-3xl shadow-[0_8px_30px_rgb(0,0,0,0.04)] border border-gray-100 p-8 slide-up">
            
            {{-- Mobile Logo --}}
            <div class="lg:hidden text-center mb-6">
                <div class="w-12 h-12 bg-emerald-700 rounded-xl inline-flex items-center justify-center text-white font-extrabold text-lg shadow-lg mb-3">RT</div>
                <h2 class="font-extrabold text-lg text-gray-800">Kampung Digital RT 01</h2>
            </div>

            {{-- Header --}}
            <div class="mb-8 text-center">
                <h2 class="text-2xl font-extrabold text-gray-800 mb-1">Masuk Akun</h2>
                <p class="text-gray-500 text-sm">Silakan masuk untuk mengelola data RT</p>
            </div>

            @if ($errors->any() && !$errors->has('email') && !$errors->has('password') && !$errors->has('captcha'))
                <div class="bg-red-50 border-l-4 border-red-500 text-red-700 p-3 rounded-lg mb-5 text-xs flex items-center gap-2">
                    <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/></svg>
                    <span>{{ $errors->first() }}</span>
                </div>
            @endif

            <form method="POST" action="{{ route('login') }}" x-data="captchaHandler()" x-init="init()">
                @csrf

                {{-- EMAIL --}}
                <div class="form-group">
                    <label for="email" class="form-label">Email</label>
                    <div class="relative">
                        <span class="input-icon">
                            <svg width="18" height="18" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207"/></svg>
                        </span>
                        <input id="email" type="email" name="email" value="{{ old('email') }}" class="form-input" placeholder="Masukkan email Anda" required autofocus style="@error('email') border-color: #ef4444; @enderror">
                    </div>
                    @error('email') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                {{-- PASSWORD --}}
                <div class="form-group">
                    <label for="password" class="form-label">Password</label>
                    <div class="relative" x-data="{ show: false }">
                        <span class="input-icon">
                            <svg width="18" height="18" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/></svg>
                        </span>
                        <input id="password" :type="show ? 'text' : 'password'" name="password" class="form-input" placeholder="Masukkan password" required style="padding-right: 40px; @error('password') border-color: #ef4444; @enderror">
                        <button type="button" class="show-password" @click="show = !show">
                            <svg x-show="!show" width="18" height="18" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                            <svg x-show="show" width="18" height="18" fill="none" stroke="currentColor" viewBox="0 0 24 24" style="display:none;"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21"/></svg>
                        </button>
                    </div>
                    @error('password') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                {{-- CAPTCHA --}}
                <div class="form-group">
                    <label class="form-label">Verifikasi Keamanan <span class="text-red-500">*</span></label>
                    <div class="captcha-wrapper">
                        <div class="captcha-box">
                            <span class="captcha-question" x-text="question + ' = ?'"></span>
                            <button type="button" @click="refresh()" :disabled="refreshing" class="captcha-refresh" :class="{ 'spinning': refreshing }" title="Ganti soal">
                                <svg width="14" height="14" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/></svg>
                            </button>
                        </div>
                        <div class="w-[100px]">
                            <input type="number" name="captcha" inputmode="numeric" placeholder="Jawab" class="form-input" style="padding: 11px; text-align: center; font-weight: 700; @error('captcha') border-color: #ef4444; @enderror" required>
                        </div>
                    </div>
                    @error('captcha') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                {{-- REMEMBER + FORGOT --}}
                <div class="flex justify-between items-center mb-6 mt-2">
                    <label class="flex items-center gap-2 text-xs text-gray-600 cursor-pointer">
                        <input type="checkbox" name="remember" class="w-3.5 h-3.5 rounded border-gray-300 text-emerald-600 focus:ring-emerald-500"> Ingat saya
                    </label>
                    <a href="https://wa.me/6281234500001?text={{ urlencode('Halo Admin, saya lupa password akun OPBM RT 01. Mohon bantu reset.') }}" target="_blank" class="text-xs text-emerald-600 hover:text-emerald-700 font-semibold flex items-center gap-1">
                        Lupa password?
                    </a>
                </div>

                {{-- SUBMIT --}}
                <button type="submit" class="btn-login">MASUK</button>

                {{-- Footer Info --}}
                <div class="mt-6 text-center">
                    <p class="text-[11px] text-gray-400 leading-relaxed">
                        Halaman ini khusus untuk <strong>RT</strong>, <strong>Bendahara</strong> & <strong>Admin</strong>.<br>Akun dibuat oleh pengurus RT.
                    </p>
                    <a href="{{ route('home') }}" class="inline-flex items-center gap-1 text-gray-500 hover:text-emerald-600 text-xs font-semibold mt-4 transition">
                        <svg width="12" height="12" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
                        Kembali ke Beranda
                    </a>
                </div>
            </form>
        </div>
    </div>

</div>

<script>
    function captchaHandler() {
        return {
            question: '{{ session('captcha_question') ?? '' }}',
            refreshing: false,
            init() {
                if (!this.question) {
                    this.refresh();
                }
                @if($errors->any())
                    this.refresh();
                @endif
            },
            refresh() {
                this.refreshing = true;
                fetch('{{ route('captcha.refresh') }}')
                    .then(r => r.json())
                    .then(data => {
                        this.question = data.question;
                        setTimeout(() => { this.refreshing = false; }, 500);
                    })
                    .catch(() => {
                        this.refreshing = false;
                        window.location.reload();
                    });
            }
        }
    }
</script>

</body>
</html>