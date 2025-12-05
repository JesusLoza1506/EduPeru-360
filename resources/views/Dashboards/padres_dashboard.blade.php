@extends('layouts.app')

@section('content')
<div class="container-fluid p-0" style="background-color: #f4f8ff; min-height: 100vh;">
    <div class="row g-0" style="min-height: 100vh;">
        <!-- Menú lateral -->
        <div class="col-md-3 col-lg-2 bg-primary text-white d-flex flex-column align-items-center py-4 shadow-sm" style="min-height: 100vh;">
            <div class="mb-4 text-center">
                <img src="{{ asset('imagenes/padre.jpg') }}" alt="Foto padre" class="rounded-circle shadow" style="width: 80px; height: 80px; object-fit: cover;">
                <h5 class="mt-3 fw-bold">Bienvenido, Padre</h5>
                <span class="badge bg-light text-primary">EduPerú360</span>
            </div>
            <nav class="nav flex-column w-100">
                <a class="nav-link text-white fw-semibold py-3 active" href="#"><i class="bi bi-bar-chart-line me-2"></i> Notas y Promedios</a>
                <a class="nav-link text-white fw-semibold py-3" href="#"><i class="bi bi-calendar-check me-2"></i> Asistencia</a>
                <a class="nav-link text-white fw-semibold py-3" href="#"><i class="bi bi-journal-bookmark me-2"></i> Tareas y Materiales</a>
                <a class="nav-link text-white fw-semibold py-3" href="#"><i class="bi bi-exclamation-triangle me-2"></i> Conducta</a>
                <a class="nav-link text-white fw-semibold py-3" href="#"><i class="bi bi-chat-dots me-2"></i> Comunicados</a>
                <a class="nav-link text-white fw-semibold py-3" href="#"><i class="bi bi-award me-2"></i> Boletines y Certificados</a>
                <a class="nav-link text-white fw-semibold py-3" href="#"><i class="bi bi-person-badge me-2"></i> Datos del Estudiante</a>
                <a class="nav-link text-white fw-semibold py-3" href="#"><i class="bi bi-whatsapp me-2"></i> Contacto Docentes</a>
            </nav>
        </div>

        <!-- Zona de contenido principal -->
        <div class="col-md-9 col-lg-10 px-4 py-5 d-flex flex-column" style="background-color: #fff; min-height: 100vh;">
            <div class="d-flex align-items-center justify-content-between mb-4">
                <div class="d-flex align-items-center">
                    <h2 class="fw-bold text-primary mb-0"><i class="bi bi-people-fill me-2"></i> Dashboard de Padres</h2>
                    <span class="ms-3 badge bg-primary fs-6">Panel principal</span>
                </div>
                <!-- Selector de hijos en la esquina derecha -->
                <div class="d-flex align-items-center gap-3">
                    <label for="selectorHijo" class="fw-bold mb-0">👨‍👩‍👧‍👦 Selecciona hijo</label>
                    <select id="selectorHijo" class="form-select form-select-lg" style="max-width: 180px;">
                        <option value="1" selected>Juan Pérez</option>
                        <option value="2">María Pérez</option>
                    </select>
                    <img src="{{ asset('imagenes/hijo1.png') }}" alt="Foto hijo" class="rounded-circle shadow" style="width: 48px; height: 48px; object-fit: cover;">
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
        </div>
    </div>
</div>
@endsection