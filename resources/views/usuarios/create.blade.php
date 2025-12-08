@extends('layouts.admin')

@section('content')
<div class="d-flex align-items-center mb-4">
    <h2 class="fw-bold text-danger mb-0"><i class="bi bi-person-plus-fill me-2"></i> Registrar Usuario</h2>
    <a href="{{ route('usuarios.index') }}" class="btn btn-secondary ms-auto" style="background:#fff; color:#d32f2f; border:2px solid #d32f2f; font-weight:600; border-radius:8px; box-shadow:0 2px 8px rgba(211,47,47,0.08);"><span style="font-size:18px; margin-right:4px; vertical-align:middle;">🔙</span>Volver al listado</a>
</div>
@if($errors->any())
<div class="alert alert-danger">
    <ul>
        @foreach($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif
<form action="{{ route('usuarios.store') }}" method="POST" class="bg-white rounded shadow p-4 mb-4" style="background:#fff; border-radius:12px; box-shadow:0 2px 12px rgba(211,47,47,0.08);"> @csrf
    <div class="row mb-3">
        <div class="col-md-6">
            <label for="nombre" class="form-label">Nombre</label>
            <input type="text" name="nombre" id="nombre" class="form-control" required value="{{ old('nombre') }}" style="border:2px solid #d32f2f;">
        </div>
        <div class="col-md-6">
            <label for="apellido" class="form-label">Apellido</label>
            <input type="text" name="apellido" id="apellido" class="form-control" required value="{{ old('apellido') }}" style="border:2px solid #d32f2f;">
        </div>
    </div>
    <div class="row mb-3">
        <div class="col-md-4">
            <label for="dni" class="form-label">DNI</label>
            <input type="text" name="dni" id="dni" class="form-control" required value="{{ old('dni') }}" style="border:2px solid #d32f2f;">
        </div>
        <div class="col-md-4">
            <label for="email" class="form-label">Email</label>
            <input type="email" name="email" id="email" class="form-control" required value="{{ old('email') }}" style="border:2px solid #d32f2f;">
        </div>
        <div class="col-md-4">
            <label for="telefono" class="form-label">Teléfono</label>
            <input type="text" name="telefono" id="telefono" class="form-control" value="{{ old('telefono') }}" style="border:2px solid #d32f2f;">
        </div>
    </div>
    <div class="row mb-3">
        <div class="col-md-4">
            <label for="rol" class="form-label">Rol</label>
            <select name="rol" id="rol" class="form-select" required style="border:2px solid #d32f2f;">
                <option value="">Selecciona un rol</option>
                <option value="Administrador General" {{ old('rol') == 'Administrador General' ? 'selected' : '' }}>Administrador General</option>
                <option value="Director" {{ old('rol') == 'Director' ? 'selected' : '' }}>Director</option>
                <option value="Docente" {{ old('rol') == 'Docente' ? 'selected' : '' }}>Docente</option>
                <option value="Estudiante" {{ old('rol') == 'Estudiante' ? 'selected' : '' }}>Estudiante</option>
                <option value="Padre" {{ old('rol') == 'Padre' ? 'selected' : '' }}>Padre</option>
            </select>
        </div>
        <div class="col-md-4">
            <label for="password" class="form-label">Contraseña</label>
            <input type="password" name="password" id="password" class="form-control" required style="border:2px solid #d32f2f;">
        </div>
        <div class="col-md-4">
            <label for="activo" class="form-label">Estado</label>
            <select name="activo" id="activo" class="form-select" required style="border:2px solid #d32f2f;">
                <option value="1" {{ old('activo', 1) == 1 ? 'selected' : '' }}>Activo</option>
                <option value="0" {{ old('activo') == 0 ? 'selected' : '' }}>Inactivo</option>
            </select>
        </div>
    </div>
    <button type="submit" class="btn" style="background:#d32f2f; color:#fff; font-weight:600; border-radius:8px; min-width:140px; box-shadow:0 2px 8px rgba(211,47,47,0.12);"><span style="font-size:18px; margin-right:4px; vertical-align:middle;">📝</span>Registrar</button>
</form>
@endsection