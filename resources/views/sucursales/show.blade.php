<!-- resources/views/sucursales/show.blade.php -->

@extends('layouts.master')

@section('content')
<div class="container">
    <h1>Detalles de la Sucursal</h1>
    <p>ID: {{ $sucursal->SucursalId }}</p>
    <p>Nombre: {{ $sucursal->Nombre }}</p>
    <p>Dirección: {{ $sucursal->Direccion }}</p>
    <a href="{{ route('sucursales.index') }}" class="btn btn-primary">Volver</a>
</div>
@endsection
