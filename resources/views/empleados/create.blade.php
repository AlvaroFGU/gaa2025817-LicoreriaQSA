@extends('layouts.master')
@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
                    <div class="card">
            <div class="card-header">Crear Producto</div>

            <div class="card-body">
            <form action="{{ route('empleados.store') }}" method="post" >
                @csrf
                <h3>Crear Empleado</h3>
                <!-- Campos de persona -->
                <div class="form-group">
                    <label for="Ci">Ci:</label>
                    <input type="number" class="form-control" name="Ci" id="Ci" value="{{ old('Ci') }}">
                    @error('Ci')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="Nombres">Nombres:</label>
                    <input type="text" class="form-control" name="Nombres" id="Nombres" value="{{ old('Nombres') }}">
                    @error('Nombres')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="Apellidos">Apellidos:</label>
                    <input type="text" class="form-control" name="Apellidos" id="Apellidos" value="{{ old('Apellidos') }}">
                    @error('Apellidos')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="Direccion">Dirección:</label>
                    <input type="text" class="form-control" name="Direccion" id="Direccion" value="{{ old('Direccion') }}">
                    @error('Direccion')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
            
                <!-- Campos de usuario -->
                <div class="form-group">
                    <label for="Correo">Correo:</label>
                    <input type="email" class="form-control" name="Correo" id="Correo" value="{{ old('Correo') }}">
                    @error('Correo')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="Contrasenia">Contraseña:</label>
                    <input type="password" class="form-control" name="Contrasenia" id="Contrasenia">
                    @error('Contrasenia')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
            
                <!-- Campos de empleado -->
                <div class="form-group">
                    <label for="FechaNacimiento">Fecha de Nacimiento:</label>
                    <input type="date" class="form-control" name="FechaNacimiento" id="FechaNacimiento" value="{{ old('FechaNacimiento') }}">
                    @error('FechaNacimiento')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="FechaContrato">Fecha de Contrato:</label>
                    <input type="date" class="form-control" name="FechaContrato" id="FechaContrato" value="{{ old('FechaContrato') }}">
                    @error('FechaContrato')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                
                <!-- Select de Rol -->
                <div class="form-group">
                    <label for="RolId">Rol:</label>
                    <select class="form-control" name="RolId" id="RolId" required>
                        <option value="">Seleccione un rol</option>
                        @foreach($roles as $rol)
                            <option value="{{ $rol->RolId }}" {{ old('RolId') == $rol->RolId ? 'selected' : '' }}>{{ $rol->Nombre }}</option>
                        @endforeach
                    </select>
                    @error('RolId')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
            
                <!-- Select de Sueldo -->
                <div class="form-group">
                    <label for="SueldoId">Sueldo:</label>
                    <select class="form-control" name="SueldoId" id="SueldoId" required>
                        <option value="">Seleccione un sueldo</option>
                        @foreach($sueldos as $sueldo)
                            <option value="{{ $sueldo->SueldosId }}" {{ old('SueldoId') == $sueldo->SueldosId ? 'selected' : '' }}>{{ $sueldo->Cargo }}: {{ $sueldo->Monto }}</option>
                        @endforeach
                    </select>
                    @error('SueldoId')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
            
                <!-- Select de Sucursal -->
                <div class="form-group">
                    <label for="SucursalId">Sucursal:</label>
                    <select class="form-control" name="SucursalId" id="SucursalId" required>
                        <option value="">Seleccione una sucursal</option>
                        @foreach($sucursales as $sucursal)
                            <option value="{{ $sucursal->SucursalId }}" {{ old('SucursalId') == $sucursal->SucursalId ? 'selected' : '' }}>{{ $sucursal->Nombre }}</option>
                        @endforeach
                    </select>
                    @error('SucursalId')
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
</div>

</div>


@endsection
