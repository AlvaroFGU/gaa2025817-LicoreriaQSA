<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class sueldossalarios extends Model
{
    use HasFactory;
    protected $table = 'sueldossalarios';

    protected $primaryKey = 'SueldosId';
    public $timestamps = false; // Indica si la tabla tiene columnas de timestamps

    protected $fillable = [
        'Cargo',
        'Monto',
        'Activo',
    ];
    public static function rules()
    {
        return [
            'Cargo' => ['required', 'string', 'regex:/^[A-Za-z\s]+$/'],
            'Monto' => ['required', 'numeric', 'min:0'],
        ];
    }

    public static function messages()
    {
        return [
            'Cargo.required' => 'El campo Cargo es obligatorio.',
            'Cargo.string' => 'El campo Cargo debe ser una cadena de caracteres.',
            'Cargo.regex' => 'El campo Cargo solo puede contener letras y espacios.',
            'Monto.required' => 'El campo Monto es obligatorio.',
            'Monto.numeric' => 'El campo Monto debe ser un número.',
            'Monto.min' => 'El campo Monto debe ser un valor positivo.',
        ];
    }
}
