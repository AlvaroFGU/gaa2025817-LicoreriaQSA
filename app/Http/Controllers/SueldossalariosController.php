<?php

namespace App\Http\Controllers;

use App\Models\sueldossalarios;
use Illuminate\Http\Request;

class SueldossalariosController extends Controller
{
    public function index()
    {
        $sueldossalarios = sueldossalarios::where('activo', 1)->paginate(10);
        return view('sueldossalarios.index', compact('sueldossalarios'));
    }


    public function create()
    {
        return view('sueldossalarios.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'Cargo' => 'required|string|min:3|max:255|unique:sueldossalarios,Cargo',
            'Monto' => 'required|numeric|min:0|max:999999.99',
        ], [
            'Cargo.required' => 'El campo Cargo es requerido.',
            'Cargo.string' => 'El campo Cargo debe ser una cadena de texto.',
            'Cargo.min' => 'El campo Cargo debe tener al menos :min caracteres.',
            'Cargo.max' => 'El campo Cargo no debe exceder los :max caracteres.',
            'Cargo.unique' => 'El Cargo ingresado ya existe en la tabla de sueldossalarios.',
            'Monto.required' => 'El campo Monto es requerido.',
            'Monto.numeric' => 'El campo Monto debe ser numérico.',
            'Monto.min' => 'El campo Monto debe ser mayor que cero.',
            'Monto.max' => 'El campo Monto no debe exceder los :max dígitos.',
        ]);

        $requestData = $request->all();
        $requestData['Cargo'] = strtoupper($request->Cargo);
        $requestData['activo'] = 1; // Asignar activo por defecto al crear un nuevo sueldo

        // Crear el registro de sueldo con los datos modificados
        sueldossalarios::create($requestData);

        return redirect()->route('sueldossalarios.index')->with('success', 'Sueldo creado correctamente.');
    }

    public function show($id)
    {
        $sueldossalario = sueldossalarios::findOrFail($id);
        return view('sueldossalarios.show', compact('sueldossalario'));
    }

    public function edit($id)
    {
        $sueldossalario = sueldossalarios::findOrFail($id);
        return view('sueldossalarios.edit', compact('sueldossalario'));
    }

    public function update(Request $request, $id)
    {
        // Encontrar el sueldo por su ID
        $sueldossalario = sueldossalarios::findOrFail($id);

        $request->validate([
            'Cargo' => 'required|string|min:3|max:255|unique:sueldossalarios,Cargo,' . $id . ',SueldosId',
            'Monto' => 'required|numeric|min:0|max:999999.99',
        ], [
            'Cargo.required' => 'El campo Cargo es requerido.',
            'Cargo.string' => 'El campo Cargo debe ser una cadena de texto.',
            'Cargo.min' => 'El campo Cargo debe tener al menos :min caracteres.',
            'Cargo.max' => 'El campo Cargo no debe exceder los :max caracteres.',
            'Cargo.unique' => 'El Cargo ingresado ya existe en la tabla de sueldossalarios.',
            'Monto.required' => 'El campo Monto es requerido.',
            'Monto.numeric' => 'El campo Monto debe ser numérico.',
            'Monto.min' => 'El campo Monto debe ser mayor que cero.',
            'Monto.max' => 'El campo Monto no debe exceder los :max dígitos.',
        ]);
        // Convertir los textos a mayúsculas antes de actualizarlos
        $requestData = $request->all();
        $requestData['Cargo'] = strtoupper($request->Cargo);

        // Actualizar el sueldo con los datos modificados
        $sueldossalario->update($requestData);

        return redirect()->route('sueldossalarios.index')->with('success', 'Sueldo editado correctamente.');
    }

    public function destroy($id)
    {
        // Eliminación lógica: actualizar el atributo 'activo' a 0
        $sueldossalario = sueldossalarios::findOrFail($id);
        $sueldossalario->activo = 0;
        $sueldossalario->save();

        return redirect()->route('sueldossalarios.index')->with('success', 'Sueldo eliminado correctamente.');
    }
}
