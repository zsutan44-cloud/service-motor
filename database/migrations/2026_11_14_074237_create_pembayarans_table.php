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
    Schema::create('pembayarans', function (Blueprint $table) {
        $table->id();
        $table->foreignId('daftar_service_id')->constrained('daftar_services')->cascadeOnDelete();
        $table->decimal('total_bayar', 12, 2);
        $table->enum('metode_pembayaran', ['Tunai', 'Transfer', 'QRIS']);
        $table->enum('status_pembayaran', ['Belum Dibayar', 'Lunas'])->default('Belum Dibayar');
        $table->date('tanggal_pembayaran')->nullable();
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pembayarans');
    }
};
