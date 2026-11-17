<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class DaftarService extends Model
{
    protected $fillable = [
        'pelanggan_id',
        'kendaraan_id',
        'keluhan',
        'tanggal_masuk',
    ];

    public function pelanggan(): BelongsTo
    {
        return $this->belongsTo(Pelanggan::class);
    }

    public function kendaraan(): BelongsTo
    {
        return $this->belongsTo(Kendaraan::class);
    }

    public function dataServices(): HasMany
    {
        return $this->hasMany(DataService::class);
    }
}
