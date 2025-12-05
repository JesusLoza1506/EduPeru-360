@extends('layouts.app')

@section('content')
<div class="container-fluid p-0" style="background-color: #fff4f4; min-height: 100vh;">
    <div class="row g-0" style="min-height: 100vh;">
        <!-- Menú lateral -->
        <div class="col-md-3 col-lg-2 bg-danger text-white d-flex flex-column align-items-center py-4 shadow-sm" style="min-height: 100vh;">
            <div class="mb-4 text-center">
                <img src="{{ asset('imagenes/admin_logo.jpg') }}" alt="Logo admin" class="rounded-circle shadow" style="width: 80px; height: 80px; object-fit: cover;">
                <h5 class="mt-3 fw-bold">Bienvenido, Administrador</h5>
                <span class="badge bg-light text-danger">EduPerú360</span>
            </div>
            <nav class="nav flex-column w-100">
                <a class="nav-link text-white fw-semibold py-3 active" href="#"><i class="bi bi-speedometer2 me-2"></i> Dashboard general</a>
                <a class="nav-link text-white fw-semibold py-3" href="#"><i class="bi bi-mortarboard me-2"></i> Matrícula y estudiantes</a>
                <a class="nav-link text-white fw-semibold py-3" href="#"><i class="bi bi-person-badge me-2"></i> Docentes y usuarios</a>
                <a class="nav-link text-white fw-semibold py-3" href="#"><i class="bi bi-building me-2"></i> Grados y cursos</a>
                <a class="nav-link text-white fw-semibold py-3" href="#"><i class="bi bi-calendar me-2"></i> Año escolar y bimestres</a>
                <a class="nav-link text-white fw-semibold py-3" href="#"><i class="bi bi-bar-chart-line me-2"></i> Notas y evaluaciones</a>
                <a class="nav-link text-white fw-semibold py-3" href="#"><i class="bi bi-calendar-check me-2"></i> Asistencia global</a>
                <a class="nav-link text-white fw-semibold py-3" href="#"><i class="bi bi-chat-dots me-2"></i> Comunicación institucional</a>
                <a class="nav-link text-white fw-semibold py-3" href="#"><i class="bi bi-exclamation-triangle me-2"></i> Conducta y sanciones</a>
                <a class="nav-link text-white fw-semibold py-3" href="#"><i class="bi bi-journal-bookmark-fill me-2"></i> Tareas y materiales</a>
                <a class="nav-link text-white fw-semibold py-3" href="#"><i class="bi bi-award me-2"></i> Certificados y actas</a>
                <a class="nav-link text-white fw-semibold py-3" href="#"><i class="bi bi-tools me-2"></i> Sistema y seguridad</a>
            </nav>
        </div>

        <!-- Zona de contenido principal -->
        <div class="col-md-9 col-lg-10 px-4 py-5 d-flex flex-column" style="background-color: #fff; min-height: 100vh;">
            <div class="d-flex align-items-center mb-4">
                <h2 class="fw-bold text-danger mb-0"><i class="bi bi-gear-fill me-2"></i> Dashboard de Administración</h2>
                <span class="ms-3 badge bg-danger fs-6">Panel principal</span>
            </div>
            <div class="row g-4">
                <div class="col-md-6 col-lg-4">
                    <div class="card shadow-sm border-0 h-100">
                        <div class="card-body text-center">
                            <i class="bi bi-speedometer2 display-4 text-danger mb-2"></i>
                            <h5 class="fw-bold">Dashboard general</h5>
                            <p class="text-muted">Métricas globales: matriculados, inasistencias, morosidad, etc.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4">
                    <div class="card shadow-sm border-0 h-100">
                        <div class="card-body text-center">
                            <i class="bi bi-mortarboard display-4 text-danger mb-2"></i>
                            <h5 class="fw-bold">Matrícula y estudiantes</h5>
                            <p class="text-muted">Gestiona estudiantes, grados, cupos y fichas de matrícula.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4">
                    <div class="card shadow-sm border-0 h-100">
                        <div class="card-body text-center">
                            <i class="bi bi-person-badge display-4 text-danger mb-2"></i>
                            <h5 class="fw-bold">Docentes y usuarios</h5>
                            <p class="text-muted">Gestiona cuentas, roles y contraseñas de usuarios.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4">
                    <div class="card shadow-sm border-0 h-100">
                        <div class="card-body text-center">
                            <i class="bi bi-building display-4 text-danger mb-2"></i>
                            <h5 class="fw-bold">Grados y cursos</h5>
                            <p class="text-muted">Crea grados, asigna docentes y configura horarios.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4">
                    <div class="card shadow-sm border-0 h-100">
                        <div class="card-body text-center">
                            <i class="bi bi-calendar display-4 text-danger mb-2"></i>
                            <h5 class="fw-bold">Año escolar y bimestres</h5>
                            <p class="text-muted">Activa años escolares y configura fechas de bimestres.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4">
                    <div class="card shadow-sm border-0 h-100">
                        <div class="card-body text-center">
                            <i class="bi bi-bar-chart-line display-4 text-danger mb-2"></i>
                            <h5 class="fw-bold">Notas y evaluaciones</h5>
                            <p class="text-muted">Revisa actas, reportes y genera informes MINEDU.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4">
                    <div class="card shadow-sm border-0 h-100">
                        <div class="card-body text-center">
                            <i class="bi bi-calendar-check display-4 text-danger mb-2"></i>
                            <h5 class="fw-bold">Asistencia global</h5>
                            <p class="text-muted">Reportes y alertas masivas de asistencia por grado.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4">
                    <div class="card shadow-sm border-0 h-100">
                        <div class="card-body text-center">
                            <i class="bi bi-chat-dots display-4 text-danger mb-2"></i>
                            <h5 class="fw-bold">Comunicación institucional</h5>
                            <p class="text-muted">Envía circulares y revisa estadísticas de lectura.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4">
                    <div class="card shadow-sm border-0 h-100">
                        <div class="card-body text-center">
                            <i class="bi bi-exclamation-triangle display-4 text-danger mb-2"></i>
                            <h5 class="fw-bold">Conducta y sanciones</h5>
                            <p class="text-muted">Revisa incidencias graves y aprueba suspensiones.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4">
                    <div class="card shadow-sm border-0 h-100">
                        <div class="card-body text-center">
                            <i class="bi bi-journal-bookmark-fill display-4 text-danger mb-2"></i>
                            <h5 class="fw-bold">Tareas y materiales</h5>
                            <p class="text-muted">Supervisa la carga y entrega de tareas.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4">
                    <div class="card shadow-sm border-0 h-100">
                        <div class="card-body text-center">
                            <i class="bi bi-award display-4 text-danger mb-2"></i>
                            <h5 class="fw-bold">Certificados y actas</h5>
                            <p class="text-muted">Genera certificados y actas oficiales masivas.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4">
                    <div class="card shadow-sm border-0 h-100">
                        <div class="card-body text-center">
                            <i class="bi bi-tools display-4 text-danger mb-2"></i>
                            <h5 class="fw-bold">Sistema y seguridad</h5>
                            <p class="text-muted">Ver bitácora, backups y seguridad del sistema.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection