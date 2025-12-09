@extends('layouts.padres')

@section('content')
<link rel="stylesheet" href="{{ asset('css/solicitudesmatricula-padre.css') }}">
<div class="matricula-header d-flex align-items-center justify-content-between">
    <div>
        <span class="matricula-title"><i class="bi bi-pencil-square me-2 text-primary"></i> Editar Solicitud de Matrícula</span>
        <p class="mb-0 mt-2">Modifica los datos del estudiante y el pago de matrícula. Solo puedes editar solicitudes pendientes.</p>
    </div>
</div>
<div class="d-flex justify-content-center align-items-center" style="min-height: 60vh; margin-top: 2.5rem;">
    <form action="{{ route('solicitudes.update', $solicitud->id) }}" method="POST" enctype="multipart/form-data" class="card shadow rounded-4 p-4 mx-auto matricula-form" style="max-width: 840px; width:100%;">
        @csrf
        @method('PUT')
        <div class="mb-4 text-center">
            <i class="bi bi-pencil-square display-5 text-primary"></i>
        </div>
        @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
        @endif
        @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        <div class="mb-3">
            <label for="nombre_estudiante" class="form-label fw-semibold">Nombre del estudiante</label>
            <input type="text" name="nombre_estudiante" id="nombre_estudiante" class="form-control" value="{{ old('nombre_estudiante', $solicitud->nombre_estudiante) }}" required>
        </div>
        <div class="mb-3">
            <label for="apellido_estudiante" class="form-label fw-semibold">Apellido del estudiante</label>
            <input type="text" name="apellido_estudiante" id="apellido_estudiante" class="form-control" value="{{ old('apellido_estudiante', $solicitud->apellido_estudiante) }}" required>
        </div>
        <div class="mb-3">
            <label for="dni_estudiante" class="form-label fw-semibold">DNI del estudiante</label>
            <input type="text" name="dni_estudiante" id="dni_estudiante" class="form-control" maxlength="8" value="{{ old('dni_estudiante', $solicitud->dni_estudiante) }}" required>
        </div>
        <div class="mb-3">
            <label for="grado_id" class="form-label fw-semibold">Grado</label>
            <select name="grado_id" id="grado_id" class="form-select" required>
                <option value="">Seleccione...</option>
                @foreach($grados as $grado)
                <option value="{{ $grado->id }}" {{ $solicitud->grado_id == $grado->id ? 'selected' : '' }}>{{ $grado->nivel }} {{ $grado->grado }}{{ $grado->seccion }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label for="ano_escolar_id" class="form-label fw-semibold">Año Escolar</label>
            <select name="ano_escolar_id" id="ano_escolar_id" class="form-select" required>
                <option value="">Seleccione...</option>
                @foreach($anosEscolares as $ano)
                <option value="{{ $ano->id }}" {{ $solicitud->ano_escolar_id == $ano->id ? 'selected' : '' }}>{{ $ano->ano }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label for="monto_matricula" class="form-label fw-semibold">Monto de matrícula (S/)</label>
            <input type="number" name="monto_matricula" id="monto_matricula" class="form-control" min="0" step="0.01" value="{{ old('monto_matricula', $solicitud->monto_matricula) }}" required>
        </div>
        <div class="mb-3">
            <label for="monto_mensualidad" class="form-label fw-semibold">Primera mensualidad (S/)</label>
            <input type="number" name="monto_mensualidad" id="monto_mensualidad" class="form-control" min="0" step="0.01" value="{{ old('monto_mensualidad', $solicitud->monto_mensualidad) }}" required>
        </div>
        <div class="mb-3">
            <label for="comprobante_yape" class="form-label fw-semibold">Comprobante de pago Yape (imagen)</label>
            <input type="file" name="comprobante_yape" id="comprobante_yape" class="form-control" accept="image/*">
            <small class="form-text text-muted">Solo imágenes (JPG, PNG, etc). Máximo 5MB. Si no subes una nueva, se mantiene el actual.</small>
            @if($solicitud->comprobante_yape)
            <div class="mt-2">
                <span class="fw-semibold">Comprobante actual:</span><br>
                <img src="https://drive.google.com/uc?id={{ $solicitud->comprobante_yape }}" alt="Comprobante Yape" style="max-width:120px; border-radius:8px; border:1px solid #0d6efd;">
            </div>
            @endif
        </div>
        <div class="mb-3">
            <label for="nro_operacion_yape" class="form-label fw-semibold">N° de operación Yape</label>
            <input type="text" name="nro_operacion_yape" id="nro_operacion_yape" class="form-control" placeholder="Ej: 1234567890" value="{{ old('nro_operacion_yape', $solicitud->nro_operacion_yape) }}" required>
        </div>
        <div class="d-flex justify-content-end gap-2 mt-4">
            <button type="submit" class="btn btn-primary px-4">Actualizar solicitud</button>
            <a href="{{ route('solicitudes.create') }}" class="btn btn-secondary px-4">Cancelar</a>
        </div>
    </form>
</div>
@endsection