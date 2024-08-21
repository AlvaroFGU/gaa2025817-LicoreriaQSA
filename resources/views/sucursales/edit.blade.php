@extends('layouts.master')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Editar Sucursal</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('sucursales.update', $sucursal->SucursalId) }}">
                            @csrf
                            @method('PUT')

                            <div class="form-group">
                                <label for="Nombre">Nombre:</label>
                                <input type="text" name="Nombre" id="Nombre" class="form-control" value="{{ old('Nombre', $sucursal->Nombre) }}" required>
                                @error('Nombre')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="Direccion">Dirección:</label>
                                <input type="text" name="Direccion" id="Direccion" class="form-control" value="{{ old('Direccion', $sucursal->Direccion) }}" required>
                                @error('Direccion')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <button type="submit" class="btn btn-primary">Guardar Cambios</button>
                            <a href="{{ route('sucursales.index') }}" class="btn btn-info">Volver</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
