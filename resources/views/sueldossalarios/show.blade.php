<!-- resources/views/sueldossalarios/show.blade.php -->

@extends('layouts.master')

@section('content')
<div class="container">
    <h1>Detalles del Sueldo/Salario</h1>
    <p>ID: {{ $sueldossalario->SueldosId }}</p>
    <p>Cargo: {{ $sueldossalario->Cargo }}</p>
    <p>Monto: {{ $sueldossalario->Monto }}</p>
    <a href="{{ route('sueldossalarios.index') }}" class="btn btn-primary">Volver</a>
</div>
@endsection
