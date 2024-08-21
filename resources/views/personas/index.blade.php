@extends('layouts.master')
@section('content')
    
<div class="container">
    <h2>Lista de Personas</h2>

    <div class="table-responsive"> 
        <div class="table-responsive">
            <table class="table table-striped"> 
                <thead>
                    <tr>
                        <th>Ci</th>
                        <th>Nombre</th>
                        <th>Apellidos</th>
                        <th>Dirección</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($personas as $persona)
                    <tr>
                        <td>{{$persona->Ci}}</td>
                        <td>{{ $persona->Nombres }}</td>
                        <td>{{ $persona->Apellidos }}</td>
                        <td>{{ $persona->Direccion }}</td>
                        <td>
                            <a href="{{ route('personas.show', $persona->Ci) }}" class="btn btn-info">Ver</a>
                            <a href="{{ route('personas.edit', $persona->Ci) }}" class="btn btn-primary">Editar</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        
    </div>

    <a href="{{ route('personas.create') }}" class="btn btn-success">Crear Nueva Persona</a>
</div>

@endsection