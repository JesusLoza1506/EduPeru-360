@extends('layouts.admin')

@section('content')
<link rel="stylesheet" href="{{ asset('css/matriculas-admin.css') }}">
<div class="matricula-header d-flex align-items-center justify-content-between">
    <div>
        <span class="matricula-title"><i class="bi bi-mortarboard me-2"></i> Registrar Matrícula</span>
        <p class="mb-0 mt-2">Completa los datos para registrar una nueva matrícula.</p>
    </div>
    <a href="{{ route('matriculas.index') }}" class="btn btn-matricula shadow">Volver al listado</a>
</div>
<div class="d-flex justify-content-center align-items-center" style="min-height: 60vh;">
    <form action="{{ route('matriculas.store') }}" method="POST" class="card shadow rounded-4 p-4 mx-auto matricula-form" style="max-width: 1220px; width:100%;">
        @csrf
        <div class="mb-4 text-center">
            <i class="bi bi-person-plus display-5 text-danger"></i>
        </div>
        <div class="mb-3">
            <label for="estudiante_id" class="form-label fw-semibold">Estudiante</label>
            <select name="estudiante_id" id="estudiante_id" class="form-select" required>
                <option value="">Seleccione...</option>
                @foreach($estudiantes as $estudiante)
                <option value="{{ $estudiante->id }}">{{ $estudiante->usuario->nombre }} {{ $estudiante->usuario->apellido }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label for="grado_id" class="form-label fw-semibold">Grado</label>
            <select name="grado_id" id="grado_id" class="form-select" required>
                <option value="">Seleccione...</option>
                @foreach($grados as $grado)
                <option value="{{ $grado->id }}">{{ $grado->nivel }} {{ $grado->grado }}{{ $grado->seccion }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label for="ano_escolar_id" class="form-label fw-semibold">Año Escolar</label>
            <select name="ano_escolar_id" id="ano_escolar_id" class="form-select" required>
                <option value="">Seleccione...</option>
                @foreach($anosEscolares as $ano)
                <option value="{{ $ano->id }}">{{ $ano->ano }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label for="fecha_matricula" class="form-label fw-semibold">Fecha de Matrícula</label>
            <input type="date" name="fecha_matricula" id="fecha_matricula" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="estado" class="form-label fw-semibold">Estado</label>
            <select name="estado" id="estado" class="form-select" required>
                <option value="Activo">Activo</option>
                <option value="Retirado">Retirado</option>
                <option value="Repitente">Repitente</option>
            </select>
        </div>
        <div class="d-flex justify-content-end gap-2 mt-4">
            <button type="submit" class="btn btn-matricula px-4">Registrar</button>
            <a href="{{ route('matriculas.index') }}" class="btn btn-secondary px-4">Cancelar</a>
        </div>
    </form>
</div>
@endsection