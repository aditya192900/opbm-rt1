@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class="mb-8">
    <h1 class="text-3xl font-bold text-gray-800">Dashboard OPBM RT 01</h1>
    <p class="text-gray-500">Ringkasan kegiatan Kampung Digital RT 01</p>
</div>

{{-- STATISTIK --}}
<div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
    <div class="bg-white p-6 rounded-lg shadow border-l-4 border-green-500">
        <p class="text-gray-500 text-sm uppercase">Warga Terdaftar OPBM</p>
        <p class="text-4xl font-bold text-green-600 mt-2">{{ $totalPendaftar }}</p>
        <p class="text-xs text-gray-400 mt-1">{{ $totalPendaftarAktif }} aktif</p>
    </div>
    <div class="bg-white p-6 rounded-lg shadow border-l-4 border-blue-500">
        <p class="text-gray-500 text-sm uppercase">Jadwal Penjemputan</p>
        <p class="text-4xl font-bold text-blue-600 mt-2">{{ $totalJadwal }}</p>
        <p class="text-xs text-gray-400 mt-1">zona aktif</p>
    </div>
    <div class="bg-white p-6 rounded-lg shadow border-l-4 border-yellow-500">
        <p class="text-gray-500 text-sm uppercase">Laporan Warga</p>
        <p class="text-4xl font-bold text-yellow-600 mt-2">{{ $totalLaporan }}</p>
        <p class="text-xs text-gray-400 mt-1">{{ $totalLaporanPending }} pending</p>
    </div>
    <div class="bg-white p-6 rounded-lg shadow border-l-4 border-purple-500">
        <p class="text-gray-500 text-sm uppercase">UMKM Warga</p>
        <p class="text-4xl font-bold text-purple-600 mt-2">{{ $totalUmkm }}</p>
        <p class="text-xs text-gray-400 mt-1">usaha terdaftar</p>
    </div>
</div>

{{-- MENU CEPAT --}}
<div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
    <a href="{{ route('jadwal.index') }}" class="bg-white p-6 rounded-lg shadow hover:shadow-lg transition">
        <h3 class="font-bold text-lg text-green-700">Jadwal OPBM</h3>
        <p class="text-gray-500 text-sm mt-1">Lihat jadwal penjemputan sampah</p>
    </a>
    <a href="{{ route('pendaftaran.index') }}" class="bg-white p-6 rounded-lg shadow hover:shadow-lg transition">
        <h3 class="font-bold text-lg text-blue-700">Pendaftaran</h3>
        <p class="text-gray-500 text-sm mt-1">Daftar layanan OPBM</p>
    </a>
    <a href="{{ route('laporan.index') }}" class="bg-white p-6 rounded-lg shadow hover:shadow-lg transition">
        <h3 class="font-bold text-lg text-yellow-700">Laporan Warga</h3>
        <p class="text-gray-500 text-sm mt-1">Lapor masalah sampah</p>
    </a>
    <a href="{{ route('umkm.index') }}" class="bg-white p-6 rounded-lg shadow hover:shadow-lg transition">
        <h3 class="font-bold text-lg text-purple-700">UMKM Warga</h3>
        <p class="text-gray-500 text-sm mt-1">Direktori usaha warga RT 1</p>
    </a>
</div>

{{-- AKTIVITAS TERBARU --}}
<div class="grid grid-cols-1 md:grid-cols-2 gap-6">
    <div class="bg-white rounded-lg shadow p-6">
        <h3 class="font-bold text-lg mb-4">Laporan Terbaru</h3>
        @forelse($laporanTerbaru as $l)
            <div class="border-b py-3 last:border-b-0">
                <p class="font-semibold">{{ $l->judul }}</p>
                <p class="text-gray-500 text-sm">oleh {{ $l->user->name ?? 'Anonim' }} - {{ $l->created_at->diffForHumans() }}</p>
            </div>
        @empty
            <p class="text-gray-400 text-sm">Belum ada laporan.</p>
        @endforelse
    </div>

    <div class="bg-white rounded-lg shadow p-6">
        <h3 class="font-bold text-lg mb-4">Pendaftar Terbaru</h3>
        @forelse($pendaftarTerbaru as $p)
            <div class="border-b py-3 last:border-b-0">
                <p class="font-semibold">{{ $p->nama_kepala_keluarga }}</p>
                <p class="text-gray-500 text-sm">{{ $p->zona }} - {{ $p->created_at->diffForHumans() }}</p>
            </div>
        @empty
            <p class="text-gray-400 text-sm">Belum ada pendaftar.</p>
        @endforelse
    </div>
</div>
@endsection