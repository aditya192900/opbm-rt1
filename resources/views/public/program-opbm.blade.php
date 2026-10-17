<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Program OPBM - Kampung Digital RT 01</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        html { scroll-behavior: smooth; }
        .reveal { opacity: 0; transform: translateY(30px); transition: opacity 0.8s ease-out, transform 0.8s ease-out; }
        .reveal.active { opacity: 1; transform: translateY(0); }
        .particle { position: absolute; background: rgba(255, 255, 255, 0.15); border-radius: 50%; pointer-events: none; }
        @keyframes float { 0%, 100% { transform: translateY(0); opacity: 0.4; } 50% { transform: translateY(-30px); opacity: 0.8; } }
        .particle-1 { width: 60px; height: 60px; top: 20%; left: 10%; animation: float 8s ease-in-out infinite; }
        .particle-2 { width: 40px; height: 40px; top: 60%; left: 80%; animation: float 6s ease-in-out infinite; animation-delay: 1s; }
        .particle-3 { width: 80px; height: 80px; top: 70%; left: 20%; animation: float 10s ease-in-out infinite; animation-delay: 2s; }
        .particle-4 { width: 30px; height: 30px; top: 15%; left: 70%; animation: float 7s ease-in-out infinite; animation-delay: 0.5s; }
        .card-gradient-emerald { background: linear-gradient(135deg, #10b981 0%, #047857 100%); }
        .card-gradient-blue    { background: linear-gradient(135deg, #3b82f6 0%, #1e40af 100%); }
        .card-gradient-yellow  { background: linear-gradient(135deg, #f59e0b 0%, #b45309 100%); }
        .card-gradient-purple  { background: linear-gradient(135deg, #8b5cf6 0%, #6d28d9 100%); }
        .card-gradient-red     { background: linear-gradient(135deg, #ef4444 0%, #b91c1c 100%); }
        .card-gradient-cyan    { background: linear-gradient(135deg, #06b6d4 0%, #0e7490 100%); }
        .lift-card { transition: transform 0.3s, box-shadow 0.3s; }
        .lift-card:hover { transform: translateY(-8px); box-shadow: 0 20px 40px rgba(0,0,0,0.1); }
        @keyframes pulse-dot { 0%, 100% { transform: scale(1); opacity: 1; } 50% { transform: scale(1.5); opacity: 0.5; } }
        .pulse-dot { animation: pulse-dot 2s ease-in-out infinite; }
        @keyframes shimmer { 0% { background-position: -200% 0; } 100% { background-position: 200% 0; } }
        .shimmer-badge { background: linear-gradient(90deg, #ecfdf5 25%, #d1fae5 50%, #ecfdf5 75%); background-size: 200% 100%; animation: shimmer 3s infinite; }
        @keyframes btn-glow {
            0%, 100% { box-shadow: 0 10px 30px rgba(251, 191, 36, 0.4); }
            50% { box-shadow: 0 10px 40px rgba(251, 191, 36, 0.7); }
        }
        .btn-glow { animation: btn-glow 2.5s ease-in-out infinite; }
    </style>
</head>
<body class="bg-gray-50 antialiased">

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
                    <a href="{{ route('home') }}" class="px-4 py-2 text-gray-700 hover:text-emerald-700 rounded-full transition">Beranda</a>
                    <a href="{{ route('profil.rt') }}" class="px-4 py-2 text-gray-700 hover:text-emerald-700 rounded-full transition">Profil RT</a>
                    <a href="{{ route('program.opbm') }}" class="px-4 py-2 rounded-full bg-emerald-50 text-emerald-700 font-semibold">Program OPBM</a>
                    <a href="{{ route('warga.opbm') }}" class="px-4 py-2 text-gray-700 hover:text-emerald-700 rounded-full transition">Warga OPBM</a>
                    <a href="{{ route('struktur.publik') }}" class="px-4 py-2 text-gray-700 hover:text-emerald-700 rounded-full transition">Struktur</a>
                </div>
                <div class="flex items-center gap-3">
                    @auth
                        <a href="{{ route('dashboard') }}" class="hidden sm:inline-flex bg-emerald-700 hover:bg-emerald-800 text-white px-5 py-2.5 rounded-full font-semibold text-sm transition shadow-sm">Beranda RT</a>
                    @else
                        <a href="{{ route('login') }}" class="hidden sm:inline-flex bg-emerald-700 hover:bg-emerald-800 text-white px-5 py-2.5 rounded-full font-semibold text-sm transition shadow-sm">Login</a>
                    @endauth
                    <button @click="open = !open" class="lg:hidden p-2 text-gray-700">
                        <svg x-show="!open" class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/></svg>
                        <svg x-show="open" class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                    </button>
                </div>
            </div>
            <div x-show="open" x-transition class="lg:hidden pb-4 space-y-1 border-t border-gray-100 pt-3 mt-2">
                <a href="{{ route('home') }}" class="block px-4 py-2 rounded-lg text-sm text-gray-700">Beranda</a>
                <a href="{{ route('profil.rt') }}" class="block px-4 py-2 rounded-lg text-sm text-gray-700">Profil RT</a>
                <a href="{{ route('program.opbm') }}" class="block px-4 py-2 rounded-lg text-sm bg-emerald-50 text-emerald-700 font-semibold">Program OPBM</a>
                <a href="{{ route('warga.opbm') }}" class="block px-4 py-2 rounded-lg text-sm text-gray-700">Warga OPBM</a>
                <a href="{{ route('struktur.publik') }}" class="block px-4 py-2 rounded-lg text-sm text-gray-700">Struktur</a>
            </div>
        </div>
    </nav>

    {{-- HERO --}}
    <section class="relative text-white py-24 overflow-hidden" style="background: linear-gradient(135deg, #047857 0%, #064e3b 100%);">
        <div class="absolute inset-0 opacity-10">
            <div class="absolute -top-24 -left-24 w-96 h-96 bg-white rounded-full blur-3xl"></div>
            <div class="absolute -bottom-24 -right-24 w-96 h-96 bg-yellow-300 rounded-full blur-3xl"></div>
        </div>
        <div class="particle particle-1"></div>
        <div class="particle particle-2"></div>
        <div class="particle particle-3"></div>
        <div class="particle particle-4"></div>
        <div class="relative max-w-5xl mx-auto px-4 sm:px-6 text-center">
            <div class="inline-flex items-center gap-2 bg-white/10 backdrop-blur border border-white/20 px-5 py-2 rounded-full text-xs font-medium mb-6">
                <span class="inline-block w-2 h-2 bg-emerald-400 rounded-full pulse-dot"></span>
                Edukasi Warga
            </div>
            <h1 class="text-4xl md:text-6xl font-extrabold mb-6 leading-tight">
                Mengenal Program <span class="text-yellow-400">OPBM</span>
            </h1>
            <p class="text-lg md:text-xl text-emerald-100 max-w-3xl mx-auto leading-relaxed mb-8">
                Operator Pengumpul Sampah Berbasis Masyarakat — Program unggulan Pemerintah Kota Jambi untuk pengelolaan sampah yang lebih baik
            </p>

            {{-- TOMBOL CTA DI HERO --}}
            <div class="flex flex-col sm:flex-row gap-4 justify-center items-center">
                <a href="{{ route('daftar.opbm') }}"
                   class="btn-glow group inline-flex items-center gap-3 text-emerald-900 px-8 py-4 rounded-full font-bold shadow-2xl transition-all duration-300 hover:scale-105"
                   style="background: linear-gradient(90deg, #fbbf24 0%, #f59e0b 100%);">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                    </svg>
                    Daftar Sekarang
                    <svg class="w-4 h-4 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M14 5l7 7m0 0l-7 7m7-7H3"/>
                    </svg>
                </a>

                <a href="{{ route('warga.opbm') }}"
                   class="inline-flex items-center gap-2 bg-white/10 border-2 border-white text-white px-8 py-4 rounded-full font-bold hover:bg-white hover:text-emerald-800 transition">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                    </svg>
                    Lihat Peserta
                </a>
            </div>

            {{-- Info Cepat --}}
            <div class="mt-10 flex flex-wrap gap-6 justify-center text-xs md:text-sm text-emerald-100">
                <div class="flex items-center gap-2">
                    <svg class="w-4 h-4 text-yellow-400" fill="currentColor" viewBox="0 0 20 20"><path d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"/></svg>
                    100% Gratis
                </div>
                <div class="flex items-center gap-2">
                    <svg class="w-4 h-4 text-yellow-400" fill="currentColor" viewBox="0 0 20 20"><path d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"/></svg>
                    Cukup 4 Data Saja
                </div>
                <div class="flex items-center gap-2">
                    <svg class="w-4 h-4 text-yellow-400" fill="currentColor" viewBox="0 0 20 20"><path d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"/></svg>
                    Tanpa NIK/KK
                </div>
            </div>
        </div>
    </section>

    {{-- PENGERTIAN --}}
    <section class="max-w-7xl mx-auto px-4 sm:px-6 py-20">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-10 items-center">
            <div class="reveal">
                <span class="inline-block shimmer-badge text-emerald-600 font-bold text-sm uppercase tracking-widest px-4 py-1.5 rounded-full">Pengertian</span>
                <h2 class="text-3xl md:text-4xl font-extrabold text-gray-800 mt-4 mb-6">Apa itu OPBM?</h2>
                <div class="text-gray-700 leading-relaxed space-y-4">
                    <p><strong class="text-emerald-700">OPBM (Operator Pengumpul Sampah Berbasis Masyarakat)</strong> adalah program Pemerintah Kota Jambi di bawah kepemimpinan Wali Kota Maulana untuk mengatasi permasalahan sampah dengan pendekatan yang lebih modern dan partisipatif.</p>
                    <p>Berbeda dari sistem lama yang mengandalkan TPS (Tempat Pembuangan Sementara), OPBM menerapkan sistem <strong>penjemputan langsung dari rumah ke rumah</strong> menggunakan bentor menuju depo transfer.</p>
                    <p>Dengan sistem ini, TPS liar secara bertahap akan ditutup, lingkungan menjadi lebih bersih, dan warga terlibat aktif menjaga kebersihan.</p>
                </div>
            </div>
            <div class="reveal bg-white rounded-3xl shadow-lg border border-gray-100 p-8 text-center lift-card">
                <div class="w-24 h-24 rounded-full mx-auto mb-5 flex items-center justify-center card-gradient-emerald">
                    <svg class="w-12 h-12 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                </div>
                <h3 class="font-bold text-2xl text-gray-800 mb-3">OPBM di RT 01</h3>
                <p class="text-gray-600 leading-relaxed mb-6">Program OPBM di lingkungan RT 01 Kampung Digital dilaksanakan untuk mendukung terwujudnya Kota Jambi Bahagia.</p>
                <div style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 12px;">
                    <div class="bg-emerald-50 rounded-xl p-3">
                        <p class="text-2xl font-bold text-emerald-600">100%</p>
                        <p class="text-xs text-gray-500">Gratis</p>
                    </div>
                    <div class="bg-blue-50 rounded-xl p-3">
                        <p class="text-2xl font-bold text-blue-600">3x</p>
                        <p class="text-xs text-gray-500">Per Minggu</p>
                    </div>
                    <div class="bg-yellow-50 rounded-xl p-3">
                        <p class="text-2xl font-bold text-yellow-600">24/7</p>
                        <p class="text-xs text-gray-500">Laporan</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- MANFAAT --}}
    <section class="bg-white py-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6">
            <div class="text-center mb-14 reveal">
                <span class="inline-block shimmer-badge text-emerald-600 font-bold text-sm uppercase tracking-widest px-4 py-1.5 rounded-full">Manfaat</span>
                <h2 class="text-3xl md:text-4xl font-extrabold text-gray-800 mt-4">Keuntungan Program OPBM</h2>
            </div>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-5">
                @php
                    $manfaat = [
                        ['gradient' => 'card-gradient-emerald', 'judul' => 'Lingkungan Bersih', 'desc' => 'Sampah diangkut rutin dari rumah, tidak ada penumpukan lagi di jalan'],
                        ['gradient' => 'card-gradient-blue', 'judul' => 'Gratis 100%', 'desc' => 'Layanan penjemputan sampah GRATIS untuk seluruh warga RT 01'],
                        ['gradient' => 'card-gradient-yellow', 'judul' => 'Warga Sehat', 'desc' => 'Mengurangi risiko penyakit akibat sampah menumpuk dan bau'],
                        ['gradient' => 'card-gradient-purple', 'judul' => 'Pengelolaan Modern', 'desc' => 'Sistem penjemputan langsung pakai bentor, tanpa TPS liar'],
                        ['gradient' => 'card-gradient-cyan', 'judul' => 'Lapor Online', 'desc' => 'Warga bisa laporkan masalah sampah melalui website 24/7'],
                        ['gradient' => 'card-gradient-red', 'judul' => 'Bebas Bau', 'desc' => 'Tidak ada lagi bau tidak sedap dari tumpukan sampah di gang'],
                    ];
                @endphp
                @foreach($manfaat as $m)
                <div class="reveal bg-white rounded-2xl shadow-sm border border-gray-100 p-6 lift-card">
                    <div class="w-12 h-12 rounded-lg mb-4 flex items-center justify-center {{ $m['gradient'] }}">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>
                    </div>
                    <h3 class="font-bold text-lg text-gray-800 mb-2">{{ $m['judul'] }}</h3>
                    <p class="text-gray-500 text-sm leading-relaxed">{{ $m['desc'] }}</p>
                </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- CARA KERJA --}}
    <section class="py-20" style="background-color: #ecfdf5;">
        <div class="max-w-7xl mx-auto px-4 sm:px-6">
            <div class="text-center mb-14 reveal">
                <span class="inline-block shimmer-badge text-emerald-600 font-bold text-sm uppercase tracking-widest px-4 py-1.5 rounded-full">Cara Kerja</span>
                <h2 class="text-3xl md:text-4xl font-extrabold text-gray-800 mt-4">Bagaimana OPBM Bekerja?</h2>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
                @php
                    $tahapan = [
                        ['no' => '1', 'gradient' => 'card-gradient-emerald', 'judul' => 'Warga Pilah Sampah', 'desc' => 'Sampah dipisahkan menjadi organik, anorganik, dan B3 di rumah'],
                        ['no' => '2', 'gradient' => 'card-gradient-blue', 'judul' => 'Bentor Jemput', 'desc' => 'Petugas OPBM menjemput sampah sesuai jadwal rutin'],
                        ['no' => '3', 'gradient' => 'card-gradient-yellow', 'judul' => 'Depo Transfer', 'desc' => 'Sampah dibawa ke depo untuk dipilah lebih lanjut'],
                        ['no' => '4', 'gradient' => 'card-gradient-purple', 'judul' => 'Pengolahan Akhir', 'desc' => 'Organik jadi kompos, anorganik didaur ulang, B3 ditangani khusus'],
                    ];
                @endphp
                @foreach($tahapan as $t)
                <div class="reveal bg-white rounded-2xl p-6 text-center shadow-sm lift-card">
                    <div class="w-16 h-16 rounded-full mx-auto mb-4 flex items-center justify-center text-white font-bold text-2xl {{ $t['gradient'] }}">{{ $t['no'] }}</div>
                    <h3 class="font-bold text-lg text-gray-800 mb-2">{{ $t['judul'] }}</h3>
                    <p class="text-gray-500 text-sm">{{ $t['desc'] }}</p>
                </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- JENIS SAMPAH --}}
    <section class="bg-white py-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6">
            <div class="text-center mb-14 reveal">
                <span class="inline-block shimmer-badge text-emerald-600 font-bold text-sm uppercase tracking-widest px-4 py-1.5 rounded-full">Edukasi</span>
                <h2 class="text-3xl md:text-4xl font-extrabold text-gray-800 mt-4">Jenis-Jenis Sampah</h2>
            </div>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                @php
                    $jenis = [
                        ['nama' => 'Organik', 'icon' => 'M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z', 'warna' => '#22c55e', 'list' => ['Sisa makanan', 'Daun & ranting', 'Kulit buah & sayur']],
                        ['nama' => 'Anorganik', 'icon' => 'M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4', 'warna' => '#3b82f6', 'list' => ['Plastik & botol', 'Kaleng & logam', 'Kertas & kardus']],
                        ['nama' => 'Kertas', 'icon' => 'M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z', 'warna' => '#f59e0b', 'list' => ['Koran & majalah', 'Kardus bekas', 'Kertas HVS']],
                        ['nama' => 'B3', 'icon' => 'M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z', 'warna' => '#ef4444', 'list' => ['Baterai bekas', 'Lampu & bohlam', 'Obat kadaluarsa']],
                    ];
                @endphp
                @foreach($jenis as $j)
                <div class="reveal rounded-3xl overflow-hidden shadow-sm border border-gray-100 lift-card bg-white">
                    <div class="h-32 flex items-center justify-center" style="background: linear-gradient(135deg, {{ $j['warna'] }} 0%, {{ $j['warna'] }}cc 100%);">
                        <svg class="w-16 h-16 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $j['icon'] }}"/></svg>
                    </div>
                    <div class="p-5">
                        <h3 class="font-bold text-lg text-gray-800 mb-3">{{ $j['nama'] }}</h3>
                        <ul class="text-xs text-gray-600 space-y-1">
                            @foreach($j['list'] as $item)
                            <li>• {{ $item }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- JADWAL --}}
    @if(isset($jadwals) && $jadwals->count() > 0)
    <section class="bg-gray-50 py-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6">
            <div class="text-center mb-14 reveal">
                <span class="inline-block shimmer-badge text-emerald-600 font-bold text-sm uppercase tracking-widest px-4 py-1.5 rounded-full">Jadwal Rutin</span>
                <h2 class="text-3xl md:text-4xl font-extrabold text-gray-800 mt-4">Kapan Sampah Dijemput?</h2>
            </div>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 max-w-5xl mx-auto">
                @foreach($jadwals as $j)
                <div class="reveal bg-white rounded-2xl p-5 border-l-4 border-emerald-500 lift-card">
                    <div class="flex justify-between items-center mb-2">
                        <h3 class="font-extrabold text-lg text-emerald-700">{{ $j->hari }}</h3>
                        <span class="bg-emerald-100 text-emerald-700 text-xs font-semibold px-2 py-0.5 rounded-full">{{ $j->zona }}</span>
                    </div>
                    <p class="text-sm font-semibold text-gray-800 flex items-center gap-2">
                        <svg class="w-4 h-4 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        {{ $j->jam_mulai }} - {{ $j->jam_selesai }}
                    </p>
                    @if($j->keterangan)
                    <p class="text-xs text-gray-500 mt-2">{{ $j->keterangan }}</p>
                    @endif
                </div>
                @endforeach
            </div>
        </div>
    </section>
    @endif

    {{-- FAQ --}}
    <section class="max-w-4xl mx-auto px-4 sm:px-6 py-20">
        <div class="text-center mb-14 reveal">
            <span class="inline-block shimmer-badge text-emerald-600 font-bold text-sm uppercase tracking-widest px-4 py-1.5 rounded-full">FAQ</span>
            <h2 class="text-3xl md:text-4xl font-extrabold text-gray-800 mt-4">Pertanyaan Umum</h2>
        </div>
        <div class="space-y-3" x-data="{ open: null }">
            @php
                $faqs = [
                    ['q' => 'Apakah program OPBM ini berbayar?', 'a' => 'Tidak. Program OPBM 100% GRATIS untuk seluruh warga RT 01 yang telah mendaftar. Tidak ada biaya apapun.'],
                    ['q' => 'Bagaimana cara mendaftar program OPBM?', 'a' => 'Klik tombol "Daftar Sekarang" di halaman ini, isi 4 data (nama, WA, alamat, blok), lalu kirim. Pengurus RT akan menghubungi Anda untuk verifikasi.'],
                    ['q' => 'Apakah sampah harus dipilah dulu sebelum dijemput?', 'a' => 'Sangat dianjurkan. Sampah yang sudah dipilah (organik, anorganik, B3) mempermudah proses pengelolaan.'],
                    ['q' => 'Kapan sampah dijemput?', 'a' => 'Sesuai jadwal yang tertera. Sampah dijemput menggunakan bentor OPBM. Pastikan sampah sudah di depan portal masuk pada jam yang ditentukan.'],
                    ['q' => 'Bagaimana cara melaporkan masalah sampah?', 'a' => 'Login ke website, buka menu Laporan, isi formulir. Anda bisa melampirkan foto sebagai bukti.'],
                ];
            @endphp
            @foreach($faqs as $i => $faq)
            <div class="reveal bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
                <button @click="open = open === {{ $i }} ? null : {{ $i }}" class="w-full text-left px-6 py-5 flex justify-between items-center hover:bg-emerald-50/50 transition">
                    <span class="font-bold text-gray-800 pr-4">{{ $faq['q'] }}</span>
                    <svg :class="open === {{ $i }} ? 'rotate-180' : ''" class="w-5 h-5 text-emerald-600 transition-transform flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                </button>
                <div x-show="open === {{ $i }}" x-collapse class="px-6 pb-5 text-gray-600 leading-relaxed border-t border-gray-100 pt-4">{{ $faq['a'] }}</div>
            </div>
            @endforeach
        </div>
    </section>

    {{-- CTA --}}
    <section class="max-w-7xl mx-auto px-4 sm:px-6 pb-16">
        <div class="reveal rounded-3xl p-8 md:p-12 text-center relative overflow-hidden text-white" style="background: linear-gradient(135deg, #047857 0%, #064e3b 100%);">
            <div class="absolute -top-8 -right-8 w-64 h-64 bg-yellow-400/20 rounded-full blur-3xl"></div>
            <div class="relative">
                <h2 class="text-3xl md:text-4xl font-extrabold mb-3">Siap Bergabung dengan Program OPBM?</h2>
                <p class="text-emerald-100 mb-8 max-w-2xl mx-auto">Daftarkan keluarga Anda sekarang dan nikmati layanan penjemputan sampah gratis dari program OPBM RT 01</p>
                <div class="flex flex-col sm:flex-row gap-4 justify-center">
                    <a href="{{ route('daftar.opbm') }}" class="inline-flex items-center justify-center gap-2 text-emerald-900 px-8 py-3 rounded-full font-bold transition shadow-lg hover:shadow-xl" style="background: linear-gradient(90deg, #fbbf24 0%, #f59e0b 100%);">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                        Isi Formulir Pendaftaran
                    </a>
                    <a href="{{ route('warga.opbm') }}" class="inline-flex items-center justify-center gap-2 bg-white/10 border-2 border-white text-white px-8 py-3 rounded-full font-bold hover:bg-white hover:text-emerald-800 transition">
                        Lihat Peserta OPBM
                    </a>
                </div>
            </div>
        </div>
    </section>

    <footer class="bg-gray-900 text-gray-400 py-10">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 text-center text-sm">
            &copy; {{ date('Y') }} Kampung Digital OPBM RT 01 - Kota Jambi Bahagia
        </div>
    </footer>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const reveals = document.querySelectorAll('.reveal');
            const observer = new IntersectionObserver((entries) => {
                entries.forEach((entry, index) => {
                    if (entry.isIntersecting) {
                        setTimeout(() => entry.target.classList.add('active'), index * 80);
                        observer.unobserve(entry.target);
                    }
                });
            }, { threshold: 0.1, rootMargin: '0px 0px -50px 0px' });
            reveals.forEach(el => observer.observe(el));
        });
    </script>

</body>
</html>