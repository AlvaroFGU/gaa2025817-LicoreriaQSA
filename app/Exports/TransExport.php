<?php

namespace App\Exports;

use App\Models\transacciones;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class TransExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return transacciones::with('producto','empleado','sucursal')
            ->get()
            ->map(function($transaccion){
                return[
                    'TransaccionesId'=>$transaccion->TransaccionId,
                    'Fecha'=>$transaccion->Fecha,
                    'ProductoId' => $transaccion->ProductoId,
                    'P.Nombre' => $transaccion->producto->Nombre,
                    'P.Precio' => $transaccion->producto->Precio,
                    'P.Descripcion' => $transaccion->producto->Descripcion,
                    'P.Modelo' => $transaccion->producto->Modelo,
                    'P.MarcaId' => $transaccion->producto->MarcaId,
                    'P.MarcaNombre' => $transaccion->producto->marca->Nombre,
                    'P.MarcaProcedencia' => $transaccion->producto->marca->Procedencia,
                    'P.MarcaDescripcion' => $transaccion->producto->marca->Descripcion,
                    'P.MarcaActivo' => $transaccion->producto->marca->Activo,
                    'P.Cantidad'=> $transaccion->producto->Cantidad,
                    'EmpleadoId'=>$transaccion->EmpleadoId,
                    'E.FechaNacimiento'=>$transaccion->empleado->FechaNacimiento,
                    'E.FechaContrato'=>$transaccion->empleado->FechaContrato,
                    'E.PersonaId'=>$transaccion->empleado->PesonaId,
                    'E.Nombres'=>$transaccion->empleado->persona->Nombres,
                    'E.Apellidos'=>$transaccion->empleado->persona->Apellidos,
                    'E.Direccion'=>$transaccion->empleado->persona->Direccion,
                    'E.Activo'=>$transaccion->empleado->persona->Activo,
                    'E.UsuarioId'=>$transaccion->empleado->UsuarioId,
                    'E.Rol'=>$transaccion->empleado->RolId,
                    'E.R.Nombre'=>$transaccion->empleado->rol->Nombre,
                    'E.R.Descripcion'=>$transaccion->empleado->rol->Descripcion,
                    'E.SueldoId'=>$transaccion->empleado->SueldoId,
                    'E.S.Cargo'=>$transaccion->empleado->sueldo->Cargo,
                    'E.S.Monto'=>$transaccion->empleado->sueldo->Monto,
                    'Cantidad'=>$transaccion->Cantidad,
                    'SucursalesId' => $transaccion->SucursalId,
                    'S.Nombre' => $transaccion->sucursal->Nombre,
                    'S.Direccion' => $transaccion->sucursal->Direccion,










                    

                ];
            });
    }

     /**
     * @return array
     */
    public function headings(): array
    {
        return [

            'Transaccion Nº',
            'Fecha',
            'Producto Nº',
            'P.Nombre',
            'P.Precio',
            'P.Descripcion',
            'P.Modelo',
            'P.MarcaId',
            'P.Marca Nombre',
            'P.Marca Procedencia',
            'P.Marca Descripcion',
            'P.Marca Activo',
            'P.Cantidad',

            'EmpleadoId',
                    'E.FechaNacimiento',
                    'E.FechaContrato',
                    'E.PersonaId',
                    'E.Nombres',
                    'E.Apellidos',
                    'E.Direccion',
                    'E.Activo',
                    'E.UsuarioId',
                    'E.Rol',
                    'E.R.Nombre',
                    'E.R.Descripcion',
                    'E.SueldoId',
                    'E.S.Cargo',
                    'E.S.Monto',
                    'Cantidad',
                    'SucursalesId',
                    'S.Nombre' ,
                    'S.Direccion',

        ];
    }
}
