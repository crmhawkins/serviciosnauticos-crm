<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>Clubes</title>
    <style>
        @page { margin: 18px 14px; }
        body { font-family: DejaVu Sans, sans-serif; font-size: 11px; color: #333; margin: 0; }
        table { width: 100%; border-collapse: collapse; table-layout: fixed; }
        th, td { border: 1px solid #e5e7eb; padding: 5px 6px; text-align: left; vertical-align: top; }
        th { background: #f3f4f6; font-weight: 700; }
        th, td { word-wrap: break-word; overflow-wrap: anywhere; }
        .col-id { width: 40px; }
        .col-nombre { width: 250px; }
        .col-email { width: 220px; }
    </style>
</head>
<body>
    <h2>Listado de Clubes</h2>
    <table>
        <thead>
            <tr>
                <th class="col-id">ID</th>
                <th class="col-nombre">Nombre</th>
                <th class="col-email">Email</th>
            </tr>
        </thead>
        <tbody>
            @foreach($clubes as $club)
                <tr>
                    <td>{{ $club->id }}</td>
                    <td>{{ $club->nombre }}</td>
                    <td>{{ $club->email }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>


