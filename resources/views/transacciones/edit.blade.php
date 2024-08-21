@extends('layouts.master')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Editar Transacción</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('transacciones.update', $transaccion->TransaccionId) }}">
                        @csrf
                        @method('PUT')

                        <div class="form-group">
                            <label for="ProductoId">Producto:</label>
                            <select name="ProductoId" id="ProductoId" class="form-control" required>
                                @foreach($productos as $producto)
                                    <option value="{{ $producto->ProductoId }}" {{ old('ProductoId', $transaccion->ProductoId) == $producto->ProductoId ? 'selected' : '' }}>
                                        {{ $producto->Nombre }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="EmpleadoId">Empleado:</label>
                            <select name="EmpleadoId" id="EmpleadoId" class="form-control" required>
                                @foreach($empleados as $empleado)
                                    <option value="{{ $empleado->EmpleadoId }}" {{ old('EmpleadoId', $transaccion->EmpleadoId) == $empleado->EmpleadoId ? 'selected' : '' }}>
                                        {{ $empleado->persona->Nombres }} {{ $empleado->persona->Apellidos }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="SucursalId">Sucursal:</label>
                            <select name="SucursalId" id="SucursalId" class="form-control" required>
                                @foreach($sucursales as $sucursal)
                                    <option value="{{ $sucursal->SucursalId }}" {{ old('SucursalId', $transaccion->SucursalId) == $sucursal->SucursalId ? 'selected' : '' }}>
                                        {{ $sucursal->Nombre }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="Cantidad">Cantidad:</label>
                            <input type="number" name="Cantidad" id="Cantidad" class="form-control" value="{{ old('Cantidad', $transaccion->Cantidad) }}" required min="1">
                        </div>

                        <div class="form-group mb-0">
                            <button type="submit" class="btn btn-primary">Actualizar</button>
                            <a href="{{ route('transacciones.index') }}" class="btn btn-secondary">Cancelar</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
