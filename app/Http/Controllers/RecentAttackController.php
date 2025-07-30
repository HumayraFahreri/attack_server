<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AttackLog;

class RecentAttackController extends Controller
{
    public function index()
    {
        // <<< REVISI: Query statistik dioptimalkan menjadi 1 query
        $stats = AttackLog::query()
            ->selectRaw("count(*) as total_attacks")
            ->selectRaw("count(case when status = 'Blocked' then 1 end) as blocked_attacks")
            ->selectRaw("count(case when type = 'TCP Flood' then 1 end) as tcp_attacks")
            ->selectRaw("count(case when severity = 'Critical' then 1 end) as critical_attacks")
            ->first();

        $attacks = AttackLog::orderBy('created_at', 'desc')->paginate(10); 

        return view('recent-attack', [ 
            'stats' => $stats,
            'attacks' => $attacks
        ]);
    }

    public function filter(Request $request)
    {
        // Kode filter Anda sudah bagus dan tidak perlu revisi wajib.
        // Versi `when()` di atas adalah alternatif jika Anda menyukai gayanya.
        $query = AttackLog::query();

        // Filter tanggal
        if ($request->filled('date_range')) {
            switch ($request->date_range) {
                case '7day':
                    $query->where('created_at', '>=', now()->subDays(7));
                    break;
                case '30day':
                    $query->where('created_at', '>=', now()->subDays(30));
                    break;
                case 'custom':
                    if ($request->filled('start_date') && $request->filled('end_date')) {
                        $query->whereBetween('created_at', [$request->start_date, $request->end_date]);
                    }
                    break;
            }
        }

        // Filter tipe serangan
        if ($request->filled('attack_type') && $request->attack_type !== 'all') {
            $query->where('type', $request->attack_type);
        }

        // Filter severity
        if ($request->filled('severity') && $request->severity !== 'allLevel') {
            $query->where('severity', 'like', $request->severity . '%');
        }

        $stats = (clone $query)
            ->selectRaw("count(*) as total_attacks")
            ->selectRaw("count(case when status = 'Blocked' then 1 end) as blocked_attacks")
            ->selectRaw("count(case when type = 'TCP Flood' then 1 end) as tcp_attacks")
            ->selectRaw("count(case when severity = 'Critical' then 1 end) as critical_attacks")
            ->first();

        $attacks = $query->orderBy('created_at', 'desc')->paginate(10);
            
        return response()->json([
            'html' => view('partials.attack-table', ['attacks' => $attacks])->render(),
            'stats' => $stats
        ]);
    }
}