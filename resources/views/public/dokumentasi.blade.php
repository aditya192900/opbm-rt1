<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dokumentasi Kegiatan RT 01 - Kampung Digital</title>
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

    <section class="bg-gradient-to-br from-emerald-700 to-emerald-900 text-white py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 text-center">
            <span class="inline-block bg-white/10 backdrop-blur border border-white/20 px-4 py-1.5 rounded-full text-xs font-medium mb-4">Galeri Kegiatan</span>
            <h1 class="text-4xl md:text-5xl font-extrabold mb-3">Dokumentasi RT 01</h1>
            <p class="text-emerald-100">Galeri kegiatan dan aktivitas warga</p>
        </div>
    </section>

    <section class="max-w-7xl mx-auto px-4 sm:px-6 py-16">
        @if($dokumentasis->count() > 0)
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($dokumentasis as $d)
            <a href="{{ route('dokumentasi.publik.show', $d) }}" class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden hover:shadow-xl transition group">
                @if($d->foto)
                    <img src="{{ asset('storage/' . $d->foto) }}" class="w-full h-48 object-cover group-hover:scale-105 transition-transform duration-300">
                @else
                    <div class="w-full h-48 bg-gradient-to-br from-yellow-100 to-yellow-200 flex items-center justify-center">
                        <span class="text-yellow-700 font-bold">Dokumentasi</span>
                    </div>
                @endif
                <div class="p-5">
                    <div class="flex items-center gap-2 text-xs text-gray-500">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                        {{ \Carbon\Carbon::parse($d->tanggal_kegiatan)->format('d M Y') }}
                    </div>
                    <h3 class="font-bold text-lg mt-2 text-gray-800 group-hover:text-emerald-700 transition">{{ $d->judul }}</h3>
                    <p class="text-gray-500 text-sm mt-2 leading-relaxed">{{ \Illuminate\Support\Str::limit($d->deskripsi, 100) }}</p>
                    @if($d->lokasi)
                    <div class="flex items-center gap-1 text-xs text-gray-400 mt-3">
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                        {{ $d->lokasi }}
                    </div>
                    @endif
                </div>
            </a>
            @endforeach
        </div>
        <div class="mt-10 flex justify-center">{{ $dokumentasis->links() }}</div>
        @else
        <div class="text-center py-20"><p class="text-gray-400">Belum ada dokumentasi.</p></div>
        @endif
    </section>

    <footer class="bg-gray-900 text-gray-400 py-10">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 text-center">
            <p class="text-sm">&copy; {{ date('Y') }} Kampung Digital OPBM RT 01 - Kota Jambi Bahagia</p>
        </div>
    </footer>

</body>
</html>