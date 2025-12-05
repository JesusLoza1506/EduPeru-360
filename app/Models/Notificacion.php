<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Notificacion extends Model
{
    protected $table = 'notificaciones';

    protected $fillable = [
        'comunicado_id',
        'receptor_id',
        'leido',
        'fecha_leido',
    ];

    protected $casts = [
        'leido' => 'boolean',
        'fecha_leido' => 'datetime',
    ];

    // Relaciones
    public function comunicado()
    {
        return $this->belongsTo(Comunicado::class, 'comunicado_id');
    }

    public function receptor()
    {
        return $this->belongsTo(User::class, 'receptor_id');
    }
}
