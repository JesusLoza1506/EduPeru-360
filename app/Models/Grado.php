<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Grado extends Model
{
    protected $table = 'grados';

    protected $fillable = [
        'nivel',
        'grado',
        'seccion',
        'capacidad',
    ];

    // Relaciones
    public function matriculas()
    {
        return $this->hasMany(Matricula::class, 'grado_id');
    }

    public function asignacionesCursos()
    {
        return $this->hasMany(AsignacionCurso::class, 'grado_id');
    }
}
