<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Imprimir Socio</title>
    <style>
        body { font-family: Arial, Helvetica, sans-serif; font-size: 12px; color: #111827; }
        .container { max-width: 900px; margin: 0 auto; padding: 24px; }
        .header { text-align: center; margin-bottom: 24px; }
        .title { font-size: 20px; margin: 0; }
        table { width: 100%; border-collapse: collapse; }
        th, td { border: 1px solid #111; padding: 8px; vertical-align: top; }
        th { background: #f3f4f6; text-align: left; }
        .no-print { margin-bottom: 12px; text-align: right; }
        .no-print a { display: inline-block; padding: 8px 12px; background: #2563eb; color: #fff; text-decoration: none; border-radius: 6px; }
        .photos { display: grid; grid-template-columns: 1fr 1fr; gap: 12px; margin-top: 16px; }
        .photo { border: 1px solid #111; padding: 8px; text-align: center; }
        .photo h4 { margin: 0 0 8px; font-size: 14px; }
        .photo img { max-width: 100%; max-height: 280px; object-fit: contain; }
        @media print {
            .no-print { display: none !important; }
            body { -webkit-print-color-adjust: exact; print-color-adjust: exact; }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="no-print">
            <a href="{{ url()->previous() }}">Volver</a>
        </div>
        <div class="header">
            @php
                $logoUrl = isset($club) && $club && $club->club_logo
                    ? asset('assets/images/' . $club->club_logo)
                    : null;
            @endphp
            <h1 class="title">
                @if($logoUrl)
                    <img src="{{ $logoUrl }}" alt="Logo {{ $club->nombre }}" style="height:40px; margin-right:8px; vertical-align:middle;" onerror="this.style.display='none';">
                @endif
                {{ $club->nombre ?? 'Club' }} - Ficha del Socio
            </h1>
        </div>

        @php
            $barco = $socio->ruta_foto ? asset('assets/images/' . $socio->ruta_foto) : null;
            $socioFoto = $socio->ruta_foto2 ? asset('assets/images/' . $socio->ruta_foto2) : null;
        @endphp

        @if($barco || $socioFoto)
            <div class="photos">
                @if($barco)
                    <div class="photo">
                        <h4>Foto del Barco</h4>
                        <img src="{{ $barco }}" alt="Foto del barco">
                    </div>
                @endif
                @if($socioFoto)
                    <div class="photo">
                        <h4>Foto del Socio</h4>
                        <img src="{{ $socioFoto }}" alt="Foto del socio">
                    </div>
                @endif
            </div>
        @endif

        <table style="margin-top: 16px;">
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
                <th colspan="3">Póliza</th>
                <td colspan="3">{{ $socio->poliza }}</td>
            </tr>
            <tr>
                <th colspan="3">Teléfonos</th>
                <td colspan="9">
                    @if($socio->telefonos && $socio->telefonos->count())
                        {{ $socio->telefonos->pluck('telefono')->join(' · ') }}
                    @else
                        —
                    @endif
                </td>
            </tr>
        </table>
    </div>

    <script>
        // Lanzar diálogo de impresión automáticamente al abrir
        window.addEventListener('load', function(){
            setTimeout(function(){ window.print(); }, 200);
        });
    </script>
</body>
</html>


