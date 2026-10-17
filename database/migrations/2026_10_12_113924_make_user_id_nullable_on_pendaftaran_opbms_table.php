<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        // Drop foreign key kalau ada
        try {
            Schema::table('pendaftaran_opbms', function (Blueprint $table) {
                $table->dropForeign(['user_id']);
            });
        } catch (\Exception $e) {}

        // Ubah user_id jadi nullable
        DB::statement('ALTER TABLE pendaftaran_opbms MODIFY user_id BIGINT UNSIGNED NULL');

        // Ubah nik jadi nullable
        DB::statement('ALTER TABLE pendaftaran_opbms MODIFY nik VARCHAR(16) NULL');
    }

    public function down(): void
    {
        DB::statement('ALTER TABLE pendaftaran_opbms MODIFY user_id BIGINT UNSIGNED NOT NULL');
        DB::statement('ALTER TABLE pendaftaran_opbms MODIFY nik VARCHAR(16) NOT NULL');
    }
};