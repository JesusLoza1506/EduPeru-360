@extends('layouts.app')

@section('content')
<div class="container-fluid p-0">
    <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm sticky-top custom-navbar">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center" href="#">
                <img src="{{ asset('imagenes/logo.png') }}" alt="Logo" style="height:40px; margin-right:10px;">
                <span class="fw-bold fs-4 text-primary">EduPerú360</span>
            </a>
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                <li class="nav-item"><a class="nav-link fw-semibold" href="#">Home</a></li>
                <li class="nav-item"><a class="nav-link fw-semibold" href="#">Nosotros</a></li>
                <li class="nav-item"><a class="nav-link fw-semibold" href="#">Contacto</a></li>
            </ul>
        </div>
    </nav>

    <div class="hero-section position-relative d-flex flex-column align-items-center justify-content-center py-5 mb-5" style="min-height: 480px;">
        <div class="hero-bg-anim"></div>
        <div class="container text-center position-relative z-1">
            <img src="{{ asset('imagenes/niños.png') }}" alt="Niños en clase" class="img-fluid mb-4 rounded-circle shadow-lg animate__animated animate__zoomIn hero-img-custom" style="max-height:240px; object-fit:cover;">
            <h2 class="fw-bolder mb-3 animate__animated animate__fadeInUp hero-title">¡Forma parte de la familia <span class="text-primary">EduPerú360</span>!</h2>
            <div class="mt-4 animate__animated animate__fadeIn animate__delay-1s">
                <p class="fs-4 text-secondary fw-light">Innovación, valores y tecnología para el futuro de tus hijos.</p>
                <div class="d-inline-block position-relative">
                    <span class="badge bg-success fs-5 shadow px-4 py-2 mt-3 admission-badge">Admisión 2025 abierta</span>
                </div>
            </div>
        </div>
    </div>

    <div class="container my-5 py-4">
        <h3 class="text-center mb-5 fw-bold text-secondary">Nuestros Pilares de Formación</h3>
        <div class="row g-4 text-center">
            <div class="col-md-4">
                <div class="pilar-card p-4 h-100 rounded-3 shadow-sm animate__animated animate__fadeInLeft">
                    <i class="bi bi-lightbulb-fill text-primary display-4 mb-3"></i>
                    <h5 class="fw-bold text-primary">Innovación Educativa</h5>
                    <p class="text-muted">Metodologías activas, aprendizaje basado en proyectos y desarrollo de pensamiento crítico.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="pilar-card p-4 h-100 rounded-3 shadow-sm animate__animated animate__fadeInUp animate__delay-0-5s">
                    <i class="bi bi-person-check-fill text-success display-4 mb-3"></i>
                    <h5 class="fw-bold text-success">Valores y Ética</h5>
                    <p class="text-muted">Formación integral centrada en el respeto, la responsabilidad y el compromiso social.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="pilar-card p-4 h-100 rounded-3 shadow-sm animate__animated animate__fadeInRight animate__delay-1s">
                    <i class="bi bi-laptop-fill text-info display-4 mb-3"></i>
                    <h5 class="fw-bold text-info">Tecnología Aplicada</h5>
                    <p class="text-muted">Aulas digitales, robótica y programación, preparando a los estudiantes para el futuro.</p>
                </div>
            </div>
        </div>
    </div>

    <div class="container my-5 py-4">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="card shadow-lg border-0 animate__animated animate__fadeInUp matrícula-card">
                    <div class="card-header text-white text-center rounded-top p-3">
                        <h3 class="mb-0 fw-bold"><i class="bi bi-pencil-square me-2"></i> PRE-MATRÍCULA 2025</h3>
                    </div>
                    <div class="card-body p-4 p-md-5">
                        <form class="row g-4 needs-validation" novalidate>
                            <div class="col-md-6">
                                <label for="nombre" class="form-label fw-semibold">Nombre del estudiante</label>
                                <input type="text" class="form-control form-control-lg" id="nombre" placeholder="Nombre completo del estudiante" required>
                                <div class="invalid-feedback">Por favor ingrese el nombre.</div>
                            </div>
                            <div class="col-md-6">
                                <label for="dni" class="form-label fw-semibold">DNI/Pasaporte</label>
                                <input type="text" class="form-control form-control-lg" id="dni" placeholder="Documento de identidad" required>
                                <div class="invalid-feedback">Por favor ingrese el DNI.</div>
                            </div>
                            <div class="col-md-6">
                                <label for="grado" class="form-label fw-semibold">Nivel Educativo</label>
                                <select class="form-select form-select-lg" id="grado" required>
                                    <option selected disabled value="">Selecciona nivel...</option>
                                    <option>Nivel Primaria</option>
                                    <option>Nivel Secundaria</option>
                                </select>
                                <div class="invalid-feedback">Por favor seleccione el grado.</div>
                            </div>
                            <div class="col-md-6">
                                <label for="telefono" class="form-label fw-semibold">Teléfono de contacto (Padre/Madre)</label>
                                <input type="text" class="form-control form-control-lg" id="telefono" placeholder="+51 9XX XXX XXX" required>
                                <div class="invalid-feedback">Por favor ingrese un teléfono válido.</div>
                            </div>
                            <div class="col-12">
                                <label for="email" class="form-label fw-semibold">Email (Padre/Madre)</label>
                                <input type="email" class="form-control form-control-lg" id="email" placeholder="ejemplo@email.com" required>
                                <div class="invalid-feedback">Por favor ingrese un email válido.</div>
                            </div>
                            <div class="col-12 text-center mt-5">
                                <button type="submit" class="btn btn-success btn-lg px-5 shadow-lg btn-matricular">
                                    <i class="bi bi-arrow-right-circle-fill me-2"></i> Enviar Pre-matrícula
                                </button>
                                <p class="text-muted small mt-3">Nos pondremos en contacto con usted en las próximas 24 horas.</p>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container my-5 py-4 animate__animated animate__fadeInUp animate__delay-1s">
        <h4 class="mb-4 text-center fw-bold text-primary">Acceso Rápido a Plataformas</h4>
        <div class="row text-center g-4">
            <div class="col-md-3 mb-3">
                <a href="/login/padres" class="btn btn-lg w-100 py-4 shadow-lg rounded-3 acceso-btn acceso-padres d-flex flex-column align-items-center justify-content-center position-relative">
                    <span class="acceso-glow acceso-padres-glow"></span>
                    <i class="bi bi-people-fill acceso-icon mb-2"></i>
                    <span class="fw-bold fs-4">PADRES</span>
                    <span class="badge bg-primary mt-2">Nuevo Portal</span>
                </a>
            </div>
            <div class="col-md-3 mb-3">
                <a href="/login/estudiantes" class="btn btn-lg w-100 py-4 shadow-lg rounded-3 acceso-btn acceso-estudiantes d-flex flex-column align-items-center justify-content-center position-relative">
                    <span class="acceso-glow acceso-estudiantes-glow"></span>
                    <i class="bi bi-person-badge acceso-icon mb-2"></i>
                    <span class="fw-bold fs-4">ESTUDIANTES</span>
                    <span class="badge bg-success mt-2">Aula Virtual</span>
                </a>
            </div>
            <div class="col-md-3 mb-3">
                <a href="/login/docentes" class="btn btn-lg w-100 py-4 shadow-lg rounded-3 acceso-btn acceso-docentes d-flex flex-column align-items-center justify-content-center position-relative">
                    <span class="acceso-glow acceso-docentes-glow"></span>
                    <i class="bi bi-person-video3 acceso-icon mb-2"></i>
                    <span class="fw-bold fs-4">DOCENTES</span>
                    <span class="badge bg-warning text-dark mt-2">Recursos</span>
                </a>
            </div>
            <div class="col-md-3 mb-3">
                <a href="/login/administracion" class="btn btn-lg w-100 py-4 shadow-lg rounded-3 acceso-btn acceso-admin d-flex flex-column align-items-center justify-content-center position-relative">
                    <span class="acceso-glow acceso-admin-glow"></span>
                    <i class="bi bi-gear-fill acceso-icon mb-2"></i>
                    <span class="fw-bold fs-4">ADMINISTRACIÓN</span>
                    <span class="badge bg-purple mt-2">Sistema Interno</span>
                </a>
            </div>
        </div>
    </div>

    <div class="container my-5 py-4">
        <h4 class="mb-5 text-center fw-bold text-secondary border-bottom border-primary pb-2 d-inline-block mx-auto">Últimas Noticias y Eventos</h4>
        <div class="row g-4">
            <div class="col-md-4 mb-3">
                <div class="card h-100 shadow-hover animate__animated animate__fadeIn">
                    <img src="{{ asset('imagenes/noticia1.png') }}" class="card-img-top card-img-custom" alt="Noticia 1">
                    <div class="card-body d-flex flex-column">
                        <span class="badge bg-primary-subtle text-primary mb-2">Eventos</span>
                        <h5 class="card-title fw-bold text-dark">Día de Logro Innovador</h5>
                        <p class="card-text text-muted flex-grow-1">Descubre los proyectos más creativos de nuestros estudiantes en ciencia y tecnología. ¡Ver fotos!</p>
                        <a href="#" class="btn btn-sm btn-outline-primary mt-3">Leer más <i class="bi bi-arrow-right"></i></a>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-3">
                <div class="card h-100 shadow-hover animate__animated animate__fadeIn animate__delay-0-5s">
                    <img src="{{ asset('imagenes/noticia2.png') }}" class="card-img-top card-img-custom" alt="Noticia 2">
                    <div class="card-body d-flex flex-column">
                        <span class="badge bg-success-subtle text-success mb-2">Circular</span>
                        <h5 class="card-title fw-bold text-dark">Horarios de Tutoría 2025</h5>
                        <p class="card-text text-muted flex-grow-1">Circular informativa sobre el nuevo esquema de tutorías personalizadas para todos los niveles.</p>
                        <a href="#" class="btn btn-sm btn-outline-success mt-3">Ver documento <i class="bi bi-arrow-right"></i></a>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-3">
                <div class="card h-100 shadow-hover animate__animated animate__fadeIn animate__delay-1s">
                    <img src="{{ asset('imagenes/noticia3.png') }}" class="card-img-top card-img-custom" alt="Noticia 3">
                    <div class="card-body d-flex flex-column">
                        <span class="badge bg-warning-subtle text-warning mb-2">Convocatoria</span>
                        <h5 class="card-title fw-bold text-dark">Beca de Excelencia Académica</h5>
                        <p class="card-text text-muted flex-grow-1">Se abre la convocatoria para las becas integrales para el próximo año. Revisa los requisitos aquí.</p>
                        <a href="#" class="btn btn-sm btn-outline-warning mt-3">Postular <i class="bi bi-arrow-right"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <footer class="text-black py-5 mt-5 footer-custom">
        <div class="container text-center">
            <div class="row align-items-center">
                <div class="col-md-4 mb-3 mb-md-0">
                    <img src="{{ asset('imagenes/logo.png') }}" alt="Logo Blanco" style="height:200px; width:200px;">
                </div>
                <div class="col-md-4 mb-3 mb-md-0 fs-6">
                    <a href="#" class="text-black d-block mb-1"><i class="bi bi-geo-alt-fill me-2"></i>Av. Los Girasoles 123, Lima, Perú</a>
                    <a href="#" class="text-black d-block mb-1"><i class="bi bi-telephone-fill me-2"></i>+51 1 555-5555</a>
                    <a href="#" class="text-black d-block mb-1"><i class="bi bi-envelope-fill me-2"></i>admision@eduperu360.edu.pe</a>
                </div>
                <div class="col-md-4">
                    <a href="#" class="text-black mx-2 icon-social"><i class="bi bi-facebook fs-3"></i></a>
                    <a href="#" class="text-black mx-2 icon-social"><i class="bi bi-whatsapp fs-3"></i></a>
                    <a href="#" class="text-black mx-2 icon-social"><i class="bi bi-instagram fs-3"></i></a>
                    <a href="#" class="text-black mx-2 icon-social"><i class="bi bi-youtube fs-3"></i></a>
                </div>
            </div>
            <div class="mt-4 small pt-3 border-top border-secondary">&copy; {{ date('Y') }} EduPerú360. Todos los derechos reservados.</div>
        </div>
    </footer>
</div>
@endsection

@push('styles')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
<link rel="stylesheet" href="{{ asset('css/acceso.css') }}" />
@endpush

@push('scripts')
<script>
    // Example starter JavaScript for disabling form submissions if there are invalid fields
    (function() {
        'use strict'

        // Fetch all the forms we want to apply custom Bootstrap validation styles to
        var forms = document.querySelectorAll('.needs-validation')

        // Loop over them and prevent submission
        Array.prototype.slice.call(forms)
            .forEach(function(form) {
                form.addEventListener('submit', function(event) {
                    if (!form.checkValidity()) {
                        event.preventDefault()
                        event.stopPropagation()
                    }

                    form.classList.add('was-validated')
                }, false)
            })
    })()
</script>
@endpush