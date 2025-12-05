<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Horario extends Model
{
    protected $table = 'horarios';

    protected $fillable = [
        'asignacion_curso_id',
        'dia',
        'hora_inicio',
        'hora_fin',
    ];

    // Relaciones
    public function asignacionCurso()
    {
        return $this->belongsTo(AsignacionCurso::class, 'asignacion_curso_id');
    }
}
