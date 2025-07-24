<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AttackServer;

class AttackServerController extends Controller
{
    public function index()
    {
        // Ambil semua data serangan dari database, urutkan dari yang terbaru
        $attacks = AttackServer::latest()->get();

        // Kirim data ke view
        return view('attack_server', compact('attacks'));
    }

    public function store(Request $request)
    {
        return redirect()->route('parameter.serangan.store')->with('success', 'Serangan berhasil ditambahkan.');
    }

    public function show($id){
        $attack = AttackServer::findOrFail($id);
        return view('attack_detail', compact('attack'));
    }

}
