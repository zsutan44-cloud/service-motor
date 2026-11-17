<?php

namespace App\Http\Controllers;

use App\Models\Kendaraan;
use Illuminate\Http\Request;

class KendaraanController extends Controller
{
    public function index(Request $request)
    {
        $kendaraans = Kendaraan::latest()->get();

        if ($request->expectsJson()) {
            return response()->json([
                'message' => 'Data kendaraan berhasil diambil!',
                'data' => $kendaraans
            ], 200);
        }

        return view('kendaraan.index', compact('kendaraans'));
    }

    public function create()
    {
        return view('kendaraan.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nomor_polisi' => 'required|string|max:255|unique:kendaraans,nomor_polisi',
            'jenis_kendaraan' => 'required|in:Matic,Manual Transmisi',
            'no_stnk' => 'required|string|max:255',
            'tahun_pembuatan' => 'required|integer|min:1900|max:' . date('Y'),
            'nama_pemilik' => 'required|string|max:255',
            'warna' => 'required|string|max:255',
        ]);

        $kendaraan = Kendaraan::create($validated);

        if ($request->expectsJson()) {
            return response()->json([
                'message' => 'Data kendaraan berhasil ditambahkan!',
                'data' => $kendaraan
            ], 201);
        }

        return redirect()->route('kendaraan.index')
            ->with('success', 'Data kendaraan berhasil ditambahkan!');
    }

    public function show(Request $request, Kendaraan $kendaraan)
    {
        if ($request->expectsJson()) {
            return response()->json([
                'message' => 'Detail kendaraan berhasil diambil!',
                'data' => $kendaraan
            ], 200);
        }

        return redirect()->route('kendaraan.index');
    }

    public function edit(Kendaraan $kendaraan)
    {
        return view('kendaraan.edit', compact('kendaraan'));
    }

    public function update(Request $request, Kendaraan $kendaraan)
    {
        $validated = $request->validate([
            'nomor_polisi' => 'required|string|max:255|unique:kendaraans,nomor_polisi,' . $kendaraan->id,
            'jenis_kendaraan' => 'required|in:Matic,Manual Transmisi',
            'no_stnk' => 'required|string|max:255',
            'tahun_pembuatan' => 'required|integer|min:1900|max:' . date('Y'),
            'nama_pemilik' => 'required|string|max:255',
            'warna' => 'required|string|max:255',
        ]);

        $kendaraan->update($validated);

        if ($request->expectsJson()) {
            return response()->json([
                'message' => 'Data kendaraan berhasil diperbarui!',
                'data' => $kendaraan
            ], 200);
        }

        return redirect()->route('kendaraan.index')
            ->with('success', 'Data kendaraan berhasil diperbarui!');
    }

    public function destroy(Request $request, Kendaraan $kendaraan)
    {
        $kendaraan->delete();

        if ($request->expectsJson()) {
            return response()->json([
                'message' => 'Data kendaraan berhasil dihapus!'
            ], 200);
        }

        return redirect()->route('kendaraan.index')
            ->with('success', 'Data kendaraan berhasil dihapus!');
    }
}
