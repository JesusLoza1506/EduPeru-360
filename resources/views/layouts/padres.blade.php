<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>EduPerú360 - Padres</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="icon" type="image/png" href="{{ asset('logo.png') }}">
</head>

<body>
    <div class="container-fluid p-0" style="background-color: #f4f8ff; min-height: 100vh;">
        <div class="row g-0" style="min-height: 100vh;">
            <!-- Menú lateral -->
            <div class="col-md-3 col-lg-2 bg-primary text-white d-flex flex-column align-items-center py-4 shadow-sm" style="min-height: 100vh;">
                <div class="mb-4 text-center">
                    <img src="{{ asset('imagenes/padre.jpg') }}" alt="Foto padre" class="rounded-circle shadow" style="width: 80px; height: 80px; object-fit: cover;">
                    <h5 class="mt-3 fw-bold">Bienvenido, {{ Auth::user()->nombre }}</h5>
                    <span class="badge bg-light text-primary" style="font-size: 0.8rem; padding:0.200em 0.575em;">EduPerú360</span>
                </div>
                <nav class="nav flex-column w-100">
                    <a class="nav-link text-white fw-semibold py-3" href="{{ url('/dashboard/padres') }}"><i class="bi bi-house-door me-2"></i> Dashboard Principal</a>
                    <a class="nav-link text-white fw-semibold py-3" href="#"><i class="bi bi-bar-chart-line me-2"></i> Notas y Promedios</a>
                    <a class="nav-link text-white fw-semibold py-3" href="#"><i class="bi bi-calendar-check me-2"></i> Asistencia</a>
                    <a class="nav-link text-white fw-semibold py-3" href="#"><i class="bi bi-journal-bookmark me-2"></i> Tareas y Materiales</a>
                    <a class="nav-link text-white fw-semibold py-3" href="#"><i class="bi bi-exclamation-triangle me-2"></i> Conducta</a>
                    <a class="nav-link text-white fw-semibold py-3" href="#"><i class="bi bi-chat-dots me-2"></i> Comunicados</a>
                    <a class="nav-link text-white fw-semibold py-3" href="#"><i class="bi bi-award me-2"></i> Boletines y Certificados</a>
                    <a class="nav-link text-white fw-semibold py-3" href="#"><i class="bi bi-person-badge me-2"></i> Datos del Estudiante</a>
                    <a class="nav-link text-white fw-semibold py-3" href="#"><i class="bi bi-whatsapp me-2"></i> Contacto Docentes</a>
                    <a class="nav-link text-white fw-semibold py-3" href="{{ route('solicitudes.create') }}"><i class="bi bi-person-plus me-2"></i> Solicitar Matrícula</a>
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