<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AttackLog extends Model
{
    use HasFactory;

    /**
     * Nama tabel yang terhubung dengan model ini.
     * Laravel biasanya bisa menebaknya, tapi lebih baik ditulis secara eksplisit.
     * @var string
     */
    protected $table = 'attack_logs'; // Sesuaikan jika nama tabel Anda berbeda

    /**
     * Atribut yang boleh diisi secara massal (mass assignable).
     * Penting untuk keamanan saat menggunakan metode create() atau update().
     * @var array
     */
    protected $fillable = [
        'attack_ip',
        'ip_target',
        'type',
        'target',
        'severity',
        'status',
        'port',
        'duration',
        // tambahkan kolom lain yang relevan
    ];

    /**
     * The attributes that should be cast.
     * Ini akan mengubah tipe data secara otomatis, misalnya tanggal menjadi objek Carbon.
     *
     * @var array
     */
    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];
}