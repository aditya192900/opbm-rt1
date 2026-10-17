<?php

namespace App\Http\Controllers;

use App\Models\PendaftaranOpbm;
use App\Models\PembayaranOpbm;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PembayaranOpbmController extends Controller
{
    public function index(Request $request)
    {
        $bulan = (int) $request->input('bulan', now()->month);
        $tahun = (int) $request->input('tahun', now()->year);

        $wargas = PendaftaranOpbm::where('status', 'aktif')
            ->orderBy('zona')
            ->orderBy('nama_kepala_keluarga')
            ->get();

        $pembayarans = PembayaranOpbm::with(['rtConfirmer', 'bendaharaConfirmer', 'canceller'])
            ->where('bulan', $bulan)
            ->where('tahun', $tahun)
            ->where('status', 'lunas')
            ->get()
            ->keyBy('pendaftaran_opbm_id');

        $pembayaransBatal = PembayaranOpbm::with(['canceller'])
            ->where('bulan', $bulan)
            ->where('tahun', $tahun)
            ->where('status', 'batal')
            ->get()
            ->keyBy('pendaftaran_opbm_id');

        $pembayaransPending = PembayaranOpbm::with('pendaftaran')
            ->where('status', 'pending')
            ->latest()
            ->get();

        $data = $wargas->map(function ($w) use ($pembayarans) {
            $bayar = $pembayarans->get($w->id);
            return (object) [
                'warga' => $w,
                'sudah_bayar' => $bayar !== null,
                'pembayaran' => $bayar,
            ];
        });

        $totalWarga = $wargas->count();
        $sudahBayar = $data->where('sudah_bayar', true)->count();
        $belumBayar = $totalWarga - $sudahBayar;
        $totalTerkumpul = $sudahBayar * 50000;
        $totalTunggakan = $belumBayar * 50000;
        $totalAllTime = PembayaranOpbm::where('status', 'lunas')->sum('jumlah');

        $namaBulan = ['Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember'];

        return view('pembayaran.index', compact(
            'data', 'bulan', 'tahun', 'wargas', 'namaBulan',
            'totalWarga', 'sudahBayar', 'belumBayar',
            'totalTerkumpul', 'totalTunggakan', 'totalAllTime',
            'pembayaransBatal', 'pembayaransPending'
        ));
    }

    public function bayar(Request $request)
    {
        $request->validate([
            'pendaftaran_opbm_id' => 'required|exists:pendaftaran_opbms,id',
            'bulan' => 'required|integer|min:1|max:12',
            'tahun' => 'required|integer',
        ]);

        $user = Auth::user();
        $role = $user->role ?? 'rt';

        $record = PembayaranOpbm::firstOrNew([
            'pendaftaran_opbm_id' => $request->pendaftaran_opbm_id,
            'bulan' => $request->bulan,
            'tahun' => $request->tahun,
        ]);

        $record->jumlah = 50000;
        $record->status = 'lunas';
        $record->tanggal_bayar = now();
        $record->metode_bayar = 'cash';

        $record->cancelled_by = null;
        $record->cancelled_role = null;
        $record->cancelled_at = null;

        if ($role === 'bendahara') {
            $record->bendahara_confirmed_by = $user->id;
            $record->bendahara_confirmed_at = now();
        } else {
            $record->rt_confirmed_by = $user->id;
            $record->rt_confirmed_at = now();
        }

        $record->save();

        $label = $role === 'bendahara' ? 'Bendahara' : 'RT';
        return back()->with('success', "Pembayaran Cash dikonfirmasi oleh {$label}!");
    }

    public function validasiQris(Request $request, $id)
    {
        $pembayaran = PembayaranOpbm::findOrFail($id);
        
        $user = Auth::user();
        $role = $user->role ?? 'rt';

        $pembayaran->status = 'lunas';
        $pembayaran->tanggal_bayar = now();

        if ($role === 'bendahara') {
            $pembayaran->bendahara_confirmed_by = $user->id;
            $pembayaran->bendahara_confirmed_at = now();
        } else {
            $pembayaran->rt_confirmed_by = $user->id;
            $pembayaran->rt_confirmed_at = now();
        }

        $pembayaran->save();

        return back()->with('success', 'Pembayaran QRIS berhasil divalidasi menjadi LUNAS!');
    }

    public function batal(Request $request)
    {
        $request->validate([
            'pendaftaran_opbm_id' => 'required|exists:pendaftaran_opbms,id',
            'bulan' => 'required|integer|min:1|max:12',
            'tahun' => 'required|integer',
        ]);

        $user = Auth::user();
        $role = $user->role ?? 'rt';

        $record = PembayaranOpbm::where('pendaftaran_opbm_id', $request->pendaftaran_opbm_id)
            ->where('bulan', $request->bulan)
            ->where('tahun', $request->tahun)
            ->first();

        if ($record) {
            $record->update([
                'status' => 'batal',
                'cancelled_by' => $user->id,
                'cancelled_role' => $role,
                'cancelled_at' => now(),
                'rt_confirmed_by' => null,
                'rt_confirmed_at' => null,
                'bendahara_confirmed_by' => null,
                'bendahara_confirmed_at' => null,
            ]);
        }

        $label = $role === 'bendahara' ? 'Bendahara' : 'RT';
        return back()->with('success', "Pembayaran dibatalkan oleh {$label}!");
    }

    public function exportExcel(Request $request)
    {
        $bulan = (int) $request->input('bulan', now()->month);
        $tahun = (int) $request->input('tahun', now()->year);
        $namaBulan = ['Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember'];

        $wargas = PendaftaranOpbm::where('status', 'aktif')
            ->orderBy('zona')
            ->orderBy('nama_kepala_keluarga')
            ->get();

        $pembayarans = PembayaranOpbm::with(['rtConfirmer', 'bendaharaConfirmer'])
            ->where('bulan', $bulan)
            ->where('tahun', $tahun)
            ->where('status', 'lunas')
            ->get()
            ->keyBy('pendaftaran_opbm_id');

        $filename = 'Iuran_OPBM_' . $namaBulan[$bulan - 1] . '_' . $tahun . '.xls';

        $html = '<html xmlns:x="urn:schemas-microsoft-com:office:excel">';
        $html .= '<head><meta charset="UTF-8">';
        $html .= '<style>
            body { font-family: Calibri, sans-serif; }
            table { border-collapse: collapse; }
            td, th { border: 1px solid #999; padding: 6px 10px; font-size: 11pt; vertical-align: middle; }
            .title { font-weight: bold; font-size: 14pt; color: #047857; }
            .header { background: #047857; color: white; font-weight: bold; text-align: center; }
            .lunas { background: #d1fae5; color: #047857; font-weight: bold; text-align: center; }
            .belum { background: #fee2e2; color: #b91c1c; font-weight: bold; text-align: center; }
            .total-row { background: #ecfdf5; font-weight: bold; }
            .center { text-align: center; }
            .right { text-align: right; }
            .text-format { mso-number-format:"\@"; }
        </style></head><body>';

        $html .= '<table>';
        $html .= '<tr><td colspan="8" class="title">LAPORAN IURAN OPBM RT 01</td></tr>';
        $html .= '<tr><td colspan="8">Periode: ' . $namaBulan[$bulan - 1] . ' ' . $tahun . '</td></tr>';
        $html .= '<tr><td colspan="8">Iuran: Rp 50.000 / bulan</td></tr>';
        $html .= '<tr><td colspan="8"></td></tr>';

        $html .= '<tr>';
        $html .= '<th class="header" width="40">No</th>';
        $html .= '<th class="header" width="200">Nama Kepala Keluarga</th>';
        $html .= '<th class="header" width="80">Blok</th>';
        $html .= '<th class="header" width="160">No HP</th>';
        $html .= '<th class="header" width="120">Status</th>';
        $html .= '<th class="header" width="140">Dikonfirmasi Oleh</th>';
        $html .= '<th class="header" width="120">Tanggal Bayar</th>';
        $html .= '<th class="header" width="120">Jumlah</th>';
        $html .= '</tr>';

        $no = 1;
        $totalTerkumpul = 0;
        foreach ($wargas as $w) {
            $bayar = $pembayarans->get($w->id);
            $sudah = $bayar !== null;
            if ($sudah) $totalTerkumpul += 50000;

            $konfirmasi = '-';
            if ($sudah) {
                $konf = [];
                if ($bayar->rt_confirmed_by) $konf[] = 'RT: ' . ($bayar->rtConfirmer->name ?? '-');
                if ($bayar->bendahara_confirmed_by) $konf[] = 'Bendahara: ' . ($bayar->bendaharaConfirmer->name ?? '-');
                $konfirmasi = implode(' | ', $konf);
            }

            $html .= '<tr>';
            $html .= '<td class="center">' . $no++ . '</td>';
            $html .= '<td>' . htmlspecialchars($w->nama_kepala_keluarga) . '</td>';
            $html .= '<td class="center">' . htmlspecialchars($w->zona) . '</td>';
            $html .= '<td class="text-format">' . htmlspecialchars($w->no_hp) . '</td>';
            $html .= '<td class="' . ($sudah ? 'lunas' : 'belum') . '">' . ($sudah ? 'LUNAS' : 'BELUM BAYAR') . '</td>';
            $html .= '<td>' . htmlspecialchars($konfirmasi) . '</td>';
            $html .= '<td class="center">' . ($sudah && $bayar->tanggal_bayar ? \Carbon\Carbon::parse($bayar->tanggal_bayar)->format('d/m/Y') : '-') . '</td>';
            $html .= '<td class="right">' . ($sudah ? 'Rp 50.000' : '-') . '</td>';
            $html .= '</tr>';
        }

        $html .= '<tr><td colspan="8"></td></tr>';
        $html .= '<tr class="total-row"><td colspan="7" class="right">TOTAL TERKUMPUL</td><td class="right">Rp ' . number_format($totalTerkumpul, 0, ',', '.') . '</td></tr>';
        $html .= '<tr class="total-row"><td colspan="7" class="right">TOTAL WARGA</td><td class="right">' . $wargas->count() . ' KK</td></tr>';
        $html .= '<tr class="total-row"><td colspan="7" class="right">SUDAH BAYAR</td><td class="right">' . $pembayarans->count() . ' KK</td></tr>';
        $html .= '<tr class="total-row"><td colspan="7" class="right">BELUM BAYAR</td><td class="right">' . ($wargas->count() - $pembayarans->count()) . ' KK</td></tr>';
        $html .= '<tr><td colspan="8"></td></tr>';
        $html .= '<tr><td colspan="8">Dicetak pada: ' . now()->format('d/m/Y H:i') . '</td></tr>';
        $html .= '</table></body></html>';

        return response($html, 200, [
            'Content-Type' => 'application/vnd.ms-excel; charset=UTF-8',
            'Content-Disposition' => 'attachment; filename="' . $filename . '"',
            'Cache-Control' => 'max-age=0',
        ]);
    }

    public function exportPdf(Request $request)
    {
        $bulan = (int) $request->input('bulan', now()->month);
        $tahun = (int) $request->input('tahun', now()->year);
        $namaBulan = ['Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember'];

        $wargas = PendaftaranOpbm::where('status', 'aktif')
            ->orderBy('zona')
            ->orderBy('nama_kepala_keluarga')
            ->get();

        $pembayarans = PembayaranOpbm::with(['rtConfirmer', 'bendaharaConfirmer'])
            ->where('bulan', $bulan)
            ->where('tahun', $tahun)
            ->where('status', 'lunas')
            ->get()
            ->keyBy('pendaftaran_opbm_id');

        $data = $wargas->map(function ($w) use ($pembayarans) {
            $bayar = $pembayarans->get($w->id);
            return (object) [
                'warga' => $w,
                'sudah_bayar' => $bayar !== null,
                'pembayaran' => $bayar,
            ];
        });

        $totalWarga = $wargas->count();
        $sudahBayar = $data->where('sudah_bayar', true)->count();
        $belumBayar = $totalWarga - $sudahBayar;
        $totalTerkumpul = $sudahBayar * 50000;

        return view('pembayaran.pdf', compact(
            'data', 'bulan', 'tahun', 'namaBulan',
            'totalWarga', 'sudahBayar', 'belumBayar', 'totalTerkumpul'
        ));
    }
}