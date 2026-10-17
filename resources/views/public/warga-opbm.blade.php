<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Warga Peserta OPBM - Kampung Digital RT 01</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        .reveal { opacity: 0; transform: translateY(30px); transition: opacity 0.8s ease-out, transform 0.8s ease-out; }
        .reveal.active { opacity: 1; transform: translateY(0); }
        .lift-card { transition: transform 0.3s ease, box-shadow 0.3s ease; }
        .lift-card:hover { transform: translateY(-4px); box-shadow: 0 12px 24px rgba(0, 0, 0, 0.08); }
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
                <a href="{{ route('umkm.publik') }}" class="text-gray-700 hover:text-emerald-700 transition">UMKM</a>
                <a href="{{ route('dokumentasi.publik') }}" class="text-gray-700 hover:text-emerald-700 transition">Dokumentasi</a>
                <a href="{{ route('warga.opbm') }}" class="text-emerald-700 font-semibold">Warga OPBM</a>
                <a href="{{ route('struktur.publik') }}" class="text-gray-700 hover:text-emerald-700 transition">Struktur</a>
            </div>
        </div>
    </nav>

    <section class="text-white py-16" style="background: linear-gradient(135deg, #047857 0%, #064e3b 100%);">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 text-center">
            <span class="inline-block bg-white/10 backdrop-blur border border-white/20 px-4 py-1.5 rounded-full text-xs font-medium mb-4">Transparansi Data</span>
            <h1 class="text-4xl md:text-5xl font-extrabold mb-3">Warga Peserta OPBM</h1>
            <p class="text-emerald-100 max-w-2xl mx-auto">Daftar warga RT 01 yang telah bergabung dalam program penjemputan sampah berbasis masyarakat</p>
        </div>
    </section>

    @php
        $zonaMap = [];
        $counter = 1;
        foreach($pendaftars->pluck('zona')->unique()->sort()->values() as $z) {
            $zonaMap[$z] = 'A' . $counter;
            $counter++;
        }
    @endphp

    <section class="max-w-7xl mx-auto px-4 sm:px-6 -mt-8 relative z-10">
        <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
            <div class="bg-white rounded-2xl shadow-lg border-l-4 border-emerald-500 p-5 reveal">
                <p class="text-xs text-gray-500 uppercase font-semibold tracking-wider">Total Peserta</p>
                <p class="text-3xl font-bold text-emerald-600 mt-1">{{ $totalAktif }}</p>
                <p class="text-xs text-gray-400 mt-1">warga aktif</p>
            </div>
            <div class="bg-white rounded-2xl shadow-lg border-l-4 border-yellow-500 p-5 reveal">
                <p class="text-xs text-gray-500 uppercase font-semibold tracking-wider">Menunggu Verifikasi</p>
                <p class="text-3xl font-bold text-yellow-600 mt-1">{{ $totalPending }}</p>
                <p class="text-xs text-gray-400 mt-1">pendaftar baru</p>
            </div>
            <div class="bg-white rounded-2xl shadow-lg border-l-4 border-blue-500 p-5 reveal">
                <p class="text-xs text-gray-500 uppercase font-semibold tracking-wider">Total Blok</p>
                <p class="text-3xl font-bold text-blue-600 mt-1">{{ count($zonaMap) }}</p>
                <p class="text-xs text-gray-400 mt-1">blok aktif</p>
            </div>
            <div class="bg-white rounded-2xl shadow-lg border-l-4 border-purple-500 p-5 reveal">
                <p class="text-xs text-gray-500 uppercase font-semibold tracking-wider">Cakupan</p>
                <p class="text-3xl font-bold text-purple-600 mt-1">100%</p>
                <p class="text-xs text-gray-400 mt-1">gratis untuk warga</p>
            </div>
        </div>
    </section>

    <section class="max-w-7xl mx-auto px-4 sm:px-6 py-12">

        <div class="mb-6 reveal">
            <h2 class="text-2xl font-bold text-gray-800">Daftar Peserta Aktif</h2>
            <p class="text-gray-500 text-sm">Data diperbarui secara berkala oleh pengurus RT 01</p>
        </div>

        @if($pendaftars->count() > 0)
        <div class="reveal bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead class="bg-gray-50 border-b border-gray-100">
                        <tr>
                            <th class="px-6 py-4 text-left text-xs font-bold text-gray-500 uppercase tracking-wider" style="width: 60px;">No</th>
                            <th class="px-6 py-4 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">Nama Kepala Keluarga</th>
                            <th class="px-6 py-4 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">Blok</th>
                            <th class="px-6 py-4 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">Terdaftar</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @foreach($pendaftars as $i => $p)
                        @php $blokLabel = $zonaMap[$p->zona] ?? 'A1'; @endphp
                        <tr class="hover:bg-emerald-50/30 transition">
                            <td class="px-6 py-5 text-sm font-semibold text-gray-500">{{ $pendaftars->firstItem() + $i }}</td>
                            <td class="px-6 py-5">
                                <div class="flex items-center gap-3">
                                    <div class="w-11 h-11 rounded-full flex items-center justify-center text-white font-bold text-sm flex-shrink-0" style="background: linear-gradient(135deg, #10b981 0%, #047857 100%);">
                                        {{ strtoupper(substr($p->nama_kepala_keluarga, 0, 2)) }}
                                    </div>
                                    <div>
                                        <p class="font-bold text-gray-800">{{ $p->nama_kepala_keluarga }}</p>
                                        <p class="text-xs text-gray-500 flex items-center gap-1 mt-0.5">
                                            <span class="inline-block w-1.5 h-1.5 bg-emerald-500 rounded-full"></span>
                                            Peserta Aktif
                                        </p>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-5">
                                <span class="inline-flex items-center gap-1.5 bg-blue-100 text-blue-700 px-3 py-1.5 rounded-full text-xs font-bold">
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/></svg>
                                    Blok {{ $blokLabel }}
                                </span>
                            </td>
                            <td class="px-6 py-5">
                                <div class="flex items-center gap-2 text-sm text-gray-600">
                                    <svg class="w-4 h-4 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                                    {{ $p->created_at->format('d M Y') }}
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <div class="mt-8 flex justify-center">{{ $pendaftars->links() }}</div>
        @else
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 text-center py-20">
            <div class="w-20 h-20 bg-emerald-100 rounded-full flex items-center justify-center mx-auto mb-4">
                <svg class="w-10 h-10 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/></svg>
            </div>
            <p class="text-gray-500 font-medium">Belum ada warga yang terdaftar</p>
            <p class="text-gray-400 text-sm mt-1">Jadilah yang pertama bergabung dalam program OPBM</p>
        </div>
        @endif

    </section>

    {{-- CTA --}}
    <section class="max-w-7xl mx-auto px-4 sm:px-6 pb-16">
        <div class="reveal rounded-3xl p-8 md:p-12 text-center relative overflow-hidden text-white" style="background: linear-gradient(135deg, #047857 0%, #064e3b 100%);">
            <div class="absolute -top-8 -right-8 w-64 h-64 bg-yellow-400/20 rounded-full blur-3xl"></div>
            <div class="relative">
                <h2 class="text-3xl md:text-4xl font-extrabold mb-3">Ingin Bergabung?</h2>
                <p class="text-emerald-100 mb-8 max-w-2xl mx-auto">Daftarkan keluarga Anda untuk menikmati layanan penjemputan sampah gratis dari program OPBM RT 01</p>

                <div class="flex flex-col sm:flex-row gap-4 justify-center">
                    {{-- Tombol Isi Formulir --}}
                    <a href="{{ route('daftar.opbm') }}"
                       class="inline-flex items-center justify-center gap-2 text-emerald-900 px-8 py-3 rounded-full font-bold transition shadow-lg hover:shadow-xl"
                       style="background: linear-gradient(90deg, #fbbf24 0%, #f59e0b 100%);">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                        </svg>
                        Isi Formulir Pendaftaran
                    </a>

                    {{-- Tombol WhatsApp --}}
                    <a href="https://wa.me/6281234500001?text={{ urlencode('Assalamualaikum Pak RT. Saya ingin tanya tentang program OPBM RT 01.') }}"
                       target="_blank"
                       class="inline-flex items-center justify-center gap-2 bg-white/10 border-2 border-white text-white px-8 py-3 rounded-full font-bold hover:bg-white hover:text-emerald-800 transition">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413Z"/>
                        </svg>
                        Chat Pak RT
                    </a>
                </div>
            </div>
        </div>
    </section>

    <footer class="bg-gray-900 text-gray-400 py-10">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 text-center">
            <p class="text-sm">&copy; {{ date('Y') }} Kampung Digital OPBM RT 01 - Kota Jambi Bahagia</p>
        </div>
    </footer>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const reveals = document.querySelectorAll('.reveal');
            const observer = new IntersectionObserver((entries) => {
                entries.forEach((entry, index) => {
                    if (entry.isIntersecting) {
                        setTimeout(() => { entry.target.classList.add('active'); }, index * 80);
                        observer.unobserve(entry.target);
                    }
                });
            }, { threshold: 0.1, rootMargin: '0px 0px -50px 0px' });
            reveals.forEach(el => observer.observe(el));
        });
    </script>

</body>
</html>