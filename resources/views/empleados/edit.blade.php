@extends('layouts.master')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Editar Empleado</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('empleados.update', $empleado->EmpleadoId) }}">
                        @csrf
                        @method('PUT')

                        <!-- Campos de la tabla empleados -->
                        <div class="form-group">
                            <label for="FechaNacimiento">Fecha de Nacimiento:</label>
                            <input type="date" name="FechaNacimiento" id="FechaNacimiento" class="form-control" value="{{ old('FechaNacimiento', $empleado->FechaNacimiento) }}">
                            @error('FechaNacimiento')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="FechaContrato">Fecha de Contrato:</label>
                            <input type="date" name="FechaContrato" id="FechaContrato" class="form-control" value="{{ old('FechaContrato', $empleado->FechaContrato) }}">
                            @error('FechaContrato')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Campos de la tabla personas -->
                        <div class="form-group">
                            <label for="Ci">Ci:</label>
                            <input type="number" name="Ci" id="Ci" class="form-control" value="{{ old('Ci', $empleado->persona->Ci) }}">
                            @error('Ci')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="Nombres">Nombres:</label>
                            <input type="text" name="Nombres" id="Nombres" class="form-control" value="{{ old('Nombres', $empleado->persona->Nombres) }}">
                            @error('Nombres')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="Apellidos">Apellidos:</label>
                            <input type="text" name="Apellidos" id="Apellidos" class="form-control" value="{{ old('Apellidos', $empleado->persona->Apellidos) }}">
                            @error('Apellidos')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="Direccion">Dirección:</label>
                            <input type="text" name="Direccion" id="Direccion" class="form-control" value="{{ old('Direccion', $empleado->persona->Direccion) }}">
                            @error('Direccion')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Campos de la tabla Usuario -->
                        <div class="form-group">
                            <label for="Correo">Correo Electrónico:</label>
                            <input type="email" name="Correo" id="Correo" class="form-control" value="{{ old('Correo', $empleado->usuario->Correo) }}">
                            @error('Correo')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="Contrasenia">Contraseña:</label>
                            <input type="password" name="Contrasenia" id="Contrasenia" class="form-control">
                            @error('Contrasenia')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Campos relacionados -->
                        <div class="form-group">
                            <label for="RolId">Rol:</label>
                            <select name="RolId" id="RolId" class="form-control">
                                @foreach($roles as $rol)
                                <option value="{{ $rol->RolId }}" {{ old('RolId', $empleado->rol->RolId) == $rol->RolId ? 'selected' : '' }}>{{ $rol->Nombre }}</option>
                                @endforeach
                            </select>
                            @error('RolId')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="SueldoId">Sueldo:</label>
                            <select name="SueldoId" id="SueldoId" class="form-control">
                                @foreach($sueldos as $sueldo)
                                <option value="{{ $sueldo->SueldosId }}" {{ old('SueldoId', $empleado->sueldo->SueldosId) == $sueldo->SueldosId ? 'selected' : '' }}>{{ $sueldo->Cargo }}: {{ $sueldo->Monto }}</option>
                                @endforeach
                            </select>
                            @error('SueldoId')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="SucursalId">Sucursal:</label>
                            <select name="SucursalId" id="SucursalId" class="form-control">
                                @foreach($sucursales as $sucursal)
                                <option value="{{ $sucursal->SucursalId }}" {{ old('SucursalId', $empleado->sucursal->SucursalId) == $sucursal->SucursalId ? 'selected' : '' }}>{{ $sucursal->Nombre }}</option>
                                @endforeach
                            </select>
                            @error('SucursalId')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-primary">Guardar Cambios</button>
                        <a href="{{ route('empleados.index') }}" class="btn btn-info">Volver</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
