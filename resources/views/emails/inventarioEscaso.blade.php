<!DOCTYPE html>
<html>
<head>
    <title>Nueva Transacción Creada</title>
</head>
<body>
    <h1>Nueva Transacción Creada</h1>
    <p>Estimado {{ $empleado->persona->Nombres }},</p>
    <p>El producto {{ $productos->Nombre }} solo tiene {{ $productos->Cantidad }} unidades disponibles</p>
    <p>Sucursal: {{ $sucursal->Nombre }}</p>
</body>
</html>
