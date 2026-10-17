<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('jadwal_penjemputans', function (Blueprint $table) {
            $table->id();
            $table->string('hari');                    // Senin, Selasa, dst
            $table->time('jam_mulai');                 // 07:00
            $table->time('jam_selesai');               // 10:00
            $table->string('zona');                    // RT 1A, 1B, dst
            $table->text('keterangan')->nullable();    // Catatan tambahan
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('jadwal_penjemputans');
    }
};