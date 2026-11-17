<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\PelangganController;
use App\Http\Controllers\KendaraanController;
use App\Http\Controllers\DaftarServiceController;
use App\Http\Controllers\DataServiceController;
use App\Http\Controllers\PembayaranController;

Route::get('/', function () {

    $totalPelanggan = DB::table('pelanggans')->count();
    $totalKendaraan = DB::table('kendaraans')->count();
    $totalDaftarService = DB::table('daftar_services')->count();
    $totalDataService = DB::table('data_services')->count();
    $totalPembayaran = DB::table('pembayarans')->count();

    return view('dashboard', compact(
        'totalPelanggan',
        'totalKendaraan',
        'totalDaftarService',
        'totalDataService',
        'totalPembayaran'
    ));
});

Route::resource('pelanggan', PelangganController::class);
Route::resource('kendaraan', KendaraanController::class);
Route::resource('daftar-service', DaftarServiceController::class);
Route::resource('data-service', DataServiceController::class);
Route::resource('pembayaran', PembayaranController::class)->except(['show']);