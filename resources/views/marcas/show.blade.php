@extends('layouts.master')

@section('content')
<div class="container">
    <h1>Detalles de la Marca</h1>
    <p>ID: {{ $marca->MarcaId }}</p>
    <p>Nombre: {{ $marca->Nombre }}</p>
    <p>Procedencia: {{ $marca->Procedencia }}</p>
    <p>Descripción: {{ $marca->Descripcion }}</p>

    <a href="{{ route('marcas.index') }}" class="btn btn-primary">Volver</a>
</div>
@endsection
