<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Reporte de Usuarios - Central Box</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 11px;
            color: #333;
            margin: 20px;
        }
        .header {
            width: 100%;
            border-bottom: 2px solid #00C897;
            padding-bottom: 10px;
            margin-bottom: 20px;
        }
        .title {
            font-size: 20px;
            font-weight: bold;
            color: #111;
        }
        .subtitle {
            color: #666;
            font-size: 10px;
        }
        .date {
            text-align: right;
            font-size: 10px;
            color: #777;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }
        th {
            background-color: #f3f4f6;
            color: #374151;
            font-weight: bold;
            text-align: left;
            padding: 8px 6px;
            border-bottom: 1px solid #d1d5db;
            text-transform: uppercase;
            font-size: 9px;
        }
        td {
            padding: 7px 6px;
            border-bottom: 1px solid #e5e7eb;
        }
        .badge {
            display: inline-block;
            padding: 2px 6px;
            border-radius: 4px;
            font-size: 9px;
            font-weight: bold;
            text-transform: uppercase;
        }
        .badge-admin { background-color: #e5e7eb; color: #374151; }
        .badge-empleado { background-color: #dbeafe; color: #1e40af; }
        .badge-cliente { background-color: #f3e8ff; color: #6b21a8; }
        .footer {
            margin-top: 30px;
            text-align: center;
            font-size: 9px;
            color: #9ca3af;
            border-top: 1px solid #e5e7eb;
            padding-top: 10px;
        }
    </style>
</head>
<body>

    <!-- MEMBRETE DEL REPORTE -->
    <table class="header">
        <tr>
            <td>
                <div class="title">Central <span style="color: #00C897;">Box</span></div>
                <div class="subtitle">Reporte Oficial de Usuarios Registrados</div>
                <div class="subtitle">NIT: 900.123.456-7 • Colombia</div>
            </td>
            <td class="date">
                <strong>Fecha de Emisión:</strong> {{ date('d/m/Y H:i A') }}<br>
                <strong>Generado por:</strong> {{ auth()->user()->nombre ?? 'Administrador' }}
            </td>
        </tr>
    </table>

    <!-- TABLA DE USUARIOS -->
    <table>
        <thead>
            <tr>
                <th style="width: 5%;">ID</th>
                <th style="width: 25%;">Nombre</th>
                <th style="width: 30%;">Correo Electrónico</th>
                <th style="width: 15%;">Teléfono</th>
                <th style="width: 15%;">Rol</th>
                <th style="width: 10%;">Estado</th>
            </tr>
        </thead>
        <tbody>
            @foreach($usuarios as $usr)
                <tr>
                    <td><strong>#{{ $usr->id }}</strong></td>
                    <td>{{ $usr->nombre }}</td>
                    <td>{{ $usr->email }}</td>
                    <td>{{ $usr->telefono ?? 'N/A' }}</td>
                    <td>
                        @if(strtolower($usr->rol) === 'admin')
                            <span class="badge badge-admin">Administrador</span>
                        @elseif(strtolower($usr->rol) === 'vendedor' || strtolower($usr->rol) === 'empleado')
                            <span class="badge badge-empleado">Empleado</span>
                        @else
                            <span class="badge badge-cliente">Cliente</span>
                        @endif
                    </td>
                    <td>{{ ucfirst($usr->estado ?? 'Activo') }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <!-- PIE DE PÁGINA -->
    <div class="footer">
        Total de registros listados: {{ count($usuarios) }} • Documento confidencial generado desde el Sistema Central Box.
    </div>

</body>
</html>