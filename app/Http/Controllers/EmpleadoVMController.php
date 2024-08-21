<?php

namespace App\Http\Controllers;

use App\Models\adelantos;
use App\Models\empleados;
use App\Models\Personas;
use App\Models\roles;
use App\Models\sucursales;
use App\Models\sueldossalarios;
use App\Models\Usuario;
use Illuminate\Http\Request;

class EmpleadoVMController extends Controller
{
    
    public function index()
    {
        $userId = session('usuario')->EmpleadoId; // Obtener el ID del usuario de la sesión

        $empleados = empleados::where('Activo', 1)->where('EmpleadoId', '!=', $userId)->with('rol', 'sucursal', 'sueldo', 'persona')->paginate(10);
        return view('empleados.index', compact('empleados'));
    }

   
    public function create()
    {
        $roles = roles::where('Activo', 1)->get();
        $sucursales = sucursales::where('Activo', 1)->get();
        $sueldos = sueldossalarios::where('Activo', 1)->get();

        return view('empleados.create', compact('roles', 'sucursales', 'sueldos'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validar los datos del formulario
        $request->validate([
            // Validación de campos para persona
            'Ci' => 'required|integer|min:100000,999999999999|unique:personas',
            'Nombres' => 'required|regex:/^[a-zA-Z\s]+$/|min:3|max:100',
            'Apellidos' => 'required|regex:/^[a-zA-Z\s]+$/|min:3|max:100',
            'Direccion' => 'required|string|max:100',
            // Validación de campos para usuario
            'Correo' => 'required|string|email|unique:usuarios',
            'Contrasenia' => 'required|string|min:8|regex:/^(?=.*[a-zA-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]+$/',
            // Validación de campos para empleado
            'FechaNacimiento' => 'required|date|before_or_equal:-15 years|after_or_equal:-100 years',
            'FechaContrato' => 'required|date|before_or_equal:today|after_or_equal:-10 years',
            'RolId' => 'required|exists:roles,RolId',
            'SueldoId' => 'required|exists:sueldossalarios,SueldosId',
            'SucursalId' => 'required|exists:sucursales,SucursalId',
        ], [
            // Mensajes personalizados para cada regla de validación
            'Ci.required' => 'El campo CI es requerido.',
            'Ci.integer' => 'El campo CI debe ser un número entero.',
            'Ci.between' => 'El CI debe tener entre 6 y 12 caracteres.',
            'Ci.unique' => 'El CI ya ha sido registrado.',
        
            'Nombres.required' => 'El campo Nombres es requerido.',
            'Nombres.regex' => 'El campo Nombres solo debe contener letras y espacios.',
            'Nombres.min' => 'El campo Nombres debe tener al menos :min caracteres.',
            'Nombres.max' => 'El campo Nombres no debe tener más de :max caracteres.',
        
            'Apellidos.required' => 'El campo Apellidos es requerido.',
            'Apellidos.regex' => 'El campo Apellidos solo debe contener letras y espacios.',
            'Apellidos.max' => 'El campo Apellidos no debe tener más de :max caracteres.',
            'Apellidos.min' => 'El campo Apellidos no debe tener menos de :min caracteres.',

            'Correo.required' => 'El campo Correo es requerido.',
            'Correo.email' => 'El Correo debe ser una dirección de correo electrónico válida.',
            'Correo.unique' => 'El Correo ya ha sido registrado.',
            'Direccion.required' => 'El campo Direccion es requerido.',
           
            'Contrasenia.required' => 'El campo Contraseña es requerido.',
            'Contrasenia.min' => 'La Contraseña debe tener al menos :min caracteres.',
            'Contrasenia.regex' => 'La Contraseña debe contener al menos una letra, un número y un carácter especial.',
        
            'FechaNacimiento.required' => 'El campo Fecha de Nacimiento es requerido.',
            'FechaNacimiento.date' => 'Ingrese una fecha de nacimiento válida.',
            'FechaNacimiento.before_or_equal' => 'Debe tener al menos 15 años de edad.',
            'FechaNacimiento.after_or_equal' => 'Debe tener como máximo 100 años de edad.',
        
            'FechaContrato.required' => 'El campo Fecha de Contrato es requerido.',
            'FechaContrato.date' => 'Ingrese una fecha de contrato válida.',
            'FechaContrato.before_or_equal' => 'La fecha de contrato no puede ser posterior a la fecha actual.',
            'FechaContrato.after_or_equal' => 'La fecha de contrato debe ser al menos hace 10 años.',
            
            'RolId.required' => 'El campo Rol es requerido.',
            'RolId.exists' => 'Seleccione un rol válido.',
        
            'SueldoId.required' => 'El campo Sueldo es requerido.',
            'SueldoId.exists' => 'Seleccione un sueldo válido.',
        
            'SucursalId.required' => 'El campo Sucursal es requerido.',
            'SucursalId.exists' => 'Seleccione una sucursal válida.',
        ]);
        

        // Crear una nueva persona
        $persona = Personas::create([
            'Ci' => $request->Ci,
            'Nombres' => strtoupper($request->Nombres),
            'Apellidos' => strtoupper($request->Apellidos),
            'Direccion' => strtoupper($request->Direccion),
        ]);
        

        // Crear un nuevo usuario
        $usuario = Usuario::create([
            'Correo' => $request->Correo,
            'Contrasenia' => bcrypt($request->Contrasenia), 
        ]);

        // Crear un nuevo empleado asociado a la persona y usuario creados
        empleados::create([
            'FechaNacimiento' => $request->FechaNacimiento,
            'FechaContrato' => $request->FechaContrato,
            'PersonaId' => $persona->Ci,
            'UsuarioId' => $usuario->Correo,
            'RolId' => $request->RolId,
            'SueldoId' => $request->SueldoId,
            'SucursalId' => $request->SucursalId,
            'Activo' => 1,
        ]);
        
        // Redireccionar a la vista deseada
        return redirect()->route('empleados.index')->with('success', 'Empleado creado correctamente');
    }

    public function show($id)
{
    $empleado = empleados::with('persona', 'usuario', 'rol', 'sueldo', 'sucursal')->findOrFail($id);
    $adelantos = adelantos::where('EmpleadoId', $id)->get();

    return view('empleados.show', compact('empleado', 'adelantos'));
}


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $empleado = empleados::findOrFail($id);
        $roles = roles::where('Activo', 1)->get();
        $sucursales = sucursales::where('Activo', 1)->get();
        $sueldos = sueldossalarios::where('Activo', 1)->get();
        
        return view('empleados.edit', compact('empleado', 'roles', 'sucursales', 'sueldos'));
    }

    

    public function update(Request $request, $id)
{
    // Encuentra el empleado por su ID
    $empleado = empleados::findOrFail($id);

    // Obtén los IDs necesarios para la validación
    $personaId = $empleado->persona->Ci;
    $usuarioId = $empleado->usuario->Correo;

    // Validación de los datos
    $request->validate([
        // Validación de campos para persona
        'Ci' => 'required|integer|between:100000,999999999999|unique:personas,Ci,' . $personaId . ',Ci',
        'Nombres' => 'required|regex:/^[a-zA-Z\s]+$/|min:3|max:100',
        'Apellidos' => 'required|regex:/^[a-zA-Z\s]+$/|min:3|max:100',
        'Direccion' => 'required|string|max:100',
        // Validación de campos para usuario
        'Correo' => 'required|string|email|unique:usuarios,Correo,' . $usuarioId . ',Correo',
        'Contrasenia' => 'required|string|min:8|regex:/^(?=.*[a-zA-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]+$/',
        // Validación de campos para empleado
        'FechaNacimiento' => 'required|date|before_or_equal:-15 years|after_or_equal:-100 years',
        'FechaContrato' => 'required|date|before_or_equal:today|after_or_equal:-10 years',
        'RolId' => 'required|exists:roles,RolId',
        'SueldoId' => 'required|exists:sueldossalarios,SueldosId',
        'SucursalId' => 'required|exists:sucursales,SucursalId',
    ], [
        // Mensajes personalizados para cada regla de validación
        'Ci.required' => 'El campo CI es requerido.',
        'Ci.integer' => 'El campo CI debe ser un número entero.',
        'Ci.between' => 'El CI debe tener entre 6 y 12 caracteres.',
        'Ci.unique' => 'El CI ya ha sido registrado.',
    
        'Nombres.required' => 'El campo Nombres es requerido.',
        'Nombres.regex' => 'El campo Nombres solo debe contener letras y espacios.',
        'Nombres.min' => 'El campo Nombres debe tener al menos :min caracteres.',
        'Nombres.max' => 'El campo Nombres no debe tener más de :max caracteres.',
    
        'Apellidos.required' => 'El campo Apellidos es requerido.',
        'Apellidos.regex' => 'El campo Apellidos solo debe contener letras y espacios.',
        'Apellidos.max' => 'El campo Apellidos no debe tener más de :max caracteres.',
        'Apellidos.min' => 'El campo Apellidos no debe tener menos de :min caracteres.',

        'Correo.required' => 'El campo Correo es requerido.',
        'Correo.email' => 'El Correo debe ser una dirección de correo electrónico válida.',
        'Correo.unique' => 'El Correo ya ha sido registrado.',
        'Direccion.required' => 'El campo Direccion es requerido.',
       
        'Contrasenia.required' => 'El campo Contraseña es requerido.',
        'Contrasenia.min' => 'La Contraseña debe tener al menos :min caracteres.',
        'Contrasenia.regex' => 'La Contraseña debe contener al menos una letra, un número y un carácter especial.',
    
        'FechaNacimiento.required' => 'El campo Fecha de Nacimiento es requerido.',
        'FechaNacimiento.date' => 'Ingrese una fecha de nacimiento válida.',
        'FechaNacimiento.before_or_equal' => 'Debe tener al menos 15 años de edad.',
        'FechaNacimiento.after_or_equal' => 'Debe tener como máximo 100 años de edad.',
    
        'FechaContrato.required' => 'El campo Fecha de Contrato es requerido.',
        'FechaContrato.date' => 'Ingrese una fecha de contrato válida.',
        'FechaContrato.before_or_equal' => 'La fecha de contrato no puede ser posterior a la fecha actual.',
        'FechaContrato.after_or_equal' => 'La fecha de contrato debe ser al menos hace 10 años.',
        
        'RolId.required' => 'El campo Rol es requerido.',
        'RolId.exists' => 'Seleccione un rol válido.',
    
        'SueldoId.required' => 'El campo Sueldo es requerido.',
        'SueldoId.exists' => 'Seleccione un sueldo válido.',
    
        'SucursalId.required' => 'El campo Sucursal es requerido.',
        'SucursalId.exists' => 'Seleccione una sucursal válida.',
    ]);

    // Actualizar la información del empleado
    $empleado->update([
        'FechaNacimiento' => $request->FechaNacimiento,
        'FechaContrato' => $request->FechaContrato,
        'RolId' => $request->RolId,
        'SueldoId' => $request->SueldoId,
        'SucursalId' => $request->SucursalId,
    ]);

    // Actualizar la información de la persona asociada al empleado
    $empleado->persona->update([
        'Ci' => $request->Ci,
        'Nombres' => strtoupper($request->Nombres),
        'Apellidos' => strtoupper($request->Apellidos),
        'Direccion' => strtoupper($request->Direccion),
    ]);

    // Actualizar la información del usuario asociado al empleado
    $empleado->usuario->update([
        'Correo' => $request->Correo,
        'Contrasenia' => bcrypt($request->Contrasenia),
    ]);

    return redirect()->route('empleados.index')->with('success', 'Empleado actualizado correctamente');
}



    public function destroy(string $id)
    {
        $empleado = empleados::findOrFail($id);
        $empleado->Activo = 0;
        $empleado->save();
        return redirect()->route('empleados.index')->with('success', 'Empleado eliminado correctamente.');
    }
   
    public function validarDatos(Request $request)
    {
        $ci = $request->input('Ci');
        $correo = $request->input('Correo');

        // Verificar si el CI existe
        $personaExistente = Personas::where('Ci', $ci)->first();
        if ($personaExistente) {
            return response()->json(['error' => 'El CI ya está registrado.'], 422);
        }

        
        // Verificar si el correo existe
        $usuarioExistente = Usuario::where('Correo', $correo)->first();
        if ($usuarioExistente) {
            return response()->json(['error' => 'El correo electrónico ya está registrado.'], 422);
        }

        // Si no hay problemas, retornar una respuesta exitosa
        return response()->json(['success' => true]);
    }

}

