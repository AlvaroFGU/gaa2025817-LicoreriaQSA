<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class marcas extends Model
{
    use HasFactory;
    protected $table = 'marcas';
    protected $primaryKey = 'MarcaId';
    public $timestamps = false;

    protected $fillable = [
        'Nombre',
        'Procedencia',
        'Descripcion',
        'Activo',
    ];

    // Convertir el nombre a mayúsculas antes de guardar en la base de datos
    public function setNombreAttribute($value)
    {
        $this->attributes['Nombre'] = strtoupper($value);
    }

    // Convertir la procedencia a mayúsculas antes de guardar en la base de datos
    public function setPocedenciaAttribute($value)
    {
        $this->attributes['Procedencia'] = strtoupper($value);
    }

    // Convertir la descripción a mayúsculas antes de guardar en la base de datos
    public function setDescripcionAttribute($value)
    {
        $this->attributes['Descripcion'] = strtoupper($value);
    }
}
