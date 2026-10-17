@extends('layouts.app')

@section('title', 'Edit Pengurus')

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
        <a href="{{ route('pengurus.index') }}" class="inline-flex items-center gap-1 text-emerald-600 hover:text-emerald-700 text-sm font-medium mb-2">
            <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
            </svg>
            Kembali ke Struktur Pengurus
        </a>
        <h1 class="text-2xl font-bold">Edit Data Pengurus</h1>
        <p class="text-gray-500 text-sm">Perbarui informasi pengurus RT 01</p>
    </div>
</div>

<form action="{{ route('pengurus.update', $pengurus) }}" method="POST" enctype="multipart/form-data" class="fade-in"
      x-data="{
          jabatan: '{{ old('jabatan', $pengurus->jabatan) }}',
          urutanOtomatis: '{{ old('urutan', $pengurus->urutan) }}',
          urutanMap: {
              'Ketua RT': 1, 'Wakil Ketua RT': 2, 'Sekretaris': 3, 'Bendahara': 4,
              'Seksi Kebersihan': 5, 'Seksi Keamanan': 6, 'Seksi Pemuda': 7,
              'Seksi Sosial': 8, 'Seksi Agama': 9, 'Seksi Olahraga': 10, 'Anggota': 99
          },
          setUrutan() { this.urutanOtomatis = this.urutanMap[this.jabatan] || this.urutanOtomatis; }
      }">
    @csrf
    @method('PUT')

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

        {{-- KOLOM KIRI: FORM --}}
        <div class="lg:col-span-2 space-y-6">

            {{-- DATA DIRI --}}
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 md:p-8">
                <div class="flex items-center gap-3 mb-6 pb-4 border-b border-gray-100">
                    <div class="w-10 h-10 rounded-xl bg-emerald-100 flex items-center justify-center">
                        <svg class="w-5 h-5 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                        </svg>
                    </div>
                    <div>
                        <h2 class="font-bold text-lg text-gray-800">Data Diri Pengurus</h2>
                        <p class="text-xs text-gray-500">Informasi utama pengurus</p>
                    </div>
                </div>

                <div class="space-y-5">
                    {{-- NAMA --}}
                    <div>
                        <label class="form-label">
                            Nama Lengkap <span class="required-star">*</span>
                        </label>
                        <input type="text" name="nama" value="{{ old('nama', $pengurus->nama) }}"
                               placeholder="Contoh: Bapak H. Ahmad Sutrisno"
                               class="form-input" required autofocus>
                        @error('nama') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>

                    {{-- JABATAN --}}
                    <div>
                        <label class="form-label">
                            Jabatan <span class="required-star">*</span>
                        </label>
                        <select name="jabatan" x-model="jabatan" @change="setUrutan()"
                                class="form-input cursor-pointer" required>
                            <option value="">-- Pilih Jabatan --</option>
                            <option value="Ketua RT">Ketua RT</option>
                            <option value="Wakil Ketua RT">Wakil Ketua RT</option>
                            <option value="Sekretaris">Sekretaris</option>
                            <option value="Bendahara">Bendahara</option>
                            <option value="Seksi Kebersihan">Seksi Kebersihan</option>
                            <option value="Seksi Keamanan">Seksi Keamanan</option>
                            <option value="Seksi Pemuda">Seksi Pemuda</option>
                            <option value="Seksi Sosial">Seksi Sosial</option>
                            <option value="Seksi Agama">Seksi Agama</option>
                            <option value="Seksi Olahraga">Seksi Olahraga</option>
                            <option value="Anggota">Anggota</option>
                        </select>
                        @error('jabatan') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>

                    {{-- NO HP --}}
                    <div>
                        <label class="form-label">
                            No WhatsApp <span class="text-gray-400 font-normal text-xs">(opsional)</span>
                        </label>
                        <div class="flex">
                            <span class="inline-flex items-center px-4 bg-gray-100 border-2 border-r-0 border-gray-200 rounded-l-xl text-gray-600 text-sm font-semibold">
                                +62
                            </span>
                            <input type="text" name="no_hp" value="{{ old('no_hp', $pengurus->no_hp) }}"
                                   placeholder="81234567890"
                                   class="flex-1 form-input" style="border-top-left-radius:0; border-bottom-left-radius:0;">
                        </div>
                        @error('no_hp') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>

                    {{-- ALAMAT --}}
                    <div>
                        <label class="form-label">
                            Alamat <span class="text-gray-400 font-normal text-xs">(opsional)</span>
                        </label>
                        <input type="text" name="alamat" value="{{ old('alamat', $pengurus->alamat ?? '') }}"
                               placeholder="Contoh: Jl. Merdeka No. 5"
                               class="form-input">
                    </div>
                </div>
            </div>

            {{-- PENGATURAN TAMPILAN --}}
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 md:p-8">
                <div class="flex items-center gap-3 mb-6 pb-4 border-b border-gray-100">
                    <div class="w-10 h-10 rounded-xl bg-purple-100 flex items-center justify-center">
                        <svg class="w-5 h-5 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 10h16M4 14h16M4 18h16"/>
                        </svg>
                    </div>
                    <div>
                        <h2 class="font-bold text-lg text-gray-800">Pengaturan Tampilan</h2>
                        <p class="text-xs text-gray-500">Atur urutan tampil di halaman struktur</p>
                    </div>
                </div>

                <div x-show="urutanOtomatis !== ''" x-transition>
                    <label class="form-label">Urutan Tampil</label>
                    <div class="flex items-center gap-3">
                        <input type="number" name="urutan" :value="urutanOtomatis"
                               class="w-24 form-input text-center font-bold" style="color:#047857; background:#f0fdf4;"
                               readonly>
                        <div class="flex-1 bg-emerald-50 border border-emerald-100 rounded-xl p-3 text-xs text-emerald-700">
                            ✨ Urutan otomatis menyesuaikan jabatan yang dipilih
                        </div>
                    </div>
                </div>
            </div>

            {{-- TOMBOL AKSI --}}
            <div class="flex gap-3">
                <button type="submit"
                        class="flex-1 text-white px-6 py-4 rounded-2xl font-bold shadow-lg hover:shadow-xl transition-all flex items-center justify-center gap-2"
                        style="background: linear-gradient(135deg, #3b82f6 0%, #1e40af 100%);">
                    <svg width="20" height="20" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/>
                    </svg>
                    Update Data Pengurus
                </button>
                <a href="{{ route('pengurus.index') }}"
                   class="px-6 py-4 rounded-2xl bg-gray-100 hover:bg-gray-200 text-gray-700 font-bold transition-all">
                    Batal
                </a>
            </div>
        </div>

        {{-- KOLOM KANAN: FOTO + INFO --}}
        <div class="lg:col-span-1 space-y-6">

            {{-- FOTO --}}
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
                <div class="flex items-center gap-3 mb-5 pb-4 border-b border-gray-100">
                    <div class="w-10 h-10 rounded-xl bg-yellow-100 flex items-center justify-center">
                        <svg class="w-5 h-5 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                        </svg>
                    </div>
                    <div>
                        <h2 class="font-bold text-gray-800">Foto Pengurus</h2>
                        <p class="text-xs text-gray-500">Biarkan kosong jika tidak ganti</p>
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

                    {{-- Foto Lama / Upload Area --}}
                    <template x-if="!preview">
                        <div>
                            @if($pengurus->foto)
                                <div class="mb-4">
                                    <p class="text-xs text-gray-500 mb-2">Foto saat ini:</p>
                                    <img src="{{ asset('storage/' . $pengurus->foto) }}" class="w-full h-48 object-cover rounded-xl border-2 border-gray-100">
                                </div>
                                <div class="upload-area" @click="$refs.fileInput.click()">
                                    <p class="font-bold text-sm text-gray-700 mb-1">🔄 Ganti Foto</p>
                                    <p class="text-xs text-gray-500">JPG/PNG, maks 2MB</p>
                                </div>
                            @else
                                <div class="upload-area" @click="$refs.fileInput.click()">
                                    <div class="w-16 h-16 rounded-full bg-emerald-100 flex items-center justify-center mx-auto mb-3">
                                        <svg width="28" height="28" fill="none" stroke="#047857" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"/>
                                        </svg>
                                    </div>
                                    <p class="font-bold text-sm text-gray-700 mb-1">Klik untuk pilih foto</p>
                                    <p class="text-xs text-gray-500">JPG/PNG, maks 2MB</p>
                                </div>
                            @endif
                        </div>
                    </template>
                </div>

                @error('foto') <p class="text-red-500 text-xs mt-2">{{ $message }}</p> @enderror
            </div>

            {{-- INFO CARD --}}
            <div class="rounded-2xl p-6 text-white" style="background: linear-gradient(135deg, #047857 0%, #064e3b 100%);">
                <div class="flex items-center gap-2 mb-4">
                    <svg width="20" height="20" fill="none" stroke="#fbbf24" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    <h3 class="font-bold text-base">Info Pengurus</h3>
                </div>
                <div class="space-y-3 text-sm">
                    <div class="flex justify-between items-center pb-3 border-b border-white/20">
                        <span class="text-emerald-100">Nama:</span>
                        <strong class="text-white text-right">{{ $pengurus->nama }}</strong>
                    </div>
                    <div class="flex justify-between items-center pb-3 border-b border-white/20">
                        <span class="text-emerald-100">Jabatan:</span>
                        <strong class="text-white text-right">{{ $pengurus->jabatan }}</strong>
                    </div>
                    <div class="flex justify-between items-center pb-3 border-b border-white/20">
                        <span class="text-emerald-100">Ditambahkan:</span>
                        <strong class="text-white text-right">{{ $pengurus->created_at->format('d M Y') }}</strong>
                    </div>
                    <div class="flex justify-between items-center">
                        <span class="text-emerald-100">Terakhir update:</span>
                        <strong class="text-white text-right">{{ $pengurus->updated_at->diffForHumans() }}</strong>
                    </div>
                </div>
            </div>

        </div>
    </div>
</form>

@endsection