@extends('layouts.app')

@section('title', 'Profil Saya')

@section('content')

<style>
    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(10px); }
        to { opacity: 1; transform: translateY(0); }
    }
    .fade-in { animation: fadeIn 0.4s ease-out; }
</style>

{{-- HEADER --}}
<div class="mb-6">
    <h1 class="text-2xl font-bold">Profil Saya</h1>
    <p class="text-gray-500 text-sm">Kelola data pribadi dan keamanan akun Anda</p>
</div>

<div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

    {{-- KIRI: KARTU PROFIL --}}
    <div class="lg:col-span-1">
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden fade-in">
            {{-- Cover --}}
            <div class="h-24" style="background: linear-gradient(135deg, #10b981 0%, #047857 100%);"></div>

            {{-- Avatar --}}
            <div class="px-6 pb-6 -mt-12 text-center">
                <div class="inline-block relative">
                    @if($user->foto && Storage::disk('public')->exists($user->foto))
                        <img src="{{ asset('storage/' . $user->foto) }}"
                             class="w-24 h-24 rounded-full object-cover border-4 border-white shadow-lg mx-auto">
                    @else
                        <div class="w-24 h-24 rounded-full border-4 border-white shadow-lg mx-auto flex items-center justify-center text-white font-bold text-3xl"
                             style="background: linear-gradient(135deg, #10b981 0%, #047857 100%);">
                            {{ strtoupper(substr($user->name, 0, 1)) }}
                        </div>
                    @endif
                </div>

                <h2 class="font-bold text-xl text-gray-800 mt-3">{{ $user->name }}</h2>
                <p class="text-gray-500 text-sm">{{ $user->email }}</p>

                <div class="inline-flex items-center gap-2 mt-3 px-4 py-1.5 rounded-full text-xs font-bold
                    {{ $user->role === 'bendahara' ? 'bg-blue-100 text-blue-700' : 'bg-emerald-100 text-emerald-700' }}">
                    @if($user->role === 'bendahara')
                        🪙 Bendahara
                    @else
                        🏠 Ketua RT
                    @endif
                </div>

                <div class="border-t border-gray-100 mt-5 pt-5 text-left space-y-3 text-sm">
                    <div>
                        <p class="text-xs text-gray-500 uppercase font-semibold tracking-wider">No HP</p>
                        <p class="font-medium text-gray-800">{{ $user->no_hp ?? '-' }}</p>
                    </div>
                    <div>
                        <p class="text-xs text-gray-500 uppercase font-semibold tracking-wider">Alamat</p>
                        <p class="font-medium text-gray-800">{{ $user->alamat ?? '-' }}</p>
                    </div>
                    <div>
                        <p class="text-xs text-gray-500 uppercase font-semibold tracking-wider">Bergabung</p>
                        <p class="font-medium text-gray-800">{{ $user->created_at->format('d F Y') }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- KANAN: FORM EDIT --}}
    <div class="lg:col-span-2 space-y-6">

        {{-- FORM DATA DIRI --}}
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 md:p-8 fade-in">
            <div class="flex items-center gap-3 mb-6">
                <div class="w-10 h-10 rounded-xl bg-emerald-100 flex items-center justify-center">
                    <svg class="w-5 h-5 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                    </svg>
                </div>
                <div>
                    <h2 class="font-bold text-lg text-gray-800">Data Diri</h2>
                    <p class="text-xs text-gray-500">Perbarui informasi profil Anda</p>
                </div>
            </div>

            @if(session('success'))
                <div class="bg-emerald-50 border-l-4 border-emerald-500 p-3 mb-5 rounded-lg text-sm text-emerald-700">
                    {{ session('success') }}
                </div>
            @endif

            <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data" class="space-y-5">
                @csrf
                @method('PATCH')

                {{-- FOTO --}}
                <div>
                    <label class="block font-semibold mb-2 text-gray-700 text-sm">Foto Profil</label>
                    <div class="flex items-center gap-4">
                        @if($user->foto && Storage::disk('public')->exists($user->foto))
                            <img src="{{ asset('storage/' . $user->foto) }}" class="w-16 h-16 rounded-full object-cover border-2 border-emerald-500">
                        @else
                            <div class="w-16 h-16 rounded-full flex items-center justify-center text-white font-bold text-xl"
                                 style="background: linear-gradient(135deg, #10b981 0%, #047857 100%);">
                                {{ strtoupper(substr($user->name, 0, 1)) }}
                            </div>
                        @endif
                        <div class="flex-1">
                            <input type="file" name="foto" accept="image/*"
                                   class="w-full text-sm border-2 border-gray-200 rounded-xl px-3 py-2.5 focus:border-emerald-500 outline-none transition file:mr-3 file:py-1.5 file:px-3 file:rounded-full file:border-0 file:text-xs file:font-bold file:bg-emerald-50 file:text-emerald-700">
                            <p class="text-xs text-gray-500 mt-1">Format: JPG/PNG, maks 2MB</p>
                            @error('foto') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                        </div>
                    </div>
                </div>

                {{-- NAMA --}}
                <div>
                    <label class="block font-semibold mb-2 text-gray-700 text-sm">Nama Lengkap <span class="text-red-500">*</span></label>
                    <input type="text" name="name" value="{{ old('name', $user->name) }}"
                           class="w-full border-2 border-gray-200 rounded-xl px-4 py-2.5 focus:border-emerald-500 outline-none transition"
                           required>
                    @error('name') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                {{-- EMAIL --}}
                <div>
                    <label class="block font-semibold mb-2 text-gray-700 text-sm">Email <span class="text-red-500">*</span></label>
                    <input type="email" name="email" value="{{ old('email', $user->email) }}"
                           class="w-full border-2 border-gray-200 rounded-xl px-4 py-2.5 focus:border-emerald-500 outline-none transition"
                           required>
                    @error('email') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                {{-- NO HP --}}
                <div>
                    <label class="block font-semibold mb-2 text-gray-700 text-sm">No HP / WhatsApp</label>
                    <input type="text" name="no_hp" value="{{ old('no_hp', $user->no_hp) }}"
                           placeholder="Contoh: 081234567890"
                           class="w-full border-2 border-gray-200 rounded-xl px-4 py-2.5 focus:border-emerald-500 outline-none transition">
                    @error('no_hp') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                {{-- ALAMAT --}}
                <div>
                    <label class="block font-semibold mb-2 text-gray-700 text-sm">Alamat</label>
                    <textarea name="alamat" rows="3"
                              placeholder="Contoh: Jl. Merdeka No. 5, RT 01"
                              class="w-full border-2 border-gray-200 rounded-xl px-4 py-2.5 focus:border-emerald-500 outline-none transition">{{ old('alamat', $user->alamat) }}</textarea>
                    @error('alamat') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                <div class="flex gap-3 pt-4 border-t border-gray-100">
                    <button type="submit"
                            class="flex-1 text-white px-6 py-3 rounded-xl font-bold shadow-md hover:shadow-lg transition"
                            style="background: linear-gradient(135deg, #10b981 0%, #047857 100%);">
                        💾 Simpan Perubahan
                    </button>
                </div>
            </form>
        </div>

        {{-- FORM GANTI PASSWORD --}}
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 md:p-8 fade-in">
            <div class="flex items-center gap-3 mb-6">
                <div class="w-10 h-10 rounded-xl bg-red-100 flex items-center justify-center">
                    <svg class="w-5 h-5 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                    </svg>
                </div>
                <div>
                    <h2 class="font-bold text-lg text-gray-800">Ganti Password</h2>
                    <p class="text-xs text-gray-500">Pastikan password baru minimal 8 karakter</p>
                </div>
            </div>

            <form action="{{ route('profile.password') }}" method="POST" class="space-y-5">
                @csrf

                <div>
                    <label class="block font-semibold mb-2 text-gray-700 text-sm">Password Lama <span class="text-red-500">*</span></label>
                    <input type="password" name="current_password"
                           class="w-full border-2 border-gray-200 rounded-xl px-4 py-2.5 focus:border-red-500 outline-none transition"
                           required>
                    @error('current_password') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label class="block font-semibold mb-2 text-gray-700 text-sm">Password Baru <span class="text-red-500">*</span></label>
                    <input type="password" name="password"
                           class="w-full border-2 border-gray-200 rounded-xl px-4 py-2.5 focus:border-red-500 outline-none transition"
                           required>
                    @error('password') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label class="block font-semibold mb-2 text-gray-700 text-sm">Konfirmasi Password Baru <span class="text-red-500">*</span></label>
                    <input type="password" name="password_confirmation"
                           class="w-full border-2 border-gray-200 rounded-xl px-4 py-2.5 focus:border-red-500 outline-none transition"
                           required>
                </div>

                <div class="flex gap-3 pt-4 border-t border-gray-100">
                    <button type="submit"
                            class="flex-1 text-white px-6 py-3 rounded-xl font-bold shadow-md hover:shadow-lg transition"
                            style="background: linear-gradient(135deg, #ef4444 0%, #b91c1c 100%);">
                        🔐 Ganti Password
                    </button>
                </div>
            </form>
        </div>

    </div>
</div>

@endsection