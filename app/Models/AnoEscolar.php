<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AnoEscolar extends Model
{
    protected $table = 'anos_escolares';

    protected $fillable = [
        'ano',
        'fecha_inicio',
        'fecha_fin',
        'activo',
    ];

    protected $casts = [
        'activo' => 'boolean',
        'fecha_inicio' => 'date',
        'fecha_fin' => 'date',
    ];

    // Relaciones
    public function bimestres()
    {
        return $this->hasMany(Bimestre::class, 'ano_escolar_id');
    }

    public function matriculas()
    {
        return $this->hasMany(Matricula::class, 'ano_escolar_id');
    }

    public function asignacionesCursos()
    {
        return $this->hasMany(AsignacionCurso::class, 'ano_escolar_id');
    }
}
