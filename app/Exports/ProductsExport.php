<?php

namespace App\Exports;

use App\Models\productos;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ProductsExport implements FromCollection, WithHeadings
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return productos::with('marca')
            ->get()
            ->map(function($producto) {
                return [
                    'ProductoId' => $producto->ProductoId,
                    'Nombre' => $producto->Nombre,
                    'Precio' => $producto->Precio,
                    'Descripcion' => $producto->Descripcion,
                    'Modelo' => $producto->Modelo,
                    'MarcaId' => $producto->MarcaId,
                    'MarcaNombre' => $producto->marca->Nombre,
                    'MarcaProcedencia' => $producto->marca->Procedencia,
                    'MarcaDescripcion' => $producto->marca->Descripcion,
                    'MarcaActivo' => $producto->marca->Activo,
                    'Cantidad'=> $producto->Cantidad,
                ];
            });
    }

    /**
     * @return array
     */
    public function headings(): array
    {
        return [
            'Producto Nº',
            'Nombre',
            'Precio',
            'Descripcion',
            'Modelo',
            'MarcaId',
            'Marca Nombre',
            'Marca Procedencia',
            'Marca Descripcion',
            'Marca Activo',
            'Cantidad',
        ];
    }
}
