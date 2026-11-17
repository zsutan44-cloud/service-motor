<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class DataService extends Model
{
    protected $fillable = [
        'daftar_service_id',
        'estimasi_service',
        'nama_mekanik',
        'sparepart_pengganti',
    ];

    public function daftarService(): BelongsTo
    {
        return $this->belongsTo(DaftarService::class);
    }
}
