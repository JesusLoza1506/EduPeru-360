@extends('layouts.admin')

@section('content')
<div class="container py-4">
    <h2 class="mb-4 fw-bold">Editar Matrícula</h2>
    <form action="{{ route('matriculas.update', $matricula->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="estudiante_id" class="form-label">Estudiante</label>
            <select name="estudiante_id" id="estudiante_id" class="form-select" required>
                @foreach($estudiantes as $estudiante)
                <option value="{{ $estudiante->id }}" {{ $matricula->estudiante_id == $estudiante->id ? 'selected' : '' }}>{{ $estudiante->usuario->nombre }} {{ $estudiante->usuario->apellido }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label for="grado_id" class="form-label">Grado</label>
            <select name="grado_id" id="grado_id" class="form-select" required>
                @foreach($grados as $grado)
                <option value="{{ $grado->id }}" {{ $matricula->grado_id == $grado->id ? 'selected' : '' }}>{{ $grado->nivel }} {{ $grado->grado }}{{ $grado->seccion }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label for="ano_escolar_id" class="form-label">Año Escolar</label>
            <select name="ano_escolar_id" id="ano_escolar_id" class="form-select" required>
                @foreach($anosEscolares as $ano)
                <option value="{{ $ano->id }}" {{ $matricula->ano_escolar_id == $ano->id ? 'selected' : '' }}>{{ $ano->ano }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label for="fecha_matricula" class="form-label">Fecha de Matrícula</label>
            <input type="date" name="fecha_matricula" id="fecha_matricula" class="form-control" value="{{ $matricula->fecha_matricula->format('Y-m-d') }}" required>
        </div>
        <div class="mb-3">
            <label for="estado" class="form-label">Estado</label>
            <select name="estado" id="estado" class="form-select" required>
                <option value="Activo" {{ $matricula->estado == 'Activo' ? 'selected' : '' }}>Activo</option>
                <option value="Retirado" {{ $matricula->estado == 'Retirado' ? 'selected' : '' }}>Retirado</option>
                <option value="Repitente" {{ $matricula->estado == 'Repitente' ? 'selected' : '' }}>Repitente</option>
            </select>
        </div>
        <button type="submit" class="btn btn-warning">Actualizar</button>
        <a href="{{ route('matriculas.index') }}" class="btn btn-secondary">Cancelar</a>
    </form>
</div>
@endsection