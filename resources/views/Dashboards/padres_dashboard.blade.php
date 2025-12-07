@extends('layouts.padres')

@section('content')
<div class="d-flex align-items-center justify-content-between mb-4">
    <div class="d-flex align-items-center">
        <h2 class="fw-bold text-primary mb-0"><i class="bi bi-people-fill me-2"></i> Dashboard de Padres</h2>
        <span class="ms-3 badge bg-primary fs-6">Panel principal</span>
    </div>
    <!-- Selector de hijos en la esquina derecha -->
    <div class="d-flex align-items-center gap-3">
        <form method="GET" action="{{ url('/dashboard/padres') }}" class="d-flex align-items-center gap-3">
            <label for="selectorHijo" class="fw-bold mb-0">👨‍👩‍👧‍👦 Selecciona hijo</label>
            <select name="hijo_id" id="selectorHijo" class="form-select form-select-lg" style="max-width: 180px;" onchange="this.form.submit()">
                @if($hijos->count() > 0)
                @foreach($hijos as $hijo)
                <option value="{{ $hijo->estudiante_id }}" {{ isset($hijoSeleccionado) && $hijoSeleccionado->estudiante_id == $hijo->estudiante_id ? 'selected' : '' }}>{{ $hijo->nombre }}</option>
                @endforeach
                @else
                <option value="">No tiene hijos registrados</option>
                @endif
            </select>
            @if(isset($hijoSeleccionado))
            <img src="{{ asset('imagenes/hijo1.png') }}" alt="Foto hijo" class="rounded-circle shadow" style="width: 48px; height: 48px; object-fit: cover;">
            @endif
        </form>
    </div>
</div>
<div class="row g-4">
    <div class="col-md-6 col-lg-4">
        <div class="card shadow-sm border-0 h-100">
            <div class="card-body text-center">
                <i class="bi bi-bar-chart-line display-4 text-primary mb-2"></i>
                <h5 class="fw-bold">Notas y Promedios</h5>
                <p class="text-muted">Consulta las notas bimestrales y el promedio final de tu hijo.</p>
            </div>
        </div>
    </div>
    <div class="col-md-6 col-lg-4">
        <div class="card shadow-sm border-0 h-100">
            <div class="card-body text-center">
                <i class="bi bi-calendar-check display-4 text-primary mb-2"></i>
                <h5 class="fw-bold">Asistencia</h5>
                <p class="text-muted">Revisa el porcentaje de asistencia y las inasistencias justificadas.</p>
            </div>
        </div>
    </div>
    <div class="col-md-6 col-lg-4">
        <div class="card shadow-sm border-0 h-100">
            <div class="card-body text-center">
                <i class="bi bi-journal-bookmark display-4 text-primary mb-2"></i>
                <h5 class="fw-bold">Tareas y Materiales</h5>
                <p class="text-muted">Visualiza las tareas pendientes, entregadas y descarga materiales.</p>
            </div>
        </div>
    </div>
    <div class="col-md-6 col-lg-4">
        <div class="card shadow-sm border-0 h-100">
            <div class="card-body text-center">
                <i class="bi bi-exclamation-triangle display-4 text-primary mb-2"></i>
                <h5 class="fw-bold">Conducta</h5>
                <p class="text-muted">Consulta las incidencias y reconocimientos de tu hijo.</p>
            </div>
        </div>
    </div>
    <div class="col-md-6 col-lg-4">
        <div class="card shadow-sm border-0 h-100">
            <div class="card-body text-center">
                <i class="bi bi-chat-dots display-4 text-primary mb-2"></i>
                <h5 class="fw-bold">Comunicados</h5>
                <p class="text-muted">Recibe mensajes, circulares y avisos importantes.</p>
            </div>
        </div>
    </div>
    <div class="col-md-6 col-lg-4">
        <div class="card shadow-sm border-0 h-100">
            <div class="card-body text-center">
                <i class="bi bi-award display-4 text-primary mb-2"></i>
                <h5 class="fw-bold">Boletines y Certificados</h5>
                <p class="text-muted">Descarga boletines, certificados y constancias en PDF.</p>
            </div>
        </div>
    </div>
    <div class="col-md-6 col-lg-4">
        <div class="card shadow-sm border-0 h-100">
            <div class="card-body text-center">
                <i class="bi bi-person-badge display-4 text-primary mb-2"></i>
                <h5 class="fw-bold">Datos del Estudiante</h5>
                <p class="text-muted">Consulta la información básica y médica de tu hijo.</p>
            </div>
        </div>
    </div>
    <div class="col-md-6 col-lg-4">
        <div class="card shadow-sm border-0 h-100">
            <div class="card-body text-center">
                <i class="bi bi-whatsapp display-4 text-primary mb-2"></i>
                <h5 class="fw-bold">Contacto Docentes</h5>
                <p class="text-muted">Comunícate con los docentes y directivos fácilmente.</p>
            </div>
        </div>
    </div>
</div>
@endsection