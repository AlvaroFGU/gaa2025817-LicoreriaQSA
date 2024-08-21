<!DOCTYPE html>
<html>
<head>
    <title>Recibo de Transacción</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        table, th, td {
            border: 1px solid #000;
        }
        th, td {
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
        .header, .footer {
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>Recibo de Transacción</h1>
    </div>

    <p><strong>Empleado:</strong> {{ $empleado->persona->Nombres }} {{ $empleado->persona->Apellidos }}</p>
    <p><strong>Sucursal:</strong> {{ $sucursal->Nombre }}</p>

    <table>
        <thead>
            <tr>
                <th>Nombre del Producto</th>
                <th>Cantidad</th>
                <th>Precio</th>
                <th>Subtotal</th>
            </tr>
        </thead>
        <tbody>
            @foreach($productosDetalles as $producto)
                <tr>
                    <td>{{ $producto['Nombre'] }}</td>
                    <td>{{ $producto['Cantidad'] }}</td>
                    <td>{{ number_format($producto['Precio'], 2) }} BS</td>
                    <td>{{ number_format($producto['Subtotal'], 2) }} BS</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <p><strong>Total:</strong> {{ number_format($total, 2) }} BS</p>
    <p><strong>Monto Cancelado:</strong> {{ number_format($montoCancelado, 2) }} BS</p>
    <p><strong>Cambio:</strong> {{ number_format($cambio, 2) }} BS</p>

    <div class="footer">
        <p>Gracias por su compra.</p>
    </div>
</body>
</html>
