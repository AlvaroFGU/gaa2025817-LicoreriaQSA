<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class empleados extends Model
{
    use HasFactory;
    
    protected $primaryKey = 'EmpleadoId';

    protected $fillable = [
        'FechaNacimiento', 'FechaContrato', 'PersonaId', 'UsuarioId', 'RolId', 'SueldoId', 'SucursalId', 'Activo',
    ];

    // Relación con la tabla de personas
    public function persona()
    {
        return $this->belongsTo(Personas::class, 'PersonaId', 'Ci');
    }

    // Relación con la tabla de Usuario
    public function usuario()
    {
        return $this->belongsTo(Usuario::class, 'UsuarioId', 'Correo');
    }

    // Relación con la tabla de roles
    public function rol()
    {
        return $this->belongsTo(roles::class, 'RolId', 'RolId');
    }
    public function sucursal()
    {
        return $this->belongsTo(sucursales::class, 'SucursalId', 'SucursalId');
    }
    public function sueldo()
    {
        return $this->belongsTo(sueldossalarios::class, 'SueldoId', 'SueldosId');
    }
    public $timestamps = false; // Indica si la tabla tiene columnas de timestamps
    public static function rules()
    {
        return [
            'FechaNacimiento' => ['required', 'date', 'before_or_equal:-16 years'],
            'FechaContrato' => ['required', 'date', 'before_or_equal:-10 years'],
        ];
    }

    public static function messages()
    {
        return [
            'FechaNacimiento.required' => 'El campo Fecha de Nacimiento es obligatorio.',
            'FechaNacimiento.date' => 'El campo Fecha de Nacimiento debe ser una fecha válida.',
            'FechaNacimiento.before_or_equal' => 'El empleado debe tener al menos 16 años de edad.',
            'FechaContrato.required' => 'El campo Fecha de Contrato es obligatorio.',
            'FechaContrato.date' => 'El campo Fecha de Contrato debe ser una fecha válida.',
            'FechaContrato.before_or_equal' => 'La fecha de contratación debe ser como máximo hace 10 años.',
        ];
    }
}

