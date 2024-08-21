<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class transacciones extends Model
{
    use HasFactory;
    protected $table = 'transacciones';
    protected $primaryKey = 'TransaccionId';
    public $timestamps = false;

    protected $fillable = [
        'Fecha',
        'ProductoId',
        'EmpleadoId',
        'Cantidad',
        'Activo',
        'SucursalId'
    ];

    public function producto()
    {
        return $this->belongsTo(Productos::class, 'ProductoId', 'ProductoId');
    }

    public function empleado()
    {
        return $this->belongsTo(Empleados::class, 'EmpleadoId', 'EmpleadoId');
    }

    public function sucursal()
    {
        return $this->belongsTo(Sucursales::class, 'SucursalId', 'SucursalId');
    }
}
