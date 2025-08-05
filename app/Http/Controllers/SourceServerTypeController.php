<?php

namespace App\Http\Controllers;

use App\Models\SourceServerType;
use Illuminate\Http\Request;

class SourceServerTypeController extends Controller
{
    public function index()
    {
        return response()->json(SourceServerType::orderBy('name')->get());
    }

    public function store(Request $request)
    {
        $validated = $request->validate(['name' => 'required|string|max:255|unique:source_server_types,name']);
        $validated['is_custom'] = true;
        $type = SourceServerType::create($validated);
        return response()->json($type, 201);
    }

    public function update(Request $request, SourceServerType $sourceServerType)
    {
        if (!$sourceServerType->is_custom) {
            return response()->json(['message' => 'Tipe default tidak dapat diubah.'], 403);
        }
        $validated = $request->validate(['name' => 'required|string|max:255|unique:source_server_types,name,' . $sourceServerType->id]);
        $sourceServerType->update($validated);
        return response()->json($sourceServerType);
    }

    public function destroy(SourceServerType $sourceServerType)
    {
        if (!$sourceServerType->is_custom) {
            return response()->json(['message' => 'Tipe default tidak dapat dihapus.'], 403);
        }
        $sourceServerType->delete();
        return response()->json(null, 204);
    }
}