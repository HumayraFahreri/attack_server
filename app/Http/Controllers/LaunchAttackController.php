<?php

namespace App\Http\Controllers;

use App\Models\AttackServer;
use App\Models\Attack;
use App\Models\Event;
use Illuminate\Http\Request;

class LaunchAttackController extends Controller
{
    public function execute($id)
    {
        $attackServer = AttackServer::findOrFail($id);

        // Path ke script Python
        $scriptPath = base_path('scripts/launch_attack.py');

        // Jalankan script Python
        $command = escapeshellcmd("sudo python3 {$scriptPath} --id={$attackServer->id}");
        $output = shell_exec($command . " 2>&1");

        // Simpan ke tabel grafik (Attack)
        $attack = Attack::create([
            'type'   => $attackServer->dos_type,
            'status' => 'Running',
            'result' => $output
        ]);

        // Simpan ke tabel recent event (Event)
        RecentEvent::create([
            'attack_id'   => $attack->id,
            'attack_ip'   => $attack->attack_ip,
            'target_ip'   => $attack->target_ip,
            'type'        => $attack->type,
            'duration'    => $attack->duration,
            'description' => "Serangan diluncurkan: {$attackServer->dos_type} ke {$attackServer->ip_target}",
            'time'        => now()
        ]);

        return redirect()->route('dashboard')->with('success', 'Attack executed and logged!');
        return redirect()->route('recent-attacks')->with('success', 'Attack execution started.');

        // Update status di tabel attack_servers
        $attackServer->status = 'Completed';
        $attackServer->save();

        return redirect()->back()->with('message', "Attack executed: {$output}");
    }
}
