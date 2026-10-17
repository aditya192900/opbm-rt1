@extends('layouts.app')

@section('title', 'Laporan Warga')

@section('content')
<div class="flex justify-between items-center mb-6">
    <div>
        <h1 class="text-2xl font-bold">Laporan Warga</h1>
        <p class="text-gray-500 text-sm">Laporan masalah sampah di lingkungan RT 01</p>
    </div>
    <a href="{{ route('laporan.create') }}" class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-lg">
        Buat Laporan
    </a>
</div>

<div class="bg-white rounded-lg shadow overflow-hidden">
    <table class="w-full">
        <thead class="bg-gray-50 border-b">
            <tr>
                <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase">Judul</th>
                <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase">Pelapor</th>
                <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase">Lokasi</th>
                <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase">Status</th>
                <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase">Tanggal</th>
            </tr>
        </thead>
        <tbody class="divide-y">
            @forelse($laporans as $laporan)
            <tr class="hover:bg-gray-50">
                <td class="px-6 py-4 font-semibold">{{ $laporan->judul }}</td>
                <td class="px-6 py-4">{{ $laporan->user->name ?? 'Anonim' }}</td>
                <td class="px-6 py-4 text-gray-600">{{ $laporan->lokasi ?? '-' }}</td>
                <td class="px-6 py-4">
                    @if($laporan->status == 'pending')
                        <span class="bg-yellow-100 text-yellow-800 px-2 py-1 rounded text-xs">Pending</span>
                    @elseif($laporan->status == 'diproses')
                        <span class="bg-blue-100 text-blue-800 px-2 py-1 rounded text-xs">Diproses</span>
                    @else
                        <span class="bg-green-100 text-green-800 px-2 py-1 rounded text-xs">Selesai</span>
                    @endif
                </td>
                <td class="px-6 py-4 text-gray-500 text-sm">{{ $laporan->created_at->format('d M Y') }}</td>
            </tr>
            @empty
            <tr>
                <td colspan="5" class="px-6 py-12 text-center text-gray-400">
                    Belum ada laporan warga.
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>

<div class="mt-4">{{ $laporans->links() }}</div>
@endsection