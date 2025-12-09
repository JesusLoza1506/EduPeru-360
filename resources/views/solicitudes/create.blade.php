@extends('layouts.padres')

@section('content')
<link rel="stylesheet" href="{{ asset('css/solicitudesmatricula-padre.css') }}">
<div class="matricula-header d-flex align-items-center justify-content-between">
    <div>
        <span class="matricula-title"><i class="bi bi-person-plus me-2 text-primary"></i> Solicitud de Matrícula</span>
        <p class="mb-0 mt-2">Registra los datos del estudiante y el pago de matrícula. La solicitud quedará pendiente de revisión.</p>
    </div>
</div>

<!-- Botón para ver solicitudes -->
<div class="d-flex justify-content-end mb-3">
    <button class="btn btn-outline-primary" type="button" onclick="document.getElementById('solicitudes-lista').classList.toggle('d-none')">
        <i class="bi bi-list-check me-1"></i> Ver mis solicitudes
    </button>
</div>

<!-- Lista de solicitudes del padre -->
<div id="solicitudes-lista" class="card shadow rounded-4 p-4 mx-auto mb-4 d-none" style="max-width: 900px;">
    <h5 class="mb-3"><i class="bi bi-list-check me-2"></i> Mis Solicitudes de Matrícula</h5>
    @if(isset($misSolicitudes) && count($misSolicitudes) > 0)
    <div class="table-responsive">
        <table class="table table-bordered table-hover">
            <thead>
                <tr>
                    <th>Estudiante</th>
                    <th>DNI</th>
                    <th>Grado</th>
                    <th>Año Escolar</th>
                    <th>Estado</th>
                    <th>PDF Matrícula</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach($misSolicitudes as $sol)
                <tr>
                    <td>{{ $sol->nombre_estudiante }} {{ $sol->apellido_estudiante }}</td>
                    <td>{{ $sol->dni_estudiante }}</td>
                    <td>{{ $sol->grado->nivel }} {{ $sol->grado->grado }}{{ $sol->grado->seccion }}</td>
                    <td>{{ $sol->anoEscolar->ano }}</td>
                    <td>
                        <span class="badge {{ $sol->estado == 'Aprobado' ? 'bg-success' : ($sol->estado == 'Rechazado' ? 'bg-danger' : 'bg-warning text-dark') }}">{{ $sol->estado }}</span>
                    </td>
                    <td>
                        @if($sol->comprobante_yape)
                        <a href="https://drive.google.com/uc?id={{ $sol->comprobante_yape }}" target="_blank" class="btn btn-sm btn-primary">Ver Comprobante</a>
                        @else
                        <span class="text-muted">No disponible</span>
                        @endif
                    </td>
                    <td>
                        @if($sol->estado == 'Pendiente')
                        <a href="{{ route('solicitudes.edit', $sol->id) }}" class="btn btn-sm btn-warning me-1">Editar</a>
                        <form action="{{ route('solicitudes.destroy', $sol->id) }}" method="POST" style="display:inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('¿Seguro que deseas eliminar esta solicitud?')">Eliminar</button>
                        </form>
                        @else
                        <span class="text-muted">No disponible</span>
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    @else
    <div class="alert alert-info mb-0">No has enviado solicitudes de matrícula aún.</div>
    @endif
</div>
<div class="d-flex justify-content-center align-items-center" style="min-height: 60vh; margin-top: 2.5rem;">
    <form action="{{ route('solicitudes.store') }}" method="POST" enctype="multipart/form-data" class="card shadow rounded-4 p-4 mx-auto matricula-form" style="max-width: 840px; width:100%;">
        @csrf
        @csrf
        <div class="mb-4 text-center">
            <i class="bi bi-person-plus display-5 text-primary"></i>
        </div>
        @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        <!-- QR Yape Colegio -->
        <div class="mb-4 text-center">
            <label class="form-label fw-semibold">Paga la matrícula y mensualidad al Yape del colegio:</label>
            <div>
                <img src="{{ asset('imagenes/qr-yape-colegio.jpg') }}" alt="QR Yape Colegio" style="max-width:180px; width:100%; border-radius:12px; border:2px solid #0d6efd; margin-bottom:10px;">
            </div>
            <div class="fw-bold">Celular: <span class="text-primary">977 860 423</span></div>
            <small class="text-muted">Escanea el QR o paga al número indicado y sube el comprobante.</small>
        </div>
        <div class="mb-3">
            <label for="nombre_estudiante" class="form-label fw-semibold">Nombre del estudiante</label>
            <input type="text" name="nombre_estudiante" id="nombre_estudiante" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="apellido_estudiante" class="form-label fw-semibold">Apellido del estudiante</label>
            <input type="text" name="apellido_estudiante" id="apellido_estudiante" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="dni_estudiante" class="form-label fw-semibold">DNI del estudiante</label>
            <input type="text" name="dni_estudiante" id="dni_estudiante" class="form-control" maxlength="8" required>
        </div>
        <div class="mb-3">
            <label for="grado_id" class="form-label fw-semibold">Grado</label>
            <select name="grado_id" id="grado_id" class="form-select" required>
                <option value="">Seleccione...</option>
                @foreach($grados as $grado)
                <option value="{{ $grado->id }}">{{ $grado->nivel }} {{ $grado->grado }}{{ $grado->seccion }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label for="ano_escolar_id" class="form-label fw-semibold">Año Escolar</label>
            <select name="ano_escolar_id" id="ano_escolar_id" class="form-select" required>
                <option value="">Seleccione...</option>
                @foreach($anosEscolares as $ano)
                <option value="{{ $ano->id }}">{{ $ano->ano }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label for="monto_matricula" class="form-label fw-semibold">Monto de matrícula (S/)</label>
            <input type="number" name="monto_matricula" id="monto_matricula" class="form-control" min="0" step="0.01" required>
        </div>
        <div class="mb-3">
            <label for="monto_mensualidad" class="form-label fw-semibold">Primera mensualidad (S/)</label>
            <input type="number" name="monto_mensualidad" id="monto_mensualidad" class="form-control" min="0" step="0.01" required>
        </div>
        <div class="mb-3">
            <label for="comprobante_yape" class="form-label fw-semibold">Comprobante de pago Yape (imagen)</label>
            <input type="file" name="comprobante_yape" id="comprobante_yape" class="form-control" accept="image/*" required>
            <small class="form-text text-muted">Solo imágenes (JPG, PNG, etc). Máximo 5MB.</small>
        </div>
        <div class="mb-3">
            <label for="nro_operacion_yape" class="form-label fw-semibold">N° de operación Yape</label>
            <input type="text" name="nro_operacion_yape" id="nro_operacion_yape" class="form-control" placeholder="Ej: 1234567890" required>
        </div>
        <div class="d-flex justify-content-end gap-2 mt-4">
            <button type="submit" class="btn btn-primary px-4">Registrar solicitud</button>
        </div>
    </form>
</div>
</div>
</div>
</div>
</div>
@endsection