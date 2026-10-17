<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Buat akun default RT & Bendahara (hanya kalau belum ada)
        if (User::where('email', 'rt01@opbm.test')->doesntExist()) {
            User::create([
                'name' => 'Ketua RT 01',
                'email' => 'rt01@opbm.test',
                'password' => bcrypt('password'),
                'role' => 'rt',
            ]);
        }

        if (User::where('email', 'bendahara@opbm.test')->doesntExist()) {
            User::create([
                'name' => 'Bendahara RT 01',
                'email' => 'bendahara@opbm.test',
                'password' => bcrypt('password'),
                'role' => 'bendahara',
            ]);
        }

        // Seeder data contoh (opsional, jangan dijalankan kalau sudah ada data)
        // $this->call([
        //     PendaftaranSeeder::class,
        //     JadwalSeeder::class,
        //     LaporanSeeder::class,
        //     UmkmSeeder::class,
        //     DokumentasiSeeder::class,
        //     PengurusSeeder::class,
        // ]);
    }
}