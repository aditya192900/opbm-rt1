<?php

namespace Database\Seeders;

use App\Models\JadwalPenjemputan;
use Illuminate\Database\Seeder;

class JadwalBaruSeeder extends Seeder
{
    public function run(): void
    {
        // Hapus data jadwal lama
        JadwalPenjemputan::truncate();

        // Data jadwal baru: Senin-Minggu jam 08:00
        $hari = ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu'];
        foreach ($hari as $h) {
            JadwalPenjemputan::create([
                'hari' => $h,
                'jam_mulai' => '08:00',
                'jam_selesai' => '10:00',
                'zona' => 'RT 01',
                'keterangan' => 'Depan portal masuk',
            ]);
        }
    }
}