<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\JadwalPenjemputanController;
use App\Http\Controllers\PendaftaranOpbmController;
use App\Http\Controllers\PembayaranOpbmController;
use App\Http\Controllers\LaporanWargaController;
use App\Http\Controllers\UmkmWargaController;
use App\Http\Controllers\MenuUmkmController;
use App\Http\Controllers\DokumentasiController;
use App\Http\Controllers\PengurusController;
use App\Http\Controllers\UserManagementController;
use App\Http\Controllers\PublicController;
use Illuminate\Support\Facades\Route;

// ============ HALAMAN PUBLIK ============
Route::get('/', [PublicController::class, 'home'])->name('home');
Route::get('/profil-rt', [PublicController::class, 'profilRt'])->name('profil.rt');
Route::get('/program-opbm', [PublicController::class, 'programOpbm'])->name('program.opbm');
Route::get('/daftar-opbm', [PublicController::class, 'daftarOpbmForm'])->name('daftar.opbm');
Route::post('/daftar-opbm', [PublicController::class, 'daftarOpbmStore'])->name('daftar.opbm.store');
Route::get('/daftar-opbm/sukses', [PublicController::class, 'daftarOpbmSukses'])->name('daftar.opbm.sukses');
Route::get('/umkm-publik', [PublicController::class, 'umkmIndex'])->name('umkm.publik');
Route::get('/umkm-publik/{umkm}', [PublicController::class, 'umkmShow'])->name('umkm.publik.show');
Route::get('/dokumentasi-publik', [PublicController::class, 'dokumentasiIndex'])->name('dokumentasi.publik');
Route::get('/dokumentasi-publik/{dokumentasi}', [PublicController::class, 'dokumentasiShow'])->name('dokumentasi.publik.show');
Route::get('/warga-opbm', [PublicController::class, 'wargaOpbm'])->name('warga.opbm');
Route::get('/struktur-pengurus', [PublicController::class, 'strukturPengurus'])->name('struktur.publik');

// ============ CEK IURAN & BAYAR QRIS (PUBLIK) ============
Route::get('/cek-iuran', [PublicController::class, 'cekIuranForm'])->name('cek.iuran');
Route::post('/cek-iuran/proses', [PublicController::class, 'cekIuranProses'])->name('cek.iuran.proses');
Route::get('/bayar-iuran', [PublicController::class, 'bayarIuranForm'])->name('bayar.iuran');
Route::post('/lapor-qris', [PublicController::class, 'laporQris'])->name('lapor.qris');

// ============ CAPTCHA REFRESH ============
Route::get('/captcha/refresh', function () {
    $num1 = rand(1, 9);
    $num2 = rand(1, 9);
    $operators = ['+', '-', '×'];
    $op = $operators[array_rand($operators)];

    switch ($op) {
        case '+': $answer = $num1 + $num2; break;
        case '-':
            if ($num1 < $num2) [$num1, $num2] = [$num2, $num1];
            $answer = $num1 - $num2;
            break;
        case '×': $answer = $num1 * $num2; break;
    }

    session(['captcha_answer' => $answer]);
    session(['captcha_question' => "$num1 $op $num2"]);

    return response()->json(['question' => "$num1 $op $num2"]);
})->name('captcha.refresh');

// ============ SETELAH LOGIN ============
Route::middleware('auth')->group(function () {

    // ====== AKSES SEMUA ROLE (RT, Bendahara, Super Admin) ======
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/pembayaran', [PembayaranOpbmController::class, 'index'])->name('pembayaran.index');
    Route::post('/pembayaran/bayar', [PembayaranOpbmController::class, 'bayar'])->name('pembayaran.bayar');
    Route::post('/pembayaran/batal', [PembayaranOpbmController::class, 'batal'])->name('pembayaran.batal');
    Route::post('/pembayaran/validasi-qris/{id}', [PembayaranOpbmController::class, 'validasiQris'])->name('pembayaran.validasi.qris');
    Route::get('/pembayaran/export-excel', [PembayaranOpbmController::class, 'exportExcel'])->name('pembayaran.export.excel');
    Route::get('/pembayaran/export-pdf', [PembayaranOpbmController::class, 'exportPdf'])->name('pembayaran.export.pdf');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::post('/profile/password', [ProfileController::class, 'updatePassword'])->name('profile.password');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // ====== HANYA RT & SUPER ADMIN ======
    Route::middleware('rt.only')->group(function () {

        // Kelola Akun
        Route::get('/kelola-akun', [UserManagementController::class, 'index'])->name('kelola.akun.index');
        Route::post('/kelola-akun', [UserManagementController::class, 'store'])->name('kelola.akun.store');
        Route::post('/kelola-akun/{user}/reset-password', [UserManagementController::class, 'resetPassword'])->name('kelola.akun.reset');
        Route::delete('/kelola-akun/{user}', [UserManagementController::class, 'destroy'])->name('kelola.akun.destroy');

        // CRUD lainnya
        Route::resource('jadwal', JadwalPenjemputanController::class);
        Route::resource('pendaftaran', PendaftaranOpbmController::class);
        Route::resource('laporan', LaporanWargaController::class);
        Route::resource('dokumentasi', DokumentasiController::class);
        Route::resource('pengurus', PengurusController::class)->parameters([
            'pengurus' => 'pengurus'
        ]);
        Route::resource('umkm', UmkmWargaController::class);
        Route::resource('umkm.menu', MenuUmkmController::class);
    });
});

require __DIR__.'/auth.php';