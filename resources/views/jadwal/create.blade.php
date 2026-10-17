@extends('layouts.app')

@section('title', 'Tambah Jadwal')

@section('content')

<style>
    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(10px); }
        to { opacity: 1; transform: translateY(0); }
    }
    .fade-in { animation: fadeIn 0.4s ease-out; }

    .form-input {
        width: 100%;
        border: 2px solid #e5e7eb;
        border-radius: 12px;
        padding: 12px 16px;
        font-size: 14px;
        outline: none;
        transition: all 0.2s;
        background: #ffffff;
    }
    .form-input:focus {
        border-color: #10b981;
        box-shadow: 0 0 0 4px rgba(16, 185, 129, 0.1);
    }
    .form-input:hover { border-color: #d1d5db; }
    .form-label {
        display: block;
        font-weight: 600;
        font-size: 13px;
        color: #374151;
        margin-bottom: 8px;
    }
    .required-star { color: #ef4444; }

    .hari-option {
        padding: 12px 16px;
        border: 2px solid #e5e7eb;
        border-radius: 12px;
        text-align: center;
        cursor: pointer;
        transition: all 0.2s;
        font-weight: 600;
        font-size: 14px;
        background: white;
        color: #374151;
    }
    .hari-option:hover {
        border-color: #10b981;
        background: #f0fdf4;
    }
    .hari-option.selected {
        border-color: #10b981;
        background: linear-gradient(135deg, #10b981 0%, #047857 100%);
        color: white;
        box-shadow: 0 8px 20px rgba(16, 185, 129, 0.3);
    }

    .quick-time {
        padding: 6px 12px;
        border-radius: 9999px;
        font-size: 11px;
        font-weight: 700;
        border: 1px solid #e5e7eb;
        background: #f9fafb;
        color: #374151;
        cursor: pointer;
        transition: all 0.2s;
    }
    .quick-time:hover {
        background: #ecfdf5;
        border-color: #10b981;
        color: #047857;
    }
</style>

{{-- HEADER --}}
<div class="flex justify-between items-center mb-6 flex-wrap gap-3 fade-in">
    <div>
        <a href="{{ route('jadwal.index') }}" class="inline-flex items-center gap-1 text-emerald-600 hover:text-emerald-700 text-sm font-medium mb-2">
            <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
            </svg>
            Kembali ke Jadwal
        </a>
        <h1 class="text-2xl font-bold">Tambah Jadwal OPBM</h1>
        <p class="text-gray-500 text-sm">Buat jadwal penjemputan sampah baru</p>
    </div>
</div>

<form action="{{ route('jadwal.store') }}" method="POST" class="fade-in"
      x-data="{ hari: '{{ old('hari') }}' }">
    @csrf

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

        {{-- KOLOM KIRI: FORM --}}
        <div class="lg:col-span-2 space-y-6">

            {{-- HARI --}}
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 md:p-8">
                <div class="flex items-center gap-3 mb-6 pb-4 border-b border-gray-100">
                    <div class="w-10 h-10 rounded-xl bg-emerald-100 flex items-center justify-center">
                        <svg class="w-5 h-5 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                        </svg>
                    </div>
                    <div>
                        <h2 class="font-bold text-lg text-gray-800">Pilih Hari</h2>
                        <p class="text-xs text-gray-500">Klik salah satu hari untuk memilih</p>
                    </div>
                </div>

                <input type="hidden" name="hari" x-model="hari" required>
                <div class="grid grid-cols-4 md:grid-cols-7 gap-2">
                    @foreach(['Senin','Selasa','Rabu','Kamis','Jumat','Sabtu','Minggu'] as $h)
                    <div class="hari-option" :class="{ 'selected': hari === '{{ $h }}' }"
                         @click="hari = '{{ $h }}'">
                        {{ $h }}
                    </div>
                    @endforeach
                </div>
                @error('hari') <p class="text-red-500 text-xs mt-2">{{ $message }}</p> @enderror
            </div>

            {{-- JAM --}}
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 md:p-8">
                <div class="flex items-center gap-3 mb-6 pb-4 border-b border-gray-100">
                    <div class="w-10 h-10 rounded-xl bg-blue-100 flex items-center justify-center">
                        <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                    <div>
                        <h2 class="font-bold text-lg text-gray-800">Waktu Penjemputan</h2>
                        <p class="text-xs text-gray-500">Tentukan jam mulai dan selesai</p>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                    <div x-data="{ jm: '{{ old('jam_mulai', '08:00') }}' }">
                        <label class="form-label">
                            Jam Mulai <span class="required-star">*</span>
                        </label>
                        <input type="time" name="jam_mulai" x-model="jm" class="form-input" required>
                        <div class="flex flex-wrap gap-2 mt-2">
                            <button type="button" class="quick-time" @click="jm = '07:00'">07:00</button>
                            <button type="button" class="quick-time" @click="jm = '08:00'">08:00</button>
                            <button type="button" class="quick-time" @click="jm = '09:00'">09:00</button>
                        </div>
                        @error('jam_mulai') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>
                    <div x-data="{ js: '{{ old('jam_selesai', '10:00') }}' }">
                        <label class="form-label">
                            Jam Selesai <span class="required-star">*</span>
                        </label>
                        <input type="time" name="jam_selesai" x-model="js" class="form-input" required>
                        <div class="flex flex-wrap gap-2 mt-2">
                            <button type="button" class="quick-time" @click="js = '10:00'">10:00</button>
                            <button type="button" class="quick-time" @click="js = '11:00'">11:00</button>
                            <button type="button" class="quick-time" @click="js = '12:00'">12:00</button>
                        </div>
                        @error('jam_selesai') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>
                </div>
            </div>

            {{-- ZONA & KETERANGAN --}}
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 md:p-8">
                <div class="flex items-center gap-3 mb-6 pb-4 border-b border-gray-100">
                    <div class="w-10 h-10 rounded-xl bg-purple-100 flex items-center justify-center">
                        <svg class="w-5 h-5 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                        </svg>
                    </div>
                    <div>
                        <h2 class="font-bold text-lg text-gray-800">Zona & Keterangan</h2>
                        <p class="text-xs text-gray-500">Detail lokasi penjemputan</p>
                    </div>
                </div>

                <div class="space-y-5">
                    <div>
                        <label class="form-label">
                            Zona <span class="required-star">*</span>
                        </label>
                        <input type="text" name="zona" value="{{ old('zona', 'RT 01') }}"
                               placeholder="Contoh: RT 01A, Blok A1"
                               class="form-input" required>
                        @error('zona') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label class="form-label">
                            Keterangan <span class="text-gray-400 font-normal text-xs">(opsional)</span>
                        </label>
                        <textarea name="keterangan" rows="3"
                                  placeholder="Contoh: Depan portal masuk"
                                  class="form-input" style="resize:vertical;">{{ old('keterangan') }}</textarea>
                    </div>
                </div>
            </div>

            {{-- TOMBOL AKSI --}}
            <div class="flex gap-3">
                <button type="submit"
                        class="flex-1 text-white px-6 py-4 rounded-2xl font-bold shadow-lg hover:shadow-xl transition-all flex items-center justify-center gap-2"
                        style="background: linear-gradient(135deg, #10b981 0%, #047857 100%);">
                    <svg width="20" height="20" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/>
                    </svg>
                    Simpan Jadwal
                </button>
                <a href="{{ route('jadwal.index') }}"
                   class="px-6 py-4 rounded-2xl bg-gray-100 hover:bg-gray-200 text-gray-700 font-bold transition-all">
                    Batal
                </a>
            </div>
        </div>

        {{-- KOLOM KANAN: TIPS --}}
        <div class="lg:col-span-1">
            <div class="rounded-2xl p-6 text-white sticky top-24" style="background: linear-gradient(135deg, #047857 0%, #064e3b 100%);">
                <div class="flex items-center gap-2 mb-4">
                    <svg width="20" height="20" fill="none" stroke="#fbbf24" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"/>
                    </svg>
                    <h3 class="font-bold text-base">Tips Jadwal</h3>
                </div>
                <ul class="space-y-3 text-sm text-emerald-50">
                    <li class="flex gap-2">
                        <span class="text-yellow-400 font-bold flex-shrink-0">✓</span>
                        <span>Buat jadwal <strong class="text-white">1-2x seminggu</strong> agar tidak terlalu sering</span>
                    </li>
                    <li class="flex gap-2">
                        <span class="text-yellow-400 font-bold flex-shrink-0">✓</span>
                        <span>Pilih jam pagi (07:00-10:00) saat warga siap buang sampah</span>
                    </li>
                    <li class="flex gap-2">
                        <span class="text-yellow-400 font-bold flex-shrink-0">✓</span>
                        <span>Sebutkan lokasi <strong class="text-white">spesifik</strong> agar jelas</span>
                    </li>
                    <li class="flex gap-2">
                        <span class="text-yellow-400 font-bold flex-shrink-0">✓</span>
                        <span>Info jadwal akan <strong class="text-white">otomatis muncul</strong> di halaman publik</span>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</form>

@endsection