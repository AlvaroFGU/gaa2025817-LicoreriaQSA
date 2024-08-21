@extends('layouts.master')

@section('content')
<div class="container justify-content-end">
    <!-- Aquí va el código de la vista index.blade.php -->
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="row justify-content-lg">
        <div class="col-md-8">
            
            <div class="card">
                <div>
                    <form class="nav-link mt-2 mt-md-0 d-lg-flex search">
                        <input type="text" id="searchInput" class="form-control" placeholder="Buscar marca...">
                    </form>
                </div>
                <h3 class="card-header">Lista de Marcas</h3>

                <div class="card-body">
                    <a href="{{ route('marcas.create') }}" class="btn btn-primary mb-3">Crear Marca</a>
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">Nombre</th>
                                    <th scope="col">Procedencia</th>
                                    <th scope="col" style="display: none;">Descripción</th>
                                    <th scope="col">Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($marcas as $marca)
                                <tr>
                                    <td>{{ $marca->Nombre }}</td>
                                    <td>{{ $marca->Procedencia }}</td>
                                    <td style="display: none;">{{ $marca->Descripcion }}</td>
                                    <td>
                                        <a href="{{ route('marcas.show', $marca->MarcaId) }}" class="btn btn-info">Ver</a>
                                        <a href="{{ route('marcas.edit', $marca->MarcaId) }}" class="btn btn-primary">Editar</a>
                                        <form action="{{ route('marcas.destroy', $marca->MarcaId) }}" method="POST" style="display: inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger" onclick="return confirm('¿Estás seguro de eliminar esta marca?')">Eliminar</button>
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
</div>
<div class="pagination-container">
    {{ $marcas->links('vendor.pagination.bootstrap-4') }} <!-- Enlaces de paginación -->
</div>
<style>
    .pagination-container {
        position: fixed;
        bottom: 50px; /* Ajusta este valor según tus necesidades */
        right: 20px;  /* Ajusta este valor según tus necesidades */
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