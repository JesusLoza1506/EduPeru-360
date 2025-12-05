<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Backup extends Model
{
    protected $table = 'backups';

    protected $fillable = [
        'archivo',
        'tamaño_mb',
        'tipo',
        'fecha',
    ];

    protected $casts = [
        'tamaño_mb' => 'float',
        'fecha' => 'datetime',
    ];
}
