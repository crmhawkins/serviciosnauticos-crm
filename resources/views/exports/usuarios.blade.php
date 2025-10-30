<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>Usuarios</title>
    <style>
        @page { margin: 18px 14px; }
        body { font-family: DejaVu Sans, sans-serif; font-size: 11px; color: #333; margin: 0; }
        table { width: 100%; border-collapse: collapse; table-layout: fixed; }
        th, td { border: 1px solid #e5e7eb; padding: 5px 6px; text-align: left; vertical-align: top; }
        th { background: #f3f4f6; font-weight: 700; }
        th, td { word-wrap: break-word; overflow-wrap: anywhere; }
        .col-alias { width: 160px; }
        .col-username { width: 160px; }
        .col-rol { width: 120px; }
        .col-email { width: 220px; }
    </style>
</head>
<body>
    <h2>Listado de Usuarios</h2>
    <table>
        <thead>
            <tr>
                <th class="col-alias">Alias</th>
                <th class="col-username">Username</th>
                <th class="col-rol">Rol</th>
                <th class="col-email">Email</th>
            </tr>
        </thead>
        <tbody>
            @foreach($usuarios as $u)
                <tr>
                    <td>{{ $u->name }}</td>
                    <td>{{ $u->username }}</td>
                    <td>{{ $u->role }}</td>
                    <td>{{ $u->email }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>


