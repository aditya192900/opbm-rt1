<?php

namespace Database\Seeders;

use App\Models\LaporanWarga;
use App\Models\User;
use Illuminate\Database\Seeder;

class LaporanSeeder extends Seeder
{
    public function run(): void
    {
        $user = User::first();
        if (!$user) return;

        $data = [
            ['judul' => 'Sampah menumpuk di depan gang', 'deskripsi' => 'Sampah sudah 2 hari tidak diangkut di depan gang masuk RT 01A.', 'lokasi' => 'Depan gang RT 01A', 'status' => 'pending'],
            ['judul' => 'Bentor OPBM tidak lewat',       'deskripsi' => 'Hari ini bentor tidak lewat di zona RT 01B padahal sesuai jadwal.', 'lokasi' => 'RT 01B', 'status' => 'diproses'],
            ['judul' => 'TPS liar di ujung jalan',       'deskripsi' => 'Ada warga luar RT yang buang sampah di ujung jalan.', 'lokasi' => 'Ujung Jl. Sudirman', 'status' => 'pending'],
            ['judul' => 'Sampah organik belum dipilah',  'deskripsi' => 'Masih ada warga yang campur sampah organik dan anorganik.', 'lokasi' => 'RT 01C', 'status' => 'selesai'],
        ];
        foreach ($data as $d) {
            LaporanWarga::create(array_merge($d, ['user_id' => $user->id]));
        }
    }
}