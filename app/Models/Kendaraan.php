<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kendaraan extends Model
{
    protected $fillable = [
        'nomor_polisi',
        'jenis_kendaraan',
        'no_stnk',
        'tahun_pembuatan',
        'nama_pemilik',
        'warna',
    ];
}
