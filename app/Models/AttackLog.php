<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AttackLog extends Model
{
    use HasFactory;

    protected $table = 'attack_logs'; // Pastikan ini benar

    protected $fillable = [
        'attack_ip',
        'ip_target',
        'type',
        'target',
        'severity',
        'status',
        'message',
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];
}