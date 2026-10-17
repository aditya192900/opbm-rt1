@extends('layouts.app')

@section('title', 'UMKM Warga')

@section('content')
<div class="flex justify-between items-center mb-6">
    <div>
        <h1 class="text-2xl font-bold">UMKM Warga RT 01</h1>
        <p class="text-gray-500 text-sm">Direktori usaha mikro, kecil, dan menengah warga</p>
    </div>
    <a href="{{ route('umkm.create') }}" class="bg-emerald-600 hover:bg-emerald-700 text-white px-5 py-2.5 rounded-full shadow-sm font-medium text-sm transition">
        + Tambah UMKM
    </a>
</div>

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

<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
    @forelse($umkms as $umkm)
    @php
        $imgSrc = $umkm->foto_produk
            ? asset('storage/' . $umkm->foto_produk)
            : ($gambarFallback[$umkm->kategori] ?? $gambarFallback['Lainnya']);
        $totalMenu = $umkm->menus()->count();
    @endphp
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden hover:shadow-xl transition group">
        <div class="relative h-48 overflow-hidden">
            <img src="{{ $imgSrc }}" alt="{{ $umkm->nama_usaha }}"
                 class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
            <span class="absolute top-3 left-3 bg-white/95 backdrop-blur text-gray-800 px-3 py-1 rounded-full text-xs font-semibold shadow">
                {{ $umkm->kategori }}
            </span>
            @if($totalMenu > 0)
            <span class="absolute top-3 right-3 bg-emerald-500 text-white px-3 py-1 rounded-full text-xs font-semibold shadow">
                {{ $totalMenu }} Menu
            </span>
            @endif
        </div>
        <div class="p-5">
            <h3 class="font-bold text-lg text-gray-800">{{ $umkm->nama_usaha }}</h3>
            <p class="text-gray-500 text-sm mt-1">Pemilik: {{ $umkm->pemilik }}</p>
            <p class="text-gray-600 text-sm mt-2 leading-relaxed">{{ \Illuminate\Support\Str::limit($umkm->deskripsi, 80) }}</p>

            <div class="mt-4 pt-4 border-t border-gray-100 flex flex-wrap items-center gap-3 text-sm">
                <a href="{{ route('umkm.menu.index', $umkm) }}" class="text-emerald-600 font-semibold hover:underline">
                    Kelola Menu
                </a>
                <span class="text-gray-300">|</span>
                <a href="{{ route('umkm.edit', $umkm) }}" class="text-blue-600 hover:underline">Edit</a>
                <span class="text-gray-300">|</span>
                <form action="{{ route('umkm.destroy', $umkm) }}" method="POST" class="inline" onsubmit="return confirm('Hapus?')">
                    @csrf @method('DELETE')
                    <button class="text-red-500 hover:underline">Hapus</button>
                </form>
            </div>
        </div>
    </div>
    @empty
    <div class="col-span-3 text-center py-12 text-gray-400">
        Belum ada UMKM terdaftar. Klik "Tambah UMKM" untuk memulai.
    </div>
    @endforelse
</div>

<div class="mt-6">{{ $umkms->links() }}</div>
@endsection