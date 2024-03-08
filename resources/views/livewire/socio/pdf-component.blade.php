<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Información del Socio</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            font-size: 12px;
        }
        .header {
            text-align: center;
            margin-bottom: 30px;
        }
        .header img {
            max-width: 100px; /* Ajusta esto según el tamaño deseado para el logo */
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid black;
            padding: 8px;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <div class="header">
        <img src="{{ asset('storage/'.$club->club_logo) }}" alt="Logo del Club">
        <h1>{{ $club->nombre }}</h1>
    </div>

    <h2>Datos del Socio</h2>
    <p><strong>Nombre:</strong> {{ $socio->nombre_socio }}</p>
    <p><strong>DNI:</strong> {{ $socio->dni }}</p>
    <p><strong>Email:</strong> {{ $socio->email }}</p>
    <!-- Agrega más datos según necesites -->

    <h2>Teléfonos</h2>
    @foreach($telefonospdf as $telefono)
    <p>{{ $telefono['telefono'] }}</p>
    @endforeach

    <h2>Números de Llave</h2>
    @foreach($llavespdf as $llave)
    <p>{{ $llave['numero_llave'] }}</p>
    @endforeach

    @if($socio->situacion_persona == 1 || $socio->situacion_persona == 2)

    <h2>Tripulantes</h2>
    @foreach($tripulantespdf as $tripulante)
    <p><strong>Nombre:</strong> {{ $tripulante['nombre'] }} - <strong>DNI:</strong> {{ $tripulante['dni'] }}</p>
    @endforeach

    <h2>Registros de Entrada (Transeúntes)</h2>
    @foreach($registros_entrada_transeuntepdf as $registro)
    <p>Entrada: {{ $registro['fecha_entrada'] }}, Salida: {{ $registro['fecha_salida'] }}, Total: {{ $registro['total'] }}</p>
    @endforeach
    @endif
    <h2>Registros de Entrada</h2>
    @foreach($registros_entradapdf as $registro)
    <p>{{ $registro['fecha_1'] }} - {{ $registro['fecha_2'] }} {{ $registro['tiempoAtraque'] ?? '' }} días</p>
    @endforeach

</body>
</html>
