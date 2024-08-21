<?php

namespace App\Http\Controllers;

use App\Models\compras;
use App\Models\detalleCompras;
use App\Models\empleados;
use App\Models\planPagos;
use App\Models\productos;
use App\Models\proveedores;
use Illuminate\Http\Request;

class ComprasController extends Controller
{
    public function index()
    {
        $compras = compras::where('Activo', 1)->paginate(15);
        return view('compras.index', compact('compras'));
    }

    public function create()
    {
        $user = session('usuario');
        $proveedores = proveedores::where('Activo', 1)->get();
        $empleados = empleados::where('Activo', 1)->where('UsuarioId', $user->UsuarioId)->get();
        $productos = productos::where('Activo', 1)->get();

        return view('compras.create', compact('proveedores', 'empleados', 'productos'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'Fecha' => 'required|date',
            'MontoTotal' => 'required|numeric|min:0|max:99999999.99',
            'MontoPagado' => 'required|numeric|min:0|max:99999999.99',
            'ProveedorId' => 'required|exists:proveedores,ProveedorId',
            'EmpleadoId' => 'required|exists:empleados,EmpleadoId',
            'productos' => 'required|array',
            'productos.*.ProductoId' => 'required|exists:productos,ProductoId',
            'productos.*.Cantidad' => 'required|integer|min:1'
        ], [
            'Fecha.required' => 'El campo Fecha es requerido.',
            'Fecha.date' => 'El campo Fecha debe ser una fecha válida.',
            'MontoTotal.required' => 'El campo Monto Total es requerido.',
            'MontoTotal.numeric' => 'El campo Monto Total debe ser un número.',
            'MontoTotal.min' => 'El campo Monto Total debe ser mayor o igual a cero.',
            'MontoTotal.max' => 'El campo Monto Total no debe exceder los 99999999.99.',
            'MontoPagado.required' => 'El campo Monto Pagado es requerido.',
            'MontoPagado.numeric' => 'El campo Monto Pagado debe ser un número.',
            'MontoPagado.min' => 'El campo Monto Pagado debe ser mayor o igual a cero.',
            'MontoPagado.max' => 'El campo Monto Pagado no debe exceder los 99999999.99.',
            'ProveedorId.required' => 'El campo Proveedor es requerido.',
            'ProveedorId.exists' => 'El proveedor seleccionado no es válido.',
            'EmpleadoId.required' => 'El campo Empleado es requerido.',
            'EmpleadoId.exists' => 'El empleado seleccionado no es válido.',
            'productos.required' => 'Se requiere al menos un producto.',
            'productos.*.ProductoId.required' => 'El ID del producto es requerido.',
            'productos.*.Cantidad.required' => 'La cantidad es requerida.'
        ]);
        if ($request->input('MontoPagado') > $request->input('MontoTotal')) {
            return back()->withErrors(['MontoPagado' => 'El monto pagado no puede ser mayor que el monto total.'])->withInput();
        }
        $compra = compras::create($validatedData);
        foreach ($request->productos as $producto) {
            detalleCompras::create([
                'CompraId' => $compra->CompraId,
                'ProductoId' => $producto['ProductoId'],
                'Cantidad' => $producto['Cantidad'],
                'Activo' => 1
            ]);
            $productoE = Productos::findOrFail($producto['ProductoId']);
            $productoE->update([
                'Cantidad' => $productoE['Cantidad']+$producto['Cantidad']
            ]);
        }
        planPagos::create([
            'Fecha' => now(),
            'Monto' => $compra->MontoPagado,
            'CompraId' => $compra->CompraId,
            'Activo' => 1,
        ]);
        return redirect()->route('compras.index')->with('success', 'Compra creada exitosamente.');
    }

    public function show($id)
    {
        $pagos = planPagos::where('CompraId', $id)->get();
        $compra = compras::findOrFail($id);
        $detalles = detalleCompras::where('CompraId', $id)->get();
        return view('compras.show', compact('compra', 'detalles', 'pagos'));
    }

    public function edit($id)
    {
        $user = session('usuario');
        $compra = compras::findOrFail($id);
        $proveedores = proveedores::where('Activo', 1)->get();
        $empleados = empleados::where('Activo', 1)->where('UsuarioId', $user->UsuarioId)->get();
        return view('compras.edit', compact('compra', 'proveedores', 'empleados'));
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'Fecha' => 'required|date',
            'MontoTotal' => 'required|numeric|min:0|max:99999999.99',
            'MontoPagado' => 'required|numeric|min:0|max:99999999.99',
            'ProveedorId' => 'required|exists:proveedores,ProveedorId',
            'EmpleadoId' => 'required|exists:empleados,EmpleadoId',
        ], [
            'Fecha.required' => 'El campo Fecha es requerido.',
            'Fecha.date' => 'El campo Fecha debe ser una fecha válida.',
            'MontoTotal.required' => 'El campo Monto Total es requerido.',
            'MontoTotal.numeric' => 'El campo Monto Total debe ser un número.',
            'MontoTotal.min' => 'El campo Monto Total debe ser mayor o igual a cero.',
            'MontoTotal.max' => 'El campo Monto Total no debe exceder los 99999999.99.',
            'MontoPagado.required' => 'El campo Monto Pagado es requerido.',
            'MontoPagado.numeric' => 'El campo Monto Pagado debe ser un número.',
            'MontoPagado.min' => 'El campo Monto Pagado debe ser mayor o igual a cero.',
            'MontoPagado.max' => 'El campo Monto Pagado no debe exceder los 99999999.99.',
            'ProveedorId.required' => 'El campo Proveedor es requerido.',
            'ProveedorId.exists' => 'El proveedor seleccionado no es válido.',
            'EmpleadoId.required' => 'El campo Empleado es requerido.',
            'EmpleadoId.exists' => 'El empleado seleccionado no es válido.',
        ]);
        if ($request->input('MontoPagado') > $request->input('MontoTotal')) {
            return back()->withErrors(['MontoPagado' => 'El monto pagado no puede ser mayor que el monto total.'])->withInput();
        }
        $compra = compras::findOrFail($id);
        $compra->update($validatedData);

        return redirect()->route('compras.index')->with('success', 'Compra actualizada exitosamente.');
    }

    public function destroy($id)
    {
        $compra = compras::findOrFail($id);
        $compra->update(['Activo' => 0]);

        return redirect()->route('compras.index')->with('success', 'Compra eliminada exitosamente.');
    }
}
