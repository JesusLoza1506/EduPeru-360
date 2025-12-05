<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Asistencia extends Model
{
    protected $table = 'asistencias';

    protected $fillable = [
        'matricula_id',
        'asignacion_curso_id',
        'fecha',
        'estado',
        'observacion',
    ];

    protected $casts = [
        'fecha' => 'date',
    ];

    // Relaciones
    public function matricula()
    {
        return $this->belongsTo(Matricula::class, 'matricula_id');
    }

    public function asignacionCurso()
    {
        return $this->belongsTo(AsignacionCurso::class, 'asignacion_curso_id');
    }
}
