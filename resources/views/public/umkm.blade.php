<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>UMKM Warga RT 01 - Kampung Digital</title>
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
                <a href="{{ route('umkm.publik') }}" class="text-emerald-700 font-semibold">UMKM</a>
                <a href="{{ route('dokumentasi.publik') }}" class="text-gray-700 hover:text-emerald-700 transition">Dokumentasi</a>
                <a href="{{ route('warga.opbm') }}" class="text-gray-700 hover:text-emerald-700 transition">Warga OPBM</a>
                <a href="{{ route('struktur.publik') }}" class="text-gray-700 hover:text-emerald-700 transition">Struktur</a>
            </div>
        </div>
    </nav>

    <section class="bg-gradient-to-br from-emerald-700 to-emerald-900 text-white py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 text-center">
            <span class="inline-block bg-white/10 backdrop-blur border border-white/20 px-4 py-1.5 rounded-full text-xs font-medium mb-4">Ekonomi Warga</span>
            <h1 class="text-4xl md:text-5xl font-extrabold mb-3">UMKM RT 01</h1>
            <p class="text-emerald-100">Direktori usaha warga yang bisa dihubungi langsung</p>
        </div>
    </section>

    <section class="max-w-7xl mx-auto px-4 sm:px-6 py-16">
        @php
            $gambarFallback = [
                'Makanan'    => 'https://images.unsplash.com/photo-1504674900247-0877df9cc836?w=800&q=80',
                'Minuman'    => 'https://images.unsplash.com/photo-1544145945-f90425340c7e?w=800&q=80',
                'Jasa'       => 'https://images.unsplash.com/photo-1556905055-8f358a7a47b2?w=800&q=80',
                'Fashion'    => 'https://images.unsplash.com/photo-1441986300917-64674bd600d8?w=800&q=80',
                'Elektronik' => 'https://images.unsplash.com/photo-1498049794561-7780e7231661?w=800&q=80',
                'Lainnya'    => 'https://images.unsplash.com/photo-1556742049-0cfed4f6a45d?w=800&q=80',
            ];
        @endphp

        @if($umkms->count() > 0)
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($umkms as $u)
            @php
                $imgSrc = $u->foto_produk ? asset('storage/' . $u->foto_produk) : ($gambarFallback[$u->kategori] ?? $gambarFallback['Lainnya']);
            @endphp
            <a href="{{ route('umkm.publik.show', $u) }}" class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden hover:shadow-xl hover:-translate-y-1 transition-all duration-300 group flex flex-col">
                <div class="relative h-48 overflow-hidden">
                    <img src="{{ $imgSrc }}" alt="{{ $u->nama_usaha }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                    <span class="absolute top-3 left-3 bg-white/95 backdrop-blur text-gray-800 px-3 py-1 rounded-full text-xs font-semibold shadow">{{ $u->kategori }}</span>
                </div>
                <div class="p-5 flex-1 flex flex-col">
                    <h3 class="font-bold text-lg text-gray-800 group-hover:text-emerald-700 transition">{{ $u->nama_usaha }}</h3>
                    <p class="text-gray-500 text-sm mt-1">Pemilik: {{ $u->pemilik }}</p>
                    <p class="text-gray-600 text-sm mt-3 leading-relaxed flex-1">{{ \Illuminate\Support\Str::limit($u->deskripsi, 90) }}</p>
                    <div class="mt-4 pt-4 border-t border-gray-100 space-y-2">
                        @if($u->no_wa)
                        <div class="flex items-center gap-2 text-sm text-gray-600">
                            <svg class="w-4 h-4 text-emerald-600 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>
                            <span class="font-medium">+{{ ltrim($u->no_wa, '0') }}</span>
                        </div>
                        @endif
                        @if($u->alamat)
                        <div class="flex items-center gap-2 text-xs text-gray-500">
                            <svg class="w-3.5 h-3.5 text-emerald-600 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                            {{ $u->alamat }}
                        </div>
                        @endif
                    </div>
                    <div class="mt-4">
                        <span class="block text-center bg-emerald-600 group-hover:bg-emerald-700 text-white px-4 py-2 rounded-full text-sm font-medium transition">Lihat Detail</span>
                    </div>
                </div>
            </a>
            @endforeach
        </div>
        <div class="mt-10 flex justify-center">{{ $umkms->links() }}</div>
        @else
        <div class="text-center py-20"><p class="text-gray-400">Belum ada UMKM terdaftar.</p></div>
        @endif
    </section>

    <footer class="bg-gray-900 text-gray-400 py-10">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 text-center">
            <p class="text-sm">&copy; {{ date('Y') }} Kampung Digital OPBM RT 01 - Kota Jambi Bahagia</p>
        </div>
    </footer>

</body>
</html>