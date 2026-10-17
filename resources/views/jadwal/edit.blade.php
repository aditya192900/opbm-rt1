@extends('layouts.app')

@section('title', 'Edit Jadwal')

@section('content')
<div class="max-w-2xl mx-auto">
    <h1 class="text-2xl font-bold mb-6">✏️ Edit Jadwal OPBM</h1>

    <form action="{{ route('jadwal.update', $jadwal) }}" method="POST" class="bg-white p-6 rounded-lg shadow space-y-4">
        @csrf @method('PUT')

        <div>
            <label class="block font-semibold mb-1">Hari</label>
            <select name="hari" class="w-full border rounded px-3 py-2" required>
                @foreach(['Senin','Selasa','Rabu','Kamis','Jumat','Sabtu','Minggu'] as $h)
                    <option value="{{ $h }}" @selected(old('hari', $jadwal->hari) == $h)>{{ $h }}</option>
                @endforeach
            </select>
        </div>

        <div class="grid grid-cols-2 gap-4">
            <div>
                <label class="block font-semibold mb-1">Jam Mulai</label>
                <input type="time" name="jam_mulai" value="{{ old('jam_mulai', $jadwal->jam_mulai) }}" class="w-full border rounded px-3 py-2" required>
            </div>
            <div>
                <label class="block font-semibold mb-1">Jam Selesai</label>
                <input type="time" name="jam_selesai" value="{{ old('jam_selesai', $jadwal->jam_selesai) }}" class="w-full border rounded px-3 py-2" required>
            </div>
        </div>

        <div>
            <label class="block font-semibold mb-1">Zona</label>
            <input type="text" name="zona" value="{{ old('zona', $jadwal->zona) }}" class="w-full border rounded px-3 py-2" required>
        </div>

        <div>
            <label class="block font-semibold mb-1">Keterangan</label>
            <textarea name="keterangan" rows="3" class="w-full border rounded px-3 py-2">{{ old('keterangan', $jadwal->keterangan) }}</textarea>
        </div>

        <div class="flex gap-3 pt-4">
            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-lg">Update</button>
            <a href="{{ route('jadwal.index') }}" class="bg-gray-200 hover:bg-gray-300 px-6 py-2 rounded-lg">Batal</a>
        </div>
    </form>
</div>
@endsection