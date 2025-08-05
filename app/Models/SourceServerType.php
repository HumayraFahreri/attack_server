<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SourceServerType extends Model
{
    use HasFactory;
    protected $table = 'source_server_types';

    protected $fillable = [
        'name',
        'description',
        'is_custom',
    ];

    protected $casts = [
        'is_custom' => 'boolean',
    ];
}
