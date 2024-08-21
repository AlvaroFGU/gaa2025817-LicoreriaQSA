<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class detalleCompras extends Model
{
    use HasFactory;
    protected $table = 'detallecompra';
    protected $primaryKey = 'DetalleId';
    public $incrementing = true;
    public $timestamps = false; 

    protected $fillable = [
        'CompraId',
        'ProductoId',
        'Cantidad',
        'Activo'
    ];

    public function compra()
    {
        return $this->belongsTo(compras::class, 'CompraId', 'CompraId');
    }

    public function producto()
    {
        return $this->belongsTo(productos::class, 'ProductoId', 'ProductoId');
    }
}
