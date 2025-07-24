<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AttackServer extends Model
{
    use HasFactory;

    protected $table = 'attack_servers'; // Pastikan sesuai dengan nama tabel di database

    protected $fillable = [
        'nama_serangan',
        'dos_type',
        'source_server',
        'ip_target',
        'port',
        'durasi',
    ];
}
