@extends('layouts.admin')

@section('content')
<link rel="stylesheet" href="{{ asset('css/matriculas-admin.css') }}">
<div class="matricula-header d-flex align-items-center justify-content-between">
    <div>
        <span class="matricula-title"><i class="bi bi-list-check me-2"></i> Solicitudes de Matrícula</span>
        <p class="mb-0 mt-2">Revisa y valida las solicitudes de matrícula registradas por los padres.</p>
    </div>
</div>
@if(session('success'))
<div class="alert alert-success">{{ session('success') }}</div>
@endif
<div class="table-responsive">
    <table class="table matricula-table table-striped table-hover rounded shadow">
        <thead>
            <tr>
                <th>Padre</th>
                <th>Estudiante</th>
                <th>DNI</th>
                <th>Grado</th>
                <th>Año Escolar</th>
                <th>Pago matrícula</th>
                <th>Pago mensualidad</th>
                <th>Comprobante Yape</th>
                <th>N° Operación Yape</th>
                <th>Estado</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($solicitudes as $solicitud)
            <tr>
                <td>{{ $solicitud->padre->nombre }} {{ $solicitud->padre->apellido }}</td>
                <td>{{ $solicitud->nombre_estudiante }} {{ $solicitud->apellido_estudiante }}</td>
                <td>{{ $solicitud->dni_estudiante }}</td>
                <td>{{ $solicitud->grado->nivel }} {{ $solicitud->grado->grado }}{{ $solicitud->grado->seccion }}</td>
                <td>{{ $solicitud->anoEscolar->ano }}</td>
                <td>S/. {{ number_format($solicitud->monto_matricula,2) }}</td>
                <td>S/. {{ number_format($solicitud->monto_mensualidad,2) }}</td>
                <td>
                    @if($solicitud->comprobante_yape)
                    <a href="https://drive.google.com/uc?id={{ $solicitud->comprobante_yape }}" target="_blank">
                        <img src="https://drive.google.com/uc?id={{ $solicitud->comprobante_yape }}" alt="Comprobante Yape" style="max-width:60px; max-height:60px; border-radius:6px; border:1px solid #ccc;">
                    </a>
                    @else
                    <span class="text-muted">No adjunto</span>
                    @endif
                </td>
                <td>
                    @if($solicitud->nro_operacion_yape)
                    <span class="fw-semibold">{{ $solicitud->nro_operacion_yape }}</span>
                    @else
                    <span class="text-muted">-</span>
                    @endif
                </td>
                <td><span class="badge {{ $solicitud->estado == 'Pendiente' ? 'bg-warning text-dark' : ($solicitud->estado == 'Aprobado' ? 'bg-success' : ($solicitud->estado == 'Rechazado' ? 'bg-danger' : 'bg-secondary')) }}">{{ $solicitud->estado }}</span></td>
                <td>
                    <a href="{{ route('solicitudes.show', $solicitud->id) }}" class="btn btn-sm btn-warning">
                        <span style="font-size:18px; margin-right:4px; vertical-align:middle;">👁️</span>Revisar
                    </a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
<div class="d-flex justify-content-center mt-4">
    {{ $solicitudes->links() }}
</div>
@endsection