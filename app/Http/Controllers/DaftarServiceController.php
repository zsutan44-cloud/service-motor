<?php

namespace App\Http\Controllers;

use App\Models\DaftarService;
use App\Models\Pelanggan;
use App\Models\Kendaraan;
use Illuminate\Http\Request;

class DaftarServiceController extends Controller
{
    public function index(Request $request)
    {
        $daftarServices = DaftarService::with([
            'pelanggan',
            'kendaraan'
        ])->latest()->get();

        if ($request->expectsJson()) {
            return response()->json([
                'message' => 'Data daftar service berhasil diambil!',
                'data' => $daftarServices
            ], 200);
        }

        return view('daftar-service.index', compact('daftarServices'));
    }

    public function create()
    {
        $pelanggans = Pelanggan::orderBy('id')->get();
        $kendaraans = Kendaraan::orderBy('nomor_polisi')->get();

        return view('daftar-service.create', compact(
            'pelanggans',
            'kendaraans'
        ));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'pelanggan_id' => 'required|exists:pelanggans,id',
            'kendaraan_id' => 'required|exists:kendaraans,id',
            'keluhan' => 'required|string',
            'tanggal_masuk' => 'required|date',
        ]);

        $daftarService = DaftarService::create($validated);

        if ($request->expectsJson()) {
            return response()->json([
                'message' => 'Daftar service berhasil ditambahkan!',
                'data' => $daftarService
            ], 201);
        }

        return redirect()->route('daftar-service.index')
            ->with('success', 'Daftar service berhasil ditambahkan!');
    }

    public function show(Request $request, DaftarService $daftar_service)
    {
        if ($request->expectsJson()) {
            $daftar_service->load(['pelanggan', 'kendaraan']);

            return response()->json([
                'message' => 'Detail daftar service berhasil diambil!',
                'data' => $daftar_service
            ], 200);
        }

        return redirect()->route('daftar-service.index');
    }

    public function edit(DaftarService $daftar_service)
    {
        $pelanggans = Pelanggan::orderBy('id')->get();
        $kendaraans = Kendaraan::orderBy('nomor_polisi')->get();

        return view('daftar-service.edit', compact(
            'daftar_service',
            'pelanggans',
            'kendaraans'
        ));
    }

    public function update(Request $request, DaftarService $daftar_service)
    {
        $validated = $request->validate([
            'pelanggan_id' => 'required|exists:pelanggans,id',
            'kendaraan_id' => 'required|exists:kendaraans,id',
            'keluhan' => 'required|string',
            'tanggal_masuk' => 'required|date',
        ]);

        $daftar_service->update($validated);

        if ($request->expectsJson()) {
            return response()->json([
                'message' => 'Daftar service berhasil diperbarui!',
                'data' => $daftar_service
            ], 200);
        }

        return redirect()->route('daftar-service.index')
            ->with('success', 'Daftar service berhasil diperbarui!');
    }

    public function destroy(Request $request, DaftarService $daftar_service)
    {
        $daftar_service->delete();

        if ($request->expectsJson()) {
            return response()->json([
                'message' => 'Daftar service berhasil dihapus!'
            ], 200);
        }

        return redirect()->route('daftar-service.index')
            ->with('success', 'Daftar service berhasil dihapus!');
    }
}
