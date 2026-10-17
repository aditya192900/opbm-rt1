@extends('layouts.app')

@section('title', 'Edit UMKM')

@section('content')
<div class="max-w-2xl mx-auto">
    <div class="mb-6">
        <a href="{{ route('umkm.index') }}" class="text-emerald-600 hover:underline text-sm">&larr; Kembali ke Daftar UMKM</a>
        <h1 class="text-2xl font-bold mt-2">Edit UMKM</h1>
        <p class="text-gray-500 text-sm">Perbarui data usaha</p>
    </div>

    <form action="{{ route('umkm.update', $umkm) }}" method="POST" enctype="multipart/form-data"
          class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 space-y-5">
        @csrf @method('PUT')

        <div>
            <label class="block font-semibold mb-1 text-gray-700">Nama Usaha <span class="text-red-500">*</span></label>
            <input type="text" name="nama_usaha" value="{{ old('nama_usaha', $umkm->nama_usaha) }}"
                   class="w-full border border-gray-300 rounded-lg px-4 py-2.5 focus:ring-2 focus:ring-emerald-500 outline-none transition" required>
            @error('nama_usaha') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
        </div>

        <div>
            <label class="block font-semibold mb-1 text-gray-700">Nama Pemilik <span class="text-red-500">*</span></label>
            <input type="text" name="pemilik" value="{{ old('pemilik', $umkm->pemilik) }}"
                   class="w-full border border-gray-300 rounded-lg px-4 py-2.5 focus:ring-2 focus:ring-emerald-500 outline-none transition" required>
            @error('pemilik') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
        </div>

        <div>
            <label class="block font-semibold mb-1 text-gray-700">Kategori <span class="text-red-500">*</span></label>
            <select name="kategori" class="w-full border border-gray-300 rounded-lg px-4 py-2.5 focus:ring-2 focus:ring-emerald-500 outline-none transition" required>
                @foreach(['Makanan','Minuman','Jasa','Fashion','Elektronik','Lainnya'] as $k)
                    <option value="{{ $k }}" @selected(old('kategori', $umkm->kategori) == $k)>{{ $k }}</option>
                @endforeach
            </select>
            @error('kategori') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
        </div>

        <div>
            <label class="block font-semibold mb-1 text-gray-700">Deskripsi <span class="text-red-500">*</span></label>
            <textarea name="deskripsi" rows="3"
                      class="w-full border border-gray-300 rounded-lg px-4 py-2.5 focus:ring-2 focus:ring-emerald-500 outline-none transition" required>{{ old('deskripsi', $umkm->deskripsi) }}</textarea>
            @error('deskripsi') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
        </div>

        <div>
            <label class="block font-semibold mb-1 text-gray-700">No WhatsApp <span class="text-red-500">*</span></label>
            <input type="text" name="no_wa" value="{{ old('no_wa', $umkm->no_wa) }}"
                   placeholder="628123456789"
                   class="w-full border border-gray-300 rounded-lg px-4 py-2.5 focus:ring-2 focus:ring-emerald-500 outline-none transition" required>
            @error('no_wa') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
        </div>

        <div>
            <label class="block font-semibold mb-1 text-gray-700">Alamat <span class="text-gray-400 text-sm font-normal">(opsional)</span></label>
            <input type="text" name="alamat" value="{{ old('alamat', $umkm->alamat) }}"
                   class="w-full border border-gray-300 rounded-lg px-4 py-2.5 focus:ring-2 focus:ring-emerald-500 outline-none transition">
        </div>

        <div>
            <label class="block font-semibold mb-1 text-gray-700">Foto Produk <span class="text-gray-400 text-sm font-normal">(biarkan kosong jika tidak ganti)</span></label>
            <input type="file" name="foto_produk" accept="image/*"
                   class="w-full border border-gray-300 rounded-lg px-4 py-2.5 focus:ring-2 focus:ring-emerald-500 outline-none transition">
            @if($umkm->foto_produk)
                <img src="{{ asset('storage/' . $umkm->foto_produk) }}" class="mt-2 w-32 rounded-lg">
            @endif
        </div>

        <div class="flex gap-3 pt-4 border-t border-gray-100">
            <button type="submit" class="flex-1 bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-lg font-semibold transition">
                Update UMKM
            </button>
            <a href="{{ route('umkm.index') }}" class="px-6 py-3 rounded-lg bg-gray-100 hover:bg-gray-200 text-gray-700 font-medium transition">
                Batal
            </a>
        </div>
    </form>
</div>
@endsection