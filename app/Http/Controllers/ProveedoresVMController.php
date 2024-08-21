<?php

namespace App\Http\Controllers;

use App\Models\Personas;
use App\Models\proveedores;
use Illuminate\Http\Request;

class ProveedoresVMController extends Controller
{
    public function index()
    {
        $proveedores = proveedores::where('Activo', 1)->paginate(10);
        return view('proveedores.index', compact('proveedores'));
    }

    public function create()
    {
        return view('proveedores.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'Ci' => 'required|integer|min:100000,999999999999|unique:personas',
            'Nombres' => 'required|regex:/^[a-zA-Z\s]+$/|min:3|max:100',
            'Apellidos' => 'required|regex:/^[a-zA-Z\s]+$/|min:3|max:100',
            'Direccion' => 'required|string|max:100',
            'Telefono' => 'required|string|max:50',
            'Correo' => 'required|string|email|max:100|unique:proveedores,Correo',
        ], [
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
            'Direccion.required' => 'El campo Dirección es requerido.',
            'Direccion.string' => 'El campo Dirección debe ser una cadena de texto.',
            'Direccion.max' => 'El campo Dirección no debe tener más de 255 caracteres.',
            'Telefono.required' => 'El campo Teléfono es requerido.',
            'Telefono.string' => 'El campo Teléfono debe ser una cadena de texto.',
            'Telefono.max' => 'El campo Teléfono no debe tener más de 50 caracteres.',
            'Correo.required' => 'El campo Correo es requerido.',
            'Correo.email' => 'El campo Correo debe ser una dirección de correo electrónico válida.',
            'Correo.max' => 'El campo Correo no debe tener más de 100 caracteres.',
            'Correo.unique' => 'El campo Correo ya ha sido registrado.',
        ]);

        $persona = new Personas();
        $persona->Ci = $request->Ci;
        $persona->Nombres = strtoupper($request->Nombres);
        $persona->Apellidos = strtoupper($request->Apellidos);
        $persona->Direccion = strtoupper($request->Direccion);
        $persona->save();

        $proveedor = new proveedores();
        $proveedor->Telefono = $request->Telefono;
        $proveedor->Correo = $request->Correo;
        $proveedor->PersonaId = $persona->Ci;
        $proveedor->save();

        return redirect()->route('proveedores.index')->with('success', 'Proveedor creado exitosamente.');
    }

    public function show($id)
    {
        $proveedor = proveedores::with('persona')->findOrFail($id);
        return view('proveedores.show', compact('proveedor'));
    }

    public function edit($id)
    {
        $proveedor = proveedores::with('persona')->findOrFail($id);
        return view('proveedores.edit', compact('proveedor'));
    }

    public function update(Request $request, $id)
    {
        $proveedor = proveedores::findOrFail($id);
        $persona = Personas::findOrFail($proveedor->PersonaId);

        $request->validate([
            'Ci' => 'required|integer|min:100000|unique:personas,Ci,' . $persona->Ci . ',Ci',
            'Nombres' => 'required|string|min:3|max:100|regex:/^[a-zA-Z\s]+$/',
            'Apellidos' => 'required|string|min:3|max:100|regex:/^[a-zA-Z\s]+$/',
            'Direccion' => 'required|string|max:255',
            'Telefono' => 'required|string|max:50',
            'Correo' => 'required|string|email|max:100|unique:proveedores,Correo,' . $proveedor->ProveedorId . ',ProveedorId',
        ], [
            'Ci.required' => 'El campo CI es requerido.',
            'Ci.integer' => 'El campo CI debe ser un número entero.',
            'Ci.min' => 'El CI debe tener al menos 6 caracteres.',
            'Ci.unique' => 'El CI ya ha sido registrado.',
            'Nombres.required' => 'El campo Nombres es requerido.',
            'Nombres.string' => 'El campo Nombres debe ser una cadena de texto.',
            'Nombres.min' => 'El campo Nombres debe tener al menos 3 caracteres.',
            'Nombres.max' => 'El campo Nombres no debe tener más de 100 caracteres.',
            'Nombres.regex' => 'El campo Nombres solo debe contener letras y espacios.',
            'Apellidos.required' => 'El campo Apellidos es requerido.',
            'Apellidos.string' => 'El campo Apellidos debe ser una cadena de texto.',
            'Apellidos.min' => 'El campo Apellidos debe tener al menos 3 caracteres.',
            'Apellidos.max' => 'El campo Apellidos no debe tener más de 100 caracteres.',
            'Apellidos.regex' => 'El campo Apellidos solo debe contener letras y espacios.',
            'Direccion.required' => 'El campo Dirección es requerido.',
            'Direccion.string' => 'El campo Dirección debe ser una cadena de texto.',
            'Direccion.max' => 'El campo Dirección no debe tener más de 255 caracteres.',
            'Telefono.required' => 'El campo Teléfono es requerido.',
            'Telefono.string' => 'El campo Teléfono debe ser una cadena de texto.',
            'Telefono.max' => 'El campo Teléfono no debe tener más de 50 caracteres.',
            'Correo.required' => 'El campo Correo es requerido.',
            'Correo.email' => 'El campo Correo debe ser una dirección de correo electrónico válida.',
            'Correo.max' => 'El campo Correo no debe tener más de 100 caracteres.',
            'Correo.unique' => 'El campo Correo ya ha sido registrado.',
        ]);

        $persona->Ci = $request->Ci;
        $persona->Nombres = strtoupper($request->Nombres);
        $persona->Apellidos = strtoupper($request->Apellidos);
        $persona->Direccion = strtoupper($request->Direccion);
        $persona->save();

        $proveedor->Telefono = $request->Telefono;
        $proveedor->Correo = $request->Correo;
        $proveedor->save();

        return redirect()->route('proveedores.index')->with('success', 'Proveedor actualizado exitosamente.');
    }

    public function destroy($id)
    {
        $proveedor = proveedores::findOrFail($id);
        $proveedor->Activo = 0;
        $proveedor->save();

        return redirect()->route('proveedores.index')->with('success', 'Proveedor eliminado exitosamente.');
    }

}