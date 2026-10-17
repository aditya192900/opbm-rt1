<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Iuran OPBM - {{ $namaBulan[$bulan - 1] }} {{ $tahun }}</title>
    <style>
        * { box-sizing: border-box; margin: 0; padding: 0; }
        body {
            font-family: 'Segoe UI', Tahoma, sans-serif;
            color: #1f2937;
            padding: 40px;
            background: white;
        }

        /* HEADER */
        .header {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            border-bottom: 3px solid #047857;
            padding-bottom: 20px;
            margin-bottom: 24px;
        }
        .header-left {
            display: flex;
            align-items: center;
            gap: 16px;
        }
        .logo {
            width: 60px;
            height: 60px;
            background: #047857;
            color: white;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 800;
            font-size: 20px;
        }
        .header-title h1 {
            font-size: 20px;
            font-weight: 800;
            color: #1f2937;
            margin-bottom: 2px;
        }
        .header-title p {
            font-size: 12px;
            color: #6b7280;
        }
        .header-right {
            text-align: right;
            font-size: 12px;
            color: #6b7280;
        }
        .header-right strong {
            color: #1f2937;
        }

        /* TITLE */
        .report-title {
            text-align: center;
            margin-bottom: 20px;
        }
        .report-title h2 {
            font-size: 18px;
            font-weight: 800;
            color: #047857;
            text-transform: uppercase;
            letter-spacing: 0.05em;
        }
        .report-title p {
            font-size: 13px;
            color: #6b7280;
            margin-top: 4px;
        }

        /* STATISTIK */
        .stats {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 12px;
            margin-bottom: 20px;
        }
        .stat-box {
            border: 1px solid #e5e7eb;
            border-radius: 12px;
            padding: 12px;
            text-align: center;
        }
        .stat-label {
            font-size: 10px;
            color: #6b7280;
            text-transform: uppercase;
            font-weight: 600;
            letter-spacing: 0.05em;
        }
        .stat-value {
            font-size: 22px;
            font-weight: 800;
            margin-top: 4px;
        }
        .stat-value.blue { color: #3b82f6; }
        .stat-value.green { color: #10b981; }
        .stat-value.red { color: #ef4444; }
        .stat-value.yellow { color: #f59e0b; font-size: 16px; }

        /* TABEL */
        table {
            width: 100%;
            border-collapse: collapse;
            font-size: 12px;
            margin-bottom: 20px;
        }
        thead {
            background: #047857;
            color: white;
        }
        thead th {
            padding: 10px 8px;
            text-align: left;
            font-weight: 700;
            text-transform: uppercase;
            font-size: 10px;
            letter-spacing: 0.05em;
        }
        thead th.center { text-align: center; }
        tbody tr:nth-child(even) { background: #f9fafb; }
        tbody td {
            padding: 8px;
            border-bottom: 1px solid #e5e7eb;
        }
        tbody td.center { text-align: center; }

        .badge {
            display: inline-block;
            padding: 3px 10px;
            border-radius: 9999px;
            font-size: 10px;
            font-weight: 800;
            text-transform: uppercase;
        }
        .badge-lunas {
            background: #d1fae5;
            color: #047857;
        }
        .badge-belum {
            background: #fee2e2;
            color: #b91c1c;
        }

        /* RINGKASAN */
        .summary {
            display: flex;
            justify-content: flex-end;
            margin-top: 10px;
        }
        .summary-box {
            border: 2px solid #047857;
            border-radius: 12px;
            padding: 16px 24px;
            min-width: 300px;
        }
        .summary-row {
            display: flex;
            justify-content: space-between;
            padding: 6px 0;
            font-size: 13px;
        }
        .summary-row.total {
            border-top: 2px solid #047857;
            margin-top: 8px;
            padding-top: 10px;
            font-size: 16px;
            font-weight: 800;
            color: #047857;
        }

        /* FOOTER */
        .footer {
            margin-top: 40px;
            padding-top: 20px;
            border-top: 1px solid #e5e7eb;
            display: flex;
            justify-content: space-between;
            align-items: flex-end;
            font-size: 11px;
            color: #6b7280;
        }
        .ttd {
            text-align: center;
        }
        .ttd-space {
            height: 60px;
        }
        .ttd-name {
            font-weight: 700;
            color: #1f2937;
            border-top: 1px solid #1f2937;
            padding-top: 4px;
            margin-top: 4px;
        }

        /* PRINT BUTTON (hanya muncul di layar) */
        .print-bar {
            position: fixed;
            top: 20px;
            right: 20px;
            z-index: 999;
            display: flex;
            gap: 10px;
        }
        .btn {
            padding: 12px 20px;
            border-radius: 12px;
            font-weight: 700;
            font-size: 14px;
            border: none;
            cursor: pointer;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            transition: all 0.2s;
            box-shadow: 0 4px 12px rgba(0,0,0,0.15);
        }
        .btn-print {
            background: #047857;
            color: white;
        }
        .btn-print:hover { background: #065f46; }
        .btn-back {
            background: #6b7280;
            color: white;
        }
        .btn-back:hover { background: #4b5563; }

        @media print {
            body { padding: 20px; }
            .print-bar { display: none; }
            thead { background: #047857 !important; -webkit-print-color-adjust: exact; print-color-adjust: exact; }
            .badge-lunas { background: #d1fae5 !important; -webkit-print-color-adjust: exact; print-color-adjust: exact; }
            .badge-belum { background: #fee2e2 !important; -webkit-print-color-adjust: exact; print-color-adjust: exact; }
        }
    </style>
</head>
<body>

    {{-- TOMBOL PRINT (tidak tercetak) --}}
    <div class="print-bar">
        <a href="{{ route('pembayaran.index', ['bulan' => $bulan, 'tahun' => $tahun]) }}" class="btn btn-back">
            ← Kembali
        </a>
        <button onclick="window.print()" class="btn btn-print">
            🖨️ Cetak / Simpan PDF
        </button>
    </div>

    {{-- HEADER --}}
    <div class="header">
        <div class="header-left">
            <div class="logo">RT</div>
            <div class="header-title">
                <h1>KAMPUNG DIGITAL OPBM RT 01</h1>
                <p>Kel. Jambi · Kec. Kota Baru · Kota Jambi</p>
            </div>
        </div>
        <div class="header-right">
            <p>Dicetak: <strong>{{ now()->format('d/m/Y H:i') }}</strong></p>
            <p>Oleh: <strong>{{ Auth::user()->name ?? '-' }}</strong></p>
        </div>
    </div>

    {{-- TITLE --}}
    <div class="report-title">
        <h2>Laporan Iuran Bulanan OPBM</h2>
        <p>Periode: <strong>{{ $namaBulan[$bulan - 1] }} {{ $tahun }}</strong> · Iuran: <strong>Rp 50.000/bulan</strong></p>
    </div>

    {{-- STATISTIK --}}
    <div class="stats">
        <div class="stat-box">
            <div class="stat-label">Total Warga</div>
            <div class="stat-value blue">{{ $totalWarga }}</div>
        </div>
        <div class="stat-box">
            <div class="stat-label">Sudah Bayar</div>
            <div class="stat-value green">{{ $sudahBayar }}</div>
        </div>
        <div class="stat-box">
            <div class="stat-label">Belum Bayar</div>
            <div class="stat-value red">{{ $belumBayar }}</div>
        </div>
        <div class="stat-box">
            <div class="stat-label">Terkumpul</div>
            <div class="stat-value yellow">Rp {{ number_format($totalTerkumpul, 0, ',', '.') }}</div>
        </div>
    </div>

    {{-- TABEL --}}
    <table>
        <thead>
            <tr>
                <th style="width: 40px;">No</th>
                <th>Nama Kepala Keluarga</th>
                <th style="width: 80px;">Blok</th>
                <th style="width: 110px;">No HP</th>
                <th style="width: 120px;" class="center">Status</th>
                <th style="width: 100px;">Tgl Bayar</th>
                <th style="width: 100px; text-align: right;">Jumlah</th>
            </tr>
        </thead>
        <tbody>
            @foreach($data as $i => $d)
            <tr>
                <td>{{ $i + 1 }}</td>
                <td><strong>{{ $d->warga->nama_kepala_keluarga }}</strong></td>
                <td>{{ $d->warga->zona }}</td>
                <td>{{ $d->warga->no_hp }}</td>
                <td class="center">
                    @if($d->sudah_bayar)
                        <span class="badge badge-lunas">✓ LUNAS</span>
                    @else
                        <span class="badge badge-belum">✗ BELUM BAYAR</span>
                    @endif
                </td>
                <td>
                    @if($d->sudah_bayar && $d->pembayaran->tanggal_bayar)
                        {{ \Carbon\Carbon::parse($d->pembayaran->tanggal_bayar)->format('d/m/Y') }}
                    @else
                        -
                    @endif
                </td>
                <td style="text-align: right;">
                    @if($d->sudah_bayar)
                        Rp 50.000
                    @else
                        -
                    @endif
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    {{-- RINGKASAN --}}
    <div class="summary">
        <div class="summary-box">
            <div class="summary-row">
                <span>Total Warga</span>
                <strong>{{ $totalWarga }} KK</strong>
            </div>
            <div class="summary-row">
                <span>Sudah Bayar</span>
                <strong style="color: #10b981;">{{ $sudahBayar }} KK</strong>
            </div>
            <div class="summary-row">
                <span>Belum Bayar</span>
                <strong style="color: #ef4444;">{{ $belumBayar }} KK</strong>
            </div>
            <div class="summary-row total">
                <span>Total Terkumpul</span>
                <span>Rp {{ number_format($totalTerkumpul, 0, ',', '.') }}</span>
            </div>
        </div>
    </div>

    {{-- FOOTER / TANDA TANGAN --}}
    <div class="footer">
        <div>
            <p>Dokumen ini digenerate otomatis oleh</p>
            <p><strong>Sistem Kampung Digital OPBM RT 01</strong></p>
        </div>
        <div class="ttd">
            <p>Jambi, {{ now()->format('d F Y') }}</p>
            <p>Ketua RT 01</p>
            <div class="ttd-space"></div>
            <p class="ttd-name">Bapak H. Ahmad Sutrisno</p>
        </div>
    </div>

</body>
</html>