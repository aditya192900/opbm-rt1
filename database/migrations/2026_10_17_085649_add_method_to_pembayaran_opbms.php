<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('pembayaran_opbms', function (Blueprint $table) {
            // cash, qris
            $table->string('metode_bayar')->default('cash')->after('status');
            // Untuk menyimpan bukti transfer QRIS
            $table->string('bukti_bayar')->nullable()->after('metode_bayar');
            // Menyimpan nominal
            $table->integer('jumlah_bayar')->default(50000)->after('bukti_bayar');
        });
    }

    public function down(): void
    {
        Schema::table('pembayaran_opbms', function (Blueprint $table) {
            $table->dropColumn(['metode_bayar', 'bukti_bayar', 'jumlah_bayar']);
        });
    }
};