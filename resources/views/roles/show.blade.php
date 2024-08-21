<!-- resources/views/roles/show.blade.php -->

@extends('layouts.master')

@section('content')
<div class="container">
    <h1>Detalles del Rol</h1>
    <p>ID: {{ $rol->RolId }}</p>
    <p>Nombre: {{ $rol->Nombre }}</p>
    <p>Descripción: {{ $rol->Descripcion }}</p>
    <p>Permisos: {{ $rol->Permisos }}</p>
    <a href="{{ route('roles.index') }}" class="btn btn-primary">Volver</a>
</div>
@endsection
