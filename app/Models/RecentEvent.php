<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    protected $table = 'events';

    protected $fillable = [
        'title',        
        'description',  // Detail event
        'event_type',   // info, warning, error
        'status',       // success, failed
        'occurred_at'   // Waktu event
    ];

    public $timestamps = false; 

    protected $casts = [
        'occurred_at' => 'datetime'
    ];
}
