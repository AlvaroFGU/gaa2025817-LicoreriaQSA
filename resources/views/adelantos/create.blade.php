@extends('layouts.master')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Crear Adelanto para {{ $empleado->persona->Nombres }} {{ $empleado->persona->Apellidos }}</div>

                    <div class="card-body">
                        <form action="{{ route('adelantos.store', $empleado->EmpleadoId) }}" method="POST">
                            @csrf

                            <div class="form-group">
                                <label for="Monto">Monto:</label>
                                <input type="number" step="0.01" name="Monto" id="Monto" class="form-control" value="{{ old('Monto') }}" required>
                                @error('Monto')
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
@endsection
