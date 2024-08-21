@extends('layouts.master')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Editar Producto</div>

                    <div class="card-body">
                        <form action="{{ route('productos.update', $producto->ProductoId) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <label for="Nombre">Nombre:</label>
                                <input type="text" class="form-control @error('Nombre') is-invalid @enderror"
                                    name="Nombre" id="Nombre" value="{{ old('Nombre', $producto->Nombre) }}" required>
                                @error('Nombre')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="Precio">Precio:</label>
                                <input type="number" class="form-control @error('Precio') is-invalid @enderror"
                                step="0.01" name="Precio" id="Precio" value="{{ old('Precio', $producto->Precio) }}" required>
                                @error('Precio')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="Descripcion">Descripción:</label>
                                <textarea class="form-control @error('Descripcion') is-invalid @enderror"
                                    name="Descripcion" id="Descripcion" rows="3"
                                    required>{{ old('Descripcion', $producto->Descripcion) }}</textarea>
                                @error('Descripcion')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="Modelo">Modelo:</label>
                                <input type="text" class="form-control @error('Modelo') is-invalid @enderror"
                                    name="Modelo" id="Modelo" value="{{ old('Modelo', $producto->Modelo) }}" required>
                                @error('Modelo')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="MarcaId">Marca:</label>
                                <select class="form-control @error('MarcaId') is-invalid @enderror" name="MarcaId"
                                    id="MarcaId" required>
                                    <option value="">Seleccione una marca</option>
                                    @foreach ($marcas as $marca)
                                        <option value="{{ $marca->MarcaId }}"
                                            {{ $marca->MarcaId == $producto->MarcaId ? 'selected' : '' }}>
                                            {{ $marca->Nombre }}</option>
                                    @endforeach
                                </select>
                                @error('MarcaId')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="ImagenUrl">Imagen:</label>
                                <input type="file" class="form-control @error('ImagenUrl') is-invalid @enderror"
                                    name="ImagenUrl" id="ImagenUrl">
                                @error('ImagenUrl')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <button type="submit" class="btn btn-primary">Actualizar</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
