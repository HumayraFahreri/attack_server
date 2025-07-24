<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AttackServer; // Tambahkan model

class ParameterSeranganController extends Controller
{
    public function index()
    {
        return view('parameter_serangan');
    }

    public function store(Request $request)
    {
        // Validasi data dari form
        $request->validate([
            'nama_serangan' => 'required|string|max:255',
            'dos_type' => 'required|string',
            'source_server' => 'required|string',
            'ip_target' => 'required|ip',
            'port' => 'required|integer|min:1|max:65535',
            'durasi' => 'required|integer|min:1',
        ]);

        // Simpan ke database
        AttackServer::create([
            'nama_serangan' => $request->nama_serangan,
            'dos_type' => $request->dos_type,
            'source_server' => $request->source_server,
            'ip_target' => $request->ip_target,
            'port' => $request->port,
            'durasi' => $request->durasi,
        ]);

        return response()->json(['message' => 'Berhasil masuk']);
    }
}
