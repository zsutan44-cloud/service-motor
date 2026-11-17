<?php

namespace App\Http\Controllers;

use App\Models\DataService;
use App\Models\DaftarService;
use Illuminate\Http\Request;

class DataServiceController extends Controller
{
    public function index(Request $request)
    {
        $dataServices = DataService::with([
            'daftarService.pelanggan',
            'daftarService.kendaraan'
        ])->latest()->get();

        if ($request->expectsJson()) {
            return response()->json([
                'message' => 'Data service berhasil diambil!',
                'data' => $dataServices
            ], 200);
        }

        return view('data-service.index', compact('dataServices'));
    }

    public function create()
    {
        $daftarServices = DaftarService::with([
            'pelanggan',
            'kendaraan'
        ])->orderBy('id')->get();

        return view('data-service.create', compact('daftarServices'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'daftar_service_id' => 'required|exists:daftar_services,id',
            'estimasi_service' => 'required|string|max:255',
            'nama_mekanik' => 'required|string|max:255',
            'sparepart_pengganti' => 'nullable|string',
        ]);

        $dataService = DataService::create($validated);

        if ($request->expectsJson()) {
            $dataService->load([
                'daftarService.pelanggan',
                'daftarService.kendaraan'
            ]);

            return response()->json([
                'message' => 'Data service berhasil ditambahkan!',
                'data' => $dataService
            ], 201);
        }

        return redirect()->route('data-service.index')
            ->with('success', 'Data service berhasil ditambahkan!');
    }

    public function show(Request $request, string $id)
    {
        $dataService = DataService::with([
            'daftarService.pelanggan',
            'daftarService.kendaraan'
        ])->findOrFail($id);

        if ($request->expectsJson()) {
            return response()->json([
                'message' => 'Detail data service berhasil diambil!',
                'data' => $dataService
            ], 200);
        }

        return redirect()->route('data-service.index');
    }

    public function edit(string $id)
    {
        $dataService = DataService::findOrFail($id);

        $daftarServices = DaftarService::with([
            'pelanggan',
            'kendaraan'
        ])->orderBy('id')->get();

        return view('data-service.edit', compact(
            'dataService',
            'daftarServices'
        ));
    }

    public function update(Request $request, string $id)
    {
        $dataService = DataService::findOrFail($id);

        $validated = $request->validate([
            'daftar_service_id' => 'required|exists:daftar_services,id',
            'estimasi_service' => 'required|string|max:255',
            'nama_mekanik' => 'required|string|max:255',
            'sparepart_pengganti' => 'nullable|string',
        ]);

        $dataService->update($validated);

        if ($request->expectsJson()) {
            $dataService->load([
                'daftarService.pelanggan',
                'daftarService.kendaraan'
            ]);

            return response()->json([
                'message' => 'Data service berhasil diperbarui!',
                'data' => $dataService
            ], 200);
        }

        return redirect()->route('data-service.index')
            ->with('success', 'Data service berhasil diperbarui!');
    }

    public function destroy(Request $request, string $id)
    {
        $dataService = DataService::findOrFail($id);

        $dataService->delete();

        if ($request->expectsJson()) {
            return response()->json([
                'message' => 'Data service berhasil dihapus!'
            ], 200);
        }

        return redirect()->route('data-service.index')
            ->with('success', 'Data service berhasil dihapus!');
    }
}
