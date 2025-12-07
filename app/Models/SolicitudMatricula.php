<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SolicitudMatricula extends Model
{
    protected $table = 'solicitudes_matricula';

    protected $fillable = [
        'padre_id',
        'nombre_estudiante',
        'apellido_estudiante',
        'dni_estudiante',
        'grado_id',
        'ano_escolar_id',
        'fecha_solicitud',
        'monto_matricula',
        'monto_mensualidad',
        'comprobante_pago',
        'comprobante_yape',
        'nro_operacion_yape',
        'estado',
        'observaciones',
        'fecha_revision',
    ];

    // Relaciones
    public function padre()
    {
        return $this->belongsTo(User::class, 'padre_id');
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
