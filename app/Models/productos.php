<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class productos extends Model
{
    use HasFactory;
    protected $table = 'productos';

    protected $primaryKey = 'ProductoId';
    public $timestamps = false;
    protected $fillable = [
        'Nombre',
        'Precio',
        'Descripcion',
        'Modelo',
        'MarcaId',
        'Cantidad',
        'Activo',
        'ImagenUrl'
    ];

    public function inventarios()
    {
        return $this->hasMany(inventarios::class, 'ProductoId');
    }
    
    public function marca()
    {
        return $this->belongsTo(marcas::class, 'MarcaId', 'MarcaId');
    }
}
