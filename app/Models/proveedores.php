<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class proveedores extends Model
{
    use HasFactory;
    protected $table = 'proveedores';
    protected $primaryKey = 'ProveedorId';
    public $timestamps = false;

    protected $fillable = [
        'Telefono',
        'Correo',
        'PersonaId',
        'Activo',
    ];

    public function persona()
    {
        return $this->belongsTo(Personas::class, 'PersonaId', 'Ci');
    }
}
