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
            <a href="{{ route('inventarios.index') }}" class="btn btn-info">Volver</a>
        @endif
                <h3 class="card-header">Crear Nuevo Inventario</h3>

                <div class="card-body">
                    <form method="POST" action="{{ route('inventarios.store') }}">
                        @csrf

                        <div class="form-group">
                            <label for="ProductoId">Producto:</label>
                            <select name="ProductoId" id="ProductoId" class="form-control" required>
                                @foreach($productos as $producto)
                                    <option value="{{ $producto->ProductoId }}">{{ $producto->Nombre }}</option>
                                @endforeach
                            </select>
                            @error('ProductoId')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="SucursalId">Sucursal:</label>
                            <select name="SucursalId" id="SucursalId" class="form-control" required>
                                @foreach($sucursales as $sucursal)
                                    <option value="{{ $sucursal->SucursalId }}">{{ $sucursal->Nombre }}</option>
                                @endforeach
                            </select>
                            @error('SucursalId')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="Cantidad">Cantidad:</label>
                            <input type="number" name="Cantidad" id="Cantidad" class="form-control" value="0" readonly required>
                            @error('Cantidad')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-primary">Guardar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
