<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Pembayaran extends Model
{
    protected $fillable = [
        'data_service_id',
        'total_bayar',
        'metode_pembayaran',
        'keterangan',
        'status_pembayaran',
        'tanggal_pembayaran',
    ];

    public function dataService(): BelongsTo
    {
        return $this->belongsTo(DataService::class);
    }
}
