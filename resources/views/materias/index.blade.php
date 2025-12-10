@extends('layouts.admin')

@section('content')
<link rel="stylesheet" href="{{ asset('css/matriculas-admin.css') }}">
<div class="matricula-header d-flex align-items-center justify-content-between">
    <div>
        <span class="matricula-title"><i class="bi bi-book me-2"></i> Materias</span>
        <p class="mb-0 mt-2">Gestión de materias escolares.</p>
    </div>
    <a href="{{ route('materias.create') }}" class="btn btn-matricula shadow">Registrar nueva materia</a>
</div>
@if(session('success'))
<div class="alert alert-success">{{ session('success') }}</div>
@endif
<div class="table-responsive">
    <table class="table matricula-table table-striped table-hover rounded shadow">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Descripción</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($cursos as $curso)
            <tr>
                <td>{{ $curso->id }}</td>
                <td>{{ $curso->nombre }}</td>
                <td>{{ $curso->area_curricular }}</td>
                <td>
                    <a href="{{ route('materias.edit', $curso->id) }}" class="btn btn-sm btn-warning me-1">
                        <span style="font-size:18px; margin-right:4px; vertical-align:middle;">✏️</span>Editar
                    </a>
                    <form action="{{ route('materias.destroy', $curso->id) }}" method="POST" style="display:inline-block;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('¿Seguro que deseas eliminar esta materia?')">
                            <span style="font-size:18px; margin-right:4px; vertical-align:middle;">🗑️</span>Eliminar
                        </button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection