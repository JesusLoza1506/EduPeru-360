@extends('layouts.admin')

@section('content')
<link rel="stylesheet" href="{{ asset('css/matriculas-admin.css') }}">
<div class="matricula-header d-flex align-items-center justify-content-between">
    <div>
        <span class="matricula-title"><i class="bi bi-person-badge me-2"></i> Asignaciones de Cursos a Docentes</span>
        <p class="mb-0 mt-2">Gestión de asignaciones por grado, curso y docente.</p>
    </div>
    <a href="{{ route('asignaciones.create') }}" class="btn btn-matricula shadow">Nueva asignación</a>
</div>
@if(session('success'))
<div class="alert alert-success">{{ session('success') }}</div>
@endif
@if(session('error'))
<div class="alert alert-danger">{{ session('error') }}</div>
@endif
<div class="table-responsive">
    <table class="table matricula-table table-striped table-hover rounded shadow">
        <thead>
            <tr>
                <th>Curso</th>
                <th>Grado</th>
                <th>Sección</th>
                <th>Docente</th>
                <th>Año escolar</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($asignaciones as $asignacion)
            <tr>
                <td>{{ $asignacion->curso->nombre }}</td>
                <td>{{ $asignacion->grado->grado }}° {{ $asignacion->grado->nivel }}</td>
                <td>{{ $asignacion->grado->seccion }}</td>
                <td>{{ $asignacion->docente->nombre }} {{ $asignacion->docente->apellido }}</td>
                <td>{{ $asignacion->anoEscolar->ano }}</td>
                <td>
                    <a href="{{ route('asignaciones.edit', $asignacion->id) }}" class="btn btn-warning btn-sm me-1">
                        <span style="font-size:18px; margin-right:4px; vertical-align:middle;">✏️</span>Editar
                    </a>
                    <form action="{{ route('asignaciones.destroy', $asignacion->id) }}" method="POST" style="display:inline-block;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('¿Seguro que deseas eliminar esta asignación?')">
                            <span style="font-size:18px; margin-right:4px; vertical-align:middle;">🗑️</span>Eliminar
                        </button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
<div class="d-flex justify-content-center mt-4">
    <span>
        Mostrando <b>{{ $asignaciones->firstItem() }}</b> a <b>{{ $asignaciones->lastItem() }}</b> de <b>{{ $asignaciones->total() }}</b> resultados
    </span>
    <div class="ms-3">
        {{ $asignaciones->onEachSide(1)->links('pagination::bootstrap-5') }}
    </div>
</div>
@endsection