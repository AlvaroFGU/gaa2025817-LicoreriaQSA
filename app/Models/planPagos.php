<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class planPagos extends Model
{
    use HasFactory;
    protected $table = 'planpagos';
    protected $primaryKey = 'PagosId';
    public $incrementing = true;
    public $timestamps = false; 

    protected $fillable = [
        'Fecha',
        'Monto',
        'CompraId',
        'Activo'
    ];

    public function compra()
    {
        return $this->belongsTo(compras::class, 'CompraId', 'CompraId');
    }
}
