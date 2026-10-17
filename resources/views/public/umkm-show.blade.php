<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $umkm->nama_usaha }} - UMKM RT 01</title>
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

    @php
        $gambarFallback = [
            'Makanan' => 'https://images.unsplash.com/photo-1504674900247-0877df9cc836?w=1200&q=80',
            'Minuman' => 'https://images.unsplash.com/photo-1544145945-f90425340c7e?w=1200&q=80',
            'Jasa' => 'https://images.unsplash.com/photo-1556905055-8f358a7a47b2?w=1200&q=80',
            'Fashion' => 'https://images.unsplash.com/photo-1441986300917-64674bd600d8?w=1200&q=80',
            'Elektronik' => 'https://images.unsplash.com/photo-1498049794561-7780e7231661?w=1200&q=80',
            'Lainnya' => 'https://images.unsplash.com/photo-1556742049-0cfed4f6a45d?w=1200&q=80',
        ];
        $imgSrc = $umkm->foto_produk ? asset('storage/' . $umkm->foto_produk) : ($gambarFallback[$umkm->kategori] ?? $gambarFallback['Lainnya']);
        $waNumber = preg_replace('/^0/', '62', preg_replace('/^\+/', '', $umkm->no_wa));
        $lainnya = \App\Models\UmkmWarga::where('id', '!=', $umkm->id)->limit(3)->get();
    @endphp

    <div class="bg-white border-b border-gray-100">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 py-3">
            <a href="{{ route('umkm.publik') }}" class="inline-flex items-center gap-2 text-emerald-600 hover:text-emerald-700 font-medium text-sm">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
                Kembali ke Daftar UMKM
            </a>
        </div>
    </div>

    <article class="max-w-6xl mx-auto px-4 sm:px-6 py-8">
        <div class="bg-white rounded-3xl shadow-sm border border-gray-100 overflow-hidden">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-0">
                <div class="relative md:col-span-1 h-64 md:h-auto md:min-h-[320px]">
                    <img src="{{ $imgSrc }}" alt="{{ $umkm->nama_usaha }}" class="absolute inset-0 w-full h-full object-cover">
                </div>

                <div class="md:col-span-2 p-6 md:p-8 flex flex-col justify-center">
                    <div class="flex flex-wrap items-center gap-2 mb-3">
                        <span class="bg-emerald-100 text-emerald-700 px-3 py-1 rounded-full text-xs font-bold uppercase tracking-wider">{{ $umkm->kategori }}</span>
                        <span class="bg-blue-100 text-blue-700 px-3 py-1 rounded-full text-xs font-medium">UMKM Resmi RT 01</span>
                    </div>
                    <h1 class="text-3xl md:text-4xl font-extrabold text-gray-800 leading-tight mb-2">{{ $umkm->nama_usaha }}</h1>
                    <p class="text-gray-500 mb-6">Dikelola oleh <span class="font-semibold text-gray-700">{{ $umkm->pemilik }}</span></p>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 mb-6">
                        @if($umkm->no_wa)
                        <div class="flex items-center gap-3 bg-gray-50 rounded-xl p-3">
                            <div class="w-9 h-9 bg-emerald-100 rounded-lg flex items-center justify-center flex-shrink-0">
                                <svg class="w-4 h-4 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>
                            </div>
                            <div class="min-w-0">
                                <p class="text-xs text-gray-500">WhatsApp</p>
                                <p class="font-semibold text-gray-800 text-sm">+{{ $waNumber }}</p>
                            </div>
                        </div>
                        @endif
                        @if($umkm->alamat)
                        <div class="flex items-center gap-3 bg-gray-50 rounded-xl p-3">
                            <div class="w-9 h-9 bg-blue-100 rounded-lg flex items-center justify-center flex-shrink-0">
                                <svg class="w-4 h-4 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                            </div>
                            <div class="min-w-0">
                                <p class="text-xs text-gray-500">Alamat</p>
                                <p class="font-semibold text-gray-800 text-sm truncate">{{ $umkm->alamat }}</p>
                            </div>
                        </div>
                        @endif
                    </div>

                    <div class="flex flex-wrap gap-3">
                        @if($umkm->no_wa)
                        <a href="https://wa.me/{{ $waNumber }}?text={{ urlencode('Halo ' . $umkm->pemilik . ', saya tertarik dengan produk ' . $umkm->nama_usaha . '. Apakah masih tersedia?') }}" target="_blank" class="inline-flex items-center gap-2 text-white px-6 py-3 rounded-full font-bold shadow-md hover:shadow-lg transition-all" style="background: linear-gradient(90deg, #10b981 0%, #059669 100%);">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413Z"/></svg>
                            Chat WhatsApp
                        </a>
                        @endif
                        @if($umkm->alamat)
                        <a href="https://maps.google.com/?q={{ urlencode($umkm->alamat . ' Jambi') }}" target="_blank" class="inline-flex items-center gap-2 bg-white hover:bg-gray-50 text-gray-700 border-2 border-gray-200 px-6 py-3 rounded-full font-bold transition-all">
                            <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                            Lihat Maps
                        </a>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mt-6">
            <div class="lg:col-span-2 space-y-6">
                <div class="bg-white rounded-3xl shadow-sm border border-gray-100 p-6 md:p-8">
                    <div class="flex items-center gap-3 mb-5">
                        <div class="w-11 h-11 bg-emerald-100 rounded-xl flex items-center justify-center">
                            <svg class="w-6 h-6 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        </div>
                        <div>
                            <h2 class="font-bold text-xl text-gray-800">Tentang Usaha</h2>
                            <p class="text-xs text-gray-500">Informasi lengkap usaha ini</p>
                        </div>
                    </div>
                    <div class="text-gray-700 leading-relaxed whitespace-pre-line">{{ $umkm->deskripsi }}</div>
                </div>

                <div class="bg-white rounded-3xl shadow-sm border border-gray-100 p-6 md:p-8">
                    <div class="flex items-center gap-3 mb-5">
                        <div class="w-11 h-11 bg-yellow-100 rounded-xl flex items-center justify-center">
                            <svg class="w-6 h-6 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z"/></svg>
                        </div>
                        <div>
                            <h2 class="font-bold text-xl text-gray-800">Menu & Produk</h2>
                            <p class="text-xs text-gray-500">{{ $umkm->menus->count() }} item tersedia</p>
                        </div>
                    </div>

                    @if($umkm->menus->count() > 0)
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        @foreach($umkm->menus as $menu)
                        <div class="bg-gray-50 rounded-2xl overflow-hidden hover:shadow-md transition {{ !$menu->is_available ? 'opacity-60' : '' }}">
                            @if($menu->foto)
                                <img src="{{ asset('storage/' . $menu->foto) }}" class="w-full h-32 object-cover">
                            @else
                                <div class="w-full h-32 bg-gradient-to-br from-yellow-100 to-yellow-200 flex items-center justify-center">
                                    <span class="text-yellow-700 font-bold text-2xl">{{ strtoupper(substr($menu->nama_menu, 0, 2)) }}</span>
                                </div>
                            @endif
                            <div class="p-4">
                                <div class="flex justify-between items-start gap-2 mb-1">
                                    <h3 class="font-bold text-gray-800 text-sm leading-tight">{{ $menu->nama_menu }}</h3>
                                    @if(!$menu->is_available)<span class="bg-red-100 text-red-700 px-2 py-0.5 rounded-full text-[10px] font-bold">HABIS</span>@endif
                                </div>
                                @if($menu->deskripsi)<p class="text-xs text-gray-500 line-clamp-2 mb-2">{{ $menu->deskripsi }}</p>@endif
                                <p class="text-emerald-600 font-bold text-base">Rp {{ number_format($menu->harga, 0, ',', '.') }}</p>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    @else
                    <div class="text-center py-10 bg-gray-50 rounded-2xl"><p class="text-gray-400 text-sm">Menu belum tersedia.</p></div>
                    @endif
                </div>
            </div>

            <div class="space-y-6">
                <div class="bg-white rounded-3xl shadow-sm border border-gray-100 p-6">
                    <h3 class="font-bold text-gray-800 mb-5">Informasi Kontak</h3>
                    @if($umkm->no_wa)
                    <div class="flex items-start gap-3 mb-5 pb-5 border-b border-gray-100">
                        <div class="w-10 h-10 bg-emerald-100 rounded-full flex items-center justify-center flex-shrink-0">
                            <svg class="w-5 h-5 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>
                        </div>
                        <div class="min-w-0 flex-1">
                            <p class="text-xs text-gray-500 uppercase font-semibold tracking-wider">WhatsApp</p>
                            <p class="font-semibold text-gray-800 break-all">+{{ $waNumber }}</p>
                        </div>
                    </div>
                    @endif
                    @if($umkm->alamat)
                    <div class="flex items-start gap-3 mb-5 pb-5 border-b border-gray-100">
                        <div class="w-10 h-10 bg-blue-100 rounded-full flex items-center justify-center flex-shrink-0">
                            <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                        </div>
                        <div class="min-w-0 flex-1">
                            <p class="text-xs text-gray-500 uppercase font-semibold tracking-wider">Alamat</p>
                            <p class="font-semibold text-gray-800">{{ $umkm->alamat }}</p>
                        </div>
                    </div>
                    @endif
                    <div class="flex items-start gap-3">
                        <div class="w-10 h-10 bg-yellow-100 rounded-full flex items-center justify-center flex-shrink-0">
                            <svg class="w-5 h-5 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        </div>
                        <div class="min-w-0 flex-1">
                            <p class="text-xs text-gray-500 uppercase font-semibold tracking-wider">Jam Operasional</p>
                            <p class="font-semibold text-gray-800">07:00 - 21:00 WIB</p>
                        </div>
                    </div>
                </div>

                <div class="bg-gradient-to-br from-emerald-700 to-emerald-900 text-white rounded-3xl p-6 relative overflow-hidden">
                    <div class="absolute -top-8 -right-8 w-40 h-40 bg-yellow-400/20 rounded-full blur-3xl"></div>
                    <div class="relative">
                        <div class="flex items-center gap-3 mb-3">
                            <div class="w-11 h-11 bg-white/15 backdrop-blur rounded-xl flex items-center justify-center">
                                <svg class="w-6 h-6 text-yellow-400" fill="currentColor" viewBox="0 0 20 20"><path d="M10 2C6 2 3 5 3 9c0 4 3 7 7 9 4-2 7-5 7-9 0-4-3-7-7-7zm0 4a3 3 0 110 6 3 3 0 010-6z"/></svg>
                            </div>
                            <div>
                                <h3 class="font-bold text-base">UMKM Warga RT 01</h3>
                                <p class="text-emerald-200 text-xs">Kampung Digital Jambi</p>
                            </div>
                        </div>
                        <p class="text-emerald-100 text-sm leading-relaxed">Dukung UMKM lokal dengan berbelanja langsung dari warga!</p>
                    </div>
                </div>
            </div>
        </div>

        @if($lainnya->count() > 0)
        <div class="mt-14">
            <div class="flex items-center justify-between mb-6">
                <div>
                    <h2 class="text-2xl font-extrabold text-gray-800">UMKM Lainnya</h2>
                    <p class="text-sm text-gray-500">Jelajahi usaha warga RT 01 lainnya</p>
                </div>
                <a href="{{ route('umkm.publik') }}" class="text-emerald-600 hover:text-emerald-700 font-semibold text-sm whitespace-nowrap">Lihat Semua &rarr;</a>
            </div>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-5">
                @foreach($lainnya as $l)
                @php $imgLain = $l->foto_produk ? asset('storage/' . $l->foto_produk) : ($gambarFallback[$l->kategori] ?? $gambarFallback['Lainnya']); @endphp
                <a href="{{ route('umkm.publik.show', $l) }}" class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden hover:shadow-xl hover:-translate-y-1 transition-all group">
                    <div class="h-40 overflow-hidden">
                        <img src="{{ $imgLain }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                    </div>
                    <div class="p-4">
                        <span class="bg-blue-100 text-blue-800 px-2 py-0.5 rounded-full text-xs font-semibold">{{ $l->kategori }}</span>
                        <h3 class="font-bold text-gray-800 mt-2 group-hover:text-emerald-700 transition">{{ $l->nama_usaha }}</h3>
                        <p class="text-gray-500 text-sm">{{ $l->pemilik }}</p>
                    </div>
                </a>
                @endforeach
            </div>
        </div>
        @endif
    </article>

    <footer class="bg-gray-900 text-gray-400 py-10 mt-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 text-center">
            <p class="text-sm">&copy; {{ date('Y') }} Kampung Digital OPBM RT 01 - Kota Jambi Bahagia</p>
        </div>
    </footer>

</body>
</html>