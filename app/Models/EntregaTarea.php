<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EntregaTarea extends Model
{
    protected $table = 'entregas_tareas';

    protected $fillable = [
        'tarea_id',
        'matricula_id',
        'archivo',
        'calificacion',
        'observacion',
        'fecha_entrega',
    ];

    protected $casts = [
        'calificacion' => 'float',
        'fecha_entrega' => 'datetime',
    ];

    // Relaciones
    public function tarea()
    {
        return $this->belongsTo(Tarea::class, 'tarea_id');
    }

    public function matricula()
    {
        return $this->belongsTo(Matricula::class, 'matricula_id');
    }
}
