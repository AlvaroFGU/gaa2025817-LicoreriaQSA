<!-- resources/views/personas/create.blade.php -->

@extends('layouts.master')

@section('content')
<div class="container">
    <h1>Crear Nueva Persona</h1>

    <form action="{{ route('personas.store') }}" method="post" id="crearPersonaForm">
        @csrf
        <div class="mb-3">
            <label for="Ci" class="form-label">Ci:</label>
            <input type="number" class="form-control" name="Ci" id="Ci" required pattern="[0-9]{6,10}" title="Por favor, ingresa un número de CI válido (entre 6 y 10 dígitos).">
        </div>
        <div class="mb-3">
            <label for="Nombres" class="form-label">Nombres:</label>
            <input type="text" class="form-control" name="Nombres" id="Nombres" required pattern="[A-Za-z\s]{3,}" title="Por favor, ingresa un nombre válido (solo letras y al menos 3 caracteres).">
        </div>
        <div class="mb-3">
            <label for="Apellidos" class="form-label">Apellidos:</label>
            <input type="text" class="form-control" name="Apellidos" id="Apellidos" required pattern="[A-Za-z\s]{3,}" title="Por favor, ingresa un apellido válido (solo letras y al menos 3 caracteres).">
        </div>
        <div class="mb-3">
            <label for="Direccion" class="form-label">Dirección:</label>
            <input type="text" class="form-control" name="Direccion" id="Direccion" required title="Por favor, ingresa una dirección válida.">
        </div>
        <button type="submit" class="btn btn-primary">Guardar</button>
    </form>
</div>
@endsection
