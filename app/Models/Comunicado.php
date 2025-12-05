<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comunicado extends Model
{
    protected $table = 'comunicados';

    protected $fillable = [
        'emisor_id',
        'titulo',
        'contenido',
        'tipo_destinatario',
        'grado_id',
        'archivo',
        'fecha_envio',
    ];

    protected $casts = [
        'fecha_envio' => 'datetime',
    ];

    // Relaciones
    public function emisor()
    {
        return $this->belongsTo(User::class, 'emisor_id');
    }

    public function grado()
    {
        return $this->belongsTo(Grado::class, 'grado_id');
    }
}
