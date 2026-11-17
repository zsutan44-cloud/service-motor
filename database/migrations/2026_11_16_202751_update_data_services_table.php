
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('data_services', function (Blueprint $table) {
            $table->dropColumn([
                'tindakan_service',
                'biaya_service',
                'tanggal_selesai'
            ]);

            $table->string('estimasi_service')->after('daftar_service_id');
            $table->text('sparepart_pengganti')->nullable()->after('nama_mekanik');
        });
    }

    public function down(): void
    {
        Schema::table('data_services', function (Blueprint $table) {
            $table->dropColumn([
                'estimasi_service',
                'sparepart_pengganti'
            ]);

            $table->text('tindakan_service');
            $table->decimal('biaya_service', 12, 2);
            $table->date('tanggal_selesai')->nullable();
        });
    }
};
