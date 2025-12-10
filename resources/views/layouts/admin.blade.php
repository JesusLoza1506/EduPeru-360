<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>EduPerú360 - Admin</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="icon" type="image/png" href="{{ asset('logo.png') }}">
</head>

<body>
    <div class="container-fluid p-0" style="background-color: #fff4f4; min-height: 100vh;">
        <div class="row g-0" style="min-height: 100vh;">
            <!-- Menú lateral -->
            <div class="col-md-3 col-lg-2 bg-danger text-white d-flex flex-column align-items-center py-4 shadow-sm" style="min-height: 100vh;">
                <div class="mb-4 text-center">
                    <img src="{{ asset('imagenes/admin_logo.jpg') }}" alt="Logo admin" class="rounded-circle shadow" style="width: 80px; height: 80px; object-fit: cover;">
                    <h5 class="mt-3 fw-bold">Bienvenido, Administrador</h5>
                    <span class="badge bg-light text-danger" style="font-size: 0.8rem; padding:0.200em 0.575em;">EduPerú360</span>
                    <div class="mt-3">
                        <form action="{{ route('logout.admin') }}" method="POST">
                            @csrf
                            <button type="submit" class="btn w-100 fw-bold py-2"
                                style="background: #fff; color: #dc3545; border: 2px solid #dc3545; border-radius: 8px; font-weight: bold; box-shadow: 0 2px 8px rgba(0,0,0,0.08); transition: background 0.3s;">
                                <i class="bi bi-box-arrow-right me-2"></i> Cerrar sesión
                            </button>
                        </form>
                    </div>
                </div>
                <nav class="nav flex-column w-100">
                    <a class="nav-link text-white fw-semibold py-3" href="{{ url('/dashboard/admin') }}"><i class="bi bi-house-door me-2"></i> Dashboard Principal</a>
                    <a class="nav-link text-white fw-semibold py-3" href="{{ route('matriculas.index') }}"><i class="bi bi-mortarboard me-2"></i> Matrícula y estudiantes</a>
                    <a class="nav-link text-white fw-semibold py-3" href="{{ route('solicitudes.index') }}"><i class="bi bi-list-check me-2"></i> Solicitudes de Matrícula</a>
                    <a class="nav-link text-white fw-semibold py-3" href="{{ route('usuarios.index') }}"><i class="bi bi-person-badge me-2"></i> Docentes y usuarios</a>
                    <a class="nav-link text-white fw-semibold py-3" href="{{ route('grados.modulo') }}"><i class="bi bi-building me-2"></i> Grados y cursos</a>
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
                @yield('content')
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>