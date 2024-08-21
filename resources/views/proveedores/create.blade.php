@extends('layouts.master')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Crear Nuevo Proveedor</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('proveedores.store') }}">
                        @csrf

                        <div class="form-group">
                            <label for="Ci">CI:</label>
                            <input type="text" name="Ci" id="Ci" class="form-control" value="{{ old('Ci') }}" required>
                            @error('Ci')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="Nombres">Nombres:</label>
                            <input type="text" name="Nombres" id="Nombres" class="form-control" value="{{ old('Nombres') }}" required>
                            @error('Nombres')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="Apellidos">Apellidos:</label>
                            <input type="text" name="Apellidos" id="Apellidos" class="form-control" value="{{ old('Apellidos') }}" required>
                            @error('Apellidos')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="Direccion">Dirección:</label>
                            <input type="text" name="Direccion" id="Direccion" class="form-control" value="{{ old('Direccion') }}" required>
                            @error('Direccion')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="Telefono">Teléfono:</label>
                            <input type="text" name="Telefono" id="Telefono" class="form-control" value="{{ old('Telefono') }}" required>
                            @error('Telefono')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="Correo">Correo Electrónico:</label>
                            <input type="email" name="Correo" id="Correo" class="form-control" value="{{ old('Correo') }}" required>
                            @error('Correo')
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
