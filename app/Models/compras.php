<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class compras extends Model
{
    use HasFactory;
    protected $table = 'compras';
    protected $primaryKey = 'CompraId';
    public $timestamps = false; 

    protected $fillable = [
        'Fecha',
        'MontoTotal',
        'MontoPagado',
        'ProveedorId',
        'EmpleadoId',
        'Activo'
    ];

    public function proveedor()
    {
        return $this->belongsTo(proveedores::class, 'ProveedorId', 'ProveedorId');
    }

    public function empleado()
    {
        return $this->belongsTo(empleados::class, 'EmpleadoId', 'EmpleadoId');
    }
}
