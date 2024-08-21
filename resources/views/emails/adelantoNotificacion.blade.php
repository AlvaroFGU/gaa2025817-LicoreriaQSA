<!DOCTYPE html>
<html>
<head>
    <title>Nuevo Adelanto</title>
</head>
<body>
    <h1>Nuevo Adelanto Creado</h1>
    <p>Hola, {{ $empleado->persona->Nombres }}.</p>
    <p>Se ha creado un nuevo adelanto para usted.</p>
    <p><strong>Monto:</strong> {{ $adelanto->Monto }}</p>
    <p><strong>Fecha:</strong> {{ $adelanto->Fecha }}</p>
    <p>Gracias.</p>
</body>
</html>
