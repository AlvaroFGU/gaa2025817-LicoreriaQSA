<!-- resources/views/roles/show.blade.php -->

@extends('layouts.master')

@section('content')
<div class="container">
    <h1>Detalles del Producto</h1>
    <p>ID: {{ $producto->ProductoId }}</p>
    <p>Nombre: {{ $producto->Nombre }}</p>
    <p>Precio: {{ $producto->Precio }}</p>
    <p>Modelo: {{ $producto->Modelo }}</p>
    <p>Caracteristicas: {{ $producto->Descripcion }}</p>

    <a href="{{ route('productos.index') }}" class="btn btn-primary">Volver</a>
</div>
@endsection
