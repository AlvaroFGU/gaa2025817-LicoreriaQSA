<?php

namespace App\Http\Controllers;

use App\Models\marcas;
use Illuminate\Http\Request;

class MarcasController extends Controller
{
    public function index()
    {
        $marcas = marcas::where('Activo', 1)->paginate(10);
        return view('marcas.index', compact('marcas'));
        
    }


    public function destroy($id)
    {
        $marca = marcas::findOrFail($id);
        $marca->Activo = 0;
        $marca->save();
        return redirect()->route('marcas.index')->with('success', 'Marca eliminada correctamente.');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('marcas.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'Nombre' => 'required|string|max:50|unique:marcas,Nombre',
            'Procedencia' => 'required|string|max:50',
            'Descripcion' => 'required|string|max:200',
        ], [
            'Nombre.required' => 'El nombre es obligatorio.',
            'Nombre.string' => 'El nombre debe ser una cadena de texto.',
            'Nombre.max' => 'El nombre no puede tener más de 50 caracteres.',
            'Nombre.unique' => 'El nombre ya está en uso, por favor elige otro.',
            
            'Procedencia.required' => 'La procedencia es obligatoria.',
            'Procedencia.string' => 'La procedencia debe ser una cadena de texto.',
            'Procedencia.max' => 'La procedencia no puede tener más de 50 caracteres.',
            
            'Descripcion.required' => 'La descripción es obligatoria.',
            'Descripcion.string' => 'La descripción debe ser una cadena de texto.',
            'Descripcion.max' => 'La descripción no puede tener más de 200 caracteres.'
        ]);
        

        Marcas::create([
            'Nombre' => strtoupper($request->Nombre),
            'Procedencia' => strtoupper($request->Procedencia),
            'Descripcion' => strtoupper($request->Descripcion),
        ]);

        return redirect()->route('marcas.index')->with('success', 'Marca creada correctamente');
    }

    public function show(string $id)
    {
        $marca = marcas::findOrFail($id);
        return view('marcas.show', compact('marca'));
    }

    public function edit(string $id)
    {
        $marca = marcas::findOrFail($id);
        return view('marcas.edit', compact('marca'));
    }

    public function update(Request $request, string $id)
    {
        $request->validate([
            'Nombre' => 'required|string|max:50|unique:marcas,Nombre,' . $id . ',MarcaId',
            'Procedencia' => 'required|string|max:50',
            'Descripcion' => 'required|string|max:200',
        ], [
            'Nombre.required' => 'El nombre es obligatorio.',
            'Nombre.string' => 'El nombre debe ser una cadena de texto.',
            'Nombre.max' => 'El nombre no puede tener más de 50 caracteres.',
            'Nombre.unique' => 'El nombre ya está en uso, por favor elige otro.',
            
            'Procedencia.required' => 'La procedencia es obligatoria.',
            'Procedencia.string' => 'La procedencia debe ser una cadena de texto.',
            'Procedencia.max' => 'La procedencia no puede tener más de 50 caracteres.',
            
            'Descripcion.required' => 'La descripción es obligatoria.',
            'Descripcion.string' => 'La descripción debe ser una cadena de texto.',
            'Descripcion.max' => 'La descripción no puede tener más de 200 caracteres.'
        ]);

        $marca = marcas::findOrFail($id);
        $marca->update([
            'Nombre' => strtoupper($request->Nombre),
            'Procedencia' => strtoupper($request->Procedencia),
            'Descripcion' => strtoupper($request->Descripcion),
        ]);

        return redirect()->route('marcas.index')->with('success', 'Marca actualizada correctamente');
    }
}
