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
                        <input type="text" id="searchInput" class="form-control" placeholder="Buscar empleado...">
                    </form>
                </div>
                <h3 class="card-header">Lista de Empleados</h3>

                <div class="card-body">
                <a href="{{ route('empleados.create') }}" class="btn btn-success">Crear Nuevo Empleado</a>
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Nombre</th>
                                <th>Correo Electrónico</th>
                                <th>Rol</th>
                                <th>Cargo</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($empleados as $empleado)
                                <tr>
                                    <td>{{ $empleado->persona->Nombres }} {{ $empleado->persona->Apellidos }}</td>
                                    <td>{{ $empleado->UsuarioId }}</td>
                                    <td>{{ $empleado->rol->Nombre }}</td>
                                    <td>{{ $empleado->sueldo->Cargo }}</td>
                                    <td>
                                        <a href="{{ route('empleados.show', $empleado->EmpleadoId) }}" class="btn btn-sm btn-info">Ver</a>
                                        <a href="{{ route('empleados.edit', $empleado->EmpleadoId) }}" class="btn btn-sm btn-primary">Editar</a>
                                        <a href="{{ route('empleados.adelanto', $empleado->EmpleadoId) }}" class="btn btn-sm btn-info">Adelantos</a>
    
                                        <form action="{{ route('empleados.destroy', $empleado->EmpleadoId) }}"
                                            method="POST" style="display: inline-block;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger"
                                                onclick="return confirm('¿Estás seguro de eliminar este Empleado?')">Eliminar</button>
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
    {{ $empleados->links('vendor.pagination.bootstrap-4') }} <!-- Enlaces de paginación -->
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
