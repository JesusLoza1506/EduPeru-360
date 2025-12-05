<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Auditoria extends Model
{
    protected $table = 'auditoria';

    protected $fillable = [
        'user_id',
        'accion',
        'tabla',
        'registro_id',
        'datos',
        'ip',
        'fecha',
    ];

    protected $casts = [
        'datos' => 'array',
        'fecha' => 'datetime',
    ];

    // Relaciones
    public function usuario()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
