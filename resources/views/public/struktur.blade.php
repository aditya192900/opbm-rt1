<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Struktur Pengurus RT 01 - Kampung Digital</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        * { box-sizing: border-box; }
        body { font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif; margin: 0; background: #f9fafb; color: #1f2937; }

        .navbar { background: white; box-shadow: 0 1px 3px rgba(0,0,0,0.06); position: sticky; top: 0; z-index: 50; }
        .navbar-inner { max-width: 1200px; margin: 0 auto; padding: 12px 24px; display: flex; justify-content: space-between; align-items: center; gap: 24px; }
        .navbar-brand { display: flex; align-items: center; gap: 12px; text-decoration: none; }
        .navbar-logo { width: 44px; height: 44px; background: #047857; color: white; border-radius: 12px; display: flex; align-items: center; justify-content: center; font-weight: 700; font-size: 14px; }
        .navbar-title { font-weight: 700; font-size: 14px; color: #1f2937; line-height: 1.2; }
        .navbar-sub   { font-size: 12px; color: #6b7280; line-height: 1.2; }
        .navbar-menu  { display: flex; gap: 20px; }
        .navbar-menu a { color: #374151; text-decoration: none; font-size: 13px; transition: color 0.2s; font-weight: 500; }
        .navbar-menu a:hover { color: #047857; }
        .navbar-menu a.active { color: #047857; font-weight: 700; }

        .page-header { background: linear-gradient(135deg, #047857 0%, #064e3b 100%); color: white; padding: 56px 24px; text-align: center; position: relative; overflow: hidden; }
        .page-header h1 { font-size: 40px; font-weight: 800; margin: 0 0 12px 0; }
        .page-header p { color: #a7f3d0; margin: 0; }

        .org-wrap { max-width: 1200px; margin: 0 auto; padding: 60px 24px; display: flex; flex-direction: column; align-items: center; }

        .card { background: white; border-radius: 24px; box-shadow: 0 4px 12px rgba(0,0,0,0.06); padding: 24px; text-align: center; border: 2px solid transparent; transition: transform 0.3s, box-shadow 0.3s; }
        .card:hover { transform: translateY(-4px); box-shadow: 0 12px 24px rgba(0,0,0,0.1); }

        .card-lg { width: 340px; }
        .card-md { width: 300px; }
        .card-sm { width: 260px; }

        .avatar { margin: 0 auto 16px; border-radius: 50%; display: flex; align-items: center; justify-content: center; overflow: hidden; border: 4px solid; font-weight: 700; color: white; }
        .avatar img { width: 100%; height: 100%; object-fit: cover; }
        .avatar-lg { width: 96px; height: 96px; font-size: 32px; }
        .avatar-md { width: 80px; height: 80px; font-size: 24px; }
        .avatar-sm { width: 64px; height: 64px; font-size: 18px; }

        .badge { display: inline-block; color: white; font-weight: 700; text-transform: uppercase; letter-spacing: 0.05em; padding: 6px 16px; border-radius: 999px; margin-bottom: 12px; }
        .badge-lg { font-size: 12px; }
        .badge-md { font-size: 11px; }
        .badge-sm { font-size: 10px; padding: 4px 12px; }

        .card-name { font-weight: 700; color: #1f2937; margin: 0 0 8px 0; }
        .card-lg .card-name { font-size: 20px; }
        .card-md .card-name { font-size: 16px; }
        .card-sm .card-name { font-size: 14px; }

        .card-desc { color: #6b7280; font-size: 13px; line-height: 1.5; margin: 0; }

        .trunk { width: 3px; height: 40px; }

        .branch-row { position: relative; width: 100%; display: flex; justify-content: center; gap: 32px; padding-top: 40px; flex-wrap: wrap; }
        .branch-row::before { content: ''; position: absolute; top: 0; height: 3px; background: #94a3b8; }
        .branch-row.branch-3::before { left: 18%; right: 18%; }
        .branch-row.branch-4::before { left: 13%; right: 13%; }

        .branch-item { position: relative; }
        .branch-item::before { content: ''; position: absolute; top: -40px; left: 50%; transform: translateX(-50%); width: 3px; height: 40px; background: #94a3b8; }

        .anggota-card { background: linear-gradient(135deg, #047857, #065f46); color: white; border-radius: 24px; box-shadow: 0 8px 24px rgba(4,120,87,0.3); padding: 24px 40px; text-align: center; max-width: 480px; margin: 0 auto; }
        .anggota-card h3 { font-size: 20px; margin: 0 0 6px 0; font-weight: 700; }
        .anggota-card p { color: #a7f3d0; font-size: 13px; margin: 0; }

        .footer { background: #111827; color: #9ca3af; padding: 32px; text-align: center; font-size: 14px; }

        @media (max-width: 768px) {
            .navbar-menu { display: none; }
            .page-header h1 { font-size: 28px; }
            .card-lg, .card-md, .card-sm { width: 100%; max-width: 340px; }
            .branch-row::before, .branch-item::before { display: none; }
            .branch-row { padding-top: 24px; gap: 24px; }
            .trunk { height: 24px; }
        }
    </style>
</head>
<body>

    {{-- NAVBAR --}}
    <nav class="navbar">
        <div class="navbar-inner">
            <a href="{{ route('home') }}" class="navbar-brand">
                <div class="navbar-logo">RT</div>
                <div>
                    <div class="navbar-title">Informasi Warga</div>
                    <div class="navbar-sub">RT 01 - Kampung Digital</div>
                </div>
            </a>
            <div class="navbar-menu">
                <a href="{{ route('home') }}">Beranda</a>
                <a href="{{ route('profil.rt') }}">Profil RT</a>
                <a href="{{ route('program.opbm') }}">Program OPBM</a>
                <a href="{{ route('warga.opbm') }}">Warga OPBM</a>
                <a href="{{ route('struktur.publik') }}" class="active">Struktur</a>
            </div>
        </div>
    </nav>

    {{-- HEADER --}}
    <div class="page-header">
        <h1>Struktur Pengurus</h1>
        <p>RT 01 - Kampung Digital, Kota Jambi</p>
    </div>

    @php
        $ketua      = $penguruss->firstWhere('jabatan', 'Ketua RT');
        $wakil      = $penguruss->firstWhere('jabatan', 'Wakil Ketua RT');
        $sekretaris = $penguruss->firstWhere('jabatan', 'Sekretaris');
        $bendahara  = $penguruss->firstWhere('jabatan', 'Bendahara');
        $seksis     = $penguruss->filter(fn($p) => str_starts_with($p->jabatan, 'Seksi'))->take(4);

        $deskripsi = [
            'Ketua RT'         => 'Memimpin dan mengkoordinasikan seluruh kegiatan di lingkungan RT 01.',
            'Wakil Ketua RT'   => 'Membantu ketua dalam menjalankan tugas dan koordinasi kegiatan.',
            'Sekretaris'       => 'Mengelola administrasi, surat-menyurat, dan pencatatan kegiatan.',
            'Bendahara'        => 'Mengelola keuangan dan laporan pemasukan serta pengeluaran.',
            'Seksi Keamanan'   => 'Menjaga keamanan dan ketertiban lingkungan RT 01.',
            'Seksi Kebersihan' => 'Mengelola kebersihan dan lingkungan sekitar RT 01.',
            'Seksi Kesehatan'  => 'Memantau kesehatan warga dan membantu kegiatan sosial.',
            'Seksi Pemuda'     => 'Mengkoordinasikan kegiatan pemuda dan olahraga.',
            'Seksi Sosial'     => 'Menangani kegiatan sosial dan bantuan warga.',
            'Seksi Agama'      => 'Mengkoordinasikan kegiatan keagamaan warga.',
            'Seksi Olahraga'   => 'Mengelola kegiatan olahraga dan kesenian warga.',
        ];

        $warna = [
            'Ketua RT'         => ['bg' => '#3b82f6', 'ring' => '#bfdbfe'],
            'Wakil Ketua RT'   => ['bg' => '#22c55e', 'ring' => '#bbf7d0'],
            'Sekretaris'       => ['bg' => '#f59e0b', 'ring' => '#fde68a'],
            'Bendahara'        => ['bg' => '#8b5cf6', 'ring' => '#ddd6fe'],
            'Seksi Keamanan'   => ['bg' => '#3b82f6', 'ring' => '#bfdbfe'],
            'Seksi Kebersihan' => ['bg' => '#22c55e', 'ring' => '#bbf7d0'],
            'Seksi Kesehatan'  => ['bg' => '#f59e0b', 'ring' => '#fde68a'],
            'Seksi Pemuda'     => ['bg' => '#8b5cf6', 'ring' => '#ddd6fe'],
            'Seksi Sosial'     => ['bg' => '#ec4899', 'ring' => '#fbcfe8'],
            'Seksi Agama'      => ['bg' => '#06b6d4', 'ring' => '#a5f3fc'],
            'Seksi Olahraga'   => ['bg' => '#f97316', 'ring' => '#fed7aa'],
        ];
        $warnaDefault = ['bg' => '#10b981', 'ring' => '#a7f3d0'];
    @endphp

    {{-- ORG CHART --}}
    <section class="py-16 bg-gradient-to-b from-white to-gray-50">
        <div class="org-wrap">

            {{-- KETUA RT --}}
            @if($ketua)
            @php $c = $warna[$ketua->jabatan] ?? $warnaDefault; @endphp
            <div class="card card-lg" style="border-color: {{ $c['bg'] }};">
                <div class="avatar avatar-lg" style="background-color: {{ $c['bg'] }}; border-color: {{ $c['ring'] }};">
                    @if($ketua->foto)
                        <img src="{{ asset('storage/' . $ketua->foto) }}">
                    @else
                        {{ strtoupper(substr($ketua->nama, 0, 2)) }}
                    @endif
                </div>
                <span class="badge badge-lg" style="background-color: {{ $c['bg'] }};">{{ $ketua->jabatan }}</span>
                <h3 class="card-name">{{ $ketua->nama }}</h3>
                <p class="card-desc">{{ $deskripsi[$ketua->jabatan] ?? 'Memimpin dan mengkoordinasikan kegiatan RT.' }}</p>
            </div>
            <div class="trunk" style="background:#3b82f6;"></div>
            @endif

            {{-- WAKIL, SEKRETARIS, BENDAHARA --}}
            @php $mid = collect([$wakil, $sekretaris, $bendahara])->filter(); @endphp
            @if($mid->count() > 0)
            <div class="branch-row branch-3">
                @foreach($mid as $p)
                    @php $c = $warna[$p->jabatan] ?? $warnaDefault; @endphp
                    <div class="card card-md branch-item" style="border-color: {{ $c['bg'] }};">
                        <div class="avatar avatar-md" style="background-color: {{ $c['bg'] }}; border-color: {{ $c['ring'] }};">
                            @if($p->foto)
                                <img src="{{ asset('storage/' . $p->foto) }}">
                            @else
                                {{ strtoupper(substr($p->nama, 0, 2)) }}
                            @endif
                        </div>
                        <span class="badge badge-md" style="background-color: {{ $c['bg'] }};">{{ $p->jabatan }}</span>
                        <h3 class="card-name">{{ $p->nama }}</h3>
                        <p class="card-desc">{{ $deskripsi[$p->jabatan] ?? 'Membantu tugas pengurus RT.' }}</p>
                    </div>
                @endforeach
            </div>
            @endif

            {{-- SEKSI --}}
            @if($seksis->count() > 0)
            <div class="trunk" style="background:#94a3b8;"></div>
            <div class="branch-row branch-4">
                @foreach($seksis as $p)
                    @php $c = $warna[$p->jabatan] ?? $warnaDefault; @endphp
                    <div class="card card-sm branch-item" style="border-color: {{ $c['bg'] }};">
                        <div class="avatar avatar-sm" style="background-color: {{ $c['bg'] }}; border-color: {{ $c['ring'] }};">
                            @if($p->foto)
                                <img src="{{ asset('storage/' . $p->foto) }}">
                            @else
                                {{ strtoupper(substr($p->nama, 0, 2)) }}
                            @endif
                        </div>
                        <span class="badge badge-sm" style="background-color: {{ $c['bg'] }};">{{ $p->jabatan }}</span>
                        <h3 class="card-name">{{ $p->nama }}</h3>
                        <p class="card-desc">{{ $deskripsi[$p->jabatan] ?? 'Menjalankan tugas seksi.' }}</p>
                    </div>
                @endforeach
            </div>
            @endif

            {{-- ANGGOTA --}}
            <div class="trunk" style="background:#94a3b8;"></div>
            <div class="anggota-card">
                <div style="display:flex; align-items:center; justify-content:center; gap:12px; margin-bottom:6px;">
                    <svg width="28" height="28" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M13 6a3 3 0 11-6 0 3 3 0 016 0zM18 8a2 2 0 11-4 0 2 2 0 014 0zM14 15a4 4 0 00-8 0v3h8v-3zM6 8a2 2 0 11-4 0 2 2 0 014 0zM16 18v-3a5.972 5.972 0 00-.75-2.906A3.005 3.005 0 0119 15v3h-3zM4.75 12.094A5.973 5.973 0 004 15v3H1v-3a3 3 0 013.75-2.906z"/>
                    </svg>
                    <h3>ANGGOTA RT 01</h3>
                </div>
                <p>Seluruh warga RT 01 - Kampung Digital</p>
            </div>

            @if($penguruss->isEmpty())
            <div style="text-align:center; padding:60px 0; color:#9ca3af;">
                Belum ada data pengurus.
            </div>
            @endif
        </div>
    </section>

    <div class="footer">
        &copy; {{ date('Y') }} Kampung Digital OPBM RT 01 - Kota Jambi Bahagia
    </div>

</body>
</html>