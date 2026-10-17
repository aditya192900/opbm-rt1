<?php

namespace Database\Seeders;

use App\Models\UmkmWarga;
use App\Models\User;
use Illuminate\Database\Seeder;

class UmkmSeeder extends Seeder
{
    public function run(): void
    {
        $user = User::first();
        if (!$user) return;

        $data = [
            ['nama_usaha' => 'Warung Bu Siti',    'pemilik' => 'Ibu Siti',    'kategori' => 'Makanan',  'deskripsi' => 'Menjual nasi uduk, gorengan, dan aneka lauk siap saji setiap pagi.', 'no_wa' => '6281234500001', 'alamat' => 'Jl. Merdeka No. 5'],
            ['nama_usaha' => 'Kopi Pak Hadi',     'pemilik' => 'Bapak Hadi',  'kategori' => 'Minuman',  'deskripsi' => 'Kedai kopi tradisional dengan aneka kopi lokal Jambi.', 'no_wa' => '6281234500002', 'alamat' => 'Jl. Sudirman No. 12'],
            ['nama_usaha' => 'Jahit Ibu Ratna',   'pemilik' => 'Ibu Ratna',   'kategori' => 'Jasa',     'deskripsi' => 'Melayani jahit dan permak pakaian dengan harga terjangkau.', 'no_wa' => '6281234500003', 'alamat' => 'Jl. Sudirman No. 15'],
            ['nama_usaha' => 'Keripik Singkong',  'pemilik' => 'Ibu Aminah',  'kategori' => 'Makanan',  'deskripsi' => 'Keripik singkong homemade berbagai rasa, bisa dipesan untuk oleh-oleh.', 'no_wa' => '6281234500004', 'alamat' => 'Jl. Merdeka No. 7'],
        ];
        foreach ($data as $d) {
            UmkmWarga::create(array_merge($d, ['user_id' => $user->id]));
        }
    }
}