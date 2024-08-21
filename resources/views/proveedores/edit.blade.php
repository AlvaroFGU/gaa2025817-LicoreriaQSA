@extends('layouts.master')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Editar Proveedor</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('proveedores.update', $proveedor->ProveedorId) }}">
                        @csrf
                        @method('PUT')

                        <div class="form-group">
                            <label for="Ci">CI:</label>
                            <input type="text" name="Ci" id="Ci" class="form-control" value="{{ old('Ci', $proveedor->persona->Ci) }}" required>
                            @error('Ci')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="Nombres">Nombres:</label>
                            <input type="text" name="Nombres" id="Nombres" class="form-control" value="{{ old('Nombres', $proveedor->persona->Nombres) }}" required>
                            @error('Nombres')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="Apellidos">Apellidos:</label>
                            <input type="text" name="Apellidos" id="Apellidos" class="form-control" value="{{ old('Apellidos', $proveedor->persona->Apellidos) }}" required>
                            @error('Apellidos')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="Direccion">Dirección:</label>
                            <input type="text" name="Direccion" id="Direccion" class="form-control" value="{{ old('Direccion', $proveedor->persona->Direccion) }}" required>
                            @error('Direccion')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="Telefono">Teléfono:</label>
                            <input type="text" name="Telefono" id="Telefono" class="form-control" value="{{ old('Telefono', $proveedor->Telefono) }}" required>
                            @error('Telefono')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="Correo">Correo Electrónico:</label>
                            <input type="email" name="Correo" id="Correo" class="form-control" value="{{ old('Correo', $proveedor->Correo) }}" required>
                            @error('Correo')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-primary">Actualizar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
