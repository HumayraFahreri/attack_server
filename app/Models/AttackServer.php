<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AttackServer extends Model
{
    use HasFactory;

    protected $table = 'attack_servers';

    protected $fillable = [
        'nama_serangan',
        'dos_type',
        'source_server',
        'ip_target',
        'port',
        'durasi',
        'data_size',
        'status',
    ];

    /**
     * METHOD BARU (ACCESSOR)
     * Mengubah durasi dari detik menjadi format jam, menit, detik.
     */
    public function getFormattedDurationAttribute(): string
    {
        $seconds = $this->durasi;

        if ($seconds < 60) {
            return $seconds . ' detik';
        }

        $hours = floor($seconds / 3600);
        $minutes = floor(($seconds % 3600) / 60);
        $remainingSeconds = $seconds % 60;

        $parts = [];
        if ($hours > 0) {
            $parts[] = $hours . ' jam';
        }
        if ($minutes > 0) {
            $parts[] = $minutes . ' menit';
        }
        if ($remainingSeconds > 0) {
            $parts[] = $remainingSeconds . ' detik';
        }

        return implode(', ', $parts);
    }
}