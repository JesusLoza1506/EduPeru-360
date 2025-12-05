@extends('layouts.app')

@section('content')
<div class="container-fluid p-0 d-flex justify-content-center align-items-center" style="min-height: 100vh; background-color: var(--light-yellow);">
    <div class="container py-4">
        <nav class="navbar navbar-light bg-white mb-4 shadow-sm rounded-pill animate__animated animate__fadeInDown" style="max-width: 500px; margin: 0 auto;">
            <div class="container-fluid justify-content-center">
                <a class="navbar-brand fw-bold d-flex align-items-center" href="/">
                    <img src="{{ asset('imagenes/logo.png') }}" alt="Logo" style="height:32px; margin-right:10px;">
                    <span class="text-dark">EduPerú360</span>
                </a>
            </div>
        </nav>

        <div class="row justify-content-center">
            <div class="col-md-7 col-lg-5">

                <div class="text-center mb-4">
                    <h2 class="fw-bold text-warning animate__animated animate__fadeIn">¡BIENVENIDO DOCENTE!</h2>
                    <p class="lead text-secondary mb-4">Registre asistencia, notas, tareas y comuníquese con padres</p>
                    <img src="{{ asset('imagenes/docente.jpg') }}" alt="Docente explicando" class="img-fluid rounded-4 shadow-lg animate__animated animate__zoomIn" style="max-height:220px; object-fit:cover; border: 4px solid #fff;">
                </div>

                <div class="card shadow-lg border-0 animate__animated animate__fadeInUp" style="border-radius: 1.5rem;">

                    <div class="card-header text-dark text-center p-3" style="background-color: var(--warning); border-radius: 1.5rem 1.5rem 0 0;">
                        <h4 class="mb-0 fw-bold">ACCESO AL PORTAL DOCENTE</h4>
                    </div>

                    <div class="card-body p-4 p-md-5">
                        <!-- Mensajes de éxito o error -->
                        @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show mb-4 animate__animated animate__fadeInDown" role="alert">
                            <i class="bi bi-check-circle me-2"></i> {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Cerrar"></button>
                        </div>
                        @endif
                        @if(session('error'))
                        <div class="alert alert-danger alert-dismissible fade show mb-4 animate__animated animate__shakeX" role="alert">
                            <i class="bi bi-exclamation-triangle me-2"></i> {{ session('error') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Cerrar"></button>
                        </div>
                        @endif
                        @if($errors->any())
                        <div class="alert alert-danger alert-dismissible fade show mb-4 animate__animated animate__shakeX" role="alert">
                            <i class="bi bi-exclamation-triangle me-2"></i> {{ $errors->first() }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Cerrar"></button>
                        </div>
                        @endif
                        <form method="POST" action="/login/docentes">
                            @csrf
                            <div class="mb-4">
                                <label for="dni" class="form-label fw-semibold">DNI del docente</label>
                                <div class="input-group input-group-lg">
                                    <span class="input-group-text"><i class="bi bi-person-badge"></i></span>
                                    <input type="text" class="form-control" id="dni" name="dni" placeholder="41234567" required>
                                </div>
                            </div>

                            <div class="mb-4">
                                <label for="password" class="form-label fw-semibold">Contraseña</label>
                                <div class="input-group input-group-lg">
                                    <span class="input-group-text"><i class="bi bi-lock-fill"></i></span>
                                    <input type="password" class="form-control" id="password" name="password" placeholder="Contraseña" required>
                                    <button class="btn btn-outline-secondary" type="button" id="togglePassword">
                                        <i class="bi bi-eye"></i>
                                    </button>
                                </div>
                            </div>

                            <div class="d-grid gap-2 mb-3 mt-4">
                                <button type="submit" class="btn btn-warning btn-lg shadow-sm fw-bold text-dark">
                                    <i class="bi bi-box-arrow-in-right me-2"></i> INGRESAR COMO DOCENTE
                                </button>
                            </div>

                            <div class="text-center small">
                                <a href="#" class="text-decoration-none text-muted">¿Olvidó su contraseña?</a>
                            </div>
                        </form>
                    </div>

                    <div class="card-footer bg-light text-center p-3" style="border-radius: 0 0 1.5rem 1.5rem;">
                        <span class="small text-muted">Use sus credenciales proporcionadas por la institución.</span>
                    </div>
                </div>

                <div class="text-center mt-4">
                    <a href="/" class="btn btn-link text-dark fw-semibold"><i class="bi bi-arrow-left me-1"></i> Volver a la página principal</a>
                </div>
            </div>
        </div>
    </div>
</div>

@push('styles')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
{{-- Carga el CSS global para usar las variables y estilos base --}}
<link rel="stylesheet" href="{{ asset('css/acceso.css') }}" />
@endpush

@push('scripts')
<script>
    document.getElementById('togglePassword').addEventListener('click', function() {
        var passwordInput = document.getElementById('password');
        var icon = this.querySelector('i');
        // Alternar el tipo de input y el icono
        if (passwordInput.type === 'password') {
            passwordInput.type = 'text';
            icon.classList.remove('bi-eye');
            icon.classList.add('bi-eye-slash');
        } else {
            passwordInput.type = 'password';
            icon.classList.remove('bi-eye-slash');
            icon.classList.add('bi-eye');
        }
    });
</script>
@endpush