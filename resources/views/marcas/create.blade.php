@extends('layouts.master')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Crear Marca</div>

                <div class="card-body">
                    @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif

                    <form action="{{ route('marcas.store') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="Nombre">Nombre:</label>
                            <input type="text" class="form-control" name="Nombre" id="Nombre" required>
                            @error('Nombre')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                        </div>
                        <div class="form-group">
                            <label for="Procedencia">Procedencia:</label>
                            <input type="text" class="form-control" name="Procedencia" id="Procedencia" required>
                            @error('Procedencia')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                        </div>
                        <div class="form-group">
                            <label for="Descripcion">Descripción:</label>
                            <textarea class="form-control" name="Descripcion" id="Descripcion" rows="3" required></textarea>
                            @error('Descripcion')
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
