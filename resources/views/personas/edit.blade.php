@extends('layouts.master')
@section('content')
<h1>Editar Persona</h1>

<form action="{{ route('personas.update', $persona->Ci) }}" method="post">
    @csrf
    @method('PUT')
    <label for="ci">Nombres:</label>
    <input type="number" name="ci" id="ci" value="{{ $persona->Ci }}">
    <label for="nombres">Nombres:</label>
    <input type="text" name="nombres" id="nombres" value="{{ $persona->Nombres }}">
    <label for="correo">Apellidos</label>
    <input type="text" name="apellidos" id="apellidos" value="{{ $persona->Apellidos }}">
    <label for="direccion">Dirección:</label>
    <input type="text" name="direccion" id="direccion" value="{{ $persona->Direccion }}">
    <button type="submit">Guardar Cambios</button>
</form>
@endsection