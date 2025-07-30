<?php

namespace App\Http\Controllers;

use App\Models\AttackServer;
use App\Models\AttackLog; 
use Illuminate\Http\Request;

class AttackServerController extends Controller
{

    public function index()
    {
        $attacks = AttackServer::whereRaw('TRIM(status) = ?', ['Pending'])->latest()->get();

        return view('attack_server', compact('attacks'));
    }
    
    /**
     * Menampilkan form untuk membuat serangan baru.
     */
    public function create()
    {
        return view('parameter_serangan'); // Mengarahkan ke form serangan
    }

    /**
     * Menyimpan data serangan baru ke database.
     */
    public function store(Request $request)
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
        AttackServer::create($validatedData);

        // Redirect ke halaman daftar serangan dengan pesan sukses
        return redirect()->route('attack-server.index')->with('success', 'Serangan baru berhasil direncanakan.');
    }

    /**
     * Menampilkan detail serangan spesifik beserta statistiknya.
     */
    public function show(AttackServer $attack) // Menggunakan Route Model Binding
    {
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

       return view('attack_detail', [
            'attack' => $attack,
            'stats'  => $stats,
        ]);
    }
    
    /**
     * METHOD BARU: Mengeksekusi serangan, membuat log, dan mengubah status.
     */
    public function execute(AttackServer $attack)
    {
        $isSuccess = true; 

        if ($isSuccess) {
            // 2. Buat entri baru di tabel attack_logs
            AttackLog::create([
                'attack_ip' => $attack->source_server,
                'target_ip' => $attack->ip_target,
                'type' => $attack->dos_type,
                'target' => $attack->nama_serangan,
                'severity' => 'Medium',
                'status' => 'Completed',
                'details' => 'Serangan dieksekusi dari daftar perencanaan.',
                'data_size' => $attack->data_size,
            ]);

            // 3. Update status serangan yang direncanakan menjadi 'Completed'
            $attack->update(['status' => 'Completed']);

            return redirect()->route('attack-server.index')->with('success', 'Serangan berhasil dieksekusi dan dipindahkan ke riwayat.');
        } 
        
        // Opsional: jika gagal
        $attack->update(['status' => 'Failed']);
        return redirect()->route('attack-server.index')->with('error', 'Eksekusi serangan gagal.');
    }
}