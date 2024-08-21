<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Personas extends Model
{
    use HasFactory;
    protected $table = 'personas'; // Nombre de la tabla

    protected $primaryKey = 'Ci'; // Clave primaria

    public $incrementing = false; // Indica si la clave primaria es autoincremental

    protected $keyType = 'int'; // Tipo de dato de la clave primaria

    public $timestamps = false; // Indica si la tabla tiene columnas de timestamps

    protected $fillable = [
        'Ci',
        'Nombres',
        'Apellidos',
        'Direccion',
        'Activo',
    ];
    public static function rules()
    {
        return [
            'Ci' => 'required|numeric|digits_between:6,11',
            'Nombres' => 'required|alpha',
            'Apellidos' => 'required|alpha',
            'Direccion' => 'required',
        ];
    }

    public static function messages()
    {
        return [
            'Ci.required' => 'El campo CI es obligatorio.',
            'Ci.numeric' => 'El campo CI debe ser numérico.',
            'Ci.digits_between' => 'El campo CI debe tener entre :min y :max dígitos.',
            'Nombres.required' => 'El campo Nombres es obligatorio.',
            'Nombres.alpha' => 'El campo Nombres solo debe contener letras.',
            'Apellidos.required' => 'El campo Apellidos es obligatorio.',
            'Apellidos.alpha' => 'El campo Apellidos solo debe contener letras.',
            'Direccion.required' => 'El campo Dirección es obligatorio.',
        ];
    }
}
