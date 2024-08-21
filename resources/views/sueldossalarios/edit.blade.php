@extends('layouts.master')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Editar Sueldo</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('sueldossalarios.update', $sueldossalario->SueldosId) }}">
                            @csrf
                            @method('PUT')

                            <div class="form-group">
                                <label for="Cargo">Cargo:</label>
                                <input type="text" name="Cargo" id="Cargo" class="form-control" value="{{ old('Cargo', $sueldossalario->Cargo) }}" required>
                                @error('Cargo')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="Monto">Monto:</label>
                                <input type="number" name="Monto" id="Monto" class="form-control" step="0.01" value="{{ old('Monto', $sueldossalario->Monto) }}" required>
                                @error('Monto')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <button type="submit" class="btn btn-primary">Guardar Cambios</button>
                            <a href="{{ route('sueldossalarios.index') }}" class="btn btn-info">Volver</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
