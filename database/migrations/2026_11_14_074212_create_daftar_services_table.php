<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
public function up(): void
{
    Schema::create('daftar_services', function (Blueprint $table) {
        $table->id();
        $table->foreignId('pelanggan_id')->constrained('pelanggans')->cascadeOnDelete();
        $table->foreignId('kendaraan_id')->constrained('kendaraans')->cascadeOnDelete();
        $table->text('keluhan');
        $table->date('tanggal_masuk');
        $table->enum('jenis_kendaraan', ['Motor', 'Mobil']);
        $table->enum('status', ['Menunggu', 'Diproses', 'Selesai'])->default('Menunggu');
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('daftar_services');
    }
};
