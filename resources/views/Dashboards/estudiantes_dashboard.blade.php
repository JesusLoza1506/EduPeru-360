@extends('layouts.app')

@section('content')
<div class="container-fluid p-0" style="background-color: #f6fff4; min-height: 100vh;">
    <div class="row g-0" style="min-height: 100vh;">
        <!-- Menú lateral -->
        <div class="col-md-3 col-lg-2 bg-success text-white d-flex flex-column align-items-center py-4 shadow-sm" style="min-height: 100vh;">
            <div class="mb-4 text-center">
                <img src="{{ asset('imagenes/estudiantes.jpg') }}" alt="Foto estudiante" class="rounded-circle shadow" style="width: 80px; height: 80px; object-fit: cover;">
                <h5 class="mt-3 fw-bold">Bienvenido, {{ Auth::user()->nombre }}</h5>
                <span class="badge bg-light text-success">EduPerú360</span>
            </div>
            <nav class="nav flex-column w-100">
                <a class="nav-link text-white fw-semibold py-3 active" href="#"><i class="bi bi-bar-chart-line me-2"></i> Mis notas</a>
                <a class="nav-link text-white fw-semibold py-3" href="#"><i class="bi bi-calendar-check me-2"></i> Asistencia</a>
                <a class="nav-link text-white fw-semibold py-3" href="#"><i class="bi bi-journal-bookmark me-2"></i> Tareas y materiales</a>
                <a class="nav-link text-white fw-semibold py-3" href="#"><i class="bi bi-award me-2"></i> Certificados y boletas</a>
                <a class="nav-link text-white fw-semibold py-3" href="#"><i class="bi bi-chat-dots me-2"></i> Comunicados</a>
                <a class="nav-link text-white fw-semibold py-3" href="#"><i class="bi bi-clock-history me-2"></i> Mi horario</a>
            </nav>
        </div>

        <!-- Zona de contenido principal -->
        <div class="col-md-9 col-lg-10 px-4 py-5 d-flex flex-column" style="background-color: #fff; min-height: 100vh;">
            <div class="d-flex align-items-center mb-4">
                <h2 class="fw-bold text-success mb-0"><i class="bi bi-person-badge me-2"></i> Dashboard de Estudiantes</h2>
                <span class="ms-3 badge bg-success fs-6">Panel principal</span>
            </div>
            <div class="row g-4">
                <div class="col-md-6 col-lg-4">
                    <div class="card shadow-sm border-0 h-100">
                        <div class="card-body text-center">
                            <i class="bi bi-bar-chart-line display-4 text-success mb-2"></i>
                            <h5 class="fw-bold">Mis notas</h5>
                            <p class="text-muted">Consulta tus notas bimestrales y el promedio final.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4">
                    <div class="card shadow-sm border-0 h-100">
                        <div class="card-body text-center">
                            <i class="bi bi-calendar-check display-4 text-success mb-2"></i>
                            <h5 class="fw-bold">Asistencia</h5>
                            <p class="text-muted">Revisa tu porcentaje de asistencia y días ausente/tardanza.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4">
                    <div class="card shadow-sm border-0 h-100">
                        <div class="card-body text-center">
                            <i class="bi bi-journal-bookmark display-4 text-success mb-2"></i>
                            <h5 class="fw-bold">Tareas y materiales</h5>
                            <p class="text-muted">Visualiza tus tareas pendientes, entregadas y descarga materiales.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4">
                    <div class="card shadow-sm border-0 h-100">
                        <div class="card-body text-center">
                            <i class="bi bi-award display-4 text-success mb-2"></i>
                            <h5 class="fw-bold">Certificados y boletas</h5>
                            <p class="text-muted">Descarga tu libreta bimestral y certificados en PDF.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4">
                    <div class="card shadow-sm border-0 h-100">
                        <div class="card-body text-center">
                            <i class="bi bi-chat-dots display-4 text-success mb-2"></i>
                            <h5 class="fw-bold">Comunicados</h5>
                            <p class="text-muted">Recibe mensajes, circulares y avisos importantes.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4">
                    <div class="card shadow-sm border-0 h-100">
                        <div class="card-body text-center">
                            <i class="bi bi-clock-history display-4 text-success mb-2"></i>
                            <h5 class="fw-bold">Mi horario</h5>
                            <p class="text-muted">Consulta tu horario semanal de clases.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection