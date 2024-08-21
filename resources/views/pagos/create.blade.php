@extends('layouts.master')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Registrar Pago para la Compra: {{ $compra->CompraId }}</div>

                    <div class="card-body">
                        <form action="{{ route('compras.pagos.store', $compra->CompraId) }}" method="POST">
                            @csrf

                            <div class="form-group">
                                <label for="Fecha">Fecha:</label>
                                <input type="date" name="Fecha" id="Fecha" class="form-control" value="{{ old('Fecha') ?? date('Y-m-d') }}" required>
                                @error('Fecha')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="Monto">Monto:</label>
                                <input type="number" step="0.01" name="Monto" id="Monto" class="form-control" value="{{ old('Monto') }}" required>
                                @error('Monto')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <input type="hidden" name="CompraId" value="{{ $compra->CompraId }}">

                            <div class="form-group">
                                <label for="MontoRestante">Monto Restante:</label>
                                <input type="text" id="MontoRestante" class="form-control" value="{{ $montoRestante }}" readonly>
                            </div>

                            <button type="submit" class="btn btn-primary">Guardar Pago</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
