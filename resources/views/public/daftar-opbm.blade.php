<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Program OPBM - Kampung Digital RT 01</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        .form-input {
            width: 100%;
            border: 2px solid #e5e7eb;
            border-radius: 12px;
            padding: 14px 16px;
            font-size: 15px;
            outline: none;
            transition: all 0.2s;
            background: #ffffff;
        }
        .form-input:focus {
            border-color: #10b981;
            box-shadow: 0 0 0 4px rgba(16, 185, 129, 0.1);
        }
        .form-label {
            display: block;
            font-weight: 600;
            font-size: 13px;
            color: #374151;
            margin-bottom: 8px;
        }
        .required-star { color: #ef4444; }
    </style>
</head>
<body class="bg-gray-50 antialiased">

    <nav class="bg-white shadow-sm sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 py-3 flex justify-between items-center">
            <a href="{{ route('home') }}" class="flex items-center gap-3">
                <div class="w-11 h-11 bg-emerald-700 text-white rounded-xl flex items-center justify-center font-bold text-sm">RT</div>
                <div>
                    <div class="font-bold text-gray-800 text-sm leading-tight">Informasi Warga</div>
                    <div class="text-xs text-gray-500 leading-tight">RT 01 - Kampung Digital</div>
                </div>
            </a>
            <div class="hidden md:flex gap-6 text-sm">
                <a href="{{ route('home') }}" class="text-gray-700 hover:text-emerald-700 transition">Beranda</a>
                <a href="{{ route('program.opbm') }}" class="text-gray-700 hover:text-emerald-700 transition">Program OPBM</a>
                <a href="{{ route('warga.opbm') }}" class="text-gray-700 hover:text-emerald-700 transition">Warga OPBM</a>
            </div>
        </div>
    </nav>

    <section class="text-white py-16" style="background: linear-gradient(135deg, #047857 0%, #064e3b 100%);">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 text-center">
            <span class="inline-block bg-white/10 backdrop-blur border border-white/20 px-4 py-1.5 rounded-full text-xs font-medium mb-4">
                Pendaftaran Online
            </span>
            <h1 class="text-4xl md:text-5xl font-extrabold mb-3">Daftar Program OPBM</h1>
            <p class="text-emerald-100 max-w-2xl mx-auto">
                Isi formulir di bawah ini untuk mendaftarkan keluarga Anda dalam program penjemputan sampah gratis
            </p>
        </div>
    </section>

    <section class="max-w-2xl mx-auto px-4 sm:px-6 py-12">

        <div class="bg-blue-50 border-l-4 border-blue-500 p-4 rounded-lg mb-8">
            <div class="flex gap-3">
                <svg class="w-6 h-6 text-blue-600 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
                <div>
                    <p class="font-bold text-blue-900 mb-1">Cukup 4 Data Saja!</p>
                    <p class="text-sm text-blue-800 leading-relaxed">
                        Isi data diri Anda di bawah ini. Tidak perlu NIK atau nomor KK. Pengurus RT akan menghubungi Anda untuk verifikasi.
                    </p>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-3xl shadow-sm border border-gray-100 p-6 md:p-10">
            <form action="{{ route('daftar.opbm.store') }}" method="POST" class="space-y-6">
                @csrf

                <div>
                    <label class="form-label">Nama Kepala Keluarga <span class="required-star">*</span></label>
                    <input type="text" name="nama_kepala_keluarga" value="{{ old('nama_kepala_keluarga') }}"
                           placeholder="Contoh: Bapak Sutrisno" class="form-input" required autofocus>
                    @error('nama_kepala_keluarga') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label class="form-label">Nomor WhatsApp <span class="required-star">*</span></label>
                    <div class="flex">
                        <span class="inline-flex items-center px-4 bg-gray-100 border-2 border-r-0 border-gray-200 rounded-l-xl text-gray-600 font-semibold">+62</span>
                        <input type="tel" name="no_hp" value="{{ old('no_hp') }}" placeholder="81234567890"
                               pattern="[0-9]*" inputmode="numeric"
                               class="flex-1 form-input" style="border-top-left-radius:0; border-bottom-left-radius:0;" required>
                    </div>
                    <p class="text-xs text-gray-500 mt-1">Tanpa angka 0 di depan, contoh: 81234567890</p>
                    @error('no_hp') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label class="form-label">Alamat Lengkap <span class="required-star">*</span></label>
                    <textarea name="alamat" rows="3" placeholder="Contoh: Jl. Merdeka No. 5, RT 01"
                              class="form-input" style="resize:vertical;" required>{{ old('alamat') }}</textarea>
                    @error('alamat') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label class="form-label">Blok / Zona <span class="required-star">*</span></label>
                    <input type="text" name="zona" value="{{ old('zona') }}"
                           placeholder="Contoh: Blok A1, Blok A2, RT 01A" class="form-input" required>
                    <p class="text-xs text-gray-500 mt-1">Tulis blok atau zona tempat tinggal Anda, contoh: <strong>Blok A1</strong></p>
                    @error('zona') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                </div>

                <div class="bg-gray-50 rounded-xl p-4">
                    <label class="flex items-start gap-3 cursor-pointer">
                        <input type="checkbox" required class="w-5 h-5 rounded mt-0.5" style="accent-color: #10b981;">
                        <span class="text-sm text-gray-700">
                            Saya setuju mengikuti program OPBM RT 01 dan bersedia memilah sampah sesuai ketentuan yang berlaku.
                        </span>
                    </label>
                </div>

                <div class="flex gap-3 pt-4 border-t border-gray-100">
                    <button type="submit"
                            class="flex-1 text-white px-6 py-4 rounded-xl font-bold shadow-lg hover:shadow-xl transition text-center"
                            style="background: linear-gradient(135deg, #10b981 0%, #047857 100%);">
                        Kirim Pendaftaran
                    </button>
                    <a href="{{ route('program.opbm') }}"
                       class="px-6 py-4 rounded-xl bg-gray-100 hover:bg-gray-200 text-gray-700 font-semibold transition">
                        Batal
                    </a>
                </div>
            </form>
        </div>

        <div class="mt-8 text-center">
            <p class="text-sm text-gray-500 mb-3">Atau ingin langsung tanya-tanya dulu?</p>
            <a href="https://wa.me/6281234500001?text={{ urlencode('Assalamualaikum Pak RT. Saya ingin tanya tentang program OPBM RT 01.') }}"
               target="_blank"
               class="inline-flex items-center gap-2 text-emerald-700 hover:text-emerald-800 font-semibold text-sm">
                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413Z"/>
                </svg>
                Hubungi Pak RT via WhatsApp
            </a>
        </div>

    </section>

    <footer class="bg-gray-900 text-gray-400 py-10">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 text-center">
            <p class="text-sm">&copy; {{ date('Y') }} Kampung Digital OPBM RT 01 - Kota Jambi Bahagia</p>
        </div>
    </footer>

</body>
</html>
