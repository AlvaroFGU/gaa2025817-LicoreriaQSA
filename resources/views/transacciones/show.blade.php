@extends('layouts.master')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Detalle de la Transacción</div>

                <div class="card-body">
                    <div class="form-group">
                        <label for="Fecha">Fecha:</label>
                        <input type="text" class="form-control" value="{{ $transaccion->Fecha }}" readonly>
                    </div>

                    <div class="form-group">
                        <label for="Producto">Producto:</label>
                        <input type="text" class="form-control" value="{{ $transaccion->producto->Nombre }}" readonly>
                    </div>

                    <div class="form-group">
                        <label for="Empleado">Empleado:</label>
                        <input type="text" class="form-control" value="{{ $transaccion->empleado->persona->Nombres }} {{ $transaccion->empleado->persona->Apellidos }}" readonly>
                    </div>

                    <div class="form-group">
                        <label for="Cantidad">Cantidad:</label>
                        <input type="text" class="form-control" value="{{ $transaccion->Cantidad }}" readonly>
                    </div>

                    <div class="form-group">
                        <label for="Sucursal">Sucursal:</label>
                        <input type="text" class="form-control" value="{{ $transaccion->sucursal->Nombre }}" readonly>
                    </div>

                    <div class="form-group mb-0">
                        <a href="{{ route('transacciones.index') }}" class="btn btn-secondary">Volver</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
