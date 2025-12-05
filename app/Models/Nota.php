<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Nota extends Model
{
    protected $table = 'notas';

    protected $fillable = [
        'matricula_id',
        'asignacion_curso_id',
        'bimestre_id',
        'nota',
        'competencias',
    ];

    protected $casts = [
        'nota' => 'float',
        'competencias' => 'array',
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

    public function bimestre()
    {
        return $this->belongsTo(Bimestre::class, 'bimestre_id');
    }
}
