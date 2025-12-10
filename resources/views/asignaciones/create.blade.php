@extends('layouts.admin')

@section('content')
<link rel="stylesheet" href="{{ asset('css/matriculas-admin.css') }}">
<div class="matricula-header d-flex align-items-center justify-content-between">
    <div>
        <span class="matricula-title"><i class="bi bi-person-badge me-2"></i> Nueva Asignación de Curso a Docente</span>
        <p class="mb-0 mt-2">Completa el formulario para asignar un curso a un docente.</p>
    </div>
    <a href="{{ route('asignaciones.index') }}" class="btn btn-secondary shadow">Volver a asignaciones</a>
</div>
@if($errors->any())
<div class="alert alert-danger">
    <ul class="mb-0">
        @foreach($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif
@if(session('error'))
<div class="alert alert-danger">{{ session('error') }}</div>
@endif
<form action="{{ route('asignaciones.store') }}" method="POST" class="bg-white rounded shadow p-4 mt-4" style="max-width:600px; margin:auto;">
    @csrf
    <div class="mb-3">
        <label for="curso_id" class="form-label">Curso</label>
        <select name="curso_id" id="curso_id" class="form-select" required>
            <option value="">Selecciona un curso</option>
            @foreach($cursos as $curso)
            <option value="{{ $curso->id }}" {{ old('curso_id') == $curso->id ? 'selected' : '' }}>{{ $curso->nombre }}</option>
            @endforeach
        </select>
    </div>
    <div class="mb-3">
        <label for="grado_id" class="form-label">Grado y sección</label>
        <select name="grado_id" id="grado_id" class="form-select" required>
            <option value="">Selecciona un grado</option>
            @foreach($grados as $grado)
            <option value="{{ $grado->id }}" {{ old('grado_id') == $grado->id ? 'selected' : '' }}>
                {{ $grado->grado }}° {{ $grado->nivel }} {{ $grado->seccion }}
            </option>
            @endforeach
        </select>
    </div>
    <div class="mb-3">
        <label for="docente_id" class="form-label">Docente</label>
        <select name="docente_id" id="docente_id" class="form-select" required>
            <option value="">Selecciona un docente</option>
            @foreach($docentes as $docente)
            <option value="{{ $docente->id }}" {{ old('docente_id') == $docente->id ? 'selected' : '' }}>
                {{ $docente->nombre }} {{ $docente->apellido }}
            </option>
            @endforeach
        </select>
    </div>
    <div class="mb-3">
        <label for="ano_escolar_id" class="form-label">Año escolar</label>
        <select name="ano_escolar_id" id="ano_escolar_id" class="form-select" required>
            <option value="">Selecciona un año</option>
            @foreach($anios as $anio)
            <option value="{{ $anio->id }}" {{ old('ano_escolar_id') == $anio->id ? 'selected' : '' }}>{{ $anio->ano }}</option>
            @endforeach
        </select>
    </div>
    <div class="d-flex justify-content-end">
        <button type="submit" class="btn btn-matricula">Guardar asignación</button>
    </div>
</form>
@endsection