<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('menu_umkms', function (Blueprint $table) {
            $table->id();
            $table->foreignId('umkm_warga_id')->constrained('umkm_wargas')->onDelete('cascade');
            $table->string('nama_menu');
            $table->text('deskripsi')->nullable();
            $table->integer('harga');
            $table->string('foto')->nullable();
            $table->enum('kategori', ['Makanan', 'Minuman', 'Lainnya'])->default('Makanan');
            $table->boolean('is_available')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('menu_umkms');
    }
};