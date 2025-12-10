@extends('layouts.admin')

@section('content')
<link rel="stylesheet" href="{{ asset('css/matriculas-admin.css') }}">
<div class="matricula-header d-flex align-items-center justify-content-between">
    <div>
        <span class="matricula-title"><i class="bi bi-building me-2"></i> Grados</span>
        <p class="mb-0 mt-2">Gestión de grados escolares y secciones.</p>
    </div>
    <a href="{{ route('grados.create') }}" class="btn btn-matricula shadow">Registrar nuevo grado</a>
</div>
@if(session('success'))
<div class="alert alert-success">{{ session('success') }}</div>
@endif
<div class="table-responsive">
    <table class="table matricula-table table-striped table-hover rounded shadow">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nivel</th>
                <th>Grado</th>
                <th>Sección</th>
                <th>Capacidad</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($grados as $grado)
            <tr>
                <td>{{ $grado->id }}</td>
                <td>{{ $grado->nivel }}</td>
                <td>{{ $grado->grado }}</td>
                <td>{{ $grado->seccion }}</td>
                <td>{{ $grado->capacidad }}</td>
                <td>
                    <a href="{{ route('grados.edit', $grado->id) }}" class="btn btn-sm btn-warning me-1">
                        <span style="font-size:18px; margin-right:4px; vertical-align:middle;">✏️</span>Editar
                    </a>
                    <form action="{{ route('grados.destroy', $grado->id) }}" method="POST" style="display:inline-block;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('¿Seguro que deseas eliminar este grado?')">
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
        Mostrando <b>{{ $grados->firstItem() }}</b> a <b>{{ $grados->lastItem() }}</b> de <b>{{ $grados->total() }}</b> resultados
    </span>
    <div class="ms-3">
        {{ $grados->onEachSide(1)->links('pagination::bootstrap-5') }}
    </div>
</div>
@endsection