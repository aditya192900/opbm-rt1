@extends('layouts.app')

@section('title', 'Edit Pendaftaran')

@section('content')
<div class="max-w-2xl mx-auto">
    <h1 class="text-2xl font-bold mb-6">✏️ Edit Data Pendaftaran</h1>

    <form action="{{ route('pendaftaran.update', $pendaftaran) }}" method="POST" class="bg-white p-6 rounded-lg shadow space-y-4">
        @csrf @method('PUT')

        <div>
            <label class="block font-semibold mb-1">Nama Kepala Keluarga</label>
            <input type="text" name="nama_kepala_keluarga" value="{{ old('nama_kepala_keluarga', $pendaftaran->nama_kepala_keluarga) }}" class="w-full border rounded px-3 py-2" required>
        </div>

        <div>
            <label class="block font-semibold mb-1">NIK</label>
            <input type="text" name="nik" value="{{ old('nik', $pendaftaran->nik) }}" maxlength="16" class="w-full border rounded px-3 py-2" required>
        </div>

        <div>
            <label class="block font-semibold mb-1">No HP</label>
            <input type="text" name="no_hp" value="{{ old('no_hp', $pendaftaran->no_hp) }}" class="w-full border rounded px-3 py-2" required>
        </div>

        <div>
            <label class="block font-semibold mb-1">Alamat</label>
            <textarea name="alamat" rows="3" class="w-full border rounded px-3 py-2" required>{{ old('alamat', $pendaftaran->alamat) }}</textarea>
        </div>

        <div class="grid grid-cols-2 gap-4">
            <div>
                <label class="block font-semibold mb-1">Zona</label>
                <input type="text" name="zona" value="{{ old('zona', $pendaftaran->zona) }}" class="w-full border rounded px-3 py-2">
            </div>
            <div>
                <label class="block font-semibold mb-1">Status</label>
                <select name="status" class="w-full border rounded px-3 py-2">
                    @foreach(['pending','aktif','nonaktif'] as $s)
                        <option value="{{ $s }}" @selected($pendaftaran->status == $s)>{{ ucfirst($s) }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="flex gap-3 pt-4">
            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-lg">Update</button>
            <a href="{{ route('pendaftaran.index') }}" class="bg-gray-200 hover:bg-gray-300 px-6 py-2 rounded-lg">Batal</a>
        </div>
    </form>
</div>
@endsection