<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Medico extends Model
{
    protected $table = 'medicos';
    protected $fillable = ['apellido', 'nro_matricula', 'especialidad', 'horarios_disponibilidad', 'consultorio', 'usuario_id'];
}
