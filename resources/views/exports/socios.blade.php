<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>Socios</title>
    <style>
        @page { margin: 18px 14px; }
        body { font-family: DejaVu Sans, sans-serif; font-size: 11px; color: #333; margin: 0; }
        h2 { margin: 0 0 8px 0; font-size: 14px; }
        table { width: 100%; border-collapse: collapse; table-layout: fixed; }
        th, td { border: 1px solid #e5e7eb; padding: 5px 6px; text-align: left; vertical-align: top; }
        th { background: #f3f4f6; font-weight: 700; }
        /* Evitar desbordamientos */
        th, td { word-wrap: break-word; overflow-wrap: anywhere; }
        .col-id { width: 34px; }
        .col-socio { width: 160px; }
        .col-barco { width: 140px; }
        .col-matricula { width: 110px; }
        .col-pantalan { width: 90px; }
        .col-situacion { width: 90px; }
        .col-telefono { width: 120px; }
    </style>
    </head>
<body>
    <h2>Listado de Socios</h2>
    <table>
        <thead>
            <tr>
                <th class="col-id">ID</th>
                <th class="col-socio">Socio</th>
                <th class="col-barco">Barco</th>
                <th class="col-matricula">Matrícula</th>
                <th class="col-pantalan">Pantalán/Atraque</th>
                <th class="col-situacion">Situación</th>
                <th class="col-telefono">Teléfono principal</th>
            </tr>
        </thead>
        <tbody>
            @foreach($socios as $socio)
                <tr>
                    <td>{{ $socio->id }}</td>
                    <td>{{ $socio->nombre_socio }}</td>
                    <td>{{ $socio->nombre_barco }}</td>
                    <td>{{ $socio->matricula }}</td>
                    <td>{{ $socio->pantalan_t_atraque }}</td>
                    <td>
                        @if ($socio->situacion_persona == 0) Socio
                        @elseif ($socio->situacion_persona == 1) Transeúnte
                        @else Socio/Transeúnte @endif
                    </td>
                    <td>{{ optional($socio->telefonos->first())->telefono }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>


