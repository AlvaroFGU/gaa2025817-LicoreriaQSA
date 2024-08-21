@extends('layouts.master')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Crear Nueva Transacción</div>

                <div class="card-body">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form method="POST" action="{{ route('transacciones.store') }}">
                        @csrf

                        <div class="form-group">
                            <label for="EmpleadoId">Empleado:</label>
                            <select name="EmpleadoId" id="EmpleadoId" class="form-control" required>
                                @foreach($empleados as $empleado)
                                    <option value="{{ $empleado->EmpleadoId }}" {{ old('EmpleadoId') == $empleado->EmpleadoId ? 'selected' : '' }}>
                                        {{ $empleado->persona->Nombres }} {{ $empleado->persona->Apellidos }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="SucursalId">Sucursal:</label>
                            <select name="SucursalId" id="SucursalId" class="form-control" required>
                                @foreach($sucursales as $sucursal)
                                    <option value="{{ $sucursal->SucursalId }}" {{ old('SucursalId') == $sucursal->SucursalId ? 'selected' : '' }}>
                                        {{ $sucursal->Nombre }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <h4>Productos Disponibles</h4>
                                <input type="text" id="searchAvailable" class="form-control mb-3" placeholder="Buscar producto...">
                                <ul id="availableProducts" class="list-group list-group-item-dark" style="max-height: 200px; overflow-y: scroll;">
                                    @foreach($productos as $producto)
                                        <li class="list-group-item">
                                            {{ $producto->Nombre }} ({{ $producto->Precio }} BS) ({{ $producto->Cantidad }} disponibles)
                                            <button type="button" class="btn btn-success btn-sm float-right add-product" data-id="{{ $producto->ProductoId }}" data-name="{{ $producto->Nombre }}" data-cantidad="{{ $producto->Cantidad }}" data-precio="{{ $producto->Precio }}">Añadir</button>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                            <div class="col-md-6">
                                <h4>Productos Seleccionados</h4>
                                <input type="text" id="searchSelected" class="form-control mb-3" placeholder="Buscar producto...">
                                <ul id="selectedProducts" class="list-group list-group-item-dark" style="max-height: 200px; overflow-y: scroll;">
                                    <!-- Productos seleccionados se agregarán aquí -->
                                </ul>
                            </div>
                        </div>
                        <div class="form-group mt-3">
                            <label for="montoCancelado">Monto Cancelado:</label>
                            <input type="number" id="montoCancelado" name="montoCancelado" class="form-control" placeholder="Monto Cancelado" required>
                        </div>
                        
                        <div class="form-group">
                            <p><strong>Total: </strong><span id="total">0.00</span> BS</p>
                            <p><strong>Cambio: </strong><span id="cambio">0.00</span> BS</p>
                        </div>
                        <div class="form-group mt-3">
                            <button type="submit" class="btn btn-primary">Crear</button>
                            <a href="{{ route('transacciones.index') }}" class="btn btn-secondary">Cancelar</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const availableProducts = document.getElementById('availableProducts');
    const selectedProducts = document.getElementById('selectedProducts');
    const montoCanceladoInput = document.getElementById('montoCancelado');
    const totalText = document.getElementById('total');
    const cambioText = document.getElementById('cambio');

    const updateTotals = () => {
        let total = 0;
        selectedProducts.querySelectorAll('li').forEach(item => {
            const cantidad = parseInt(item.querySelector('input[name*="Cantidad"]').value);
            const precio = parseFloat(item.getAttribute('data-precio'));
            const subtotal = cantidad * precio;
            total += subtotal;
            item.querySelector('.subtotal').textContent = `Subtotal: ${subtotal.toFixed(2)}`;
        });

        totalText.textContent = total.toFixed(2);
        const montoCancelado = parseFloat(montoCanceladoInput.value) || 0;
        const cambio = montoCancelado - total;
        cambioText.textContent = cambio.toFixed(2);
    };

    montoCanceladoInput.addEventListener('input', updateTotals);

    const addProduct = function() {
        const id = this.getAttribute('data-id');
        let name = this.getAttribute('data-name');
        const cantidadDisponible = this.getAttribute('data-cantidad');
        const precio = parseFloat(this.getAttribute('data-precio'));

        // Truncar el nombre si es mayor a 15 caracteres
        if (name.length > 15) {
            name = name.substring(0, 15) + '...';
        }

        const listItem = document.createElement('li');
        listItem.className = 'list-group-item';
        listItem.setAttribute('data-precio', precio);
        listItem.innerHTML = `
            ${name} (${precio.toFixed(2)} BS)
            <input type="hidden" name="productos[${id}][ProductoId]" value="${id}">
            <input type="number" name="productos[${id}][Cantidad]" class="form-control d-inline-block w-25 ml-2" placeholder="Cantidad" value="1" required min="1" max="${cantidadDisponible}">
            </br><span class="subtotal">Subtotal: ${precio.toFixed(2)}</span>
            <button type="button" class="btn btn-danger btn-sm float-right remove-product">Eliminar</button>
        `;
        selectedProducts.appendChild(listItem);
        this.closest('li').remove();

        listItem.querySelector('.remove-product').addEventListener('click', function() {
            const id = listItem.querySelector('input[type="hidden"]').value;
            const name = listItem.firstChild.textContent.trim();
            const newItem = document.createElement('li');
            newItem.className = 'list-group-item';
            newItem.innerHTML = `
                ${name} (${cantidadDisponible} disponibles)
                <button type="button" class="btn btn-success btn-sm float-right add-product" data-id="${id}" data-name="${name}" data-cantidad="${cantidadDisponible}" data-precio="${precio}">Añadir</button>
            `;
            availableProducts.appendChild(newItem);
            listItem.remove();

            // Reasignar el evento al botón "Añadir"
            newItem.querySelector('.add-product').addEventListener('click', addProduct);

            updateTotals();
        });

        listItem.querySelector('input[name*="Cantidad"]').addEventListener('input', updateTotals);

        updateTotals();
    };

    document.querySelectorAll('.add-product').forEach(button => {
        button.addEventListener('click', addProduct);
    });

    document.getElementById('searchAvailable').addEventListener('input', function() {
        const query = this.value.toLowerCase();
        document.querySelectorAll('#availableProducts li').forEach(item => {
            const text = item.textContent.toLowerCase();
            item.style.display = text.includes(query) ? '' : 'none';
        });
    });

    document.getElementById('searchSelected').addEventListener('input', function() {
        const query = this.value.toLowerCase();
        document.querySelectorAll('#selectedProducts li').forEach(item => {
            const text = item.textContent.toLowerCase();
            item.style.display = text.includes(query) ? '' : 'none';
        });
    });
});

</script>
@endsection
