@extends('layouts.app')

@section('title', 'Iuran OPBM')

@section('content')

<style>
    @keyframes blink {
        0%, 100% { opacity: 1; }
        50% { opacity: 0.3; }
    }
</style>

{{-- HEADER --}}
<div class="flex justify-between items-center mb-6 flex-wrap gap-3">
    <div>
        <h1 class="text-2xl font-bold">Iuran Bulanan OPBM</h1>
        <p class="text-gray-500 text-sm">
            Iuran Rp 50.000/bulan ·
            Login sebagai: <strong class="text-emerald-700">
                {{ Auth::user()->role === 'bendahara' ? '🪙 Bendahara' : '🏠 RT' }} ({{ Auth::user()->name }})
            </strong>
        </p>
    </div>
    <div class="flex items-center gap-2 flex-wrap">
        <div class="inline-flex items-center gap-1.5 bg-emerald-50 text-emerald-700 px-3 py-2 rounded-full text-xs font-semibold">
            <span class="w-1.5 h-1.5 bg-emerald-500 rounded-full" style="animation: blink 2s infinite;"></span>
            Auto-refresh 5s
        </div>
        <a href="{{ route('pembayaran.export.excel', ['bulan' => $bulan, 'tahun' => $tahun]) }}" class="inline-flex items-center gap-2 bg-green-600 hover:bg-green-700 text-white px-4 py-2.5 rounded-full font-semibold text-sm transition shadow-sm">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
            Excel
        </a>
        <a href="{{ route('pembayaran.export.pdf', ['bulan' => $bulan, 'tahun' => $tahun]) }}" target="_blank" class="inline-flex items-center gap-2 bg-red-500 hover:bg-red-600 text-white px-4 py-2.5 rounded-full font-semibold text-sm transition shadow-sm">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"/></svg>
            PDF
        </a>
    </div>
</div>

{{-- SECTION VALIDASI QRIS PENDING --}}
@if(isset($pembayaransPending) && $pembayaransPending->count() > 0)
<div class="bg-yellow-50 border-2 border-yellow-400 rounded-2xl p-6 mb-8 shadow-sm">
    <div class="flex items-center gap-3 mb-4">
        <div class="w-10 h-10 bg-yellow-400 rounded-full flex items-center justify-center text-white animate-pulse">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
        </div>
        <div>
            <h2 class="text-lg font-bold text-yellow-800">Menunggu Validasi QRIS ({{ $pembayaransPending->count() }})</h2>
            <p class="text-xs text-yellow-700">Warga telah mengunggah bukti transfer. Harap verifikasi mutasi rekening Anda.</p>
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
        @foreach($pembayaransPending as $pending)
        <div class="bg-white rounded-xl p-4 shadow-sm border border-yellow-200 flex flex-col justify-between">
            <div>
                <div class="flex justify-between items-start mb-2">
                    <div>
                        <p class="font-bold text-gray-800">{{ $pending->pendaftaran->nama_kepala_keluarga }}</p>
                        <p class="text-xs text-gray-500">{{ $pending->pendaftaran->zona }} | {{ $pending->pendaftaran->no_hp }}</p>
                    </div>
                    <span class="bg-yellow-100 text-yellow-700 text-[10px] font-bold px-2 py-1 rounded-full">PENDING</span>
                </div>
                <div class="text-sm text-gray-600 mb-3">
                    Iuran: <b>{{ $pending->bulan }}/{{ $pending->tahun }}</b><br>
                    Nominal: <b>Rp {{ number_format($pending->jumlah_bayar, 0, ',', '.') }}</b>
                </div>
            </div>
            
                      <div class="flex items-center gap-2 mt-4 pt-3 border-t border-gray-100">
                @if($pending->bukti_bayar)
                    <a href="{{ asset('storage/' . $pending->bukti_bayar) }}" target="_blank" class="flex-1 text-center bg-gray-100 hover:bg-gray-200 text-gray-700 px-3 py-2 rounded-lg text-xs font-semibold transition">
                        Lihat Bukti
                    </a>
                @else
                    <span class="flex-1 text-center bg-red-100 text-red-700 px-3 py-2 rounded-lg text-xs font-semibold">
                        Bukti Kosong
                    </span>
                @endif
                <form action="{{ route('pembayaran.validasi.qris', $pending->id) }}" method="POST" class="flex-1" onsubmit="return confirm('Validasi pembayaran ini menjadi LUNAS?')">
                    @csrf
                    <button type="submit" class="w-full bg-emerald-600 hover:bg-emerald-700 text-white px-3 py-2 rounded-lg text-xs font-bold transition">
                        Validasi LUNAS
                    </button>
                </form>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endif

{{-- FILTER --}}
<div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-5 mb-6">
    <form method="GET" action="{{ route('pembayaran.index') }}" class="flex flex-wrap items-end gap-4">
        <div>
            <label class="block text-sm font-semibold text-gray-700 mb-2">Bulan</label>
            <select name="bulan" class="border-2 border-gray-200 rounded-xl px-4 py-2.5 pr-10 bg-white focus:border-emerald-500 outline-none transition cursor-pointer" style="appearance: none; background-image: url('data:image/svg+xml;charset=UTF-8,%3csvg xmlns=%27http://www.w3.org/2000/svg%27 viewBox=%270 0 24 24%27 fill=%27none%27 stroke=%27%236b7280%27 stroke-width=%272%27%3e%3cpolyline points=%276 9 12 15 18 9%27/%3e%3c/svg%3e'); background-repeat: no-repeat; background-position: right 12px center; background-size: 16px;">
                @foreach($namaBulan as $i => $nb)
                    <option value="{{ $i + 1 }}" @selected($bulan == ($i + 1))>{{ $nb }}</option>
                @endforeach
            </select>
        </div>
        <div>
            <label class="block text-sm font-semibold text-gray-700 mb-2">Tahun</label>
            <select name="tahun" class="border-2 border-gray-200 rounded-xl px-4 py-2.5 pr-10 bg-white focus:border-emerald-500 outline-none transition cursor-pointer" style="min-width: 130px; appearance: none; background-image: url('data:image/svg+xml;charset=UTF-8,%3csvg xmlns=%27http://www.w3.org/2000/svg%27 viewBox=%270 0 24 24%27 fill=%27none%27 stroke=%27%236b7280%27 stroke-width=%272%27%3e%3cpolyline points=%276 9 12 15 18 9%27/%3e%3c/svg%3e'); background-repeat: no-repeat; background-position: right 12px center; background-size: 16px;">
                @for($y = now()->year - 2; $y <= now()->year + 1; $y++)
                    <option value="{{ $y }}" @selected($tahun == $y)>{{ $y }}</option>
                @endfor
            </select>
        </div>
        <button type="submit" class="bg-emerald-600 hover:bg-emerald-700 text-white px-6 py-2.5 rounded-xl font-semibold transition shadow-sm">
            Tampilkan
        </button>
    </form>
</div>

{{-- STATISTIK --}}
<div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-6">
    <div class="bg-white rounded-2xl shadow-sm border-l-4 border-blue-500 p-5">
        <p class="text-xs text-gray-500 uppercase font-semibold tracking-wider">Total Warga</p>
        <p class="text-3xl font-bold text-blue-600 mt-1">{{ $totalWarga }}</p>
        <p class="text-xs text-gray-400 mt-1">kepala keluarga aktif</p>
    </div>
    <div class="bg-white rounded-2xl shadow-sm border-l-4 border-emerald-500 p-5">
        <p class="text-xs text-gray-500 uppercase font-semibold tracking-wider">Sudah Bayar</p>
        <p class="text-3xl font-bold text-emerald-600 mt-1">{{ $sudahBayar }}</p>
        <p class="text-xs text-gray-400 mt-1">{{ $namaBulan[$bulan - 1] }} {{ $tahun }}</p>
    </div>
    <div class="bg-white rounded-2xl shadow-sm border-l-4 border-red-500 p-5">
        <p class="text-xs text-gray-500 uppercase font-semibold tracking-wider">Belum Bayar</p>
        <p class="text-3xl font-bold text-red-600 mt-1">{{ $belumBayar }}</p>
        <p class="text-xs text-gray-400 mt-1">menunggu pembayaran</p>
    </div>
    <div class="bg-white rounded-2xl shadow-sm border-l-4 border-yellow-500 p-5">
        <p class="text-xs text-gray-500 uppercase font-semibold tracking-wider">Terkumpul</p>
        <p class="text-2xl font-bold text-yellow-600 mt-1">Rp {{ number_format($totalTerkumpul, 0, ',', '.') }}</p>
        <p class="text-xs text-gray-400 mt-1">dari Rp {{ number_format($totalWarga * 50000, 0, ',', '.') }}</p>
    </div>
</div>

{{-- PROGRESS BAR --}}
<div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-5 mb-6">
    <div class="flex justify-between items-center mb-2">
        <p class="font-semibold text-gray-700">Progress Pembayaran {{ $namaBulan[$bulan - 1] }} {{ $tahun }}</p>
        <p class="text-sm font-bold text-emerald-600">
            {{ $totalWarga > 0 ? round(($sudahBayar / $totalWarga) * 100) : 0 }}%
        </p>
    </div>
    <div class="w-full bg-gray-100 rounded-full h-4 overflow-hidden">
        <div class="h-full rounded-full transition-all duration-500" style="width: {{ $totalWarga > 0 ? ($sudahBayar / $totalWarga) * 100 : 0 }}%; background: linear-gradient(90deg, #10b981 0%, #047857 100%);"></div>
    </div>
</div>

{{-- INFO ANTI KECURANGAN --}}
<div class="bg-blue-50 border-l-4 border-blue-500 p-4 rounded-2xl mb-6">
    <div class="flex items-start gap-3">
        <svg class="w-6 h-6 text-blue-600 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
        </svg>
        <div class="text-sm text-blue-800">
            <p class="font-bold">🔒 Sistem Anti-Kecurangan Aktif</p>
            <p class="mt-1">Setiap konfirmasi & pembatalan dicatat: <strong>siapa</strong>, <strong>role</strong> (RT/Bendahara), dan <strong>waktunya</strong>. Sinkronisasi realtime antar kedua aktor.</p>
        </div>
    </div>
</div>

{{-- TABEL --}}
<div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden mb-6">
    <div class="overflow-x-auto">
        <table class="w-full" style="border-collapse: collapse;">
            <thead class="bg-gray-50 border-b border-gray-100">
                <tr>
                    <th class="px-6 py-4 text-left text-xs font-bold text-gray-500 uppercase" style="width:60px;">No</th>
                    <th class="px-6 py-4 text-left text-xs font-bold text-gray-500 uppercase">Nama Kepala Keluarga</th>
                    <th class="px-6 py-4 text-left text-xs font-bold text-gray-500 uppercase">Blok</th>
                    <th class="px-6 py-4 text-left text-xs font-bold text-gray-500 uppercase">Status</th>
                    <th class="px-6 py-4 text-left text-xs font-bold text-gray-500 uppercase">Konfirmasi</th>
                    <th class="px-6 py-4 text-right text-xs font-bold text-gray-500 uppercase">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($data as $i => $d)
                @php
                    $p = $d->pembayaran;
                    $rtOk = $p && $p->rt_confirmed_by;
                    $bendaharaOk = $p && $p->bendahara_confirmed_by;
                    $isDouble = $rtOk && $bendaharaOk;
                    $initials = strtoupper(substr($d->warga->nama_kepala_keluarga, 0, 2));
                    $bgRow = $d->sudah_bayar ? '#f0fdf4' : '#fef2f2';
                    $borderRow = $d->sudah_bayar ? '#10b981' : '#ef4444';
                @endphp
                <tr style="background: {{ $bgRow }}; border-bottom: 1px solid #e5e7eb; border-left: 3px solid {{ $borderRow }};">
                    <td class="px-6 py-4 text-sm text-gray-500">{{ $i + 1 }}</td>
                    <td class="px-6 py-4">
                        <div style="display:flex; align-items:center; gap:12px;">
                            <div style="width:40px; height:40px; border-radius:50%; background:linear-gradient(135deg, #10b981 0%, #047857 100%); color:white; display:flex; align-items:center; justify-content:center; font-weight:700; font-size:12px; flex-shrink:0;">
                                {{ $initials }}
                            </div>
                            <span style="font-weight:600; color:#1f2937;">{{ $d->warga->nama_kepala_keluarga }}</span>
                        </div>
                    </td>
                    <td class="px-6 py-4">
                        <span style="background:#dbeafe; color:#1e40af; padding:4px 12px; border-radius:9999px; font-size:11px; font-weight:700;">{{ $d->warga->zona }}</span>
                    </td>
                    <td class="px-6 py-4">
                        @if($d->sudah_bayar)
                            <span style="display:inline-flex; align-items:center; gap:4px; background:linear-gradient(135deg, #10b981, #047857); color:white; font-size:11px; font-weight:700; padding:5px 12px; border-radius:9999px;">
                                ✓ LUNAS
                            </span>
                        @else
                            <span style="display:inline-flex; align-items:center; gap:4px; background:linear-gradient(135deg, #ef4444, #b91c1c); color:white; font-size:11px; font-weight:700; padding:5px 12px; border-radius:9999px;">
                                ✗ BELUM BAYAR
                            </span>
                        @endif
                    </td>
                    <td class="px-6 py-4">
                        @if($d->sudah_bayar)
                            @if($isDouble)
                                <span style="display:inline-flex; align-items:center; gap:4px; background:linear-gradient(90deg, #fbbf24, #f59e0b); color:#78350f; font-size:10px; font-weight:800; padding:4px 10px; border-radius:9999px; box-shadow:0 2px 6px rgba(245,158,11,0.3);">
                                    ✓✓ RT & Bendahara
                                </span>
                            @elseif($rtOk)
                                <span style="display:inline-flex; align-items:center; gap:4px; background:#d1fae5; color:#047857; font-size:10px; font-weight:700; padding:4px 10px; border-radius:9999px; border:1px solid #10b981;">
                                    ✓ RT: {{ $p->rtConfirmer->name ?? '-' }}
                                </span>
                            @elseif($bendaharaOk)
                                <span style="display:inline-flex; align-items:center; gap:4px; background:#dbeafe; color:#1e40af; font-size:10px; font-weight:700; padding:4px 10px; border-radius:9999px; border:1px solid #3b82f6;">
                                    ✓ Bendahara: {{ $p->bendaharaConfirmer->name ?? '-' }}
                                </span>
                            @else
                                <span style="font-size:11px; color:#9ca3af;">-</span>
                            @endif
                        @else
                            <span style="font-size:11px; color:#9ca3af;">-</span>
                        @endif
                    </td>
                    <td class="px-6 py-4 text-right whitespace-nowrap">
                        @if($d->sudah_bayar)
                            <form action="{{ route('pembayaran.batal') }}" method="POST" style="display:inline;" onsubmit="return confirm('Batalkan pembayaran {{ $d->warga->nama_kepala_keluarga }}? Aksi ini akan dicatat.')">
                                @csrf
                                <input type="hidden" name="pendaftaran_opbm_id" value="{{ $d->warga->id }}">
                                <input type="hidden" name="bulan" value="{{ $bulan }}">
                                <input type="hidden" name="tahun" value="{{ $tahun }}">
                                <button style="color:#ef4444; font-size:13px; background:none; border:none; cursor:pointer;">
                                    Batalkan
                                </button>
                            </form>
                        @else
                            <form action="{{ route('pembayaran.bayar') }}" method="POST" style="display:inline;">
                                @csrf
                                <input type="hidden" name="pendaftaran_opbm_id" value="{{ $d->warga->id }}">
                                <input type="hidden" name="bulan" value="{{ $bulan }}">
                                <input type="hidden" name="tahun" value="{{ $tahun }}">
                                <button style="background:linear-gradient(90deg, #10b981 0%, #047857 100%); color:white; padding:8px 16px; border-radius:9999px; font-size:12px; font-weight:700; border:none; cursor:pointer; box-shadow:0 2px 6px rgba(16,185,129,0.3); display:inline-flex; align-items:center; gap:6px;">
                                    <span style="font-size:14px;">+</span> Konfirmasi LUNAS
                                </button>
                            </form>
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

{{-- TOTAL KAS --}}
<div class="bg-gradient-to-br from-emerald-600 to-emerald-800 text-white rounded-2xl p-6 mb-6">
    <div class="flex items-center gap-3 mb-2">
        <svg class="w-6 h-6 text-yellow-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
        <p class="text-sm uppercase tracking-wider font-semibold">Total Kas OPBM Keseluruhan</p>
    </div>
    <p class="text-3xl md:text-4xl font-extrabold">Rp {{ number_format($totalAllTime, 0, ',', '.') }}</p>
</div>

<script>
    const hasFlash = {{ session('success') ? 'true' : 'false' }};
    const delay = hasFlash ? 8000 : 5000;
    let paused = false;

    ['mousedown', 'keydown', 'touchstart'].forEach(evt => {
        document.addEventListener(evt, () => {
            paused = true;
            clearTimeout(window.__pauseTimeout);
            window.__pauseTimeout = setTimeout(() => { paused = false; }, 15000);
        }, { passive: true });
    });

    setTimeout(function() {
        if (!paused) window.location.reload();
        else setTimeout(() => window.location.reload(), 8000);
    }, delay);
</script>

@endsection