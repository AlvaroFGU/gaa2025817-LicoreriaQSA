<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class adelantos extends Model
{
    use HasFactory;
    protected $table = 'adelantos';
    protected $primaryKey = 'AdelantoId';
    public $timestamps = false; 

    protected $fillable = [
        'Fecha',
        'Monto',
        'EmpleadoId',
        'Activo'
    ];

    public function empleado()
    {
        return $this->belongsTo(empleados::class, 'EmpleadoId', 'EmpleadoId');
    }
}
