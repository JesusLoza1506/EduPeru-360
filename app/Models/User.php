<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use Notifiable;

    /**
     * Los atributos que se pueden asignar masivamente.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'nombre',
        'apellido',
        'dni',
        'email',
        'password',
        'telefono',
        'rol',
        'activo',
        'email_verified_at',
    ];

    /**
     * Los atributos que deben estar ocultos para la serialización.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Los atributos que deben ser convertidos a tipos nativos.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'activo' => 'boolean',
        'email_verified_at' => 'datetime',
    ];

    // Constantes de roles
    public const ROL_ADMIN = 'Administrador General';
    public const ROL_DIRECTOR = 'Director';
    public const ROL_DOCENTE = 'Docente';
    public const ROL_ESTUDIANTE = 'Estudiante';
    public const ROL_PADRE = 'Padre';

    // Relaciones
    public function estudiante()
    {
        return $this->hasOne(Estudiante::class, 'user_id');
    }

    public function comunicadosEmitidos()
    {
        return $this->hasMany(Comunicado::class, 'emisor_id');
    }

    public function auditorias()
    {
        return $this->hasMany(Auditoria::class, 'user_id');
    }

    public function asignacionesDocente()
    {
        return $this->hasMany(AsignacionCurso::class, 'docente_id');
    }

    public function hijos()
    {
        return $this->belongsToMany(User::class, 'padre_hijo', 'padre_id', 'estudiante_id');
    }

    // Relación inversa: obtener los padres de un estudiante
    public function padres()
    {
        return $this->belongsToMany(User::class, 'padre_hijo', 'estudiante_id', 'padre_id');
    }
}
