<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Curso extends Model
{
    protected $table = 'cursos';

    protected $fillable = [
        'nombre',
        'area_curricular',
    ];

    // Relaciones
    public function asignacionesCursos()
    {
        return $this->hasMany(AsignacionCurso::class, 'curso_id');
    }
}
