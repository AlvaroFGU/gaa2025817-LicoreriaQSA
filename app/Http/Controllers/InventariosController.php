<?php

namespace App\Http\Controllers;

use App\Models\inventarios;
use App\Models\productos;
use App\Models\sucursales;
use Illuminate\Http\Request;

class InventariosController extends Controller
{
    public function index()
    {
        $inventarios = inventarios::where('Activo', 1)->paginate(15);
        return view('inventarios.index', compact('inventarios'));
    }

    public function create()
    {
        $productos = productos::where('Activo', 1)->get();
        $sucursales = sucursales::where('Activo', 1)->get();
        return view('inventarios.create', compact('productos', 'sucursales'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'ProductoId' => 'required|integer|exists:productos,ProductoId,Activo,1',
            'SucursalId' => 'required|integer|exists:sucursales,SucursalId,Activo,1',
            'Cantidad' => 'required|integer|min:0',
        ]);
        $existingInventory = inventarios::where('ProductoId', $request->ProductoId)
        ->where('SucursalId', $request->SucursalId)
        ->exists();

        if ($existingInventory) {
            return redirect()->back()->with('error', 'Ya existe un inventario para este producto en esta sucursal.');
        }

        inventarios::create($request->all());

        return redirect()->route('inventarios.index')->with('success', 'Inventario creado exitosamente.');
    }
    public function show($id)
{
    $inventario = inventarios::findOrFail($id);
    return view('inventarios.show', compact('inventario'));
}

public function edit($id)
{
    $inventario = inventarios::findOrFail($id);
    $productos = productos::where('Activo', 1)->get();
    $sucursales = sucursales::where('Activo', 1)->get();
    return view('inventarios.edit', compact('inventario', 'productos', 'sucursales'));
}

public function update(Request $request, $id)
{
    $inventario = inventarios::findOrFail($id);

    $request->validate([
        'ProductoId' => 'required|integer|exists:productos,ProductoId,Activo,1',
        'SucursalId' => 'required|integer|exists:sucursales,SucursalId,Activo,1',
        'Cantidad' => 'required|integer|min:0',
    ]);
    $existingInventory = inventarios::where('ProductoId', $request->ProductoId)
    ->where('SucursalId', $request->SucursalId)
    ->where('InventarioId', '!=', $id)
    ->exists();

    if ($existingInventory) {
        return redirect()->back()->with('error', 'Ya existe un inventario para este producto en esta sucursal.');
    }
    $inventario->update($request->all());

    return redirect()->route('inventarios.index')->with('success', 'Inventario actualizado exitosamente.');
}

public function destroy($id)
{
    inventarios::findOrFail($id)->delete();
    return redirect()->route('inventarios.index')->with('success', 'Inventario eliminado exitosamente.');
}
}
