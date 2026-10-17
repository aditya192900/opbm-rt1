@extends('layouts.app')

@section('title', 'Dokumentasi Kegiatan')

@section('content')
<div class="flex justify-between items-center mb-6">
    <div>
        <h1 class="text-2xl font-bold">Dokumentasi Kegiatan RT 01</h1>
        <p class="text-gray-500 text-sm">Foto & catatan kegiatan warga</p>
    </div>
    <a href="{{ route('dokumentasi.create') }}" class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-lg">
        Tambah Dokumentasi
    </a>
</div>

<div class="grid grid-cols-1 md:grid-cols-3 gap-6">
    @forelse($dokumentasis as $d)
    <div class="bg-white rounded-lg shadow overflow-hidden">
        @if($d->foto)
            <img src="{{ asset('storage/' . $d->foto) }}" class="w-full h-48 object-cover">
        @else
            <div class="w-full h-48 bg-gray-200 flex items-center justify-center text-gray-400">Tidak ada foto</div>
        @endif
        <div class="p-4">
            <p class="text-xs text-gray-500">{{ \Carbon\Carbon::parse($d->tanggal_kegiatan)->format('d M Y') }}</p>
            <h3 class="font-bold text-lg">{{ $d->judul }}</h3>
            <p class="text-gray-600 text-sm mt-1">{{ \Illuminate\Support\Str::limit($d->deskripsi, 80) }}</p>
            <div class="mt-3 space-x-2">
                <a href="{{ route('dokumentasi.edit', $d) }}" class="text-blue-600 text-sm">Edit</a>
                <form action="{{ route('dokumentasi.destroy', $d) }}" method="POST" class="inline" onsubmit="return confirm('Hapus?')">
                    @csrf @method('DELETE')
                    <button class="text-red-600 text-sm">Hapus</button>
                </form>
            </div>
        </div>
    </div>
    @empty
    <div class="col-span-3 text-center py-12 text-gray-400">Belum ada dokumentasi.</div>
    @endforelse
</div>

<div class="mt-6">{{ $dokumentasis->links() }}</div>
@endsection