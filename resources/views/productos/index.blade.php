@extends('layouts.master')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            @if (session('success'))
                <div class="alert alert-success col-md-12">
                    {{ session('success') }}
                </div>
            @endif
            <div class="col-md-12">
                <div class="card">
                    <div>
                        <form class="nav-link mt-2 mt-md-0 d-lg-flex search">
                            <input type="text" id="searchInput" class="form-control" placeholder="Buscar producto...">
                        </form>
                    </div>            
                    <h3 class="card-header">Productos</h3>
                    <div class="card-body">
                        <a href="{{ route('productos.create') }}" class="btn btn-primary mb-3">Crear Producto</a>
                        @if (count($productos) > 0)
                            <a href="{{ route('productos.export') }}" class="btn btn-primary mb-3">Exportar</a>
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th scope="col">Nombre</th>
                                            <th scope="col">Precio</th>
                                            <th scope="col">Modelo</th>
                                            <th scope="col">Marca</th>
                                            <th scope="col">Cantidad</th>
                                            <th scope="col">Acciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($productos as $producto)
                                            <tr>
                                                <td>{{ $producto->Nombre }}</td>
                                                <td>{{ $producto->Precio }}</td>
                                                <td>{{ $producto->Modelo }}</td>
                                                <td>{{ $producto->marca->Nombre }}</td>
                                                <td>{{ $producto->Cantidad }}</td>
                                                <td>
                                                    <a href="{{ route('productos.show', $producto->ProductoId) }}" class="btn btn-sm btn-primary">Ver</a>
                                                    <a href="{{ route('productos.edit', $producto->ProductoId) }}" class="btn btn-sm btn-warning">Editar</a>
                                                    <form action="{{ route('productos.destroy', $producto->ProductoId) }}" method="POST" style="display: inline-block;">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('¿Estás seguro de eliminar este producto?')">Eliminar</button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @else
                            <p>No hay productos disponibles.</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="pagination-container">
        {{ $productos->links('vendor.pagination.bootstrap-4') }}
    </div>
    <style>
        .pagination-container {
            position: fixed;
            bottom: 50px;
            right: 20px;
        }
    </style>
@endsection
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const searchInput = document.getElementById('searchInput');
        searchInput.addEventListener('input', function () {
            const searchTerm = searchInput.value.toLowerCase();
            const rows = document.querySelectorAll('tbody tr');
            rows.forEach(row => {
                const rowData = row.textContent.toLowerCase();
                if (rowData.includes(searchTerm)) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
            });
        });
    });
</script>
