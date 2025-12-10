@extends('layouts.admin')

@section('content')
<link rel="stylesheet" href="{{ asset('css/matriculas-admin.css') }}">
<div class="matricula-header d-flex align-items-center justify-content-between">
    <div>
        <span class="matricula-title"><i class="bi bi-building me-2"></i> Grados y Cursos</span>
        <p class="mb-0 mt-2">Selecciona el módulo que deseas gestionar.</p>
    </div>
</div>
<div class="row justify-content-center mt-5">
    <div class="col-md-8">
        <div class="card shadow rounded-4 p-4">
            <div class="row g-4">
                <div class="col-md-6 d-flex justify-content-center">
                    <a href="{{ route('grados.index') }}" class="btn btn-matricula w-100 py-4 fw-bold fs-5">
                        <i class="bi bi-journal-bookmark-fill me-2"></i> Gestionar Cursos
                    </a>
                </div>
                <div class="col-md-6 d-flex justify-content-center">
                    <a href="{{ route('materias.index') }}" class="btn btn-secondary w-100 py-4 fw-bold fs-5">
                        <i class="bi bi-book me-2"></i> Gestionar Materias
                    </a>
                </div>
                <div class="col-md-6 d-flex justify-content-center">
                    <a href="{{ route('asignaciones.index') }}" class="btn btn-warning w-100 py-4 fw-bold fs-5">
                        <i class="bi bi-person-badge me-2"></i> Asignar Cursos a Docentes
                    </a>
                </div>
                <div class="col-md-6 d-flex justify-content-center">
                    <a href="#" class="btn btn-info w-100 py-4 fw-bold fs-5">
                        <i class="bi bi-calendar-week me-2"></i> Gestionar Horarios
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection