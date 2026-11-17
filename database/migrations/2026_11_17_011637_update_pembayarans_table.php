<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('pembayarans', function (Blueprint $table) {
            $table->dropForeign(['daftar_service_id']);
            $table->dropColumn('daftar_service_id');
        });

        Schema::table('pembayarans', function (Blueprint $table) {
            $table->foreignId('data_service_id')
                ->nullable()
                ->after('id')
                ->constrained('data_services')
                ->nullOnDelete();

            $table->text('keterangan')
                ->nullable()
                ->after('metode_pembayaran');
        });

        DB::statement("
            ALTER TABLE pembayarans
            MODIFY metode_pembayaran
            ENUM('Tunai', 'Transfer', 'QRIS', 'Non Tunai') NOT NULL
        ");

        DB::table('pembayarans')
            ->whereIn('metode_pembayaran', ['Transfer', 'QRIS'])
            ->update(['metode_pembayaran' => 'Non Tunai']);

        DB::statement("
            ALTER TABLE pembayarans
            MODIFY metode_pembayaran
            ENUM('Tunai', 'Non Tunai') NOT NULL
        ");
    }

    public function down(): void
    {
        DB::table('pembayarans')
            ->where('metode_pembayaran', 'Non Tunai')
            ->update(['metode_pembayaran' => 'Tunai']);

        Schema::table('pembayarans', function (Blueprint $table) {
            $table->dropForeign(['data_service_id']);
            $table->dropColumn(['data_service_id', 'keterangan']);
        });

        Schema::table('pembayarans', function (Blueprint $table) {
            $table->foreignId('daftar_service_id')
                ->nullable()
                ->constrained('daftar_services')
                ->nullOnDelete();
        });

        DB::statement("
            ALTER TABLE pembayarans
            MODIFY metode_pembayaran
            ENUM('Tunai', 'Transfer', 'QRIS') NOT NULL
        ");
    }
};
