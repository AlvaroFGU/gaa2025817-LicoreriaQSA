@extends('layouts.master')

@section('content')
<div class="container justify-content-end">
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="row justify-content-lg-end">
        <div class="col-md-12">
            <div class="card">
                <div>
                    <form class="nav-link mt-2 mt-md-0 d-lg-flex search">
                        <input type="text" id="searchInput" class="form-control" placeholder="Buscar proveedor...">
                    </form>
                </div>
                <h3 class="card-header">Lista de Proveedores</h3>

                <div class="card-body">
                    <a href="{{ route('proveedores.create') }}" class="btn btn-success">Crear Nuevo Proveedor</a>
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Nombres</th>
                                    <th>Apellidos</th>
                                    <th>CI</th>
                                    <th>Teléfono</th>
                                    <th>Correo</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($proveedores as $proveedor)
                                    <tr>
                                        <td>{{ $proveedor->persona->Nombres }}</td>
                                        <td>{{ $proveedor->persona->Apellidos }}</td>
                                        <td>{{ $proveedor->persona->Ci }}</td>
                                        <td>{{ $proveedor->Telefono }}</td>
                                        <td>{{ $proveedor->Correo }}</td>
                                        <td>
                                            <a href="{{ route('proveedores.show', $proveedor->ProveedorId) }}" class="btn btn-sm btn-info">Ver</a>
                                            <a href="{{ route('proveedores.edit', $proveedor->ProveedorId) }}" class="btn btn-sm btn-primary">Editar</a>
                                            <form action="{{ route('proveedores.destroy', $proveedor->ProveedorId) }}"
                                                  method="POST" style="display: inline-block;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger"
                                                        onclick="return confirm('¿Estás seguro de eliminar este proveedor?')">Eliminar</button>
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
    {{ $proveedores->links('vendor.pagination.bootstrap-4') }} <!-- Enlaces de paginación -->
</div>
<style>
    .pagination-container {
        position: fixed;
        bottom: 50px; /* Ajusta este valor según tus necesidades */
        right: 20px;  /* Ajusta este valor según tus necesidades */
    }
</style>
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
@endsection


