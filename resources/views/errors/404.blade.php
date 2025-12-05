@extends('layouts.app')

@section('content')
<div class="container text-center py-5">
    <h1 class="display-4 text-danger mb-4">404 - No encontrado</h1>
    <p class="lead">{{ $mensaje ?? 'La página que buscas no existe.' }}</p>
    <a href="/" class="btn btn-primary mt-3"><i class="bi bi-arrow-left"></i> Volver al inicio</a>
</div>
@endsection