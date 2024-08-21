@extends('layouts.master')

@section('content')
<div class="container justify-content">
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="row justify-content">
        <div class="col-md-12">
            <div class="card">
                <div>
                    <div>
                        <form class="nav-link mt-2 mt-md-0 d-lg-flex search">
                            <input type="text" id="searchInput" class="form-control" placeholder="Buscar transaccion...">
                        </form>
                    </div>                </div>
                <h3 class="card-header">Lista de Transacciones</h3>

                <div class="card-body">
                    <a href="{{ route('transacciones.create') }}" class="btn btn-success">Crear Nueva Transacción</a>
                    @if (count($transacciones) > 0)
                    <a href="{{ route('transacciones.export') }}" class="btn btn-success">Exportar</a>
                    @endif
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Fecha</th>
                                    <th>Empleado</th>
                                    <th>Producto</th>
                                    <th>Marca</th>
                                    <th>Cantidad</th>
                                    <th>Sucursal</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($transacciones as $transaccion)
                                    <tr>
                                        <td>{{ $transaccion->Fecha }}</td>
                                        <td>{{ $transaccion->empleado->persona->Nombres }} {{ $transaccion->empleado->persona->Apellidos }}</td>
                                        <td>{{ $transaccion->producto->Nombre }}</td>
                                        <td>{{ $transaccion->producto->marca->Nombre }}</td>
                                        <td>{{ $transaccion->Cantidad }}</td>
                                        <td>{{ $transaccion->sucursal->Nombre }}</td>
                                        <td>
                                            <a href="{{ route('transacciones.show', $transaccion->TransaccionId) }}" class="btn btn-sm btn-info">Ver</a>
                                            <a href="{{ route('transacciones.edit', $transaccion->TransaccionId) }}" class="btn btn-sm btn-primary">Editar</a>
                                            <form action="{{ route('transacciones.destroy', $transaccion->TransaccionId) }}" method="POST" style="display: inline-block;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('¿Estás seguro de eliminar esta transacción?')">Eliminar</button>
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
    {{ $transacciones->links('vendor.pagination.bootstrap-4') }} <!-- Enlaces de paginación -->
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
