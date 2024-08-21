@extends('layouts.master')

@section('content')
<div class="container justify-content-end">
    <!-- Aquí va el código de la vista index.blade.php -->
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="row justify-content-lg-end">
        <div class="col-md-12">
            
            <div class="card">
                <div>
                    <div>
                        <form class="nav-link mt-2 mt-md-0 d-lg-flex search">
                            <input type="text" id="searchInput" class="form-control" placeholder="Buscar en inventario...">
                        </form>
                    </div>            
                </div>
                <h3 class="card-header">Lista del Inventario</h3>

                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Producto</th>
                                    <th>Sucursal</th>
                                    <th>Cantidad</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($inventarios as $inventario)
                                    <tr>
                                        <td>{{ $inventario->producto->Nombre }}</td>
                                        <td>{{ $inventario->sucursal->Nombre }}</td>
                                        <td>{{ $inventario->Cantidad }}</td>
                                        <td>
                                            <a href="{{ route('inventarios.show', $inventario->InventarioId) }}" class="btn btn-info btn-sm">Ver</a>
                                            <a href="{{ route('inventarios.edit', $inventario->InventarioId) }}" class="btn btn-primary btn-sm">Editar</a>
                                            <form action="{{ route('inventarios.destroy', $inventario->InventarioId) }}" method="POST" style="display: inline-block;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('¿Estás seguro de eliminar este inventario?')">Eliminar</button>
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
    {{ $inventarios->links('vendor.pagination.bootstrap-4') }} <!-- Enlaces de paginación -->
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
