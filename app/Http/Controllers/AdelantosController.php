<?php

namespace App\Http\Controllers;

use App\Mail\AdelantoNotificacion;
use App\Models\adelantos;
use App\Models\empleados;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class AdelantosController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create($id)
    {
        $empleado = empleados::findOrFail($id);
        return view('adelantos.create', compact('empleado'));
    }

    public function store(Request $request, $id)
    {
        $request->validate([
            'Monto' => 'required|numeric|min:0',
        ], [
            'Monto.required' => 'El campo Monto es obligatorio.',
            'Monto.numeric' => 'El campo Monto debe ser un número.',
            'Monto.min' => 'El campo Monto debe ser al menos 0.',
        ]);

        $adelanto = adelantos::create([
            'Fecha' => now(),
            'Monto' => $request->Monto,
            'EmpleadoId' => $id,
            'Activo' => 1,
        ]);
        $empleado = empleados::with('persona', 'usuario', 'rol', 'sueldo', 'sucursal')->findOrFail($id);
        $adelantos = adelantos::where('EmpleadoId', $id)->get();
        Mail::to($empleado->usuario->Correo)->send(new AdelantoNotificacion($adelanto, $empleado));

        return redirect()->route('empleados.show', $id)->with('success', 'Adelanto creado correctamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
