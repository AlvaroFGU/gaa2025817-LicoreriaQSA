<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Usuario extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $table = 'usuarios';
    protected $primaryKey = 'Correo';
    public $incrementing = false;
    protected $keyType = 'string';
    public $timestamps = false;

    protected $fillable = [
        'Correo',
        'Contrasenia',
        'Activo',
    ];

    protected $hidden = [
        'Contrasenia',
        'remember_token',
    ];
    public static function rules()
    {
        return [
            'Correo' => ['required', 'email'],
            'Contrasenia' => ['required', 'string', 'min:8', 'regex:/^(?=.*[a-zA-Z])(?=.*\d)(?=.*[\W_]).{8,}$/'],
        ];
    }
    public function empleado()
    {
        return $this->hasOne(empleados::class, 'UsuarioId', 'Correo');
    }
    public static function messages()
    {
        return [
            'Correo.required' => 'El campo Correo es obligatorio.',
            'Correo.email' => 'El campo Correo debe ser una dirección de correo electrónico válida.',
            'Contrasenia.required' => 'El campo Contraseña es obligatorio.',
            'Contrasenia.string' => 'El campo Contraseña debe ser una cadena de caracteres.',
            'Contrasenia.min' => 'El campo Contraseña debe tener al menos :min caracteres.',
            'Contrasenia.regex' => 'El campo Contraseña debe contener al menos una letra, un número y un carácter especial.',
        ];
    }
}
