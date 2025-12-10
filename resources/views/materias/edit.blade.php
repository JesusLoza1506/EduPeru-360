@extends('layouts.admin')

@section('content')
<link rel="stylesheet" href="{{ asset('css/matriculas-admin.css') }}">
<div class="matricula-header d-flex align-items-center justify-content-between">
    <div>
        <span class="matricula-title"><i class="bi bi-book me-2"></i> Editar Materia</span>
        <p class="mb-0 mt-2">Modifica los datos de la materia escolar.</p>
    </div>
</div>
<div class="d-flex justify-content-center align-items-center" style="min-height: 60vh;">
    <form action="{{ route('materias.update', $curso->id) }}" method="POST" class="card shadow rounded-4 p-4 mx-auto matricula-form" style="max-width: 600px; width:100%;">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="nombre" class="form-label">Nombre</label>
            <input type="text" name="nombre" id="nombre" class="form-control" required maxlength="100" value="{{ $curso->nombre }}">
        </div>
        <div class="mb-3">
            <label for="area_curricular" class="form-label">Área Curricular</label>
            <input type="text" name="area_curricular" id="area_curricular" class="form-control" maxlength="100" value="{{ $curso->area_curricular }}">
        </div>
        <div class="d-flex justify-content-end gap-2 mt-4">
            <button type="submit" class="btn btn-success px-4">Actualizar</button>
            <a href="{{ route('materias.index') }}" class="btn btn-secondary px-4">Cancelar</a>
        </div>
    </form>
</div>
@endsection