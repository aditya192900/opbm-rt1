@extends('layouts.app')

@section('title', 'Buat Laporan')

@section('content')
<div class="max-w-2xl mx-auto">
    <h1 class="text-2xl font-bold mb-6">Buat Laporan Baru</h1>

    <form action="{{ route('laporan.store') }}" method="POST" enctype="multipart/form-data" class="bg-white p-6 rounded-lg shadow space-y-4">
        @csrf

        <div>
            <label class="block font-semibold mb-1">Judul Laporan</label>
            <input type="text" name="judul" value="{{ old('judul') }}" class="w-full border rounded px-3 py-2" required>
            @error('judul') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
        </div>

        <div>
            <label class="block font-semibold mb-1">Deskripsi</label>
            <textarea name="deskripsi" rows="4" class="w-full border rounded px-3 py-2" required>{{ old('deskripsi') }}</textarea>
            @error('deskripsi') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
        </div>

        <div>
            <label class="block font-semibold mb-1">Lokasi (opsional)</label>
            <input type="text" name="lokasi" value="{{ old('lokasi') }}" class="w-full border rounded px-3 py-2" placeholder="Contoh: Depan rumah no. 5">
        </div>

        <div>
            <label class="block font-semibold mb-1">Foto (opsional)</label>
            <input type="file" name="foto" accept="image/*" class="w-full border rounded px-3 py-2">
        </div>

        <div class="flex gap-3 pt-4">
            <button type="submit" class="bg-green-600 hover:bg-green-700 text-white px-6 py-2 rounded-lg">Kirim Laporan</button>
            <a href="{{ route('laporan.index') }}" class="bg-gray-200 hover:bg-gray-300 px-6 py-2 rounded-lg">Batal</a>
        </div>
    </form>
</div>
@endsection