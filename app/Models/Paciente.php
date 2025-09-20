<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Paciente extends Model
{
    protected $table = 'pacientes';

    protected $fillable = [
        'usuario_id', 'nombre', 'apellido', 'tipo_documento', 'nro_documento', 'genero', 'fecha_nacimiento', 'telefono_linea', 'celular'
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'usuario_id');
    }

    public function turnos(): HasMany
    {
        return $this->hasMany(Turno::class, 'paciente_id');
    }
}
