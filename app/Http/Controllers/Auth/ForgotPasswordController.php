<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Models\Usuario; // Asegúrate de importar el modelo de usuarios adecuadamente

class ForgotPasswordController extends Controller
{
    use SendsPasswordResetEmails;

    public function showLinkRequestForm()
    {
        return view('passwords.email');
    }

    public function sendResetLinkEmail(Request $request)
    {
        $request->validate(['email' => 'required|email']);

        // Busca el usuario por el correo en la tabla 'usuarios'
        $usuario = Usuario::where('Correo', $request->email)->first();

        if (!$usuario) {
            return back()->withErrors(['email' => 'El correo electrónico ingresado no está registrado.']);
        }

        // Genera un número aleatorio de 4 dígitos
        $numeroAleatorio = mt_rand(1000, 9999);

        // Guarda el mismo número aleatorio en la columna 'CodigoSeguridad' del usuario
        $usuario->CodigoSeguridad = $numeroAleatorio;
        $usuario->save();

        // Construye el mensaje que incluye el número aleatorio
        $mensaje = "Es hora del rockanroll\nTu código de seguridad: $numeroAleatorio";

        // Envía el mensaje solo si se encontró el usuario
        Mail::raw($mensaje, function($message) use ($usuario) {
            $message->to($usuario->Correo)->subject('Mensaje importante');
        });

        // Redirige al usuario a la vista de reseteo de contraseña
        return view('passwords.reset')->with(['email' => $usuario->Correo]);
    }
}
