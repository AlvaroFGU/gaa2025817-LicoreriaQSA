<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class inventarios extends Model
{
    use HasFactory;
    protected $primaryKey = 'InventarioId';
    public $timestamps = false;
    protected $fillable = [
        'ProductoId',
        'SucursalId',
        'Cantidad',
        'Activo'
    ];

    public function producto()
    {
        return $this->belongsTo(productos::class, 'ProductoId');
    }

    public function sucursal()
    {
        return $this->belongsTo(sucursales::class, 'SucursalId');
    }
}
