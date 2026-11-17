<?php

namespace App\Http\Controllers;

use App\Models\Pembayaran;
use App\Models\DataService;
use Illuminate\Http\Request;

class PembayaranController extends Controller
{
    public function index(Request $request)
    {
        $pembayarans = Pembayaran::with([
            'dataService.daftarService.pelanggan',
            'dataService.daftarService.kendaraan'
        ])->latest()->get();

        if ($request->expectsJson()) {
            return response()->json([
                'message' => 'Data pembayaran berhasil diambil!',
                'data' => $pembayarans
            ], 200);
        }

        return view('pembayaran.index', compact('pembayarans'));
    }

    public function create()
    {
        $dataServices = DataService::with([
            'daftarService.pelanggan',
            'daftarService.kendaraan'
        ])->orderBy('id')->get();

        return view('pembayaran.create', compact('dataServices'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'data_service_id' => 'required|exists:data_services,id',
            'total_bayar' => 'required|numeric|min:0',
            'metode_pembayaran' => 'nullable|in:Tunai,Non Tunai',
            'keterangan' => 'nullable|string',
        ]);

        $pembayaran = Pembayaran::create($validated);

        if ($request->expectsJson()) {
            $pembayaran->load([
                'dataService.daftarService.pelanggan',
                'dataService.daftarService.kendaraan'
            ]);

            return response()->json([
                'message' => 'Pembayaran berhasil ditambahkan!',
                'data' => $pembayaran
            ], 201);
        }

        return redirect()->route('pembayaran.index')
            ->with('success', 'Pembayaran berhasil ditambahkan!');
    }

    public function show(Request $request, string $id)
    {
        $pembayaran = Pembayaran::with([
            'dataService.daftarService.pelanggan',
            'dataService.daftarService.kendaraan'
        ])->findOrFail($id);

        if ($request->expectsJson()) {
            return response()->json([
                'message' => 'Detail pembayaran berhasil diambil!',
                'data' => $pembayaran
            ], 200);
        }

        return redirect()->route('pembayaran.index');
    }

    public function edit(string $id)
    {
        $pembayaran = Pembayaran::findOrFail($id);

        $dataServices = DataService::with([
            'daftarService.pelanggan',
            'daftarService.kendaraan'
        ])->orderBy('id')->get();

        return view('pembayaran.edit', compact(
            'pembayaran',
            'dataServices'
        ));
    }

    public function update(Request $request, string $id)
    {
        $pembayaran = Pembayaran::findOrFail($id);

        $validated = $request->validate([
            'data_service_id' => 'required|exists:data_services,id',
            'total_bayar' => 'required|numeric|min:0',
            'metode_pembayaran' => 'nullable|in:Tunai,Non Tunai',
            'keterangan' => 'nullable|string',
        ]);

        $pembayaran->update($validated);

        if ($request->expectsJson()) {
            $pembayaran->load([
                'dataService.daftarService.pelanggan',
                'dataService.daftarService.kendaraan'
            ]);

            return response()->json([
                'message' => 'Pembayaran berhasil diperbarui!',
                'data' => $pembayaran
            ], 200);
        }

        return redirect()->route('pembayaran.index')
            ->with('success', 'Pembayaran berhasil diperbarui!');
    }

    public function destroy(Request $request, string $id)
    {
        $pembayaran = Pembayaran::findOrFail($id);

        $pembayaran->delete();

        if ($request->expectsJson()) {
            return response()->json([
                'message' => 'Pembayaran berhasil dihapus!'
            ], 200);
        }

        return redirect()->route('pembayaran.index')
            ->with('success', 'Pembayaran berhasil dihapus!');
    }
}
