<?php
namespace App\Http\Controllers;

use App\Models\Roles;
use Illuminate\Http\Request;

class RolesController extends Controller
{
    public function index()
    {
        $roles = roles::where('Activo', 1)->paginate(10);
        return view('roles.index', compact('roles'));
    }

    public function create()
    {
        return view('roles.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'Nombre' => 'required|string|max:20|unique:roles,Nombre',
            'Descripcion' => 'required|string|max:255',
            'Permisos' => 'required|array',
        ], [
            'Nombre.required' => 'El campo Nombre es requerido.',
            'Nombre.string' => 'El campo Nombre debe ser una cadena de caracteres.',
            'Nombre.max' => 'El campo Nombre no debe exceder los :max caracteres.',
            'Nombre.unique' => 'El Nombre ingresado ya está en uso.',

            'Descripcion.required' => 'El campo Descripción es requerido.',
            'Descripcion.string' => 'El campo Descripción debe ser una cadena de caracteres.',
            'Descripcion.max' => 'El campo Descripción no debe exceder los :max caracteres.',

            'Permisos.required' => 'El campo Permisos es requerido.',
            'Permisos.array' => 'El campo Permisos debe ser un array de valores.',
        ]);

        $permisos = implode(',', $request->Permisos);

        $requestData = $request->all();
        $requestData['Nombre'] = strtoupper($requestData['Nombre']);
        $requestData['Descripcion'] = strtoupper($requestData['Descripcion']);
        $requestData['Permisos'] = $permisos;

        Roles::create($requestData);
        return redirect()->route('roles.index');
    }

    public function show($id)
    {
        $rol = Roles::findOrFail($id);
        return view('roles.show', compact('rol'));
    }

    public function edit($id)
    {
        $rol = Roles::findOrFail($id);
        return view('roles.edit', compact('rol'));
    }

    public function update(Request $request, $id)
    {
        $rol = Roles::findOrFail($id);

        $request->validate([
            'Nombre' => 'required|string|max:20|unique:roles,Nombre,' . $id . ',RolId',
            'Descripcion' => 'required|string|max:255',
            'Permisos' => 'required|array',
        ], [
            'Nombre.required' => 'El campo Nombre es requerido.',
            'Nombre.string' => 'El campo Nombre debe ser una cadena de caracteres.',
            'Nombre.max' => 'El campo Nombre no debe exceder los :max caracteres.',
            'Nombre.unique' => 'El Nombre ingresado ya está en uso.',

            'Descripcion.required' => 'El campo Descripción es requerido.',
            'Descripcion.string' => 'El campo Descripción debe ser una cadena de caracteres.',
            'Descripcion.max' => 'El campo Descripción no debe exceder los :max caracteres.',

            'Permisos.required' => 'El campo Permisos es requerido.',
            'Permisos.array' => 'El campo Permisos debe ser un array de valores.',
        ]);

        $permisos = implode(',', $request->Permisos);

        $requestData = $request->all();
        $requestData['Nombre'] = strtoupper($requestData['Nombre']);
        $requestData['Descripcion'] = strtoupper($requestData['Descripcion']);
        $requestData['Permisos'] = $permisos;

        $rol->update($requestData);
        return redirect()->route('roles.index');
    }

    public function destroy($id)
    {
        Roles::findOrFail($id)->delete();
        return redirect()->route('roles.index');
    }
}
