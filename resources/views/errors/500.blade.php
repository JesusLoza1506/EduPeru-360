@extends('layouts.app')

@section('content')
<div class="container text-center py-5">
    <h1 class="display-4 text-warning mb-4">500 - Error interno</h1>
    <p class="lead">{{ $mensaje ?? 'Ocurrió un error inesperado en el servidor.' }}</p>
    <a href="/" class="btn btn-primary mt-3"><i class="bi bi-arrow-left"></i> Volver al inicio</a>
</div>
@endsection