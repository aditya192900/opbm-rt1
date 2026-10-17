@extends('layouts.app')

@section('title', 'Jadwal OPBM')

@section('content')

<style>
    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(10px); }
        to { opacity: 1; transform: translateY(0); }
    }
    .fade-in { animation: fadeIn 0.4s ease-out; }

    .jadwal-card {
        background: white;
        border-radius: 20px;
        padding: 24px;
        border: 1px solid #f3f4f6;
        box-shadow: 0 1px 3px rgba(0,0,0,0.04);
        transition: all 0.3s;
        position: relative;
        overflow: hidden;
    }
    .jadwal-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 20px 40px rgba(16, 185, 129, 0.1);
        border-color: #d1fae5;
    }
    .jadwal-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 5px;
        height: 100%;
        background: linear-gradient(180deg, #34d399, #047857);
    }

    .action-btn {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 8px 14px;
        border-radius: 9999px;
        font-size: 12px;
        font-weight: 700;
        text-decoration: none;
        border: none;
        cursor: pointer;
        transition: all 0.2s;
    }
    .action-edit {
        background: #dbeafe;
        color: #1e40af;
    }
    .action-edit:hover {
        background: #3b82f6;
        color: white;
        transform: scale(1.05);
    }
    .action-delete {
        background: #fee2e2;
        color: #b91c1c;
    }
    .action-delete:hover {
        background: #ef4444;
        color: white;
        transform: scale(1.05);
    }
</style>

{{-- HEADER --}}
<div class="flex justify-between items-center mb-6 flex-wrap gap-3 fade-in">
    <div>
        <h1 class="text-2xl font-bold">Jadwal Penjemputan OPBM</h1>
        <p class="text-gray-500 text-sm">Kelola jadwal bentor OPBM di lingkungan RT 01</p>
    </div>
    <a href="{{ route('jadwal.create') }}" class="inline-flex items-center gap-2 text-white px-5 py-3 rounded-full font-bold shadow-md hover:shadow-lg transition"
       style="background: linear-gradient(135deg, #10b981 0%, #047857 100%);">
        <svg width="18" height="18" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
        </svg>
        Tambah Jadwal
    </a>
</div>

{{-- INFO STATISTIK --}}
<div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-6 fade-in">
    <div class="bg-white rounded-2xl shadow-sm border-l-4 border-emerald-500 p-5">
        <p class="text-xs text-gray-500 uppercase font-semibold tracking-wider">Total Jadwal</p>
        <p class="text-3xl font-bold text-emerald-600 mt-1">{{ $jadwals->total() }}</p>
        <p class="text-xs text-gray-400 mt-1">hari aktif</p>
    </div>
    <div class="bg-white rounded-2xl shadow-sm border-l-4 border-blue-500 p-5">
        <p class="text-xs text-gray-500 uppercase font-semibold tracking-wider">Zona Aktif</p>
        <p class="text-3xl font-bold text-blue-600 mt-1">{{ $jadwals->pluck('zona')->unique()->count() }}</p>
        <p class="text-xs text-gray-400 mt-1">wilayah layanan</p>
    </div>
    <div class="bg-white rounded-2xl shadow-sm border-l-4 border-yellow-500 p-5">
        <p class="text-xs text-gray-500 uppercase font-semibold tracking-wider">Jam Mulai</p>
        <p class="text-2xl font-bold text-yellow-600 mt-1">{{ $jadwals->first()->jam_mulai ?? '-' }}</p>
        <p class="text-xs text-gray-400 mt-1">penjemputan pertama</p>
    </div>
    <div class="bg-white rounded-2xl shadow-sm border-l-4 border-purple-500 p-5">
        <p class="text-xs text-gray-500 uppercase font-semibold tracking-wider">Status</p>
        <p class="text-xl font-bold text-purple-600 mt-1">Aktif</p>
        <p class="text-xs text-gray-400 mt-1">semua jadwal berjalan</p>
    </div>
</div>

{{-- LIST JADWAL --}}
@if($jadwals->count() > 0)
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-5 fade-in">
    @php
        $hariIcon = [
            'Senin' => '1️⃣', 'Selasa' => '2️⃣', 'Rabu' => '3️⃣', 'Kamis' => '4️⃣',
            'Jumat' => '5️⃣', 'Sabtu' => '6️⃣', 'Minggu' => '7️⃣'
        ];
    @endphp
    @foreach($jadwals as $j)
    <div class="jadwal-card">
        {{-- Header --}}
        <div class="flex justify-between items-start mb-4">
            <div class="flex items-center gap-3">
                <div class="w-12 h-12 rounded-xl flex items-center justify-center text-white font-bold text-lg"
                     style="background: linear-gradient(135deg, #34d399 0%, #047857 100%);">
                    {{ substr($j->hari, 0, 2) }}
                </div>
                <div>
                    <h3 class="font-extrabold text-xl text-gray-800">{{ $j->hari }}</h3>
                    <p class="text-xs text-gray-500">Hari penjemputan</p>
                </div>
            </div>
            <span class="bg-emerald-100 text-emerald-700 px-3 py-1 rounded-full text-xs font-bold">
                {{ $j->zona }}
            </span>
        </div>

        {{-- Waktu --}}
        <div class="bg-gradient-to-br from-emerald-50 to-white rounded-xl p-4 mb-4 border border-emerald-100">
            <div class="flex items-center gap-2 text-gray-700">
                <svg width="20" height="20" fill="none" stroke="#047857" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
                <div>
                    <p class="text-xs text-gray-500">Jam Penjemputan</p>
                    <p class="font-bold text-gray-800">{{ $j->jam_mulai }} - {{ $j->jam_selesai }}</p>
                </div>
            </div>
        </div>

        {{-- Keterangan --}}
        @if($j->keterangan)
        <div class="flex items-start gap-2 mb-4">
            <svg width="16" height="16" fill="none" stroke="#6b7280" viewBox="0 0 24 24" class="mt-0.5 flex-shrink-0">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
            </svg>
            <p class="text-sm text-gray-600">{{ $j->keterangan }}</p>
        </div>
        @endif

        {{-- Actions --}}
        <div class="flex gap-2 pt-4 border-t border-gray-100">
            <a href="{{ route('jadwal.edit', $j) }}" class="action-btn action-edit flex-1 justify-center">
                <svg width="14" height="14" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                </svg>
                Edit
            </a>
            <form action="{{ route('jadwal.destroy', $j) }}" method="POST" onsubmit="return confirm('Hapus jadwal {{ $j->hari }}?')" class="flex-1">
                @csrf @method('DELETE')
                <button type="submit" class="action-btn action-delete w-full justify-center">
                    <svg width="14" height="14" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                    </svg>
                    Hapus
                </button>
            </form>
        </div>
    </div>
    @endforeach
</div>

<div class="mt-6">{{ $jadwals->links() }}</div>
@else
<div class="bg-white rounded-2xl shadow-sm border border-gray-100 text-center py-20 fade-in">
    <div class="w-20 h-20 bg-emerald-100 rounded-full flex items-center justify-center mx-auto mb-4">
        <svg width="40" height="40" fill="none" stroke="#047857" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
        </svg>
    </div>
    <p class="text-gray-500 font-semibold">Belum ada jadwal</p>
    <p class="text-gray-400 text-sm mt-1">Klik "Tambah Jadwal" untuk memulai</p>
    <a href="{{ route('jadwal.create') }}" class="inline-block mt-4 text-white px-6 py-2.5 rounded-full font-bold text-sm"
       style="background: linear-gradient(135deg, #10b981 0%, #047857 100%);">
        + Tambah Jadwal Pertama
    </a>
</div>
@endif

@endsection