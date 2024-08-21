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
                        <input type="text" id="searchInput" class="form-control mb-3" placeholder="Buscar compra...">
                    </form>
                </div>
                <h3 class="card-header">Lista de Compras</h3>
                <div class="card-body">
                    <a href="{{ route('compras.create') }}" class="btn btn-success mb-3">Crear Nueva Compra</a>
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Fecha</th>
                                    <th>Monto Total</th>
                                    <th>Monto Pagado</th>
                                    <th>Proveedor</th>
                                    <th>Empleado</th>
                                    <th>Pago</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($compras as $compra)
                                    <tr>
                                        <td>{{ $compra->Fecha }}</td>
                                        <td>{{ $compra->MontoTotal }}</td>
                                        <td>{{ $compra->MontoPagado }}</td>
                                        <td>{{ $compra->proveedor->persona->Nombres }} {{ $compra->proveedor->persona->Apellidos }}</td>
                                        <td>{{ $compra->empleado->persona->Nombres }} {{ $compra->empleado->persona->Apellidos }}</td>
                                        @if ($compra->MontoTotal > $compra->MontoPagado)
                                            <td>Pendiente</td>
                                        @else
                                            <td>Completado</td>
                                        @endif
                                             <td>
                                            <a href="{{ route('compras.show', $compra->CompraId) }}" class="btn btn-sm btn-info">Ver</a>
                                            <a href="{{ route('compras.edit', $compra->CompraId) }}" class="btn btn-sm btn-primary">Editar</a>
                                            <a href="{{ route('compras.pagos', $compra->CompraId) }}" class="btn btn-sm btn-warning">Pagos</a>
                                            <form action="{{ route('compras.destroy', $compra->CompraId) }}" method="POST" style="display: inline-block;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('¿Estás seguro de eliminar esta compra?')">Eliminar</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    
                    <div class="mt-3">
                        <a href="{{ url('/') }}" class="btn btn-secondary">Volver al inicio</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    document.getElementById('searchInput').addEventListener('input', function() {
        let filter = this.value.toLowerCase();
        let rows = document.querySelectorAll('tbody tr');

        rows.forEach(row => {
            let columns = row.querySelectorAll('td');
            let match = false;

            columns.forEach(column => {
                if (column.textContent.toLowerCase().indexOf(filter) > -1) {
                    match = true;
                }
            });

            if (match) {
                row.style.display = '';
            } else {
                row.style.display = 'none';
            }
        });
    });
</script>
@endsection
