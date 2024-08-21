<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class roles extends Model
{
    use HasFactory;
    protected $table = 'roles';

    protected $primaryKey = 'RolId';

    protected $fillable = [
        'Nombre',
        'Descripcion',
        'Permisos',
        'Activo',
    ];

    public $timestamps = false; // Desactivar marcas de tiempo automáticas
}
