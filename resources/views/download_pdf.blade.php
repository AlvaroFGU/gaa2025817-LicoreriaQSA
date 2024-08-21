<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="refresh" content="0; url={{ route('transacciones.index') }}">
</head>
<body>
    <script>
        window.onload = function() {
            var link = document.createElement('a');
            link.href = "{{ route('descargar.pdf') }}";
            link.download = 'recibo_transaccion.pdf';
            document.body.appendChild(link);
            link.click();
            document.body.removeChild(link);
        };
    </script>
</body>
</html>
