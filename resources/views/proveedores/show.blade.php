@extends('layouts.master')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Detalles del Proveedor</div>

                <div class="card-body">
                    <div class="form-group">
                        <label for="Nombres">Nombres:</label>
                        <input type="text" id="Nombres" class="form-control" value="{{ $proveedor->persona->Nombres }}" readonly>
                    </div>

                    <div class="form-group">
                        <label for="Apellidos">Apellidos:</label>
                        <input type="text" id="Apellidos" class="form-control" value="{{ $proveedor->persona->Apellidos }}" readonly>
                    </div>

                    <div class="form-group">
                        <label for="Ci">CI:</label>
                        <input type="text" id="Ci" class="form-control" value="{{ $proveedor->persona->Ci }}" readonly>
                    </div>

                    <div class="form-group">
                        <label for="Telefono">Teléfono:</label>
                        <input type="text" id="Telefono" class="form-control" value="{{ $proveedor->Telefono }}" readonly>
                    </div>

                    <div class="form-group">
                        <label for="Correo">Correo:</label>
                        <input type="email" id="Correo" class="form-control" value="{{ $proveedor->Correo }}" readonly>
                    </div>

                    <a href="{{ route('proveedores.index') }}" class="btn btn-primary">Volver</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
