<?php

namespace App\Http\Controllers;

use App\Models\Dokumentasi;
use App\Models\JadwalPenjemputan;
use App\Models\PendaftaranOpbm;
use App\Models\PembayaranOpbm;
use App\Models\Pengurus;
use App\Models\UmkmWarga;
use Illuminate\Http\Request;

class PublicController extends Controller
{
    public function home()
    {
        $jadwals = JadwalPenjemputan::orderBy('hari')->limit(6)->get();
        $umkms = UmkmWarga::latest()->limit(3)->get();
        $dokumentasis = Dokumentasi::latest('tanggal_kegiatan')->limit(3)->get();

        return view('public.home', compact('jadwals', 'umkms', 'dokumentasis'));
    }

    public function profilRt()
    {
        return view('public.profil');
    }

    public function programOpbm()
    {
        $jadwals = JadwalPenjemputan::orderBy('hari')->get();
        return view('public.program-opbm', compact('jadwals'));
    }

    public function umkmIndex()
    {
        $umkms = UmkmWarga::latest()->paginate(12);
        return view('public.umkm', compact('umkms'));
    }

    public function umkmShow(UmkmWarga $umkm)
    {
        return view('public.umkm-show', compact('umkm'));
    }

    public function dokumentasiIndex()
    {
        $dokumentasis = Dokumentasi::latest('tanggal_kegiatan')->paginate(9);
        return view('public.dokumentasi', compact('dokumentasis'));
    }

    public function dokumentasiShow(Dokumentasi $dokumentasi)
    {
        return view('public.dokumentasi-show', compact('dokumentasi'));
    }

    public function strukturPengurus()
    {
        $penguruss = Pengurus::orderBy('urutan')->orderBy('id')->get();
        return view('public.struktur', compact('penguruss'));
    }

    public function wargaOpbm()
    {
        $totalAktif = PendaftaranOpbm::where('status', 'aktif')->count();
        $totalPending = PendaftaranOpbm::where('status', 'pending')->count();
        $pendaftars = PendaftaranOpbm::where('status', 'aktif')
                        ->orderBy('zona')
                        ->orderBy('nama_kepala_keluarga')
                        ->paginate(20);

        return view('public.warga-opbm', compact('pendaftars', 'totalAktif', 'totalPending'));
    }

    public function daftarOpbmForm()
    {
        return view('public.daftar-opbm');
    }

    public function daftarOpbmStore(Request $request)
    {
        $request->validate([
            'nama_kepala_keluarga' => 'required|string|max:255',
            'no_hp' => 'required|string|max:20',
            'alamat' => 'required|string',
            'zona' => 'required|string',
        ], [
            'nama_kepala_keluarga.required' => 'Nama kepala keluarga wajib diisi.',
            'no_hp.required' => 'Nomor WhatsApp wajib diisi.',
            'alamat.required' => 'Alamat wajib diisi.',
            'zona.required' => 'Blok wajib diisi.',
        ]);

        $pendaftaran = PendaftaranOpbm::create([
            'user_id' => null,
            'nama_kepala_keluarga' => $request->nama_kepala_keluarga,
            'nik' => null,
            'no_hp' => $request->no_hp,
            'alamat' => $request->alamat,
            'zona' => $request->zona,
            'status' => 'pending',
        ]);

        return redirect()->route('daftar.opbm.sukses', ['id' => $pendaftaran->id]);
    }

    public function daftarOpbmSukses(Request $request)
    {
        $pendaftar = null;

        if ($request->has('id')) {
            $p = PendaftaranOpbm::find($request->id);
            if ($p) {
                $pendaftar = [
                    'nama' => $p->nama_kepala_keluarga,
                    'hp' => $p->no_hp,
                    'alamat' => $p->alamat,
                    'zona' => $p->zona,
                    'waktu' => $p->created_at->format('d M Y, H:i'),
                ];
            }
        }

        return view('public.daftar-opbm-sukses', compact('pendaftar'));
    }

    // ============ CEK IURAN & LAPOR QRIS ============
    public function cekIuranForm()
    {
        return view('public.cek-iuran');
    }

    public function cekIuranProses(Request $request)
    {
        $request->validate([
            'no_hp' => 'required|string'
        ]);

        $warga = PendaftaranOpbm::where('no_hp', 'like', '%' . $request->no_hp . '%')->first();

        if (!$warga) {
            return back()->with('error', 'Data tidak ditemukan. Pastikan Nomor WhatsApp sesuai dengan yang didaftarkan.');
        }

        $pembayarans = PembayaranOpbm::where('pendaftaran_opbm_id', $warga->id)
                        ->orderBy('tahun', 'desc')
                        ->orderBy('bulan', 'desc')
                        ->get();

        return view('public.cek-iuran', compact('warga', 'pembayarans'));
    }

    public function bayarIuranForm()
    {
        $bulanSekarang = now()->month;
        $tahunSekarang = now()->year;
        
        return view('public.bayar-iuran', compact('bulanSekarang', 'tahunSekarang'));
    }

    public function laporQris(Request $request)
    {
        $request->validate([
            'no_hp' => 'required',
            'bulan' => 'required',
            'tahun' => 'required',
            'bukti_bayar' => 'required|image|max:2048',
        ]);

        $warga = PendaftaranOpbm::where('no_hp', 'like', '%' . $request->no_hp . '%')->first();

        if (!$warga) {
            return back()->with('error', 'Nomor HP tidak terdaftar.');
        }

        $data = [
            'status' => 'pending',
            'metode_bayar' => 'qris',
            'jumlah_bayar' => 50000,
            'tanggal_bayar' => now(),
        ];

        // PROSES UPLOAD FILE GAMBAR
        if ($request->hasFile('bukti_bayar')) {
            $data['bukti_bayar'] = $request->file('bukti_bayar')->store('bukti_qris', 'public');
        }

        PembayaranOpbm::updateOrCreate(
            [
                'pendaftaran_opbm_id' => $warga->id,
                'bulan' => $request->bulan,
                'tahun' => $request->tahun,
            ],
            $data
        );

        return back()->with('success', 'Laporan pembayaran QRIS berhasil dikirim! Menunggu validasi Bendahara.');
    }
}