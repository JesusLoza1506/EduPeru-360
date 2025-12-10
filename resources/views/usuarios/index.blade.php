@extends('layouts.admin')

@section('content')
<link rel="stylesheet" href="{{ asset('css/usuarios-admin.css') }}">
<div class="usuarios-header d-flex flex-column align-items-start justify-content-between gap-3">
    <span class="usuarios-title mb-3"><i class="bi bi-people-fill me-2"></i> Gestión de Usuarios y Docentes</span>
</div>
<div class="bg-white rounded shadow p-3 mb-4 w-100 d-flex flex-wrap align-items-center gap-2" style="margin-top:-1.5rem;">
    <form method="GET" action="{{ route('usuarios.index') }}" class="usuarios-filtros-form d-flex flex-wrap align-items-center gap-3 mb-0 w-100 justify-content-center" style="background:#fff; border-radius:12px; box-shadow:0 2px 12px rgba(211,47,47,0.08); padding:18px 12px;">
        <div class="input-group" style="min-width:120px;">
            <span class="input-group-text" style="background:#d32f2f; color:#fff; font-weight:600; border:none;">Filtro</span>
            <select name="filtro" class="form-select" style="border:2px solid #d32f2f; color:#000;">
                <option value="nombre_apellido" {{ request('filtro') == 'nombre_apellido' ? 'selected' : '' }}>Nombres y Apellidos</option>
                <option value="dni" {{ request('filtro') == 'dni' ? 'selected' : '' }}>DNI</option>
                <option value="email" {{ request('filtro') == 'email' ? 'selected' : '' }}>Email</option>
                <option value="telefono" {{ request('filtro') == 'telefono' ? 'selected' : '' }}>Teléfono</option>
            </select>
        </div>
        <div class="input-group" style="min-width:160px;">
            <span class="input-group-text" style="background:#d32f2f; color:#fff; font-weight:600; border:none;">Buscar</span>
            <input type="text" name="busqueda" class="form-control" placeholder="Buscar..." value="{{ request('busqueda') }}" style="border:2px solid #d32f2f; color:#000;">
        </div>
        <div class="input-group" style="min-width:140px;">
            <span class="input-group-text" style="background:#d32f2f; color:#fff; font-weight:600; border:none;">Rol</span>
            <select name="rol" class="form-select" style="border:2px solid #d32f2f; color:#000;">
                <option value="">Todos los roles</option>
                <option value="Administrador General" {{ request('rol') == 'Administrador General' ? 'selected' : '' }}>Administrador General</option>
                <option value="Director" {{ request('rol') == 'Director' ? 'selected' : '' }}>Director</option>
                <option value="Docente" {{ request('rol') == 'Docente' ? 'selected' : '' }}>Docente</option>
                <option value="Estudiante" {{ request('rol') == 'Estudiante' ? 'selected' : '' }}>Estudiante</option>
                <option value="Padre" {{ request('rol') == 'Padre' ? 'selected' : '' }}>Padre</option>
            </select>
        </div>
        <button type="submit" class="btn ms-0 ms-md-2" style="background:#fff; color:#d32f2f; border:2px solid #d32f2f; min-width:140px; font-weight:600; border-radius:8px; box-shadow:0 2px 8px rgba(211,47,47,0.08);">🔎 Buscar</button>
        <a href="{{ route('usuarios.index') }}" class="btn ms-0 ms-md-2" style="background:#fff; color:#d32f2f; border:2px solid #d32f2f; min-width:140px; font-weight:600; border-radius:8px; box-shadow:0 2px 8px rgba(211,47,47,0.08);">🧹 Limpiar filtros</a>
        <a href="{{ route('usuarios.create') }}" class="btn ms-0 ms-md-2" style="background:#fff; color:#d32f2f; border:2px solid #d32f2f; min-width:140px; font-weight:600; border-radius:8px; box-shadow:0 2px 8px rgba(211,47,47,0.08);">📝 Registrar nuevo usuario</a>
    </form>
</div>
@if(session('success'))
<div class="alert alert-success">{{ session('success') }}</div>
@endif
<div class="table-responsive">
    <table class="table usuarios-table table-striped table-hover rounded shadow">
        <thead>
            <tr>
                <th>Nombres completos</th>
                <th>DNI</th>
                <th>Email</th>
                <th>Teléfono</th>
                <th>Rol</th>
                <th>Estado</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($usuarios as $usuario)
            <tr>
                <td>{{ $usuario->nombre }} {{ $usuario->apellido }}</td>
                <td>{{ $usuario->dni }}</td>
                <td>{{ $usuario->email }}</td>
                <td>{{ $usuario->telefono }}</td>
                <td>{{ $usuario->rol }}</td>
                <td>
                    @if($usuario->activo)
                    <span class="badge bg-success">Activo</span>
                    @else
                    <span class="badge bg-secondary">Inactivo</span>
                    @endif
                </td>
                <td>
                    <a href="{{ route('usuarios.edit', $usuario->id) }}" class="btn btn-warning btn-sm">
                        <span style="font-size:18px; margin-right:4px; vertical-align:middle;">✏️</span>Editar
                    </a>
                    <form action="{{ route('usuarios.destroy', $usuario->id) }}" method="POST" style="display:inline-block;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('¿Seguro que deseas eliminar este usuario?')">
                            <span style="font-size:18px; margin-right:4px; vertical-align:middle;">🗑️</span>Eliminar
                        </button>
                    </form>
                    <form action="{{ route('usuarios.resetPassword', $usuario->id) }}" method="POST" style="display:inline-block;">
                        @csrf
                        <input type="hidden" name="password" value="12345678">
                        <button type="submit" class="btn btn-info btn-sm" onclick="return confirm('¿Restablecer la contraseña a 12345678?')">
                            <span style="font-size:18px; margin-right:4px; vertical-align:middle;">🔄</span>Reset
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
        Mostrando <b>{{ $usuarios->firstItem() }}</b> a <b>{{ $usuarios->lastItem() }}</b> de <b>{{ $usuarios->total() }}</b> resultados
    </span>
    <div class="ms-3">
        {{ $usuarios->onEachSide(1)->links('pagination::bootstrap-5') }}
    </div>
</div>
@endsection