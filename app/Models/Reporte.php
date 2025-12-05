<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reporte extends Model
{
    protected $table = 'reportes';

    protected $fillable = [
        'tipo',
        'filtros',
        'archivo',
        'fecha_generacion',
    ];

    protected $casts = [
        'filtros' => 'array',
        'fecha_generacion' => 'date',
    ];

    // Opcional: definir constantes para los tipos de reporte
    public const TIPO_NOTAS = 'Notas';
    public const TIPO_ASISTENCIA = 'Asistencia';
    public const TIPO_MATRICULA = 'Matrícula';
    public const TIPO_COMPORTAMIENTO = 'Comportamiento';
}
