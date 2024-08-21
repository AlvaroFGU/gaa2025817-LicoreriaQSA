<?php

namespace App\Http\Controllers;

use App\Mail\CorreoElectronico;
use App\Models\empleados;
use App\Models\inventarios;
use App\Models\productos;
use App\Models\sucursales;
use App\Models\transacciones;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\TransExport;
use Barryvdh\DomPDF\Facade\Pdf;

class TransaccionesController extends Controller
{
    

    public function index()
    {
        $transacciones = transacciones::where('Activo', 1)
        ->orderBy('Fecha', 'desc')
        ->paginate(15);
        return view('transacciones.index', compact('transacciones'));
    }

    public function export()
    {
        return Excel::download(new TransExport, 'transacciones.csv');
    }

    public function create()
    {
        $user = session('usuario');
        $productos = Productos::where('Activo', 1)->where('Cantidad', '>', 0)->get();
        $empleados = empleados::where('Activo', 1)->where('UsuarioId', $user->UsuarioId)->get();
        $sucursales = sucursales::where('Activo', 1)->get();

        return view('transacciones.create', compact('productos', 'empleados', 'sucursales'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'EmpleadoId' => 'required|exists:empleados,EmpleadoId',
            'SucursalId' => 'required|exists:sucursales,SucursalId',
            'productos' => 'required|array',
            'productos.*.ProductoId' => 'required|exists:productos,ProductoId',
            'productos.*.Cantidad' => 'required|integer|min:1',
        ], [
            'EmpleadoId.required' => 'El campo Empleado es obligatorio.',
            'EmpleadoId.exists' => 'El Empleado seleccionado no es válido.',
            'SucursalId.required' => 'El campo Sucursal es obligatorio.',
            'SucursalId.exists' => 'La Sucursal seleccionada no es válida.',
        ]);
        $empleado = empleados::findOrFail($request->EmpleadoId);
        $sucursal = sucursales::findOrFail($request->SucursalId);
        $productos = $request->productos;
        $empleados = empleados::where('Activo', 1)->get();
        $montoCancelado = $request->montoCancelado;
        $total = 0;


        foreach ($productos as $producto) {
            // Crear la transacción
            transacciones::create([
                'Fecha' => now(),
                'ProductoId' => $producto['ProductoId'],
                'EmpleadoId' => $request->EmpleadoId,
                'Cantidad' => $producto['Cantidad'],
                'Activo' => 1,
                'SucursalId' => $request->SucursalId,
            ]);

            // Verificar si existe inventario
            $inventario = inventarios::where('ProductoId', $producto['ProductoId'])
                                     ->where('SucursalId', $request->SucursalId)
                                     ->first();

            if ($inventario) {
                // Si existe, actualizar la cantidad
                $inventario->update([
                    'Cantidad' => $inventario->Cantidad + $producto['Cantidad']
                ]);
            } else {
                // Si no existe, crear un nuevo inventario
                inventarios::create([
                    'ProductoId' => $producto['ProductoId'],
                    'SucursalId' => $request->SucursalId,
                    'Cantidad' => $producto['Cantidad'],
                    'Activo' => 1
                ]);
            }

            // Actualizar la cantidad de productos
            $productoE = productos::findOrFail($producto['ProductoId']);
            $productoE->update([
                'Cantidad' => $productoE['Cantidad'] - $producto['Cantidad'],
            ]);

            $total += $productoE->Precio * $producto['Cantidad'];
            // Enviar correo si la cantidad del producto es menor a 5
            if ($productoE->Cantidad < -1) {
                foreach ($empleados as $empleadoE) {
                    Mail::to($empleadoE->usuario->Correo)->send(new CorreoElectronico($empleadoE, $productoE, $sucursal));
                }
            }
        }
        $productosDetalles[] = [
            'Nombre' => $productoE->Nombre,
            'Cantidad' => $producto['Cantidad'],
            'Precio' => $productoE->Precio,
            'Subtotal' => $productoE->Precio * $producto['Cantidad']
        ];
        $cambio = $montoCancelado - $total;

        // Generar el PDF usando la clase completa
        $pdf = Pdf::loadView('pdf.recibo', [
            'productosDetalles' => $productosDetalles,
            'total' => $total,
            'montoCancelado' => $montoCancelado,
            'cambio' => $cambio,
            'empleado' => $empleado,
            'sucursal' => $sucursal
        ]);


        $pdfPath = 'recibo_transaccion.pdf'; // Solo el nombre del archivo
        $fullPath = storage_path('app/public/' . $pdfPath);
        $pdf->save($fullPath);

        // Guardar la ruta en la sesión
        session()->flash('pdf_path', $pdfPath);

        // Redirige a la vista que descargará el PDF automáticamente
        return view('download_pdf'); 

    }

    public function show($id)
    {
        $transaccion = transacciones::findOrFail($id);
        return view('transacciones.show', compact('transaccion'));
    }

    public function edit($id)
    {
        $user = session('usuario');
        $transaccion = transacciones::findOrFail($id);
        $productos = productos::where('Activo', 1)->get();
        $empleados = empleados::where('Activo', 1)->where('UsuarioId', $user->UsuarioId)->get();
        $sucursales = sucursales::where('Activo', 1)->get();
        return view('transacciones.edit', compact('transaccion', 'productos', 'empleados', 'sucursales'));
    }

    public function update(Request $request, $id)
    {
        $transaccion = transacciones::findOrFail($id);
        $cantAnterior = $transaccion->Cantidad;
        $request->validate([
            'ProductoId' => 'required|exists:productos,ProductoId',
            'EmpleadoId' => 'required|exists:empleados,EmpleadoId',
            'Cantidad' => 'required|integer|min:1',
            'SucursalId' => 'required|exists:sucursales,SucursalId',
        ], [
            'ProductoId.required' => 'El campo Producto es obligatorio.',
            'ProductoId.exists' => 'El Producto seleccionado no es válido.',
            'EmpleadoId.required' => 'El campo Empleado es obligatorio.',
            'EmpleadoId.exists' => 'El Empleado seleccionado no es válido.',
            'Cantidad.required' => 'El campo Cantidad es obligatorio.',
            'Cantidad.integer' => 'El campo Cantidad debe ser un número entero.',
            'Cantidad.min' => 'El campo Cantidad debe ser al menos 1.',
            'SucursalId.required' => 'El campo Sucursal es obligatorio.',
            'SucursalId.exists' => 'La Sucursal seleccionado no es válido.',
        ]);

        $transaccion->update([
            'ProductoId' => $request->ProductoId,
            'EmpleadoId' => $request->EmpleadoId,
            'Cantidad' => $request->Cantidad,
            'SucursalId' => $request->SucursalId,
        ]);
        $productoMod = productos::findOrFail($request->ProductoId);
        $productoMod->update([
            'Cantidad' => $productoMod->Cantidad + $cantAnterior - $request->Cantidad
        ]);

        return redirect()->route('transacciones.index')->with('success', 'Transacción actualizada exitosamente.');
    }

    public function destroy($id)
    {
        $transaccion = transacciones::findOrFail($id);
        $transaccion->update(['Activo' => 0]);

        return redirect()->route('transacciones.index')->with('success', 'Transacción eliminada exitosamente.');
    }
}
