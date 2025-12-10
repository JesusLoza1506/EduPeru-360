@extends('layouts.admin')

@section('content')
<link rel="stylesheet" href="{{ asset('css/matriculas-admin.css') }}">
<div class="matricula-header d-flex align-items-center justify-content-between">
    <div>
        <span class="matricula-title"><i class="bi bi-building me-2"></i> Editar Grado</span>
        <p class="mb-0 mt-2">Modificar datos del grado escolar y sección.</p>
    </div>
</div>
<div class="d-flex justify-content-center align-items-center" style="min-height: 60vh;">
    <form action="{{ route('grados.update', $grado->id) }}" method="POST" class="card shadow rounded-4 p-4 mx-auto matricula-form" style="max-width: 600px; width:100%;">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="nivel" class="form-label">Nivel</label>
            <select name="nivel" id="nivel" class="form-control" required>
                <option value="Primaria" {{ $grado->nivel == 'Primaria' ? 'selected' : '' }}>Primaria</option>
                <option value="Secundaria" {{ $grado->nivel == 'Secundaria' ? 'selected' : '' }}>Secundaria</option>
            </select>
        </div>
        <div class="mb-3">
            <label for="grado" class="form-label">Grado</label>
            <input type="number" name="grado" id="grado" class="form-control" required min="1" value="{{ $grado->grado }}">
        </div>
        <div class="mb-3">
            <label for="seccion" class="form-label">Sección</label>
            <input type="text" name="seccion" id="seccion" class="form-control" required maxlength="1" value="{{ $grado->seccion }}">
        </div>
        <div class="mb-3">
            <label for="capacidad" class="form-label">Capacidad</label>
            <input type="number" name="capacidad" id="capacidad" class="form-control" required min="1" value="{{ $grado->capacidad }}">
        </div>
        <div class="d-flex justify-content-end gap-2 mt-4">
            <button type="submit" class="btn btn-success px-4">Actualizar</button>
            <a href="{{ route('grados.index') }}" class="btn btn-secondary px-4">Cancelar</a>
        </div>
    </form>
</div>
@endsection