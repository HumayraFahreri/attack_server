<?php

namespace App\Http\Controllers;

use App\Models\AttackServer;
use App\Models\AttackLog; 
use Illuminate\Http\Request;

class AttackServerController extends Controller
{
    public function index(){
        $attacks = AttackServer::where('status', 'Pending')->latest()->get();
        return view('attack_server', compact('attacks'));
    }
    
    public function create(){
        return view('attack_parameter');
    }

    public function store(Request $request){
        $validatedData = $request->validate([
            'nama_serangan' => 'required|string|max:255',
            'dos_type'      => 'required|string',
            'source_server' => 'required|string',
            'ip_target'     => 'required|ip',
            'port'          => 'required|integer|min:1|max:65535',
            'durasi'        => 'required|integer|min:1',
            'data_size'     => 'required|integer|min:1',
        ]);
        AttackServer::create($validatedData);
        return redirect()->route('attack-server.index')->with('success', 'Serangan baru berhasil direncanakan.');
    }

    public function show(AttackServer $attack) {
        $averagePacketSizeKB = 1; 
        $totalDataKB = ($attack->data_size ?? 0) * 1024;
        $packetsSent = $totalDataKB > 0 ? $totalDataKB / $averagePacketSizeKB : 0;
        $averageRate = 0;
        if ($attack->durasi > 0 && $packetsSent > 0) {
            $averageRate = $packetsSent / $attack->durasi;
        }
        $stats = [
            'packets_sent' => $packetsSent,
            'data_transferred' => $attack->data_size ?? 0,
            'average_rate' => $averageRate,
        ];
        return view('attack_detail', compact('attack', 'stats'));
    }

    public function edit(AttackServer $attack)
    {
        return view('attack_server_edit', compact('attack'));
    }

    public function update(Request $request, AttackServer $attack)
    {
        $validatedData = $request->validate([
            'nama_serangan' => 'required|string|max:255',
            'dos_type'      => 'required|string',
            'source_server' => 'required|string',
            'ip_target'     => 'required|ip',
            'port'          => 'required|integer|min:1|max:65535',
            'durasi'        => 'required|integer|min:1',
            'data_size'     => 'required|integer|min:1',
        ]);
        $attack->update($validatedData);
        return redirect()->route('attack-server.index')->with('success', 'Attack updated successfully.');
    }
    
    public function execute(AttackServer $attack)
    {
        // ... (kode execute Anda sudah benar) ...
    }
    
    // Anda bisa tambahkan method destroy di sini jika perlu
    public function destroy(AttackServer $attack)
    {
        $attack->delete();
        return redirect()->route('attack-server.index')->with('success', 'Attack deleted successfully.');
    }
}