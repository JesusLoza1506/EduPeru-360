<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Recuperacion extends Model
{
    protected $table = 'recuperaciones';

    protected $fillable = [
        'matricula_id',
        'asignacion_curso_id',
        'nota_original',
        'nota_recuperacion',
        'fecha',
        'aprobado_final',
    ];

    protected $casts = [
        'nota_original' => 'float',
        'nota_recuperacion' => 'float',
        'fecha' => 'date',
        'aprobado_final' => 'boolean',
    ];

    public function matricula()
    {
        return $this->belongsTo(Matricula::class);
    }

    public function asignacionCurso()
    {
        return $this->belongsTo(AsignacionCurso::class);
    }
}
