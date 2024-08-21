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
                    <form class="nav-link mt-2 mt-md-0 d-lg-flex search">
                        <input type="text" id="searchInput" class="form-control" placeholder="Buscar rol...">
                    </form>
                </div>
                <h3 class="card-header">Lista de Roles</h3>

                <div class="card-body">
                    <a href="{{ route('roles.create') }}" class="btn btn-success">Crear Nuevo Rol</a>
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Nombre</th>
                                    <th>Descripción</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($roles as $rol)
                                    <tr>
                                        <td>{{ $rol->Nombre }}</td>
                                        <td>{{ $rol->Descripcion }}</td>
                                        <td>
                                            <a href="{{ route('roles.show', $rol->RolId) }}" class="btn btn-sm btn-info">Ver</a>
                                            <a href="{{ route('roles.edit', $rol->RolId) }}" class="btn btn-sm btn-primary">Editar</a>
                                            <form action="{{ route('roles.destroy', $rol->RolId) }}" method="POST" style="display: inline-block;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('¿Estás seguro de eliminar este Rol?')">Eliminar</button>
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
    {{ $roles->links('vendor.pagination.bootstrap-4') }} <!-- Enlaces de paginación -->
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


