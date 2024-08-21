<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Personas;

class PersonasController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $personas = Personas::all();
        return view('personas.index', compact('personas'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('personas.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'Ci' => 'required|digits_between:6,10|unique:personas',
            'Nombres' => 'required|regex:/^[a-zA-Z\s]{3,}$/|max:100',
            'Apellidos' => 'required|regex:/^[a-zA-Z\s]{3,}$/|max:100',
            'Direccion' => 'required|string|max:100',
        ]);
        Personas::create($request->all());
        return redirect()->route('personas.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $persona = Personas::findOrFail($id);
        return view('personas.show', compact('persona'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $persona = Personas::findOrFail($id);
        return view('personas.edit', compact('persona'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'Ci' => 'required|numeric|digits_between:6,10',
            'Nombres' => 'required|regex:/^[a-zA-Z\s]{3,}$/|max:100',
            'Apellidos' => 'required|regex:/^[a-zA-Z\s]{3,}$/|max:100',
            'Direccion' => 'required|string|max:100',
        ]);
        $persona = Personas::findOrFail($id);
        $persona->update($request->all());
        return redirect()->route('personas.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
    
}
