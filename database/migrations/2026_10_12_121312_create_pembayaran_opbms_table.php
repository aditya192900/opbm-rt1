<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pembayaran_opbms', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pendaftaran_opbm_id')->constrained('pendaftaran_opbms')->onDelete('cascade');
            $table->integer('bulan'); // 1-12
            $table->integer('tahun');
            $table->integer('jumlah')->default(50000);
            $table->enum('status', ['lunas', 'belum'])->default('lunas');
            $table->date('tanggal_bayar')->nullable();
            $table->text('catatan')->nullable();
            $table->timestamps();

            $table->unique(['pendaftaran_opbm_id', 'bulan', 'tahun'], 'unique_pembayaran');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pembayaran_opbms');
    }
};