<?php

namespace Database\Seeders;

use App\Models\Pengurus;
use Illuminate\Database\Seeder;

class PengurusSeeder extends Seeder
{
    public function run(): void
    {
        $data = [
            ['nama' => 'Bapak H. Ahmad Sutrisno', 'jabatan' => 'Ketua RT',          'no_hp' => '6281234500001', 'urutan' => 1],
            ['nama' => 'Bapak Budi Santoso',      'jabatan' => 'Wakil Ketua RT',    'no_hp' => '6281234500002', 'urutan' => 2],
            ['nama' => 'Ibu Sri Wahyuni',         'jabatan' => 'Sekretaris',         'no_hp' => '6281234500003', 'urutan' => 3],
            ['nama' => 'Ibu Ratna Dewi',          'jabatan' => 'Bendahara',          'no_hp' => '6281234500004', 'urutan' => 4],
            ['nama' => 'Bapak Yusuf',             'jabatan' => 'Seksi Kebersihan',   'no_hp' => '6281234500005', 'urutan' => 5],
            ['nama' => 'Bapak Suparman',          'jabatan' => 'Seksi Keamanan',     'no_hp' => '6281234500006', 'urutan' => 6],
            ['nama' => 'Bapak Andi Pratama',      'jabatan' => 'Seksi Pemuda',       'no_hp' => '6281234500007', 'urutan' => 7],
            ['nama' => 'Ibu Nurhayati',           'jabatan' => 'Seksi Sosial',       'no_hp' => '6281234500008', 'urutan' => 8],
        ];
        foreach ($data as $d) {
            Pengurus::create($d);
        }
    }
}