<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil RT 01 - Kampung Digital</title>
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
        .lift-card { transition: transform 0.3s, box-shadow 0.3s; }
        .lift-card:hover { transform: translateY(-8px); box-shadow: 0 20px 40px rgba(0,0,0,0.1); }
        @keyframes pulse-dot { 0%, 100% { transform: scale(1); opacity: 1; } 50% { transform: scale(1.5); opacity: 0.5; } }
        .pulse-dot { animation: pulse-dot 2s ease-in-out infinite; }
        @keyframes shimmer { 0% { background-position: -200% 0; } 100% { background-position: 200% 0; } }
        .shimmer-badge { background: linear-gradient(90deg, #ecfdf5 25%, #d1fae5 50%, #ecfdf5 75%); background-size: 200% 100%; animation: shimmer 3s infinite; }
        @keyframes bounce-soft { 0%, 100% { transform: translateY(0); } 50% { transform: translateY(-8px); } }
        .icon-bounce { animation: bounce-soft 2.5s ease-in-out infinite; }
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
                    <a href="{{ route('home') }}" class="px-4 py-2 text-gray-700 hover:text-emerald-700 rounded-full transition">Beranda</a>
                    <a href="{{ route('profil.rt') }}" class="px-4 py-2 rounded-full bg-emerald-50 text-emerald-700 font-semibold">Profil RT</a>
                    <a href="{{ route('program.opbm') }}" class="px-4 py-2 text-gray-700 hover:text-emerald-700 rounded-full transition">Program OPBM</a>
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
                <a href="{{ route('profil.rt') }}" class="block px-4 py-2 rounded-lg text-sm bg-emerald-50 text-emerald-700 font-semibold">Profil RT</a>
                <a href="{{ route('program.opbm') }}" class="block px-4 py-2 rounded-lg text-sm text-gray-700">Program OPBM</a>
                <a href="{{ route('warga.opbm') }}" class="block px-4 py-2 rounded-lg text-sm text-gray-700">Warga OPBM</a>
                <a href="{{ route('struktur.publik') }}" class="block px-4 py-2 rounded-lg text-sm text-gray-700">Struktur</a>
            </div>
        </div>
    </nav>

    {{-- HERO --}}
    <section class="relative text-white py-28 overflow-hidden" style="background: linear-gradient(135deg, #047857 0%, #064e3b 100%);">
        <div class="absolute inset-0 opacity-10">
            <div class="absolute -top-24 -left-24 w-96 h-96 bg-white rounded-full blur-3xl"></div>
            <div class="absolute -bottom-24 -right-24 w-96 h-96 bg-yellow-300 rounded-full blur-3xl"></div>
        </div>
        <div class="particle particle-1"></div>
        <div class="particle particle-2"></div>
        <div class="particle particle-3"></div>
        <div class="particle particle-4"></div>

        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 text-center">
            <div class="inline-block bg-white/10 backdrop-blur border border-white/20 px-5 py-2 rounded-full text-xs font-medium mb-6">
                <span class="inline-block w-2 h-2 bg-emerald-400 rounded-full mr-2 pulse-dot" style="vertical-align: middle;"></span> Tentang Kami
            </div>
            <h1 class="text-4xl md:text-6xl font-extrabold mb-4">Profil RT 01</h1>
            <p class="text-lg md:text-xl text-emerald-100 max-w-3xl mx-auto">
                Mengenal lebih dekat lingkungan RT 01 — Kampung Digital, Kota Jambi Bahagia
            </p>
        </div>
    </section>

    {{-- STATISTIK --}}
    <section class="max-w-7xl mx-auto px-4 sm:px-6 -mt-12 relative z-10">
        <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
            <div class="reveal bg-white rounded-2xl shadow-xl border-l-4 border-emerald-500 p-5 text-center lift-card">
                <div class="w-12 h-12 rounded-xl bg-emerald-100 flex items-center justify-center mx-auto mb-3">
                    <svg class="w-6 h-6 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
                </div>
                <p class="text-3xl font-extrabold text-emerald-600">45</p>
                <p class="text-xs text-gray-500 mt-1 font-semibold">Kepala Keluarga</p>
            </div>
            <div class="reveal bg-white rounded-2xl shadow-xl border-l-4 border-blue-500 p-5 text-center lift-card">
                <div class="w-12 h-12 rounded-xl bg-blue-100 flex items-center justify-center mx-auto mb-3">
                    <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                </div>
                <p class="text-3xl font-extrabold text-blue-600">180</p>
                <p class="text-xs text-gray-500 mt-1 font-semibold">Total Jiwa</p>
            </div>
            <div class="reveal bg-white rounded-2xl shadow-xl border-l-4 border-yellow-500 p-5 text-center lift-card">
                <div class="w-12 h-12 rounded-xl bg-yellow-100 flex items-center justify-center mx-auto mb-3">
                    <svg class="w-6 h-6 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 8V4m0 0h4M4 4l5 5m11-1V4m0 0h-4m4 0l-5 5M4 16v4m0 0h4m-4 0l5-5m11 5l-5-5m5 5v-4m0 4h-4"/></svg>
                </div>
                <p class="text-3xl font-extrabold text-yellow-600">1,5</p>
                <p class="text-xs text-gray-500 mt-1 font-semibold">Hektar Luas</p>
            </div>
            <div class="reveal bg-white rounded-2xl shadow-xl border-l-4 border-purple-500 p-5 text-center lift-card">
                <div class="w-12 h-12 rounded-xl bg-purple-100 flex items-center justify-center mx-auto mb-3">
                    <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                </div>
                <p class="text-3xl font-extrabold text-purple-600">1985</p>
                <p class="text-xs text-gray-500 mt-1 font-semibold">Berdiri Sejak</p>
            </div>
        </div>
    </section>

    {{-- SAMBUTAN --}}
    <section class="max-w-7xl mx-auto px-4 sm:px-6 py-20">
        <div class="reveal bg-white rounded-3xl shadow-lg border border-gray-100 overflow-hidden">
            <div class="grid grid-cols-1 md:grid-cols-3">
                <div class="relative flex items-center justify-center p-12" style="background: linear-gradient(135deg, #ecfdf5 0%, #a7f3d0 100%);">
                    <div class="w-40 h-40 md:w-52 md:h-52 rounded-full bg-white shadow-2xl flex items-center justify-center border-4 border-white">
                        <span class="text-emerald-700 font-extrabold text-5xl">AS</span>
                    </div>
                    <div class="absolute bottom-4 right-4 bg-yellow-400 text-emerald-900 text-xs font-bold px-3 py-1 rounded-full shadow-lg">Ketua RT</div>
                </div>
                <div class="md:col-span-2 p-8 md:p-12">
                    <span class="inline-block bg-emerald-100 text-emerald-700 text-xs font-bold uppercase tracking-widest px-4 py-1.5 rounded-full mb-4">Sambutan</span>
                    <h2 class="text-3xl font-extrabold text-gray-800 mb-2">Kata Pengantar Ketua RT</h2>
                    <p class="text-gray-500 mb-6">Bapak H. Ahmad Sutrisno &middot; Ketua RT 01</p>
                    <div class="text-gray-700 leading-relaxed space-y-4">
                        <p>Assalamu'alaikum warahmatullahi wabarakatuh. Selamat datang di website resmi RT 01 Kampung Digital. Website ini kami hadirkan sebagai wujud komitmen kami dalam mendukung program <strong>Kota Jambi Bahagia</strong> melalui penerapan teknologi digital di tingkat lingkungan.</p>
                        <p>Melalui program <strong>OPBM (Operator Pengumpul Sampah Berbasis Masyarakat)</strong>, kami mengajak seluruh warga untuk bersama-sama menjaga kebersihan lingkungan dengan sistem pengelolaan sampah yang lebih modern, transparan, dan partisipatif.</p>
                        <p>Semoga kehadiran website ini dapat mempermudah pelayanan kepada warga serta menjadi contoh bagi RT lain di Kota Jambi.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- VISI & MISI --}}
    <section class="bg-gray-50 py-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6">
            <div class="text-center mb-14 reveal">
                <span class="inline-block shimmer-badge text-emerald-600 font-bold text-sm uppercase tracking-widest px-4 py-1.5 rounded-full">Visi & Misi</span>
                <h2 class="text-3xl md:text-4xl font-extrabold text-gray-800 mt-4">Visi & Misi RT 01</h2>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="reveal text-white rounded-3xl p-8 md:p-10 relative overflow-hidden lift-card" style="background: linear-gradient(135deg, #059669 0%, #065f46 100%);">
                    <div class="absolute -top-8 -right-8 w-40 h-40 bg-yellow-400/20 rounded-full blur-3xl"></div>
                    <div class="relative">
                        <div class="inline-flex items-center gap-2 bg-white/15 backdrop-blur border border-white/25 px-4 py-1.5 rounded-full text-xs font-bold uppercase tracking-widest mb-6">
                            <svg class="w-4 h-4 text-yellow-400" fill="currentColor" viewBox="0 0 20 20"><path d="M10 2C6 2 3 5 3 9c0 4 3 7 7 9 4-2 7-5 7-9 0-4-3-7-7-7zm0 4a3 3 0 110 6 3 3 0 010-6z"/></svg>
                            Visi
                        </div>
                        <div class="mb-5">
                            <svg class="w-16 h-16 text-yellow-400 icon-bounce" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2l2.09 6.26L20.18 9l-5.09 4.14L16.82 20 12 16.77 7.18 20l1.73-6.86L3.82 9l6.09-.74L12 2z"/></svg>
                        </div>
                        <h3 class="text-2xl md:text-3xl font-extrabold leading-tight mb-4">Menjadi lingkungan yang bersih, aman, dan sejahtera</h3>
                        <p class="text-emerald-50 leading-relaxed">Mewujudkan RT 01 sebagai lingkungan yang harmonis, bersih, aman, nyaman, dan maju — dengan semangat gotong royong, kekeluargaan, dan kebersamaan seluruh warga.</p>
                    </div>
                </div>
                <div class="reveal bg-white rounded-3xl shadow-sm border border-gray-100 p-8 md:p-10 lift-card">
                    <div class="inline-flex items-center gap-2 bg-emerald-50 border border-emerald-100 px-4 py-1.5 rounded-full text-xs font-bold uppercase tracking-widest text-emerald-700 mb-6">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/></svg>
                        Misi
                    </div>
                    <div class="space-y-5">
                        @php
                            $misi = [
                                ['judul' => 'Mewujudkan Lingkungan Bersih', 'desc' => 'Program OPBM berkelanjutan untuk pengelolaan sampah yang lebih baik.'],
                                ['judul' => 'Meningkatkan Pelayanan Digital', 'desc' => 'Layanan cepat, mudah, dan gratis untuk semua warga melalui website.'],
                                ['judul' => 'Memberdayakan UMKM Warga', 'desc' => 'Mendorong ekonomi lokal dengan promosi usaha warga RT 01.'],
                                ['judul' => 'Membangun Kebersamaan Warga', 'desc' => 'Kegiatan sosial, olahraga, dan keagamaan untuk mempererat silaturahmi.'],
                                ['judul' => 'Mendukung Jambi Smart City', 'desc' => 'Berkontribusi pada program Pemerintah Kota Jambi menuju kota cerdas.'],
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

    {{-- DATA WILAYAH --}}
    <section class="bg-white py-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6">
            <div class="text-center mb-14 reveal">
                <span class="inline-block shimmer-badge text-emerald-600 font-bold text-sm uppercase tracking-widest px-4 py-1.5 rounded-full">Data Wilayah</span>
                <h2 class="text-3xl md:text-4xl font-extrabold text-gray-800 mt-4">Informasi Administratif</h2>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="reveal bg-gradient-to-br from-emerald-50 to-white rounded-3xl p-8 border border-emerald-100 lift-card">
                    <div class="flex items-center gap-3 mb-6">
                        <div class="w-12 h-12 rounded-xl bg-emerald-600 flex items-center justify-center">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/></svg>
                        </div>
                        <h3 class="font-bold text-xl text-gray-800">Data Umum</h3>
                    </div>
                    <div class="space-y-3">
                        @php
                            $dataUmum = [
                                ['Nama RT', 'RT 01'],
                                ['RW', 'RW 05'],
                                ['Kelurahan', 'Kel. Jambi'],
                                ['Kecamatan', 'Kec. Kota Baru'],
                                ['Kota', 'Kota Jambi'],
                                ['Kode Pos', '36111'],
                            ];
                        @endphp
                        @foreach($dataUmum as $d)
                        <div class="flex justify-between py-2 border-b border-emerald-100 last:border-0">
                            <span class="text-gray-500 text-sm">{{ $d[0] }}</span>
                            <span class="font-semibold text-gray-800 text-sm">{{ $d[1] }}</span>
                        </div>
                        @endforeach
                    </div>
                </div>

                <div class="reveal bg-gradient-to-br from-blue-50 to-white rounded-3xl p-8 border border-blue-100 lift-card">
                    <div class="flex items-center gap-3 mb-6">
                        <div class="w-12 h-12 rounded-xl bg-blue-600 flex items-center justify-center">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l4.553 2.276A1 1 0 0021 18.382V7.618a1 1 0 00-.553-.894L15 4m0 13V4m0 0L9 7"/></svg>
                        </div>
                        <h3 class="font-bold text-xl text-gray-800">Batas Wilayah</h3>
                    </div>
                    <div class="space-y-3">
                        @php
                            $batas = [
                                ['Utara', 'Jl. Sudirman', 'text-emerald-600'],
                                ['Selatan', 'Jl. Ahmad Yani', 'text-blue-600'],
                                ['Timur', 'Perumahan Griya Asri', 'text-yellow-600'],
                                ['Barat', 'Sungai Batanghari', 'text-purple-600'],
                            ];
                        @endphp
                        @foreach($batas as $b)
                        <div class="flex items-start gap-3 py-2 border-b border-blue-100 last:border-0">
                            <span class="font-bold w-20 flex-shrink-0 text-sm {{ $b[2] }}">{{ $b[0] }}</span>
                            <span class="text-gray-700 text-sm">{{ $b[1] }}</span>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- FASILITAS --}}
    <section class="bg-gray-50 py-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6">
            <div class="text-center mb-14 reveal">
                <span class="inline-block shimmer-badge text-emerald-600 font-bold text-sm uppercase tracking-widest px-4 py-1.5 rounded-full">Fasilitas & Potensi</span>
                <h2 class="text-3xl md:text-4xl font-extrabold text-gray-800 mt-4">Yang Ada di RT 01</h2>
            </div>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                @php
                    $fasilitas = [
                        ['judul' => 'Balai RT', 'desc' => 'Ruang pertemuan warga untuk rapat dan kegiatan sosial', 'icon' => 'M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4', 'warna' => 'emerald'],
                        ['judul' => 'Masjid / Musholla', 'desc' => 'Tempat ibadah dan kegiatan keagamaan warga', 'icon' => 'M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253', 'warna' => 'blue'],
                        ['judul' => 'Lapangan', 'desc' => 'Area olahraga dan kegiatan pemuda', 'icon' => 'M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z', 'warna' => 'yellow'],
                        ['judul' => 'Pos Ronda', 'desc' => 'Pos keamanan lingkungan 24 jam', 'icon' => 'M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z', 'warna' => 'purple'],
                        ['judul' => 'Depo Sampah OPBM', 'desc' => 'Titik pengumpulan sampah sebelum diangkut', 'icon' => 'M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16', 'warna' => 'emerald'],
                        ['judul' => 'WiFi Komunitas', 'desc' => 'Akses internet gratis untuk warga', 'icon' => 'M8.111 16.404a5.5 5.5 0 017.778 0M12 20h.01m-7.08-7.071c3.904-3.905 10.236-3.905 14.141 0M1.394 9.393c5.857-5.857 15.355-5.857 21.213 0', 'warna' => 'blue'],
                    ];
                @endphp
                @foreach($fasilitas as $f)
                <div class="reveal bg-white rounded-2xl shadow-sm border border-gray-100 p-6 lift-card">
                    <div class="w-14 h-14 bg-{{ $f['warna'] }}-100 rounded-2xl flex items-center justify-center mb-4">
                        <svg class="w-7 h-7 text-{{ $f['warna'] }}-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $f['icon'] }}"/>
                        </svg>
                    </div>
                    <h3 class="font-bold text-lg text-gray-800 mb-2">{{ $f['judul'] }}</h3>
                    <p class="text-gray-500 text-sm leading-relaxed">{{ $f['desc'] }}</p>
                </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- KONTAK --}}
    <section class="bg-white py-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6">
            <div class="text-center mb-14 reveal">
                <span class="inline-block shimmer-badge text-emerald-600 font-bold text-sm uppercase tracking-widest px-4 py-1.5 rounded-full">Hubungi Kami</span>
                <h2 class="text-3xl md:text-4xl font-extrabold text-gray-800 mt-4">Kontak & Sekretariat</h2>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 max-w-4xl mx-auto">
                <div class="reveal bg-gradient-to-br from-blue-50 to-white rounded-2xl p-6 text-center border border-blue-100 lift-card">
                    <div class="w-14 h-14 bg-blue-600 rounded-2xl flex items-center justify-center mx-auto mb-4">
                        <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                    </div>
                    <h3 class="font-bold text-gray-800 mb-2">Sekretariat</h3>
                    <p class="text-gray-600 text-sm">Jl. Merdeka No. 10, RT 01<br>Kota Jambi</p>
                </div>
                <div class="reveal bg-gradient-to-br from-emerald-50 to-white rounded-2xl p-6 text-center border border-emerald-100 lift-card">
                    <div class="w-14 h-14 bg-emerald-600 rounded-2xl flex items-center justify-center mx-auto mb-4">
                        <svg class="w-7 h-7 text-white" fill="currentColor" viewBox="0 0 24 24"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413Z"/></svg>
                    </div>
                    <h3 class="font-bold text-gray-800 mb-2">WhatsApp</h3>
                    <a href="https://wa.me/6281234500001" target="_blank" class="text-emerald-600 hover:underline text-sm font-semibold">+62 812-3450-0001</a>
                </div>
                <div class="reveal bg-gradient-to-br from-purple-50 to-white rounded-2xl p-6 text-center border border-purple-100 lift-card">
                    <div class="w-14 h-14 bg-purple-600 rounded-2xl flex items-center justify-center mx-auto mb-4">
                        <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                    </div>
                    <h3 class="font-bold text-gray-800 mb-2">Email</h3>
                    <p class="text-gray-600 text-sm">rt01@jambikota.go.id</p>
                </div>
            </div>
        </div>
    </section>

    {{-- FOOTER --}}
    <footer class="bg-gray-900 text-gray-400 py-12">
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
                        setTimeout(() => entry.target.classList.add('active'), index * 100);
                        observer.unobserve(entry.target);
                    }
                });
            }, { threshold: 0.15, rootMargin: '0px 0px -50px 0px' });
            reveals.forEach(el => observer.observe(el));
        });
    </script>

</body>
</html>