<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cek Status Iuran - Kampung Digital RT 01</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
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
                <a href="{{ route('cek.iuran') }}" class="text-emerald-700 font-semibold">Cek Iuran</a>
            </div>
        </div>
    </nav>

    <section class="max-w-3xl mx-auto px-4 sm:px-6 py-12">
        <div class="text-center mb-10">
            <h1 class="text-3xl font-extrabold text-gray-800 mb-2">Cek Status Iuran OPBM</h1>
            <p class="text-gray-500 text-sm">Masukkan Nomor WhatsApp yang terdaftar untuk melihat status pembayaran Anda.</p>
        </div>

        @if(session('error'))
            <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 rounded-lg mb-6">
                {{ session('error') }}
            </div>
        @endif
        @if(session('success'))
            <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 rounded-lg mb-6">
                {{ session('success') }}
            </div>
        @endif

        <div class="bg-white p-6 md:p-8 rounded-3xl shadow-sm border border-gray-100 mb-8">
            <form action="{{ route('cek.iuran.proses') }}" method="POST" class="flex flex-col sm:flex-row gap-3">
                @csrf
                <div class="flex-1">
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Nomor WhatsApp Anda</label>
                    <div class="flex">
                        <span class="inline-flex items-center px-4 bg-gray-100 border-2 border-r-0 border-gray-200 rounded-l-xl text-gray-600 font-semibold">+62</span>
                        <input type="text" name="no_hp" value="{{ request('no_hp') }}" placeholder="81234567890" class="w-full border-2 border-gray-200 rounded-r-xl px-4 py-3 focus:border-emerald-500 outline-none" required>
                    </div>
                </div>
                <div class="flex items-end">
                    <button type="submit" class="w-full sm:w-auto bg-emerald-700 hover:bg-emerald-800 text-white px-8 py-3.5 rounded-xl font-bold transition shadow-md">
                        Cek Sekarang
                    </button>
                </div>
            </form>
        </div>

        @if(isset($warga))
        <div class="bg-white rounded-3xl shadow-lg border border-gray-100 overflow-hidden">
            <div class="bg-gradient-to-r from-emerald-700 to-emerald-900 p-6 text-white">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm text-emerald-200 mb-1">Nama Kepala Keluarga</p>
                        <h2 class="text-2xl font-bold">{{ $warga->nama_kepala_keluarga }}</h2>
                        <p class="text-sm text-emerald-100 mt-1">{{ $warga->alamat }}</p>
                    </div>
                    <div class="bg-white/20 px-3 py-1 rounded-full text-xs font-bold backdrop-blur">
                        {{ $warga->zona }}
                    </div>
                </div>
            </div>

            <div class="p-6">
                <h3 class="font-bold text-lg text-gray-800 mb-4 border-b pb-2">Riwayat Iuran</h3>
                
                @if($pembayarans->count() > 0)
                <div class="space-y-3">
                    @foreach($pembayarans as $p)
                        @php
                            $namaBulan = ['', 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'][$p->bulan];
                        @endphp
                        <div class="flex items-center justify-between p-4 rounded-2xl border-2 
                            @if($p->status == 'lunas') border-emerald-200 bg-emerald-50 
                            @elseif($p->status == 'pending') border-yellow-200 bg-yellow-50
                            @elseif($p->status == 'dikonfirmasi_rt') border-blue-200 bg-blue-50
                            @else border-red-200 bg-red-50 @endif">
                            
                            <div>
                                <p class="font-bold text-gray-800">{{ $namaBulan }} {{ $p->tahun }}</p>
                                <p class="text-xs text-gray-500 mt-1">
                                    Metode: {{ strtoupper($p->metode_bayar) }} | Rp {{ number_format($p->jumlah_bayar, 0, ',', '.') }}
                                </p>
                            </div>
                            
                            <div class="text-right">
                                @if($p->status == 'lunas')
                                    <span class="inline-flex items-center gap-1 bg-emerald-500 text-white px-3 py-1.5 rounded-full text-xs font-bold">
                                        ✓ LUNAS
                                    </span>
                                @elseif($p->status == 'pending')
                                    <span class="inline-flex items-center gap-1 bg-yellow-400 text-white px-3 py-1.5 rounded-full text-xs font-bold">
                                        ⏳ MENUNGGU VALIDASI
                                    </span>
                                @elseif($p->status == 'dikonfirmasi_rt')
                                    <span class="inline-flex items-center gap-1 bg-blue-500 text-white px-3 py-1.5 rounded-full text-xs font-bold">
                                        💵 DI RT
                                    </span>
                                @else
                                    <span class="inline-flex items-center gap-1 bg-red-500 text-white px-3 py-1.5 rounded-full text-xs font-bold">
                                        ✗ DIBATALKAN
                                    </span>
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>
                @else
                <div class="text-center py-8 text-gray-500">
                    Belum ada riwayat pembayaran yang tercatat.
                </div>
                @endif
            </div>
        </div>
        @endif
    </section>

    <footer class="bg-gray-900 text-gray-400 py-10 mt-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 text-center text-sm">
            &copy; {{ date('Y') }} Kampung Digital OPBM RT 01 - Kota Jambi Bahagia
        </div>
    </footer>

</body>
</html>