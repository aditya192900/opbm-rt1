@extends('layouts.app')

@section('title', 'Struktur Pengurus RT')

@section('content')
<div class="flex justify-between items-center mb-6">
    <div>
        <h1 class="text-2xl font-bold">Struktur Pengurus RT 01</h1>
        <p class="text-gray-500 text-sm">Daftar pengurus aktif RT 01</p>
    </div>
    <a href="{{ route('pengurus.create') }}" class="bg-emerald-600 hover:bg-emerald-700 text-white px-5 py-2.5 rounded-full shadow-sm font-medium text-sm transition">
        + Tambah Pengurus
    </a>
</div>

@php
    $pimpinan = $penguruss->filter(fn($p) => in_array($p->jabatan, ['Ketua RT', 'Wakil Ketua RT']));
    $inti = $penguruss->filter(fn($p) => in_array($p->jabatan, ['Sekretaris', 'Bendahara']));
    $seksi = $penguruss->filter(fn($p) => !in_array($p->jabatan, ['Ketua RT', 'Wakil Ketua RT', 'Sekretaris', 'Bendahara']));
@endphp

{{-- PIMPINAN --}}
@if($pimpinan->count() > 0)
<div class="mb-10">
    <h2 class="text-xs font-bold tracking-widest text-emerald-600 uppercase mb-4">Pimpinan</h2>
    <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
        @foreach($pimpinan as $p)
        <div class="group bg-white rounded-2xl p-6 text-center shadow-sm border border-gray-100 hover:shadow-xl hover:-translate-y-1 transition-all duration-300">
            <div class="relative inline-block mb-3">
                <div class="w-20 h-20 rounded-full p-1 mx-auto group-hover:scale-105 transition-transform duration-300" style="background: linear-gradient(135deg, #34d399, #047857);">
                    <div class="w-full h-full rounded-full bg-white flex items-center justify-center overflow-hidden">
                        @if($p->foto)
                            <img src="{{ asset('storage/' . $p->foto) }}" class="w-full h-full object-cover">
                        @else
                            <span class="text-emerald-700 font-bold text-xl">{{ strtoupper(substr($p->nama, 0, 2)) }}</span>
                        @endif
                    </div>
                </div>
            </div>
            <h3 class="font-bold text-sm text-gray-800 leading-tight">{{ $p->nama }}</h3>
            <p class="text-emerald-600 text-xs font-semibold mt-1">{{ $p->jabatan }}</p>
            <div class="mt-3 opacity-0 group-hover:opacity-100 transition-opacity flex justify-center gap-2 text-xs">
                <a href="{{ route('pengurus.edit', $p) }}" class="text-blue-600 hover:underline">Edit</a>
                <span class="text-gray-300">|</span>
                <form action="{{ route('pengurus.destroy', $p) }}" method="POST" class="inline" onsubmit="return confirm('Hapus?')">
                    @csrf @method('DELETE')
                    <button class="text-red-500 hover:underline">Hapus</button>
                </form>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endif

{{-- INTI --}}
@if($inti->count() > 0)
<div class="mb-10">
    <h2 class="text-xs font-bold tracking-widest text-emerald-600 uppercase mb-4">Pengurus Inti</h2>
    <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
        @foreach($inti as $p)
        <div class="group bg-white rounded-2xl p-6 text-center shadow-sm border border-gray-100 hover:shadow-xl hover:-translate-y-1 transition-all duration-300">
            <div class="relative inline-block mb-3">
                <div class="w-20 h-20 rounded-full p-1 mx-auto group-hover:scale-105 transition-transform duration-300" style="background: linear-gradient(135deg, #34d399, #047857);">
                    <div class="w-full h-full rounded-full bg-white flex items-center justify-center overflow-hidden">
                        @if($p->foto)
                            <img src="{{ asset('storage/' . $p->foto) }}" class="w-full h-full object-cover">
                        @else
                            <span class="text-emerald-700 font-bold text-xl">{{ strtoupper(substr($p->nama, 0, 2)) }}</span>
                        @endif
                    </div>
                </div>
            </div>
            <h3 class="font-bold text-sm text-gray-800 leading-tight">{{ $p->nama }}</h3>
            <p class="text-emerald-600 text-xs font-semibold mt-1">{{ $p->jabatan }}</p>
            <div class="mt-3 opacity-0 group-hover:opacity-100 transition-opacity flex justify-center gap-2 text-xs">
                <a href="{{ route('pengurus.edit', $p) }}" class="text-blue-600 hover:underline">Edit</a>
                <span class="text-gray-300">|</span>
                <form action="{{ route('pengurus.destroy', $p) }}" method="POST" class="inline" onsubmit="return confirm('Hapus?')">
                    @csrf @method('DELETE')
                    <button class="text-red-500 hover:underline">Hapus</button>
                </form>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endif

{{-- SEKSI --}}
@if($seksi->count() > 0)
<div class="mb-10">
    <h2 class="text-xs font-bold tracking-widest text-emerald-600 uppercase mb-4">Seksi & Anggota</h2>
    <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
        @foreach($seksi as $p)
        <div class="group bg-white rounded-2xl p-6 text-center shadow-sm border border-gray-100 hover:shadow-xl hover:-translate-y-1 transition-all duration-300">
            <div class="relative inline-block mb-3">
                <div class="w-20 h-20 rounded-full p-1 mx-auto group-hover:scale-105 transition-transform duration-300" style="background: linear-gradient(135deg, #34d399, #047857);">
                    <div class="w-full h-full rounded-full bg-white flex items-center justify-center overflow-hidden">
                        @if($p->foto)
                            <img src="{{ asset('storage/' . $p->foto) }}" class="w-full h-full object-cover">
                        @else
                            <span class="text-emerald-700 font-bold text-xl">{{ strtoupper(substr($p->nama, 0, 2)) }}</span>
                        @endif
                    </div>
                </div>
            </div>
            <h3 class="font-bold text-sm text-gray-800 leading-tight">{{ $p->nama }}</h3>
            <p class="text-emerald-600 text-xs font-semibold mt-1">{{ $p->jabatan }}</p>
            <div class="mt-3 opacity-0 group-hover:opacity-100 transition-opacity flex justify-center gap-2 text-xs">
                <a href="{{ route('pengurus.edit', $p) }}" class="text-blue-600 hover:underline">Edit</a>
                <span class="text-gray-300">|</span>
                <form action="{{ route('pengurus.destroy', $p) }}" method="POST" class="inline" onsubmit="return confirm('Hapus?')">
                    @csrf @method('DELETE')
                    <button class="text-red-500 hover:underline">Hapus</button>
                </form>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endif

@if($penguruss->isEmpty())
<div class="text-center py-16">
    <p class="text-gray-400">Belum ada data pengurus. Klik "Tambah Pengurus" untuk memulai.</p>
</div>
@endif

<div class="mt-6">{{ $penguruss->links() }}</div>
@endsection