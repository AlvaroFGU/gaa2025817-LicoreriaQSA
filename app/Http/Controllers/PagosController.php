<?php

namespace App\Http\Controllers;

use App\Models\compras;
use App\Models\planPagos;
use Illuminate\Http\Request;

class PagosController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    public function create($id)
    {
        $compra = compras::findOrFail($id);
        $montoTotal = $compra->MontoTotal;
        $montoPagado = $compra->MontoPagado;
        $montoRestante = $montoTotal - $montoPagado;

        return view('pagos.create', compact('compra', 'montoRestante'));
    }

    public function store(Request $request, $id)
    {
        $compra = Compras::findOrFail($id);

        $request->validate([
            'Fecha' => 'required|date',
            'Monto' => 'required|numeric|min:0.01|max:' . ($compra->MontoTotal - $compra->MontoPagado),
        ], [
            'Monto.max' => 'El monto no puede superar la diferencia entre el monto total y el monto pagado.'
        ]);

        planPagos::create([
            'Fecha' => $request->input('Fecha'),
            'Monto' => $request->input('Monto'),
            'CompraId' => $compra->CompraId,
            'Activo' => 1,
        ]);
        $compra->MontoPagado += $request->input('Monto');

        $compra->save();
        return redirect()->route('compras.show', $compra->CompraId)->with('success', 'Pago registrado correctamente.');
    }

    
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
