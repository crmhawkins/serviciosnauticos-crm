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
            max-width: 100px;
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
        {{-- <img src="{{ asset('storage/'.$club->club_logo) }}" alt="Logo del Club"> --}}
        <h1>{{ $club->nombre }}</h1>
    </div>

    <table>
        <tr>
            <th colspan="12">Datos del Socio</th>
        </tr>
        <tr>
            <th colspan="3">Nombre</th>
            <td colspan="3">{{ $socio->nombre_socio }}</td>
            <th colspan="3">Nº de socio</th>
            <td colspan="3">{{ $socio->numero_socio }}</td>
        </tr>
        <tr>
            <th colspan="3">DNI</th>
            <td colspan="3">{{ $socio->dni }}</td>
            <th colspan="3">PIN de socio</th>
            <td colspan="3">{{ $socio->pin_socio }}</td>
        </tr>
        <tr>
            <th colspan="3">Dirección</th>
            <td colspan="9">{{ $socio->direccion }}</td>
        </tr>
        <tr>
            <th colspan="3">Email</th>
            <td colspan="9">{{ $socio->email }}</td>
        </tr>
        <tr>
            <th colspan="3">Nombre del barco</th>
            <td colspan="9">{{ $socio->nombre_barco }}</td>
        </tr>
        <tr>
            <th colspan="3">Pantalán y Atraque</th>
            <td colspan="3">{{ $socio->pantalan_t_atraque }}</td>
            <th colspan="3">Matrícula</th>
            <td colspan="3">{{ $socio->matricula }}</td>
        </tr>
        <tr>
            <th colspan="3">Eslora</th>
            <td colspan="3">{{ $socio->eslora }}</td>
            <th colspan="3">Manga</th>
            <td colspan="3">{{ $socio->manga }}</td>
        </tr>
        <tr>
            <th colspan="3">Calado</th>
            <td colspan="3">{{ $socio->calado }}</td>
            <th colspan="3">Puntal</th>
            <td colspan="3">{{ $socio->puntal }}</td>
        </tr>
        <tr>
            <th colspan="3">Seguro barco</th>
            <td colspan="3">{{ $socio->seguro_barco }}</td>
            <th colspan="3">Póliza</th>
            <td colspan="3">{{ $socio->poliza }}</td>
        </tr>
        <tr>
            <th colspan="3">Vencimiento</th>
            <td colspan="3">{{ $socio->vencimiento }}</td>
            <th colspan="3">ITB</th>
            <td colspan="3">{{ $socio->itb }}</td>
        </tr>
    </table>
    <!-- Agrega más datos según necesites -->

    @if (isset($telefonos))
    <table>
        <tr>
            <th colspan="6">Teléfonos</th>
        </tr>
        @foreach($telefonos as $telefono)
        <tr>
        <th colspan="3">Telefono</th>
        <td colspan="3">{{ $telefono['telefono'] }}</td>
        </tr>
        @endforeach
    </table>
    @else
    <table>
        <tr>
            <th colspan="6">Teléfonos</th>
        </tr>
        <tr>
            <th colspan="6">Sin telefonos asignados</th>
        </tr>
    </table>
    @endif

    @if (isset($llaves))
    <table>
        <tr>
            <th colspan="6">Numeros de llave</th>
        </tr>
        @foreach($llaves as $llave)
        <tr>
        <th colspan="3">Llave Nº</th>
        <td colspan="3">{{ $llave['numero_llave'] }}</td>
        </tr>
        @endforeach

    </table>
    @else
    <table>
        <tr>
            <th colspan="6">Numeros de llave</th>
        </tr>
        <tr>
            <th colspan="6">Sin numeros de llave asignados</th>
        </tr>
    </table>
    @endif

    @if($socio->situacion_persona == 1 || $socio->situacion_persona == 2)
        @if(isset($tripulantes))
            <table>
                <tr>
                    <th colspan="12">Tripulantes</th>
                </tr>
                @foreach($tripulantes as $tripulante)
                <tr>
                    <th colspan="3">Nombre</th>
                    <td colspan="3">{{ $tripulante['nombre'] }}</td>
                    <th colspan="3">DNI:</th>
                    <td colspan="3">{{ $tripulante['dni'] }}</td>
                </tr>
                @endforeach

            </table>
        @else
            <table>
                <tr>
                    <th colspan="12">Tripulantes</th>
                </tr>
                <tr>
                    <th colspan="12">Sin tripulantes asignados</th>
                </tr>
            </table>
        @endif

        @if(isset($registros_entrada_transeunte))
            <table>
                <tr>
                    <th colspan="12">Registros de Entrada (Transeúntes)</th>
                </tr>
                @foreach($registros_entrada_transeunte as $registro)
                <tr>
                <th colspan="2">Fecha de entrada</th>
                <td colspan="2">{{ $registro['fecha_entrada'] }} </td>
                <th colspan="2">Fecha de salida</th>
                <td colspan="2">{{ $registro['fecha_salida'] }} </td>
                <th colspan="2">Total</th>
                <td colspan="2">{{ $registro['total'] }}</td>
                </tr>
                @endforeach

            </table>
        @else
            <table>
                <tr>
                    <th colspan="12">Registros de Entrada (Transeúntes)</th>
                </tr>
                <tr>
                    <th colspan="12">Sin registros</th>
                </tr>
            </table>
        @endif
    @endif

    @if(isset($registros_entrada))
            <table>
                <tr>
                    <th colspan="12">Registros de Entrada</th>
                </tr>

                @foreach($registros_entrada as $registro)
                <tr>
                    <td colspan="6">{{ $registro['fecha_1'] }} </td>
                    <td colspan="6">{{ $registro['fecha_2'] }} </td>
                </tr>
                @endforeach
            </table>
        @else
            <table>
                <tr>
                    <th colspan="12">Registros de Entrada</th>
                </tr>
                <tr>
                    <th colspan="12">Sin registros</th>
                </tr>
            </table>
    @endif


</body>
</html>
