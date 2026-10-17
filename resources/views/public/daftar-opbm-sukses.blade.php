<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pendaftaran Berhasil - Kampung Digital RT 01</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        @keyframes slideUp {
            from { opacity: 0; transform: translateY(30px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .slide-up { animation: slideUp 0.6s ease-out; }
        @keyframes pulse-ring {
            0% { transform: scale(1); opacity: 0.6; }
            100% { transform: scale(1.5); opacity: 0; }
        }
        .pulse-ring { animation: pulse-ring 1.5s ease-out infinite; }
        @keyframes bounce-soft {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-10px); }
        }
        .icon-bounce { animation: bounce-soft 2s ease-in-out infinite; }
        @keyframes glow-green {
            0%, 100% { box-shadow: 0 0 0 0 rgba(16, 185, 129, 0.5); }
            50% { box-shadow: 0 0 0 20px rgba(16, 185, 129, 0); }
        }
        .glow-green { animation: glow-green 2s ease-in-out infinite; }
    </style>
</head>
<body class="bg-gray-50 antialiased">

    {{-- NAVBAR --}}
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

    <section class="max-w-2xl mx-auto px-4 sm:px-6 py-12 text-center">

        {{-- SUCCESS ICON --}}
        <div class="relative inline-block mb-6 slide-up">
            <div class="absolute inset-0 rounded-full pulse-ring" style="background: linear-gradient(135deg, #10b981 0%, #047857 100%);"></div>
            <div class="relative w-24 h-24 mx-auto rounded-full flex items-center justify-center glow-green" style="background: linear-gradient(135deg, #10b981 0%, #047857 100%);">
                <svg class="w-14 h-14 text-white icon-bounce" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"/>
                </svg>
            </div>
        </div>

        <h1 class="text-3xl md:text-4xl font-extrabold text-gray-800 mb-4 slide-up">
            Pendaftaran Berhasil! 🎉
        </h1>

        <p class="text-gray-600 text-lg leading-relaxed mb-8 max-w-md mx-auto slide-up">
            Terima kasih telah mendaftar program <strong class="text-emerald-700">OPBM RT 01</strong>. Data Anda telah kami terima di sistem.
        </p>

        {{-- KARTU DATA PENDAFTAR --}}
        @if($pendaftar)
        <div class="bg-gradient-to-br from-emerald-50 to-white rounded-3xl border-2 border-emerald-200 p-6 md:p-8 text-left mb-6 slide-up">
            <div class="flex items-center gap-3 mb-5">
                <div class="w-10 h-10 bg-emerald-600 rounded-xl flex items-center justify-center">
                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                    </svg>
                </div>
                <h3 class="font-bold text-lg text-gray-800">Data Pendaftaran Anda</h3>
            </div>
            <div class="space-y-3">
                <div class="flex justify-between py-2 border-b border-emerald-100">
                    <span class="text-gray-500 text-sm">Nama</span>
                    <span class="font-semibold text-gray-800 text-sm text-right">{{ $pendaftar['nama'] }}</span>
                </div>
                <div class="flex justify-between py-2 border-b border-emerald-100">
                    <span class="text-gray-500 text-sm">No HP</span>
                    <span class="font-semibold text-gray-800 text-sm text-right">{{ $pendaftar['hp'] }}</span>
                </div>
                <div class="flex justify-between py-2 border-b border-emerald-100">
                    <span class="text-gray-500 text-sm">Alamat</span>
                    <span class="font-semibold text-gray-800 text-sm text-right">{{ $pendaftar['alamat'] }}</span>
                </div>
                <div class="flex justify-between py-2 border-b border-emerald-100">
                    <span class="text-gray-500 text-sm">Blok / Zona</span>
                    <span class="font-semibold text-gray-800 text-sm text-right">{{ $pendaftar['zona'] }}</span>
                </div>
                <div class="flex justify-between py-2">
                    <span class="text-gray-500 text-sm">Waktu Daftar</span>
                    <span class="font-semibold text-gray-800 text-sm text-right">{{ $pendaftar['waktu'] }}</span>
                </div>
            </div>
        </div>
        @endif

        {{-- KARTU LANGKAH BERIKUTNYA --}}
        <div class="bg-white rounded-3xl shadow-sm border border-gray-100 p-6 md:p-8 text-left mb-6 slide-up">
            <div class="flex items-center gap-3 mb-5">
                <div class="w-10 h-10 bg-blue-100 rounded-xl flex items-center justify-center">
                    <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </div>
                <h3 class="font-bold text-lg text-gray-800">Apa Selanjutnya?</h3>
            </div>
            <div class="space-y-4">
                <div class="flex gap-3">
                    <div class="w-8 h-8 rounded-full bg-emerald-100 flex items-center justify-center flex-shrink-0 font-bold text-emerald-700 text-sm">1</div>
                    <div>
                        <p class="font-semibold text-gray-800">Kirim Notifikasi ke Pak RT</p>
                        <p class="text-sm text-gray-500">Klik tombol hijau di bawah agar Pak RT tahu Anda baru mendaftar.</p>
                    </div>
                </div>
                <div class="flex gap-3">
                    <div class="w-8 h-8 rounded-full bg-emerald-100 flex items-center justify-center flex-shrink-0 font-bold text-emerald-700 text-sm">2</div>
                    <div>
                        <p class="font-semibold text-gray-800">Verifikasi Data</p>
                        <p class="text-sm text-gray-500">Pengurus RT akan memverifikasi data Anda dalam 1-2 hari.</p>
                    </div>
                </div>
                <div class="flex gap-3">
                    <div class="w-8 h-8 rounded-full bg-emerald-100 flex items-center justify-center flex-shrink-0 font-bold text-emerald-700 text-sm">3</div>
                    <div>
                        <p class="font-semibold text-gray-800">Sampah Mulai Dijemput</p>
                        <p class="text-sm text-gray-500">Setelah disetujui, sampah Anda akan dijemput sesuai jadwal.</p>
                    </div>
                </div>
            </div>
        </div>

        {{-- TOMBOL WA KIRIM NOTIFIKASI --}}
        @if($pendaftar)
        @php
            $p = $pendaftar;
            $pesan = "Assalamualaikum Pak RT.\n\nSaya baru saja mendaftar program OPBM RT 01 melalui website.\n\n" .
                    "DATA PENDAFTARAN:\n" .
                    "- Nama: {$p['nama']}\n" .
                    "- No HP: {$p['hp']}\n" .
                    "- Alamat: {$p['alamat']}\n" .
                    "- Blok: {$p['zona']}\n" .
                    "- Waktu: {$p['waktu']}\n\n" .
                    "Mohon data saya diverifikasi. Terima kasih.";
        @endphp

        <div class="mb-6 slide-up">
            <a href="https://wa.me/6281234500001?text={{ urlencode($pesan) }}"
               target="_blank"
               class="group inline-flex items-center justify-center gap-3 w-full text-white px-8 py-4 rounded-2xl font-bold shadow-xl hover:shadow-2xl transition-all"
               style="background: linear-gradient(135deg, #25D366 0%, #128C7E 100%);">
                <svg class="w-6 h-6 group-hover:scale-110 transition-transform" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413Z"/>
                </svg>
                <div class="text-left">
                    <div class="font-bold">Kirim Notifikasi ke Pak RT</div>
                    <div class="text-xs text-white/90 font-normal">Via WhatsApp · Sekali klik</div>
                </div>
                <svg class="w-5 h-5 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M14 5l7 7m0 0l-7 7m7-7H3"/>
                </svg>
            </a>
            <p class="text-xs text-gray-500 mt-3">
                Pesan akan otomatis terisi dengan data pendaftaran Anda. Tinggal tekan <strong>Kirim</strong> di WhatsApp.
            </p>
        </div>
        @endif

        {{-- TOMBOL KEMBALI --}}
        <div class="flex flex-col sm:flex-row gap-3 justify-center slide-up">
            <a href="{{ route('warga.opbm') }}"
               class="inline-flex items-center justify-center gap-2 bg-emerald-700 hover:bg-emerald-800 text-white px-6 py-3 rounded-full font-bold transition shadow-md">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                </svg>
                Lihat Peserta OPBM
            </a>
            <a href="{{ route('home') }}"
               class="inline-flex items-center justify-center gap-2 bg-gray-100 hover:bg-gray-200 text-gray-700 px-6 py-3 rounded-full font-bold transition">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                </svg>
                Kembali ke Beranda
            </a>
        </div>

    </section>

    <footer class="bg-gray-900 text-gray-400 py-10 mt-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 text-center">
            <p class="text-sm">&copy; {{ date('Y') }} Kampung Digital OPBM RT 01 - Kota Jambi Bahagia</p>
        </div>
    </footer>

</body>
</html>