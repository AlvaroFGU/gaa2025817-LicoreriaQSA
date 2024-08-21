<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\Usuario;
use App\Models\empleados;

use Illuminate\Support\Facades\Session;


class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('login');
    }

    public function login(Request $request)
    {
        // Validar el formulario de inicio de sesión
        $request->validate([
            'Correo' => 'required|email',
            'Contrasenia' => 'required',
        ]);

        // Obtener las credenciales del formulario
        $credentials = $request->only('Correo', 'Contrasenia');
        
        // Intentar autenticar al usuario con las credenciales proporcionadas
        $user = Usuario::where('Correo', $credentials['Correo'])->first();
        if ($user && Hash::check($credentials['Contrasenia'], $user->Contrasenia)) {
            Auth::login($user);
            $empleado = empleados::where('UsuarioId', $credentials['Correo'])->first();
            Session::put('usuario', $empleado);
            return redirect()->intended('inicio');
        } else {
            return back()->withErrors([
                'Correo' => 'Las credenciales no coinciden con nuestros registros. Intente nuevamente',
            ]);
        }
    }
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
}
