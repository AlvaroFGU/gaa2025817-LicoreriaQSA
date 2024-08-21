@extends('layouts.master')
@section('content')
<div class="container">
   <h3>Detalles del Empleado</h3>


   
      <div class="row d-flex justify-content">
          <div class="col-md-4">
              <div class="card mb-4">
                  <div class="card-body">
                     <h4 class="card-title">Datos de la Persona:</h4>
                     <ul class="list-group">
                      <li class="list-group-item"><strong>Ci:</strong> {{ $empleado->persona->Ci }} </li>
                         <li class="list-group-item"><strong>Nombre:</strong> {{ $empleado->persona->Nombres }} {{ $empleado->persona->Apellidos }}</li>
                         <li class="list-group-item"><strong>Fecha de Nacimiento:</strong> {{ $empleado->FechaNacimiento }}</li>
                         <li class="list-group-item"><strong>Dirección:</strong> {{ $empleado->persona->Direccion }}</li>
                     </ul>
                  </div>
              </div>
          </div>
          <div class="col-md-4">
              <div class="card mb-4">
                  <div class="card-body">
                     <h4 class="card-title">Datos del Usuario:</h4>
                     <ul class="list-group">
                         <li class="list-group-item"><strong>Correo Electrónico:</strong> {{ $empleado->usuario->Correo }}</li>
                     </ul>
                  </div>
              </div>
          </div>
          <div class="col-md-4">
              <div class="card mb-4">
                  <div class="card-body">
                     <h4 class="card-title">Rol del Empleado:</h4>
                     <ul class="list-group">
                         <li class="list-group-item"><strong>Rol:</strong> {{ $empleado->rol->Nombre }}</li>
                     </ul>
                  </div>
              </div>
          </div>
          <div class="col-md-4">
            <div class="card mb-4">
                <div class="card-body">
                  <h4 class="card-title">Datos Laborales:</h4>
                  <ul class="list-group">
                      <li class="list-group-item"><strong>Fecha de Contrato:</strong> {{ $empleado->FechaContrato }}</li>
                      <li class="list-group-item"><strong>Sucursal:</strong> {{ $empleado->sucursal->Nombre }}, {{ $empleado->sucursal->Direccion }}</li>
                  </ul>
                </div>
            </div>
        </div>
      </div>
 
  


   <div class="container">
      <!-- Resto del código... -->
  
      <!-- Enlace para volver al índice -->
      <a href="{{ route('empleados.index') }}" class="btn btn-primary mt-3">Volver</a>
  
      <!-- Enlace para ir a la página de edición -->
      <a href="{{ route('empleados.edit', $empleado->EmpleadoId) }}" class="btn btn-secondary mt-3">Editar Empleado</a>
  </div>
</div>


@endsection