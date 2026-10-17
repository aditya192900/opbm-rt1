@extends('layouts.app')

@section('title', 'Edit Menu')

@section('content')
<div class="max-w-2xl mx-auto">
    <div class="mb-6">
        <a href="{{ route('umkm.menu.index', $umkm) }}" class="text-emerald-600 hover:underline text-sm">&larr; Kembali</a>
        <h1 class="text-2xl font-bold mt-2">Edit Menu: {{ $umkm->nama_usaha }}</h1>
    </div>

    <form action="{{ route('umkm.menu.update', [$umkm, $menu]) }}" method="POST" enctype="multipart/form-data" class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 space-y-5">
        @csrf @method('PUT')

        <div>
            <label class="block font-semibold mb-1 text-gray-700">Nama Menu <span class="text-red-500">*</span></label>
            <input type="text" name="nama_menu" value="{{ old('nama_menu', $menu->nama_menu) }}"
                   class="w-full border border-gray-300 rounded-lg px-4 py-2.5 focus:ring-2 focus:ring-emerald-500 outline-none transition" required>
        </div>

        <div class="grid grid-cols-2 gap-4">
            <div>
                <label class="block font-semibold mb-1 text-gray-700">Kategori <span class="text-red-500">*</span></label>
                <select name="kategori" class="w-full border border-gray-300 rounded-lg px-4 py-2.5 focus:ring-2 focus:ring-emerald-500 outline-none transition" required>
                    <option value="Makanan" @selected($menu->kategori == 'Makanan')>Makanan</option>
                    <option value="Minuman" @selected($menu->kategori == 'Minuman')>Minuman</option>
                    <option value="Lainnya" @selected($menu->kategori == 'Lainnya')>Lainnya</option>
                </select>
            </div>
            <div>
                <label class="block font-semibold mb-1 text-gray-700">Harga (Rp) <span class="text-red-500">*</span></label>
                <input type="number" name="harga" value="{{ old('harga', $menu->harga) }}" min="0"
                       class="w-full border border-gray-300 rounded-lg px-4 py-2.5 focus:ring-2 focus:ring-emerald-500 outline-none transition" required>
            </div>
        </div>

        <div>
            <label class="block font-semibold mb-1 text-gray-700">Deskripsi</label>
            <textarea name="deskripsi" rows="3"
                      class="w-full border border-gray-300 rounded-lg px-4 py-2.5 focus:ring-2 focus:ring-emerald-500 outline-none transition">{{ old('deskripsi', $menu->deskripsi) }}</textarea>
        </div>

        <div>
            <label class="block font-semibold mb-1 text-gray-700">Foto Menu (biarkan kosong jika tidak ganti)</label>
            <input type="file" name="foto" accept="image/*"
                   class="w-full border border-gray-300 rounded-lg px-4 py-2.5 focus:ring-2 focus:ring-emerald-500 outline-none transition">
            @if($menu->foto)
                <img src="{{ asset('storage/' . $menu->foto) }}" class="mt-2 w-32 rounded-lg">
            @endif
        </div>

        <div class="flex items-center gap-2">
            <input type="checkbox" name="is_available" id="is_available" value="1" {{ $menu->is_available ? 'checked' : '' }}
                   class="w-4 h-4 text-emerald-600 rounded focus:ring-emerald-500">
            <label for="is_available" class="text-sm text-gray-700">Menu tersedia</label>
        </div>

        <div class="flex gap-3 pt-4 border-t border-gray-100">
            <button type="submit" class="flex-1 bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-lg font-semibold transition">
                Update Menu
            </button>
            <a href="{{ route('umkm.menu.index', $umkm) }}" class="px-6 py-3 rounded-lg bg-gray-100 hover:bg-gray-200 text-gray-700 font-medium transition">
                Batal
            </a>
        </div>
    </form>
</div>
@endsection