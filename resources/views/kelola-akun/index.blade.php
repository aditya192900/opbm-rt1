@extends('layouts.app')

@section('title', 'Kelola Akun')

@section('content')

<style>
    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(10px); }
        to { opacity: 1; transform: translateY(0); }
    }
    .fade-in { animation: fadeIn 0.4s ease-out; }
    .user-card {
        background: white;
        border-radius: 16px;
        padding: 20px;
        border: 1px solid #f3f4f6;
        box-shadow: 0 1px 3px rgba(0,0,0,0.04);
        transition: all 0.3s;
    }
    .user-card:hover {
        transform: translateY(-2px);
        box-shadow: 0 10px 25px rgba(0,0,0,0.08);
    }
    .form-input {
        width: 100%;
        border: 2px solid #e5e7eb;
        border-radius: 10px;
        padding: 10px 14px;
        font-size: 14px;
        outline: none;
        transition: all 0.2s;
    }
    .form-input:focus { border-color: #10b981; }
    .btn-sm {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 8px 14px;
        border-radius: 9999px;
        font-size: 12px;
        font-weight: 700;
        border: none;
        cursor: pointer;
        transition: all 0.2s;
        text-decoration: none;
    }
    .btn-reset { background: #dbeafe; color: #1e40af; }
    .btn-reset:hover { background: #3b82f6; color: white; }
    .btn-delete { background: #fee2e2; color: #b91c1c; }
    .btn-delete:hover { background: #ef4444; color: white; }
    .role-badge {
        display: inline-flex;
        align-items: center;
        gap: 4px;
        padding: 4px 10px;
        border-radius: 9999px;
        font-size: 10px;
        font-weight: 800;
        text-transform: uppercase;
        letter-spacing: 0.05em;
    }
    .role-super { background: linear-gradient(135deg, #fbbf24, #f59e0b); color: #78350f; }
    .role-rt { background: #d1fae5; color: #047857; border: 1px solid #10b981; }
    .role-bendahara { background: #dbeafe; color: #1e40af; border: 1px solid #3b82f6; }
</style>

@php
    $isSuperAdmin = Auth::user()->role === 'super_admin';
    $isRt = Auth::user()->role === 'rt';
@endphp

{{-- HEADER --}}
<div class="flex justify-between items-center mb-6 flex-wrap gap-3 fade-in">
    <div>
        <h1 class="text-2xl font-bold">Kelola Akun</h1>
        <p class="text-gray-500 text-sm">Kelola akun RT, Bendahara, dan administrator</p>
    </div>
</div>

{{-- INFO --}}
<div class="bg-blue-50 border-l-4 border-blue-500 p-4 rounded-2xl mb-6">
    <div class="flex items-start gap-3">
        <svg class="w-6 h-6 text-blue-600 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
        </svg>
        <div class="text-sm text-blue-800">
            @if($isSuperAdmin)
                <p class="font-bold">👑 Halaman Super Admin</p>
                <p class="mt-1">Sebagai <strong>Super Admin</strong>, Anda dapat <strong>menambah, mereset password, dan menghapus</strong> semua akun (RT & Bendahara).</p>
            @else
                <p class="font-bold">🔒 Halaman Khusus Administrator</p>
                <p class="mt-1">Sebagai <strong>Ketua RT</strong>, Anda dapat <strong>mereset password</strong> dan <strong>menghapus akun Bendahara</strong>. Untuk menambah akun baru, hubungi Super Admin.</p>
            @endif
        </div>
    </div>
</div>

{{-- TOMBOL TAMBAH AKUN (HANYA SUPER ADMIN) --}}
@if($isSuperAdmin)
<div class="mb-6 fade-in">
    <button onclick="document.getElementById('formTambah').classList.toggle('hidden')"
            class="inline-flex items-center gap-2 text-white px-5 py-3 rounded-full font-bold shadow-md hover:shadow-lg transition"
            style="background: linear-gradient(135deg, #10b981 0%, #047857 100%);">
        <svg width="18" height="18" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
        </svg>
        Tambah Akun Baru
    </button>
</div>

{{-- FORM TAMBAH AKUN --}}
<div id="formTambah" class="hidden mb-6 fade-in">
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
        <h3 class="font-bold text-lg text-gray-800 mb-4">Tambah Akun Baru</h3>
        <form action="{{ route('kelola.akun.store') }}" method="POST" class="grid grid-cols-1 md:grid-cols-2 gap-4">
            @csrf
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">Nama Lengkap</label>
                <input type="text" name="name" value="{{ old('name') }}" class="form-input" required>
                @error('name') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">Email</label>
                <input type="email" name="email" value="{{ old('email') }}" class="form-input" required>
                @error('email') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">Password (min 8 karakter)</label>
                <input type="text" name="password" class="form-input" required>
                @error('password') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">Role</label>
                <select name="role" class="form-input cursor-pointer" required>
                    <option value="">-- Pilih Role --</option>
                    <option value="rt" @selected(old('role') == 'rt')>Ketua RT</option>
                    <option value="bendahara" @selected(old('role') == 'bendahara')>Bendahara</option>
                </select>
                @error('role') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>
            <div class="md:col-span-2 flex gap-3 pt-2">
                <button type="submit" class="text-white px-6 py-2.5 rounded-full font-bold shadow-md transition"
                        style="background: linear-gradient(135deg, #10b981 0%, #047857 100%);">
                    Simpan Akun
                </button>
                <button type="button" onclick="document.getElementById('formTambah').classList.add('hidden')"
                        class="bg-gray-100 hover:bg-gray-200 text-gray-700 px-6 py-2.5 rounded-full font-bold transition">
                    Batal
                </button>
            </div>
        </form>
    </div>
</div>
@endif

{{-- LIST USERS --}}
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-5 fade-in">
    @foreach($users as $u)
    @php
        // Tentukan apakah user ini bisa di-reset/hapus oleh user yang login
        $canManage = false;
        if ($u->id !== Auth::id() && $u->role !== 'super_admin') {
            if ($isSuperAdmin) {
                $canManage = true;
            } elseif ($isRt && $u->role === 'bendahara') {
                $canManage = true;
            }
        }
    @endphp
    <div class="user-card">
        {{-- Header --}}
        <div class="flex items-center gap-3 mb-4">
            <div class="w-14 h-14 rounded-full flex items-center justify-center text-white font-bold text-lg flex-shrink-0"
                 style="background: linear-gradient(135deg, #10b981 0%, #047857 100%);">
                {{ strtoupper(substr($u->name, 0, 1)) }}
            </div>
            <div class="min-w-0 flex-1">
                <h3 class="font-bold text-gray-800 truncate">{{ $u->name }}</h3>
                <p class="text-xs text-gray-500 truncate">{{ $u->email }}</p>
                @if($u->id === Auth::id())
                    <p class="text-xs text-emerald-600 font-bold mt-1">← Akun Anda</p>
                @endif
            </div>
        </div>

        {{-- Role Badge --}}
        <div class="mb-4">
            @if($u->role === 'super_admin')
                <span class="role-badge role-super">⭐ SUPER ADMIN</span>
            @elseif($u->role === 'rt')
                <span class="role-badge role-rt">🏠 KETUA RT</span>
            @else
                <span class="role-badge role-bendahara">🪙 BENDAHARA</span>
            @endif
        </div>

        {{-- Info --}}
        <div class="border-t border-gray-100 pt-3 mb-4 text-xs text-gray-500 space-y-1">
            <div class="flex justify-between">
                <span>Bergabung:</span>
                <span class="font-medium text-gray-700">{{ $u->created_at->format('d M Y') }}</span>
            </div>
        </div>

        {{-- Actions --}}
        @if($u->id === Auth::id())
            <div class="bg-emerald-50 rounded-lg p-3 text-xs text-emerald-700 text-center">
                💡 Ganti password Anda sendiri via <a href="{{ route('profile.edit') }}" class="font-bold underline">Profil Saya</a>
            </div>
        @elseif($u->role === 'super_admin')
            <div class="bg-yellow-50 rounded-lg p-3 text-xs text-yellow-700 text-center">
                🔒 Super Admin tidak bisa diubah dari sini
            </div>
        @elseif($canManage)
            <div class="flex gap-2">
                <button onclick="openResetModal({{ $u->id }}, '{{ addslashes($u->name) }}')"
                        class="btn-sm btn-reset flex-1 justify-center">
                    <svg width="12" height="12" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z"/>
                    </svg>
                    Reset Password
                </button>
                <form action="{{ route('kelola.akun.destroy', $u) }}" method="POST" onsubmit="return confirm('Hapus akun {{ $u->name }}?')">
                    @csrf @method('DELETE')
                    <button type="submit" class="btn-sm btn-delete">
                        <svg width="12" height="12" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                        </svg>
                    </button>
                </form>
            </div>
        @else
            <div class="bg-gray-50 rounded-lg p-3 text-xs text-gray-500 text-center">
                🔒 Hanya bisa dikelola Super Admin
            </div>
        @endif
    </div>
    @endforeach
</div>

{{-- MODAL RESET PASSWORD --}}
<div id="resetModal" class="hidden fixed inset-0 z-50 items-center justify-center" style="background: rgba(0,0,0,0.5);">
    <div class="bg-white rounded-2xl shadow-xl max-w-md w-full mx-4 p-6">
        <h3 class="font-bold text-lg text-gray-800 mb-1">Reset Password</h3>
        <p class="text-sm text-gray-500 mb-5">Reset password untuk: <strong id="resetName" class="text-gray-800"></strong></p>

        <form id="resetForm" method="POST">
            @csrf
            <div class="mb-5">
                <label class="block text-sm font-semibold text-gray-700 mb-2">Password Baru (min 8 karakter)</label>
                <input type="text" name="password_baru" id="passwordBaru" class="form-input" required>
                <p class="text-xs text-gray-500 mt-2">💡 Catat password ini dan berikan ke user terkait</p>
            </div>
            <div class="flex gap-3">
                <button type="submit" class="flex-1 text-white px-6 py-3 rounded-full font-bold shadow-md"
                        style="background: linear-gradient(135deg, #10b981 0%, #047857 100%);">
                    Reset Password
                </button>
                <button type="button" onclick="closeResetModal()"
                        class="px-6 py-3 rounded-full bg-gray-100 hover:bg-gray-200 text-gray-700 font-bold">
                    Batal
                </button>
            </div>
        </form>
    </div>
</div>

<script>
    function openResetModal(userId, userName) {
        document.getElementById('resetName').textContent = userName;
        document.getElementById('resetForm').action = '/kelola-akun/' + userId + '/reset-password';
        document.getElementById('passwordBaru').value = '';
        const modal = document.getElementById('resetModal');
        modal.classList.remove('hidden');
        modal.classList.add('flex');
        setTimeout(() => document.getElementById('passwordBaru').focus(), 100);
    }

    function closeResetModal() {
        const modal = document.getElementById('resetModal');
        modal.classList.add('hidden');
        modal.classList.remove('flex');
    }

    document.getElementById('resetModal').addEventListener('click', function(e) {
        if (e.target === this) closeResetModal();
    });
</script>

@endsection