@extends('layouts.admin')

@section('content')
<link rel="stylesheet" href="{{ asset('css/matriculas-admin.css') }}">
<div class="matricula-header d-flex align-items-center justify-content-between">
    <div>
        <span class="matricula-title"><i class="bi bi-mortarboard me-2"></i> Matrículas</span>
        <p class="mb-0 mt-2">Gestión de estudiantes, grados y fichas de matrícula.</p>
    </div>
    <a href="{{ route('matriculas.create') }}" class="btn btn-matricula shadow">Registrar nueva matrícula</a>
</div>
@if(session('success'))
<div class="alert alert-success">{{ session('success') }}</div>
@endif
<div class="table-responsive">
    <table class="table matricula-table table-striped table-hover rounded shadow">
        <thead>
            <tr>
                <th>ID</th>
                <th>Estudiante</th>
                <th>Grado</th>
                <th>Año Escolar</th>
                <th>Fecha Matrícula</th>
                <th>Estado</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($matriculas as $matricula)
            <tr>
                <td>{{ $matricula->id }}</td>
                <td>{{ $matricula->estudiante->usuario->nombre }} {{ $matricula->estudiante->usuario->apellido }}</td>
                <td>{{ $matricula->grado->nivel }} {{ $matricula->grado->grado }}{{ $matricula->grado->seccion }}</td>
                <td>{{ $matricula->anoEscolar->ano }}</td>
                <td>{{ $matricula->fecha_matricula->format('d/m/Y') }}</td>
                <td><span class="badge {{ $matricula->estado == 'Activo' ? 'bg-success' : ($matricula->estado == 'Retirado' ? 'bg-secondary' : 'bg-warning text-dark') }}">{{ $matricula->estado }}</span></td>
                <td>
                    <a href="{{ route('matriculas.edit', $matricula->id) }}" class="btn btn-sm btn-warning me-1">Editar</a>
                    @if($matricula->ficha_pdf)
                    <a href="{{ asset('storage/' . $matricula->ficha_pdf) }}" target="_blank" class="btn btn-sm btn-primary me-1">Ver PDF</a>
                    @endif
                    <form action="{{ route('matriculas.destroy', $matricula->id) }}" method="POST" style="display:inline-block;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('¿Seguro que deseas eliminar esta matrícula?')">Eliminar</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
<div class="d-flex justify-content-center mt-4">
    {{ $matriculas->links() }}
</div>
@endsection