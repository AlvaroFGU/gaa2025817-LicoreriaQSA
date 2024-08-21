<?php

namespace App\Http\Controllers;

use App\Models\sucursales;
use Illuminate\Http\Request;

class SucursalesController extends Controller
{
    public function index()
    {
        $sucursales = sucursales::where('activo', 1)->paginate(10);
        return view('sucursales.index', compact('sucursales'));
    }

    public function create()
    {
        return view('sucursales.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'Nombre' => 'required|string|max:255|unique:sucursales,Nombre',
            'Direccion' => 'required|string|max:255',
        ], [
            'Nombre.required' => 'El campo Nombre es requerido.',
            'Nombre.string' => 'El campo Nombre debe ser una cadena de texto.',
            'Nombre.max' => 'El campo Nombre no debe exceder los :max caracteres.',
            'Nombre.unique' => 'El Nombre ingresado ya existe en la tabla de sucursales.',
            'Direccion.required' => 'El campo Dirección es requerido.',
            'Direccion.string' => 'El campo Dirección debe ser una cadena de texto.',
            'Direccion.max' => 'El campo Dirección no debe exceder los :max caracteres.',
        ]);
        

        $requestData = $request->all();
        $requestData['Nombre'] = strtoupper($requestData['Nombre']);
        $requestData['Direccion'] = strtoupper($requestData['Direccion']);
        $requestData['activo'] = 1; // Activo por defecto al crear

        // Crear la sucursal con los datos modificados
        sucursales::create($requestData);

        return redirect()->route('sucursales.index')->with('success', 'Sucursal creada correctamente.');
    }

    public function show($id)
    {
        $sucursal = sucursales::findOrFail($id);
        return view('sucursales.show', compact('sucursal'));
    }

    public function edit($id)
    {
        $sucursal = sucursales::findOrFail($id);
        return view('sucursales.edit', compact('sucursal'));
    }

    public function update(Request $request, $id)
    {
        $sucursal = sucursales::findOrFail($id);

        $request->validate([
            'Nombre' => 'required|string|max:255|unique:sucursales,Nombre,' . $id . ',SucursalId',
            'Direccion' => 'required|string|max:255',
        ], [
            'Nombre.required' => 'El campo Nombre es requerido.',
            'Nombre.string' => 'El campo Nombre debe ser una cadena de texto.',
            'Nombre.max' => 'El campo Nombre no debe exceder los :max caracteres.',
            'Nombre.unique' => 'El Nombre ingresado ya existe en la tabla de sucursales.',
            'Direccion.required' => 'El campo Dirección es requerido.',
            'Direccion.string' => 'El campo Dirección debe ser una cadena de texto.',
            'Direccion.max' => 'El campo Dirección no debe exceder los :max caracteres.',
        ]);

        // Convertir los textos a mayúsculas antes de actualizarlos
        $requestData = $request->all();
        $requestData['Nombre'] = strtoupper($requestData['Nombre']);
        $requestData['Direccion'] = strtoupper($requestData['Direccion']);

        // Actualizar la sucursal con los datos modificados
        $sucursal->update($requestData);

        return redirect()->route('sucursales.index')->with('success', 'Sucursal actualizada correctamente.');
    }

    public function destroy($id)
    {
        // Desactivar la sucursal en lugar de eliminarla físicamente
        $sucursal = sucursales::findOrFail($id);
        $sucursal->activo = 0;
        $sucursal->save();

        return redirect()->route('sucursales.index')->with('success', 'Sucursal eliminada correctamente.');
    }
}
