@extends('layouts.master')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Editar Marca</div>

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

                    <form action="{{ route('marcas.update', $marca->MarcaId) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label for="Nombre">Nombre:</label>
                            <input type="text" class="form-control" name="Nombre" id="Nombre" value="{{ $marca->Nombre }}" required>
                        </div>
                        <div class="form-group">
                            <label for="Procedencia">Procedencia:</label>
                            <input type="text" class="form-control" name="Procedencia" id="Procedencia" value="{{ $marca->Procedencia }}" required>
                        </div>
                        <div class="form-group">
                            <label for="Descripcion">Descripción:</label>
                            <textarea class="form-control" name="Descripcion" id="Descripcion" rows="3" required>{{ $marca->Descripcion }}</textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">Guardar Cambios</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
