<?php

namespace App\Http\Controllers;

use App\Models\DosType;
use Illuminate\Http\Request;

class ManageDosController extends Controller
{
    /**
     * Mengambil semua data untuk ditampilkan di tabel modal.
     * Mengembalikan response JSON.
     */
    public function index()
    {
        return response()->json(DosType::orderBy('name')->get());
    }

    /**
     * Menyimpan data baru dari modal.
     * Mengembalikan response JSON.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:dos_types,name',
            'description' => 'nullable|string',
        ]);

        $validated['is_custom'] = true;
        $dosType = DosType::create($validated);

        return response()->json($dosType, 201);
    }

    /**
     * Mengupdate data yang ada menggunakan Route Model Binding.
     * Mengembalikan response JSON.
     */
    public function update(Request $request, DosType $dosType)
    {
        if (!$dosType->is_custom) {
            return response()->json(['message' => 'Tipe default tidak dapat diubah.'], 403);
        }

        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:dos_types,name,' . $dosType->id,
            'description' => 'nullable|string',
        ]);

        $dosType->update($validated);
        return response()->json($dosType);
    }

    /**
     * Menghapus data menggunakan Route Model Binding.
     * Mengembalikan response JSON.
     */
    public function destroy(DosType $dosType)
    {
        if (!$dosType->is_custom) {
            return response()->json(['message' => 'Tipe default tidak dapat dihapus.'], 403);
        }

        $dosType->delete();
        return response()->json(null, 204);
    }
}