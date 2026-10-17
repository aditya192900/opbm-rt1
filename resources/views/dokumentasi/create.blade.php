@extends('layouts.app')

@section('title', 'Tambah Dokumentasi')

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
    .form-input:hover {
        border-color: #d1d5db;
    }
    .form-label {
        display: block;
        font-weight: 600;
        font-size: 13px;
        color: #374151;
        margin-bottom: 8px;
    }
    .required-star { color: #ef4444; }

    .preset-btn {
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
    .preset-btn:hover {
        background: #ecfdf5;
        border-color: #10b981;
        color: #047857;
    }
    .preset-btn.active {
        background: #ecfdf5;
        border-color: #10b981;
        color: #047857;
    }

    .upload-area {
        border: 2px dashed #d1d5db;
        border-radius: 16px;
        padding: 24px;
        text-align: center;
        cursor: pointer;
        transition: all 0.2s;
        background: #f9fafb;
    }
    .upload-area:hover {
        border-color: #10b981;
        background: #ecfdf5;
    }
</style>

{{-- HEADER --}}
<div class="flex justify-between items-center mb-6 flex-wrap gap-3 fade-in">
    <div>
        <a href="{{ route('dokumentasi.index') }}" class="inline-flex items-center gap-1 text-emerald-600 hover:text-emerald-700 text-sm font-medium mb-2">
            <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
            </svg>
            Kembali ke Dokumentasi
        </a>
        <h1 class="text-2xl font-bold">Tambah Dokumentasi Kegiatan</h1>
        <p class="text-gray-500 text-sm">Catat dan abadikan kegiatan warga RT 01</p>
    </div>
</div>

<form action="{{ route('dokumentasi.store') }}" method="POST" enctype="multipart/form-data" class="fade-in">
    @csrf

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

        {{-- KOLOM KIRI: FORM UTAMA --}}
        <div class="lg:col-span-2 space-y-6">

            {{-- SECTION 1: INFO KEGIATAN --}}
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 md:p-8">
                <div class="flex items-center gap-3 mb-6 pb-4 border-b border-gray-100">
                    <div class="w-10 h-10 rounded-xl bg-emerald-100 flex items-center justify-center">
                        <svg class="w-5 h-5 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                        </svg>
                    </div>
                    <div>
                        <h2 class="font-bold text-lg text-gray-800">Informasi Kegiatan</h2>
                        <p class="text-xs text-gray-500">Detail dasar dokumentasi</p>
                    </div>
                </div>

                <div class="space-y-5">
                    {{-- JUDUL --}}
                    <div>
                        <label class="form-label">
                            Judul Kegiatan <span class="required-star">*</span>
                        </label>
                        <input type="text" name="judul" value="{{ old('judul') }}"
                               placeholder="Contoh: Kerja Bakti Bersih Kampung"
                               class="form-input" required autofocus>
                        @error('judul') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>

                    {{-- DESKRIPSI --}}
                    <div x-data="{ count: {{ strlen(old('deskripsi', '')) }} }">
                        <div class="flex justify-between items-center mb-2">
                            <label class="form-label" style="margin-bottom:0;">
                                Deskripsi Kegiatan <span class="required-star">*</span>
                            </label>
                            <span class="text-xs text-gray-400" x-text="count + ' karakter'"></span>
                        </div>
                        <textarea name="deskripsi" rows="5"
                                  @input="count = $event.target.value.length"
                                  placeholder="Ceritakan kegiatan yang berlangsung, siapa yang terlibat, dan hasilnya..."
                                  class="form-input" style="resize:vertical;" required>{{ old('deskripsi') }}</textarea>
                        @error('deskripsi') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>
                </div>
            </div>

            {{-- SECTION 2: WAKTU & LOKASI --}}
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 md:p-8">
                <div class="flex items-center gap-3 mb-6 pb-4 border-b border-gray-100">
                    <div class="w-10 h-10 rounded-xl bg-blue-100 flex items-center justify-center">
                        <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                        </svg>
                    </div>
                    <div>
                        <h2 class="font-bold text-lg text-gray-800">Waktu & Lokasi</h2>
                        <p class="text-xs text-gray-500">Kapan dan di mana kegiatan berlangsung</p>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                    {{-- TANGGAL --}}
                    <div x-data="{ tanggal: '{{ old('tanggal_kegiatan', date('Y-m-d')) }}' }">
                        <label class="form-label">
                            Tanggal Kegiatan <span class="required-star">*</span>
                        </label>
                        <input type="date" name="tanggal_kegiatan" x-model="tanggal"
                               class="form-input" required>

                        {{-- Preset Cepat --}}
                        <div class="flex flex-wrap gap-2 mt-2">
                            <button type="button" class="preset-btn"
                                    @click="tanggal = '{{ date('Y-m-d') }}'">
                                📅 Hari Ini
                            </button>
                            <button type="button" class="preset-btn"
                                    @click="tanggal = '{{ date('Y-m-d', strtotime('-1 day')) }}'">
                                ⬅️ Kemarin
                            </button>
                            <button type="button" class="preset-btn"
                                    @click="tanggal = '{{ date('Y-m-d', strtotime('-1 week')) }}'">
                                📆 Minggu Lalu
                            </button>
                        </div>
                        @error('tanggal_kegiatan') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>

                    {{-- LOKASI --}}
                    <div>
                        <label class="form-label">
                            Lokasi <span class="text-gray-400 font-normal text-xs">(opsional)</span>
                        </label>
                        <input type="text" name="lokasi" value="{{ old('lokasi') }}"
                               placeholder="Contoh: Balai RT 01"
                               class="form-input">
                        @error('lokasi') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
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
                    Simpan Dokumentasi
                </button>
                <a href="{{ route('dokumentasi.index') }}"
                   class="px-6 py-4 rounded-2xl bg-gray-100 hover:bg-gray-200 text-gray-700 font-bold transition-all">
                    Batal
                </a>
            </div>
        </div>

        {{-- KOLOM KANAN: FOTO + TIPS --}}
        <div class="lg:col-span-1 space-y-6">

            {{-- UPLOAD FOTO --}}
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
                <div class="flex items-center gap-3 mb-5 pb-4 border-b border-gray-100">
                    <div class="w-10 h-10 rounded-xl bg-yellow-100 flex items-center justify-center">
                        <svg class="w-5 h-5 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                        </svg>
                    </div>
                    <div>
                        <h2 class="font-bold text-gray-800">Foto Dokumentasi</h2>
                        <p class="text-xs text-gray-500">Opsional tapi sangat disarankan</p>
                    </div>
                </div>

                <div x-data="{
                    preview: null,
                    fileName: '',
                    handleFile(event) {
                        const file = event.target.files[0];
                        if (file) {
                            this.fileName = file.name;
                            const reader = new FileReader();
                            reader.onload = (e) => { this.preview = e.target.result; };
                            reader.readAsDataURL(file);
                        }
                    },
                    clearFile() {
                        this.$refs.fileInput.value = '';
                        this.preview = null;
                        this.fileName = '';
                    }
                }">
                    <input type="file" name="foto" accept="image/*" class="hidden"
                           x-ref="fileInput"
                           @change="handleFile($event)">

                    {{-- Preview --}}
                    <template x-if="preview">
                        <div class="relative rounded-xl overflow-hidden">
                            <img :src="preview" class="w-full h-48 object-cover">
                            <button type="button" @click="clearFile()"
                                    class="absolute top-2 right-2 bg-red-500 hover:bg-red-600 text-white rounded-full w-8 h-8 flex items-center justify-center shadow-lg transition">
                                <svg width="14" height="14" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M6 18L18 6M6 6l12 12"/>
                                </svg>
                            </button>
                            <p class="text-xs text-gray-500 mt-2 text-center truncate" x-text="fileName"></p>
                        </div>
                    </template>

                    {{-- Upload Area --}}
                    <template x-if="!preview">
                        <div class="upload-area" @click="$refs.fileInput.click()">
                            <div class="w-16 h-16 rounded-full bg-emerald-100 flex items-center justify-center mx-auto mb-3">
                                <svg width="28" height="28" fill="none" stroke="#047857" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"/>
                                </svg>
                            </div>
                            <p class="font-bold text-sm text-gray-700 mb-1">Klik untuk pilih foto</p>
                            <p class="text-xs text-gray-500">JPG, PNG, atau WEBP · Maks 2MB</p>
                        </div>
                    </template>
                </div>

                @error('foto') <p class="text-red-500 text-xs mt-2">{{ $message }}</p> @enderror
            </div>

            {{-- TIPS --}}
            <div class="rounded-2xl p-6 text-white" style="background: linear-gradient(135deg, #047857 0%, #064e3b 100%);">
                <div class="flex items-center gap-2 mb-4">
                    <svg width="20" height="20" fill="none" stroke="#fbbf24" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"/>
                    </svg>
                    <h3 class="font-bold text-base">Tips Dokumentasi Bagus</h3>
                </div>
                <ul class="space-y-2.5 text-sm text-emerald-50">
                    <li class="flex gap-2">
                        <span class="text-yellow-400 font-bold">✓</span>
                        <span>Gunakan <strong class="text-white">judul singkat & jelas</strong> agar mudah dicari</span>
                    </li>
                    <li class="flex gap-2">
                        <span class="text-yellow-400 font-bold">✓</span>
                        <span>Foto diambil dari <strong class="text-white">sudut terbaik</strong>, pencahayaan cukup</span>
                    </li>
                    <li class="flex gap-2">
                        <span class="text-yellow-400 font-bold">✓</span>
                        <span>Tulis deskripsi dengan <strong class="text-white">siapa, apa, kapan, hasilnya</strong></span>
                    </li>
                    <li class="flex gap-2">
                        <span class="text-yellow-400 font-bold">✓</span>
                        <span>Sertakan <strong class="text-white">lokasi spesifik</strong> untuk referensi</span>
                    </li>
                </ul>
            </div>

        </div>
    </div>
</form>

@endsection