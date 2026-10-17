<?php

namespace App\Http\Controllers;

use App\Models\JadwalPenjemputan;
use App\Models\PendaftaranOpbm;
use App\Models\LaporanWarga;
use App\Models\UmkmWarga;
use App\Models\PembayaranOpbm;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        // Bendahara langsung diarahkan ke halaman pembayaran
        if (Auth::user()->role === 'bendahara') {
            return redirect()->route('pembayaran.index');
        }

        $totalJadwal = JadwalPenjemputan::count();
        $totalPendaftar = PendaftaranOpbm::count();
        $totalPendaftarAktif = PendaftaranOpbm::where('status', 'aktif')->count();
        $totalLaporan = LaporanWarga::count();
        $totalLaporanPending = LaporanWarga::where('status', 'pending')->count();
        $totalUmkm = UmkmWarga::count();

        // Statistik pembayaran bulan ini
        $bulanIni = now()->month;
        $tahunIni = now()->year;
        $totalBayarBulanIni = PembayaranOpbm::where('bulan', $bulanIni)
            ->where('tahun', $tahunIni)
            ->where('status', 'lunas')
            ->count();
        $totalTunggakanBulanIni = $totalPendaftarAktif - $totalBayarBulanIni;
        $totalKasBulanIni = $totalBayarBulanIni * 50000;

        $laporanTerbaru = LaporanWarga::with('user')->latest()->limit(5)->get();
        $pendaftarTerbaru = PendaftaranOpbm::latest()->limit(5)->get();

        return view('dashboard', compact(
            'totalJadwal',
            'totalPendaftar',
            'totalPendaftarAktif',
            'totalLaporan',
            'totalLaporanPending',
            'totalUmkm',
            'totalBayarBulanIni',
            'totalTunggakanBulanIni',
            'totalKasBulanIni',
            'laporanTerbaru',
            'pendaftarTerbaru'
        ));
    }
}