@extends('layouts.master')

@section('content')
    <div class="container">
        @if (session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif
        <div class="row justify-content-center">
            <div class="col-md-12">
                
                <div class="card">
                    <div>
                        <form class="nav-link mt-2 mt-md-0 d-lg-flex search">
                            <input type="text" id="searchInput" class="form-control" placeholder="Buscar sucursal...">
                        </form>
                    </div>
                    <h3 class="card-header">Lista de Sucursales</h3>
                    <div class="card-body">
                        

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <a href="{{ route('sucursales.create') }}" class="btn btn-success">Crear Nueva Sucursal</a>
                            </div>
                            
                        </div>
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Nombre</th>
                                        <th>Dirección</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($sucursales as $sucursal)
                                        <tr>
                                            <td>{{ $sucursal->Nombre }}</td>
                                            <td>{{ $sucursal->Direccion }}</td>
                                            <td>
                                                <a href="{{ route('sucursales.show', $sucursal->SucursalId) }}" class="btn btn-sm btn-info">Ver</a>
                                                <a href="{{ route('sucursales.edit', $sucursal->SucursalId) }}" class="btn btn-sm btn-primary">Editar</a>
                                                <form action="{{ route('sucursales.destroy', $sucursal->SucursalId) }}" method="POST" style="display: inline-block;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('¿Estás seguro de eliminar esta Sucursal?')">Eliminar</button>
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
        {{ $sucursales->links('vendor.pagination.bootstrap-4') }} <!-- Enlaces de paginación -->
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

@section('scripts')
    
@endsection
