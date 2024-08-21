@extends('layouts.master')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Distribución de {{ $producto->nombre }}</div>

                    <div class="card-body">
                        <form id="inventariosForm" action="{{ route('productos.updateDistribucion', $producto->ProductoId) }}" method="POST">
                            @csrf
                            @method('PUT')

                            <div class="form-group">
                                <label for="cantidad">Cantidad del Producto:</label>
                                <input type="text" id="cantidad" class="form-control" value="{{ $producto->Cantidad }}" readonly>
                            </div>

                            <div class="form-group">
                                <label for="inventarios">Inventarios:</label>
                                <br>
                                @foreach ($inventarios as $inventario)
                                    <div class="form-group">
                                        <label for="inventario_{{ $inventario->SucursalId }}">{{ $inventario->sucursal->Nombre }}</label>
                                        <input readonly type="number" name="inventarios[{{ $inventario->SucursalId }}]" id="inventario_{{ $inventario->SucursalId }}" class="form-control inventario text-black" value="{{ $inventario->Cantidad }}" data-max="{{ $producto->Cantidad }}" required>
                                    </div>
                                @endforeach
                            </div>

                            <a href="{{ route('productos.index')}}"
                                class="btn btn-sm btn-primary">Volver</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    
@endsection
