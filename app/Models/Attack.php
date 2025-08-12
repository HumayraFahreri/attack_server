<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attack extends Model
{
    use HasFactory;

    protected $table = 'attacks';

    protected $fillable = [
        'attack_type',   // TCP, UDP, ICMP
        'source_ip',
        'destination_ip',
        'packets_sent',
        'status',        // running, completed, failed
        'duration',      // dalam detik
        'started_at',
        'ended_at'
    ];

    // Kalau pakai timestamps default (created_at, updated_at)
    public $timestamps = true;

        protected $casts = [
        'started_at' => 'datetime',
        'ended_at' => 'datetime'
    ];
}
