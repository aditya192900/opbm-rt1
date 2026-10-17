<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kampung Digital OPBM RT 01 - Kota Jambi</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        html { scroll-behavior: smooth; }
        .reveal { opacity: 0; transform: translateY(30px); transition: opacity 0.8s ease-out, transform 0.8s ease-out; }
        .reveal.active { opacity: 1; transform: translateY(0); }
        .particle { position: absolute; background: rgba(255, 255, 255, 0.15); border-radius: 50%; pointer-events: none; }
        @keyframes float {
            0%, 100% { transform: translateY(0) translateX(0); opacity: 0.4; }
            50% { transform: translateY(-30px) translateX(15px); opacity: 0.8; }
        }
        .particle-1 { width: 60px; height: 60px; top: 20%; left: 10%; animation: float 8s ease-in-out infinite; }
        .particle-2 { width: 40px; height: 40px; top: 60%; left: 80%; animation: float 6s ease-in-out infinite; animation-delay: 1s; }
        .particle-3 { width: 80px; height: 80px; top: 70%; left: 20%; animation: float 10s ease-in-out infinite; animation-delay: 2s; }
        .particle-4 { width: 30px; height: 30px; top: 15%; left: 70%; animation: float 7s ease-in-out infinite; animation-delay: 0.5s; }
        .particle-5 { width: 50px; height: 50px; top: 85%; left: 60%; animation: float 9s ease-in-out infinite; animation-delay: 1.5s; }
        .particle-6 { width: 45px; height: 45px; top: 40%; left: 45%; animation: float 8.5s ease-in-out infinite; animation-delay: 3s; }
        @keyframes glow {
            0%, 100% { box-shadow: 0 0 20px rgba(250, 204, 21, 0.3); }
            50% { box-shadow: 0 0 40px rgba(250, 204, 21, 0.6); }
        }
        .btn-glow { animation: glow 2.5s ease-in-out infinite; }
        @keyframes shimmer {
            0% { background-position: -200% 0; }
            100% { background-position: 200% 0; }
        }
        .shimmer-badge {
            background: linear-gradient(90deg, #ecfdf5 25%, #d1fae5 50%, #ecfdf5 75%);
            background-size: 200% 100%;
            animation: shimmer 3s infinite;
        }
        .lift-card { transition: transform 0.3s ease, box-shadow 0.3s ease; }
        .lift-card:hover { transform: translateY(-8px); box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1); }
        @keyframes pulse-dot {
            0%, 100% { transform: scale(1); opacity: 1; }
            50% { transform: scale(1.5); opacity: 0.5; }
        }
        .pulse-dot { animation: pulse-dot 2s ease-in-out infinite; }
        @keyframes gradient-shift {
            0%, 100% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
        }
        .animated-gradient-text {
            background: linear-gradient(90deg, #34d399, #fbbf24, #34d399);
            background-size: 200% auto;
            -webkit-background-clip: text;
            background-clip: text;
            -webkit-text-fill-color: transparent;
            animation: gradient-shift 4s ease infinite;
        }
        @keyframes bounce-soft {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-6px); }
        }
        .icon-bounce { animation: bounce-soft 2s ease-in-out infinite; }
        @keyframes scroll-bounce {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(10px); }
        }
        .scroll-bounce { animation: scroll-bounce 1.5s ease-in-out infinite; }
        .jadwal-card {
            background: white;
            border-radius: 20px;
            padding: 24px;
            border: 1px solid #f3f4f6;
            box-shadow: 0 1px 3px rgba(0,0,0,0.04);
            position: relative;
            overflow: hidden;
            transition: all 0.3s;
        }
        .jadwal-card::before {
            content: '';
            position: absolute;
            top: 0; left: 0;
            width: 5px; height: 100%;
            background: linear-gradient(180deg, #34d399, #047857);
        }
        .jadwal-card:hover {
            transform: translateY(-6px);
            box-shadow: 0 20px 40px rgba(16, 185, 129, 0.15);
        }
        .umkm-card { transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1); }
        .umkm-card:hover { transform: translateY(-8px); }
        .umkm-card:hover .umkm-img { transform: scale(1.1); }
        .dok-card { transition: all 0.4s ease; }
        .dok-card:hover { transform: translateY(-8px); box-shadow: 0 20px 40px rgba(0,0,0,0.12); }
        .dok-card:hover .dok-img { transform: scale(1.08); }
    </style>
</head>
<body class="bg-white antialiased">

    {{-- NAVBAR --}}
    <nav x-data="{ open: false }" class="bg-white shadow-sm sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6">
            <div class="flex justify-between items-center py-3">
                <a href="{{ route('home') }}" class="flex items-center gap-3">
                    <div class="w-12 h-12 bg-emerald-700 text-white rounded-xl flex items-center justify-center font-bold text-sm">RT</div>
                    <div>
                        <div class="font-bold text-gray-800 text-base leading-tight">Informasi Warga</div>
                        <div class="text-xs text-gray-500 leading-tight">RT 01 - Kampung Digital</div>
                    </div>
                </a>

                <div class="hidden lg:flex items-center gap-1 text-sm">
                    <a href="{{ route('home') }}" class="px-4 py-2 rounded-full bg-emerald-50 text-emerald-700 font-semibold">Beranda</a>

                    <div class="relative group">
                        <button class="px-4 py-2 text-gray-700 hover:text-emerald-700 flex items-center gap-1 rounded-full transition">
                            Tentang Kami
                            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 9l-7 7-7-7"/></svg>
                        </button>
                        <div class="absolute left-0 top-full mt-1 w-56 bg-white shadow-lg rounded-xl py-2 opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-200 border border-gray-100 z-50">
                            <a href="{{ route('profil.rt') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-emerald-50 hover:text-emerald-700 rounded-lg mx-1">Profil RT</a>
                            <a href="{{ route('program.opbm') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-emerald-50 hover:text-emerald-700 rounded-lg mx-1">Program OPBM</a>
                            <a href="{{ route('struktur.publik') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-emerald-50 hover:text-emerald-700 rounded-lg mx-1">Struktur Pengurus</a>
                            <a href="{{ route('warga.opbm') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-emerald-50 hover:text-emerald-700 rounded-lg mx-1">Warga Peserta OPBM</a>
                        </div>
                    </div>

                    <div class="relative group">
                        <button class="px-4 py-2 text-gray-700 hover:text-emerald-700 flex items-center gap-1 rounded-full transition">
                            Layanan
                            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 9l-7 7-7-7"/></svg>
                        </button>
                        <div class="absolute left-0 top-full mt-1 w-60 bg-white shadow-lg rounded-xl py-2 opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-200 border border-gray-100 z-50">
                            <a href="{{ route('umkm.publik') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-emerald-50 hover:text-emerald-700 rounded-lg mx-1">UMKM Warga</a>
                            <a href="{{ route('dokumentasi.publik') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-emerald-50 hover:text-emerald-700 rounded-lg mx-1">Dokumentasi Kegiatan</a>
                            <a href="{{ route('warga.opbm') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-emerald-50 hover:text-emerald-700 rounded-lg mx-1">Warga Peserta OPBM</a>
                            <a href="{{ route('cek.iuran') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-emerald-50 hover:text-emerald-700 rounded-lg mx-1">Cek Iuran</a>
                            <a href="{{ route('bayar.iuran') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-emerald-50 hover:text-emerald-700 rounded-lg mx-1">Bayar Iuran</a>
                        </div>
                    </div>
                </div>

                <div class="flex items-center gap-3">
                    @auth
                        <a href="{{ route('dashboard') }}" class="hidden sm:inline-flex items-center gap-2 bg-emerald-700 hover:bg-emerald-800 text-white px-5 py-2.5 rounded-full font-semibold text-sm transition shadow-sm">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"/></svg>
                            Beranda RT
                        </a>
                    @else
                        <a href="{{ route('login') }}" class="hidden sm:inline-flex items-center gap-2 bg-emerald-700 hover:bg-emerald-800 text-white px-5 py-2.5 rounded-full font-semibold text-sm transition shadow-sm">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/></svg>
                            Login
                        </a>
                    @endauth

                    <button @click="open = !open" class="lg:hidden p-2 text-gray-700">
                        <svg x-show="!open" class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/></svg>
                        <svg x-show="open" class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                    </button>
                </div>
            </div>

            <div x-show="open" x-transition class="lg:hidden pb-4 space-y-1 border-t border-gray-100 pt-3 mt-2">
                <a href="{{ route('home') }}" class="block px-4 py-2 rounded-lg text-sm bg-emerald-50 text-emerald-700 font-semibold">Beranda</a>
                <a href="{{ route('profil.rt') }}" class="block px-4 py-2 rounded-lg text-sm text-gray-700">Profil RT</a>
                <a href="{{ route('program.opbm') }}" class="block px-4 py-2 rounded-lg text-sm text-gray-700">Program OPBM</a>
                <a href="{{ route('umkm.publik') }}" class="block px-4 py-2 rounded-lg text-sm text-gray-700">UMKM Warga</a>
                <a href="{{ route('dokumentasi.publik') }}" class="block px-4 py-2 rounded-lg text-sm text-gray-700">Dokumentasi</a>
                <a href="{{ route('warga.opbm') }}" class="block px-4 py-2 rounded-lg text-sm text-gray-700">Warga Peserta OPBM</a>
                <a href="{{ route('struktur.publik') }}" class="block px-4 py-2 rounded-lg text-sm text-gray-700">Struktur Pengurus</a>
                <a href="{{ route('cek.iuran') }}" class="block px-4 py-2 rounded-lg text-sm text-gray-700">Cek Iuran</a>
                <a href="{{ route('bayar.iuran') }}" class="block px-4 py-2 rounded-lg text-sm text-gray-700">Bayar Iuran</a>
                @auth
                    <a href="{{ route('dashboard') }}" class="block bg-emerald-700 text-white px-4 py-2 rounded-lg font-semibold text-center text-sm mt-2">Beranda RT</a>
                @else
                    <a href="{{ route('login') }}" class="block bg-emerald-700 text-white px-4 py-2 rounded-lg font-semibold text-center text-sm mt-2">Login</a>
                @endauth
            </div>
        </div>
    </nav>

    {{-- HERO --}}
    <section id="hero" x-data="{ images: ['https://images.unsplash.com/photo-1532996122724-e3c354a0b15b?w=1920&q=80','https://images.unsplash.com/photo-1542601906990-b4d3fb778b09?w=1920&q=80','https://images.unsplash.com/photo-1611284446314-60a58ac0deb9?w=1920&q=80','https://images.unsplash.com/photo-1567095761054-7a02e69e5c43?w=1920&q=80'], current: 0, init() { setInterval(() => { this.current = (this.current + 1) % this.images.length; }, 5000); }, goTo(i) { this.current = i; } }" class="relative min-h-screen flex items-center justify-center text-white overflow-hidden">
        <template x-for="(img, index) in images" :key="index">
            <div x-show="current === index" x-transition:enter="transition-opacity duration-1000" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" x-transition:leave="transition-opacity duration-1000" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" class="absolute inset-0 bg-cover bg-center" :style="'background-image: url(' + img + ')'"></div>
        </template>
        <div class="absolute inset-0 bg-black/60"></div>
        <div class="absolute inset-0 bg-gradient-to-b from-black/40 via-transparent to-black/80"></div>

        <div class="particle particle-1"></div>
        <div class="particle particle-2"></div>
        <div class="particle particle-3"></div>
        <div class="particle particle-4"></div>
        <div class="particle particle-5"></div>
        <div class="particle particle-6"></div>

        <div class="relative max-w-5xl mx-auto px-4 sm:px-6 text-center z-10 pt-24 pb-16">
            <div class="inline-block bg-white/10 backdrop-blur-md border border-white/20 px-5 py-2 rounded-full text-xs sm:text-sm font-medium mb-8">
                <span class="inline-block w-2 h-2 bg-emerald-400 rounded-full mr-2 pulse-dot" style="vertical-align: middle;"></span> Perumahan RT 01 - Kota Jambi
            </div>
            <h1 class="text-4xl sm:text-6xl md:text-7xl lg:text-8xl font-extrabold leading-tight mb-6">
                Selamat Datang<br><span class="animated-gradient-text">Warga RT 01</span>
            </h1>
            <p class="text-base sm:text-lg md:text-xl text-gray-200 mb-12 max-w-2xl mx-auto leading-relaxed">
                Kampung Digital OPBM &middot; Kel. Jambi &middot; Kec. Kota Baru &middot; Kota Jambi
            </p>
            <div class="flex flex-col sm:flex-row gap-4 justify-center items-center mb-20">
                @auth
                    <a href="{{ route('dashboard') }}" class="btn-glow group inline-flex items-center gap-3 border-2 border-yellow-400 text-yellow-400 hover:bg-yellow-400 hover:text-emerald-900 px-8 py-4 rounded-full font-bold tracking-wider text-sm transition-all duration-300">
                        MULAI
                        <svg class="w-4 h-4 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                    </a>
                @else
                    <a href="{{ route('login') }}" class="btn-glow group inline-flex items-center gap-3 border-2 border-yellow-400 text-yellow-400 hover:bg-yellow-400 hover:text-emerald-900 px-8 py-4 rounded-full font-bold tracking-wider text-sm transition-all duration-300">
                        MULAI
                        <svg class="w-4 h-4 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                    </a>
                @endauth
            </div>
            <a href="#visi-misi" class="inline-flex flex-col items-center gap-2 text-xs tracking-widest text-gray-300 hover:text-white transition">
                SCROLL
                <svg class="w-5 h-5 scroll-bounce" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3"/></svg>
            </a>
        </div>

        <div class="absolute bottom-8 right-8 flex items-center gap-2 z-10">
            <template x-for="(img, index) in images" :key="index">
                <button @click="goTo(index)" :class="current === index ? 'bg-yellow-400 w-8' : 'bg-white/40 w-2'" class="h-2 rounded-full transition-all duration-300"></button>
            </template>
        </div>
    </section>

    {{-- STATISTIK QUICK --}}
    <section class="bg-emerald-800 text-white py-10">
        <div class="max-w-7xl mx-auto px-4 sm:px-6">
            <div class="grid grid-cols-2 md:grid-cols-4 gap-6 text-center">
                <div class="reveal">
                    <div class="text-3xl md:text-4xl font-extrabold text-yellow-400">{{ $jadwals->count() }}</div>
                    <div class="text-xs md:text-sm text-emerald-100 mt-1">Jadwal Penjemputan</div>
                </div>
                <div class="reveal">
                    <div class="text-3xl md:text-4xl font-extrabold text-yellow-400">{{ $umkms->count() }}+</div>
                    <div class="text-xs md:text-sm text-emerald-100 mt-1">UMKM Warga</div>
                </div>
                <div class="reveal">
                    <div class="text-3xl md:text-4xl font-extrabold text-yellow-400">{{ $dokumentasis->count() }}+</div>
                    <div class="text-xs md:text-sm text-emerald-100 mt-1">Dokumentasi Kegiatan</div>
                </div>
                <div class="reveal">
                    <div class="text-3xl md:text-4xl font-extrabold text-yellow-400">24/7</div>
                    <div class="text-xs md:text-sm text-emerald-100 mt-1">Layanan Online</div>
                </div>
            </div>
        </div>
    </section>

    {{-- BANNER BAYAR IURAN QRIS --}}
    <section class="py-12 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6">
            <div class="rounded-3xl p-8 md:p-12 relative overflow-hidden flex flex-col md:flex-row items-center justify-between gap-8" style="background: linear-gradient(135deg, #047857 0%, #064e3b 100%);">
                <div class="absolute -top-8 -right-8 w-64 h-64 bg-yellow-400/20 rounded-full blur-3xl"></div>
                <div class="relative z-10 text-center md:text-left">
                    <span class="inline-block bg-white/10 backdrop-blur border border-white/20 text-white px-4 py-1.5 rounded-full text-xs font-bold mb-4">
                        💳 Pembayaran Digital
                    </span>
                    <h2 class="text-3xl md:text-4xl font-extrabold text-white mb-3">Bayar Iuran OPBM via QRIS</h2>
                    <p class="text-emerald-100 max-w-xl">Cukup scan dari HP Anda menggunakan M-Banking atau E-Wallet (GoPay, OVO, Dana, dll). Praktis, aman, dan tercatat otomatis.</p>
                </div>
                <div class="relative z-10 flex flex-col sm:flex-row gap-3 w-full md:w-auto">
                    <a href="{{ route('bayar.iuran') }}" class="inline-flex items-center justify-center gap-2 bg-yellow-400 hover:bg-yellow-300 text-emerald-900 px-8 py-4 rounded-full font-bold shadow-lg transition transform hover:-translate-y-1">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v1m6 11h2m-6 0h-2v4m0-11v3m0 0h.01M12 12h4.01M16 20h4M4 12h4m12 0h.01M5 8h2a1 1 0 001-1V5a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1zm14 0h2a1 1 0 001-1V5a1 1 0 00-1-1h-2a1 1 0 00-1 1v2a1 1 0 001 1zM5 20h2a1 1 0 001-1v-2a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1z"/></svg>
                        Bayar Sekarang
                    </a>
                    <a href="{{ route('cek.iuran') }}" class="inline-flex items-center justify-center gap-2 bg-white/10 border-2 border-white text-white hover:bg-white hover:text-emerald-800 px-8 py-4 rounded-full font-bold transition">
                        Cek Status Iuran
                    </a>
                </div>
            </div>
        </div>
    </section>

    {{-- VISI & MISI --}}
    <section id="visi-misi" class="bg-gray-50 py-16 md:py-24">
        <div class="max-w-7xl mx-auto px-4 sm:px-6">
            <div class="text-center mb-12 reveal">
                <span class="inline-block shimmer-badge text-emerald-600 font-bold text-sm uppercase tracking-widest px-4 py-1.5 rounded-full">Visi & Misi</span>
                <h2 class="text-3xl md:text-4xl font-extrabold text-gray-800 mt-4">Visi & Misi RT 01</h2>
                <p class="text-gray-500 mt-3 max-w-2xl mx-auto">Tujuan bersama yang ingin kami capai untuk lingkungan RT 01</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="reveal text-white rounded-3xl p-8 md:p-10 relative overflow-hidden lift-card" style="background: linear-gradient(135deg, #059669 0%, #065f46 100%);">
                    <div class="absolute -top-8 -right-8 w-40 h-40 bg-yellow-400/20 rounded-full blur-3xl"></div>
                    <div class="relative">
                        <div class="inline-flex items-center gap-2 bg-white/15 backdrop-blur border border-white/25 px-4 py-1.5 rounded-full text-xs font-bold uppercase tracking-widest mb-6">
                            <svg class="w-4 h-4 text-yellow-400 icon-bounce" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                            </svg>
                            Visi
                        </div>
                        <div class="mb-5">
                            <svg class="w-16 h-16 text-yellow-400 icon-bounce" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M12 2l2.09 6.26L20.18 9l-5.09 4.14L16.82 20 12 16.77 7.18 20l1.73-6.86L3.82 9l6.09-.74L12 2z"/>
                            </svg>
                        </div>
                        <h3 class="text-2xl md:text-3xl font-extrabold leading-tight mb-4">Menjadi lingkungan yang bersih, aman, dan sejahtera</h3>
                        <p class="text-emerald-50 leading-relaxed">Mewujudkan RT 01 sebagai lingkungan yang harmonis, bersih, aman, nyaman, dan maju — dengan semangat gotong royong, kekeluargaan, dan kebersamaan seluruh warga.</p>
                    </div>
                </div>

                <div class="reveal bg-white rounded-3xl shadow-sm border border-gray-100 p-8 md:p-10 lift-card">
                    <div class="inline-flex items-center gap-2 bg-emerald-50 border border-emerald-100 px-4 py-1.5 rounded-full text-xs font-bold uppercase tracking-widest text-emerald-700 mb-6">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                        </svg>
                        Misi
                    </div>
                    <div class="space-y-5">
                        @php
                            $misi = [
                                ['judul' => 'Mewujudkan Lingkungan Bersih',    'desc' => 'Program OPBM berkelanjutan untuk pengelolaan sampah yang lebih baik.'],
                                ['judul' => 'Meningkatkan Pelayanan Digital',  'desc' => 'Layanan cepat, mudah, dan gratis untuk semua warga melalui website.'],
                                ['judul' => 'Memberdayakan UMKM Warga',        'desc' => 'Mendorong ekonomi lokal dengan promosi usaha warga RT 01.'],
                                ['judul' => 'Membangun Kebersamaan Warga',     'desc' => 'Kegiatan sosial, olahraga, dan keagamaan untuk mempererat silaturahmi.'],
                                ['judul' => 'Mendukung Jambi Smart City',      'desc' => 'Berkontribusi pada program Pemerintah Kota Jambi menuju kota cerdas.'],
                            ];
                        @endphp
                        @foreach($misi as $i => $m)
                        <div class="flex gap-4">
                            <div class="w-10 h-10 rounded-lg bg-emerald-600 text-white font-bold flex items-center justify-center flex-shrink-0">{{ $i + 1 }}</div>
                            <div>
                                <h4 class="font-bold text-gray-800 mb-1">{{ $m['judul'] }}</h4>
                                <p class="text-gray-500 text-sm leading-relaxed">{{ $m['desc'] }}</p>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- LAYANAN --}}
    <section id="layanan" class="py-20 md:py-28 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6">
            <div class="text-center mb-14 reveal">
                <span class="inline-block shimmer-badge text-emerald-600 font-bold text-sm uppercase tracking-widest px-4 py-1.5 rounded-full">Layanan Kami</span>
                <h2 class="text-3xl md:text-4xl font-extrabold text-gray-800 mt-4 mb-4">Layanan Digital RT 01</h2>
                <p class="text-gray-500 max-w-2xl mx-auto">Login untuk mengakses seluruh layanan digital kami</p>
            </div>

            @php
                $layanan = [
                    ['nomor' => '01', 'judul' => 'Jadwal OPBM', 'desc' => 'Lihat jadwal penjemputan sampah di lingkungan RT 01 dengan sistem bentor terintegrasi.', 'warna' => 'emerald', 'icon' => 'M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z'],
                    ['nomor' => '02', 'judul' => 'Pendaftaran', 'desc' => 'Daftar sebagai peserta layanan penjemputan sampah gratis untuk warga RT 01.', 'warna' => 'blue', 'icon' => 'M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z'],
                    ['nomor' => '03', 'judul' => 'Laporan Warga', 'desc' => 'Laporkan masalah sampah dengan cepat dan mudah langsung dari rumah Anda.', 'warna' => 'yellow', 'icon' => 'M11 5.882V19.24a1.76 1.76 0 01-3.417.592l-2.147-6.15M18 13a3 3 0 100-6M5.436 13.683A4.001 4.001 0 017 6h1.832c4.1 0 7.625-1.234 9.168-3v14c-1.543-1.766-5.067-3-9.168-3H7a3.988 3.988 0 01-1.564-.317z'],
                    ['nomor' => '04', 'judul' => 'UMKM Warga', 'desc' => 'Direktori usaha warga RT 01 yang bisa dihubungi langsung via WhatsApp.', 'warna' => 'purple', 'icon' => 'M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z'],
                ];
            @endphp

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                @foreach($layanan as $l)
                <a href="{{ route('login') }}" class="reveal group relative bg-white border-2 border-gray-100 rounded-2xl p-6 transition-all duration-300 overflow-hidden lift-card">
                    <div class="absolute -top-4 -right-2 text-8xl font-black select-none pointer-events-none transition-all duration-300 group-hover:scale-110" style="color: rgba(16, 185, 129, 0.06); line-height: 1;">{{ $l['nomor'] }}</div>
                    <div class="w-14 h-14 bg-{{ $l['warna'] }}-100 text-{{ $l['warna'] }}-600 rounded-2xl flex items-center justify-center mb-5 relative z-10 transition-all duration-300 group-hover:scale-110 group-hover:rotate-6">
                        <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $l['icon'] }}"/></svg>
                    </div>
                    <div class="flex items-center justify-between mb-2 relative z-10">
                        <h3 class="font-bold text-lg text-gray-800 group-hover:text-emerald-700 transition">{{ $l['judul'] }}</h3>
                        <div class="w-6 h-6 rounded-full bg-emerald-50 group-hover:bg-emerald-600 flex items-center justify-center transition-all duration-300 group-hover:translate-x-1">
                            <svg class="w-3.5 h-3.5 text-emerald-600 group-hover:text-white transition" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                        </div>
                    </div>
                    <p class="text-gray-500 text-sm leading-relaxed relative z-10">{{ $l['desc'] }}</p>
                    <div class="mt-5 pt-4 border-t border-gray-100 relative z-10 flex items-center gap-2">
                        <svg class="w-3.5 h-3.5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/></svg>
                        <span class="text-xs text-gray-400 font-semibold">Perlu login untuk akses</span>
                    </div>
                    <div class="absolute inset-0 opacity-0 group-hover:opacity-100 transition-opacity duration-300 pointer-events-none" style="background: linear-gradient(135deg, rgba(16, 185, 129, 0.03) 0%, rgba(16, 185, 129, 0.08) 100%);"></div>
                </a>
                @endforeach
            </div>
        </div>
    </section>

    {{-- JADWAL --}}
    <section class="py-20 md:py-28 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6">
            <div class="text-center mb-14 reveal">
                <span class="inline-block shimmer-badge text-emerald-600 font-bold text-sm uppercase tracking-widest px-4 py-1.5 rounded-full">Jadwal Rutin</span>
                <h2 class="text-3xl md:text-4xl font-extrabold text-gray-800 mt-4 mb-4">Jadwal Penjemputan Sampah</h2>
                <p class="text-gray-500 max-w-2xl mx-auto">Bentor OPBM akan menjemput sampah sesuai jadwal berikut</p>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                @forelse($jadwals as $j)
                @php
                    $hariColors = [
                        'Senin' => 'from-emerald-400 to-emerald-600',
                        'Selasa' => 'from-blue-400 to-blue-600',
                        'Rabu' => 'from-yellow-400 to-yellow-600',
                        'Kamis' => 'from-purple-400 to-purple-600',
                        'Jumat' => 'from-pink-400 to-pink-600',
                        'Sabtu' => 'from-orange-400 to-orange-600',
                        'Minggu' => 'from-red-400 to-red-600',
                    ];
                    $gradient = $hariColors[$j->hari] ?? 'from-emerald-400 to-emerald-600';
                @endphp
                <div class="reveal jadwal-card lift-card">
                    <div class="flex justify-between items-start mb-5">
                        <div class="flex items-center gap-3">
                            <div class="w-14 h-14 rounded-2xl bg-gradient-to-br {{ $gradient }} flex items-center justify-center text-white font-extrabold text-xl shadow-lg">
                                {{ substr($j->hari, 0, 2) }}
                            </div>
                            <div>
                                <h3 class="font-extrabold text-xl text-gray-800">{{ $j->hari }}</h3>
                                <p class="text-xs text-gray-500">Hari Penjemputan</p>
                            </div>
                        </div>
                        <span class="bg-emerald-100 text-emerald-700 text-xs font-bold px-3 py-1 rounded-full">{{ $j->zona }}</span>
                    </div>
                    <div class="bg-gradient-to-br from-emerald-50 to-white rounded-xl p-4 mb-4 border border-emerald-100">
                        <div class="flex items-center gap-2">
                            <svg class="w-5 h-5 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            <div>
                                <p class="text-xs text-gray-500">Jam Penjemputan</p>
                                <p class="font-bold text-gray-800 text-sm">{{ $j->jam_mulai }} - {{ $j->jam_selesai }}</p>
                            </div>
                        </div>
                    </div>
                    @if($j->keterangan)
                    <div class="flex items-start gap-2 text-gray-600">
                        <svg class="w-4 h-4 text-gray-400 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                        </svg>
                        <span class="text-sm">{{ $j->keterangan }}</span>
                    </div>
                    @endif
                </div>
                @empty
                <div class="col-span-3 text-center text-gray-400 py-8">Belum ada jadwal.</div>
                @endforelse
            </div>
        </div>
    </section>

    {{-- UMKM --}}
    <section class="py-20 md:py-28 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6">
            <div class="flex justify-between items-end mb-10 reveal flex-wrap gap-3">
                <div>
                    <span class="inline-block shimmer-badge text-emerald-600 font-bold text-sm uppercase tracking-widest px-4 py-1.5 rounded-full">Ekonomi Warga</span>
                    <h2 class="text-3xl md:text-4xl font-extrabold text-gray-800 mt-4 mb-2">UMKM RT 01</h2>
                    <p class="text-gray-500 text-sm">Dukung usaha warga dengan berbelanja langsung</p>
                </div>
                <a href="{{ route('umkm.publik') }}" class="inline-flex items-center gap-1 text-emerald-600 hover:text-emerald-700 font-bold text-sm whitespace-nowrap">
                    Lihat Semua
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                </a>
            </div>

            @php
                $kategoriIcon = ['Makanan' => '🍜', 'Minuman' => '☕', 'Jasa' => '🛠️', 'Fashion' => '👕', 'Elektronik' => '📱', 'Lainnya' => '📦'];
                $gambarFallback = [
                    'Makanan' => 'https://images.unsplash.com/photo-1504674900247-0877df9cc836?w=800&q=80',
                    'Minuman' => 'https://images.unsplash.com/photo-1544145945-f90425340c7e?w=800&q=80',
                    'Jasa' => 'https://images.unsplash.com/photo-1556905055-8f358a7a47b2?w=800&q=80',
                    'Fashion' => 'https://images.unsplash.com/photo-1441986300917-64674bd600d8?w=800&q=80',
                    'Elektronik' => 'https://images.unsplash.com/photo-1498049794561-7780e7231661?w=800&q=80',
                    'Lainnya' => 'https://images.unsplash.com/photo-1556742049-0cfed4f6a45d?w=800&q=80',
                ];
            @endphp

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                @forelse($umkms as $u)
                @php
                    $imgSrc = $u->foto_produk ? asset('storage/' . $u->foto_produk) : ($gambarFallback[$u->kategori] ?? $gambarFallback['Lainnya']);
                    $icon = $kategoriIcon[$u->kategori] ?? '📦';
                @endphp
                <a href="{{ route('umkm.publik.show', $u) }}" class="reveal umkm-card group bg-white rounded-2xl overflow-hidden border border-gray-100 shadow-sm hover:shadow-2xl">
                    <div class="relative h-52 overflow-hidden">
                        <img src="{{ $imgSrc }}" alt="{{ $u->nama_usaha }}" class="umkm-img w-full h-full object-cover transition-transform duration-700">
                        <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-transparent to-transparent"></div>
                        <div class="absolute top-3 left-3 flex items-center gap-2 bg-white/95 backdrop-blur px-3 py-1.5 rounded-full shadow-md">
                            <span class="text-sm">{{ $icon }}</span>
                            <span class="text-xs font-bold text-gray-800">{{ $u->kategori }}</span>
                        </div>
                        @if($u->no_wa)
                        <div class="absolute top-3 right-3 bg-emerald-500 text-white px-2.5 py-1 rounded-full text-xs font-bold shadow-lg flex items-center gap-1">
                            <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 24 24"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413Z"/></svg>
                            WA
                        </div>
                        @endif
                    </div>
                    <div class="p-5">
                        <h3 class="font-bold text-lg text-gray-800 group-hover:text-emerald-700 transition">{{ $u->nama_usaha }}</h3>
                        <p class="text-gray-500 text-sm mt-1 flex items-center gap-1">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                            {{ $u->pemilik }}
                        </p>
                        <div class="mt-4 pt-4 border-t border-gray-100 flex items-center justify-between">
                            <span class="text-xs text-gray-400 font-semibold">Lihat detail →</span>
                            <div class="w-8 h-8 rounded-full bg-emerald-50 group-hover:bg-emerald-600 flex items-center justify-center transition-all duration-300 group-hover:scale-110">
                                <svg class="w-4 h-4 text-emerald-600 group-hover:text-white transition" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                            </div>
                        </div>
                    </div>
                </a>
                @empty
                <p class="col-span-3 text-center text-gray-400 py-8">Belum ada UMKM terdaftar.</p>
                @endforelse
            </div>
        </div>
    </section>

    {{-- DOKUMENTASI --}}
    <section class="py-20 md:py-28 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6">
            <div class="flex justify-between items-end mb-10 reveal flex-wrap gap-3">
                <div>
                    <span class="inline-block shimmer-badge text-emerald-600 font-bold text-sm uppercase tracking-widest px-4 py-1.5 rounded-full">Galeri Kegiatan</span>
                    <h2 class="text-3xl md:text-4xl font-extrabold text-gray-800 mt-4 mb-2">Dokumentasi RT 01</h2>
                    <p class="text-gray-500 text-sm">Momen dan kegiatan warga dalam bingkai foto</p>
                </div>
                <a href="{{ route('dokumentasi.publik') }}" class="inline-flex items-center gap-1 text-emerald-600 hover:text-emerald-700 font-bold text-sm whitespace-nowrap">
                    Lihat Semua
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                </a>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                @forelse($dokumentasis as $d)
                <a href="{{ route('dokumentasi.publik.show', $d) }}" class="reveal dok-card group bg-white rounded-2xl overflow-hidden border border-gray-100 shadow-sm">
                    <div class="relative h-52 overflow-hidden">
                        @if($d->foto)
                            <img src="{{ asset('storage/' . $d->foto) }}" class="dok-img w-full h-full object-cover transition-transform duration-700">
                        @else
                            <div class="w-full h-full bg-gradient-to-br from-yellow-100 to-yellow-200 flex items-center justify-center">
                                <span class="text-yellow-700 font-bold text-xl">Dokumentasi</span>
                            </div>
                        @endif
                        <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-black/20 to-transparent"></div>
                        <div class="absolute top-3 left-3 bg-white/95 backdrop-blur px-3 py-1.5 rounded-full shadow-md">
                            <p class="text-xs font-bold text-gray-800 flex items-center gap-1">
                                <svg class="w-3 h-3 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                                {{ \Carbon\Carbon::parse($d->tanggal_kegiatan)->format('d M Y') }}
                            </p>
                        </div>
                        @if($d->lokasi)
                        <div class="absolute top-3 right-3 bg-emerald-500 text-white px-2.5 py-1 rounded-full text-xs font-bold shadow-lg flex items-center gap-1 max-w-[140px]">
                            <svg class="w-3 h-3 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/></svg>
                            <span class="truncate">{{ $d->lokasi }}</span>
                        </div>
                        @endif
                        <div class="absolute bottom-3 left-3 right-3">
                            <h3 class="font-bold text-white text-lg leading-tight drop-shadow-lg">{{ $d->judul }}</h3>
                        </div>
                    </div>
                    <div class="p-5">
                        <p class="text-gray-500 text-sm leading-relaxed">{{ \Illuminate\Support\Str::limit($d->deskripsi, 100) }}</p>
                        <div class="mt-4 pt-4 border-t border-gray-100 flex items-center justify-between">
                            <span class="text-xs text-gray-400 font-semibold">Baca selengkapnya →</span>
                            <div class="w-8 h-8 rounded-full bg-emerald-50 group-hover:bg-emerald-600 flex items-center justify-center transition-all duration-300 group-hover:scale-110">
                                <svg class="w-4 h-4 text-emerald-600 group-hover:text-white transition" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                            </div>
                        </div>
                    </div>
                </a>
                @empty
                <p class="col-span-3 text-center text-gray-400 py-8">Belum ada dokumentasi.</p>
                @endforelse
            </div>
        </div>
    </section>

    {{-- FOOTER --}}
    <footer class="bg-gray-900 text-gray-400 py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6">
            <div class="grid md:grid-cols-3 gap-8 mb-8">
                <div>
                    <div class="flex items-center gap-2 text-white mb-3">
                        <div class="w-9 h-9 bg-emerald-600 rounded-lg flex items-center justify-center font-bold text-white">RT</div>
                        <span class="font-bold">OPBM RT 01</span>
                    </div>
                    <p class="text-sm leading-relaxed">Sistem pengelolaan sampah berbasis masyarakat untuk Kota Jambi Bahagia.</p>
                </div>
                <div>
                    <h4 class="text-white font-semibold mb-3">Navigasi</h4>
                    <ul class="space-y-2 text-sm">
                        <li><a href="{{ route('home') }}" class="hover:text-emerald-400 transition">Beranda</a></li>
                        <li><a href="{{ route('umkm.publik') }}" class="hover:text-emerald-400 transition">UMKM</a></li>
                        <a href="{{ route('dokumentasi.publik') }}" class="hover:text-emerald-400 transition">Dokumentasi</a>
                        <li><a href="{{ route('warga.opbm') }}" class="hover:text-emerald-400 transition">Warga OPBM</a></li>
                        <li><a href="{{ route('cek.iuran') }}" class="hover:text-emerald-400 transition">Cek Iuran</a></li>
                        <li><a href="{{ route('bayar.iuran') }}" class="hover:text-emerald-400 transition">Bayar Iuran</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="text-white font-semibold mb-3">Program</h4>
                    <p class="text-sm leading-relaxed">Kompetisi Kampung Digital 2026<br>Jambi Smart City Fest</p>
                </div>
            </div>
            <div class="border-t border-gray-800 pt-6 text-center text-sm">
                &copy; {{ date('Y') }} Kampung Digital OPBM RT 01 - Kota Jambi Bahagia
            </div>
        </div>
    </footer>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const reveals = document.querySelectorAll('.reveal');
            const observer = new IntersectionObserver((entries) => {
                entries.forEach((entry, index) => {
                    if (entry.isIntersecting) {
                        setTimeout(() => { entry.target.classList.add('active'); }, index * 100);
                        observer.unobserve(entry.target);
                    }
                });
            }, { threshold: 0.15, rootMargin: '0px 0px -50px 0px' });
            reveals.forEach(el => observer.observe(el));
        });
    </script>

</body>
</html>