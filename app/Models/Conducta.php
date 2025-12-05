<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Conducta extends Model
{
    protected $table = 'conducta';

    protected $fillable = [
        'matricula_id',
        'docente_id',
        'tipo',
        'descripcion',
        'fecha',
    ];

    protected $casts = [
        'fecha' => 'date',
    ];

    // Relaciones
    public function matricula()
    {
        return $this->belongsTo(Matricula::class, 'matricula_id');
    }

    public function docente()
    {
        return $this->belongsTo(User::class, 'docente_id');
    }
}
