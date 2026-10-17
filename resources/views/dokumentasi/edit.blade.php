@extends('layouts.app')

@section('title', 'Edit Dokumentasi')

@section('content')
<div class="max-w-2xl mx-auto">
    <h1 class="text-2xl font-bold mb-6">Edit Dokumentasi</h1>
    <form action="{{ route('dokumentasi.update', $dokumentasi) }}" method="POST" enctype="multipart/form-data" class="bg-white p-6 rounded-lg shadow space-y-4">
        @csrf @method('PUT')
        <div>
            <label class="block font-semibold mb-1">Judul</label>
            <input type="text" name="judul" value="{{ old('judul', $dokumentasi->judul) }}" class="w-full border rounded px-3 py-2" required>
        </div>
        <div>
            <label class="block font-semibold mb-1">Deskripsi</label>
            <textarea name="deskripsi" rows="4" class="w-full border rounded px-3 py-2" required>{{ old('deskripsi', $dokumentasi->deskripsi) }}</textarea>
        </div>
        <div class="grid grid-cols-2 gap-4">
            <div>
                <label class="block font-semibold mb-1">Tanggal</label>
                <input type="date" name="tanggal_kegiatan" value="{{ old('tanggal_kegiatan', $dokumentasi->tanggal_kegiatan) }}" class="w-full border rounded px-3 py-2" required>
            </div>
            <div>
                <label class="block font-semibold mb-1">Lokasi</label>
                <input type="text" name="lokasi" value="{{ old('lokasi', $dokumentasi->lokasi) }}" class="w-full border rounded px-3 py-2">
            </div>
        </div>
        <div>
            <label class="block font-semibold mb-1">Foto (biarkan kosong jika tidak ganti)</label>
            <input type="file" name="foto" accept="image/*" class="w-full border rounded px-3 py-2">
            @if($dokumentasi->foto)
                <img src="{{ asset('storage/' . $dokumentasi->foto) }}" class="mt-2 w-32 rounded">
            @endif
        </div>
        <div class="flex gap-3 pt-4">
            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-lg">Update</button>
            <a href="{{ route('dokumentasi.index') }}" class="bg-gray-200 hover:bg-gray-300 px-6 py-2 rounded-lg">Batal</a>
        </div>
    </form>
</div>
@endsection