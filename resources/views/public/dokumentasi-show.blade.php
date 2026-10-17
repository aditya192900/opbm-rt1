<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $dokumentasi->judul }} - Kampung Digital RT 01</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-50 antialiased">

    <nav class="bg-white shadow-sm sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 py-3 flex justify-between items-center">
            <a href="{{ route('home') }}" class="flex items-center gap-3">
                <div class="w-11 h-11 bg-emerald-700 text-white rounded-xl flex items-center justify-center font-bold text-sm">RT</div>
                <div>
                    <div class="font-bold text-gray-800 text-sm leading-tight">Informasi Warga</div>
                    <div class="text-xs text-gray-500 leading-tight">RT 01 - Kampung Digital</div>
                </div>
            </a>
            <div class="hidden md:flex gap-6 text-sm">
                <a href="{{ route('home') }}" class="text-gray-700 hover:text-emerald-700 transition">Beranda</a>
                <a href="{{ route('umkm.publik') }}" class="text-gray-700 hover:text-emerald-700 transition">UMKM</a>
                <a href="{{ route('dokumentasi.publik') }}" class="text-emerald-700 font-semibold">Dokumentasi</a>
                <a href="{{ route('warga.opbm') }}" class="text-gray-700 hover:text-emerald-700 transition">Warga OPBM</a>
                <a href="{{ route('struktur.publik') }}" class="text-gray-700 hover:text-emerald-700 transition">Struktur</a>
            </div>
        </div>
    </nav>

    @if($dokumentasi->foto)
    <section class="relative h-72 md:h-96 bg-cover bg-center" style="background-image: url('{{ asset('storage/' . $dokumentasi->foto) }}');">
        <div class="absolute inset-0 bg-gradient-to-t from-black/70 to-transparent"></div>
    </section>
    @endif

    <article class="max-w-4xl mx-auto px-4 sm:px-6 py-12">
        <a href="{{ route('dokumentasi.publik') }}" class="inline-flex items-center gap-2 text-emerald-600 hover:text-emerald-700 font-medium text-sm mb-6">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
            Kembali ke Dokumentasi
        </a>

        <div class="bg-white rounded-3xl shadow-sm border border-gray-100 p-8 md:p-12">
            <div class="flex flex-wrap items-center gap-4 text-sm text-gray-500 mb-4">
                <div class="flex items-center gap-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                    {{ \Carbon\Carbon::parse($dokumentasi->tanggal_kegiatan)->format('d F Y') }}
                </div>
                @if($dokumentasi->lokasi)
                <div class="flex items-center gap-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                    {{ $dokumentasi->lokasi }}
                </div>
                @endif
            </div>

            <h1 class="text-3xl md:text-4xl font-extrabold text-gray-800 leading-tight mb-6">{{ $dokumentasi->judul }}</h1>
            <div class="w-16 h-1 bg-gradient-to-r from-emerald-500 to-emerald-700 rounded-full mb-8"></div>
            <div class="text-gray-700 text-lg leading-relaxed whitespace-pre-line">{{ $dokumentasi->deskripsi }}</div>
        </div>
    </article>

    <footer class="bg-gray-900 text-gray-400 py-10 mt-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 text-center">
            <p class="text-sm">&copy; {{ date('Y') }} Kampung Digital OPBM RT 01 - Kota Jambi Bahagia</p>
        </div>
    </footer>

</body>
</html>