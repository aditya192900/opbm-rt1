<?php

namespace Database\Seeders;

use App\Models\PendaftaranOpbm;
use App\Models\User;
use Illuminate\Database\Seeder;

class PendaftaranSeeder extends Seeder
{
    public function run(): void
    {
        $user = User::first();
        if (!$user) return;

        $data = [
            ['nama_kepala_keluarga' => 'Bapak Sutrisno',  'nik' => '1571010101010001', 'no_hp' => '6281234500001', 'alamat' => 'Jl. Merdeka No. 5', 'zona' => 'RT 01A', 'status' => 'aktif'],
            ['nama_kepala_keluarga' => 'Ibu Siti Aminah', 'nik' => '1571010101010002', 'no_hp' => '6281234500002', 'alamat' => 'Jl. Merdeka No. 7', 'zona' => 'RT 01A', 'status' => 'aktif'],
            ['nama_kepala_keluarga' => 'Bapak Hadi',      'nik' => '1571010101010003', 'no_hp' => '6281234500003', 'alamat' => 'Jl. Sudirman No. 12', 'zona' => 'RT 01B', 'status' => 'aktif'],
            ['nama_kepala_keluarga' => 'Ibu Ratna',       'nik' => '1571010101010004', 'no_hp' => '6281234500004', 'alamat' => 'Jl. Sudirman No. 15', 'zona' => 'RT 01B', 'status' => 'pending'],
            ['nama_kepala_keluarga' => 'Bapak Yusuf',     'nik' => '1571010101010005', 'no_hp' => '6281234500005', 'alamat' => 'Jl. Ahmad Yani No. 3', 'zona' => 'RT 01C', 'status' => 'aktif'],
        ];
        foreach ($data as $d) {
            PendaftaranOpbm::create(array_merge($d, ['user_id' => $user->id]));
        }
    }
}