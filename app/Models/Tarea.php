<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tarea extends Model
{
    protected $table = 'tareas';

    protected $fillable = [
        'asignacion_curso_id',
        'titulo',
        'descripcion',
        'fecha_entrega',
        'archivo_adjunto',
    ];

    protected $casts = [
        'fecha_entrega' => 'date',
    ];

    public function asignacionCurso()
    {
        return $this->belongsTo(AsignacionCurso::class);
    }
}
