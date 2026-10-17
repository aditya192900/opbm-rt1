<?php

namespace Database\Seeders;

use App\Models\Dokumentasi;
use Illuminate\Database\Seeder;

class DokumentasiSeeder extends Seeder
{
    public function run(): void
    {
        $data = [
            ['judul' => 'Sosialisasi Program OPBM',   'deskripsi' => 'Sosialisasi program OPBM kepada warga RT 01 bersama perangkat kelurahan dan dinas terkait.', 'tanggal_kegiatan' => '2026-09-15', 'lokasi' => 'Balai RT 01'],
            ['judul' => 'Kerja Bakti Bersih Kampung', 'deskripsi' => 'Kegiatan kerja bakti rutin bulanan bersama seluruh warga untuk menjaga kebersihan lingkungan.', 'tanggal_kegiatan' => '2026-09-22', 'lokasi' => 'Lingkungan RT 01'],
            ['judul' => 'Peluncuran Kampung Digital', 'deskripsi' => 'Peluncuran website Kampung Digital RT 01 oleh Pak Lurah dan Wali Kota Jambi.', 'tanggal_kegiatan' => '2026-10-01', 'lokasi' => 'Balai RT 01'],
            ['judul' => 'Pelatihan Pemilahan Sampah', 'deskripsi' => 'Pelatihan pemilahan sampah organik, anorganik, dan B3 kepada warga RT 01.', 'tanggal_kegiatan' => '2026-10-08', 'lokasi' => 'Balai RT 01'],
        ];
        foreach ($data as $d) {
            Dokumentasi::create($d);
        }
    }
}