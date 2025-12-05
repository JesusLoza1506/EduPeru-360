<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PromedioAnual extends Model
{
    protected $table = 'promedios_anuales';

    protected $fillable = [
        'matricula_id',
        'asignacion_curso_id',
        'promedio',
        'aprobado',
    ];

    protected $casts = [
        'promedio' => 'float',
        'aprobado' => 'boolean',
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
