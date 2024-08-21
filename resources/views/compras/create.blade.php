@extends('layouts.master')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            <div class="card">
                <div class="card-header">Crear Nueva Compra</div>
                <div class="card-body">
                    <form method="POST" action="{{ route('compras.store') }}">
                        @csrf
                        <div class="form-group">
                            <label for="ProveedorId">Proveedor:</label>
                            <select name="ProveedorId" id="ProveedorId" class="form-control" required>
                                <option value="">Seleccione un proveedor</option>
                                @foreach($proveedores as $proveedor)
                                    <option value="{{ $proveedor->ProveedorId }}" {{ old('ProveedorId') == $proveedor->ProveedorId ? 'selected' : '' }}>
                                        {{ $proveedor->persona->Nombres }} {{ $proveedor->persona->Apellidos }}
                                    </option>
                                @endforeach
                            </select>
                            @error('ProveedorId')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="EmpleadoId">Empleado:</label>
                            <select name="EmpleadoId" id="EmpleadoId" class="form-control" required>
                                @foreach($empleados as $empleado)
                                    <option value="{{ $empleado->EmpleadoId }}" {{ old('EmpleadoId') == $empleado->EmpleadoId ? 'selected' : '' }}>
                                        {{ $empleado->persona->Nombres }} {{ $empleado->persona->Apellidos }}
                                    </option>
                                @endforeach
                            </select>
                            @error('EmpleadoId')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="MontoTotal">Monto Total:</label>
                            <input type="number" step="0.01" name="MontoTotal" id="MontoTotal" class="form-control" value="{{ old('MontoTotal') }}" required>
                            @error('MontoTotal')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="MontoPagado">Monto Pagado:</label>
                            <input type="number" step="0.01" name="MontoPagado" id="MontoPagado" class="form-control" value="{{ old('MontoPagado') }}" required>
                            @error('MontoPagado')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="Fecha">Fecha:</label>
                            <input type="date" name="Fecha" id="Fecha" class="form-control" value="{{ now()->toDateString() }}" readonly>
                            @error('Fecha')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <h5>Productos Disponibles</h5>
                                <input type="text" id="search-available" class="form-control mb-2" placeholder="Buscar productos...">
                                <ul id="available-products" class="list-group list-group-item-dark" style="max-height: 300px; overflow-y: scroll;">
                                    @foreach($productos as $producto)
                                        <li class="list-group-item">
                                            {{ $producto->Nombre }} {{ $producto->Modelo }}
                                            <button type="button" class="btn btn-sm btn-primary float-right add-product" data-id="{{ $producto->ProductoId }}" data-name="{{ $producto->Nombre }}" data-model="{{ $producto->Modelo }}">
                                                Añadir
                                            </button>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                            <div class="col-md-6">
                                <h5>Productos Seleccionados</h5>
                                <input type="text" id="search-selected" class="form-control mb-2" placeholder="Buscar productos...">
                                <ul id="selected-products" class="list-group list-group-item-dark" style="max-height: 300px; overflow-y: scroll;">
                                    <!-- Los productos seleccionados aparecerán aquí -->
                                </ul>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary mt-3">Crear Compra</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    document.querySelectorAll('.add-product').forEach(button => {
        button.addEventListener('click', function () {
            const productId = this.dataset.id;
            const productName = this.dataset.name;
            const productModel = this.dataset.model;

            const selectedProducts = document.getElementById('selected-products');
            const li = document.createElement('li');
            li.classList.add('list-group-item');
            li.dataset.id = productId;

            li.innerHTML = `
                ${productName} ${productModel}
                <input type="number" name="productos[${productId}][Cantidad]" class="form-control d-inline-block w-25 ml-2" placeholder="Cantidad" required>
                <input type="hidden" name="productos[${productId}][ProductoId]" value="${productId}">
                <button type="button" class="btn btn-sm btn-danger float-right remove-product">Eliminar</button>
            `;

            selectedProducts.appendChild(li);

            // Eliminar el producto de la lista de disponibles
            this.closest('li').remove();

            // Añadir funcionalidad de eliminar
            li.querySelector('.remove-product').addEventListener('click', function () {
                const id = li.dataset.id;
                const name = li.childNodes[0].nodeValue.trim();
                
                // Devolver a la lista de disponibles
                const availableProducts = document.getElementById('available-products');
                const availableLi = document.createElement('li');
                availableLi.classList.add('list-group-item');
                availableLi.innerHTML = `
                    ${name}
                    <button type="button" class="btn btn-sm btn-primary float-right add-product" data-id="${id}" data-name="${name}">Añadir</button>
                `;
                availableProducts.appendChild(availableLi);

                // Eliminar el producto de la lista de seleccionados
                li.remove();

                // Añadir funcionalidad de añadir
                availableLi.querySelector('.add-product').addEventListener('click', function () {
                    this.closest('li').remove();
                    selectedProducts.appendChild(li);
                });
            });
        });
    });

    // Funcionalidad de búsqueda en tiempo real para productos disponibles
    document.getElementById('search-available').addEventListener('input', function () {
        const query = this.value.toLowerCase();
        document.querySelectorAll('#available-products li').forEach(li => {
            const text = li.textContent.toLowerCase();
            li.style.display = text.includes(query) ? '' : 'none';
        });
    });

    // Funcionalidad de búsqueda en tiempo real para productos seleccionados
    document.getElementById('search-selected').addEventListener('input', function () {
        const query = this.value.toLowerCase();
        document.querySelectorAll('#selected-products li').forEach(li => {
            const text = li.textContent.toLowerCase();
            li.style.display = text.includes(query) ? '' : 'none';
        });
    });
});
</script>
@endsection
