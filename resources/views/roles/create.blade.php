@extends('layouts.master')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Crear Nuevo Rol</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('roles.store') }}">
                            @csrf

                            <div class="form-group">
                                <label for="Nombre">Nombre:</label>
                                <input type="text" name="Nombre" id="Nombre" class="form-control" required value="{{ old('Nombre') }}">
                                @error('Nombre')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="Descripcion">Descripción:</label>
                                <textarea name="Descripcion" id="Descripcion" class="form-control" required>{{ old('Descripcion') }}</textarea>
                                @error('Descripcion')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="Permisos">Permisos:</label>

                                @php
                                    $sections = [
                                        'Productos' => [
                                            ['value' => 1, 'label' => 'Ver Productos'],
                                            ['value' => 2, 'label' => 'Crear Producto'],
                                            ['value' => 3, 'label' => 'Editar Producto'],
                                            ['value' => 4, 'label' => 'Eliminar Producto'],
                                            ['value' => 5, 'label' => 'Distribuir Productos']
                                        ],
                                        'Empleados' => [
                                            ['value' => 6, 'label' => 'Ver Empleados'],
                                            ['value' => 7, 'label' => 'Crear Empleado'],
                                            ['value' => 8, 'label' => 'Editar Empleado'],
                                            ['value' => 9, 'label' => 'Eliminar Empleado'],
                                            ['value' => 10, 'label' => 'Adelantos a Empleados']
                                        ],
                                        // Añade más secciones y permisos personalizados aquí...
                                        'Compras' => [
                                            ['value' => 11, 'label' => 'Ver Compras'],
                                            ['value' => 12, 'label' => 'Crear Compra'],
                                            ['value' => 13, 'label' => 'Editar Compra'],
                                            ['value' => 14, 'label' => 'Eliminar Compra'],
                                            ['value' => 15, 'label' => 'Plan de Pagos']
                                        ],
                                        'Marcas' => [
                                            ['value' => 16, 'label' => 'Ver Marcas'],
                                            ['value' => 17, 'label' => 'Crear Marca'],
                                            ['value' => 18, 'label' => 'Editar Marca'],
                                            ['value' => 19, 'label' => 'Eliminar Marca'],
                                            //['value' => 20, 'label' => 'Exportar Marcas']
                                        ],
                                        'Proveedores' => [
                                            ['value' => 21, 'label' => 'Ver Proveedores'],
                                            ['value' => 22, 'label' => 'Crear Proveedor'],
                                            ['value' => 23, 'label' => 'Editar Proveedor'],
                                            ['value' => 24, 'label' => 'Eliminar Proveedor'],
                                           // ['value' => 25, 'label' => 'Exportar Proveedores']
                                        ],
                                        'Sucursales' => [
                                            ['value' => 26, 'label' => 'Ver Sucursales'],
                                            ['value' => 27, 'label' => 'Crear Sucursal'],
                                            ['value' => 28, 'label' => 'Editar Sucursal'],
                                            ['value' => 29, 'label' => 'Eliminar Sucursal'],
                                            //['value' => 30, 'label' => 'Exportar Sucursales']
                                        ],
                                        'Roles' => [
                                            ['value' => 31, 'label' => 'Ver Roles'],
                                            ['value' => 32, 'label' => 'Crear Rol'],
                                            ['value' => 33, 'label' => 'Editar Rol'],
                                            ['value' => 34, 'label' => 'Eliminar Rol'],
                                            //['value' => 35, 'label' => 'Exportar Roles']
                                        ],
                                        'Sueldos' => [
                                            ['value' => 36, 'label' => 'Ver Sueldos'],
                                            ['value' => 37, 'label' => 'Crear Sueldo'],
                                            ['value' => 38, 'label' => 'Editar Sueldo'],
                                            ['value' => 39, 'label' => 'Eliminar Sueldo'],
                                            //['value' => 40, 'label' => 'Exportar Sueldos']
                                        ],
                                        'Transacciones' => [
                                            ['value' => 41, 'label' => 'Ver Transacciones'],
                                            ['value' => 42, 'label' => 'Crear Transacción'],
                                            ['value' => 43, 'label' => 'Editar Transacción'],
                                            ['value' => 44, 'label' => 'Eliminar Transacción'],
                                            //['value' => 45, 'label' => 'Exportar Transacciones']
                                        ],
                                        'Inventarios' => [
                                            ['value' => 46, 'label' => 'Ver Inventarios'],
                                            ['value' => 47, 'label' => 'Crear Inventarios'],
                                            ['value' => 48, 'label' => 'Editar Inventarios'],
                                            ['value' => 49, 'label' => 'Eliminar Inventarios'],
                                            ['value' => 50, 'label' => 'Exportar Inventarios']
                                        ]
                                    ];
                                @endphp

                                @foreach ($sections as $section => $permissions)
                                    <div class="dropdown-container">
                                        <button class="btn btn-warning dropdown-toggle btn-sm" type="button" id="dropdownMenuButton{{ $loop->index }}" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            {{ $section }}
                                        </button>
                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton{{ $loop->index }}">
                                            <div class="dropdown-item small-checkbox">
                                                <div class="form-check">
                                                    <input class="form-check-input select-all" type="checkbox" id="selectAll{{ $loop->index }}">
                                                    <label class="form-check-label" for="selectAll{{ $loop->index }}">Seleccionar todo</label>
                                                </div>
                                            </div>
                                            @foreach ($permissions as $permission)
                                                <div class="dropdown-item small-checkbox">
                                                    <div class="form-check">
                                                        <input class="form-check-input permiso" type="checkbox" name="Permisos[]" value="{{ $permission['value'] }}" id="permiso{{ $permission['value'] }}" {{ (is_array(old('Permisos')) && in_array($permission['value'], old('Permisos'))) ? 'checked' : '' }}>
                                                        <label class="form-check-label" for="permiso{{ $permission['value'] }}">{{ $permission['label'] }}</label>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                @endforeach

                                @error('Permisos')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            
                            <button type="submit" class="btn btn-primary">Guardar</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <style>
        .dropdown-menu {
            max-height: 200px;
            overflow-y: auto;
        }
        .small-checkbox .form-check-input {
            width: 1.25rem;
            height: 1.25rem;
        }
    </style>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>

    <script>
        $(document).ready(function() {
            $('.dropdown-container').each(function() {
                var $dropdown = $(this);
                var $selectAll = $dropdown.find('.select-all');
                var $checkboxes = $dropdown.find('.permiso');

                $selectAll.click(function() {
                    $checkboxes.prop('checked', $(this).is(':checked'));
                });

                $checkboxes.click(function() {
                    if (!$(this).is(':checked')) {
                        $selectAll.prop('checked', false);
                    } else {
                        let allChecked = true;
                        $checkboxes.each(function() {
                            if (!$(this).is(':checked')) {
                                allChecked = false;
                            }
                        });
                        $selectAll.prop('checked', allChecked);
                    }
                });
            });
        });
    </script>
@endsection
