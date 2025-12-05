@extends('layouts.app')

@section('content')
<div class="container-fluid p-0 d-flex justify-content-center align-items-center" style="min-height: 100vh; background-color: var(--light-purple);">
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
                    <h2 class="fw-bold text-danger animate__animated animate__fadeIn">PANEL ADMINISTRATIVO</h2>
                    <p class="lead text-secondary mb-4">Directivos, secretaría, tesorería y coordinación</p>
                    {{-- La imagen se centra y tiene un borde blanco para destacarla --}}
                    <img src="{{ asset('imagenes/admin_logo.jpg') }}" alt="Logo del colegio" class="img-fluid rounded-4 shadow-lg animate__animated animate__zoomIn" style="max-height:180px; object-fit:contain; border: 4px solid #fff;">
                </div>

                <div class="card shadow-lg border-0 animate__animated animate__fadeInUp" style="border-radius: 1.5rem;">

                    <div class="card-header text-white text-center p-3" style="background-color: #dc3545; border-radius: 1.5rem 1.5rem 0 0;">
                        <h4 class="mb-0 fw-bold">ACCESO DE PERSONAL</h4>
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
                        <form method="POST" action="/login/admin">
                            @csrf
                            <div class="mb-4">
                                <label for="usuario" class="form-label fw-semibold">Usuario o DNI</label>
                                <div class="input-group input-group-lg">
                                    <span class="input-group-text"><i class="bi bi-person-lock"></i></span>
                                    <input type="text" class="form-control" id="usuario" name="usuario" placeholder="admin2025" required>
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
                                <button type="submit" class="btn btn-danger btn-lg shadow-sm fw-bold">
                                    <i class="bi bi-box-arrow-in-right me-2"></i> INGRESAR AL PANEL
                                </button>
                            </div>
                        </form>
                    </div>

                    <div class="card-footer bg-light text-center p-3" style="border-radius: 0 0 1.5rem 1.5rem;">
                        <a href="#" class="text-decoration-none text-muted small">¿Problemas con el acceso?</a>
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