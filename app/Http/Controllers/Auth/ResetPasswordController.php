<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\Usuario; // Asegúrate de importar el modelo de usuarios adecuadamente

class ResetPasswordController extends Controller
{
    public function showResetForm()
    {
        return view('passwords.reset');
    }

    public function reset(Request $request)
    {
        // Validaciones
        $request->validate([
            'email' => 'required|email',
            'seguridad' => 'required|digits:4',
            'password' => 'required|string|min:8|confirmed|regex:/[a-z]/|regex:/[A-Z]/|regex:/[0-9]/|regex:/[@$!%*?&]/',
        ]);

        // Buscar al usuario por el correo y validar el código de seguridad
        $usuario = Usuario::where('Correo', $request->email)
                          ->where('CodigoSeguridad', $request->seguridad)
                          ->first();

        if (!$usuario) {
            return back()->withErrors(['seguridad' => 'El código de seguridad o correo electrónico no es válido.']);
        }

        // Actualizar la contraseña del usuario
        $usuario->Contrasenia = Hash::make($request->password);
        $usuario->CodigoSeguridad = null; // Limpiar el código de seguridad después de usarlo
        $usuario->save();

        // Redirigir al usuario a una página de confirmación o inicio de sesión
        return redirect('/login')->with('success', 'Contraseña restablecida correctamente. Inicie sesión con su nueva contraseña.');
    }
}
