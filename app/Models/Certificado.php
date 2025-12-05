<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Certificado extends Model
{
    protected $table = 'certificados';

    protected $fillable = [
        'matricula_id',
        'tipo',
        'archivo_pdf',
        'codigo_verificacion',
        'fecha_generacion',
    ];

    protected $casts = [
        'fecha_generacion' => 'date',
    ];

    // Relaciones
    public function matricula()
    {
        return $this->belongsTo(Matricula::class, 'matricula_id');
    }
}
