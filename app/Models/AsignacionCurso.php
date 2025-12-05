<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AsignacionCurso extends Model
{
    protected $table = 'asignacion_cursos';

    protected $fillable = [
        'curso_id',
        'grado_id',
        'docente_id',
        'ano_escolar_id',
    ];

    // Relaciones
    public function curso()
    {
        return $this->belongsTo(Curso::class, 'curso_id');
    }

    public function grado()
    {
        return $this->belongsTo(Grado::class, 'grado_id');
    }

    public function docente()
    {
        return $this->belongsTo(User::class, 'docente_id');
    }

    public function anoEscolar()
    {
        return $this->belongsTo(AnoEscolar::class, 'ano_escolar_id');
    }

    public function horarios()
    {
        return $this->hasMany(Horario::class, 'asignacion_curso_id');
    }
}
