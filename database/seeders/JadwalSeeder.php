<?php

namespace Database\Seeders;

use App\Models\JadwalPenjemputan;
use Illuminate\Database\Seeder;

class JadwalSeeder extends Seeder
{
    public function run(): void
    {
        $data = [
            ['hari' => 'Senin',  'jam_mulai' => '07:00', 'jam_selesai' => '10:00', 'zona' => 'RT 01A', 'keterangan' => 'Zona depan gang'],
            ['hari' => 'Rabu',   'jam_mulai' => '07:00', 'jam_selesai' => '10:00', 'zona' => 'RT 01B', 'keterangan' => 'Zona belakang gang'],
            ['hari' => 'Jumat',  'jam_mulai' => '07:00', 'jam_selesai' => '10:00', 'zona' => 'RT 01C', 'keterangan' => 'Zona pasar'],
        ];
        foreach ($data as $d) {
            JadwalPenjemputan::create($d);
        }
    }
}