<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        // Ubah status jadi VARCHAR biar bisa simpan 'batal'
        DB::statement("ALTER TABLE pembayaran_opbms MODIFY status VARCHAR(20) DEFAULT 'lunas'");

        Schema::table('pembayaran_opbms', function (Blueprint $table) {
            $table->foreignId('rt_confirmed_by')->nullable()->after('status');
            $table->timestamp('rt_confirmed_at')->nullable()->after('rt_confirmed_by');
            $table->foreignId('bendahara_confirmed_by')->nullable()->after('rt_confirmed_at');
            $table->timestamp('bendahara_confirmed_at')->nullable()->after('bendahara_confirmed_by');
            $table->foreignId('cancelled_by')->nullable()->after('bendahara_confirmed_at');
            $table->string('cancelled_role')->nullable()->after('cancelled_by');
            $table->timestamp('cancelled_at')->nullable()->after('cancelled_role');
        });
    }

    public function down(): void
    {
        Schema::table('pembayaran_opbms', function (Blueprint $table) {
            $table->dropColumn([
                'rt_confirmed_by', 'rt_confirmed_at',
                'bendahara_confirmed_by', 'bendahara_confirmed_at',
                'cancelled_by', 'cancelled_role', 'cancelled_at'
            ]);
        });
    }
};