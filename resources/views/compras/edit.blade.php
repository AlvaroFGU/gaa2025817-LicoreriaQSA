@extends('layouts.master')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Editar Compra</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('compras.update', $compra->CompraId) }}">
                        @csrf
                        @method('PUT')

                        <div class="form-group">
                            <label for="Fecha">Fecha:</label>
                            <input type="date" name="Fecha" id="Fecha" class="form-control" value="{{ old('Fecha', $compra->Fecha) }}" readonly>
                            @error('Fecha')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="MontoTotal">Monto Total:</label>
                            <input type="number" step="0.01" name="MontoTotal" id="MontoTotal" class="form-control" value="{{ old('MontoTotal', $compra->MontoTotal) }}" required>
                            @error('MontoTotal')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="MontoPagado">Monto Pagado:</label>
                            <input type="number" step="0.01" name="MontoPagado" id="MontoPagado" class="form-control" value="{{ old('MontoPagado', $compra->MontoPagado) }}" required>
                            @error('MontoPagado')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="ProveedorId">Proveedor:</label>
                            <select name="ProveedorId" id="ProveedorId" class="form-control" required>
                                @foreach($proveedores as $proveedor)
                                    <option value="{{ $proveedor->ProveedorId }}" {{ old('ProveedorId', $compra->ProveedorId) == $proveedor->ProveedorId ? 'selected' : '' }}>
                                        {{ $proveedor->Correo }}
                                    </option>
                                @endforeach
                            </select>
                            @error('ProveedorId')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="EmpleadoId">Empleado:</label>
                            <select name="EmpleadoId" id="EmpleadoId" class="form-control" required>
                                @foreach($empleados as $empleado)
                                    <option value="{{ $empleado->EmpleadoId }}" {{ old('EmpleadoId', $compra->EmpleadoId) == $empleado->EmpleadoId ? 'selected' : '' }}>
                                        {{ $empleado->persona->Nombres }} {{ $empleado->persona->Apellidos }}
                                    </option>
                                @endforeach
                            </select>
                            @error('EmpleadoId')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-primary">Actualizar</button>
                        <a href="{{ route('compras.index') }}" class="btn btn-secondary">Cancelar</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
