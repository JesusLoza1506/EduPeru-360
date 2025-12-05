<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Material extends Model
{
    protected $table = 'materiales';

    protected $fillable = [
        'asignacion_curso_id',
        'titulo',
        'descripcion',
        'archivo',
        'fecha_publicacion',
    ];

    protected $casts = [
        'fecha_publicacion' => 'date',
    ];

    // Relaciones
    public function asignacionCurso()
    {
        return $this->belongsTo(AsignacionCurso::class, 'asignacion_curso_id');
    }
}
