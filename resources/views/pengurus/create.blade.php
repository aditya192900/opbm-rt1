@extends('layouts.app')

@section('title', 'Tambah Pengurus')

@section('content')
<div class="max-w-2xl mx-auto">
    <div class="mb-6">
        <h1 class="text-2xl font-bold">Tambah Pengurus RT</h1>
        <p class="text-gray-500 text-sm">Isi data pengurus baru. Kolom bertanda * wajib diisi.</p>
    </div>

    <form action="{{ route('pengurus.store') }}" method="POST" enctype="multipart/form-data"
          class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 space-y-5"
          x-data="{
              jabatan: '{{ old('jabatan') }}',
              urutanOtomatis: '',
              urutanMap: {
                  'Ketua RT': 1,
                  'Wakil Ketua RT': 2,
                  'Sekretaris': 3,
                  'Bendahara': 4,
                  'Seksi Kebersihan': 5,
                  'Seksi Keamanan': 6,
                  'Seksi Pemuda': 7,
                  'Seksi Sosial': 8,
                  'Seksi Agama': 9,
                  'Seksi Olahraga': 10,
                  'Anggota': 99
              },
              setUrutan() {
                  this.urutanOtomatis = this.urutanMap[this.jabatan] || '';
              }
          }"
          x-init="setUrutan()">
        @csrf

        {{-- NAMA --}}
        <div>
            <label class="block font-semibold mb-1 text-gray-700">Nama Lengkap <span class="text-red-500">*</span></label>
            <input type="text" name="nama" value="{{ old('nama') }}"
                   placeholder="Contoh: Bapak H. Ahmad Sutrisno"
                   class="w-full border border-gray-300 rounded-lg px-4 py-2.5 focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 outline-none transition"
                   required autofocus>
            @error('nama') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
        </div>

        {{-- JABATAN DROPDOWN --}}
        <div>
            <label class="block font-semibold mb-1 text-gray-700">Jabatan <span class="text-red-500">*</span></label>
            <select name="jabatan" x-model="jabatan" @change="setUrutan()"
                    class="w-full border border-gray-300 rounded-lg px-4 py-2.5 focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 outline-none transition"
                    required>
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
            @error('jabatan') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
        </div>

        {{-- NO HP --}}
        <div>
            <label class="block font-semibold mb-1 text-gray-700">No WhatsApp <span class="text-gray-400 text-sm font-normal">(opsional)</span></label>
            <div class="flex">
                <span class="inline-flex items-center px-4 bg-gray-100 border border-r-0 border-gray-300 rounded-l-lg text-gray-600 text-sm">
                    +62
                </span>
                <input type="text" name="no_hp" value="{{ old('no_hp') }}"
                       placeholder="81234567890"
                       class="flex-1 border border-gray-300 rounded-r-lg px-4 py-2.5 focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 outline-none transition">
            </div>
            @error('no_hp') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
        </div>

        {{-- ALAMAT --}}
        <div>
            <label class="block font-semibold mb-1 text-gray-700">Alamat <span class="text-gray-400 text-sm font-normal">(opsional)</span></label>
            <input type="text" name="alamat" value="{{ old('alamat') }}"
                   placeholder="Contoh: Jl. Merdeka No. 5"
                   class="w-full border border-gray-300 rounded-lg px-4 py-2.5 focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 outline-none transition">
        </div>

        {{-- URUTAN (AUTO) --}}
        <div x-show="urutanOtomatis !== ''" x-transition>
            <label class="block font-semibold mb-1 text-gray-700">Urutan Tampil</label>
            <div class="flex items-center gap-3">
                <input type="number" name="urutan" :value="urutanOtomatis"
                       class="w-24 border border-gray-300 rounded-lg px-4 py-2.5 bg-gray-50 text-center font-semibold text-emerald-700 outline-none"
                       readonly>
                <span class="text-sm text-gray-500">Otomatis menyesuaikan jabatan</span>
            </div>
        </div>

        {{-- FOTO --}}
        <div>
            <label class="block font-semibold mb-1 text-gray-700">Foto <span class="text-gray-400 text-sm font-normal">(opsional)</span></label>
            <div class="border-2 border-dashed border-gray-300 rounded-lg p-4 text-center hover:border-emerald-500 transition"
                 x-data="{ preview: null }">
                <input type="file" name="foto" accept="image/*" class="hidden"
                       x-ref="fileInput"
                       @change="preview = URL.createObjectURL($event.target.files[0])">
                <template x-if="!preview">
                    <div>
                        <button type="button" @click="$refs.fileInput.click()"
                                class="bg-gray-100 hover:bg-gray-200 text-gray-700 px-4 py-2 rounded-lg text-sm font-medium transition">
                            Pilih Foto
                        </button>
                        <p class="text-xs text-gray-400 mt-2">Format: JPG/PNG, maks 2MB</p>
                    </div>
                </template>
                <template x-if="preview">
                    <div>
                        <img :src="preview" class="w-32 h-32 object-cover rounded-lg mx-auto mb-3">
                        <button type="button" @click="$refs.fileInput.value = ''; preview = null"
                                class="text-red-500 text-sm hover:underline">
                            Hapus Foto
                        </button>
                    </div>
                </template>
            </div>
        </div>

        {{-- TOMBOL --}}
        <div class="flex gap-3 pt-4 border-t border-gray-100">
            <button type="submit" class="flex-1 bg-emerald-600 hover:bg-emerald-700 text-white px-6 py-3 rounded-lg font-semibold transition">
                Simpan Pengurus
            </button>
            <a href="{{ route('pengurus.index') }}" class="px-6 py-3 rounded-lg bg-gray-100 hover:bg-gray-200 text-gray-700 font-medium transition">
                Batal
            </a>
        </div>
    </form>
</div>
@endsection