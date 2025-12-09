@extends('layouts.admin')

@section('content')
<link rel="stylesheet" href="{{ asset('css/matriculas-admin.css') }}">
<div class="matricula-header d-flex align-items-center justify-content-between mb-4">
    <div>
        <span class="matricula-title"><i class="bi bi-search me-2"></i> Revisión de Solicitud de Matrícula</span>
        <p class="mb-0 mt-2">Valida el pago y los datos antes de aprobar o rechazar la solicitud.</p>
    </div>
    <a href="{{ route('solicitudes.index') }}" class="btn btn-outline-danger">Volver</a>
</div>
<div class="card shadow p-4 mb-4">
    <div class="row g-4">
        <div class="col-md-4 text-center">
            <h5 class="fw-bold">Comprobante Yape</h5>
            @if($solicitud->comprobante_yape)
            <a href="{{ $solicitud->comprobante_yape }}" target="_blank">
                <img src="{{ $solicitud->comprobante_yape }}" alt="Comprobante Yape" style="max-width: 220px; border-radius: 10px; border: 2px solid #0d6efd;">
            </a>
            @else
            <span class="text-muted">No adjuntado</span>
            @endif
            <div class="mt-3">
                <span class="fw-semibold">N° Operación Yape:</span> {{ $solicitud->nro_operacion_yape ?? '-' }}
            </div>
        </div>
        <div class="col-md-8">
            <h5 class="fw-bold mb-3">Datos de la Solicitud</h5>
            <ul class="list-group mb-3">
                <li class="list-group-item"><b>Padre:</b> {{ $solicitud->padre->nombre }} {{ $solicitud->padre->apellido }}</li>
                <li class="list-group-item"><b>Estudiante:</b> {{ $solicitud->nombre_estudiante }} {{ $solicitud->apellido_estudiante }}</li>
                <li class="list-group-item"><b>DNI:</b> {{ $solicitud->dni_estudiante }}</li>
                <li class="list-group-item"><b>Grado:</b> {{ $solicitud->grado->nivel }} {{ $solicitud->grado->grado }}{{ $solicitud->grado->seccion }}</li>
                <li class="list-group-item"><b>Año Escolar:</b> {{ $solicitud->anoEscolar->ano }}</li>
                <li class="list-group-item"><b>Monto matrícula:</b> S/. {{ number_format($solicitud->monto_matricula,2) }}</li>
                <li class="list-group-item"><b>Primera mensualidad:</b> S/. {{ number_format($solicitud->monto_mensualidad,2) }}</li>
                <li class="list-group-item"><b>Estado actual:</b> <span class="badge {{ $solicitud->estado == 'Pendiente' ? 'bg-warning text-dark' : ($solicitud->estado == 'Aprobado' ? 'bg-success' : 'bg-danger') }}">{{ $solicitud->estado }}</span></li>
                @if($solicitud->observaciones)
                <li class="list-group-item"><b>Observaciones:</b> {{ $solicitud->observaciones }}</li>
                @endif
            </ul>
            @if($solicitud->estado == 'Pendiente')
            <form action="{{ route('solicitudes.validar', $solicitud->id) }}" method="POST" class="d-flex flex-column gap-3">
                @csrf
                <div class="form-group">
                    <label for="observaciones" class="form-label">Observaciones (obligatorio si rechaza):</label>
                    <textarea name="observaciones" id="observaciones" class="form-control" rows="2"></textarea>
                </div>
                <div class="d-flex gap-2">
                    <button type="submit" name="accion" value="aprobar" class="btn btn-success px-4">Aprobar y generar matrícula</button>
                    <button type="submit" name="accion" value="rechazar" class="btn btn-danger px-4">Rechazar</button>
                </div>
            </form>
            @endif
        </div>
    </div>
</div>
@endsection