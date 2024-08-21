@extends('layouts.master')

@section('content')
    <div class="container">
        <div class="row justify-content-lg-end">
            <div class="col-md-12">
                @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif
                <div class="card">
                    <div>
                        <form class="nav-link mt-2 mt-md-0 d-lg-flex search">
                            <input type="text" id="searchInput" class="form-control" placeholder="Buscar sueldo...">
                        </form>

                    </div>
                    <h3 class="card-header">Lista de Sueldos</h3>
                    <div class="card-body">
                        <a href="{{ route('sueldossalarios.create') }}" class="btn btn-success">Crear Nuevo Sueldo</a>
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Cargo</th>
                                        <th>Monto</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody id="sueldosTableBody">
                                    @foreach($sueldossalarios as $sueldossalario)
                                        <tr>
                                            <td>{{ $sueldossalario->Cargo }}</td>
                                            <td>{{ $sueldossalario->Monto }}</td>
                                            <td>
                                                <a href="{{ route('sueldossalarios.show', $sueldossalario->SueldosId) }}" class="btn btn-sm btn-primary">Ver</a>
                                                <a href="{{ route('sueldossalarios.edit', $sueldossalario->SueldosId) }}" class="btn btn-sm btn-warning">Editar</a>
                                                <form action="{{ route('sueldossalarios.destroy', $sueldossalario->SueldosId) }}" method="POST" style="display: inline-block;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('¿Estás seguro de eliminar este Sueldo?')">Eliminar</button>
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
        {{ $sueldossalarios->links('vendor.pagination.bootstrap-4') }} <!-- Enlaces de paginación -->
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
