<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class sucursales extends Model
{
    use HasFactory;
    protected $table = 'sucursales';

    protected $primaryKey = 'SucursalId';

    protected $fillable = [
        'Nombre',
        'Direccion',
        'Activo',
    ];

    public $timestamps = false; // Desactivar marcas de tiempo automáticas
}
