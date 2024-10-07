<!DOCTYPE html>
<html>
<head>
    <title>Informe</title>
</head>
<body>
    <h1>Carta de Presentación</h1>
    <p>Nombre: {{ $docente->name }}</p>
    <p>Academia: {{ $docente->academia }}</p>
    <p>RFC: {{ $docente->rfc }}</p>

    <h2>Estancias</h2>
    <table>
        <thead>
            <tr>
                <th>Nombre</th>
            </tr>
        </thead>
        <tbody>

                <tr>
                    <td>{{ $estancia->nombre }}</td>
                </tr>
        </tbody>
    </table>
</body>
</html>
