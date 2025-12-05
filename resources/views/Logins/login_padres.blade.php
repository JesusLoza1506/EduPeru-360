@extends('layouts.app')

@section('content')
<div class="container-fluid p-0 d-flex justify-content-center align-items-center" style="min-height: 100vh; background-color: var(--light-blue);">
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
                    <h2 class="fw-bold text-primary animate__animated animate__fadeIn">¡BIENVENIDO PADRE DE FAMILIA!</h2>
                    <p class="lead text-secondary mb-4">Acceda al seguimiento académico, pagos, tareas y comunicados de su(s) hijo(s)</p>
                    <img src="{{ asset('imagenes/padre.jpg') }}" alt="Padre con hijo" class="img-fluid rounded-4 shadow-lg animate__animated animate__zoomIn" style="max-height:220px; object-fit:cover; border: 4px solid #ffffffff;">
                </div>

                <div class="card shadow-lg border-0 animate__animated animate__fadeInUp" style="border-radius: 1.5rem;">

                    <div class="card-header text-white text-center p-3" style="background-color: var(--primary); border-radius: 1.5rem 1.5rem 0 0;">
                        <h4 class="mb-0 fw-bold">ACCESO AL PORTAL</h4>
                    </div>

                    <div class="card-body p-4 p-md-5">
                        <form method="POST" action="/login/padres">
                            @csrf
                            <div class="mb-4">
                                <label for="dni" class="form-label fw-semibold">DNI del apoderado</label>
                                <div class="input-group input-group-lg">
                                    <span class="input-group-text"><i class="bi bi-person-vcard"></i></span>
                                    <input type="text" class="form-control" id="dni" name="dni" placeholder="72819465" required>
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
                                <button type="submit" class="btn btn-primary btn-lg shadow-sm fw-bold">
                                    <i class="bi bi-box-arrow-in-right me-2"></i> INGRESAR AL PORTAL
                                </button>
                            </div>

                            <div class="text-center small">
                                <a href="#" class="text-decoration-none text-muted">¿Olvidó su contraseña?</a>
                            </div>
                        </form>
                    </div>

                    <div class="card-footer bg-light text-center p-3" style="border-radius: 0 0 1.5rem 1.5rem;">
                        <span class="small text-muted">¿No tiene cuenta? </span>
                        <a href="#" class="text-primary fw-bold small">Solicite acceso al colegio</a>
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