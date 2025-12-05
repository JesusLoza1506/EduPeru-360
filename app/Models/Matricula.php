<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Matricula extends Model
{
    protected $table = 'matriculas';

    protected $fillable = [
        'estudiante_id',
        'grado_id',
        'ano_escolar_id',
        'fecha_matricula',
        'estado',
        'ficha_pdf',
    ];

    protected $casts = [
        'fecha_matricula' => 'date',
    ];

    // Relaciones
    public function estudiante()
    {
        return $this->belongsTo(Estudiante::class, 'estudiante_id');
    }

    public function grado()
    {
        return $this->belongsTo(Grado::class, 'grado_id');
    }

    public function anoEscolar()
    {
        return $this->belongsTo(AnoEscolar::class, 'ano_escolar_id');
    }
}
