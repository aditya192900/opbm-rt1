@extends('layouts.app')

@section('title', 'Daftar OPBM')

@section('content')
<div class="max-w-2xl mx-auto">
    <h1 class="text-2xl font-bold mb-6">📝 Formulir Pendaftaran OPBM</h1>

    <form action="{{ route('pendaftaran.store') }}" method="POST" class="bg-white p-6 rounded-lg shadow space-y-4">
        @csrf

        <div>
            <label class="block font-semibold mb-1">Nama Kepala Keluarga</label>
            <input type="text" name="nama_kepala_keluarga" value="{{ old('nama_kepala_keluarga') }}" class="w-full border rounded px-3 py-2" required>
            @error('nama_kepala_keluarga') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
        </div>

        <div>
            <label class="block font-semibold mb-1">NIK (16 digit)</label>
            <input type="text" name="nik" value="{{ old('nik') }}" maxlength="16" class="w-full border rounded px-3 py-2" required>
            @error('nik') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
        </div>

        <div>
            <label class="block font-semibold mb-1">No HP / WhatsApp</label>
            <input type="text" name="no_hp" value="{{ old('no_hp') }}" class="w-full border rounded px-3 py-2" required>
            @error('no_hp') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
        </div>

        <div>
            <label class="block font-semibold mb-1">Alamat</label>
            <textarea name="alamat" rows="3" class="w-full border rounded px-3 py-2" required>{{ old('alamat') }}</textarea>
            @error('alamat') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
        </div>

        <div>
            <label class="block font-semibold mb-1">Zona</label>
            <input type="text" name="zona" value="{{ old('zona', 'RT 01') }}" class="w-full border rounded px-3 py-2">
        </div>

        <div class="flex gap-3 pt-4">
            <button type="submit" class="bg-green-600 hover:bg-green-700 text-white px-6 py-2 rounded-lg">Kirim Pendaftaran</button>
            <a href="{{ route('pendaftaran.index') }}" class="bg-gray-200 hover:bg-gray-300 px-6 py-2 rounded-lg">Batal</a>
        </div>
    </form>
</div>
@endsection