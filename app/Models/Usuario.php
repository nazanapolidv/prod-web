<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Usuario extends Authenticatable
{
    use Notifiable;
    use HasFactory;

    protected $table = 'usuarios';

    protected $fillable = [
        'nombre',
        'apellido',
        'tipo_doc',
        'documento',
        'genero',
        'fecha_nac',
        'telefono',
        'email',
        'password',
        'rol',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
        'fecha_nac' => 'date',
    ];

    public function getNameAttribute()
    {
        return $this->nombre;
    }

    public function medico()
    {
        return $this->hasOne(Medico::class, 'usuario_id');
    }
    public function hasRole($rol)
    {
        return $this->rol === $rol;
    }
}
