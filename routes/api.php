<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PelangganController;
use App\Http\Controllers\KendaraanController;
use App\Http\Controllers\DaftarServiceController;
use App\Http\Controllers\DataServiceController;
use App\Http\Controllers\PembayaranController;

Route::apiResource('pelanggan', PelangganController::class);
Route::apiResource('kendaraan', KendaraanController::class);
Route::apiResource('daftar-service', DaftarServiceController::class);
Route::apiResource('data-service', DataServiceController::class);
Route::apiResource('pembayaran', PembayaranController::class);
