<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Medico extends Model
{
    use HasFactory;
    
    protected $table = 'medicos';
    
    protected $fillable = [
        'apellido',
        'especialidad',
        'nro_matricula',
        'consultorio',
        'horarios_disponibilidad',
    ];

    protected $casts = [
        'horarios_disponibilidad' => 'array',
    ];

    public function turnos()
    {
        return $this->hasMany(Turno::class);
    }
}