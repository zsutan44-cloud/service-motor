<?php

namespace App\Http\Controllers;

use App\Models\Pelanggan;
use Illuminate\Http\Request;

class PelangganController extends Controller
{
    public function index(Request $request)
    {
        $pelanggans = Pelanggan::latest()->get();

        if ($request->expectsJson()) {
            return response()->json([
                'message' => 'Data pelanggan berhasil diambil!',
                'data' => $pelanggans
            ], 200);
        }

        return view('pelanggan.index', compact('pelanggans'));
    }

    public function create()
    {
        return view('pelanggan.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_pelanggan' => 'required|string|max:255',
            'alamat' => 'required|string',
            'pekerjaan' => 'required|string|max:255',
            'no_hp' => 'required|string|max:15',
        ]);

        $pelanggan = Pelanggan::create($validated);

        if ($request->expectsJson()) {
            return response()->json([
                'message' => 'Data pelanggan berhasil ditambahkan!',
                'data' => $pelanggan
            ], 201);
        }

        return redirect()->route('pelanggan.index')
            ->with('success', 'Data pelanggan berhasil ditambahkan!');
    }

    public function show(Request $request, Pelanggan $pelanggan)
    {
        if ($request->expectsJson()) {
            return response()->json([
                'message' => 'Detail pelanggan berhasil diambil!',
                'data' => $pelanggan
            ], 200);
        }

        return redirect()->route('pelanggan.index');
    }

    public function edit(Pelanggan $pelanggan)
    {
        return view('pelanggan.edit', compact('pelanggan'));
    }

    public function update(Request $request, Pelanggan $pelanggan)
    {
        $validated = $request->validate([
            'nama_pelanggan' => 'required|string|max:255',
            'alamat' => 'required|string',
            'pekerjaan' => 'required|string|max:255',
            'no_hp' => 'required|string|max:15',
        ]);

        $pelanggan->update($validated);

        if ($request->expectsJson()) {
            return response()->json([
                'message' => 'Data pelanggan berhasil diperbarui!',
                'data' => $pelanggan
            ], 200);
        }

        return redirect()->route('pelanggan.index')
            ->with('success', 'Data pelanggan berhasil diperbarui!');
    }

    public function destroy(Request $request, Pelanggan $pelanggan)
    {
        $pelanggan->delete();

        if ($request->expectsJson()) {
            return response()->json([
                'message' => 'Data pelanggan berhasil dihapus!'
            ], 200);
        }

        return redirect()->route('pelanggan.index')
            ->with('success', 'Data pelanggan berhasil dihapus!');
    }
}
