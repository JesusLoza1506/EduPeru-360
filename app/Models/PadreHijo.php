<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PadreHijo extends Model
{
    protected $table = 'padre_hijo';
    public $incrementing = false;
    protected $primaryKey = ['padre_id', 'estudiante_id'];

    protected $fillable = [
        'padre_id',
        'estudiante_id',
        'parentesco',
    ];

    // Relaciones
    public function padre()
    {
        return $this->belongsTo(User::class, 'padre_id');
    }

    public function estudiante()
    {
        return $this->belongsTo(User::class, 'estudiante_id');
    }
}
