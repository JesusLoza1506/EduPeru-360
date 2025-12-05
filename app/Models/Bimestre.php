<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Bimestre extends Model
{
    protected $table = 'bimestres';

    protected $fillable = [
        'ano_escolar_id',
        'numero',
        'fecha_inicio',
        'fecha_fin',
    ];

    protected $casts = [
        'fecha_inicio' => 'date',
        'fecha_fin' => 'date',
    ];

    // Relaciones
    public function anoEscolar()
    {
        return $this->belongsTo(AnoEscolar::class, 'ano_escolar_id');
    }
}
