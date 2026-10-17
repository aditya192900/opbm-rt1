@extends('layouts.app')

@section('title', 'Menu ' . $umkm->nama_usaha)

@section('content')
<div class="mb-6">
    <a href="{{ route('umkm.index') }}" class="text-emerald-600 hover:underline text-sm">&larr; Kembali ke Daftar UMKM</a>
    <h1 class="text-2xl font-bold mt-2">Kelola Menu: {{ $umkm->nama_usaha }}</h1>
    <p class="text-gray-500 text-sm">Daftar makanan/minuman/produk yang dijual</p>
</div>

<div class="flex justify-between items-center mb-6">
    <a href="{{ route('umkm.menu.create', $umkm) }}" class="bg-emerald-600 hover:bg-emerald-700 text-white px-5 py-2.5 rounded-full shadow-sm font-medium text-sm">
        + Tambah Menu
    </a>
    <span class="text-sm text-gray-500">Total: {{ $menus->total() }} menu</span>
</div>

<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-5">
    @forelse($menus as $m)
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden hover:shadow-lg transition">
        @if($m->foto)
            <img src="{{ asset('storage/' . $m->foto) }}" class="w-full h-40 object-cover">
        @else
            <div class="w-full h-40 bg-gradient-to-br from-yellow-100 to-yellow-200 flex items-center justify-center">
                <span class="text-yellow-700 font-bold text-2xl">{{ strtoupper(substr($m->nama_menu, 0, 2)) }}</span>
            </div>
        @endif
        <div class="p-4">
            <div class="flex justify-between items-start mb-2">
                <span class="bg-blue-100 text-blue-700 px-2 py-0.5 rounded-full text-xs font-semibold">{{ $m->kategori }}</span>
                @if($m->is_available)
                    <span class="bg-emerald-100 text-emerald-700 px-2 py-0.5 rounded-full text-xs font-semibold">Tersedia</span>
                @else
                    <span class="bg-red-100 text-red-700 px-2 py-0.5 rounded-full text-xs font-semibold">Habis</span>
                @endif
            </div>
            <h3 class="font-bold text-gray-800">{{ $m->nama_menu }}</h3>
            <p class="text-emerald-600 font-bold text-lg mt-1">Rp {{ number_format($m->harga, 0, ',', '.') }}</p>
            @if($m->deskripsi)
                <p class="text-gray-500 text-sm mt-2 line-clamp-2">{{ $m->deskripsi }}</p>
            @endif
            <div class="mt-3 pt-3 border-t border-gray-100 space-x-2">
                <a href="{{ route('umkm.menu.edit', [$umkm, $m]) }}" class="text-blue-600 text-sm hover:underline">Edit</a>
                <form action="{{ route('umkm.menu.destroy', [$umkm, $m]) }}" method="POST" class="inline" onsubmit="return confirm('Hapus menu ini?')">
                    @csrf @method('DELETE')
                    <button class="text-red-500 text-sm hover:underline">Hapus</button>
                </form>
            </div>
        </div>
    </div>
    @empty
    <div class="col-span-3 text-center py-16 text-gray-400">
        Belum ada menu. Klik "Tambah Menu" untuk memulai.
    </div>
    @endforelse
</div>

<div class="mt-6">{{ $menus->links() }}</div>
@endsection