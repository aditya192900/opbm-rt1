@extends('layouts.app')

@section('title', 'Tambah UMKM')

@section('content')
<div class="max-w-2xl mx-auto">
    <h1 class="text-2xl font-bold mb-6">Tambah Data UMKM</h1>

    <form action="{{ route('umkm.store') }}" method="POST" enctype="multipart/form-data" class="bg-white p-6 rounded-lg shadow space-y-4">
        @csrf

        <div>
            <label class="block font-semibold mb-1">Nama Usaha</label>
            <input type="text" name="nama_usaha" value="{{ old('nama_usaha') }}" class="w-full border rounded px-3 py-2" required>
            @error('nama_usaha') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
        </div>

        <div>
            <label class="block font-semibold mb-1">Nama Pemilik</label>
            <input type="text" name="pemilik" value="{{ old('pemilik') }}" class="w-full border rounded px-3 py-2" required>
            @error('pemilik') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
        </div>

        <div>
            <label class="block font-semibold mb-1">Kategori</label>
            <select name="kategori" class="w-full border rounded px-3 py-2" required>
                <option value="">-- Pilih Kategori --</option>
                @foreach(['Makanan','Minuman','Jasa','Fashion','Elektronik','Lainnya'] as $k)
                    <option value="{{ $k }}" @selected(old('kategori') == $k)>{{ $k }}</option>
                @endforeach
            </select>
            @error('kategori') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
        </div>

        <div>
            <label class="block font-semibold mb-1">Deskripsi</label>
            <textarea name="deskripsi" rows="3" class="w-full border rounded px-3 py-2" required>{{ old('deskripsi') }}</textarea>
            @error('deskripsi') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
        </div>

        <div>
            <label class="block font-semibold mb-1">No WhatsApp</label>
            <input type="text" name="no_wa" value="{{ old('no_wa') }}" class="w-full border rounded px-3 py-2" placeholder="628123456789" required>
            @error('no_wa') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
        </div>

        <div>
            <label class="block font-semibold mb-1">Alamat (opsional)</label>
            <input type="text" name="alamat" value="{{ old('alamat') }}" class="w-full border rounded px-3 py-2">
        </div>

        <div>
            <label class="block font-semibold mb-1">Foto Produk (opsional)</label>
            <input type="file" name="foto_produk" accept="image/*" class="w-full border rounded px-3 py-2">
        </div>

        <div class="flex gap-3 pt-4">
            <button type="submit" class="bg-green-600 hover:bg-green-700 text-white px-6 py-2 rounded-lg">Simpan</button>
            <a href="{{ route('umkm.index') }}" class="bg-gray-200 hover:bg-gray-300 px-6 py-2 rounded-lg">Batal</a>
        </div>
    </form>
</div>
@endsection