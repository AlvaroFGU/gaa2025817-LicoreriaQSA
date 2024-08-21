@extends('layouts.master')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                @if(session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
            
        @endif
                <h3 class="card-header">Editar Inventario</h3>
        <form method="POST" action="{{ route('inventarios.update', $inventario->InventarioId) }}">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="ProductoId">Producto:</label>
                <select name="ProductoId" id="ProductoId" class="form-control">
                    @foreach($productos as $producto)
                        <option value="{{ $producto->ProductoId }}" {{ $inventario->ProductoId == $producto->ProductoId ? 'selected' : '' }}>{{ $producto->Nombre }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="SucursalId">Sucursal:</label>
                <select name="SucursalId" id="SucursalId" class="form-control">
                    @foreach($sucursales as $sucursal)
                        <option value="{{ $sucursal->SucursalId }}" {{ $inventario->SucursalId == $sucursal->SucursalId ? 'selected' : '' }}>{{ $sucursal->Nombre }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="Cantidad">Cantidad:</label>
                <input type="number" name="Cantidad" id="Cantidad" class="form-control" value="{{ old('Cantidad', $inventario->Cantidad) }}" readonly min="0">
            </div>

            <button type="submit" class="btn btn-primary">Guardar Cambios</button>
            <a href="{{ route('inventarios.index') }}" class="btn btn-info">Volver</a>
        </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
