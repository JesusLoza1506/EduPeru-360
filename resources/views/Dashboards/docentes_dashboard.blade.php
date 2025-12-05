@extends('layouts.app')

@section('content')
<div class="container-fluid p-0" style="background-color: #fffbe6; min-height: 100vh;">
    <div class="row g-0" style="min-height: 100vh;">
        <!-- Menú lateral -->
        <div class="col-md-3 col-lg-2 bg-warning text-dark d-flex flex-column align-items-center py-4 shadow-sm" style="min-height: 100vh;">
            <div class="mb-4 text-center">
                <img src="{{ asset('imagenes/docente.jpg') }}" alt="Foto docente" class="rounded-circle shadow" style="width: 80px; height: 80px; object-fit: cover;">
                <h5 class="mt-3 fw-bold">Bienvenido, Docente</h5>
                <span class="badge bg-light text-warning">EduPerú360</span>
            </div>
            <nav class="nav flex-column w-100">
                <a class="nav-link text-dark fw-semibold py-3 active" href="#"><i class="bi bi-journal-bookmark me-2"></i> Mis cursos</a>
                <a class="nav-link text-dark fw-semibold py-3" href="#"><i class="bi bi-calendar-check me-2"></i> Asistencia</a>
                <a class="nav-link text-dark fw-semibold py-3" href="#"><i class="bi bi-bar-chart-line me-2"></i> Notas</a>
                <a class="nav-link text-dark fw-semibold py-3" href="#"><i class="bi bi-journal-bookmark-fill me-2"></i> Tareas y materiales</a>
                <a class="nav-link text-dark fw-semibold py-3" href="#"><i class="bi bi-exclamation-triangle me-2"></i> Conducta</a>
                <a class="nav-link text-dark fw-semibold py-3" href="#"><i class="bi bi-chat-dots me-2"></i> Comunicación</a>
                <a class="nav-link text-dark fw-semibold py-3" href="#"><i class="bi bi-file-earmark-bar-graph me-2"></i> Reportes del curso</a>
                <a class="nav-link text-dark fw-semibold py-3" href="#"><i class="bi bi-award me-2"></i> Certificados</a>
            </nav>
        </div>

        <!-- Zona de contenido principal -->
        <div class="col-md-9 col-lg-10 px-4 py-5 d-flex flex-column" style="background-color: #fff; min-height: 100vh;">
            <div class="d-flex align-items-center mb-4">
                <h2 class="fw-bold text-warning mb-0"><i class="bi bi-person-video3 me-2"></i> Dashboard de Docentes</h2>
                <span class="ms-3 badge bg-warning fs-6 text-dark">Panel principal</span>
            </div>
            <div class="row g-4">
                <div class="col-md-6 col-lg-4">
                    <div class="card shadow-sm border-0 h-100">
                        <div class="card-body text-center">
                            <i class="bi bi-journal-bookmark display-4 text-warning mb-2"></i>
                            <h5 class="fw-bold">Mis cursos</h5>
                            <p class="text-muted">Selecciona el grado/sección y consulta los cursos que dictas.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4">
                    <div class="card shadow-sm border-0 h-100">
                        <div class="card-body text-center">
                            <i class="bi bi-calendar-check display-4 text-warning mb-2"></i>
                            <h5 class="fw-bold">Asistencia</h5>
                            <p class="text-muted">Toma asistencia diaria y revisa el historial de tus cursos.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4">
                    <div class="card shadow-sm border-0 h-100">
                        <div class="card-body text-center">
                            <i class="bi bi-bar-chart-line display-4 text-warning mb-2"></i>
                            <h5 class="fw-bold">Notas</h5>
                            <p class="text-muted">Registra y edita notas por bimestre y competencias.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4">
                    <div class="card shadow-sm border-0 h-100">
                        <div class="card-body text-center">
                            <i class="bi bi-journal-bookmark-fill display-4 text-warning mb-2"></i>
                            <h5 class="fw-bold">Tareas y materiales</h5>
                            <p class="text-muted">Asigna tareas, sube archivos y califica entregas.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4">
                    <div class="card shadow-sm border-0 h-100">
                        <div class="card-body text-center">
                            <i class="bi bi-exclamation-triangle display-4 text-warning mb-2"></i>
                            <h5 class="fw-bold">Conducta</h5>
                            <p class="text-muted">Registra incidencias y reconocimientos de tus estudiantes.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4">
                    <div class="card shadow-sm border-0 h-100">
                        <div class="card-body text-center">
                            <i class="bi bi-chat-dots display-4 text-warning mb-2"></i>
                            <h5 class="fw-bold">Comunicación</h5>
                            <p class="text-muted">Envía mensajes y circulares a padres y estudiantes.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4">
                    <div class="card shadow-sm border-0 h-100">
                        <div class="card-body text-center">
                            <i class="bi bi-file-earmark-bar-graph display-4 text-warning mb-2"></i>
                            <h5 class="fw-bold">Reportes del curso</h5>
                            <p class="text-muted">Genera actas, listados y reportes en PDF/Excel.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4">
                    <div class="card shadow-sm border-0 h-100">
                        <div class="card-body text-center">
                            <i class="bi bi-award display-4 text-warning mb-2"></i>
                            <h5 class="fw-bold">Certificados</h5>
                            <p class="text-muted">Genera constancias y certificados individuales.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection