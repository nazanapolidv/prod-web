<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Empleado extends Model
{
    use HasFactory;

    protected $table = 'empleados';

    protected $fillable = [
        'nombre',
        'apellido',
        'documento',
        'telefono',
        'email',
        'tipo_empleado',
        'fecha_ingreso',
        'fecha_egreso',
        'activo',
        'nro_matricula',
        'especialidad',
        'observaciones',
    ];

    protected $casts = [
        'fecha_ingreso' => 'date',
        'fecha_egreso' => 'date',
        'activo' => 'boolean',
    ];

    /**
     * Scope para obtener solo empleados activos
     */
    public function scopeActivos($query)
    {
        return $query->where('activo', true);
    }

    /**
     * Scope para obtener solo empleados inactivos
     */
    public function scopeInactivos($query)
    {
        return $query->where('activo', false);
    }

    /**
     * Scope para filtrar por tipo de empleado
     */
    public function scopePorTipo($query, $tipo)
    {
        return $query->where('tipo_empleado', $tipo);
    }

    /**
     * Accessor para obtener el estado laboral
     */
    public function getEstadoLaboralAttribute()
    {
        return $this->activo ? 'Activo' : 'Inactivo';
    }
}
