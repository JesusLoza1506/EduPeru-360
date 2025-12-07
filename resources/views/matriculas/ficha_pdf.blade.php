<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Ficha de Matrícula</title>
    <style>
        body {
            font-family: 'Segoe UI', Arial, sans-serif;
            font-size: 15px;
            margin: 40px 30px 60px 30px;
            background: #fff;
        }

        .pdf-container {
            border: 2px solid #0d47a1;
            border-radius: 12px;
            padding: 32px 32px 16px 32px;
            background: #f8fafc;
            box-shadow: 0 2px 8px #e3e3e3;
        }

        .header {
            text-align: center;
            margin-bottom: 28px;
        }

        .logo {
            width: 90px;
            margin-bottom: 8px;
        }

        .title {
            font-size: 1.7em;
            color: #0d47a1;
            font-weight: bold;
            margin-bottom: 2px;
        }

        .subtitle {
            font-size: 1.1em;
            color: #333;
            margin-bottom: 0;
        }

        .info-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 18px;
        }

        .info-table th,
        .info-table td {
            border: 1px solid #b0bec5;
            padding: 8px 10px;
            font-size: 1em;
        }

        .info-table th {
            background: #e3f0fc;
            color: #0d47a1;
            text-align: left;
            width: 32%;
        }

        .info-table td {
            background: #fff;
        }

        .section-title {
            font-weight: bold;
            color: #0d47a1;
            margin-top: 18px;
            margin-bottom: 6px;
            font-size: 1.1em;
        }

        .footer {
            position: fixed;
            left: 0;
            right: 0;
            bottom: 0;
            text-align: center;
            font-size: 0.95em;
            color: #888;
            border-top: 1px solid #b0bec5;
            padding: 8px 0 2px 0;
            background: #f8fafc;
        }
    </style>
</head>

<body>
    <div class="pdf-container">
        <div class="header">
            <img src="{{ public_path('imagenes/logo.png') }}" class="logo" alt="Logo">
            <div class="title">Ficha de Matrícula</div>
            <div class="subtitle">EduPerú360</div>
        </div>
        <table class="info-table">
            <tr>
                <th>Fecha de Matrícula</th>
                <td>{{ $matricula->fecha_matricula->format('d/m/Y') }}</td>
            </tr>
            <tr>
                <th>Estudiante</th>
                <td>{{ $userEstudiante->nombre }} {{ $userEstudiante->apellido }}</td>
            </tr>
            <tr>
                <th>DNI</th>
                <td>{{ $userEstudiante->dni }}</td>
            </tr>
            <tr>
                <th>Grado</th>
                <td>{{ $solicitud->grado->nivel }} {{ $solicitud->grado->grado }}{{ $solicitud->grado->seccion }}</td>
            </tr>
            <tr>
                <th>Año Escolar</th>
                <td>{{ $solicitud->anoEscolar->ano }}</td>
            </tr>
            <tr>
                <th>Monto Matrícula</th>
                <td>S/. {{ number_format($solicitud->monto_matricula,2) }}</td>
            </tr>
            <tr>
                <th>Primera Mensualidad</th>
                <td>S/. {{ number_format($solicitud->monto_mensualidad,2) }}</td>
            </tr>
            <tr>
                <th>Padre/Apoderado</th>
                <td>{{ $solicitud->padre->nombre }} {{ $solicitud->padre->apellido }}</td>
            </tr>
            <tr>
                <th>N° Operación Yape</th>
                <td>{{ $solicitud->nro_operacion_yape }}</td>
            </tr>
        </table>
        <div class="section-title">Observaciones</div>
        <div style="min-height:40px; border:1px solid #b0bec5; background:#fff; padding:8px 10px; border-radius:5px;">
            {{ $solicitud->observacion ?? 'Ninguna' }}
        </div>
    </div>
    <div class="footer">
        <span>EduPerú360 &bull; Av. Ejemplo 123, Lima &bull; Tel: (01) 123-4567 &bull; www.eduperu360.edu.pe</span>
    </div>
</body>

</html>